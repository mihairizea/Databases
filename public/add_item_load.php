<?php require_once("../includes/connection.php") ?>
<?php
//start session before anything else
  session_start();

   ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
?>

<html>
<body>


<?php 
$item_name = $_POST["item-name"];
$item_description = $_POST["item-description"];
$image =  $_POST["item-image"];
$category_id = $_POST["item-category"]; //will be a query that finds the category id in the database based on the category name from the form
$user_id = $_SESSION["ID"];//will come from the session

 
//Perform database query

$add_item_query = "INSERT INTO items (user_id, item_description, item_name, image, category_id) 
VALUES ({$user_id}, '{$item_description}', '{$item_name}', '{$image}', {$category_id})";

$result = mysqli_query($conn, $add_item_query);
//Test if there was a query error 
if ($result){
	//Success
} else {
	$message = "Information missing or item has already been added";
	echo $message;
}

?>

</body>
</html>

<?php // close connection
  mysqli_close($conn);?>

  <script> 
	window.location.replace("unauctioned_items.php");
	</script> 