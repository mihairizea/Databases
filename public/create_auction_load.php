<?php require_once("../includes/connection.php") ?>
<?php
//start session before anything else
  session_start();

  // errors print
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
?>

<html>
<body>


<?php 
// echo $_POST["start-date"]; echo "   ";
// echo $_POST["start-time"];echo "   ";
// echo $_POST["end-date"];echo "   ";
// echo $_POST["end-time"];echo "   ";
$item_id = $_SESSION["first_auction_id"]; //will comefrom session later
$start_time = $_POST["start-date"] . " " . $_POST["start-time"];
$start_time = date($start_time);
$end_time = $_POST["end-date"] . " " . $_POST["end-time"];
$start_time = date($end_time);
$start_price = $_POST["start-price"];


$create_auction_query = "INSERT INTO auction (item_id, start_time, end_time, start_price) 
VALUES ({$item_id}, '{$start_time}', '{$end_time}', {$start_price})";


$result = mysqli_query($conn, $create_auction_query);
//Test if there was a query error 
if ($result){
	//Success
	//redirect_to("my_items.php");
} else {
	$message = "Information missing or auction has already been started";
	echo $message;
}

 // close connection
  mysqli_close($conn);
?>

<!-- Site footer -->
      <footer class="footer">
        <p>&copy; 2016 Cool Crew Company, Inc.</p>
      </footer>

    </div> <!-- /container -->

    <script> 
	window.location.replace("auctioned_items.php");
	</script> 

  </body>
</html>



