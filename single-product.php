<?php
include "header.php";
include "db_connection.php";

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    $query = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger text-center my-5'>Product not found.</div>";
        include "footer.php";
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<div class='alert alert-warning text-center my-5'>Invalid product.</div>";
    include "footer.php";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Pet Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .product-gallery img {
            cursor: pointer;
            transition: transform 0.3s;
        }
        .product-gallery img:hover {
            transform: scale(1.03);
        }
        .main-image {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .badge-tag {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1;
        }
        .quantity-input {
            width: 60px;
            text-align: center;
        }
        .product-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
        }
        .product-meta {
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        .related-products .card {
            transition: transform 0.3s;
        }
        .related-products .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>

<!-- Product Detail Section -->
<section class="py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['product_name']); ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Product Images -->
            <div class="col-lg-6">
                <div class="position-relative mb-4">
                    <span class="badge bg-danger badge-tag">Hot</span>
                    <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid main-image w-100" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                </div>
                <div class="row g-2 product-gallery">
                    <div class="col-3">
                        <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded border" alt="Thumbnail 1">
                    </div>
                    <div class="col-3">
                        <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded border" alt="Thumbnail 2">
                    </div>
                    <div class="col-3">
                        <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded border" alt="Thumbnail 3">
                    </div>
                    <div class="col-3">
                        <img src="admin/<?php echo $product['product_image']; ?>" class="img-fluid rounded border" alt="Thumbnail 4">
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="product-info h-100">
                    <h1 class="mb-3"><?php echo htmlspecialchars($product['product_name']); ?></h1>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-warning me-2">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="text-muted">(24 reviews)</span>
                    </div>
                    
                    <h3 class="text-primary mb-4">Rs. <?php echo number_format($product['product_price'], 2); ?></h3>
                    
                    <p class="mb-4"><?php echo nl2br(htmlspecialchars($product['product_description'])); ?></p>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3">
                            <label class="form-label">Quantity:</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" id="decrement">-</button>
                                <input type="text" class="form-control quantity-input" value="1" id="quantity">
                                <button class="btn btn-outline-secondary" type="button" id="increment">+</button>
                            </div>
                        </div>
                        <div class="availability">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span class="ms-1">In Stock</span>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="addtocart.php?id=<?php echo $product['product_id']; ?>" class="btn btn-primary px-4 py-2 flex-grow-1">
                            <i class="bi bi-cart-plus me-2"></i> Add to Cart
                        </a>
                        <a href="wishlist.php" class="btn btn-outline-danger px-4 py-2">
                            <i class="bi bi-heart me-2"></i> Wishlist
                        </a>
                    </div>
                    
                    <div class="product-meta">
                        <p class="mb-2"><strong>SKU:</strong> PET<?php echo $product['product_id']; ?></p>
                        <p class="mb-2"><strong>Category:</strong> 
                            <a href="#" class="text-decoration-none">Pet Food</a>
                        </p>
                        <p class="mb-0"><strong>Share:</strong> 
                            <a href="#" class="text-decoration-none me-2"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-decoration-none me-2"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-decoration-none me-2"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="text-decoration-none"><i class="bi bi-pinterest"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">Reviews (3)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab">Shipping & Returns</button>
                    </li>
                </ul>
                <div class="tab-content p-4 border border-top-0 rounded-bottom" id="productTabsContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <h4>Product Details</h4>
                        <p><?php echo nl2br(htmlspecialchars($product['product_description'])); ?></p>
                        <ul>
                            <li>High-quality ingredients for your pet's health</li>
                            <li>Veterinarian recommended</li>
                            <li>100% satisfaction guarantee</li>
                            <li>Made with natural ingredients</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="mb-4">
                            <h4>Customer Reviews</h4>
                            <div class="d-flex align-items-center mb-3">
                                <div class="text-warning me-2">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span>4.5 out of 5</span>
                            </div>
                            <p>Based on 24 reviews</p>
                        </div>
                        
                        <div class="review mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <h5>Great Product!</h5>
                                <small class="text-muted">2 days ago</small>
                            </div>
                            <div class="text-warning mb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p>My pet loves this food! Will definitely buy again.</p>
                            <p class="text-muted">- John D.</p>
                        </div>
                        
                        <div class="review mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <h5>Good quality</h5>
                                <small class="text-muted">1 week ago</small>
                            </div>
                            <div class="text-warning mb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                            </div>
                            <p>Good product but a bit expensive.</p>
                            <p class="text-muted">- Sarah M.</p>
                        </div>
                        
                        <button class="btn btn-outline-primary">Write a Review</button>
                    </div>
                    <div class="tab-pane fade" id="shipping" role="tabpanel">
                        <h4>Shipping Information</h4>
                        <p>We offer fast and reliable shipping options:</p>
                        <ul>
                            <li><strong>Standard Shipping:</strong> 3-5 business days - Rs. 150</li>
                            <li><strong>Express Shipping:</strong> 1-2 business days - Rs. 300</li>
                            <li><strong>Free Shipping:</strong> On orders over Rs. 2000</li>
                        </ul>
                        <h4 class="mt-4">Returns Policy</h4>
                        <p>We offer a 30-day return policy. Items must be unopened and in original packaging.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="mb-4">You May Also Like</h3>
                <div class="row related-products">
                    <?php
                    include "db_connection.php";
                    $query = "SELECT * FROM products WHERE product_id != ? ORDER BY RAND() LIMIT 4";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $product_id);
                    $stmt->execute();
                    $related = $stmt->get_result();
                    
                    if ($related->num_rows > 0) {
                        while ($item = $related->fetch_assoc()) {
                    ?>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="admin/<?php echo $item['product_image']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['product_name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($item['product_name']); ?></h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-primary">Rs. <?php echo number_format($item['product_price'], 2); ?></span>
                                    <a href="single-product.php?id=<?php echo $item['product_id']; ?>" class="btn btn-sm btn-outline-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    $stmt->close();
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Bootstrap JS (already included below), add Bootstrap CSS if not already present -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Quantity increment/decrement
    document.getElementById('increment').addEventListener('click', function() {
        const quantityInput = document.getElementById('quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });
    
    document.getElementById('decrement').addEventListener('click', function() {
        const quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });
    
    // Image gallery functionality
    const thumbnails = document.querySelectorAll('.product-gallery img');
    const mainImage = document.querySelector('.main-image');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            mainImage.src = this.src;
        });
    });
</script>

<?php
include "footer.php";
?>