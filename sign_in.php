<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/Users/rimahsaini/Downloads/bootstrap-3.3-2.6/docs/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/Users/rimahsaini/Downloads/bootstrap-3.3-2.6/docs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/Applications/MAMP/htdocs/test/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/Users/rimahsaini/Downloads/bootstrap-3.3-2.6/docs/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php

// connect to database
  $servername = "localhost";
  $username = "team";
  $password = "CQqN4N3sEHPfrLTU";
  $dbname = "AUCTION";
  $conn = new mysqli($servername, $username, $password, $dbname);
// deal with connection failure
  if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

// define variables
  $user = $_REQUEST['username'];
  $pass = $_REQUEST['password'];

// case of empty fields
  if(isset($_POST['loggedin']))
  {
  if (empty ($user))
  {
    echo "you must enter your unique username <br />";
  }
  if (empty ($pass)
  {
    echo "you must enter your password <br />";
  }
  }

// send select query 
  else
  {   
  $query = "SELECT * FROM users WHERE $user = username AND $pass = password" ;
  $result = mysqli_query($conn,$query);
  if ($result) 
  {
    echo "query successfull wrote to DB";
    header('location:/Applications/MAMP/htdocs/test/sign_in.php');
  }
  else
  {
    echo"unscccessful login";
  }
  }

// close connection
  mysqli_close($conn);
    ?>

  </head>

  <body>

    

    <div class="container">

      <form class="form-signin" method="post" action="createNewUser.php" name="newUserForm">
        <h2 class="form-signin-heading">Please sign in</h2>
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
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="loggedin" value="Log In">Sign in</button>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/Users/rimahsaini/Downloads/bootstrap-3.3-2.6/docs/assets/js/ie10-viewport-bug-workaround.js"></script>

    
  </body>
</html>
