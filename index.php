<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <title>Home</title>
    <link rel = "icon" href ="img/D-logo.jpg" type = "image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">

    <style>
      .category-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        background: #fff;
      }
      .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
      }
      .img-wrapper {
        overflow: hidden;
        height: 200px; /* Tinggi gambar seragam */
        position: relative;
      }
      .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
      }
      .category-card:hover .img-wrapper img {
        transform: scale(1.1); /* Efek zoom saat hover */
      }
      .card-title a {
        text-decoration: none;
        color: #333;
        font-weight: 700;
      }
      .card-title a:hover {
        color: #ffc107; /* Warna warning bootstrap */
      }
      .section-header h2 {
        font-weight: 700;
        position: relative;
        padding-bottom: 15px;
        text-transform: uppercase;
        color: #444;
      }
      .section-header h2::after {
        content: '';
        position: absolute;
        display: block;
        width: 60px;
        height: 3px;
        background: #ffc107;
        bottom: 0;
        left: calc(50% - 30px);
      }
    </style>

  </head>
  <body>
  <?php include 'partials/_dbconnect.php';?>
  <?php include 'partials/_nav.php';?>
  
      <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <div class="carousel-background"><img src="assets/img/slide/slide-6.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Dtastyum</span></h2>
                <p class="animate__animated animate__fadeInUp">From Our Kitchen to Your Table, Fresh Every Time.</p>
                <a href="index.php" class="btn-get-started animate__animated animate__fadeInUp scrollto">Get Started</a>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="carousel-background"><img src="assets/img/slide/slide-10.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown mb-0">Our Mission</h2>
                <p class="animate__animated animate__fadeInUp">Where Every Meal Feels Like Home</p>
                <a href="index.php" class="btn-get-started animate__animated animate__fadeInUp scrollto">Get Started</a>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="carousel-background"><img src="assets/img/slide/slide-9.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown mb-0">Dtastyum</h2><p>Instagram : <a href="https://github.com/darshankparmar" target="_blank">@dtastyum</a></p>
                <a href="index.php" class="btn-get-started animate__animated animate__fadeInUp scrollto">Get Started</a>
              </div>
            </div>
          </div>
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon icofont-thin-double-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon icofont-thin-double-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><div class="container my-5">
    <div class="col-12 text-center my-5 section-header">     
      <h2>Explore Categories</h2>
      <p class="text-muted mt-2">Discover our delicious range of food carefully prepared for you.</p>
    </div>
    
    <div class="row">
      <?php 
        $sql = "SELECT * FROM `categories`"; 
        $result = mysqli_query($conn, $sql);
        
        while($row = mysqli_fetch_assoc($result)){
          $id = $row['categorieId'];
          $cat = $row['categorieName'];
          $desc = $row['categorieDesc'];

          // Output Card Modern
          echo '
          <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 border-0 shadow-sm category-card">
              <div class="img-wrapper">
                 <img src="img/card-'.$id. '.jpg" class="card-img-top" alt="image for '.$cat.'">
              </div>
              <div class="card-body d-flex flex-column text-center pt-3 pb-4">
                <h5 class="card-title mb-2"><a href="viewPizzaList.php?catid=' . $id . '">' . $cat . '</a></h5>
                <p class="card-text text-muted small mb-3">' . substr($desc, 0, 45). '...</p>
                <div class="mt-auto w-100">
                    <a href="viewPizzaList.php?catid=' . $id . '" class="btn btn-warning rounded-pill btn-block font-weight-bold shadow-sm">View Menu</a>
                </div>
              </div>
            </div>
          </div>';
        }
      ?>
    </div>
  </div>
  <main id="main">

  <?php include 'partials/_footer.php';?> 

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></link>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counterup/counterup.min.js"></script>

    <script src="assets/js/main.js"></script>

    <script> 
        // Note: Pastikan variabel $catname terdefinisi di PHP sebelum baris ini dipanggil, 
        // atau script ini mungkin error di console jika $catname kosong.
        // Jika ini halaman index/home, biasanya $catname belum ada isinya.
        // Saya biarkan sesuai request "jangan rubah code penting".
        <?php if(isset($catname)) { ?>
          document.getElementById("title").innerHTML = "<?php echo $catname; ?>"; 
          document.getElementById("catTitle").innerHTML = "<?php echo $catname; ?>"; 
        <?php } ?>
    </script> 

  </body>
</html>