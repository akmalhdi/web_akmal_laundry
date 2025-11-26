<?php
session_start();
include "../config/koneksi.php";

// ambil data table orders
$query = mysqli_query($koneksi, "SELECT * FROM orders ORDER BY id DESC");
$row = mysqli_fetch_assoc($query);

// ambil data table order details
$order_id = $row['id'];
$queryDetails = mysqli_query($koneksi, "SELECT p.product_name, od.* FROM order_details od LEFT JOIN products p ON p.id = od.product_id WHERE order_id = '$order_id'");
$rowDetails = mysqli_fetch_all($queryDetails, MYSQLI_ASSOC);

// ppn
$tax = $row['order_subtotal'] * 0.1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>

    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 80mm;
            margin: auto;
            padding: 10px;
            background-color: white;
        }

        .receipt-page {
            width: 100%;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h2 {
            font-size: 20px;
            margin: 0 0 10px 0;
            font-weight: bold;
        }

        .header p {
            margin: 3px 0;
            font-size: 11px;
        }

        .info {
            margin: 15px 0;
            font-size: 11px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
        }

        .separator {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        .item {
            margin: 0 10px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            font-size: 12px;
        }

        .item-qty {
            margin: 0 10px;
            flex: 1;
        }

        .item-price {
            text-align: right;
            min-width: 80px;
        }

        .totals {
            margin-top: 15px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            font-size: 12px;
        }

        .total-row.grand {
            font-weight: bolder;
            font-size: 16px;
            margin: 10px 0;
        }

        .payment {
            margin-top: 10px;
        }

        @media print {
            body {
                margin: auto;
                padding: 0;
            }

            @page {
                margin: 0;
                size: 80mm auto;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="receipt-page">

        <div class="header">
            <h2>Struk Pembayaran</h2>
            <p>Jl. Benhil Karet Jakarta Pusat</p>
            <p>08999809989</p>
        </div>

        <div class="separator"></div>

        <div class="info">
            <div class="info-row">
                <?php
                // strtotime
                $date = date(
                    'd-M-Y',
                    strtotime($row['created_at'])
                );
                $time = date(
                    'h:i:s',
                    strtotime($row['created_at'])
                );
                ?>
                <span><?php echo $date ?></span>
                <span><?php echo $time ?></span>
            </div>

            <div class="info-row">
                <span>Transaction Id</span>
                <span><?php echo $row['order_code'] ?></span>
            </div>

            <div class="info-row">
                <span>Cashier Name</span>
                <span><?php echo $_SESSION['NAME'] ?></span>
            </div>
        </div>

        <div class="separator"></div>

        <div class="items">
            <?php foreach ($rowDetails as $item): ?>
                <div class="item">
                    <span class="item-name"><?php echo $item['product_name'] ?></span>
                    <span class="item-qty"><?php echo "X" . $item['qty'] ?></span>
                    <span class="item-price"><?php echo "Rp. " . number_format($item['order_price'], 0, ',', '.') ?></span>
                </div>
            <?php endforeach ?>
        </div>

        <div class="separator"></div>

        <div class="totals">
            <div class="total-row">
                <span>Sub Total</span>
                <span><?php echo "Rp. " . number_format($row['order_subtotal'], 0, ',', '.') ?></span>
            </div>

            <div class="total-row">
                <span>Ppn (10%)</span>
                <span><?php echo "Rp. " . number_format($tax, 0, ',', '.') ?></span>
            </div>
        </div>

        <div class="separator"></div>

        <div class="payment">
            <div class="total-row grand">
                <span>Total</span>
                <span><?php echo "Rp. " . number_format($row['order_amount'], 0, ',', '.') ?></span>
            </div>

            <!-- <div class="total-row">
                <span>Cash</span>
                <span>Rp. 20.000</span>
            </div>

            <div class="total-row">
                <span>Change</span>
                <span>Rp. 9.000</span>
            </div> -->
        </div>

    </div>
</body>

</html>