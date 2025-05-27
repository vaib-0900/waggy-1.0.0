<?php
include('header.php');
include('sidebar.php');
include('db_connection.php');

if (isset($_GET['id'])) {
    $contact_id = $_GET['id'];
    $query = "SELECT * FROM tbl_contact WHERE contact_id = $contact_id";
    $result = mysqli_query($conn, $query);
    $category = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_sub = $_POST['contact_sub'];
    $contact_msg = $_POST['contact_msg'];

    $query = "UPDATE tbl_contact SET contact_name='$contact_name', contact_email='$contact_email', contact_sub='$contact_sub', contact_msg='$contact_msg' WHERE contact_id=$contact_id";

    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Contact updated successfully!</div>";
        header("Location: contact_list.php"); // Redirect to contact list after update
        exit();
    } else {
        echo "Error updating contact: " . mysqli_error($conn);
    }
}


?>

<div id="page-wrapper">
<div id="page-inner">
    <h1>Edit contact </h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="contact_name">contact Name:</label>
            <input type="text" name="contact_name" class="form-control" value="<?php echo htmlspecialchars($category['contact_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="contact_email">contact_email:</label>
            <input type="email" name="contact_email" class="form-control" value="<?php echo htmlspecialchars($category['contact_email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="contact_sub">contact_sub:</label>
            <input type="text" name="contact_sub" class="form-control" value="<?php echo htmlspecialchars($category['contact_sub']); ?>" required>
        </div>
        <div class="form-group">
            <label for="contact_msg">contact_msg:</label>
            <textarea name="contact_msg" class="form-control" required><?php echo htmlspecialchars($category['contact_msg']); ?></textarea>
        </div>
       
        
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
</div>

<?php
include 'footer.php';
?></div>