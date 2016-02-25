<?php
$servername = "localhost";
$username = "root";
$password = "password";

   
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
if (!empty($_REQUEST['term'])) {

$term = mysql_real_escape_string($_REQUEST['term']);     

$sql = "SELECT * FROM item_category WHERE 1 LIKE '%".$term."%'"; 
$r_query = mysql_query($sql); 

while ($row = mysql_fetch_array($r_query)){  
echo 'category_id: ' .$row['category_id'];  
echo '<br /> category_name: ' .$row['category_name'];  
echo '<br /> category_description: '.$row['category_description'];  
echo '<br /> parent_category_id: '.$row['parent_category_id'];   
}  

}
?>
    </body>
</html>