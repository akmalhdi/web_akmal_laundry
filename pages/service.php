<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$query = mysqli_query($config, "SELECT * From services s ORDER BY s.id DESC");
$service = mysqli_fetch_all($query, MYSQLI_ASSOC);

// disini parameter delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($config, "DELETE FROM services WHERE id='$id'");
    // redirect
    header("location:?page=service&hapus=berhasil");
}

?>

<div class="pagetitle">
    <h1>Service</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=dashboard">Home</a></li>
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Blank</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Data Service
                </h3>
            </div>
            <div class="card-body">
                <div align="right">
                    <a href="?page=tambah-service" class="btn btn-primary btn-sm mb-3 mt-3">
                        <i class="bi bi-plus-circle"></i> Add Service
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Service Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($service as $key => $value) {
                        ?>
                            <tr>
                                <td><?php echo $key += 1 ?></td>
                                <td><?php echo $value['name'] ?></td>
                                <td><?php echo $value['price'] ?></td>
                                <td><?php echo $value['description'] ?></td>
                                <td align="center">
                                    <a class="btn btn-success btn-sm" href="?page=tambah-service&edit=<?php echo $value['id'] ?>">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                        href="?page=service&delete=<?php echo $value['id'] ?>">
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