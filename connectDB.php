<?php

$user = 'root';
$password = 'root';
$db = 'inventory';
$host = 'localhost';
$port = 3306;

$link = mysqli_init();

$success = mysqli_real_connect(
   $link, 
   $host, 
   $user, 
   $password, 
   $db,
   $port
);

mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database);

if ($db_found) {

print "Database Found";

}
else {

print "Database NOT Found";

}

?>
