<?php 
// 1. CEK SESSION
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $userId = $_SESSION['userId'];
  $username = $_SESSION['username'];
}
else{
  $loggedin = false;
  $userId = 0;
}

// 2. CEK KONEKSI DATABASE
if(!isset($conn)){
    include '_dbconnect.php';
}

$sql = "SELECT * FROM `sitedetail`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$systemName = $row['systemName'];

// Menghitung jumlah cart
$count = 0;
if($loggedin) {
    $countsql = "SELECT SUM(`itemQuantity`) FROM `viewcart` WHERE `userId`=$userId"; 
    $countresult = mysqli_query($conn, $countsql);
    if($countresult){
        $countrow = mysqli_fetch_assoc($countresult);      
        $count = $countrow['SUM(`itemQuantity`)'];
    }
}
if(!$count) {
  $count = 0;
}

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-lg py-3">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="img/D-logo.jpg" alt="Logo" style="width:40px; height:40px; border-radius:50%; margin-right:10px; object-fit:cover; border: 2px solid #ffc107;">
      <h4 class="mb-0 font-weight-bold text-warning">'.$systemName.'</h4>
    </a>
    
    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto ml-lg-4">
        <li class="nav-item active">
          <a class="nav-link font-weight-bold text-light" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-weight-bold text-light" href="about.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-weight-bold text-light" href="contact.php">Contact</a>
        </li>
      </ul>

      <form method="get" action="/davaweb/search.php" class="form-inline my-2 my-lg-0 mr-lg-3 w-100" style="max-width: 300px;">
        <div class="input-group w-100">
           <input class="form-control rounded-pill border-0 pl-3" type="search" name="search" id="search" placeholder="Search menu..." aria-label="Search" style="background:#fff;" required>
           <div class="input-group-append" style="margin-left: -40px; z-index: 10;">
              <button class="btn btn-warning text-dark rounded-pill shadow-sm" type="submit" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                 <i class="fas fa-search"></i>
              </button>
           </div>
        </div>
      </form>

      <div class="d-flex align-items-center justify-content-around mt-3 mt-lg-0">';

        // Cart Icon
        echo '<a href="viewCart.php" class="btn btn-link text-light position-relative mr-2" title="My Cart">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
             <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>';
          if($count > 0) {
            echo '<span class="badge badge-warning badge-pill position-absolute text-dark font-weight-bold" style="top: -5px; right: -5px; font-size: 0.6rem;">'.$count.'</span>';
          }
        echo '</a>';

        // Wishlist Icon
        echo '<a href="wishlist.php" class="btn btn-link text-light mr-2" title="Wishlist">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
          </svg>
        </a>';

        // Order Icon
        echo '<a href="viewOrder.php" class="btn btn-link text-light mr-3" title="Your Orders">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box2-fill" viewBox="0 0 16 16">
             <path d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3L2.95.4zM7.5 1v3h1V1h-1zM3.75 1 1.5 4h6V1H3.75zM8.75 1V4h6L12.25 1H8.75zM15 5H1v10h14V5z"/>
          </svg>
        </a>';

        if($loggedin){
          echo '
            <div class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="img/person-' .$userId. '.jpg" class="rounded-circle border border-warning mr-2" onError="this.src = \'img/profilePic.jpg\'" style="width:35px; height:35px; object-fit:cover;">
                <span class="d-none d-md-inline-block font-weight-bold">Hi, ' .$username. '</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow border-0" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="viewProfile.php"><i class="fas fa-user mr-2 text-muted"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="partials/_logout.php"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
              </div>
            </div>';
        }
        else {
          echo '
          <button type="button" class="btn btn-warning rounded-pill px-4 mx-2 font-weight-bold text-dark shadow-sm" data-toggle="modal" data-target="#loginModal">Login</button>
          <button type="button" class="btn btn-outline-warning rounded-pill px-4" data-toggle="modal" data-target="#signupModal">SignUp</button>';
        }
            
  echo '</div>
    </div>
  </div>
</nav>';

    include 'partials/_loginModal.php';
    include 'partials/_signupModal.php';

    // Alerts Logic
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true") {
      echo '<div class="alert alert-success alert-dismissible fade show fixed-top" style="top: 80px; z-index:10000;" role="alert">
              <strong>Success!</strong> You can now login.
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
    if(isset($_GET['error']) && $_GET['signupsuccess']=="false") {
      echo '<div class="alert alert-warning alert-dismissible fade show fixed-top" style="top: 80px; z-index:10000;" role="alert">
              <strong>Warning!</strong> ' .$_GET['error']. '
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
      echo '<div class="alert alert-success alert-dismissible fade show fixed-top" style="top: 80px; z-index:10000;" role="alert">
              <strong>Success!</strong> You are logged in
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
      echo '<div class="alert alert-danger alert-dismissible fade show fixed-top" style="top: 80px; z-index:10000;" role="alert">
              <strong>Warning!</strong> Invalid Credentials
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>