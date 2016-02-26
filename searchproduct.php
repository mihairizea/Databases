<?php
$db_hostname = 'localhost';
$db_username = 'zaeema1';
$db_password = 'nZtaun5pvxyVCd5f';
$db_database = 'auction system';

// Database Connection String
$con = new mysqli($db_hostname,$db_username,$db_password,$db_database);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Search Item</title>
    </head>
    <body>
<form action="" method="post">  
Search: <input type="text" name="term" /> 
<input type="submit" value="Search" />  
</form>
  
<?php
if (!empty($_POST['term'])) {

$term = mysqli_real_escape_string($con, $_REQUEST['term']);     

$sql = "SELECT * FROM item_category WHERE category_description LIKE '%".$term."%'"; 
$r_query = mysqli_query($con, $sql); 
 

} 
?>
    </body>
</html>