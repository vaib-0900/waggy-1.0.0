<?php
include "header.php";
include "db_connection.php";

// Check if order ID exists and customer is logged in
if (!isset($_GET['id']) || !isset($_SESSION['customer_id'])) {
    header("Location: order_history.php");
    exit();
}

$order_id = mysqli_real_escape_string($conn, $_GET['id']);
$customer_id = $_SESSION['customer_id'];

// Get order details with prepared statement
$order_query = "SELECT * FROM orders WHERE order_id = ? AND customer_id = ?";
$stmt = mysqli_prepare($conn, $order_query);
mysqli_stmt_bind_param($stmt, "si", $order_id, $customer_id);
mysqli_stmt_execute($stmt);
$order_result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($order_result) == 0) {
    header("Location: order_history.php");
    exit();
}

$order = mysqli_fetch_assoc($order_result);

// Get order items
$items_query = "SELECT * FROM order_items WHERE order_id = ?";
$stmt = mysqli_prepare($conn, $items_query);
mysqli_stmt_bind_param($stmt, "s", $order_id);
mysqli_stmt_execute($stmt);
$items_result = mysqli_stmt_get_result($stmt);

// Calculate item count and subtotal
$item_count = mysqli_num_rows($items_result);
?>

<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <!-- Order Summary Card -->
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="h4 mb-0"><i class="fas fa-receipt text-primary me-2"></i> Order #<?php echo $order_id; ?></h2>
                            <p class="text-muted small mb-0">Placed on <?php echo date('F j, Y \a\t g:i A', strtotime($order['order_date'])); ?></p>
                        </div>
                        <span class="badge bg-<?php
                            switch ($order['status']) {
                                case 'Pending': echo 'warning text-dark'; break;
                                case 'Completed': echo 'success text-dark'; break;
                                case 'Processing': echo 'primary text-dark'; break;
                                case 'Shipped': echo 'info text-dark'; break;
                                case 'Delivered': echo 'success text-dark'; break;
                                case 'Cancelled': echo 'danger text-dark'; break;
                                default: echo 'secondary';
                            }
                        ?> rounded-pill py-2 px-3"><?php echo $order['status']; ?></span>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Enhanced Progress Tracker -->
                    <div class="mb-5">
                        <h6 class="text-uppercase small fw-bold mb-3">Order Status</h6>
                        <div class="progress-tracker">
                            <ul class="step-progress">
                                <li class="step-progress__step <?= ($order['status'] == 'Pending') ? 'is-active' : ((in_array($order['status'], ['Processing', 'Completed', 'Shipped', 'Delivered', 'Cancelled'])) ? 'is-complete' : '') ?>">
                                    <span class="step-progress__step-title">Pending</span>
                                    <span class="step-progress__step-icon">
                                        <i class="fas fa-hourglass-start"></i>
                                    </span>
                                </li>
                                <li class="step-progress__step <?= ($order['status'] == 'Processing') ? 'is-active' : ((in_array($order['status'], ['Completed', 'Shipped', 'Delivered', 'Cancelled'])) ? 'is-complete' : '') ?>">
                                    <span class="step-progress__step-title">Processing</span>
                                    <span class="step-progress__step-icon">
                                        <i class="fas fa-clipboard-check"></i>
                                    </span>
                                </li>
                                <li class="step-progress__step <?= ($order['status'] == 'Completed') ? 'is-active' : ((in_array($order['status'], ['Shipped', 'Delivered', 'Cancelled'])) ? 'is-complete' : '') ?>">
                                    <span class="step-progress__step-title">Completed</span>
                                    <span class="step-progress__step-icon">
                                        <i class="fas fa-check-double"></i>
                                    </span>
                                </li>
                                <li class="step-progress__step <?= ($order['status'] == 'Shipped') ? 'is-active' : ((in_array($order['status'], ['Delivered', 'Cancelled'])) ? 'is-complete' : '') ?>">
                                    <span class="step-progress__step-title">Shipped</span>
                                    <span class="step-progress__step-icon">
                                        <i class="fas fa-shipping-fast"></i>
                                    </span>
                                </li>
                                <li class="step-progress__step <?= ($order['status'] == 'Delivered') ? 'is-active' : (($order['status'] == 'Cancelled') ? 'is-complete' : '') ?>">
                                    <span class="step-progress__step-title">Delivered</span>
                                    <span class="step-progress__step-icon">
                                        <i class="fas fa-box-open"></i>
                                    </span>
                                </li>
                                <li class="step-progress__step <?= ($order['status'] == 'Cancelled') ? 'is-active is-cancelled' : '' ?>">
                                    <span class="step-progress__step-title">Cancelled</span>
                                    <span class="step-progress__step-icon">
                                        <i class="fas fa-times-circle"></i>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <h5 class="mb-3"><i class="fas fa-box-open text-muted me-2"></i> Order Items (<?php echo $item_count; ?>)</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 80px">Item</th>
                                    <th>Product</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($item = mysqli_fetch_assoc($items_result)): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($item['image'])): ?>
                                                <img src="admin/upload/?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>" class="img-fluid rounded" style="width: 60px; height: 60px;">
                                            <?php else: ?>
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-box-open text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <h6 class="mb-1"><?php echo htmlspecialchars($item['product_name']); ?></h6>
                                            <p class="text-muted small mb-0">SKU: <?php echo htmlspecialchars($item['product_id']); ?></p>
                                        </td>
                                        <td class="text-end">Rs.<?php echo number_format($item['price'], 2); ?></td>
                                        <td class="text-center"><?php echo $item['quantity']; ?></td>
                                        <td class="text-end fw-bold">Rs.<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Order Summary -->
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="card border-0 bg-light rounded-3 h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-truck text-muted me-2"></i> Shipping Information</h5>
                                    <address class="mb-0">
                                        <strong><?php echo htmlspecialchars($order['name']); ?></strong><br>
                                        <?php echo htmlspecialchars($order['address']); ?><br>
                                        <?php echo htmlspecialchars($order['city']); ?>, <?php echo htmlspecialchars($order['state']); ?> <?php echo htmlspecialchars($order['zip_code']); ?><br>
                                        <abbr title="Phone">Phone:</abbr> <?php echo htmlspecialchars($order['phone']); ?><br>
                                        <abbr title="Email">Email:</abbr> <?php echo htmlspecialchars($order['email']); ?>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 bg-light rounded-3 h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-file-invoice-dollar text-muted me-2"></i> Payment Summary</h5>
                                    <table class="table table-sm mb-0">
                                        <tr>
                                            <td>Subtotal (<?php echo $item_count; ?> items)</td>
                                            <td class="text-end">Rs.<?php echo number_format($order['total_amount'], 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Fee</td>
                                            <td class="text-end">Free</td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td>Total</td>
                                            <td class="text-end">Rs.<?php echo number_format($order['total_amount'], 2); ?></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <p class="small text-muted mb-0">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Payment Method: <?php echo htmlspecialchars($order['payment_method']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="order_history.php" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left me-1"></i> Back to Orders
                        </a>
                        <div>
                            <?php if ($order['status'] == 'Completed'): ?>
                                <button class="btn btn-success rounded-pill px-4 me-2">
                                    <i class="fas fa-redo me-1"></i> Reorder
                                </button>
                            <?php endif; ?>
                            <?php if (in_array($order['status'], ['Completed', 'Shipped', 'Delivered'])): ?>
                                <form action="print_invoice.php" method="get" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($order_id); ?>">
                                    <button type="submit" class="btn btn-outline-primary rounded-pill px-4">
                                        <i class="fas fa-file-download me-1"></i> View Invoice
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced Progress Tracker */
.progress-tracker {
    position: relative;
    padding: 0;
    margin: 0 auto;
    max-width: 100%;
    overflow-x: auto;
}

.step-progress {
    display: flex;
    justify-content: space-between;
    list-style: none;
    padding: 0;
    margin: 0 0 1rem;
    position: relative;
}

.step-progress::before {
    content: "";
    position: absolute;
    top: 24px;
    left: 0;
    width: 100%;
    height: 4px;
    background-color: #e9ecef;
    z-index: 1;
}

.step-progress__step {
    position: relative;
    flex: 1;
    text-align: center;
    z-index: 2;
    padding: 0 5px;
}

.step-progress__step:last-child {
    flex: 0;
}

.step-progress__step-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    margin: 0 auto 8px;
    border-radius: 50%;
    background-color: #e9ecef;
    color: #6c757d;
    font-size: 1.25rem;
    position: relative;
    z-index: 2;
}

.step-progress__step-title {
    display: block;
    font-size: 0.875rem;
    color: #6c757d;
    white-space: nowrap;
}

/* Active step */
.step-progress__step.is-active .step-progress__step-icon {
    background-color: #0d6efd;
    color: white;
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.2);
}

.step-progress__step.is-active .step-progress__step-title {
    color: #0d6efd;
    font-weight: 500;
}

/* Completed steps */
.step-progress__step.is-complete .step-progress__step-icon {
    background-color: #198754;
    color: white;
}

.step-progress__step.is-complete .step-progress__step-title {
    color: #198754;
}

/* Cancelled state */
.step-progress__step.is-cancelled .step-progress__step-icon {
    background-color: #dc3545;
    color: white;
}

.step-progress__step.is-cancelled .step-progress__step-title {
    color: #dc3545;
}

/* Progress bar */
.step-progress__bar {
    position: absolute;
    top: 24px;
    left: 0;
    height: 4px;
    background-color: #198754;
    z-index: 1;
    transition: width 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .step-progress {
        min-width: 500px;
    }
    
    .step-progress__step-title {
        font-size: 0.75rem;
    }
    
    .step-progress__step-icon {
        width: 36px;
        height: 36px;
        font-size: 1rem;
    }
    
    .step-progress::before,
    .step-progress__bar {
        top: 18px;
    }
}
</style>
<!-- Link Bootstrap CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php include "footer.php"; ?>