<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION["id"])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $customer_id = $_SESSION['id'];
    
    // Check if the product is already in the wishlist
    $check_query = "SELECT * FROM tbl_wishlist WHERE wishlist_product_id = '$product_id' AND wishlist_customer_id = '$customer_id'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['error'] = "Product is already in your wishlist";
    } else {
        $insert_query = "INSERT INTO tbl_wishlist (wishlist_product_id, wishlist_customer_id) VALUES ('$product_id', '$customer_id')";
        $insert_result = mysqli_query($conn, $insert_query);
        
        if ($insert_result) {
            $_SESSION['message'] = "Product added to wishlist";
        } else {
            $_SESSION['error'] = "Failed to add product to wishlist";
        }
    }
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>