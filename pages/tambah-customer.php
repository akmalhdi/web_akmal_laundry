<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$queryEdit = mysqli_query($config, "SELECT * FROM customers WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['update'])) {
    // $_POST
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $update = mysqli_query(
        $config,
        "UPDATE customers SET 
        name='$name', 
        phone='$phone', 
        address='$address'
        WHERE id='$id' 
        "
    );
    header("location:?page=customer&ubah=berhasil");
}

if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $query = mysqli_query($config, "INSERT INTO customers (name, phone, address) values ('$name', '$phone', '$address')");

    if ($query) {
        header("location:?page=customer&tambah=berhasil");
    }
}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                    <h3 class="card-title">
                        <?php echo isset($_GET['edit']) ? 'Update' : 'Add' ?> Customer
                    </h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Customer Name</label>
                        <input class="form-control" type="text" name="name" value="<?php echo $rowEdit['name'] ?? "" ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Phone Number</label>
                        <input class="form-control" type="text" name="phone" value="<?php echo $rowEdit['phone'] ?? "" ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id=""><?php echo $rowEdit['address'] ?? "" ?></textarea>
                    </div>

                    <div class="mb-3 d-flex justify-content-center gap-2">
                        <button class="btn btn-primary btn-sm" type="submit"
                            name="<?php echo isset($_GET['edit']) ? 'update' : 'simpan' ?>">
                            <?php echo isset($_GET['edit']) ? 'Edit' : 'Save' ?>
                        </button>
                        <a href="?page=customer" class="btn btn-primary btn-sm">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>