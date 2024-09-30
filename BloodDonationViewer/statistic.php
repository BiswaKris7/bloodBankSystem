<?php
include 'connect2DB.php';

  session_start();
  
  if (isset($_SESSION["userID"])) {

    $conn = OpenConnection();
    
    $view2 = "SELECT * FROM donor
              WHERE healthCardNum = {$_SESSION["userID"]}";
    
    $view2Result = $conn->query($view2);

    $user = $view2Result->fetch_assoc();

    $view7 = 'SELECT * FROM donation, donor
              WHERE donation.donorNum = "'.$user["DonorNum"].'"';

    $view7Result = $conn->query($view7);
    $row = mysqli_fetch_array($view7Result);
    $amountDonated = $row["donationAmount"];

    $view8 = 'SELECT hospitalNm FROM hospital
              WHERE hospitalNum = ANY (SELECT hospitalNum FROM storage, donation
                                    WHERE storage.donationNum = donation.donationNum
                                    AND donation.donorNum = "'.$user["DonorNum"].'")
              GROUP BY hospitalNm';

    $view8Result = $conn->query($view8);
    $row = mysqli_fetch_array($view8Result);
    $hospitalName = $row["hospitalNm"];

    $view9 = 'SELECT donationUsed FROM storage, donation
              WHERE storage.donationNum = donation.donationNum
              AND donation.donorNum = "'.$user["DonorNum"].'"';

    $view9Result = $conn->query($view9);
    $row = mysqli_fetch_array($view9Result);
    
    $donationUsed;
    if ($row["donationUsed"] == 1) {
      $donationUsed = "Yes";
    } else {
      $donationUsed = "No";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>statistic</title>
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
          <li><a href="information.php">Donor Information</a></li>
          <li><a class="active" href="statistic.php">Blood Statistics</a></li>
          <li><a href="available.php">Blood Availability</a></li>       
          <li><a href="contact.php">Contact</a></li>
          <li><a href="login.php">Log Out</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
  <!-- End Header -->







  <main id="main">





  <!-- ======= Our Services Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Statistic</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Statistic</li>
          </ol>
        </div>

      </div>
    </section><!-- End Our Services Section -->



    <div class="container">
    <table style="margin-top: 3rem;" class="table table-striped">
   
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Blood Type: </td>
          <td> <?=$user['bloodType']?> </td>
 
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Last Donation: </td>
          <td><?=$user['lastDonationDt']?></td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Donation Renewal Day: </td>
          <td><?=$_SESSION["renewalDonationDate"]?></td>
        </tr>
        <tr>
          <th scope="row">4</th>
          <td>Amount Donated: </td>
          <td><?=$amountDonated?> L</td>
        </tr>
        <tr>
          <th scope="row">5</th>
          <td>Hospital With Donation: </td>
          <td><?=$hospitalName?></td>
        </tr>
        <tr>
          <th scope="row">6</th>
          <td>Donation Used: </td>
          <td><?=$donationUsed?></td>
        </tr>
      </tbody>
    </table>
    </div>

  </main><!-- End #main -->

  <!------------------------------------------------------------->
 <!-- ======= Footer ======= -->
 <div class="fixed-bottom">
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