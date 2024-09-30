<?php
include 'connect2DB.php';

  session_start();
  
  if (isset($_SESSION["userID"])) {

    $conn = OpenConnection();
    
    $view2 = "SELECT * FROM donor
              WHERE healthCardNum = {$_SESSION["userID"]}";
    
    $view2Result = $conn->query($view2);

    $user = $view2Result->fetch_assoc();

    $view5 = "SELECT clinicNm FROM clinic, donation, donor
              WHERE donor.healthCardNum = {$_SESSION["userID"]} 
              AND donation.donorNum = donor.DonorNum 
              AND donation.clinicNum = clinic.clinicNum";

    $view5Result = $conn->query($view5);
    $row = mysqli_fetch_array($view5Result);
    $donatedClinicName = $row["clinicNm"];

    $view6 = 'SELECT firstNm, lastNm, employeeNum FROM employee, clinic
              WHERE clinic.clinicNm = "'.$row["clinicNm"].'"';
    $view6Result = $conn->query($view6);
    $row = mysqli_fetch_array($view6Result);
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Donor Information</title>
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


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.php"><span>Canadian Blood Donors</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="" href="index.php">Home</a></li>
          <li><a class="active" href="information.php">Donor Information</a></li>
          <li><a href="statistic.php">Blood Statistics</a></li>
          <li><a href="available.php">Blood Availability</a></li>          
          <li><a href="contact.php">Contact</a></li>
          <li><a href="login.php">Log Out</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">


    <!-- ======= About Us Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Donor information Input</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Information</li>
          </ol>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= About Us Section ======= -->  
  <div style="margin-top: 3rem;" class="container text-center">
    <div class="row">
      <div class="col">
        <h3>First Name: <?=$user['firstNm']?></h3>
      </div>
      <div class="col">
        <h3>Last Name: <?=$user['lastNm']?></h3>
      </div>
      <div class="col">
        <h3>Health Card: <?=$user['healthCardNum']?></h3>
      </div>
    </div>
  </div>
  <div class="container">
    <table style="margin-top: 3rem;" class="table table-striped">
   
      <tbody>
        <tr>
          <th scope="row"></th>
          <td ><h1 class="display-4">Blood Type: <?=$user['bloodType']?> </h1></td>
 
        </tr>
        <tr>
          <th scope="row"></th>
          <td>Phone Number: <?=$user['phoneNum']?></td>
        </tr>
        <tr>
          <th scope="row"></th>
          <td>Address: <?=$user['address']?></td>
        </tr>
        <tr>
          <th scope="row"></th>
          <td>Clinic Name: <?=$donatedClinicName?></td>
        </tr>
        <tr>
          <th scope="row"></th>
          <td>Employee : <?=$row["firstNm"] ?> <?=$row["lastNm"] ?>, <?=$row["employeeNum"] ?> </td>
        </tr>
      </tbody>
    </table>
    </div>
  </main><!-- End #main -->
  <div >
<!-- ======= Footer ======= -->
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
  <div class="container">
    <div class="copyright">
  
    </div>
    <div class="credits">
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