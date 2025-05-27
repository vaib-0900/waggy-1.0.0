<?php
include('header.php');
include('sidebar.php');
include('db_connection.php');
?>

<?php
if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $query = "SELECT * FROM tbl_customer WHERE customer_id = $customer_id";
    $result = mysqli_query($conn, $query);
    $customer = mysqli_fetch_assoc($result);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_password = $_POST['customer_password'];
    $customer_phone = $_POST['customer_phone'];
    $customer_address = $_POST['customer_address'];
    $customer_landmark = $_POST['customer_landmark'];
    $customer_status = $_POST['customer_status'];

    $query = "UPDATE tbl_customer SET customer_name='$customer_name', customer_email='$customer_email', customer_password='$customer_password', customer_phone='$customer_phone', customer_address='$customer_address', customer_landmark='$customer_landmark', customer_status='$customer_status' WHERE customer_id=$customer_id";

    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Customer updated successfully!</div>";
        header("Location: customer_list.php"); // Redirect to customer list after update
        exit();

    } else {
        echo "Error updating customer: " . mysqli_error($conn);
    }
}
?>
<div id="page-wrapper">
<div id="page-inner">
    <h1>Edit customer</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="customer_name">customer Name:</label>
            <input type="text" name="customer_name" class="form-control" value="<?php echo $customer['customer_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="customer_email">customer_email:</label>
            <input type="email" name="customer_email" class="form-control" value="<?php echo $customer['customer_email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="customer_password">customer_password:</label>
            <input type="password" name="customer_password" class="form-control" value="<?php echo $customer['customer_password']; ?>" required>
        </div>
        <div class="form-group">
            <label for="customer_phone">customer_phone:</label>
            <input type="text" name="customer_phone" class="form-control" value="<?php echo $customer['customer_phone']; ?>" required>
        </div>
        <div class="form-group">
            <label for="customer_address">customer_address:</label>
            <input type="text" name="customer_address" class="form-control" value="<?php echo $customer['customer_address']; ?>" required>
        </div>
        <div class="form-group">
            <label for="customer_landmark">customer_landmark:</label>
            <input type="text" name="customer_landmark" class="form-control" value="<?php echo $customer['customer_landmark']; ?>" required>
        </div>
        <div class="form-group">
            <label for="customer_status">customer_status:</label>
            <select name="customer_status" class="form-control" required>
                <option value="1" <?php if ($customer['customer_status'] == 1) echo 'selected'; ?>>Active</option>
                <option value="0" <?php if ($customer['customer_status'] == 0) echo 'selected'; ?>>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update customer</button>
    </form>
</div>
</div>




<?php
include("footer.php");
?>
