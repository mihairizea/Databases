<?php
$db_hostname = 'localhost';
$db_username = 'zaeema1';
$db_password = 'nZtaun5pvxyVCd5f';
$db_database = 'auction system';

// Database Connection String
$con = mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Search Item Category drop list</title>
    </head>
    <body>
 
  

<!-- Code for dropdown list -->

<?php

$categoryname = "SELECT category_name, category_id FROM item_category";
$c_query = mysqli_query($categoryname);
$rcategory = mysqli_fetch_assoc($c_query);
if (!$result = $con->query($categoryname)) {
	die (' There was an error running query[' .$con->error. ']');
}
?>

<form action="testFile.php" method="get"> 


<?php
if (!empty($_POST['term'])) {
	$term = mysqli_real_escape_string($con, $_REQUEST['term']);     
	$sql = "SELECT * FROM item_category WHERE category_description LIKE '%".$term."%'"; 
	$r_query = mysqli_query($con, $sql); 
	} 
?>
	<select name="categorylist">
	    <option value="">Select a category</option>
		<?php while ($row = $result->fetch_assoc()) {?>
		<option value="<?php echo $row["category_id"]; ?>"><?php echo $row["category_name"]; ?></option>
		<?php }; ?>
		
	</select>
 
<input type="submit" value="Search">



<!-- code for searchfield -->
<input  type="text" id="item" name="item" placeholder="Search item" />




<?php

if (!empty($_GET['item'])) {
	$product = mysqli_real_escape_string($con, $_GET['item']);
	$product1 = "SELECT * FROM item WHERE item_description LIKE '%".$product."%'";
	$product_query = mysqli_query($con, $product1);
}

?>
	
<?php while ($row = mysqli_fetch_assoc($product_query)) {
	
	echo $row["item_id"];
}; ?>


</form>


  </body>
</html>
