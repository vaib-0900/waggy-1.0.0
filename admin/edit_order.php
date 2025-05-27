<?php
include('header.php');
include('sidebar.php');
include('db_connection.php');
?>

<?php
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $query = "SELECT * FROM orders WHERE order_id = $order_id";
    $result = mysqli_query($conn, $query);
    $order = mysqli_fetch_assoc($result);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_status = $_POST['order_status']; 
    $order_date = $_POST['order_date'];

    $query = "UPDATE orders SET  status='$order_status', order_date='$order_date' WHERE order_id=$order_id";

    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Order updated successfully!</div>";
        header("Location: order_list.php"); // Redirect to order list after update
        exit();
    } else {
        echo "Error updating order: " . mysqli_error($conn);
    }
}
?>
<div id="page-wrapper">
<div id="page-inner">
    <h1>Edit Order</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="customer_id">Customer ID:</label>
            <input type="text" name="customer_id" class="form-control" value="<?php echo $order['customer_id']; ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Order Status:</label>
            <select name="order_status" class="form-control" required>
                <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="Completed" <?php if ($order['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                <option value="Shipped" <?php if ($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                <option value="Delivered" <?php if ($order['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option> 
                <option value="Cancelled" <?php if ($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
            </select>
        </div>
        <div class="form-group">
            <label for="total_amount">Order Total:</label>
            <input type="text" readonly name="total_amount" class="form-control" value="<?php echo $order['total_amount']; ?>" required>
        </div>
        <div class="form-group">
            <label for="order_date">Order Date:</label>
            <input type="date" name="order_date" class="form-control" value="<?php echo $order['order_date']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Order</button>
    </form>
</div>
</div>

<?php
include("footer.php");
?></div>