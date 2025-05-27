<?php
include 'header.php';
include 'sidebar.php';
?>
<div id="page-wrapper">
<div id="page-inner">
    <h1>contact list</h1>
    <a href="" class="btn btn-success">Add New  contact</a>
    <br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('db_connection.php');
            $query = "SELECT * FROM tbl_contact"; 
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['contact_id'] . "</td>";
                    echo "<td>" . $row['contact_name'] . "</td>";
                    echo "<td>" . $row['contact_email'] . "</td>";
                    echo "<td>" . $row['contact_sub'] . "</td>";
                    echo "<td>" . $row['contact_msg'] . "</td>";
                    echo "<td>
                            <a href='edit_contact.php?id=" . $row['contact_id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                            <a href='delete_contact.php?id=" . $row['contact_id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No categories found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</div>



























<?php
include 'footer.php';
?>