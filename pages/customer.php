<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$query = mysqli_query($config, "SELECT * From customers c ORDER BY c.id DESC");
$customer = mysqli_fetch_all($query, MYSQLI_ASSOC);

// disini parameter delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($config, "DELETE FROM customers WHERE id='$id'");
    // redirect
    header("location:?page=customer&hapus=berhasil");
}

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Data Customers
                </h3>
            </div>
            <div class="card-body">
                <div align="right">
                    <a href="?page=tambah-customer" class="btn btn-primary btn-sm mb-3 mt-3">
                        <i class="bi bi-plus-circle"></i> Add Customer
                    </a>
                </div>
                <table class="table table-bordered table-striped datatable">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($customer as $key => $value) {
                        ?>
                            <tr>
                                <td><?php echo $key += 1 ?></td>
                                <td><?php echo $value['name'] ?></td>
                                <td><?php echo $value['phone'] ?></td>
                                <td><?php echo $value['address'] ?></td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="?page=tambah-customer&edit=<?php echo $value['id'] ?>">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                        href="?page=customer&delete=<?php echo $value['id'] ?>">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>