<?php
include 'connect2DB.php';

  session_start();
  
  if (isset($_SESSION["userID"])) {

    $conn = OpenConnection();
    
    $view2 = "SELECT * FROM donor
              WHERE healthCardNum = {$_SESSION["userID"]}";
    
    $view2Result = $conn->query($view2);

    $user = $view2Result->fetch_assoc();

    $donateMSG;
    $dateDiff = floor((time() - (strtotime($user["lastDonationDt"])))/(60*60*24));
    $renewalDate = $dateDiff + time();
    $_SESSION["renewalDonationDate"] = date("Y-m-d", $renewalDate);

    if ($dateDiff > 84)  {
      $donateMSG = "You are elegible to donate!";
    } else {
      $timeLeft = 84 - $dateDiff;
      $donateMSG = "You are not elegible to donate."; 
    }

    $view3 = "SELECT SUM(litresNeeded) FROM patient";
    $view3Result = $conn->query($view3);
    $row = mysqli_fetch_array($view3Result);
    $totalBloodNeeded = $row["SUM(litresNeeded)"];

    $view4 = "SELECT SUM(donationAmount) FROM donation";
    $view4Result = $conn->query($view4);
    $row = mysqli_fetch_array($view4Result);
    $totalBloodSupply = $row["SUM(donationAmount)"];

    $totalBloodRatio = number_format((float)(($totalBloodSupply/$totalBloodNeeded)*100), 2, '.', '');
    $_SESSION["totalBloodRatio"] = $totalBloodRatio;
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>
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
      width:400px;
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

  <?php if (!isset($user)) { header('Location: login.php'); } ?>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.php"><span>Canadian Blood Donors</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active " href="index.php">Home</a></li>
          <li><a href="information.php">Donor Information</a></li>
          <li><a href="statistic.php">Blood Statistics</a></li>
          <li><a href="available.php">Blood Availability</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="login.php">Log Out</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-cntent-center align-items-center">
      <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animateanimated animatefadeInDown">Welcome<span> <?= $user["firstNm"] ?> <?= $user["lastNm"] ?>! </span></h2>
          <p class="animateanimated animatefadeInUp"><?= $donateMSG ?></p>


          <div class="row Bg-0 position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
              <div class="circle">
          <div class="circleContent">
            <h1><?= $totalBloodRatio ?>%</h1>
            <h5>Ratio of Total Blood Currently Available to Patients</h5>
          </div>
        </div> 
            </div>

            <div class="col-md-6 p-4 ps-md-0">
              <a href="information.php" class="btn-get-started animateanimated animatefadeInUp">Donor Information</a>
          <a href="statistic.php" class="btn-get-started animateanimated animatefadeInUp">Blood Statistics</a>
          <a href="available.php" class="btn-get-started animateanimated animatefadeInUp">Blood Availability</a>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

     <!-- ======= Team Section ======= -->
      <section class="team" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
      <div class="container">

        <div class="row">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="blood3.jpg" class="img-fluid" alt="">
                <div class="social">
                  <h5 style="color: white;">Blood Lab</h5>
                </div>
              </div>
              <div class="member-info">
                <h4>Lab</h4>
                <span></span>
                <p>As Canadas largest community lab, we are an industry leader in ensuring exceptional quality testing in our state-of-the-art facilities. Driven by a passion to ensure you have critical information about your health, we give you access to the latest diagnostic tests available.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="blood2.jpg" class="img-fluid" alt="">
                <div class="social">
                 <h5 style="color: white;">Red Blood Cell</h5>
                </div>
              </div>
              <div class="member-info">
                <h4>Erythrocytes</h4>
                <span></span>
                <p>Red blood cells, also referred to as red cells, red blood corpuscles, haematids, erythroid cells or erythrocytes, are the most common type of blood cell and the vertebrate's principal means of delivering oxygen to the body tissues—via blood flow through the circulatory system.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="blood4.jpg" class="img-fluid" alt="">
                <div class="social">
                  <h5 style="color: white;">Platelets</h5>
                </div>
              </div>
              <div class="member-info">
                <h4>Thank you</h4>
                <span></span>
                <p>Blood donation is a very kind-hearted act. If today someone is a blood donor, he might be a blood receiver in the futur. So, giving blood and saving someones life is generous work to do therefore appreciating them is an important task to gear up their spirit of donating blood.</p>
              </div>
            </div>
          </div>

       

        </div>

      </div>
    </section><!-- End Team Section --> -->


   

  </main><!-- End #main -->
     <!-- ======= Map Section ======= -->
     <section class="map mt-2">
      <div class="container-fluid p-0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16488.58332295916!2d-78.9176902369961!3d43.93849898245968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d51c73b39b700f%3A0x835d6e8171146631!2sDynacare%20Laboratory%20and%20Health%20Services%20Centre!5e0!3m2!1sen!2sca!4v1669776479388!5m2!1sen!2sca" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </section><!-- End Map Section -->

  </main><!-- End #main -->


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