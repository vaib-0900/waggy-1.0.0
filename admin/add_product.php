<?php
include 'header.php';
include 'sidebar.php';
include 'db_connection.php';
?>
<!-- product save code -->
<?php
if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $discount_per = $_POST['discount_per'];
    $discount_value = $_POST['discount_value'];
    $sell_price = $_POST['sell_price'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category_id'];


    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $file_tmp = $_FILES['product_image']['tmp_name'];
        $file_name = $_FILES['product_image']['name'];
        move_uploaded_file($file_tmp, "upload/$file_name");
        $product_img = "upload/$file_name";
    } else {
        echo "Error uploading file.";
        exit;
    }

    $query = "INSERT INTO products (`product_name`, `product_image`, `product_price`, `discount_per`, `discount_value`, `sell_price`,`product_description`,`category_id`) VALUES ('$product_name', '$product_img', '$product_price', '$discount_per', '$discount_value', '$sell_price', '$product_description','$category_id')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding product: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!--product save code end -->

<div id="page-wrapper">
<div id="page-inner">
    <h1 class="page-header">Add Product</h1>
    <a href="product_list.php" class="btn btn-primary">View Product List</a>
    <br><br>
    <form action="add_product.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" required>
        </div>
        <div class="mb-3">
            <label for="product_image" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="product_image" name="product_image" required>
        </div>
    <div class="mb-3">
        <label for="product_price" class="form-label">Product Price</label>
        <input type="number" class="form-control" id="product_price" name="product_price" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="discount_per" class="form-label">Discount Percentage</label>
        <input type="number" class="form-control" id="discount_per" name="discount_per" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="discount_value" class="form-label">Discount Value</label>
        <input type="number" class="form-control" id="discount_value" name="discount_value" step="0.01" readonly>
    </div>
    <div class="mb-3">
        <label for="sell_price" class="form-label">Sell Price</label>
        <input type="number" class="form-control" id="sell_price" name="sell_price" step="0.01" readonly>
    </div>
    <script>
        document.getElementById('discount_per').addEventListener('input', function () {
            const productPrice = parseFloat(document.getElementById('product_price').value) || 0;
            const discountPercentage = parseFloat(this.value) || 0;
            const discountValue = (productPrice * discountPercentage) / 100;
            document.getElementById('discount_value').value = discountValue.toFixed(2);
            document.getElementById('sell_price').value = (productPrice - discountValue).toFixed(2);
        });

        document.getElementById('product_price').addEventListener('input', function () {
            const productPrice = parseFloat(this.value) || 0;
            const discountPercentage = parseFloat(document.getElementById('discount_per').value) || 0;
            const discountValue = (productPrice * discountPercentage) / 100;
            document.getElementById('discount_value').value = discountValue.toFixed(2);
            document.getElementById('sell_price').value = (productPrice - discountValue).toFixed(2);
        });
    </script>
        <div class="mb-3">
            <label for="product_description" class="form-label">Product Description</label>
            <textarea class="form-control" id="product_description" name="product_description"></textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <?php
                $query = "SELECT * FROM tbl_category";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <option value="<?php echo $row['category_id'];?>">
                    <?php echo $row['category_name'];?>
                </option>
                <?php
                }
                ?>

            </select>
        </div>
   
        <button type="submit" name='submit' value='submit' href="product_list.php" class='btn btn-primary mt-5'>Add Product</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>


<?php
include "footer.php";
?>
