<?php
// require_once "config/koneksi.php";

$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$query = mysqli_query($config, "SELECT * FROM menus WHERE id='$id'");
$menu = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $icon = $_POST['icon'];
    $link = $_POST['link'];
    $order = $_POST['order'];
    $update = mysqli_query($config, "UPDATE menus SET name='$name', icon='$icon', link='$link', `order`='$order' WHERE id='$id' ");
    header("location:?page=menu&ubah=berhasil");
}

if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $icon = $_POST['icon'];
    $link = $_POST['link'];
    $order = $_POST['order'];
    $insert = mysqli_query($config, "INSERT INTO menus (name, icon, link, `order`) VALUES ('$name', '$icon', '$link', '$order')");

    header("location:?page=menu&tambah=berhasil");
}

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <?php echo isset($_GET['edit']) ? 'Update' : 'Add' ?> Menu
                </h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Menu Name</label>
                        <input class="form-control" type="text" name="name" value="<?php echo $menu['name'] ?? "" ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Icon</label>
                        <input class="form-control" type="text" name="icon" value="<?php echo $menu['icon'] ?? "" ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Link</label>
                        <input class="form-control" type="text" name="link" value="<?php echo $menu['link'] ?? "" ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Order</label>
                        <input class="form-control" type="number" name="order" value="<?php echo $menu['order'] ?? "" ?>" required>
                    </div>
                    <div class="mb-3 d-flex justify-content-center gap-2">
                        <button class="btn btn-primary btn-sm" type="submit"
                            name="<?php echo isset($_GET['edit']) ? 'update' : 'simpan' ?>">
                            <?php echo isset($_GET['edit']) ? 'Edit' : 'Save' ?>
                        </button>
                        <a href="?page=menu" class="btn btn-primary btn-sm">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>