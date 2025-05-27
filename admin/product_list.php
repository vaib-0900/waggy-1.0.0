<?php
include('header.php');
include('sidebar.php');
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Product List</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12  text-center">
                <a href="add_product.php" class="btn btn-primary">Add New Product</a>
            </div>
        </div>
        <br>
        
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>product price</th>
                            <th>Discoount per(%)</th>
                            <th>Discount value</th>
                            <th>Sell price</th>
                            <th>Product Description</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('db_connection.php');
                        $query = "SELECT * FROM products";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['product_id'] . "</td>";
                            echo "<td>" . $row['product_name'] . "</td>";
                            echo "<td><img src='" . $row['product_image'] . "' alt='upload/product/" . $row['product_image'] . "' style='width: 100px; height: auto;'></td>";
                            echo "<td>" . $row['product_price'] . "</td>";
                            echo "<td>" . $row['discount_per'] . "</td>";
                            echo "<td>" . $row['discount_value'] . "</td>";
                            echo "<td>" . $row['sell_price'] . "</td>";
                            echo "<td>" . $row['product_description'] . "</td>";
                            echo "<td>";
                            $category_query = "SELECT category_name FROM tbl_category WHERE category_id = " . $row['add_category'];
                            echo "</td>";
                            echo "<td>
                                    <a href='edit_product.php?id=" . $row['product_id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                                    <a href='delete_product.php?id=" . $row['product_id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
<?php
include('footer.php');
?>