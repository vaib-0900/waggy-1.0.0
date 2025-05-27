<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Waggy Pet Shop</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color: #fff9f0;
        }
        .thank-you-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .header-bg {
            background: linear-gradient(45deg, #ff9a9e, #fad0c4);
            padding: 30px 0;
        }
        .paw-icon {
            font-size: 3rem;
            color: #fff;
        }
        .pet-image {
            border-radius: 15px;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .btn-pink {
            background: #ff9a9e;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: bold;
        }
        .btn-pink:hover {
            background: #ff7b85;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="thank-you-card bg-white text-center">
                    <!-- Header with Gradient -->
                    <div class="header-bg">
                        <div class="paw-icon">🐾</div>
                        <h1 class="text-white fw-bold">Thank You!</h1>
                        <p class="text-white mb-0">From Waggy Pet Shop</p>
                    </div>

                    <!-- Body Content -->
                    <div class="p-4 p-md-5">
                        <img src=" images/logo.png" alt="Happy Pet" class="pet-image img-fluid mb-4">
                        <h2 class="fw-bold">We Appreciate You!</h2>
                        <p class="lead">Thank you for trusting us with your furry friends. Your support means the world to us!</p>
                        <p>🐶 For treats, toys, and tail wags, we’ve got you covered!</p>
                        <a href="index.php" class="btn btn-pink mt-3">Visit Us Again!</a>
                    </div>

                    <!-- Footer -->
                    <div class="bg-light p-3">
                        <p class="mb-0">📍 123 Pet Street, Dogville | ☎️ (123) 456-7890</p>
                        <p class="mb-0">Follow us: @WaggyPetShop</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include 'footer.php';
?>