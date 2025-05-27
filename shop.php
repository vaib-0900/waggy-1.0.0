<?php
include 'header.php';
?>
<section id="banner-2" class="my-3" style="background: #F9F3EC;">
  <div class="container">
    <div class="row flex-row-reverse banner-content align-items-center">
      <div class="img-wrapper col-12 col-md-6">
        <img src="images/banner-img2.png" class="img-fluid">
      </div>
      <div class="content-wrapper col-12 offset-md-1 col-md-5 p-5">
        <div class="secondary-font text-primary text-uppercase mb-3 fs-4">Upto 40% off</div>
        <h2 class="banner-title display-1 fw-normal">Clearance sale !!!
        </h2>
        <a href="shop.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
          shop now
          <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
            <use xlink:href="#arrow-right"></use>
          </svg></a>
      </div>

    </div>
  </div>
</section>


<!-- <section id="categories" class="py-5">
  <div class="container">
    <h3 class="text-center mb-4">Categories</h3> 
    <div class="row">
      <div class="col-md-3">
        <a href="#" class="categories-item d-block p-3 border rounded shadow-sm">
          <iconify-icon class="category-icon mb-2" icon="ph:cat" style="font-size: 2rem;"></iconify-icon>
          <h5>Cat Shop</h5>
        </a>
      </div>
      <div class="col-md-3">
        <a href="#" class="categories-item d-block p-3 border rounded shadow-sm">
          <iconify-icon class="category-icon mb-2" icon="ph:bird" style="font-size: 2rem;"></iconify-icon>
          <h5>Bird Shop</h5>
        </a>
      </div>
      <div class="col-md-3">
        <a href="#" class="categories-item d-block p-3 border rounded shadow-sm">
          <iconify-icon class="category-icon mb-2" icon="ph:dog" style="font-size: 2rem;"></iconify-icon>
          <h5>Dog Shop</h5>
        </a>
      </div>
      <div class="col-md-3">
        <a href="#" class="categories-item d-block p-3 border rounded shadow-sm">
          <iconify-icon class="category-icon mb-2" icon="ph:fish" style="font-size: 2rem;"></iconify-icon>
          <h5>Fish Shop</h5>
        </a>
      </div>
    </div>
  </div>
</section> -->


<section class="mt-5 mb-5" id="categories">
  <?php
  include "db_connection.php";

  // Fetch all categories from the database
  $query = "SELECT * FROM tbl_category";
  $result = $conn->query($query);
  ?>

  <?php if ($result->num_rows > 0): ?>
    <div class="container">
      <h3 class="text-center mb-4">Categories</h3>
      <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
          <?php
          $category_id = $row['category_id'];
          $category_name = htmlspecialchars($row['category_name']);
          $category_image = htmlspecialchars($row['category_image']);
          
          $link = 'food.php';
          if ($category_id == 31) {
            $link = 'cloths.php';
          }
          if ($category_id == 32) {
            $link = 'food.php';
          }

          ?>
          <div class="col-md-3 mb-4">
            <a href="<?= $link ?>?id=<?= $category_id ?>" class="categories-item d-block text-center p-3 border rounded shadow-sm h-100 text-decoration-none">
              <img src="admin/<?= $category_image ?>" alt="<?= $category_name ?>" class="img-fluid mb-2" style="height: 80px;">
              <h5 class="mb-0"><?= $category_name ?></h5>
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  <?php else: ?>
    <p class="text-center">No categories found.</p>
  <?php endif; ?>

  <?php $conn->close(); ?>
</section>


