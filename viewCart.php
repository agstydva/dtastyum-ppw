<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'partials/_dbconnect.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $userId = $_SESSION['userId'];
}
else{
  $loggedin = false;
  $userId = 0;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <title>My Cart</title>
    <link rel="icon" href="img/D-logo.jpg" type="image/x-icon">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212; 
            color: #fff;
            /* PERBAIKAN PADDING ATAS: Ditambah jadi 100px agar lega */
            padding-top: 100px; 
        }
        
        #cont {
            min-height : 626px;
        }

        .cart-card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 15px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .cart-card:hover {
            border-color: #ffc107;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }

        .cart-img-wrapper {
            width: 120px;
            height: 120px;
            overflow: hidden;
            border-radius: 10px;
            margin: 10px;
        }

        .cart-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-name {
            font-weight: 700;
            color: #fff;
            font-size: 1.1rem;
            text-decoration: none;
        }
        
        .item-name:hover {
            color: #ffc107;
            text-decoration: none;
        }

        .item-price {
            color: #ffc107;
            font-weight: 600;
        }

        .qty-btn {
            background: #333;
            color: #fff;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.2s;
            cursor: pointer;
        }
        
        .qty-btn:hover {
            background: #ffc107;
            color: #000;
        }

        .qty-input {
            background: transparent;
            border: none;
            color: #fff;
            width: 40px;
            text-align: center;
            font-weight: bold;
        }

        .summary-card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 15px;
            padding: 25px;
            position: sticky;
            top: 120px; /* Sticky disesuaikan karena padding body bertambah */
        }

        .summary-title {
            color: #ffc107;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid #444;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            color: #ccc;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #444;
            font-size: 1.2rem;
            font-weight: 800;
            color: #fff;
        }

        .btn-checkout {
            background-color: #ffc107;
            color: #000;
            font-weight: 800;
            border-radius: 50px;
            padding: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
            border: none;
            width: 100%;
        }

        .btn-checkout:hover {
            background-color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }

        .remove-btn {
            color: #dc3545;
            background: transparent;
            border: 1px solid #dc3545;
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 0.8rem;
            transition: 0.3s;
            cursor: pointer;
        }

        .remove-btn:hover {
            background: #dc3545;
            color: #fff;
        }

        .empty-cart-container {
            background: #1e1e1e;
            border-radius: 20px;
            padding: 50px;
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
    
    <div class="container" id="cont">
    <?php if($loggedin){ ?>
        
        <div class="row">
            <div class="col-12 mb-4">
                <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center" role="alert" style="background: #332b00; color: #ffc107;">
                    <i class="fas fa-info-circle mr-3" style="font-size: 1.5rem;"></i>
                    <div>
                        <strong>Payment Info:</strong> Saat ini pembayaran online sedang maintenance. Silakan gunakan metode <strong>Cash On Delivery (COD)</strong>.
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <h2 class="font-weight-bold text-white">Shopping Cart</h2>
            </div>

            <div class="col-lg-8">
                <?php
                    $sql = "SELECT * FROM `viewcart` WHERE `userId`= $userId";
                    $result = mysqli_query($conn, $sql);
                    $counter = 0;
                    $totalPrice = 0;
                    
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $pizzaId = $row['pizzaId'];
                            $Quantity = $row['itemQuantity'];
                            
                            $mysql = "SELECT * FROM `pizza` WHERE pizzaId = $pizzaId";
                            $myresult = mysqli_query($conn, $mysql);
                            $myrow = mysqli_fetch_assoc($myresult);
                            
                            $pizzaName = $myrow['pizzaName'];
                            $pizzaPrice = $myrow['pizzaPrice'];
                            $total = $pizzaPrice * $Quantity;
                            $counter++;
                            $totalPrice = $totalPrice + $total;
                ?>
                            <div class="cart-card d-flex align-items-center">
                                <div class="cart-img-wrapper">
                                    <img src="img/pizza-<?php echo $pizzaId; ?>.jpg" class="cart-img" alt="<?php echo $pizzaName; ?>" onerror="this.src='img/pizza-default.jpg';">
                                </div>
                                
                                <div class="p-3 w-100">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <a href="viewPizza.php?pizzaid=<?php echo $pizzaId; ?>" class="item-name"><?php echo $pizzaName; ?></a>
                                            <div class="item-price mt-1">Rp <?php echo $pizzaPrice; ?>.000</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-weight-bold mb-2">Rp <?php echo $total; ?>.000</div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <form id="frm<?php echo $pizzaId; ?>">
                                            <input type="hidden" name="pizzaId" value="<?php echo $pizzaId; ?>">
                                            <div class="d-flex align-items-center" style="background: #252525; border-radius: 8px; padding: 2px;">
                                                <button type="button" class="qty-btn" onclick="updateQty(<?php echo $pizzaId; ?>, -1)">-</button>
                                                <input type="number" name="quantity" id="qtyInput<?php echo $pizzaId; ?>" value="<?php echo $Quantity; ?>" class="qty-input" readonly>
                                                <button type="button" class="qty-btn" onclick="updateQty(<?php echo $pizzaId; ?>, 1)">+</button>
                                            </div>
                                        </form>

                                        <button class="remove-btn" onclick="removeItem(<?php echo $pizzaId; ?>)">
                                            <i class="fas fa-trash-alt mr-1"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>

                <?php   } 
                    } else {
                         echo '<div class="empty-cart-container text-center">
                                <i class="fas fa-shopping-basket empty-icon"></i>
                                <h3 class="font-weight-bold">Your Cart is Empty</h3>
                                <p class="text-muted">Looks like you haven\'t made your choice yet.</p>
                                <a href="index.php" class="btn btn-warning rounded-pill font-weight-bold px-4 mt-3">Start Shopping</a>
                              </div>';
                    }
                ?>
                
                <?php if($counter > 0) { ?>
                    <div class="text-right mb-4">
                        <button onclick="removeAllItems(<?php echo $userId; ?>)" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                            <i class="fas fa-trash mr-2"></i>Empty Cart
                        </button>
                    </div>
                <?php } ?>
            </div>

            <?php if($counter > 0) { ?>
            <div class="col-lg-4">
                <div class="summary-card">
                    <h5 class="summary-title">Order Summary</h5>
                    <div class="summary-item">
                        <span>Items (<?php echo $counter; ?>)</span>
                        <span>Rp <?php echo $totalPrice; ?>.000</span>
                    </div>
                    <div class="summary-item">
                        <span>Shipping</span>
                        <span class="text-success">Free</span>
                    </div>
                    
                    <div class="mb-3 border-top border-dark pt-3">
                        <a class="text-warning small d-flex justify-content-between align-items-center" data-toggle="collapse" href="#promoCode" role="button" aria-expanded="false" style="text-decoration: none;">
                            Have a promo code? <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse mt-2" id="promoCode">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Enter code">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-outline-warning" type="button">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-total">
                        <span>Total</span>
                        <span class="text-warning">Rp <?php echo $totalPrice; ?>.000</span>
                    </div>

                    <div class="mt-4 mb-4">
                        <h6 class="text-white small font-weight-bold mb-2">Payment Method</h6>
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" id="cod" name="paymentMethod" class="custom-control-input" checked>
                            <label class="custom-control-label text-muted" for="cod">Cash On Delivery (COD)</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="online" name="paymentMethod" class="custom-control-input" disabled>
                            <label class="custom-control-label text-muted" for="online">Online Payment (Maintenance)</label>
                        </div>
                    </div>

                    <button type="button" class="btn-checkout shadow-sm" data-toggle="modal" data-target="#checkoutModal">
                        Checkout Now
                    </button>
                </div>
            </div>
            <?php } ?>
        </div>

    <?php 
    } else {
        echo '<div class="row justify-content-center align-items-center" style="min-height: 400px;">
                <div class="col-md-6 text-center">
                    <i class="fas fa-user-lock mb-3" style="font-size: 4rem; color: #ffc107;"></i>
                    <h3 class="text-white">Please Login First</h3>
                    <p class="text-muted">You need to be logged in to view your cart and place orders.</p>
                    <button class="btn btn-warning rounded-pill px-4 font-weight-bold" data-toggle="modal" data-target="#loginModal">Login Now</button>
                </div>
              </div>';
    }
    ?>
    </div>

    <?php require 'partials/_checkoutModal.php'; ?>
    <?php require 'partials/_footer.php' ?>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>         
    
    <script>
        // 1. Update QTY
        function updateQty(id, change) {
            var inputField = document.getElementById("qtyInput" + id);
            var currentVal = parseInt(inputField.value);
            var newVal = currentVal + change;
            
            if(newVal < 1) return;
            inputField.value = newVal;

            $.ajax({
                url: 'partials/_manageCart.php',
                type: 'POST',
                data: $("#frm"+id).serialize(),
                success: function(res) {
                    location.reload(); 
                }
            });
        }

        // 2. Remove Single Item (AJAX)
        function removeItem(pizzaId) {
            if(confirm('Are you sure you want to remove this item?')) {
                $.ajax({
                    url: 'partials/_manageCart.php',
                    type: 'POST',
                    // Kirim data persis seperti yang diharapkan PHP (name="removeItem")
                    data: {
                        removeItem: true, 
                        itemId: pizzaId
                    },
                    success: function(res) {
                        // Paksa reload halaman setelah sukses
                        location.reload();
                    },
                    error: function() {
                        alert('Error removing item. Please try again.');
                    }
                });
            }
        }

        // 3. Remove All Items (AJAX)
        function removeAllItems(userId) {
            if(confirm('Are you sure you want to delete ALL items in cart?')) {
                $.ajax({
                    url: 'partials/_manageCart.php',
                    type: 'POST',
                    data: {
                        removeAllItem: true, 
                        userId: userId
                    },
                    success: function(res) {
                        location.reload();
                    }
                });
            }
        }
    </script>
</body>
</html>