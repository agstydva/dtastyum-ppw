<?php
// START SESSION DI PALING ATAS
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'partials/_dbconnect.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <title>My Wishlist</title>
    <link rel="icon" href="img/D-logo.jpg" type="image/x-icon">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212; 
            color: #fff;
            padding-top: 100px;
            padding-bottom: 50px;
        }

        /* Wishlist Card */
        .wish-card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            height: 100%;
            position: relative;
        }

        .wish-card:hover {
            transform: translateY(-5px);
            border-color: #ffc107;
            box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        }

        .img-wrapper {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .wish-card:hover .card-img-top {
            transform: scale(1.1);
        }

        /* Button Overlay (Remove) */
        .remove-overlay {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }

        .btn-remove-icon {
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn-remove-icon:hover {
            background: #dc3545;
            transform: scale(1.1);
        }

        .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .card-title a {
            color: #fff;
            text-decoration: none;
        }

        .card-title a:hover {
            color: #ffc107;
        }

        .price-text {
            color: #ffc107;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .btn-add-cart {
            background-color: #ffc107;
            color: #000;
            font-weight: 700;
            border-radius: 50px;
            border: none;
            width: 100%;
            padding: 10px;
            transition: 0.3s;
        }

        .btn-add-cart:hover {
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }

        /* Empty State */
        .empty-container {
            text-align: center;
            padding: 80px 20px;
            background: #1e1e1e;
            border-radius: 20px;
            border: 2px dashed #333;
        }

        .empty-icon {
            font-size: 80px;
            color: #444;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    
    <div class="container">
        
        <div class="text-center mb-5">
            <h2 class="font-weight-bold text-white text-uppercase" style="letter-spacing: 2px;">My Wishlist</h2>
            <p class="text-muted">Save your favorite food for later</p>
        </div>

        <?php
        // Cek Login
        if (isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
            
            // Query Join
            $sql = "SELECT p.pizzaId, p.pizzaName, p.pizzaPrice, p.pizzaDesc 
                    FROM `wishlist` w 
                    JOIN `pizza` p ON w.pizzaId = p.pizzaId 
                    WHERE w.userId = '$userId'";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                echo '<div class="row">';
                
                while($row = mysqli_fetch_assoc($result)){
                    $pizzaId = $row['pizzaId'];
                    $pizzaName = $row['pizzaName'];
                    $pizzaPrice = $row['pizzaPrice'];
                    $pizzaDesc = $row['pizzaDesc'];
        ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="wish-card">
                            
                            <div class="img-wrapper">
                                <a href="viewPizza.php?pizzaid=<?php echo $pizzaId; ?>">
                                    <img src="img/pizza-<?php echo $pizzaId; ?>.jpg" class="card-img-top" alt="<?php echo $pizzaName; ?>" onerror="this.src='img/pizza-default.jpg';">
                                </a>

                                <form action="partials/_manageWishlist.php" method="POST" class="remove-overlay">
                                    <input type="hidden" name="itemId" value="<?php echo $pizzaId; ?>">
                                    <button type="submit" name="addToWishlist" class="btn-remove-icon" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title text-truncate">
                                    <a href="viewPizza.php?pizzaid=<?php echo $pizzaId; ?>"><?php echo $pizzaName; ?></a>
                                </h5>
                                <p class="card-text text-muted small text-truncate mb-2"><?php echo substr($pizzaDesc, 0, 40); ?>...</p>
                                <div class="price-text">Rp <?php echo $pizzaPrice; ?>.000</div>
                                
                                <div class="mt-auto">
                                    <form action="partials/_manageCart.php" method="POST">
                                        <input type="hidden" name="itemId" value="<?php echo $pizzaId; ?>">
                                        <button type="submit" name="addToCart" class="btn btn-add-cart">
                                            <i class="fas fa-cart-plus mr-2"></i> Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
        <?php
                }
                echo '</div>'; // End Row

            } else {
                // Empty State
                echo '<div class="empty-container">
                        <i class="far fa-heart empty-icon"></i>
                        <h3>Your Wishlist is Empty</h3>
                        <p class="text-muted">Start adding your favorite pizzas here!</p>
                        <a href="index.php" class="btn btn-warning rounded-pill font-weight-bold px-4 mt-3">Browse Menu</a>
                      </div>';
            }

        } else {
            // Belum Login
            echo '<div class="row justify-content-center align-items-center" style="min-height: 400px;">
                    <div class="col-md-6 text-center">
                        <i class="fas fa-lock mb-3" style="font-size: 4rem; color: #ffc107;"></i>
                        <h3 class="text-white">Please Login First</h3>
                        <p class="text-muted">You need to be logged in to save items to your wishlist.</p>
                        <button class="btn btn-warning rounded-pill px-4 font-weight-bold" data-toggle="modal" data-target="#loginModal">Login Now</button>
                    </div>
                  </div>';
        }
        ?>
        
    </div>

    <?php require 'partials/_footer.php'; ?>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>