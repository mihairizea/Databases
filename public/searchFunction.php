<?php require_once("../includes/connection.php") ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Search Item Category drop list</title>
    </head>
    <body>
 
  

<!-- Code for dropdown list -->

<?php
$categoryname = "SELECT cat_name, cat_id FROM item_category";
$c_query = mysqli_query($conn, $categoryname);
$rcategory = mysqli_fetch_assoc($c_query);

?>

<form action="" method="get"> 


<?php
if (!empty($_GET'term'])) {
	$term = mysqli_real_escape_string($conn, $_REQUEST['term']);     
	$sql = "SELECT * FROM item_category WHERE cat_description LIKE '%".$term."%'"; 
	$r_query = mysqli_query($conn, $sql); 
	} 
?>
	<select name="categorylist">
	    <option value="">Select a category</option>
		<?php while ($row = $result->fetch_assoc()) {?>
		<option value="<?php echo $row["cat_id"]; ?>"><?php echo $row["cat_name"]; ?></option>
		<?php }; ?>
		
	</select>
 
<input type="submit" value="Search">



<!-- code for searchfield -->
<input  type="text" id="item" name="item" placeholder="Search item" />


<!-- 'item' is for the search field, 'category list' is for drop down
item_description is from items table. '$categorylist is concatinating the drop down with search box.  -->

<?php
if (!empty($_GET['item']) && !empty($_GET['categorylist'])) {
	$product = mysqli_real_escape_string($conn, $_GET['item']);
	$categorylist = mysqli_real_escape_string($conn, $_GET['categorylist']);
	$product_query = "SELECT * FROM items,item_category WHERE items.category_id=item_category.cat_id AND item_description LIKE '%".$product."%' AND items.category_id=".$categorylist;
	$result_product_query = mysqli_query($conn, $product_query);
}
elseif 	(!empty($_GET['categorylist'])) {
	// $product = mysqli_real_escape_string($con, $_GET['item']);
	$categorylist = mysqli_real_escape_string($conn, $_GET['categorylist']);
	$product_query = "SELECT * FROM items,item_category WHERE items.category_id=item_category.cat_id AND items.category_id=".$categorylist;
	// echo $product_query;
	$result_product_query = mysqli_query($conn, $product_query);
}
elseif (!empty($_GET['item'])) {
	$product = mysqli_real_escape_string($conn, $_GET['item']);
	// $categorylist = mysqli_real_escape_string($con, $_GET['categorylist']);
	$product_query = "SELECT * FROM items,item_category WHERE items.category_id=item_category.cat_id AND item_description LIKE '%".$product."%'";
	$result_product_query = mysqli_query($conn, $product_query);
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

// close connection
  mysqli_close($conn);
 
?>

</form>


  </body>
</html>