<section id="bestselling" class="my-5 overflow-hidden">
  <div class="container py-5 mb-5">

    <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
      <h2 class="display-3 fw-normal">Best selling products</h2>
      <div>
        <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
          shop now
          <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
            <use xlink:href="#arrow-right"></use>
          </svg></a>
      </div>
    </div>

    <section class="mt-5 mb-5" id="products">
      <div class="container">
        <h3 class="text-center mb-4">Products</h3>
        <div class="row">

          <?php
          include "db_connection.php";
          $query = "SELECT * FROM products";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
          ?>
              <div class="col-md-3 mb-4">
                <div class="card h-100 border rounded-3 shadow-sm p-2 text-center">
                  <a href="shop.php?id=<?= $row['product_id'] ?>">
                    <img src="admin/<?= $row['product_image'] ?>" alt="<?= $row['product_name'] ?>" class="img-fluid rounded-3 mb-2" style="height: 200px; object-fit: cover;">
                  </a>
                  <div class="card-body p-2">
                    <a href="single-product.php?id=<?= $row['product_id'] ?>">
                      <h5 class="card-title text-truncate"><?= $row['product_name'] ?></h5>
                    </a>
                    <p class="card-text small text-muted"><?= $row['product_description'] ?></p>
                    <span class="rating d-block mb-2">
                      <?php for ($i = 0; $i < 5; $i++) { ?>
                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                      <?php } ?>
                      <small class="text-muted">5.0</small>
                    </span>
                    <h5 class="text-primary">Rs. <?= $row['product_price'] ?></h5>
                    <div class="d-flex justify-content-center mt-3">
                      <a href="addtocart.php?id=<?= $row['product_id']?> " class="btn btn-sm btn-outline-primary me-2">Add to Cart</a>
                      <a href="wishlist.php" class="btn btn-sm btn-outline-danger">
                        <iconify-icon icon="fluent:heart-28-filled"></iconify-icon>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
          <?php
            }
          } else {
            echo '<p class="text-center">No products found.</p>';
          }
          $conn->close();
          ?>
        </div>
      </div>
    </section>




  </div>
  </div>
  <!-- / category-carousel -->


  </div>
