<?php
include "db_connection.php";

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$query = "INSERT INTO tbl_contact (`contact_name`, `contact_email`, `contact_sub`, `contact_msg`) VALUES ('$name', '$email', '$subject', '$message')";
$result = mysqli_query($conn, $query);
if ($result) {
    echo "<script>alert('Contact saved successfully!');</script>";
    echo "<script>window.location.href='contact.php';</script>";
} else {
    echo "<script>alert('Error saving contact. Please try again.');</script>";
    echo "<script>window.location.href='contact.php';</script>";
}
?>