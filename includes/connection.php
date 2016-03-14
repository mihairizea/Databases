<?php

// connect to database
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "AUCTION";
  $conn = new mysqli($servername, $username, $password, $dbname);
// deal with connection failure
  if($conn->connect_errno){
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }

?>
