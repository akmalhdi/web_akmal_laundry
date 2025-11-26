<?php
// require_once "config/koneksi.php";

$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$query = mysqli_query($config, "SELECT * FROM taxs WHERE id='$id'");
$tax = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $percent = $_POST['percent'];
    $is_active = $_POST['is_active'];
    $update = mysqli_query($config, "UPDATE taxs SET percent='$percent', is_active='$is_active' WHERE id='$id' ");
    header("location:?page=tax&ubah=berhasil");
}

if (isset($_POST['simpan'])) {
    $percent = $_POST['percent'];
    $is_active = $_POST['is_active'];
    $insert = mysqli_query($config, "INSERT INTO taxs (percent, is_active) VALUES ('$percent', '$is_active')");

    header("location:?page=tax&tambah=berhasil");
}

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3><?php echo isset($_GET['edit']) ? 'Update' : 'Add' ?> Tax</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Percent</label>
                            <input class="form-control" type="number" name="percent" value="<?php echo $tax['percent'] ?? "" ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <br>
                            <input type="radio" name="is_active" value="0"
                                <?= ($tax['is_active'] ?? '') == 0 ? 'checked' : '' ?>> Draft
                            <br>
                            <input type="radio" name="is_active" value="1"
                                <?= ($tax['is_active'] ?? '') == 1 ? 'checked' : '' ?>> Active
                        </div>
                        <div class="mb-3 d-flex justify-content-center gap-2">
                            <button class="btn btn-primary btn-sm" type="submit"
                                name="<?php echo isset($_GET['edit']) ? 'update' : 'simpan' ?>">
                                <?php echo isset($_GET['edit']) ? 'Edit' : 'Save' ?>
                            </button>
                            <a href="?page=tax" class="btn btn-primary btn-sm">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>