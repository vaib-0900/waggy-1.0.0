<?php
include('header.php');
?>
<section id="foodies" class="my-5">
  <div class="container my-5 py-5">

    <div class="section-header d-md-flex justify-content-between align-items-center">
      <h2 class="display-3 fw-normal">Pet Foodies</h2>
      <div class="mb-4 mb-md-0">
        <p class="m-0">
          <button class="filter-button me-4  active" data-filter="*">ALL</button>
          <button class="filter-button me-4 " data-filter=".cat">CAT</button>
          <button class="filter-button me-4 " data-filter=".dog">DOG</button>
          <button class="filter-button me-4 " data-filter=".bird">BIRD</button>
        </p>
      </div>
      <div>
        <a href="food.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
          shop now
          <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
            <use xlink:href="#arrow-right"></use>
          </svg></a>
      </div>
    </div>

    <div class="isotope-container row">
      <!-- dog food -->

      <?php
      include "db_connection.php";
      $query = "SELECT * FROM products WHERE product_id = 11";
      
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>

        <div class="item dog col-md-4 col-lg-3 my-4">
          <div class="card position-relative">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">Rs.<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="wishlist.php" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      $conn->close();
      ?>


      <?php
      include "db_connection.php";
      $query = "SELECT * FROM products WHERE product_id = 12";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>

        <div class="item dog col-md-4 col-lg-3 my-4">
          <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
            New
          </div>
          <div class="card position-relative">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>
              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">Rs.<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      $conn->close();
      ?>

      <?php
      include "db_connection.php"; // update this with your DB connection file
      $query = "SELECT * FROM products WHERE product_id = 13";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>

        <div class="item dog col-md-4 col-lg-3 my-4">
          <div class="card position-relative">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>
              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">Rs.<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      $conn->close();
      ?>

      <?php
      include "db_connection.php"; // your DB connection file
      $query = "SELECT * FROM products WHERE product_id = 14";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>

        <div class="item dog col-md-4 col-lg-3 my-4">
          <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
            Sold
          </div>
          <div class="card position-relative">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">Rs.<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>

            </div>
          </div>
        </div>

      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      $conn->close();
      ?>

      <!-- dog food -->

      <!-- cat food -->
      <?php
      include "db_connection.php"; // Replace with your actual DB connection file
      $query = "SELECT * FROM products WHERE product_id = 15";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>

        <div class="item cat col-md-4 col-lg-3 my-4">
          <div class="card position-relative">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">Rs.<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      $conn->close();
      ?>

      <?php
      include "db_connection.php"; // Your DB connection file

      $query = "SELECT * FROM products WHERE product_id = 17";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>

        <div class="item cat col-md-4 col-lg-3 my-4">
          <div class="card position-relative">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">Rs.<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      $conn->close();
      ?>


      <?php
      include "db_connection.php"; // Replace with your actual DB connection
      $query = "SELECT * FROM products WHERE product_id = 16";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>

        <div class="item cat col-md-4 col-lg-3 my-4">
          <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
            Sale
          </div>
          <div class="card position-relative">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">Rs.<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      $conn->close();
      ?>

      <?php
      include "db_connection.php"; // connect to your DB

      $query = "SELECT * FROM products WHERE product_id = 18";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>

        <div class="item cat col-md-4 col-lg-3 my-4">
          <div class="card position-relative">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">Rs.<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      $conn->close();
      ?>

      <!-- cat food -->

      <!-- bird food -->
      <?php
      include "db_connection.php"; // connect to your DB

      $query = "SELECT * FROM products WHERE product_id = 19";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>
        <div class="item bird col-md-4 col-lg-3 my-4 mt-5">
          <div class="card position-relative mt-4">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">$<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3 ">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      ?>


      <?php
      include "db_connection.php"; // connect to your DB

      $query = "SELECT * FROM products WHERE product_id = 21";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>
        <div class="item bird col-md-4 col-lg-3 my-4 mt-4">
          <div class="card position-relative mt-3">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">$<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      ?>

      <?php
      include "db_connection.php"; // connect to your DB

      $query = "SELECT * FROM products WHERE product_id = 22";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>
        <div class="item bird col-md-4 col-lg-3 my-4 mt-4">
          <div class="card position-relative mt-3">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>

              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">$<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      ?>

      <?php
      include "db_connection.php"; // connect to your DB

      $query = "SELECT * FROM products WHERE product_id = 20";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
      ?>
        <div class="item bird col-md-4 col-lg-3 my-4 mt-4">
          <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
            Sale
          </div>
          <div class="card position-relative mt-5">
            <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
              <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </a>
            <div class="card-body p-0">
              <a href="single-product.php?id=<?php echo $product['product_id']; ?>">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($product['product_name']); ?></h3>
              </a>
              <div class="card-text">
                <span class="rating secondary-font">
                  <?php for ($i = 0; $i < 5; $i++) { ?>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                  <?php } ?>
                  5.0
                </span>

                <h3 class="secondary-font text-primary">$<?php echo $product['product_price']; ?></h3>

                <div class="d-flex flex-wrap mt-3">
                  <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <a href="#" class="btn-wishlist px-4 pt-3">
                    <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      } else {
        echo "<p>Product not found.</p>";
      }
      ?>

      <!-- bird food -->

    </div>


  </div>
</section>

<?php include('footer.php'); ?>