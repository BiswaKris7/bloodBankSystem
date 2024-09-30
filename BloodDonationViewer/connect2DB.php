<!-- This file establishes a connection to the database (phpmyadmin on WAMP server) -->

<?php

// When other scripts utilize this connect2DB.php script, a variable is supposed to equate to this function's execution to open the connection.
function OpenConnection(){
    // Initialize parameters related to the database credentials
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "bloodbanksystem";

    // Establish connection to the database
    $conn = new mysqli($dbhost, //hostname 
                       $dbuser, //username
                       $dbpass, //password
                       $dbname);//database name

    // If there's a connection error, kill the script and print out the connection error.
    if ($conn->connect_errno) {
        die("Connection error: " . $conn->connect_error);
    }

    // Return the connection    
    return $conn;

}

// When other scripts utilize this connect2DB.php script, a variable is supposed to equate to this function's execution to close the connection.
function CloseConnection($conn){
    $conn->close();
}

?>