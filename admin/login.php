<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Admin Login</title>
    <link rel = "icon" href ="/davaweb/img/D-logo.jpg" type = "image/x-icon">

    <style>
        body {
            background: url('/davaweb/assets/img/slide/slide-11.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            color: #fff;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.8);
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(to right, #333, #000);
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo {
            margin: 20px auto;
            width: 120px;
            height: 120px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .logo img {
            width: 70%;
            height: 70%;
        }

        .form-group label {
            font-weight: bold;
            color: #ddd;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-bottom: 1px solid #ff7e5f;
            box-shadow: none;
        }

        .btn-primary {
            background: #ff7e5f;
            border: none;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: #feb47b;
            transform: scale(1.05);
        }

        .alert {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="logo">
                            <img src="/davaweb/img/D-logo.jpg" alt="Logo">
                        </div>
                        Admin Login
                    </div>
                    <div class="card-body">
                        <form action="partials/_handleLogin.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>

                        <?php
                            if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false") {
                                echo '<div class="alert alert-warning text-center mt-3">Invalid Credentials</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
