<?php
// Session Start
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

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Profile</title>
    <link rel="icon" href="img/D-logo.jpg" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212; 
            color: #fff;
            padding-top: 100px;
            padding-bottom: 50px;
            min-height: 100vh;
        }

        /* Profile Cards */
        .profile-card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            margin-bottom: 30px;
        }

        .profile-img-container {
            position: relative;
            width: 180px;
            height: 180px;
            margin: 0 auto 20px;
        }

        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #ffc107; /* Border Kuning */
            padding: 3px;
            background-color: #1e1e1e;
        }

        /* Form Styling */
        .form-label {
            font-weight: 600;
            color: #ffc107;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            background-color: #2d2d2d;
            border: 1px solid #444;
            color: #fff;
            border-radius: 8px;
            height: 45px;
        }

        .form-control:focus {
            background-color: #333;
            border-color: #ffc107;
            color: #fff;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }
        
        .form-control:disabled {
            background-color: #222;
            color: #888;
        }

        /* Buttons */
        .btn-theme {
            background-color: #ffc107;
            color: #000;
            font-weight: 700;
            border-radius: 50px;
            border: none;
            padding: 10px 30px;
            transition: 0.3s;
        }

        .btn-theme:hover {
            background-color: #fff;
            color: #000;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }

        .btn-danger-custom {
            background-color: transparent;
            border: 2px solid #dc3545;
            color: #dc3545;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-danger-custom:hover {
            background-color: #dc3545;
            color: #fff;
        }

        /* File Upload Styling */
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-upload {
            border: 2px dashed #ffc107;
            color: #ffc107;
            background-color: transparent;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        
        .btn-upload:hover {
            background-color: #ffc107;
            color: #000;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

        /* 404 / Not Logged In Styling */
        #notfound {
            position: relative;
            height: 60vh;
        }
        .notfound {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .notfound h1 {
            font-size: 100px;
            font-weight: 900;
            margin: 0;
            color: #333;
            text-shadow: 2px 2px 0px #ffc107;
        }
        .notfound h2 {
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
            color: #fff;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .notfound a {
            font-weight: 700;
            text-decoration: none;
            background-color: #ffc107;
            color: #000;
            padding: 10px 30px;
            border-radius: 40px;
            transition: 0.3s;
        }
        .notfound a:hover {
            background-color: #fff;
        }

    </style>

</head>
<body>
    <?php require 'partials/_nav.php' ?>
    
    <?php if($loggedin) { ?>
    
    <div class="container">
        <?php 
            $sql = "SELECT * FROM users WHERE id='$userId'"; 
            $result = mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
            $username = $row['username'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $phone = $row['phone'];
            $userType = ($row['userType'] == 0) ? "User" : "Admin";
        ?>
        
        <div class="row">
            <div class="col-md-4">
                <div class="profile-card text-center">
                    <div class="profile-img-container">
                        <img class="profile-img" src="img/person-<?php echo $userId; ?>.jpg" onError="this.src = 'img/profilePic.jpg'">
                    </div>
                    
                    <h4 class="font-weight-bold"><?php echo $username; ?></h4>
                    <p class="text-muted mb-4"><?php echo $userType; ?></p>

                    <form action="partials/_manageProfile.php" method="POST" enctype="multipart/form-data">
                        <div class="upload-btn-wrapper mb-2">
                            <button class="btn-upload"><i class="fas fa-camera mr-1"></i> Change Photo</button>
                            <input type="file" name="image" id="image" accept="image/*">
                        </div>
                        <button type="submit" name="updateProfilePic" class="btn btn-sm btn-success d-block mx-auto mt-2" style="border-radius: 20px;">Save Photo</button>
                    </form>

                    <form action="partials/_manageProfile.php" method="POST" class="mt-3">
                        <button type="submit" class="btn btn-sm text-danger" name="removeProfilePic" style="background:none; border:none; text-decoration:underline;">
                            Remove Photo
                        </button>
                    </form>

                    <hr style="border-color: #333; margin: 25px 0;">

                    <a href="partials/_logout.php" class="btn btn-danger-custom btn-block">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </div>

            <div class="col-md-8">
                <div class="profile-card">
                    <h3 class="font-weight-bold mb-4" style="color: #ffc107;">Edit Profile</h3>
                    
                    <form action="partials/_manageProfile.php" method="post">
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control" id="username" name="username" type="text" disabled value="<?php echo $username ?>">
                            <small class="text-muted">Username cannot be changed.</small>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required value="<?php echo $firstName ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" required value="<?php echo $lastName ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required value="<?php echo $email ?>">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #333; border-color: #444; color: #ffc107;">+62</span>
                                    </div>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="8123xxxx" required pattern="[0-9]{10,13}" value="<?php echo $phone ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password" class="form-label">Confirm Password</label>    
                                <input class="form-control" id="password" name="password" placeholder="Enter Password to Save" type="password" required minlength="4">
                                <small class="text-muted">Required to save changes.</small>
                            </div>
                        </div>
                        
                        <div class="text-right mt-4">
                            <button type="submit" name="updateProfileDetail" class="btn btn-theme">
                                <i class="fas fa-save mr-2"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        }
        else {
            // Tampilan jika belum login (404 style dark)
            echo '<div id="notfound">
                    <div class="notfound">
                        <h1>Oops!</h1>
                        <h2>404 - Page not found</h2>
                        <p class="text-muted mb-4">The page you are looking for might have been removed or is temporarily unavailable.</p>
                        <a href="index.php">Go To Homepage</a>
                    </div>
                </div>';
        }
    ?>
    
    <?php require 'partials/_footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    
    <script>
        // Script untuk mengubah teks tombol saat file dipilih
        $('#image').change(function() {
            var file = ($('#image')[0].files[0].name).substring(0, 15) + "...";
            $(this).prev('.btn-upload').html('<i class="fas fa-check mr-1"></i> ' + file);
        });
    </script>

</body>
</html>