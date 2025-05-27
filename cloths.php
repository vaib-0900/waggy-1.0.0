<?php
include 'header.php';
?>
<section id="clothing" class="my-5 overflow-hidden">
  <div class="container pb-5">

    <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
      <h2 class="display-3 fw-normal">Pet Clothing</h2>
      <div>
        <a href="cloths.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
          shop now
          <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
            <use xlink:href="#arrow-right"></use>
          </svg></a>
      </div>
    </div>

    <div class="products-carousel swiper">
      <div class="swiper-wrapper">
 
        <?php
        include "db_connection.php";

  
        $query = "SELECT * FROM products WHERE product_id = 7";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc(); 

          echo '<div class="swiper-slide">';
          echo '<div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle text-right">New</div>';

          echo '<div class="card position-relative">';
          echo '<a href="single-product.php?id=' . $row['product_id'] . '">
          <img src="admin/' . $row['product_image'] . '" class="img-fluid rounded-4" alt="' . $row['product_name'] . '">
        </a>';

          echo '<div class="card-body p-0">';
          echo '<a href="single-product.php?id=' . $row['product_id'] . '">
          <h4 class="card-title pt-4 m-0">' . $row['product_name'] . '</h4>
        </a>';

          echo '<div class="card-text">';
          echo '<span class="rating secondary-font">';
          for ($i = 0; $i < 5; $i++) {
            echo '<iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>';
          }
          echo ' 5.0</span>';

          echo '<h3 class="secondary-font text-primary"> Rs.' . $row['product_price'] . '</h3>';

          echo '<div class="d-flex flex-wrap mt-3">';
          echo '<a href="addtocart.php?id=' . $row['product_id'] . '" class="btn-cart me-3 px-4 pt-3 pb-3">
          <h5 class="text-uppercase m-0">Add to Cart</h5>
        </a>';
          echo '<a href=""wishlist.php class="btn-wishlist px-4 pt-3 ">
          <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
        </a>';
          echo '</div>'; 

          echo '</div>'; 
          echo '</div>'; 
          echo '</div>'; 
          echo '</div>'; 
        } else {
          echo '<p class="text-center">Product with ID 7 not found.</p>';
        }

        $conn->close();
        ?>

        <?php
        include "db_connection.php";

        // Fetch product with ID 8
        $query = "SELECT * FROM products WHERE product_id = 8";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc(); 

          echo '<div class="swiper-slide">';

          echo '<div class="card position-relative">';
          echo '<a href="single-product.php?id=' . $row['product_id'] . '">
          <img src="admin/' . $row['product_image'] . '" class="img-fluid rounded-4" alt="' . $row['product_name'] . '">
        </a>';

          echo '<div class="card-body p-0">';
          echo '<a href="single-product.php?id=' . $row['product_id'] . '">
          <h3 class="card-title pt-4 m-0">' . $row['product_name'] . '</h3>
        </a>';

          echo '<div class="card-text">';
          echo '<span class="rating secondary-font">';
          for ($i = 0; $i < 5; $i++) {
            echo '<iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>';
          }
          echo ' 5.0</span>';

          echo '<h3 class="secondary-font text-primary"> Rs.' . $row['product_price'] . '</h3>';

          echo '<div class="d-flex flex-wrap mt-3">';
          echo '<a href="addtocart.php?id=' . $row['product_id'] . '" class="btn-cart me-3 px-4 pt-3 pb-3">
          <h5 class="text-uppercase m-0">Add to Cart</h5>
        </a>';
          echo '<a href="wishlist.php" class="btn-wishlist px-4 pt-3 ">
          <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
        </a>';
          echo '</div>'; 

          echo '</div>'; 
          echo '</div>'; 
          echo '</div>'; 
          echo '</div>';
        } else {
          echo '<p class="text-center">Product with ID 8 not found.</p>';
        }

        $conn->close();
        ?>
        <?php
        include "db_connection.php";

        // Fetch product with ID 9
        $query = "SELECT * FROM products WHERE product_id = 9";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();

          echo '<div class="swiper-slide">';
          echo '<div class="z-1 position-absolute rounded-3 border border-dark-subtle m-3 px-3 bg-white">-10%</div>';

          echo '<div class="card position-relative">';
          echo '<a href="single-product.php?id=' . $row['product_id'] . '">
          <img src="admin/' . $row['product_image'] . '" class="img-fluid rounded-4" alt="' . $row['product_name'] . '">
        </a>';

          echo '<div class="card-body p-0">';
          echo '<a href="single-product.php?id=' . $row['product_id'] . '">
          <h3 class="card-title pt-4 m-0">' . $row['product_name'] . '</h3>
        </a>';

          echo '<div class="card-text">';
          echo '<span class="rating secondary-font">';
          for ($i = 0; $i < 5; $i++) {
            echo '<iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>';
          }
          echo ' 5.0</span>';

          echo '<h3 class="secondary-font text-primary">Rs.' . $row['product_price'] . '</h3>';

          echo '<div class="d-flex flex-wrap mt-3">';
          echo '<a href="addtocart.php?id=' . $row['product_id'] . '" class="btn-cart me-3 px-4 pt-3 pb-3">
          <h5 class="text-uppercase m-0">Add to Cart</h5>
        </a>';
          echo '<a href="wishlist.php" class="btn-wishlist px-4 pt-3 ">
          <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
        </a>';
          echo '</div>'; 

          echo '</div>'; 
          echo '</div>'; 
          echo '</div>';
          echo '</div>'; 
        } else {
          echo '<p class="text-center">Product with ID 9 not found.</p>';
        }

        $conn->close();
        ?>

        <?php
        include "db_connection.php";

    
        $query = "SELECT * FROM products WHERE product_id = 10";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();

          echo '<div class="swiper-slide">';
          echo '<div class="card position-relative">';

          echo '<a href="single-product.php?id=' . $row['product_id'] . '">
          <img src="admin/' . $row['product_image'] . '" class="img-fluid rounded-4" alt="' . $row['product_name'] . '">
        </a>';

          echo '<div class="card-body p-0">';
          echo '<a href="single-product.php?id=' . $row['product_id'] . '">
          <h4 class="card-title pt-4 m-0">' . $row['product_name'] . '</h4>
        </a>';

          echo '<div class="card-text">';
          echo '<span class="rating secondary-font">';
          for ($i = 0; $i < 5; $i++) {
            echo '<iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>';
          }
          echo ' 5.0</span>';

          echo '<h3 class="secondary-font text-primary">Rs.' . $row['product_price'] . '</h3>';

          echo '<div class="d-flex flex-wrap mt-3">';
          echo '<a href="addtocart.php?id=' . $row['product_id'] . '" class="btn-cart me-3 px-4 pt-3 pb-3">
          <h5 class="text-uppercase m-0">Add to Cart</h5>
        </a>';
          echo '<a href="wishlist.php" class="btn-wishlist px-4 pt-3 ">
          <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
        </a>';
          echo '</div>'; 

          echo '</div>'; 
          echo '</div>'; 
          echo '</div>';
          echo '</div>'; 
        } else {
          echo '<p class="text-center">Product with ID 10 not found.</p>';
        }

        $conn->close();
        ?>

        <!-- dog cloths -->
      </div>
    </div>
    <!-- / products-carousel -->

  </div>
</section>
     <?php include 'footer.php'; ?>