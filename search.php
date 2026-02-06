<?php
// Session Start di paling atas
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'partials/_dbconnect.php';

// Cek Login
$loggedin = false;
$userId = 0;
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin = true;
  $userId = $_SESSION['userId'];
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
    
    <title>Search Results</title>
    <link rel="icon" href="img/D-logo.jpg" type="image/x-icon">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212; /* Background Hitam */
            color: #fff;
            padding-top: 100px;
            padding-bottom: 50px;
            min-height: 100vh;
        }

        .search-header h2 {
            font-weight: 700;
            color: #fff;
        }
        
        .search-term {
            color: #ffc107;
            font-style: italic;
        }

        /* Section Title */
        .section-title {
            position: relative;
            margin-bottom: 30px;
            margin-top: 40px;
            padding-bottom: 10px;
            border-bottom: 1px solid #333;
            color: #e0e0e0;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 80px;
            height: 3px;
            background-color: #ffc107;
        }

        /* Card Styling */
        .result-card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            height: 100%;
        }

        .result-card:hover {
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

        .result-card:hover .card-img-top {
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

        .card-text {
            color: #aaa;
            font-size: 0.9rem;
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
            text-decoration: none;
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

        .empty-icon {
            font-size: 60px;
            color: #444;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php require 'partials/_nav.php' ?>

    <div class="container my-3">
        <div class="search-header text-center mb-5">
            <h2>Search Result for <span class="search-term">"<?php echo $_GET['search']?>"</span></h2>
        </div>

        <?php 
            // Mengambil query pencarian dan membersihkannya untuk keamanan dasar
            $query = mysqli_real_escape_string($conn, $_GET["search"]);
            $foundAny = false; // Flag pengecekan hasil
        ?>

        <?php 
            // Menggunakan LIKE %query% agar pencarian lebih fleksibel tanpa setting FULLTEXT
            $sql = "SELECT * FROM `pizza` WHERE `pizzaName` LIKE '%$query%' OR `pizzaDesc` LIKE '%$query%'"; 
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0){
                $foundAny = true;
        ?>
            <h3 class="section-title">Matching Products</h3>
            <div class="row">
                <?php 
                while($row = mysqli_fetch_assoc($result)){
                    $pizzaId = $row['pizzaId'];
                    $pizzaName = $row['pizzaName'];
                    $pizzaPrice = $row['pizzaPrice'];
                    $pizzaDesc = $row['pizzaDesc'];
                    
                    echo '
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="result-card">
                            <div class="img-wrapper">
                                <a href="viewPizza.php?pizzaid=' . $pizzaId . '">
                                    <img src="img/pizza-'.$pizzaId. '.jpg" class="card-img-top" alt="'.$pizzaName.'" onerror="this.src=\'img/pizza-default.jpg\';">
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-truncate">
                                    <a href="viewPizza.php?pizzaid=' . $pizzaId . '">' . $pizzaName . '</a>
                                </h5>
                                <div class="price-text">Rp '.$pizzaPrice.'.000</div>
                                <p class="card-text text-truncate">' . substr($pizzaDesc, 0, 40). '...</p>
                                
                                <div class="mt-auto">';
                                    
                                    if($loggedin){
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

                    echo '          <a href="viewPizza.php?pizzaid=' . $pizzaId . '" class="btn-outline-theme btn-sm">Quick View</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        <?php } ?>


        <?php 
            // Pencarian kategori juga menggunakan LIKE
            $sql = "SELECT * FROM `categories` WHERE `categorieName` LIKE '%$query%' OR `categorieDesc` LIKE '%$query%'";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0){ 
                $foundAny = true;
        ?>
            <h3 class="section-title">Matching Categories</h3>
            <div class="row">
                <?php 
                while($row = mysqli_fetch_assoc($result)){
                    $catId = $row['categorieId'];
                    $catname = $row['categorieName'];
                    $catdesc = $row['categorieDesc'];
                    
                    echo '
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="result-card">
                            <div class="img-wrapper">
                                <a href="viewPizzaList.php?catid=' . $catId . '">
                                    <img src="img/card-'.$catId. '.jpg" class="card-img-top" alt="'.$catname.'" onerror="this.src=\'img/category-default.jpg\';">
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><a href="viewPizzaList.php?catid=' . $catId . '">' . $catname . '</a></h5>
                                <p class="card-text text-truncate">' . substr($catdesc, 0, 50). '...</p>
                                <div class="mt-auto">
                                    <a href="viewPizzaList.php?catid=' . $catId . '" class="btn-outline-theme">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        <?php } ?>

        <?php if(!$foundAny) { ?>
            <div class="empty-container">
                <i class="fas fa-search empty-icon"></i>
                <h3 class="font-weight-bold text-white">No Results Found</h3>
                <p class="text-muted">We couldn't find anything for <em>"<?php echo $_GET['search']?>"</em>.</p>
                <div class="mt-4 text-left d-inline-block">
                    <p class="text-warning mb-2">Suggestions:</p>
                    <ul class="text-muted text-left">
                        <li>Check your spelling.</li>
                        <li>Try different keywords (e.g. "Pizza", "Chicken").</li>
                        <li>Try more general keywords.</li>
                    </ul>
                </div>
                <div class="mt-4">
                    <a href="index.php" class="btn btn-theme px-4 rounded-pill text-dark text-decoration-none">Back to Home</a>
                </div>
            </div>
        <?php } ?>

    </div>

    <?php require 'partials/_footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>