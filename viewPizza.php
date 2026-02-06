<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    
    <title id=title>Product Detail</title>
    <link rel = "icon" href ="img/D-logo.jpg" type = "image/x-icon">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Open Sans', sans-serif;
            padding-top: 80px; /* Space for fixed navbar */
        }
        
        .product-container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 40px;
            margin-top: 20px;
        }

        .product-img-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .product-img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-img:hover {
            transform: scale(1.03);
        }

        .product-title {
            font-weight: 800;
            color: #212529;
            margin-bottom: 10px;
            text-transform: capitalize;
        }

        .product-price {
            font-size: 2rem;
            color: #212529;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .currency-symbol {
            font-size: 1rem;
            vertical-align: top;
            margin-top: 8px;
            display: inline-block;
        }

        .product-desc {
            color: #6c757d;
            line-height: 1.8;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        /* Tombol Tema Kuning/Hitam */
        .btn-theme {
            background-color: #ffc107;
            color: #212529;
            font-weight: 700;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(255, 193, 7, 0.3);
        }

        .btn-theme:hover {
            background-color: #e0a800;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 193, 7, 0.4);
            color: #000;
        }
        
        .btn-outline-theme {
            border: 2px solid #343a40;
            color: #343a40;
            font-weight: 600;
            border-radius: 50px;
            padding: 10px 25px;
        }
        
        .btn-outline-theme:hover {
            background-color: #343a40;
            color: #fff;
            text-decoration: none;
        }

    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php require 'partials/_nav.php' ?>

    <div class="container mb-5" id="cont">
        
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent pl-0">
            <li class="breadcrumb-item"><a href="index.php" class="text-dark">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
          </ol>
        </nav>

        <?php
            $pizzaId = $_GET['pizzaid'];
            $sql = "SELECT * FROM `pizza` WHERE pizzaId = $pizzaId";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $pizzaName = $row['pizzaName'];
            $pizzaPrice = $row['pizzaPrice'];
            $pizzaDesc = $row['pizzaDesc'];
            $pizzaCategorieId = $row['pizzaCategorieId'];
        ?>
        
        <script> document.getElementById("title").innerHTML = "<?php echo $pizzaName; ?> | Dtastyum"; </script> 

        <div class="product-container">
            <div class="row align-items-center">
                
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="product-img-wrapper">
                        <?php echo '<img src="img/pizza-'.$pizzaId. '.jpg" class="product-img" alt="'.$pizzaName.'">'; ?>
                    </div>
                </div>

                <div class="col-md-6 pl-md-5">
                    
                    <h1 class="display-4 product-title"><?php echo $pizzaName; ?></h1>
                    
                    <div class="product-price">
                        <span class="currency-symbol">Rp</span><?php echo $pizzaPrice; ?>.000
                    </div>
                    
                    <div class="mb-3">
                        <span class="badge badge-success p-2 px-3 rounded-pill"><i class="fas fa-check-circle"></i> In Stock</span>
                        <span class="badge badge-light p-2 px-3 rounded-pill border"><i class="fas fa-truck"></i> Fast Delivery</span>
                    </div>

                    <p class="product-desc">
                        <?php echo $pizzaDesc; ?>
                    </p>

                    <hr class="my-4">

                    <?php
                    if($loggedin){
                        $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE pizzaId = '$pizzaId' AND `userId`='$userId'";
                        $quaresult = mysqli_query($conn, $quaSql);
                        $quaExistRows = mysqli_num_rows($quaresult);
                        
                        echo '<div class="d-flex flex-wrap align-items-center">';
                        
                        if($quaExistRows == 0) {
                            echo '<form action="partials/_manageCart.php" method="POST" class="mr-3 mb-2">
                                    <input type="hidden" name="itemId" value="'.$pizzaId. '">
                                    <button type="submit" name="addToCart" class="btn btn-theme btn-lg">
                                        <i class="fas fa-cart-plus mr-2"></i>Add to Cart
                                    </button>
                                  </form>';
                        } else {
                            echo '<a href="viewCart.php" class="btn btn-theme btn-lg mr-3 mb-2">
                                    <i class="fas fa-shopping-cart mr-2"></i>Go to Cart
                                  </a>';
                        }
                        
                        echo '</div>';
                    }
                    else{
                        echo '<button class="btn btn-theme btn-lg" data-toggle="modal" data-target="#loginModal">
                                <i class="fas fa-lock mr-2"></i>Login to Order
                              </button>';
                    }
                    ?>

                    <div class="mt-4">
                         <a href="viewPizzaList.php?catid=<?php echo $pizzaCategorieId; ?>" class="btn btn-outline-theme btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Menu
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php require 'partials/_footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>