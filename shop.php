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
  </section>

<section id="bestselling" class="my-5 overflow-hidden">
  <div class="container py-5 mb-5">
    <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
      <h2 class="display-3 fw-normal">Best selling products</h2>
      <div>
        <button class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1" id="filter-toggle">
          Filters
          <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
            <use xlink:href="#arrow-right"></use>
          </svg>
        </button>
      </div>
    </div>

    <div class="row">
      <!-- Filter Sidebar -->
      <div class="col-md-3 mb-4" id="filter-sidebar">
        <div class="card border rounded-3 shadow-sm p-3">
          <h5 class="card-title mb-3">Filters</h5>

          <!-- Price Range Filter -->
          <!-- Replace the Price Range Filter section with this code -->
          <div class="mb-4">
            <h6 class="mb-3">Price Range</h6>
            <div class="list-group">
              <?php
              // Define price ranges
              $priceRanges = [
                ['min' => 100, 'max' => 500],
                ['min' => 500, 'max' => 1000],
                ['min' => 1000, 'max' => 3000],
                ['min' => 3000, 'max' => 5000],
                ['min' => 5000, 'max' => 10000],
                ['min' => 10000, 'max' => 15000]
              ];

              // Get product counts for each range
              include "db_connection.php";
              foreach ($priceRanges as $range) {
                $countQuery = "SELECT COUNT(*) as count FROM tbl_product 
                          WHERE product_price BETWEEN {$range['min']} AND {$range['max']}";
                $countResult = $conn->query($countQuery);
                $count = $countResult->fetch_assoc()['count'];

                echo "<a href='#' class='list-group-item list-group-item-action price-range-filter d-flex justify-content-between align-items-center' 
                  data-min='{$range['min']}' data-max='{$range['max']}'>
                  {$range['min']} to {$range['max']}
                  <span class='badge bg-primary rounded-pill'>{$count}</span>
                  </a>";
              }
              ?>
            </div>
          </div>

          <!-- Category Filter -->
          <!-- Update the Category Filter section with counts -->
          <div class="mb-4">
            <h6 class="mb-3">Categories</h6>
            <?php
            $cat_query = "SELECT c.*, COUNT(p.product_id) as product_count 
                 FROM tbl_category c
                 LEFT JOIN tbl_product p ON c.category_id = p.category_id
                 GROUP BY c.category_id";
            $cat_result = $conn->query($cat_query);

            if ($cat_result->num_rows > 0) {
              while ($cat_row = $cat_result->fetch_assoc()) {
                echo '<div class="form-check mb-2 d-flex justify-content-between align-items-center">
                <div>
                    <input class="form-check-input category-filter" type="checkbox" value="' . $cat_row['category_id'] . '" id="cat-' . $cat_row['category_id'] . '">
                    <label class="form-check-label" for="cat-' . $cat_row['category_id'] . '">
                        ' . htmlspecialchars($cat_row['category_name']) . '
                    </label>
                </div>
                <span class="badge bg-primary rounded-pill">' . $cat_row['product_count'] . '</span>
            </div>';
              }
            }
            ?>
          </div>

          <!-- Rating Filter -->
          <div class="mb-4">
            <h6 class="mb-3">Customer Rating</h6>
            <div class="form-check mb-2">
              <input class="form-check-input rating-filter" type="checkbox" value="4" id="rating-4">
              <label class="form-check-label" for="rating-4">
                <iconify-icon icon="clarity:star-solid" class="text-warning"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-warning"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-warning"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-warning"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-secondary"></iconify-icon>
                & above
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input rating-filter" type="checkbox" value="3" id="rating-3">
              <label class="form-check-label" for="rating-3">
                <iconify-icon icon="clarity:star-solid" class="text-warning"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-warning"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-warning"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-secondary"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-secondary"></iconify-icon>
                & above
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input rating-filter" type="checkbox" value="2" id="rating-2">
              <label class="form-check-label" for="rating-2">
                <iconify-icon icon="clarity:star-solid" class="text-warning"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-warning"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-secondary"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-secondary"></iconify-icon>
                <iconify-icon icon="clarity:star-solid" class="text-secondary"></iconify-icon>
                & above
              </label>
            </div>
          </div>

          <button class="btn btn-primary w-100" id="apply-filters">Apply Filters</button>
          <button class="btn btn-outline-secondary w-100 mt-2" id="reset-filters">Reset</button>
        </div>
      </div>

      <!-- Products Section -->
        <div class="col-md-9">
          <div class="row" id="products-container">
            <?php
            include "db_connection.php";
            $query = "SELECT * FROM tbl_product";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
            ?>
                <div class="col-md-4 mb-4 product-card"
                  data-price="<?= $row['product_price'] ?>"
                  data-category="<?= $row['category_id'] ?>"
                  data-rating="5">
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
                      <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="addtocart.php?id=<?= $row['product_id'] ?>" class="btn btn-outline-primary btn-sm d-flex align-items-center px-3 py-2 rounded-pill shadow-sm">
                          <iconify-icon icon="mdi:cart-plus" class="me-2"></iconify-icon>
                          <span>Add to Cart</span>
                        </a>
                        <a href="wishlist.php?id=<?= $row['product_id'] ?>" class="btn btn-outline-danger btn-sm d-flex align-items-center px-3 py-2 rounded-pill shadow-sm">
                          <iconify-icon icon="fluent:heart-28-filled" class="me-2"></iconify-icon>
                          <span>Wishlist</span>
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
    </div>
  </div>