</section>
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
        <!-- dog cloths -->
        <?php
        include "db_connection.php";

        $query = "SELECT * FROM products WHERE product_id = 7";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
        ?>
          <div class="swiper-slide">
            <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle text-right">New</div>

            <div class="card position-relative">
              <a href="single-product.php?id=<?php echo $row['product_id']; ?>">
                <img src="admin/<?php echo $row['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
              </a>

              <div class="card-body p-0">
                <a href="single-product.php?id=<?php echo $row['product_id']; ?>">
                  <h4 class="card-title pt-4 m-0"><?php echo htmlspecialchars($row['product_name']); ?></h4>
                </a>

                <div class="card-text">
                  <span class="rating secondary-font">
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <?php } ?>
                    5.0
                  </span>

                  <h3 class="secondary-font text-primary">Rs.<?php echo $row['product_price']; ?></h3>

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
          echo '<p class="text-center">Product with ID 7 not found.</p>';
        }
        $conn->close();
        ?>

        <?php
        include "db_connection.php";

        $query = "SELECT * FROM products WHERE product_id = 8";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
        ?>
          <div class="swiper-slide">
            <div class="card position-relative">

              <a href="single-product.php?id=<?php echo $row['product_id']; ?>">
                <img src="admin/<?php echo $row['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
              </a>

              <div class="card-body p-0">
                <a href="single-product.php?id=<?php echo $row['product_id']; ?>">
                  <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($row['product_name']); ?></h3>
                </a>

                <div class="card-text">
                  <span class="rating secondary-font">
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <?php } ?>
                    5.0
                  </span>

                  <h3 class="secondary-font text-primary">Rs.<?php echo $row['product_price']; ?></h3>

                  <div class="d-flex flex-wrap mt-3">

                    <form action="addtocart.php" method="POST" class="me-3">
                      <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                      <input type="hidden" name="cart_qty" value="1">
                      <button type="submit" class="btn-cart px-4 pt-3 pb-3">
                        <h5 class="text-uppercase m-0">Add to Cart</h5>
                      </button>
                    </form>

                    <a href="wishlist.php" class="btn-wishlist px-4 pt-3">
                      <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        } else {
          echo '<p class="text-center">Product with ID 8 not found.</p>';
        }

        $conn->close();
        ?>

        <?php
        include "db_connection.php";

        $query = "SELECT * FROM products WHERE product_id = 9";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
        ?>
          <div class="swiper-slide">
            <!-- Discount badge -->
            <div class="z-1 position-absolute rounded-3 border border-dark-subtle m-3 px-3 bg-white">-10%</div>

            <div class="card position-relative">
              <a href="single-product.php?id=<?php echo $row['product_id']; ?>">
                <img src="admin/<?php echo $row['product_image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
              </a>

              <div class="card-body p-0">
                <a href="single-product.php?id=<?php echo $row['product_id']; ?>">
                  <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($row['product_name']); ?></h3>
                </a>

                <div class="card-text">
                  <span class="rating secondary-font">
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <?php } ?>
                    5.0
                  </span>

                  <h3 class="secondary-font text-primary">Rs.<?php echo $row['product_price']; ?></h3>

                  <div class="d-flex flex-wrap mt-3">
                    <!-- Use POST for Add to Cart -->
                    <form action="addtocart.php" method="POST" class="me-3">
                      <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                      <input type="hidden" name="cart_qty" value="1">
                      <button type="submit" class="btn-cart px-4 pt-3 pb-3">
                        <h5 class="text-uppercase m-0">Add to Cart</h5>
                      </button>
                    </form>

                    <a href="wishlist.php" class="btn-wishlist px-4 pt-3">
                      <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
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
        ?>
          <div class="swiper-slide">
            <div class="card position-relative">
              <!-- Product Image -->
              <a href="single-product.php?id=<?php echo $row['product_id']; ?>">
                <img src="admin/<?php echo htmlspecialchars($row['product_image']); ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
              </a>

              <div class="card-body p-0">
                <!-- Product Title -->
                <a href="single-product.php?id=<?php echo $row['product_id']; ?>">
                  <h4 class="card-title pt-4 m-0"><?php echo htmlspecialchars($row['product_name']); ?></h4>
                </a>

                <div class="card-text">
                  <!-- Rating -->
                  <span class="rating secondary-font">
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <?php } ?>
                    5.0
                  </span>

                  <!-- Price -->
                  <h3 class="secondary-font text-primary">Rs.<?php echo $row['product_price']; ?></h3>

                  <!-- Add to Cart and Wishlist -->
                  <div class="d-flex flex-wrap mt-3">
                    <form action="addtocart.php" method="POST" class="me-3">
                      <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                      <input type="hidden" name="cart_qty" value="1">
                      <button type="submit" class="btn-cart px-4 pt-3 pb-3">
                        <h5 class="text-uppercase m-0">Add to Cart</h5>
                      </button>
                    </form>

                    <a href="wishlist.php" class="btn-wishlist px-4 pt-3">
                      <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        } else {
          echo '<p class="text-center">Product with ID 10 not found.</p>';
        }

        $conn->close();
        ?>
      </div>
      <!-- dog cloths -->
    </div>
  </div>
  <!-- / products-carousel -->

  </div>
</section>

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
      $query = "SELECT * FROM products 
WHERE category_id = (SELECT category_id FROM tbl_category WHERE category_name = 'foodies')";
      ?>
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
                  <a href="wishlist.php" class="btn-wishlist px-4 pt-3">
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
                  <a href="wishlist.php" class="btn-wishlist px-4 pt-3">
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
                  <a href="wishlist.php" class="btn-wishlist px-4 pt-3">
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
                  <a href="wishlist.php" class="btn-wishlist px-4 pt-3">
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
      ?>


      <?php
      include "db_connection.php";

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
                  <a href="wishlist.php" class="btn-wishlist px-4 pt-3">
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
      include "db_connection.php";

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
                  <a href="wishlist.php" class="btn-wishlist px-4 pt-3">
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
                  <a href="wishlist.php" class="btn-wishlist px-4 pt-3">
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

 


<?php include 'footer.php'; ?>