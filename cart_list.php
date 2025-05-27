<?php
include "header.php";
include "db_connection.php";



// Handle cart updates
if (isset($_POST['update_cart'])) {
  $customer_id = $_SESSION['customer_id'];
  foreach ($_POST['quantity'] as $cart_id => $qty) {
    $cart_id = mysqli_real_escape_string($conn, $cart_id);
    $qty = intval($qty);
    if ($qty > 0) {
      $update_query = "UPDATE tbl_cart SET cart_qty = $qty 
                            WHERE cart_id = $cart_id AND cart_customer_id = '$customer_id'";
      mysqli_query($conn, $update_query);
    } else {
      // Remove item if quantity is 0
      $delete_query = "DELETE FROM tbl_cart   
                           WHERE cart_id = $cart_id AND cart_customer_id = '$customer_id'";
      mysqli_query($conn, $delete_query);
    }
  }
  header("Location: cart_list.php?updated=true");
  exit();
}

// Get cart items
$customer_id = $_SESSION['customer_id'];
$query = "SELECT * FROM tbl_cart 
         INNER JOIN products ON products.product_id = tbl_cart.cart_product_id 
         WHERE tbl_cart.cart_customer_id = '$customer_id'";
$result = mysqli_query($conn, $query);
$total = 0;
?>

<div class="container-fluid py-5">
  <div class="row">
    <div class="col-md-8">
      <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Your Shopping Cart</h4>
        </div>
        <div class="card-body">
          <?php if (isset($_GET['added'])): ?>
            <div class="alert alert-success">Product added to cart successfully!</div>
          <?php endif; ?>
          <?php if (isset($_GET['updated'])): ?>
            <div class="alert alert-success">Cart updated successfully!</div>
          <?php endif; ?>

          <form method="post" action="cart_list.php">
            <div class="table-responsive">
              <table class="table">
                <thead class="table-light">
                  <tr>
                    <th width="40%">Product</th>
                    <th width="15%">Price</th>
                    <th width="15%">Quantity</th>
                    <th width="15%">Subtotal</th>
                    <th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                      <?php
                      $subtotal = $row['product_price'] * $row['cart_qty'];
                      $total += $subtotal;
                      ?>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="admin/<?php echo htmlspecialchars($row['product_image']); ?>"
                              class="img-thumbnail me-3"
                              width="80"
                              alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                            <div>
                              <h6 class="mb-1"><?php echo htmlspecialchars($row['product_name']); ?></h6>
                              <small class="text-muted"><?php echo htmlspecialchars($row['product_description']); ?></small>
                            </div>
                          </div>
                        </td>
                        <td>Rs.<?php echo number_format($row['product_price'], 2); ?></td>
                        <td>
                         <form action="qty_add.php" method="post">
                                    <input type="hidden" name="cart_id" value="<?= $row['cart_id'] ?>"> 
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button name="minus_category" type="submit"  class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>-
                                        </button>
                                    </div>
                                    <input type="text" readonly class="form-control  form-control-sm text-center border-0" name="cart_qty"  value="<?= $row["cart_qty"] ?>">
                                    <div class="input-group-btn">
                                            <button  name="add_category" type="submit" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i> +
                                            </button>
                                        </div>
                                </div>
                           </form>
                        </td>
                        <td class="subtotal" data-id="<?php echo $row['cart_id']; ?>">
                          Rs.<?php echo number_format($subtotal, 2); ?>
                        </td>
                        <td>
                          <form action="remove_cart.php" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fas fa-trash"></i> Remove
                            </button>
                          </form>
                        </td>
                  
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="5" class="text-center">Your cart is empty</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="shop.php" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Continue Shopping
              </a>
              <?php if (mysqli_num_rows($result) > 0): ?>
                <button type="submit" name="update_cart" class="btn btn-primary">
                  <i class="fas fa-sync-alt me-2"></i>Update Cart
                </button>
              <?php endif; ?>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
          <h4 class="mb-0"><i class="fas fa-receipt me-2"></i>Cart Summary</h4>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between mb-2">
            <span>Subtotal:</span>
            <span id="cart-subtotal">Rs.<?php echo number_format($total, 2); ?></span>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <span>Shipping:</span>
            <span>Free</span>
          </div>
          <hr>
          <div class="d-flex justify-content-between fw-bold">
            <span>Total:</span>
            <span id="cart-total">Rs.<?php echo number_format($total, 2); ?></span>
          </div>
          <?php if (mysqli_num_rows($result) > 0): ?>
            <a href="checkout.php" class="btn btn-success w-100 mt-3">
              <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>