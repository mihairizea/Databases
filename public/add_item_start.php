<?php require_once("../includes/connection.php") ?>
<?php
//start session before anything else
  session_start();
?>
<html>
<body>
<?php
$categoryname = "SELECT cat_name, cat_id FROM item_category";
$c_query = mysqli_query($conn, $categoryname);
// set array
$array = array();
// look through query
while($row = mysqli_fetch_assoc($c_query)){
	// add each row returned into an array
  $array[] = $row;
}

?>

<form id="add-item" action="add_item_load.php" method="post">
Item name <input type="text" name="item-name"><br>
Item decription <input type="text" name="item-description"><br>
URL to item image <input type="text" name="item-image"><br>

<?php
$categoryname = "SELECT cat_name, cat_id FROM item_category";
$c_query = mysqli_query($conn, $categoryname);
// set array
$array = array();
// look through query
while($row = mysqli_fetch_assoc($c_query)){
	// add each row returned into an array
  $array[] = $row;}?>

<select name="item-category">
	    <option value="">Select a category</option>
		 <?php foreach($array as $item) {?>

			<option value="<?php echo $item["cat_id"]; ?>"><?php echo $item["cat_name"]; ?></option>
		<?php }; ?>
		</select>

<button type="Submit" name="submit-item">Add item</button>
</form>
</body>
</html>


<?php // close connection
  mysqli_close($conn);?>