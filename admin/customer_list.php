<?php
include "header.php";
include "sidebar.php";
?>

<div id="page-wrapper">
<div id="page-inner">
    <h1>customer List</h1>
    <a href="customer_add.php" class="btn btn-primary">Add customer</a>
   
    <br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>customer Name</th>
                <th>customer_email</th>
                <th>customer_password </th>
                <th>customer_phone</th>
                <th>customer_address</th>
                <th>customer_landmark</th>
                <th>customer_status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php
        include "db_connection.php";
        $query = "SELECT * FROM tbl_customer"; 
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['customer_id'] . "</td>";
                echo "<td>" . $row['customer_name'] . "</td>";
                echo "<td>" . $row['customer_email'] . "</td>";
                echo "<td>" . $row['customer_password'] . "</td>";
                echo "<td>" . $row['customer_phone'] . "</td>";
                echo "<td>" . $row['customer_address'] . "</td>";
                echo "<td>" . $row['customer_landmark'] . "</td>";
                // Display customer status as Active/Inactive
                echo "<td>" . ($row['customer_status'] ? 'Active' : 'Inactive') . "</td>";
                echo "<td>
                        <a href='edit_customer.php?id=" . $row['customer_id'] . "' class='btn btn-primary'>Edit</a>
                        <a href='delete_customer.php?id=" . $row['customer_id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No customers found</td></tr>";
        }
        ?>
        <tbody>
           
        </tbody>
    </table>
</div>
</div>

<?php
include "footer.php";
?>