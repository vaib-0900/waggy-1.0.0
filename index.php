<?php
include('header.php');
?>

<section id="banner" style="background: #F9F3EC;">
    <div class="container">
      <div class="swiper main-swiper">
        <div class="swiper-wrapper">

          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="images/banner-img.png" class="img-fluid">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                <h2 class="banner-title display-1 fw-normal">Best destination for <span class="text-primary">your
                    pets</span>
                </h2>
                <a href="shop.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  shop now
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>

            </div>
          </div>
          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="images//banner-img3.png" class="img-fluid">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                <h2 class="banner-title display-1 fw-normal">Best destination for <span class="text-primary">your
                    pets</span>
                </h2>
                <a href="shop.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  shop now
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>

            </div>
          </div>
          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="images/banner-img4.png" class="img-fluid">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                <h2 class="banner-title display-1 fw-normal">Best destination for <span class="text-primary">your
                    pets</span>
                </h2>
                <a href="shop.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  shop now
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>

            </div>
          </div>
        </div>

        <div class="swiper-pagination mb-5"></div>

      </div>
    </div>
  </section>

  <section class="mt-5 mb-5" id="categories">
<?php
include "db_connection.php";
$category_id = 11; 
$query = "SELECT * FROM tbl_category WHERE category_id = $category_id";
$result = $conn->query($query);
?>

<?php if ($result->num_rows > 0): ?>
  <div class="container">
    <h3 class="text-center mb-4">Category</h3>
    <div class="row">
      <?php while ($row = $result->fetch_assoc()): ?>
        <?php
          $category_name = htmlspecialchars($row['category_name']);
          $category_image = htmlspecialchars($row['category_image']);
        ?>
        <div class="col-md-3 mb-4">
          <a href="food.php?id=<?= $category_id ?>" class="categories-item d-block text-center p-3 border rounded shadow-sm h-100 text-decoration-none">
            <img src="admin/<?= $category_image ?>" alt="<?= $category_name ?>" class="img-fluid mb-2" style="height: 80px;">
            <h5 class="mb-0"><?= $category_name ?></h5>
          </a>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
<?php else: ?>
  <p class="text-center">No category found with ID 11.</p>
<?php endif; ?>

<?php $conn->close(); ?>
<!-- / category-2 -->
<?php
include "db_connection.php";
$category_id = 31; 
$query = "SELECT * FROM tbl_category WHERE category_id = $category_id";
$result = $conn->query($query);
?>

<?php if ($result->num_rows > 0): ?>
  <div class="container">
    
      <?php while ($row = $result->fetch_assoc()): ?>
        <?php
          $category_name = htmlspecialchars($row['category_name']);
          $category_image = htmlspecialchars($row['category_image']);
        ?>
        <div class="col-md-3 mb-4">
          <a href="cloths.php?id=<?= $category_id ?>" class="categories-item d-block text-center p-3 border rounded shadow-sm h-100 text-decoration-none">
            <img src="admin/<?= $category_image ?>" alt="<?= $category_name ?>" class="img-fluid mb-2" style="height: 80px;">
            <h5 class="mb-0"><?= $category_name ?></h5>
          </a>
        </div>
      <?php endwhile; ?> 
   
  </div>
<?php else: ?>
  <p class="text-center">No category found with ID 11.</p>
<?php endif; ?>

<?php $conn->close(); ?>

</section>

  <section id="service">
    <div class="container py-5 my-5">
      <div class="row g-md-5 pt-4">
        <div class="col-md-3 my-3">
          <div class="card">
        <div>
          <iconify-icon class="service-icon text-primary" icon="la:shopping-cart"></iconify-icon>
        </div>
        <h3 class="card-title py-2 m-0">Fast Delivery</h3>
        <div class="card-text">
          <p class="blog-paragraph fs-6">Get your products delivered quickly and on time.</p>
        </div>
          </div>
        </div>
        <div class="col-md-3 my-3">
          <div class="card">
        <div>
          <iconify-icon class="service-icon text-primary" icon="la:user-check"></iconify-icon>
        </div>
        <h3 class="card-title py-2 m-0">Secure Payment</h3>
        <div class="card-text">
          <p class="blog-paragraph fs-6">Your transactions are safe and encrypted.</p>
        </div>
          </div>
        </div>
        <div class="col-md-3 my-3">
          <div class="card">
        <div>
          <iconify-icon class="service-icon text-primary" icon="la:tag"></iconify-icon>
        </div>
        <h3 class="card-title py-2 m-0">Exclusive Offers</h3>
        <div class="card-text">
          <p class="blog-paragraph fs-6">Enjoy amazing deals and discounts every day.</p>
        </div>
          </div>
        </div>
        <div class="col-md-3 my-3">
          <div class="card">
        <div>
          <iconify-icon class="service-icon text-primary" icon="la:award"></iconify-icon>
        </div>
        <h3 class="card-title py-2 m-0">Premium Quality</h3>
        <div class="card-text">
          <p class="blog-paragraph fs-6">We ensure the best quality for all our products.</p>
        </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <section id="insta" class="my-5">
    <div class="row g-0 py-5">
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta1.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta2.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta3.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta4.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta5.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
      <div class="col instagram-item  text-center position-relative">
        <div class="icon-overlay d-flex justify-content-center position-absolute">
          <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
        </div>
        <a href="#">
          <img src="images/insta6.jpg" alt="insta-img" class="img-fluid rounded-3">
        </a>
      </div>
    </div>
  </section>

 <?php include 'footer.php'; ?>