<?php
session_start();
include "../config/config.php";

$id = $_GET['id'] ?? '';
// ambil data table orders
$query = mysqli_query($config, "SELECT * FROM trans_orders WHERE id = '$id' ORDER BY id DESC");
$row = mysqli_fetch_assoc($query);

// ambil data table order details
$order_id = $row['id'];
$queryDetails = mysqli_query($config, "SELECT s.name, od.* FROM trans_order_details od LEFT JOIN services s ON s.id = od.id_service WHERE id_order = '$order_id'");
$rowDetails = mysqli_fetch_all($queryDetails, MYSQLI_ASSOC);

$queryTax = mysqli_query($config, "SELECT * FROM taxs WHERE is_active = 1");
$taxs = mysqli_fetch_assoc($queryTax);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi Laundry</title>

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
            <h2>Struk MariLaundry</h2>
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
                    <span class="item-name"><?php echo $item['name'] ?></span>
                    <span class="item-qty"><?php echo "X" . $item['qty'] ?></span>
                    <span class="item-price"><?php echo "Rp. " . number_format($item['price'], 0, ',', '.') ?></span>
                </div>
            <?php endforeach ?>
        </div>

        <div class="separator"></div>

        <div class="totals">
            <?php foreach($rowDetails as $detail): ?>
            <div class="total-row">
                <span>Sub Total</span>
                <span><?php echo "Rp. " . number_format($detail['subtotal'], 0, ',', '.') ?></span>
            </div>
            <?php endforeach ?>

            <div class="total-row">
                <span>Ppn (<?= $taxs['percent'] ?>%)</span>
                <span><?php echo "Rp. " . number_format($row['order_tax'], 0, ',', '.') ?></span>
            </div>
        </div>

        <div class="separator"></div>

        <div class="payment">
            <div class="total-row grand">
                <span>Total</span>
                <span><?php echo "Rp. " . number_format($row['order_total'], 0, ',', '.') ?></span>
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