<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$queryEdit = mysqli_query($config, "SELECT * FROM users WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

$queryLevels = mysqli_query($config, "SELECT * FROM levels ORDER BY id DESC");
$rowLevels = mysqli_fetch_all($queryLevels, MYSQLI_ASSOC);

if (isset($_POST['update'])) {
    // $_POST
    $id_level = $_POST['id_level'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    if ($password) {
        $query = mysqli_query($config, "UPDATE users SET id_level='$id_level', name='$name', email='$email', password='$password' WHERE id='$id'");
    } else {
        $query = mysqli_query($config, "UPDATE users SET id_level='$id_level', name='$name', email='$email' WHERE id='$id'");
    }

    if ($query) {
        header("location:?page=user&ubah=berhasil");
    }
}

if (isset($_POST['simpan'])) {
    $id_level = $_POST['id_level'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $query = mysqli_query($config, "INSERT INTO users (id_level, name, email, password) values ('$id_level', '$name', '$email', '$password')");

    if ($query) {
        header("location:?page=user&tambah=berhasil");
    }
}

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card-header">
            <h3 class="card-title">
                <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> User
            </h3>
        </div>
        <div class="card-body mt-3">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Level Name</label>
                    <select name="id_level" class="form-control" id="">
                        <option value="">- Select Level -</option>
                        <?php
                        foreach ($rowLevels as $value) :
                        ?>
                            <option value="<?php echo $value['id'] ?>" <?= isset($rowEdit) && $rowEdit['id_level'] == $value['id'] ? 'selected' : '' ?>><?php echo $value['name'] ?></option>
                        <?php endforeach
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" required value="<?php echo $rowEdit['name'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required value="<?php echo $rowEdit['email'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Password <small>*Kosongkan jika tidak ingin mengubah</small></label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                </div>

                <div class="mb-3 d-flex justify-content-center gap-2">
                    <button class="btn btn-primary btn-sm" type="submit" name="<?php echo ($id) ? 'update' : 'simpan' ?>">
                        <?php echo ($id) ? 'Edit' : 'Save' ?>
                    </button>
                    <a href="?page=user" class="btn btn-primary btn-sm">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>