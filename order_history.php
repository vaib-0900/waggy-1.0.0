<?php
include "header.php";
include "db_connection.php";

// Check if customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Get all orders for this customer, newest first
$orders_query = "SELECT * FROM orders 
                WHERE customer_id = '$customer_id' 
                ORDER BY order_date DESC";
$orders_result = mysqli_query($conn, $orders_query);

// Count total orders
$total_orders = mysqli_num_rows($orders_result);
?>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0"><i class="fas fa-history me-2 text-primary"></i> Order History</h2>
                        <span class="badge bg-primary rounded-pill"><?php echo $total_orders; ?> orders</span>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($total_orders > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr class="text-uppercase small">
                                        <th scope="col" class="fw-500 ps-4"> # Order</th>
                                        <th scope="col" class="fw-500">Date</th>
                                        <th scope="col" class="fw-500">Items</th>
                                        <th scope="col" class="fw-500">Total</th>
                                        <th scope="col" class="fw-500">Status</th>
                                        <th scope="col" class="fw-500 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($order = mysqli_fetch_assoc($orders_result)):
                                        // Count items in this order
                                        $items_query = "SELECT COUNT(*) as item_count FROM order_items 
                                                       WHERE order_id = '{$order['order_id']}'";
                                        $items_result = mysqli_query($conn, $items_query);
                                        $item_count = mysqli_fetch_assoc($items_result)['item_count'];
                                    ?>
                                        <tr class="border-top border-bottom">
                                            <td class="ps-4 fw-bold text-primary">#<?php echo $order['order_id']; ?></td>
                                            <td><?php echo date('M d, Y', strtotime($order['order_date'])); ?></td>
                                            <td>
                                                <span class="d-flex align-items-center">
                                                    <i class="fas fa-box-open me-2 text-muted"></i>
                                                    <?php echo $item_count; ?> item<?php echo $item_count != 1 ? 's' : ''; ?>
                                                </span>
                                            </td>
                                            <td class="fw-bold">Rs.<?php echo number_format($order['total_amount'], 2); ?></td>
                                            <td>
                                                <?php
                                                $status_class = '';
                                                switch (strtolower($order['status'])) {
                                                    case 'pending':
                                                        $status_class = 'bg-warning text-dark';
                                                        break;
                                                    case 'processing':
                                                        $status_class = 'bg-primary text-dark';
                                                        break;
                                                    case 'completed':
                                                        $status_class = 'bg-success text-dark';
                                                        break;
                                                    case 'shipped':
                                                        $status_class = 'bg-info text-dark';
                                                        break;
                                                    case 'delivered':
                                                        $status_class = 'bg-success text-dark';
                                                        break;
                                                    case 'cancelled':
                                                        $status_class = 'bg-danger text-dark';
                                                        break;
                                                    default:
                                                        $status_class = 'bg-secondary text-dark';
                                                        break;
                                                }
                                                ?>
                                                <span class="badge rounded-pill <?php echo $status_class; ?>">
                                                    <?php echo $order['status']; ?>
                                                </span>
                                            </td>
                                            <td class="text-center pe-4">
                                                <a href="order_details.php?id=<?php echo $order['order_id']; ?>"
                                                    class="btn btn-sm btn-outline-primary px-4">
                                                    <i class="fas fa-eye me-1"></i> View
                                                </a>
                                                <?php if ($order['status'] == 'Completed'): ?>
                                                    <button class="btn btn-sm btn-outline-success rounded-pill px-3 ms-2">
                                                        <i class="fas fa-redo me-1"></i> Reorder
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination would go here -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-4">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-shopping-bag fa-4x text-muted opacity-25"></i>
                            </div>
                            <h4 class="mb-3">No orders yet</h4>
                            <p class="text-muted mb-4">You haven't placed any orders. Start shopping to see your order history here.</p>
                            <a href="shop.php" class="btn btn-primary px-4 py-2 rounded-pill">
                                <i class="fas fa-store me-2"></i> Start Shopping
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Link Bootstrap CSS and JS -->
           
            <!-- Quick Stats Card
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card bg-primary text-white rounded-4 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="card-title text-uppercase small mb-1">Completed</h6>
                                    <h3 class="mb-0">5</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card bg-info text-white rounded-4 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-truck fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="card-title text-uppercase small mb-1">Shipped</h6>
                                    <h3 class="mb-0">2</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card bg-warning text-dark rounded-4 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="card-title text-uppercase small mb-1">Processing</h6>
                                    <h3 class="mb-0">1</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

            <?php include "footer.php"; ?>