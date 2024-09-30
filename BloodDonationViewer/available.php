<?php
include 'connect2DB.php';

  session_start();
  
  if (isset($_SESSION["userID"])) {

    $conn = OpenConnection();
    
    $view2 = "SELECT * FROM donor
              WHERE healthCardNum = {$_SESSION["userID"]}";
    
    $view2Result = $conn->query($view2);

    $user = $view2Result->fetch_assoc();

    $view10 = 'SELECT SUM(donationAmount) FROM donation
               WHERE donation.bloodType = "A+"';

    $view10Result = $conn->query($view10);
    $row = mysqli_fetch_array($view10Result);
    $bloodAvailableA1 = $row["SUM(donationAmount)"];

    $view11 = 'SELECT SUM(donationAmount) FROM donation
               WHERE donation.bloodType = "A-"';

    $view11Result = $conn->query($view11);
    $row = mysqli_fetch_array($view11Result);
    $bloodAvailableA2 = $row["SUM(donationAmount)"];

    $view12 = 'SELECT SUM(donationAmount) FROM donation
               WHERE donation.bloodType = "B+"';

    $view12Result = $conn->query($view12);
    $row = mysqli_fetch_array($view12Result);
    $bloodAvailableB1 = $row["SUM(donationAmount)"];

    $view13 = 'SELECT SUM(donationAmount) FROM donation
               WHERE donation.bloodType = "B-"';

    $view13Result = $conn->query($view13);
    $row = mysqli_fetch_array($view13Result);
    $bloodAvailableB2 = $row["SUM(donationAmount)"];

    $view14 = 'SELECT SUM(donationAmount) FROM donation
               WHERE donation.bloodType = "AB+"';

    $view14Result = $conn->query($view14);
    $row = mysqli_fetch_array($view14Result);
    $bloodAvailableAB1 = $row["SUM(donationAmount)"];

    $view15 = 'SELECT SUM(donationAmount) FROM donation
               WHERE donation.bloodType = "AB-"';

    $view15Result = $conn->query($view15);
    $row = mysqli_fetch_array($view15Result);
    $bloodAvailableAB2 = $row["SUM(donationAmount)"];

    $view16 = 'SELECT SUM(donationAmount) FROM donation
               WHERE donation.bloodType = "O+"';

    $view16Result = $conn->query($view16);
    $row = mysqli_fetch_array($view16Result);
    $bloodAvailableO1 = $row["SUM(donationAmount)"];

    $view17 = 'SELECT SUM(donationAmount) FROM donation
               WHERE donation.bloodType = "O-"';

    $view17Result = $conn->query($view17);
    $row = mysqli_fetch_array($view17Result);
    $bloodAvailableO2 = $row["SUM(donationAmount)"];

    $view18 = 'SELECT DISTINCT donation.bloodType FROM donation INNER JOIN patient ON donation.donationAmount <= patient.litresNeeded'; 
    $view18Result = $conn->query($view18);
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>available</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    .circle {
      width:300px;
      height:250px;
      background:#8216167a;
      margin-bottom:0;
      border-radius:30%;
      position: relative;
    }

    .circleContent {
      position: absolute;
      width: inherit;
      height: auto;
      top: 50%;
      transform: translateY(-50%);
      text-align: center;
      color: #fff;
    }
  </style>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.html"><span>Canadian Blood Donors</span></a></h1>
     
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="" href="index.php">Home</a></li>
          <li><a href="information.php">Donor Information</a></li>
          <li><a href="statistic.php">Blood Statistics</a></li>
          <li><a class="active" href="available.php">Blood Availability</a></li>         
          <li><a href="contact.php">Contact</a></li>
          <li><a href="login.php">Log Out</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
  <!-- End Header -->

  <main id="main">


    <!-- ======= Our Portfolio Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Available</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Available</li>
          </ol>
        </div>

      </div>
    </section><!-- End Our Portfolio Section -->



    <div class="container" >

      <div class="jumbotron" style="background-color: rgba(255, 255, 255, 0.41);">
        <h1 class="display-4">Available Blood For Patient</h1>
        <div class="row Bg-0 position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
              <div class="circle">
          <div class="circleContent">
            <h1><?=$_SESSION["totalBloodRatio"]?>%</h1>
            <h5>Ratio of Total Blood Currently Available to Patients</h5>
          </div>
        </div> 
        <hr class="my-4">
        <p>Help save life with your donation</p>
      </div>

      <table style="margin-top: 3rem;" class="table table-striped">

        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Blood Type</th>
            <th scope="col">Blood Available</th>
          </tr>
        </thead>
     
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>A+ </td>
            <td><?=$bloodAvailableA1?> L</td>
   
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>A- </td>
            <td><?=$bloodAvailableA2?> L</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>B+</td>
            <td><?=$bloodAvailableB1?></td>
          </tr>
          <tr>
            <th scope="row">4</th>
            <td>B-</td>
            <td><?=$bloodAvailableB2?> L</td>
          </tr>
          <tr>
            <th scope="row">5</th>
            <td>AB+ </td>
            <td><?=$bloodAvailableAB1?> L</td>
          </tr>
          <tr>
            <th scope="row">6</th>
            <td>AB- </td>
            <td><?=$bloodAvailableAB2?> L</td>
          </tr>
          <tr>
            <th scope="row">7</th>
            <td>O+ </td>
            <td><?=$bloodAvailableO1?></td>
          </tr>
          <tr>
            <th scope="row">8</th>
            <td>O- </td>
            <td><?=$bloodAvailableO2?></td>
          </tr>
         
        </tbody>
      </table>
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Blood Type Currently In Demand:</h1>
          <?php while ($row = $view18Result->fetch_assoc()){
            echo $row["bloodType"] . ", ";
          } ?>
          <h1 class="display-6"></h1>
        </div>
      </div>
      </div>
  </main><!-- End #main -->

 <!-- ======= Footer ======= -->
 <div >
<footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">

  <div class="footer-newsletter">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h4>CANADIAN BLOOD DONORS</h4>
          <p>Thank you for your donation.</p>
        </div>
      </div>
    </div>
  </div>
    </div>
  </div>
</footer>
 </div>
<!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>