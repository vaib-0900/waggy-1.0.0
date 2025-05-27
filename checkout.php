<?php
include "header.php";
include "db_connection.php";

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];
$cart_query = "SELECT p.*, c.cart_qty, c.cart_id 
              FROM tbl_cart c
              JOIN products p ON c.cart_product_id = p.product_id
              WHERE c.cart_customer_id = '$customer_id'";
$cart_result = mysqli_query($conn, $cart_query);



$total = 0;
$cart_items = [];
while ($item = mysqli_fetch_assoc($cart_result)) {
    $subtotal = $item['product_price'] * $item['cart_qty'];
    $total += $subtotal;
    $cart_items[] = $item;
}


$customer_query = "SELECT * FROM tbl_customer WHERE customer_id = '$customer_id'";
$customer_result = mysqli_query($conn, $customer_query);
$customer = mysqli_fetch_assoc($customer_result);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

    mysqli_begin_transaction($conn);

    try {

        $order_query = "INSERT INTO orders (
                        customer_id, total_amount, name, email, phone, 
                        address, city, state, zip_code, payment_method, order_date, status
                      ) VALUES (
                        '$customer_id', '$total', '$name', '$email', '$phone',
                        '$address', '$city', '$state', '$zip', '$payment_method', NOW(), 'Pending'
                      )";

        if (!mysqli_query($conn, $order_query)) {
            throw new Exception("Error creating order");
        }

        $order_id = mysqli_insert_id($conn);


        foreach ($cart_items as $item) {
            $item_query = "INSERT INTO order_items (
                            order_id, product_id, quantity, price, product_name
                          ) VALUES (
                            '$order_id', '{$item['product_id']}', '{$item['cart_qty']}', 
                            '{$item['product_price']}', '{$item['product_name']}'
                          )";

            if (!mysqli_query($conn, $item_query)) {
                throw new Exception("Error adding order items");
            }
        }


        $clear_cart = "DELETE FROM tbl_cart WHERE cart_customer_id = '$customer_id'";
        if (!mysqli_query($conn, $clear_cart)) {
            throw new Exception("Error clearing cart");
        }

        mysqli_commit($conn);
    } catch (Exception $e) {

        mysqli_rollback($conn);
        $error = "Error processing your order: " . $e->getMessage();
    }
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-checkout me-2"></i>Checkout</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form method="post" id="checkout-form">
                        <h5 class="mb-3">Billing Details</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?php echo htmlspecialchars($customer['customer_name'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo htmlspecialchars($customer['customer_email'] ?? ''); ?>" required>
                            </div>
                            <div class="col-12">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    value="<?php echo htmlspecialchars($customer['customer_phone'] ?? ''); ?>" required>
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="<?php echo htmlspecialchars($customer['customer_address'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="<?php echo htmlspecialchars($customer['customer_city'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control" id="state" name="state"
                                    value="<?php echo htmlspecialchars($customer['customer_state'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="zip" class="form-label">ZIP Code</label>
                                <input type="text" class="form-control" id="zip" name="zip"
                                    value="<?php echo htmlspecialchars($customer['customer_zip'] ?? ''); ?>" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Payment Method</h5>
                        <div class="form-check">
                            <input id="cod" name="payment_method" type="radio" class="form-check-input" value="COD" checked required>
                            <label class="form-check-label" for="cod">Cash on Delivery (COD)</label>
                        </div>
                        <div class="form-check">
                            <input id="credit" name="payment_method" type="radio" class="form-check-input" value="Credit Card">
                            <label class="form-check-label" for="credit">Credit Card</label>
                        </div>
                        <div class="form-check">
                            <input id="paypal" name="payment_method" type="radio" class="form-check-input" value="PayPal">
                            <label class="form-check-label" for="paypal">PayPal</label>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Place Order</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-receipt me-2"></i>Your Order</h4>
                </div>
                <div class="card-body">
                    <h6 class="mb-3">Products</h6>
                    <ul class="list-group mb-3">
                        <?php foreach ($cart_items as $item): ?>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0"><?php echo htmlspecialchars($item['product_name']); ?></h6>
                                    <small class="text-muted">Qty: <?php echo $item['cart_qty']; ?></small>
                                </div>
                                <span class="text-muted">Rs.<?php echo number_format($item['product_price'] * $item['cart_qty'], 2); ?></span>
                            </li>
                        <?php endforeach; ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Subtotal</span>
                            <strong>Rs.<?php echo number_format($total, 2); ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Shipping</span>
                            <strong>FREE</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong>Rs.<?php echo number_format($total, 2); ?></strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        const inputs = this.querySelectorAll('input[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Please fill all required fields');
        }
    });
</script>

<?php include "footer.php"; ?>