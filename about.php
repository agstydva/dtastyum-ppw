<?php
include 'partials/_dbconnect.php'; // Koneksi database
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <title>All Products</title>
    <link rel="icon" href="img/D-logo.jpg" type="image/x-icon">
    <style>
        body {
            padding-top: 80px;
            background-color: #f8f9fa;
            font-family: 'Open Sans', sans-serif;
        }
        
        /* Card Styling */
        .product-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            background: #fff;
            overflow: hidden;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Image Styling */
        .img-container {
            position: relative;
            height: 200px; /* Tinggi gambar seragam */
            overflow: hidden;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .card-img-top {
            transform: scale(1.1);
        }

        /* Wishlist Button Overlay */
        .wishlist-btn-overlay {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }
        
        .btn-wishlist-icon {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: all 0.2s;
            color: #dc3545; /* Merah */
            cursor: pointer;
        }

        .btn-wishlist-icon:hover {
            transform: scale(1.1);
            background: #fff;
        }

        /* Text Styling */
        .card-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .card-title a {
            color: #333;
            text-decoration: none;
        }
        
        .card-title a:hover {
            color: #ffc107;
        }

        .price-text {
            color: #212529;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .card-text {
            font-size: 0.85rem;
            color: #777;
        }

        /* Add to Cart Button */
        .btn-add-cart {
            background-color: #ffc107;
            color: #212529;
            font-weight: 600;
            border-radius: 50px;
            border: none;
            box-shadow: 0 4px 6px rgba(255, 193, 7, 0.2);
        }

        .btn-add-cart:hover {
            background-color: #e0a800;
            color: #000;
        }
        
        .section-header {
            position: relative;
            margin-bottom: 40px;
        }
        
        .section-header h2 {
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .section-header:after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: #ffc107;
            margin: 10px auto 0;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <?php require 'partials/_nav.php'; ?>

    <div class="container my-5">
        <div class="section-header text-center">
            <h2>Our Menu</h2>
            <p class="text-muted">Tasty food waiting for you</p>
        </div>
        
        <div class="row">
        <?php
            $sql = "SELECT * FROM `pizza`";
            $result = mysqli_query($conn, $sql);
            $noResult = true;

            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $pizzaId = $row['pizzaId'];
                $pizzaName = $row['pizzaName'];
                $pizzaPrice = $row['pizzaPrice'];
                $pizzaDesc = $row['pizzaDesc'];

                // Start Card
                echo '<div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="card product-card h-100 shadow-sm">
                            
                            <div class="img-container">
                                <a href="viewPizza.php?pizzaid=' . $pizzaId . '">
                                    <img src="img/pizza-'.$pizzaId. '.jpg" class="card-img-top" alt="'.$pizzaName.'">
                                </a>';

                                // Wishlist Logic (Floating Icon)
                                if (isset($_SESSION['userId'])) {
                                    $userId = $_SESSION['userId'];
                                    echo '<form action="partials/_manageWishlist.php" method="POST" class="wishlist-btn-overlay">
                                            <input type="hidden" name="itemId" value="'.$pizzaId.'">
                                            <button type="submit" name="addToWishlist" class="btn-wishlist-icon" title="Wishlist">';
                                                
                                            $checkSql = "SELECT * FROM `wishlist` WHERE `userId` = '$userId' AND `pizzaId` = '$pizzaId'";
                                            $checkResult = mysqli_query($conn, $checkSql);
                                            if (mysqli_num_rows($checkResult) > 0) {
                                                // Icon Full (Sudah di wishlist)
                                                echo '<i class="fas fa-heart"></i>'; 
                                            } else {
                                                // Icon Outline (Belum di wishlist)
                                                echo '<i class="far fa-heart"></i>'; 
                                            }
                                    echo    '</button>
                                          </form>';
                                } else {
                                    // Jika belum login, tombol wishlist memicu modal login
                                    echo '<div class="wishlist-btn-overlay">
                                            <button type="button" class="btn-wishlist-icon" data-toggle="modal" data-target="#loginModal">
                                                <i class="far fa-heart"></i>
                                            </button>
                                          </div>';
                                }

                echo '      </div>
                            
                            <div class="card-body d-flex flex-column pb-3">
                                <h5 class="card-title text-truncate">
                                    <a href="viewPizza.php?pizzaid=' . $pizzaId . '">' . $pizzaName . '</a>
                                </h5>
                                <p class="card-text text-truncate mb-2">' . substr($pizzaDesc, 0, 40). '...</p>
                                
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="price-text">Rp ' . $pizzaPrice . '.000</span>
                                </div>
                                
                                <div class="mt-auto">';
                                    
                                if (isset($_SESSION['userId'])) {
                                    echo '<form action="partials/_manageCart.php" method="POST">
                                            <input type="hidden" name="itemId" value="'.$pizzaId.'">
                                            <button type="submit" name="addToCart" class="btn btn-add-cart btn-block rounded-pill">
                                                <i class="fas fa-plus small mr-1"></i> Add
                                            </button>
                                          </form>';
                                } else {
                                    echo '<button class="btn btn-add-cart btn-block rounded-pill" data-toggle="modal" data-target="#loginModal">
                                            <i class="fas fa-plus small mr-1"></i> Add
                                          </button>';
                                }

                echo '          </div>
                            </div>
                        </div>
                    </div>';
            }

            if ($noResult) {
                echo '<div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i> No products available right now.
                        </div>
                      </div>';
            }
        ?>
        </div>
    </div>

    <?php require 'partials/_footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>