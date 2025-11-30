<?php
// include
// include_once
// require_once
// require
// require_once "config/koneksi.php";

$query = mysqli_query($config, "SELECT * FROM menus ORDER BY `order`");

$menus = mysqli_fetch_all($query, MYSQLI_ASSOC);

// disini parameter delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($config, "DELETE FROM menus WHERE id='$id'");
    // redirect
    header("location:?page=menu&hapus=berhasil");
}
?>

<div class="pagetitle">
    <h1>Menu</h1>
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
                    Data Menu
                </h3>
            </div>
            <div class="card-body mt-3">
                <div class="mb-3" align="right">
                    <a href="?page=tambah-menu" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Add Menu
                    </a>
                    <!-- <a href="?page=user-restore" class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i> User Restore
                    </a> -->
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Name</th>
                            <th>Icon</th>
                            <th>Link</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($menus as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key += 1 ?></td>
                                <td><?php echo $value['name'] ?></td>
                                <td><?php echo $value['icon'] ?></td>
                                <td><?php echo $value['link'] ?></td>
                                <td><?php echo $value['order'] ?></td>
                                <td align="center">
                                    <a class="btn btn-success btn-sm" href="?page=tambah-menu&edit=<?php echo $value['id'] ?>">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                        href="?page=menu&delete=<?php echo $value['id'] ?>">
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