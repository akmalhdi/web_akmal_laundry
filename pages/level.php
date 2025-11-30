<?php
// require_once "config/koneksi.php";
$query = mysqli_query($config, "SELECT * FROM levels");
$levels = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($config, "DELETE FROM levels WHERE id = '$id'");
    header("location:?page=level&hapus=berhasil");
}

?>

<div class="pagetitle">
    <h1>Level</h1>
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
                    Data Level
                </h3>
            </div>
            <div class="card-body">
                <div align="right">
                    <a href="?page=tambah-level" class="btn btn-primary btn-sm mb-3 mt-3">
                        <i class="bi bi-plus-circle"></i> Add Level
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Level Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($levels as $key => $level) {
                        ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $level['name'] ?></td>
                                <td align="center">
                                    <a class="btn btn-warning btn-sm" href="?page=add-role-menu&edit=<?php echo $level['id'] ?>">
                                        <i class="bi bi-people"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm" href="?page=tambah-level&edit=<?php echo $level['id'] ?>">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                        href="?page=level&delete=<?php echo $level['id'] ?>">
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