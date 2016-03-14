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
        <title>Category Dropdown List and Search Field</title>
    </head>
    <body>
 
<form action="search_option.php" method="get" autocomplete="on">

<!-- Code for dropdown list -->
<?php

$dropdown_query = "SELECT category_name, category_id FROM item_category";
$result = mysqli_query($con, $dropdown_query);
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


<!-- 'item' is for the search field, 'category list' is for drop down
item_description is from items table. '$categorylist is concatinating the drop down with search box.  -->

<?php

if (!empty($_GET['item']) && !empty($_GET['categorylist'])) {
	$product = mysqli_real_escape_string($con, $_GET['item']);
	$categorylist = mysqli_real_escape_string($con, $_GET['categorylist']);
	$product_query = "SELECT * FROM item,item_category WHERE item.category_id=item_category.category_id AND item_description LIKE '%".$product."%' AND item.category_id=".$categorylist;
	$result_product_query = mysqli_query($con, $product_query);



}
elseif 	(!empty($_GET['categorylist'])) {
	// $product = mysqli_real_escape_string($con, $_GET['item']);
	$categorylist = mysqli_real_escape_string($con, $_GET['categorylist']);
	$product_query = "SELECT * FROM item,item_category WHERE item.category_id=item_category.category_id AND item.category_id=".$categorylist;

	// echo $product_query;
	$result_product_query = mysqli_query($con, $product_query);
}

elseif (!empty($_GET['item'])) {
	$product = mysqli_real_escape_string($con, $_GET['item']);
	// $categorylist = mysqli_real_escape_string($con, $_GET['categorylist']);
	$product_query = "SELECT * FROM item,item_category WHERE item.category_id=item_category.category_id AND item_description LIKE '%".$product."%'";
	$result_product_query = mysqli_query($con, $product_query);

    // echo $product_query;
}

	// echo $product_query;
	// $result_product_query = mysqli_query($con, $product_query);

if (mysqli_num_rows($result_product_query)==0 && isset($_GET["categorylist"]))
{
    // die('Invalid query: ' . mysqli_error($conn));
     echo "Please Select a different Category";
}

?>
	
<?php while ($row = mysqli_fetch_assoc($result_product_query)) {
	
	echo $row["item_description"];
}; 

?>


</form>


  </body>
</html>