<?php


include 'header.php';
include 'db_connection.php';
?>

<div class="container mt-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <b>Wish List</b>
            </div>

            <div class="row px-3 font-weight-bold border-bottom py-2">
                <div class="col-4">Product</div>
                <div class="col-4">Name</div>
                <div class="col-2">Price</div>
                <div class="col-2">Action</div>
            </div>
            <hr>
            <div class="card-body">
                <?php
                $customer_id = $_SESSION['customer_id'];
                $query = "SELECT tbl_wishlist.wishlist_id, tbl_wishlist.wishlist_product_id, tbl_wishlist.added_date, 
                          products.product_id AS product_id, products.product_name, products.sell_price, products.product_image 
                          FROM tbl_wishlist  
                          INNER JOIN products  ON tbl_wishlist.wishlist_product_id = products.product_id 
                          WHERE tbl_wishlist.wishlist_customer_id = '$customer_id'";

                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="card mb-2" style="color: black; background-color: aliceblue;">
                            <div class="row px-3 border-bottom py-3 align-items-center">
                                <div class="col-4">
                                    <input type="hidden" name="id" value="<?= $row['product_id']; ?>">
                                    <a href="singleproduct.php?id=<?= $row['product_id']; ?>" title="Product Title">
                                        <img src="admin/upload/<?= $row['image']; ?>" alt="Product Image" width="100"
                                            height="100" style="border: 1px solid black; border-radius: 10px;">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <?= $row['name']; ?><br>
                                    <small class="text-muted">Added on: <?= date('d M Y', strtotime($row['added_date'])); ?></small>
                                </div>
                                <div class="col-2">
                                    ₹<?= $row['CP']; ?>
                                </div>
                                <div class="col-2">
                                    <form method="POST" action="remove_wishlist.php">
                                        <input type="hidden" name="wishlist_id" value="<?= $row["wishlist_id"]; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='text-center text-muted mt-3'>Your wishlist is empty.</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>