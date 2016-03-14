<?php require_once("../includes/connection.php") ?>

<?php
//start session before anything else
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../css/favicon.ico">

    <title>Registration</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/semantic.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">

<?php

  // define php variables from name html tags
  $user = mysqli_real_escape_string($conn, $_POST['username']);
  $pass = mysqli_real_escape_string($conn, $_POST['password']);
  $fname = mysqli_real_escape_string($conn, $_POST['fname']);
  $lname = mysqli_real_escape_string($conn, $_POST['lname']);
  $age = mysqli_real_escape_string($conn, $_POST['age']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $card = mysqli_real_escape_string($conn, $_POST['card']);

  // case of empty fields
  if(isset($_POST['signup']))
  {
      if (empty ($user))
      {
         echo "you must enter a username <br />";
      }
      if (empty ($pass))
      {
         echo "you must enter a password <br />";
      }
      if (empty ($fname))
      {
         echo "you must enter your firstname <br />";
      }
      if (empty ($lname))
      {
         echo "you must enter your lastname <br />";
      }
      if (empty ($age))
      {
         echo "you must enter your age <br />";
      }
      if (empty ($address))
      {
         echo "you must enter your address <br />";
      }
      if (empty ($email))
      {
         echo "you must enter your email <br />";
      }
      if (empty ($card))
      {
         echo "you must enter your payment card number <br />";
      }


  else
  {
    $query = "SELECT * FROM users WHERE username LIKE '$user'";
    $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result)>0)
    {
        echo "Username already exists. Please choose a new one.";
        // echo "Email address already registered. Please sign in.";
    }

    else
    {
        $sql = "INSERT INTO AUCTION.users (`user_id`, `user_fname`, `user_lname`, `username`, `password`, `user_gender`, `user_age`, `user_address`, `user_email`, `user_payment`, `rating_id`)
        VALUES (NULL, '$fname', '$lname', '$user', '$pass', '', '$age', '$address', '$email', '$card', '')";
        $inser = mysqli_query($conn, $sql);

        if ($inser)
        {
            header('Location: index.php');
        }
        else
        {
            echo"Unsuccessful signup, please try again";
        }
    }
    }
 }

  // close connection
  mysqli_close($conn);

?>

  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="" name="">
        <h2 class="form-signin-heading" align="center">Registration</h2>
        </br> </br>

        <div class="ui action input">
          <div class="ui teal left labeled icon button">
            <i class="user icon"></i>
            Username
          </div>
          <input type="" name="username" class="form-control" required autofocus>
        </div>

        <br>

        <div class="ui action input">
          <div class="ui teal left labeled icon button">
            <i class="lock icon"></i>
            Password
          </div>
          <input type="password" name="password" class="form-control" required>
        </div>

        <br>

        <div class="ui action input">
          <div class="ui teal left labeled icon button">
            <i class="smile icon"></i>
            First name
          </div>
          <input type="" name="fname" class="form-control" required>
        </div>
        </br>
        <input type="" name="lname" class="form-control" placeholder="Last Name" required>
        </br>
        <input type="" name="age" class="form-control" placeholder="Age" required>
        </br>
        <input type="" name="address" class="form-control" placeholder="Address" required>
        </br>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        </br>
        <input type="" name="card" class="form-control" placeholder="Card Number" required>
        </br> </br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="signup">Sign Up</button>
      </form>
    </div> <!-- /container -->
  </body>
</html>
