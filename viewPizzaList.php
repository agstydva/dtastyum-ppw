<?php
// Session Start di paling atas
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'partials/_dbconnect.php';

// Cek Login Status
$loggedin = false;
$userId = 0;
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin = true;
  $userId = $_SESSION['userId'];
}

// Ambil Info Kategori
$catId = $_GET['catid'];
$sql = "SELECT * FROM `categories` WHERE categorieId = $catId";
$result = mysqli_query($conn, $sql);
if($result && mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $catname = $row['categorieName'];
    $catdesc = $row['categorieDesc'];
} else {
    // Handle kategori tidak valid
    echo "<script>window.location.href='index.php';</script>";
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <title><?php echo $catname; ?> - Menu</title>
    <link rel="icon" href="img/D-logo.jpg" type="image/x-icon">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212; 
            color: #fff;
            padding-top: 100px;
            padding-bottom: 50px;
            min-height: 100vh;
        }

        /* Header Category */
        .category-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #333;
        }

        .category-title {
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #ffc107;
            margin-bottom: 10px;
        }

        .category-desc {
            color: #aaa;
            font-size: 0.95rem;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Breadcrumb Dark */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 20px;
        }
        .breadcrumb-item a { color: #aaa; text-decoration: none; }
        .breadcrumb-item a:hover { color: #ffc107; }
        .breadcrumb-item.active { color: #ffc107; }
        .breadcrumb-item + .breadcrumb-item::before { color: #555; }

        /* Card Styling (Sama dengan Search Result) */
        .product-card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            height: 100%;
            position: relative;
        }

        .product-card:hover {
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

        .product-card:hover .card-img-top {
            transform: scale(1.1);
        }

        /* Wishlist Overlay */
        .wishlist-overlay {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }

        .btn-wish-icon {
            width: 35px;
            height: 35px;
            background: rgba(0,0,0,0.6);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn-wish-icon:hover {
            background: #fff;
            color: #dc3545;
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
        .card-title a:hover { color: #ffc107; }

        .card-text {
            color: #aaa;
            font-size: 0.85rem;
            margin-bottom: 15px;
        }

        .price-text {
            color: #ffc107;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        /* Buttons */
        .btn-theme {
            background-color: #ffc107;
            color: #000;
            font-weight: 700;
            border-radius: 50px;
            border: none;
            width: 100%;
            padding: 10px;
            transition: 0.3s;
        }

        .btn-theme:hover {
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }
        
        .btn-outline-theme {
            background: transparent;
            border: 2px solid #ffc107;
            color: #ffc107;
            font-weight: 600;
            border-radius: 50px;
            width: 100%;
            padding: 8px;
            transition: 0.3s;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }
        
        .btn-outline-theme:hover {
            background: #ffc107;
            color: #000;
        }

        /* Empty State */
        .empty-container {
            text-align: center;
            padding: 80px 20px;
            background: #1e1e1e;
            border-radius: 20px;
            border: 2px dashed #333;
            margin-top: 30px;
        }
        .empty-icon { font-size: 60px; color: #444; margin-bottom: 20px; }
    </style>
</head>
<body>
    <?php require 'partials/_nav.php' ?>

    <div class="container mb-5">
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $catname; ?></li>
            </ol>
        </nav>

        <div class="category-header">
            <h2 class="category-title"><?php echo $catname; ?></h2>
            <p class="category-desc"><?php echo $catdesc; ?></p>
        </div>

        <div class="row">
        <?php
            $sql = "SELECT * FROM `pizza` WHERE pizzaCategorieId = $catId";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $noResult = false;
                    $pizzaId = $row['pizzaId'];
                    $pizzaName = $row['pizzaName'];
                    $pizzaPrice = $row['pizzaPrice'];
                    $pizzaDesc = $row['pizzaDesc'];
                    
                    echo '
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="product-card">
                            <div class="img-wrapper">
                                <a href="viewPizza.php?pizzaid=' . $pizzaId . '">
                                    <img src="img/pizza-'.$pizzaId. '.jpg" class="card-img-top" alt="'.$pizzaName.'" onerror="this.src=\'img/pizza-default.jpg\';">
                                </a>';

                                // Tombol Wishlist (Floating)
                                if($loggedin){
                                    echo '<form action="partials/_manageWishlist.php" method="POST" class="wishlist-overlay">
                                            <input type="hidden" name="itemId" value="'.$pizzaId.'">
                                            <button type="submit" name="addToWishlist" class="btn-wish-icon" title="Toggle Wishlist">';
                                            
                                            $checkSql = "SELECT * FROM `wishlist` WHERE `userId` = '$userId' AND `pizzaId` = '$pizzaId'";
                                            $checkResult = mysqli_query($conn, $checkSql);
                                            if (mysqli_num_rows($checkResult) > 0) {
                                                echo '<i class="fas fa-heart text-danger"></i>'; 
                                            } else {
                                                echo '<i class="far fa-heart"></i>'; 
                                            }
                                    echo   '</button>
                                          </form>';
                                } else {
                                    echo '<div class="wishlist-overlay">
                                            <button class="btn-wish-icon" data-toggle="modal" data-target="#loginModal">
                                                <i class="far fa-heart"></i>
                                            </button>
                                          </div>';
                                }

                    echo '  </div>
                            <div class="card-body">
                                <h5 class="card-title text-truncate">
                                    <a href="viewPizza.php?pizzaid=' . $pizzaId . '">' . $pizzaName . '</a>
                                </h5>
                                <div class="price-text">Rp '.$pizzaPrice.'.000</div>
                                <p class="card-text text-truncate">' . substr($pizzaDesc, 0, 40). '...</p>
                                
                                <div class="mt-auto">';
                                    
                                    if($loggedin){
                                        // Cek apakah item sudah ada di cart
                                        $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE pizzaId = '$pizzaId' AND `userId`='$userId'";
                                        $quaresult = mysqli_query($conn, $quaSql);
                                        $quaExistRows = mysqli_num_rows($quaresult);
                                        
                                        if($quaExistRows == 0) {
                                            echo '<form action="partials/_manageCart.php" method="POST">
                                                    <input type="hidden" name="itemId" value="'.$pizzaId. '">
                                                    <button type="submit" name="addToCart" class="btn btn-theme mb-2">Add to Cart</button>
                                                  </form>';
                                        } else {
                                            echo '<a href="viewCart.php" class="btn btn-theme mb-2">Go to Cart</a>';
                                        }
                                    } else {
                                        echo '<button class="btn btn-theme mb-2" data-toggle="modal" data-target="#loginModal">Add to Cart</button>';
                                    }

                    echo '          <a href="viewPizza.php?pizzaid=' . $pizzaId . '" class="btn btn-outline-theme btn-sm">Quick View</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
            
            if($noResult) {
                echo '<div class="col-12">
                        <div class="empty-container">
                            <i class="fas fa-utensils empty-icon"></i>
                            <h3 class="font-weight-bold">Menu Unavailable</h3>
                            <p class="text-muted">Sorry, there are no items in this category yet.</p>
                            <a href="index.php" class="btn btn-outline-theme px-4 rounded-pill mt-3">Back to Categories</a>
                        </div>
                      </div>';
            }
        ?>
        </div>
    </div>

    <?php require 'partials/_footer.php' ?>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>