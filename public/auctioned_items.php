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

        <?php

  $id = $_SESSION["ID"];

    $my_items = " SELECT items.item_id, items.item_name, items.item_description FROM items INNER JOIN auction ON auction.item_id = items.item_id = '$id' ";
    $result_my_items = mysqli_query($conn,$my_items);

      if (mysqli_num_rows($result_my_items) > 0) {
      while ($row = mysqli_fetch_assoc($result_my_items)) { ?>
        <div class="row">
          <div class="col-lg-4">
            <h2><?php echo $row["item_name"] ?></h2>
            <p><?php echo $row["item_description"] ?></p>
            <p><a class="btn btn-primary" href="auction.php?id=<?php echo $row["item_id"] ?>">View details</a></p>
          </div>
        </div>
      <?php }
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