</section>

<style>
  #filter-sidebar {
    transition: all 0.3s ease;
  }

  .price-range-filter.active {
    background-color: #0d6efd;
    color: white;
    border-color: #0d6efd;
  }

  .price-range-slider {
    position: relative;
    height: 40px;
  }

  .price-range-slider input[type="range"] {
    position: absolute;
    width: 100%;
  }

  .price-range-slider input[type="range"]:nth-child(1) {
    top: 0;
  }

  .price-range-slider input[type="range"]:nth-child(2) {
    top: 20px;
  }

  @media (max-width: 768px) {
    #filter-sidebar {
      position: fixed;
      top: 0;
      left: -100%;
      width: 80%;
      height: 100vh;
      z-index: 1050;
      background: white;
      overflow-y: auto;
      padding: 20px;
    }

    #filter-sidebar.show {
      left: 0;
    }

    .filter-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1040;
      display: none;
    }

    .filter-overlay.show {
      display: block;
    }
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile filter toggle
    const filterToggle = document.getElementById('filter-toggle');
    const filterSidebar = document.getElementById('filter-sidebar');
    const filterOverlay = document.createElement('div');
    filterOverlay.className = 'filter-overlay';
    document.body.appendChild(filterOverlay);
    
    filterToggle.addEventListener('click', function() {
        if (window.innerWidth <= 768) {
            filterSidebar.classList.toggle('show');
            filterOverlay.classList.toggle('show');
        }
    });
    
    filterOverlay.addEventListener('click', function() {
        filterSidebar.classList.remove('show');
        filterOverlay.classList.remove('show');
    });
    
    // Price range filter click handler
    document.querySelectorAll('.price-range-filter').forEach(filter => {
        filter.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all filters
            document.querySelectorAll('.price-range-filter').forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to clicked filter
            this.classList.add('active');
            
            // Filter products
            filterProducts();
        });
    });
    
    // Function to update counts after filtering
    function updateFilterCounts() {
        // Get current active filters
        const activePriceFilter = document.querySelector('.price-range-filter.active');
        let minPrice = 0;
        let maxPrice = 100000;
        
        if (activePriceFilter) {
            minPrice = parseInt(activePriceFilter.dataset.min);
            maxPrice = parseInt(activePriceFilter.dataset.max);
        }
        
        const selectedCategories = Array.from(document.querySelectorAll('.category-filter:checked')).map(el => el.value);
        const selectedRatings = Array.from(document.querySelectorAll('.rating-filter:checked')).map(el => parseInt(el.value));
        
        // Update price range counts
        document.querySelectorAll('.price-range-filter').forEach(filter => {
            const rangeMin = parseInt(filter.dataset.min);
            const rangeMax = parseInt(filter.dataset.max);
            
            // Count products in this range that match other filters
            let count = 0;
            document.querySelectorAll('.product-card').forEach(card => {
                const price = parseInt(card.dataset.price);
                const category = card.dataset.category;
                const rating = parseInt(card.dataset.rating);
                
                const priceInRange = price >= rangeMin && price <= rangeMax;
                const categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(category);
                const ratingMatch = selectedRatings.length === 0 || selectedRatings.some(r => rating >= r);
                
                if (priceInRange && categoryMatch && ratingMatch) {
                    count++;
                }
            });
            
            // Update the badge count
            const badge = filter.querySelector('.badge');
            if (badge) {
                badge.textContent = count;
            }
        });
        
        // Update category counts
        document.querySelectorAll('.category-filter').forEach(checkbox => {
            const categoryId = checkbox.value;
            const parentDiv = checkbox.closest('.form-check');
            const badge = parentDiv.querySelector('.badge');
            
            if (badge) {
                let count = 0;
                document.querySelectorAll('.product-card').forEach(card => {
                    const price = parseInt(card.dataset.price);
                    const category = card.dataset.category;
                    const rating = parseInt(card.dataset.rating);
                    
                    const priceMatch = price >= minPrice && price <= maxPrice;
                    const categoryMatch = category === categoryId;
                    const ratingMatch = selectedRatings.length === 0 || selectedRatings.some(r => rating >= r);
                    
                    if (priceMatch && categoryMatch && ratingMatch) {
                        count++;
                    }
                });
                
                badge.textContent = count;
            }
        });
    }
    
    // Filter products function
    function filterProducts() {
        // Get active price range
        const activePriceFilter = document.querySelector('.price-range-filter.active');
        let minPrice = 0;
        let maxPrice = 100000;
        
        if (activePriceFilter) {
            minPrice = parseInt(activePriceFilter.dataset.min);
            maxPrice = parseInt(activePriceFilter.dataset.max);
        }
        
        const selectedCategories = Array.from(document.querySelectorAll('.category-filter:checked')).map(el => el.value);
        const selectedRatings = Array.from(document.querySelectorAll('.rating-filter:checked')).map(el => parseInt(el.value));
        
        document.querySelectorAll('.product-card').forEach(card => {
            const price = parseInt(card.dataset.price);
            const category = card.dataset.category;
            const rating = parseInt(card.dataset.rating);
            
            const priceMatch = price >= minPrice && price <= maxPrice;
            const categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(category);
            const ratingMatch = selectedRatings.length === 0 || selectedRatings.some(r => rating >= r);
            
            if (priceMatch && categoryMatch && ratingMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
        
        // Update counts after filtering
        updateFilterCounts();
    }
    
    // Add event listeners to all filter elements
    document.querySelectorAll('.price-range-filter, .category-filter, .rating-filter').forEach(filter => {
        filter.addEventListener('change', filterProducts);
        filter.addEventListener('click', filterProducts);
    });
    
    // Apply filters button
    document.getElementById('apply-filters').addEventListener('click', function() {
        filterProducts();
        if (window.innerWidth <= 768) {
            filterSidebar.classList.remove('show');
            filterOverlay.classList.remove('show');
        }
    });
    
    // Reset filters
    document.getElementById('reset-filters').addEventListener('click', function() {
        document.querySelectorAll('.price-range-filter').forEach(item => {
            item.classList.remove('active');
        });
        
        document.querySelectorAll('.category-filter, .rating-filter').forEach(checkbox => {
            checkbox.checked = false;
        });
        
        // Reload the original counts
        location.reload();
    });
});
</script>

<?php include 'footer.php'; ?>