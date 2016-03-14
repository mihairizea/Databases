<?php require_once("../includes/connection.php") ?>
<?php
//start session before anything else
  session_start();

  // errors print
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
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

    <title>My Auctioned Items</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/justified-nav.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

    	<div class="jumbotron">
        <h1>My Auctioned Items</h1>
        </div>

      </br>
    </br>

    <div>
      <p><a class="btn btn-lg btn-danger" href="add_item_start.php" role="button">Add Item</a></p>
    </div>

        <?php

  $id = $_SESSION["ID"];

  // retrieve items posted by user
    $my_items = " SELECT items.item_name, items.item_description FROM items WHERE user_id = '$id' ";
    $result_my_items = mysqli_query($conn,$my_items);
    // $row_data = mysqli_fetch_assoc($result_data);

    // if (!isset($_SESSION['user_id'])) {

      if (mysqli_num_rows($result_my_items) > 0) {
      while ($row = mysqli_fetch_assoc($result_my_items)) {
        echo "<div class=\"row\">";
        echo "<div class=\"col-lg-4\">";
        echo "<h2>" . $row["item_name"]. "</h2>";
        echo "<p>" . $row["item_description"]. "</p>";
        echo "<p><a class=\"btn btn-primary\" href=\"sign_in.php\" role=\"button\">View details &raquo;</a></p></br>";
        echo "<p><a class=\"btn btn-success\" href=\"create_auction_start.php\" role=\"button\">Auction</a></p></br>";
        echo "</div>";
        echo "</div>";
        // echo "item name: " . $row["item_name"]. " - item description: " . $row["item_description"]. " <br>";
      } 
      } else {
      echo "No items posted yet";
      }

  // close connection
  mysqli_close($conn);
?>

<!-- Site footer -->
      <footer class="footer">
        <p>&copy; 2016 Cool Crew Company, Inc.</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>

