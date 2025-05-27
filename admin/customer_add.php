<?php
include('header.php');
include('sidebar.php');
include('db_connection.php');
?>
<div id="page-wrapper">
    <div id="page-inner">
        <h1>Add customer</h1>
        <form action="customer_add.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="customer Name:">customer Name:</label>
                <input type="text" class="form-control" name="customer_name" required>
            </div>
            <div class="form-group">
                <label for="customer_email">customer_email:</label>
                <input type="email" class="form-control" name="customer_email" required>
            </div>
            <div class="form-group">
                <label for="customer_password">customer_password:</label>
                <input type="password" class="form-control" name="customer_password" required>
            </div>
            <div class="form-group">
                <label for="customer_phone">customer_phone:</label>
                <input type="text" class="form-control" name="customer_phone" required>
            </div>
            <div class="form-group">
                <label for="customer_address">customer_address:</label>
                <input type="text" class="form-control" name="customer_address" required>
            </div>
            <div class="form-group">
                <label for="customer_landmark">customer_landmark:</label>
                <input type="text" class="form-control" name="customer_landmark" required>
            </div>
            <div class="form-group">
                <label for="customer_status">customer_status:</label>
                <select class="form-control" name="customer_status" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" href="customer_list.php">Add customer</button>
            <a href="category_list.php" class="btn btn-primary">Back to Category List</a>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $customer_name = $_POST['customer_name'];
            $customer_email = $_POST['customer_email'];
            $customer_password = $_POST['customer_password'];
            $customer_phone = $_POST['customer_phone'];
            $customer_address = $_POST['customer_address'];
            $customer_landmark = $_POST['customer_landmark'];
            $customer_status = $_POST['customer_status'];

            $sql = "INSERT INTO tbl_customer (customer_name, customer_email, customer_password, customer_phone, customer_address, customer_landmark, customer_status) VALUES ('$customer_name', '$customer_email', '$customer_password', '$customer_phone', '$customer_address', '$customer_landmark', '$customer_status')";

            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success'>Customer added successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>
        
    </div>
</div>

<?php
include('footer.php');
?>