<?php

$query = mysqli_query($config, "SELECT c.name, `to`.* FROM trans_orders `to` LEFT JOIN customers c ON c.id = `to`.id_customer WHERE order_status =   0 ORDER BY `to`.id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($config, "DELETE FROM trans_orders WHERE id=$id");
    if ($delete) {
        header("location:?page=order");
    }
}

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <h3 class="card-title">
                Transactions History
            </h3>
            <div class="card-body mt-3">
                <table class="table table-bordered table-striped">
                    <tr align="center">
                        <th>No</th>
                        <th>Order Code</th>
                        <th>Estimation</th>
                        <th>Order Total</th>
                        <th>Order Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    foreach ($rows as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $value['order_code'] ?></td>
                            <td><?php echo $value['order_end_date'] ?></td>
                            <td><?php echo $value['order_total'] ?></td>
                            <td><?= $value['order_status'] == 1 ? 'On Process' : 'Done' ?></td>
                            <td align="center">
                                <a class="btn btn-success btn-sm" href="pos/print.php?id=<?= $value['id'] ?>">
                                    <i class="bi bi-printer"></i> Print
                                </a>
                                <a class="btn btn-primary btn-sm" href="?page=detail&detail=<?php echo $value['id'] ?>">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                    href="?page=order&delete=<?php echo $value['id'] ?>">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <div class="d-flex justify-content-center">
                    <a href="?page=order" class="btn btn-primary btn-sm mb-3">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>