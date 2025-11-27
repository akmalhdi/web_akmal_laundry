<?php

include "../config/config.php";

$queryServices = mysqli_query($config, "SELECT * FROM services");
$services = mysqli_fetch_all($queryServices, MYSQLI_ASSOC);

$queryCustomers = mysqli_query($config, "SELECT * FROM customers");
$customers = mysqli_fetch_all($queryCustomers, MYSQLI_ASSOC);

// query product
// $queryProduct = mysqli_query($config, "SELECT s.name, p.* FROM products p LEFT JOIN categories c ON c.id = p.category_id ORDER BY id DESC");
// $fetchProducts = mysqli_fetch_all($queryProduct, MYSQLI_ASSOC);

if (isset($_GET['payment'])) {

    // transaction
    mysqli_begin_transaction($config);
    $data = json_decode(file_get_contents('php://input'), true);

    $cart = $data['cart'];

    $tax = $data['tax'];
    $orderAmounth = $data['grandTotal'];
    $orderCode = $data['order_code'];
    $order_end_date = $data['order_end_date'];
    $customer_id = $data['customer_id'];
    $orderChange = 0;
    $orderPay = 0;
    $orderStatus = 1;

    try {
        $insertOrder = mysqli_query(
            $config,
            "INSERT INTO trans_orders (order_code, order_end_date, order_total, order_pay, order_change, order_tax, order_status) 
            VALUES('$orderCode', '$order_end_date', '$orderAmounth', '$orderPay', '$orderChange', '$tax', '$orderStatus')"
        );

        if (!$insertOrder) {
            throw new Exception(
                'Insert failed to table orders',
                mysqli_error($config)
            );
        }

        $idOrder = mysqli_insert_id($config);

        foreach ($cart as $v) {
            $service_id = $v['id'];
            $qty = $v['qty'];
            $order_price = $v['price'];
            $subtotal = $qty * $order_price;

            $insertOrderDetails = mysqli_query($config, "INSERT INTO trans_order_details(id_order, id_service, qty, price, subtotal) VALUES ('$idOrder', '$service_id', '$qty', '$order_price', '$subtotal')");

            if (!$insertOrderDetails) {
                throw new Exception(
                    'Insert failed to table order details',
                    mysqli_error($config)
                );
            }
        }

        mysqli_commit($config);
        $response = [
            'status' => 'success',
            'message' => 'Transaction success',
            'order_id' => $idOrder,
            'order_code' => $orderCode,
        ];
        echo json_encode($response);
        die;
    } catch (\Throwable $th) {
        mysqli_rollback($config);
        $response = ['status' => 'Error', 'message' => $th->getMessage()];
        echo json_encode($response);
        die;
    }
}

// ambil data untuk order number
$orderNumber = mysqli_query($config, "SELECT id FROM trans_orders ORDER BY id DESC LIMIT 1");
$row = mysqli_fetch_assoc($orderNumber);

$nextId = $row ? $row['id'] + 1 : 1;
$order_code = "ORD-" . date("dmy") . str_pad($nextId, 4, "0", STR_PAD_LEFT);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point Of Sale</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/css/pos.css" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
</head>

<body>
    <div class="container-fluid container-pos">
        <div class="row h-100">
            <div class="col-md-7 product-section">
                <div class="card shadow-sm mb-3">
                    <div class="card-header text-center fs-4">
                        Laundry Customer
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    Customer Name
                                </label>
                                <select name="id_customer" id="customer_id" class="form-control" onchange="selectCustomers()">
                                    <option value="">Select One</option>
                                    <?php foreach ($customers as $customer): ?>
                                        <option data-phone="<?= $customer['phone'] ?>" data-address="<?= $customer['address'] ?>" value="<?= $customer['id'] ?>">
                                            <?= $customer['name'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    Phone Number
                                </label>
                                <input type="text" class="form-control" placeholder="Phone Number" id="phone" readonly>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    End Date
                                </label>
                                <input type="date" name="order_end_date" id="order_end_date" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    Address
                                </label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Address" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-3">
                    <div class="card-header text-center fs-4">
                        Laundry Service
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <?php foreach ($services as $service): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm service-card p-2 text-center" onclick="openModal(<?= htmlspecialchars(json_encode($service)) ?>)">
                                        <h6><?= $service['name'] ?></h6>
                                        <small class="text-muted">Rp.<?= $service['price'] ?> / Kg</small>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="modal_id">
                                <input type="hidden" id="modal_price">
                                <input type="hidden" id="modal_qty">

                                <div class="mb-3">
                                    <label for="" class="form-label">
                                        Service Name
                                    </label>
                                    <input type="text" id="modal_name" name="modal_name" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">
                                        Weight / Qty
                                    </label>
                                    <input type="number" name="modal_qty" class="form-control" placeholder="weight / Qty">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="addToCart()">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 cart-section">

                <div class="cart-header">
                    <h4>Cart</h4>
                    <!-- ORD-date-001 -->
                    <small>Order #<span class="orderNumber"><?php echo $order_code ?></span></small>
                </div>

                <div class="cart-items" id="cartItems">
                    <div class="text-center text-muted mt-5">
                        <i class="bi bi-cart mb-3"></i>
                        <p>Cart Empty</p>
                    </div>
                </div>

                <div class="cart-footer">

                    <div class="total-section">

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span id="subtotal">Rp 0.-</span>
                            <input type="hidden" id="subtotal_value">
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax(10%)</span>
                            <span id="tax">Rp 0.-</span>
                            <input type="hidden" id="tax_value">
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Total</span>
                            <span id="total">Rp 0.-</span>
                            <input type="hidden" id="total_value">
                        </div>

                        <div class="row g-2">

                            <div class="col-md-6">
                                <button class="btn btn-clear-cart btn-danger w-100" id="clearCart">
                                    <i class="bi bi-trash"></i>Clear Cart
                                </button>
                            </div>

                            <div class="col-md-6">
                                <button class="btn btn-checkhout btn-primary w-100"
                                    onclick="processPayment()">
                                    <i class="bi bi-cash"></i> Process Payment
                                </button>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>

    <script src="../assets/js/laundry.js"></script>
</body>

</html>