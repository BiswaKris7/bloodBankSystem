// This file uses an html form to get a user's submission and validate their inputted credentials using the database.

<?php
include 'connect2DB.php'; // Must include connect2DB.php in order to connect to the database.

    $invalidHCN = false; // Variable meant to indicate if the entered credentials are valid.

    if ($_SERVER['REQUEST_METHOD'] === "POST") { // If 
        
        $conn = OpenConnection(); // Open connection to the database.

        $healthCardNum = $_POST['healthCardNum']; // Store the username from the POST global array (user input collection) into healthCardNum.

        $view1 = sprintf("SELECT * FROM donor  
                          WHERE healthCardNum='%s'",
                          $conn->real_escape_string($healthCardNum)); // Query instructions which fetches any results (tuples) that matches the inputted username.
        
        $view1Result = $conn->query($view1); // Connect to the database, execute the query, and store the results into the database. 
        $user = $view1Result->fetch_assoc(); // Store the query result in an array.

        if ($user){ // If a match was found...

            session_start(); // Start a session to keep the user's information between pages.
            session_regenerate_id(); // Regenerate session id

            $_SESSION["userID"] = $user["healthCardNum"]; // Store the username in the SESSION global array under the name "userID"

            header('Location: index.php'); // Redirect user to home page.
            exit; // Exit from this script (rest of it does not execute).
        }

        $invalidHCN = true; // If the script makes it this far (doesn't exit), then the credentials were incorrect and this variable is set to true.

        CloseConnection($conn); // Close the connection to the database.
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>login</title>
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
    body {font-family: Arial, Helvetica, sans-serif;}
    form {border: 3px solid #f1f1f1;}

    input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      background-color: #04AA6D;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    form {
      background: #f3dddd;
    }

    button:hover {
      opacity: 0.8;
    }

    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }

    .imgcontainer {
      text-align: center;
      margin: 24px 0 12px 0;
    }

    img.avatar {
      width: 40%;
      border-radius: 50%;
    }

    .container {
      padding: 16px;
      width: 50%;
      height: 50%;
    }

    span.psw {
      float: right;
      padding-top: 16px;
    }



    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }
      .cancelbtn {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <h1 class="text-light"><span style="margin-left:15px ;">CANADIAN BLOOD DONORS</span></a></h1>
    <div class="container d-flex justify-content-between align-items-center">
  </header><!-- End Header -->

  <div class="container col-md-auto" style="margin-left:375px; margin-top: 5%;" style="background-color: pink;">
    <div style="text-align:center;">
      <h2>Login Form</h2>
    </div>

    <form method="post">
      <div class="imgcontainer">
        <img src="picture8.PNG" alt="Avatar" class="avatar">
      </div>

      <div class="container" style="margin-left:175px;">
        <label for="uname">
          <div> 
            <span style="text-align:center; margin: left 50px; ;">Health Card Number</span>
          </div>
        </label>

        <!-- Saves previous entry in input space/bar-->
        <input type="text" placeholder="Enter Health Card Number" name="healthCardNum" value="<?= htmlspecialchars($healthCardNum ?? "") ?>" required> 



        <button type="submit" style="text-align: center;">Login</button>

    </form>
  </div>

    <?php if ($invalidHCN): ?>  <!-- Embedded php command which checks if the credentials were invalid-->
      <em>Invalid Health Card: Number Not Found In Database.</em>
    <?php endif; ?>

  </body>
</html>