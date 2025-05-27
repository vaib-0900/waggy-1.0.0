<?php
include('header.php');
include('sidebar.php');
include('db_connection.php');
?>
<div id="page-wrapper">
    <div class="container-fluid mt-5">
        <div class="card shadow">
            <div class="card-header mt-3">
                <h4 class="text-center" style="font-size: 35px; margin-top:20px; margin-bottom: 30px;">Order List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer ID</th>
                                <th>Total Amount</th>
                                <th>Customer</th>
                                <th>Customer Phone</th>
                                <th>Customer Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip Code</th>
                                <th>Payment Method</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM orders";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) :
                            ?>
                                <tr>
                                    <td><?= $row['order_id']; ?></td>
                                    <td><?= $row['customer_id']; ?></td>
                                    <td><?= $row['total_amount']; ?></td>
                                    <td>
                                        <div class="font-weight-bold"><?= $row['name']; ?></div>
                                        <small class=""><?= $row['email']; ?></small>
                                    </td>
                                    <td><?= $row['phone']; ?></td>
                                    <td><?= $row['address']; ?></td>
                                    <td><?= $row['city']; ?></td>
                                    <td><?= $row['state']; ?></td>
                                    <td><?= $row['zip_code']; ?></td>
                                    <td><?= $row['payment_method']; ?></td>
                                    <td><?= date('M j, Y', strtotime($row['order_date'])); ?></td>
                                    <td>
                                        <span class="text-daek"><?= $row['status']; ?></span>
                                    </td>
                                    <td>
                                        <a href="view_order.php?id=<?= $row['order_id']; ?>" class="btn btn-success btn-sm mb-1">View</a>
                                        <a href="edit_order.php?id=<?= $row['order_id']; ?>" class="btn btn-primary btn-sm mb-1">Edit</a>
                                        <a href="delete_order.php?id=<?= $row['order_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>