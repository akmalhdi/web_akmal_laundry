<?php
$sql = "SELECT o.id, o.order_code, o.created_at, o.order_total, o.order_pay, 
               o.order_status, c.name AS customer_name
        FROM trans_orders o
        JOIN customers c ON o.id_customer = c.id
        ORDER BY o.created_at DESC";

$result = $config->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Laporan Transaksi Laundry</title>
  <style>
    @media print {
      .d-print-none {
        display: none !important;
      }
    }
  </style>
</head>

<body>
  <!-- Tombol cetak -->
  <button id="print-btn" onclick="window.print()" class="btn btn-primary mb-3 d-print-none">🖨️ print report</button>

  <!-- Tampilkan periode terpilih -->
  <div class="card">
    <div class="card-header">
      <h2 class="card-title mb-3">REPORT OF ALL TRANSACTIONS</h2>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Order Code</th>
            <th>Order Date</th>
            <th>Customer</th>
            <th class="text-right">Total</th>
            <th class="text-right">Pay</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sumTotal = 0;
          $sumPay   = 0;

          while ($row = $result->fetch_assoc()) {
            // akumulasi total
            $sumTotal  += $row['order_total'];
            $sumPay    += $row['order_pay'];
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $row['order_code'] ?></td>
              <td><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
              <td><?= $row['customer_name'] ?></td>
              <td class="text-right"><?= "Rp " . number_format($row['order_total'], 0, ',', '.') ?></td>
              <td class="text-right"><?= "Rp " . number_format($row['order_pay'], 0, ',', '.') ?></td>
              <td><?= $row['order_status'] == 1 ? 'On Process' : 'Done' ?></td>
            </tr>
          <?php } ?>
        </tbody>

        <tfoot>
          <tr>
            <th colspan="4" class="text-right">TOTAL</th>
            <th class="text-right"><?= "Rp " . number_format($sumTotal, 0, ',', '.') ?></th>
            <th class="text-right"><?= "Rp " . number_format($sumPay, 0, ',', '.') ?></th>
          </tr>
        </tfoot>
      </table>
    </div>
    <p class="mb-3 ms-3 fw-bold">Printed on: <?= date('d/m/Y') ?></p>
  </div>

</body>

</html>