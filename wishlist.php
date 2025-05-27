<?php
include 'header.php';
include("db_connection.php");
?>
<!-- Breadcrumb Start -->

<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <h1 class="mb-4">My Wishlist</h1>
        </div>
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="table-info">
                    <tr>
                        <th>Product Img</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    $customer = $_SESSION["customer_id"];
                    $query = "SELECT * FROM tbl_wishlist INNER JOIN products ON products.product_id = tbl_wishlist.wishlist_product_id WHERE tbl_wishlist.wishlist_customer_id = $customer";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td> <img style="width: 100px; height: 100px;" src="admin/uplode/<?= $row["product_image"] ?>"
                                    alt=""></td>
                            <td class="align-middle">

                                <?= $row["product_name"] ?>
                            </td>

                            <td class="align-middle">
                                <?= $row["sell_price"] ?>
                            </td>
                            <td class="align-middle">
                                <?= $row["sell_price"] ?>
                            </td>
                            <td class="align-middle"><a href="wishlist-delete.php?id=<?= $row["id"] ?>"
                                    class="btn btn-outline-danger"
                                    onclick="if(confirm('Are You Sure ?')){}else{return false;}"><i
                                        class="nav-icon fas fa-trash"></i></a></td>

                        </tr>
                        <?php
                    } ?>
                </tbody>
            </table>
        </div>


    </div>
</div>

<!-- Breadcrumb End -->

<?php
include 'footer.php';
?>