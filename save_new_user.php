<?php

// user is trying to post data to the server so use $POST statement
if( $_POST )
{

  // create connection to the database

  $servername = "localhost";
  $username = "team";
  $password = "CQqN4N3sEHPfrLTU";
  $dbname = "AUCTION";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // deal with fail conenction case
  // if ($conn->connect_error) {
  //   die("Connection failed: " . $conn->connect_error);
  //   } 

  if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

    $users_first = mysqli_real_escape_string ($conn, $_POST['fName']);
    $users_last = mysqli_real_escape_string ($conn, $_POST['lName']);
    $users_username = mysqli_real_escape_string ($conn, $_POST['username']);
    $users_password = mysqli_real_escape_string ($conn, $_POST['password']);
    $users_gender = mysqli_real_escape_string ($conn, $_POST['gender']); 
    $users_age = mysqli_real_escape_string ($conn, $_POST['age']);
    $users_address = mysqli_real_escape_string ($conn, $_POST['address']);
    $users_email = mysqli_real_escape_string ($conn, $_POST['email']);
    $users_payment = mysqli_real_escape_string ($conn, $_POST['card']);

//sql queries for inserting user data into users table

$sql = "INSERT INTO users(user_fname, user_lname, username, password, user_gender, 
  user_age, user_address, user_email, user_payment, rating_id) 
VALUES ('$users_first', '$users_last',''$users_username','$users_password','$users_gender',
  '$users_age','$users_address','$users_email','$users_payment')";

$result = mysqli_query($conn, $sql);

if (!$result) 
{
    die('Invalid query: ' . mysqli_error($conn));
}
else
{
    echo "Success";
}

mysqli_close($conn);

// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();

?>