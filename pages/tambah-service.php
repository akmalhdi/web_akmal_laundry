<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$queryEdit = mysqli_query($config, "SELECT * FROM services WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['update'])) {
    // $_POST
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $update = mysqli_query(
        $config,
        "UPDATE services SET 
        name='$name', 
        price='$price', 
        description='$description'
        WHERE id='$id' 
        "
    );
    header("location:?page=service&ubah=berhasil");
}

if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $query = mysqli_query($config, "INSERT INTO services (name, price, description) values ('$name', '$price', '$description')");

    if ($query) {
        header("location:?page=service&tambah=berhasil");
    }
}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                        <?php echo isset($_GET['edit']) ? 'Update' : 'Add' ?> Service
                </h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Service Name</label>
                        <input class="form-control" type="text" name="name" value="<?php echo $rowEdit['name'] ?? "" ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input class="form-control" type="number" name="price" value="<?php echo $rowEdit['price'] ?? "" ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id=""><?php echo $rowEdit['description'] ?? "" ?></textarea>
                    </div>

                    <div class="mb-3 d-flex justify-content-center gap-2">
                        <button class="btn btn-primary btn-sm" type="submit"
                            name="<?php echo isset($_GET['edit']) ? 'update' : 'simpan' ?>">
                            <?php echo isset($_GET['edit']) ? 'Edit' : 'Save' ?>
                        </button>
                        <a href="?page=service" class="btn btn-primary btn-sm">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>