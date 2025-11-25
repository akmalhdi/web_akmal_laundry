<?php
// require_once "config/koneksi.php";

$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$query = mysqli_query($config, "SELECT * FROM levels WHERE id='$id'");
$level = mysqli_fetch_assoc($query);

$selectedLevel = $level['id'];

$queryMenus = mysqli_query($config, "SELECT * FROM menus ORDER BY id DESC");
$rowMenus = mysqli_fetch_all($queryMenus, MYSQLI_ASSOC);

$selectedMenu = mysqli_query($config, "SELECT id_menu FROM level_menus WHERE id_level = '$selectedLevel'");
$selectedMenuIds = [];
$rowSelectedMenus = mysqli_fetch_all($selectedMenu, MYSQLI_ASSOC);
foreach ($rowSelectedMenus as $selectedMenus) {
    $selectedMenuIds[] = $selectedMenus['id_menu'];
}

if (isset($_POST['save'])) {
    $id_level =  $_POST['id_level'];
    $id_menu =  $_POST['id_menu'];

    mysqli_query($config, "DELETE FROM level_menus WHERE id_level = $id_level");

    foreach ($id_menu as $key => $menu) {
        $insert = mysqli_query($config, "INSERT INTO level_menus (id_level, id_menu) VALUES ('$id_level', '$menu')");
    }

    header("location:?page=level&tambah=success");
}

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3><?php echo isset($_GET['edit']) ? 'Update' : 'Add' ?> Level</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Level Name</label>
                            <input class="form-control" type="text" value="<?php echo $level['name'] ?? "" ?>" readonly>
                            <input class="form-control" type="hidden" name="id_level" value="<?php echo $level['id'] ?? "" ?>" >
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Menu</label> <br>
                            <?php foreach ($rowMenus as $menu): ?>
                                <input type="checkbox" 
                                <?= in_array($menu['id'], $selectedMenuIds) ? 'checked' : '' ?>
                                name="id_menu[]" 
                                value="<?= $menu['id'] ?>">
                                <?= $menu['name'] ?> <br>
                            <?php endforeach ?>
                        </div>
                        
                        <div class="mb-3 d-flex justify-content-center gap-2">
                            <button class="btn btn-primary btn-sm" type="submit"
                                name="save">
                                Save Change
                            </button>
                            <a href="?page=level" class="btn btn-primary btn-sm">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>