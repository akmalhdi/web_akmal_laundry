<?php
session_start();
include "../config/config.php";

$id = $_GET['id'] ?? '';
$query = mysqli_query($config, "SELECT * FROM trans_orders WHERE id = '$id' ORDER BY id DESC");
$row = mysqli_fetch_assoc($query);

$order_id = $row['id'];
$queryDetails = mysqli_query($config, "SELECT s.name, od.* FROM trans_order_details od LEFT JOIN services s ON s.id = od.id_service WHERE id_order = '$order_id'");
$rowDetails = mysqli_fetch_all($queryDetails, MYSQLI_ASSOC);

// Hitung total subtotal sebelum PPN
$totalSubtotal = 0;
foreach ($rowDetails as $item) {
    $totalSubtotal += $item['subtotal'];
}
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
            margin: 8px 0;
            font-size: 12px;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            margin-left: 10px;
        }

        .item-left {
            flex: 1;
        }

        .item-right {
            min-width: 80px;
            text-align: right;
            font-weight: bold;
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
                $date = date('d-M-Y', strtotime($row['created_at']));
                $time = date('H:i:s', strtotime($row['created_at']));
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
                    <div class="item-name"><?php echo $item['name'] ?></div>
                    <div class="item-row">
                        <span class="item-left">
                            <?php echo "X" . $item['qty'] . " @ " . "Rp. " . number_format($item['price'], 0, ',', '.') ?>
                        </span>
                        <span class="item-right">
                            <?php echo "Rp. " . number_format($item['subtotal'], 0, ',', '.') ?>
                        </span>
                    </div>
                </div>
                <div class="separator"></div>
            <?php endforeach ?>
        </div>

        <div class="totals">
            <div class="total-row">
                <span>Sub Total</span>
                <span><?php echo "Rp. " . number_format($totalSubtotal, 0, ',', '.') ?></span>
            </div>
            <div class="total-row">
                <span>Ppn (<?= $row['active_tax'] ?>%)</span>
                <span><?php echo "Rp. " . number_format($row['order_tax'], 0, ',', '.') ?></span>
            </div>
        </div>

        <div class="separator"></div>

        <div class="payment">
            <div class="total-row grand">
                <span>Total</span>
                <span><?php echo "Rp. " . number_format($row['order_total'], 0, ',', '.') ?></span>
            </div>
        </div>

    </div>
</body>

</html>