<?php
include('header.php');
include('sidebar.php');
include('db_connection.php');

if(!isset($_GET['id'])) {
    header("Location: order_list.php");
    exit();
}

$order_id = $_GET['id'];

// Get order details
$order_query = "SELECT * FROM orders WHERE order_id = $order_id";
$order_result = mysqli_query($conn, $order_query);
$order = mysqli_fetch_assoc($order_result);

// Get order items
$items_query = "SELECT * FROM order_items WHERE order_id = $order_id";
$items_result = mysqli_query($conn, $items_query);
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Order Details <small>#<?= $order['order_id'] ?></small>
                    <div class="pull-right">
                        <span class="label label-<?= 
                            $order['status'] == 'Completed' ? 'success' : 
                            ($order['status'] == 'Processing' ? 'warning' : 
                            ($order['status'] == 'Cancelled' ? 'danger' : 'info')) 
                        ?>">
                            <?= $order['status'] ?>
                        </span>
                    </div>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="order_list.php"><i class="fa fa-list"></i> Orders</a></li>
                    <li class="active"><i class="fa fa-file-text-o"></i> Order Details</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Customer Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="30%">Name</th>
                                        <td><?= htmlspecialchars($order['name']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><a href="mailto:<?= htmlspecialchars($order['email']) ?>"><?= htmlspecialchars($order['email']) ?></a></td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td><?= htmlspecialchars($order['phone']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>
                                            <?= htmlspecialchars($order['address']) ?><br>
                                            <?= htmlspecialchars($order['city']) ?>, <?= htmlspecialchars($order['state']) ?><br>
                                            <?= htmlspecialchars($order['zip_code']) ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Order Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="30%">Order Date</th>
                                        <td><?= date('F j, Y, g:i a', strtotime($order['order_date'])) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Payment Method</th>
                                        <td>
                                            <?= htmlspecialchars($order['payment_method']) ?>
                                            <?php if($order['payment_method'] == 'Credit Card'): ?>
                                                <span class="text-muted">(****-****-****-<?= substr($order['card_number'], -4) ?>)</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="label label-<?= 
                                            $order['status'] == 'Completed' ? 'success' : 
                                            ($order['status'] == 'Processing' ? 'warning' : 
                                            ($order['status'] == 'Cancelled' ? 'danger' : 'info')) 
                                        ?>">
                                            <?= htmlspecialchars($order['status']) ?>
                                        </span>
                                    </td></td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount</th>
                                        <td class="text-success"><strong>Rs. <?= number_format($order['total_amount'], 2) ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-list-ol"></i> Order Items</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="active">
                                        <th>#</th>
                                        <th>Product</th>
                                        <th class="text-right">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $counter = 1;
                                    $subtotal = 0;
                                    while($item = mysqli_fetch_assoc($items_result)): 
                                        $item_total = $item['price'] * $item['quantity'];
                                        $subtotal += $item_total;
                                    ?>
                                    <tr>
                                        <td><?= $counter++ ?></td>
                                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                                        <td class="text-right">Rs. <?= number_format($item['price'], 2) ?></td>
                                        <td class="text-center"><?= $item['quantity'] ?></td>
                                        <td class="text-right">Rs. <?= number_format($item_total, 2) ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">Subtotal:</th>
                                        <th class="text-right">Rs. <?= number_format($subtotal, 2) ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">Shipping:</th>
                                        <th class="text-right">Free</th>
                                    </tr>
                                
                                    <tr class="success">
                                        <th colspan="4" class="text-right">Total:</th>
                                        <th class="text-right">Rs. <?= number_format($order['total_amount'], 2) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        
        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    <a href="order_list.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Orders</a>
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="fas fa-print me-2"></i> Print Invoice
                    </button>
                </div>
            </div>
            
        </div> 
               <!-- Thank You Message -->
                <div class="thank-you text-center">
                    Thank you for your business! <br>
                    <strong>Waggy Pet Shop - Where Every Pet is Family!</strong>
                </div>
    </div>
</div>


<?php include('footer.php'); ?>