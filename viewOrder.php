<?php
// PERBAIKAN: Session start di baris paling awal
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'partials/_dbconnect.php';

// Cek Login
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <title>My Orders</title>
    <link rel="icon" href="img/D-logo.jpg" type="image/x-icon">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212; /* Background Gelap */
            color: #fff;
            padding-top: 100px; /* Jarak Navbar */
            padding-bottom: 50px;
        }

        /* Container Table */
        .order-wrapper {
            background: #1e1e1e;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            padding: 30px;
            overflow: hidden;
        }

        /* Header Section */
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .order-title {
            font-weight: 800;
            color: #ffc107;
            text-transform: uppercase;
            font-size: 1.8rem;
            margin: 0;
        }

        /* Tombol Header */
        .btn-header {
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 8px 20px;
            display: inline-flex;
            align-items: center;
            transition: 0.3s;
            border: none;
            text-decoration: none !important;
        }

        .btn-print {
            background: #333;
            color: #ccc;
            margin-right: 10px;
        }
        .btn-print:hover {
            background: #fff;
            color: #000;
        }

        .btn-refresh {
            background: #ffc107;
            color: #000;
        }
        .btn-refresh:hover {
            background: #e0a800;
            color: #000;
            transform: translateY(-2px);
        }

        /* Table Styling (Dark Premium) */
        .table-custom {
            color: #e0e0e0;
            vertical-align: middle;
        }

        .table-custom thead th {
            border-top: none;
            border-bottom: 2px solid #444;
            color: #ffc107; /* Judul Kolom Kuning */
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            padding: 15px;
        }

        .table-custom tbody td {
            border-top: 1px solid #333;
            padding: 15px;
            vertical-align: middle;
            font-size: 0.95rem;
        }

        .table-hover tbody tr:hover {
            background-color: #252525;
            color: #fff;
        }

        /* Tombol Aksi di Tabel (Track & Detail) */
        .btn-icon-action {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            border: none;
            margin: 0 4px;
            cursor: pointer;
        }

        .btn-track {
            background: rgba(23, 162, 184, 0.2);
            color: #17a2b8;
        }
        .btn-track:hover {
            background: #17a2b8;
            color: #fff;
            transform: scale(1.1);
        }

        .btn-detail {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }
        .btn-detail:hover {
            background: #ffc107;
            color: #000;
            transform: scale(1.1);
        }

        /* Payment Mode Badge */
        .badge-cod {
            background: #444;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 500;
            font-size: 0.8rem;
        }
        .badge-online {
            background: #28a745;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 500;
            font-size: 0.8rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px;
        }
        .empty-icon {
            font-size: 5rem;
            color: #333;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    
    <div class="container">
    <?php if($loggedin){ ?>
        
        <div class="order-wrapper">
            <div class="order-header">
                <h2 class="order-title">Order Details</h2>
                <div>
                    <a href="#" onclick="window.print()" class="btn-header btn-print">
                        <i class="fas fa-print mr-2"></i> Print
                    </a>
                    <a href="viewOrder.php" class="btn-header btn-refresh">
                        <i class="fas fa-sync-alt mr-2"></i> Refresh List
                    </a>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-custom table-hover text-center mb-0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th class="text-left">Address</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Track</th>
                            <th>Items</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM `orders` WHERE `userId`= $userId ORDER BY `orderId` DESC";
                            $result = mysqli_query($conn, $sql);
                            $counter = 0;
                            
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $orderId = $row['orderId'];
                                    $address = $row['address'];
                                    $zipCode = $row['zipCode'];
                                    $phoneNo = $row['phoneNo'];
                                    $amount = $row['amount'];
                                    $orderDate = $row['orderDate'];
                                    $paymentMode = $row['paymentMode'];
                                    
                                    // Format Payment Mode
                                    if($paymentMode == 0) {
                                        $paymentLabel = '<span class="badge-cod">Cash on Delivery</span>';
                                    } else {
                                        $paymentLabel = '<span class="badge-online">Online Payment</span>';
                                    }
                                    
                                    $counter++;
                                    
                                    echo '<tr>
                                            <td class="font-weight-bold text-white">#' . $orderId . '</td>
                                            <td class="text-left" title="' . $address . '" style="max-width: 200px;">
                                                ' . substr($address, 0, 25) . '...
                                            </td>
                                            <td>' . $phoneNo . '</td>
                                            <td class="text-warning font-weight-bold">Rp ' . $amount . '.000</td>
                                            <td>' . $paymentLabel . '</td>
                                            <td>' . date("d M Y", strtotime($orderDate)) . '</td>
                                            
                                            <td>
                                                <button class="btn-icon-action btn-track" data-toggle="modal" data-target="#orderStatus' . $orderId . '" title="Track Order Status">
                                                    <i class="fas fa-shipping-fast"></i>
                                                </button>
                                            </td>
                                            
                                            <td>
                                                <button class="btn-icon-action btn-detail" data-toggle="modal" data-target="#orderItem' . $orderId . '" title="View Items">
                                                    <i class="fas fa-list-ul"></i>
                                                </button>
                                            </td>
                                          </tr>';
                                }
                            } else {
                                // Empty State
                                echo '<tr>
                                        <td colspan="8">
                                            <div class="empty-state">
                                                <i class="fas fa-receipt empty-icon"></i>
                                                <h3>No Orders Yet</h3>
                                                <p class="text-muted">You haven\'t placed any orders. Let\'s order some pizza!</p>
                                                <a href="index.php" class="btn btn-warning rounded-pill px-4 mt-3 font-weight-bold">Go to Menu</a>
                                            </div>
                                        </td>
                                      </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php 
    } else {
        // BELUM LOGIN STATE
        echo '<div class="row justify-content-center align-items-center" style="min-height: 400px;">
                <div class="col-md-6 text-center">
                    <i class="fas fa-lock mb-3" style="font-size: 4rem; color: #ffc107;"></i>
                    <h3 class="text-white">Access Denied</h3>
                    <p class="text-muted">Please login to view your order history.</p>
                    <button class="btn btn-warning rounded-pill px-4 font-weight-bold" data-toggle="modal" data-target="#loginModal">Login Now</button>
                </div>
              </div>';
    }
    ?>
    </div>

    <?php 
    include 'partials/_orderItemModal.php';
    include 'partials/_orderStatusModal.php'; // Ini file yang berisi modal tracking (Screenshot 2094)
    require 'partials/_footer.php'
    ?> 
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>