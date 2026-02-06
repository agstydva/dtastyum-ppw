<?php
// PERBAIKAN: Session dimulai paling atas sebelum kode HTML apapun
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'partials/_dbconnect.php';

// Cek status login
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
    
    <title>Contact Us</title>
    <link rel="icon" href="img/D-logo.jpg" type="image/x-icon">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212; /* Background Gelap Premium */
            color: #fff;
            padding-top: 80px; /* Jarak untuk navbar fixed */
            overflow-x: hidden;
        }

        /* Container Card */
        .contact-wrap {
            background: #1e1e1e;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.5);
            overflow: hidden;
            margin: 40px auto;
            max-width: 1100px;
        }

        /* Bagian Kiri: Info (Kuning) */
        .contact-info-section {
            background-color: #ffc107;
            color: #121212;
            padding: 50px;
            position: relative;
            z-index: 1;
        }
        
        /* Dekorasi background halus */
        .contact-info-section::after {
            content: "";
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(0,0,0,0.05);
            border-radius: 50%;
            z-index: -1;
        }

        .contact-info-title {
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 20px;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        .info-icon {
            font-size: 1.4rem;
            margin-right: 15px;
            margin-top: 4px;
            color: #121212;
            width: 25px; /* Lebar fix agar teks rata */
            text-align: center;
        }

        /* Social Links */
        .social-links a {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 45px;
            height: 45px;
            background: #121212;
            color: #ffc107;
            border-radius: 50%;
            margin-right: 10px;
            transition: 0.3s;
            text-decoration: none;
            font-size: 1.2rem;
        }

        .social-links a:hover {
            background: #fff;
            color: #121212;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Bagian Kanan: Form (Gelap) */
        .contact-form-section {
            background-color: #1e1e1e;
            padding: 50px;
        }

        .form-title {
            color: #ffc107;
            font-weight: 700;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        /* Input Styling */
        .modern-input {
            background: transparent;
            border: none;
            border-bottom: 2px solid #444;
            border-radius: 0;
            color: #fff;
            padding: 15px 5px;
            height: auto;
            transition: 0.3s;
        }

        .modern-input:focus {
            background: transparent;
            border-color: #ffc107;
            box-shadow: none;
            color: #fff;
            outline: none;
        }
        
        /* Fix auto-fill background color in Chrome */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus {
          -webkit-text-fill-color: #fff;
          -webkit-box-shadow: 0 0 0px 1000px #1e1e1e inset;
          transition: background-color 5000s ease-in-out 0s;
        }

        .modern-input::placeholder {
            color: #666;
        }

        .input-group-text {
            background: transparent;
            border: none;
            border-bottom: 2px solid #444;
            color: #ffc107;
            font-weight: bold;
        }

        /* Tombol */
        .btn-send {
            background: #ffc107;
            color: #000;
            font-weight: 700;
            padding: 12px 40px;
            border-radius: 50px;
            border: none;
            letter-spacing: 1px;
            transition: 0.3s;
            text-transform: uppercase;
        }

        .btn-send:hover {
            background: #fff;
            color: #000;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
            transform: translateY(-2px);
        }
        
        .btn-history {
            background: transparent;
            border: 2px solid #ffc107;
            color: #ffc107;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            margin-left: 10px;
            transition: 0.3s;
        }
        
        .btn-history:hover {
            background: #ffc107;
            color: #000;
            text-decoration: none;
        }

        /* Notifikasi Badge */
        .msg-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545; /* Merah */
            color: white;
            border-radius: 50%;
            padding: 4px 7px;
            font-size: 0.75rem;
            font-weight: bold;
            border: 2px solid #1e1e1e;
        }
        
        /* Modal Style */
        .modal-content {
            background: #1e1e1e;
            color: #fff;
            border: 1px solid #333;
        }
        .modal-header {
            border-bottom: 1px solid #333;
        }
        .table-dark-custom {
            background-color: #252525;
            color: #e0e0e0;
        }
        .table-dark-custom th {
            color: #ffc107;
            border-top: none;
        }
        .table-dark-custom td {
            border-top: 1px solid #333;
        }
    </style>
  </head>
  <body>
  
  <?php include 'partials/_nav.php';?>

  <div class="container">
    <div class="row contact-wrap">
        
        <div class="col-lg-5 contact-info-section">
            <h2 class="contact-info-title">Let's Talk About Food</h2>
            <p class="mb-5">Ada pertanyaan seputar menu, pesanan, atau ingin kerjasama? Hubungi kami langsung!</p>
            
            <?php
                $sql = "SELECT * FROM `sitedetail`";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $address = $row['address'];
                $emailSite = $row['email'];
                $contact1 = $row['contact1'];
            ?>

            <div class="info-item">
                <i class="fas fa-map-marker-alt info-icon"></i>
                <span><?php echo $address; ?></span>
            </div>
            
            <div class="info-item">
                <i class="fas fa-phone-alt info-icon"></i>
                <span><?php echo $contact1; ?></span>
            </div>
            
            <div class="info-item">
                <i class="fas fa-envelope info-icon"></i>
                <span><?php echo $emailSite; ?></span>
            </div>

            <div class="social-links mt-4">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>

        <div class="col-lg-7 contact-form-section">
            <div class="d-flex justify-content-between align-items-start">
                <h3 class="form-title">Send Message</h3>
                
                <?php if($loggedin){ ?>
                    <div style="position: relative; margin-top: 5px;">
                         <a href="#" data-toggle="modal" data-target="#adminReply" class="text-warning" style="font-size: 1.5rem;">
                             <i class="fas fa-bell"></i>
                             <span class="msg-badge" id="totalMessage">0</span>
                         </a>
                    </div>
                <?php } ?>
            </div>

            <?php
                // Pre-fill data jika user login
                $userEmail = "";
                $userPhone = "";
                if($loggedin){
                    $passSql = "SELECT * FROM users WHERE id='$userId'"; 
                    $passResult = mysqli_query($conn, $passSql);
                    if($passResult){
                        $passRow = mysqli_fetch_assoc($passResult);
                        $userEmail = $passRow['email'];
                        $userPhone = $passRow['phone'];
                    }
                }
            ?>

            <form action="partials/_manageContactUs.php" method="POST">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="email" class="form-control modern-input" id="email" name="email" placeholder="Your Email" required value="<?php echo $userEmail ?>">
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+62</span>
                            </div>
                            <input type="tel" class="form-control modern-input" id="phone" name="phone" placeholder="Phone Number" required pattern="[0-9]+" value="<?php echo $userPhone ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <input class="form-control modern-input" type="text" id="orderId" name="orderId" placeholder="Order ID (Optional)" value="">
                    </div>
                    <div class="col-md-6 form-group">
                        <input class="form-control modern-input" id="password" name="password" type="password" placeholder="Confirm Password" required>
                    </div>
                </div>
                
                <div class="form-group mt-3">
                    <textarea class="form-control modern-input" id="message" name="message" rows="3" required minlength="6" placeholder="Write your message here..."></textarea>
                </div>

                <div class="mt-4">
                    <?php if($loggedin){ ?>
                        <button type="submit" class="btn btn-send">Submit <i class="fas fa-paper-plane ml-2"></i></button>
                        <button type="button" class="btn btn-history" data-toggle="modal" data-target="#history">History</button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-send" style="opacity: 0.5; cursor: not-allowed;" disabled>Submit</button>
                        <p class="text-muted mt-2 small"><i class="fas fa-lock text-warning"></i> Please login to contact us.</p>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
  </div>

  <div class="modal fade" id="adminReply" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-warning">Inbox Messages</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-0">
            <div class="table-responsive">
              <table class="table table-dark-custom mb-0 text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    if($loggedin){
                        $sql = "SELECT * FROM `contactreply` WHERE `userId`='$userId'"; 
                        $result = mysqli_query($conn, $sql);
                        $count = 0;
                        if($result){
                            while($row=mysqli_fetch_assoc($result)) {
                                $contactId = $row['contactId'];
                                $message = $row['message'];
                                $datetime = $row['datetime'];
                                $count++;
                                echo '<tr>
                                        <td>' .$contactId. '</td>
                                        <td>' .$message. '</td>
                                        <td>' .$datetime. '</td>
                                      </tr>';
                            }
                        }
                        // Update badge notification via JS
                        echo '<script>
                                var badge = document.getElementById("totalMessage");
                                if(badge) badge.innerHTML = "' .$count. '";
                              </script>';
                        
                        if($count==0) echo '<tr><td colspan="3" class="text-muted py-3">No messages yet.</td></tr>';
                    }
                ?>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-warning">Sent History</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-0">
            <div class="table-responsive">
              <table class="table table-dark-custom mb-0 text-center">
                <thead>
                    <tr>
                        <th>Contact ID</th>
                        <th>Order ID</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    if($loggedin){
                        $sql = "SELECT * FROM `contact` WHERE `userId`='$userId'"; 
                        $result = mysqli_query($conn, $sql);
                        $count = 0;
                        if($result){
                            while($row=mysqli_fetch_assoc($result)) {
                                $contactId = $row['contactId'];
                                $orderId = $row['orderId'];
                                $message = $row['message'];
                                $datetime = $row['time'];
                                $count++;
                                echo '<tr>
                                        <td>' .$contactId. '</td>
                                        <td>' .$orderId. '</td>
                                        <td class="text-left">' .$message. '</td>
                                        <td>' .$datetime. '</td>
                                      </tr>';
                            }
                        }                
                        if($count==0) echo '<tr><td colspan="4" class="text-muted py-3">No sent messages found.</td></tr>';
                    }
                ?>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>

    <?php require 'partials/_footer.php'; ?>
  </body>
</html>