<?php require_once("../includes/connection.php") ?>

<?php

// start session before anything else
session_start();

// errors print
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  // retrieve and check user and pass variables from sign in fields
  $user = mysqli_real_escape_string($conn, $_POST['username']);
  $pass = mysqli_real_escape_string($conn, $_POST['password']);


// case of empty fields -> do hashing for password
  if(isset($_POST['signin'])) {
      if (empty ($user)) {
         echo "Please enter your unique username <br/>";
      }
      if (empty ($pass)) {
         echo "Please enter your password";
      }


  // send select query to check if user exists in database
  else {

  // retrieve fname and lname of user   
  $user_data = "SELECT * FROM users WHERE username LIKE '$user' AND password LIKE '$pass'";
  $result_data = mysqli_query($conn,$user_data);
  $row_data = mysqli_fetch_assoc($result_data);

    if (!isset($_SESSION['user_id'])) {

      if (mysqli_num_rows($result_data)==1) {
      // define session variables to be retrieved
      $_SESSION["ID"] = $row_data["user_id"];
      $_SESSION["firstname"] = $row_data["user_fname"];
      $_SESSION["lastname"] = $row_data["user_lname"];
      header('Location: public/my_account.php');
      exit();

      // deny access if user or password don't exist
      } else {
      echo "Invalid username or password, please try again";
      }
    }
  } 

  }

  // close connection
  mysqli_close($conn);
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

    <title>Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="" name="">
        <h2 class="form-signin-heading" align="center">Cool Crew Auction</h2>
      </br>
      </br>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="username" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <!-- <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div> -->
        </br>
        </br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="signin" value="Log In">Sign in</button>
        <a class="btn btn-lg btn-primary btn-block" type="submit" href="user_registration.php">Register</a>
      </form>

    </div> <!-- /container -->
    
  </body>
</html>
