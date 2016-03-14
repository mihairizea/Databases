<?php require_once("../includes/connection.php") ?>

<?php
//start session before anything else
  session_start();
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
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

    <title>My Account</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/justified-nav.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

      <!-- NAVBAR -->
      <div class="masthead">
        <!-- USER-SESSION DETAILS -->
        <h3 class="text-muted"><?php echo "You are logged in as " . $_SESSION["firstname"] . " " . $_SESSION["lastname"] . ""; ?></h3>
        <!-- TABS -->
        <nav>
          <ul class="nav nav-justified">
            <li><a href="index.php">Search</a></li>
            <li><a href="auctioned_items.php">Auctioned Items</a></li>
            <li><a href="unauctioned_items.php">Non-Auctioned Items</a></li>
            <li><a href="#">Sold Items</a></li>
            <li><a href="#">Bought Items</a></li>
            <li><a href="#">My Bids</a></li>
            <li><a href="#">Watchlist</a></li>
          </ul>
        </nav>
      </div>

      <!-- HOMEPAGE -->
      <div class="jumbotron">
        <h1>Cool Crew Auction</h1></br></br>

        <!-- ADD ITEM -->
      <p><a class="btn btn-lg btn-danger" href="add_item_start.php" role="button">Add Item</a></p>
      </div>
      </br>
      </br>

        <p class="lead">Search items you fancy!</p>
            
            <!-- SEARCH BAR -->
            <form action="" method="get" autocomplete="on">

            <!-- <input type="text" class="form-control" id="item" name="item" placeholder="Search for..."></br> -->
            <input  type="text" id="item" name="item" placeholder="Search item" /></br></br>


            <!-- DROPDOWN -->
            <div>
              <?php
              $dropdown_query = "SELECT cat_name, cat_id FROM item_category";
              $result = mysqli_query($conn, $dropdown_query);?>

              <select name="categorylist">
                <option value="">Select a category</option>
                <?php while ($row = $result->fetch_assoc()) {?>
                <option value="<?php echo $row["cat_id"]; ?>"><?php echo $row["cat_name"]; ?></option>
                <?php }; ?>
              </select>
              
              </br>
              </br>

              <input type="submit" value="Search">
            </div>

            <!-- PHP SEARCH -->
            <?php

            // DISPLAY DEFAULT ITEMS IN AUCTION TABLE
            if (empty($_GET['item']) && empty($_GET['categorylist'])) {

              $auctions_home = "SELECT auction.auction_id, items.item_name, items.item_description, items.views FROM items INNER JOIN auction ON auction.item_id = items.item_id";
              $result_auctions_home = mysqli_query($conn,$auctions_home);
              $a = array();

              if (mysqli_num_rows($result_auctions_home) > 0) {
                while ($row = mysqli_fetch_assoc($result_auctions_home)) {
                  echo "<div class=\"row\">";
                  echo "<div class=\"col-lg-4\">";
                  echo "<h2>" . $row["item_name"]. "</h2>";
                  echo "<p>" . $row["item_description"]. "</p>";
                  if(isset($_POST['viewing'])) {
                    $sql = "UPDATE AUCTION.auction SET viewings = viewings+1 WHERE auction_id = {$row["auction_id"]}";
                    mysqli_query($conn, $sql);
                  }
                  echo "<form class=\"\" method=\"post\" action=\"\" name=\"\">
                  <button class=\"btn btn-lg btn-primary\" type=\"submit\" name=\"viewing\" onclick=\"window.location.replace(\"bmx.php\")\">View</button>
                  </form>";
                  echo "</br></br><p><a class=\"btn btn-success\" href=\"bmx.php\" role=\"button\">Add to Watchlist</a></p>";
                  echo "</div>";
                  echo "</div>";
                  array_push($a, "" . $row["item_name"] . "", "" . $row["item_description"] . "", "" . $row["views"] . "", "" . $row["auction_id"] . "");
                }
              } else {
                echo "No live auctions";
              }
            }

            // SELECT CATEGORY AND ENTER SEARCH TERM CASE
            if (!empty($_GET['item']) && !empty($_GET['categorylist'])) {
              $product = mysqli_real_escape_string($conn, $_GET['item']);
              $categorylist = mysqli_real_escape_string($conn, $_GET['categorylist']);
              $product_query = "SELECT * FROM items,item_category WHERE items.category_id=item_category.cat_id AND item_description LIKE '%".$product."%' AND items.category_id=".$categorylist;
              $result_product_query = mysqli_query($conn, $product_query);
            }
            
            // SELECT CATEGORY ONLY CASE
            elseif  (!empty($_GET['categorylist'])) {
              $categorylist = mysqli_real_escape_string($conn, $_GET['categorylist']);
              $product_query = "SELECT * FROM items,item_category WHERE items.category_id=item_category.cat_id AND items.category_id=".$categorylist;
              $result_product_query = mysqli_query($conn, $product_query);
            }

            // ENTER SEARCH TERM ONLY CASE
            elseif (!empty($_GET['item'])) {
              $product = mysqli_real_escape_string($conn, $_GET['item']);
              $product_query = "SELECT * FROM items,item_category WHERE items.category_id=item_category.cat_id AND item_description LIKE '%".$product."%'";
              $result_product_query = mysqli_query($conn, $product_query);
            }

            // SEARCH KEY DOESN'T MATCH SELECTED CATEGORY
            if (mysqli_num_rows($result_product_query)==0 && isset($_GET["categorylist"])) {
              echo "<div class=\"row\">";
              echo "<div class=\"col-lg-4\">";
              echo "No result in current category, please select a different one.";
              echo "</div>";
              echo "</div>";
            }

         
            // DISPLAY RESULTS
            while ($row = mysqli_fetch_assoc($result_product_query)) {

              echo $row["item_name"];
              echo "<div class=\"row\">";
              echo "<div class=\"col-lg-4\">";
              echo "<h2>" . $row["item_name"]. "</h2>";
              echo "<p>" . $row["item_description"]. "</p>";
              if(isset($_POST['viewing'])) {
                $sql = "UPDATE AUCTION.auction SET viewings = viewings+1 WHERE auction_id = {$row["auction_id"]}";
                mysqli_query($conn, $sql);
              }
              echo "<form class=\"\" method=\"post\" action=\"\" name=\"\">    
              <button class=\"btn btn-lg btn-primary\" type=\"submit\" name=\"viewing\" onclick=\"window.location.replace(\"bmx.php\")\">View</button>
              </form>";
              echo "</br></br><p><a class=\"btn btn-success\" href=\"mercedes.php\" role=\"button\">Add to Watchlist</a></p>";
              echo "</div>";
              echo "</div>";
              array_push($a, "" . $row["item_name"] . "", "" . $row["item_description"] . "", "" . $row["views"] . "", "" . $row["auction_id"] . "");
            }; 

            ?>

             </form>

      </br>
      </br>


<?php
// close connection
  mysqli_close($conn);
?>
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; 2016 Cool Crew Company, Inc.</p>
      </footer>

    </div> <!-- /container -->
    

<!-- SCRIPT GO TO ITEM PAGE -->
<script>
   function move(){
     window.location.replace("bmx.php");
   }
</script>

  </body>
</html>
