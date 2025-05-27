<?php
include "header.php";

// Fetch customer account details from the database
include "db_connection.php";

$customer_id = $_SESSION['customer_id'];
$query = "SELECT * FROM tbl_customer WHERE customer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$customer = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">My Account</h3>
                </div>

                <div class="card-body">
                    <?php if ($customer) : ?>
                        <div class="text-center mb-4">
                            <h2>Welcome, <?= htmlspecialchars($customer['customer_name']) ?></h2>
                            <div class="mt-3 text-center">
                                <img src="admin/upload/vaibhav.JPG?= htmlspecialchars($customer['customer_image']) ?>" 
                                     alt="Profile Picture" class="rounded-circle" 
                                     style="width: 200px; height: 200px; object-fit: cover;">
                            </div>
                        </div>

                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Email</h5>
                                </div>
                                <p class="mb-1"><?= htmlspecialchars($customer['customer_email']) ?></p>
                            </div>

                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Phone</h5>
                                </div>
                                <p class="mb-1"><?= htmlspecialchars($customer['customer_phone']) ?></p>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="edit_profile.php" class="btn btn-outline-primary mr-3">
                                <i class="fas fa-user-edit"></i> Edit Profile
                            </a>
                            <a href="login_out.php" class="btn btn-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-warning">Account details not found.</div>
                    <?php endif; ?>
                </div>

                <div class="card-footer text-muted text-center">
                    Last updated: <?= date("F j, Y") ?>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php include "footer.php"; ?>