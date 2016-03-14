<?php require_once("../includes/connection.php") ?>

<?php

session_start();


$auction_id = $_SESSION["first_auction_id"]; // will come from menu page
// ad a field here that selects the name of the item being 
// bidded upon from the database (use auction id to get item id to get item name)

$bid_value = $_POST["bid-value"];//comes from post
$bid_time = date("Y-m-d H:i:s"); 
$bidder_id = $_SESSION["ID"]; // the bidder, will come from session
//echo $bid_time;

$make_bid_query = "INSERT INTO bids (auction_id, bid_value, bid_time, bidder_id) 
VALUES ({$auction_id}, {$bid_value}, '{$bid_time}', {$bidder_id})";

$result = mysqli_query($conn, $make_bid_query);
//Test if there was a query error 
if ($result) {

	//Success
	// header('Location: https://www.google.co.uk');
	} else {
	$message = "Information missing or identical bid already placed";
	echo $message;
}

?>
<?php
$last_bid_query = "SELECT bid_id FROM bids ORDER BY bids.bid_time DESC LIMIT 1" ;
//echo $last_bid_query;
$last_bid_query2 = mysqli_query($conn, $last_bid_query);
$row = mysqli_fetch_assoc($last_bid_query2);
//print_r($row);
$converter = $row["bid_id"];
$add_last_bid = "UPDATE auction SET last_bid_id = {$converter} WHERE auction_id = {$auction_id}";
$add_last_bid2 = mysqli_query($conn, $add_last_bid);
?>

<?php 
// add to auction counter. 
$count_query = "SELECT bid_counter FROM auction WHERE auction_id = {$auction_id}";
$count_query2 = mysqli_query($conn, $count_query);
$count_row = mysqli_fetch_assoc ($count_query2);
$bid_counter = $count_row["bid_counter"] + 1; 
$update_count_query = "UPDATE auction SET bid_counter = {$bid_counter} WHERE auction_id = {$auction_id}";
$update_count_query2 = mysqli_query($conn, $update_count_query);
?>

<?php
if ($bid_counter <=1){
	$update_loser_query = "UPDATE auction SET loser_bid_id = {$converter} WHERE auction_id = {$auction_id}";
	$update_loser_query2 = mysqli_query($conn, $update_loser_query);
}
else {
	$find_loser_query = "SELECT MAX (bid_id) FROM bids WHERE auction_id = {$auction_id} AND bid_value < ( SELECT MAX( bid_value )
                 FROM bids )";
	$find_loser_query2 = mysqli_query($conn, $find_loser_query);
	$row = mysqli_fetch_assoc($find_loser_query2);
	$loser_bid = $row["bid_id"];
	if($converter != $loser_bid){
		$find_bidder_id_query = "SELECT bidder_id FROM bids WHERE bid_id = {$loser_bid}";
		$find_bidder_id_query2 = mysqli_query($conn, $find_bidder_id_query);
		$find_bidder_id_row = mysqli_fetch_assoc($find_bidder_id_query2);
		$last_bidder_id = $find_bidder_id_row["bidder_id"];
		//find his user email
		$find_user_email_query = "SELECT user_email FROM users WHERE user_id = {last_bidder_id}";
		$find_user_email_query2 = mysqli_query($conn, $find_user_email_query);
		$find_user_email_row = mysqli_fetch_assoc($find_user_email_query2);
		$last_user_email = $find_user_email_row["user_id"];
		//find item in bid;
		$find_item_id = "SELECT item_id FROM auction where auction_id = {$auction_id}";
		$find_item_id2 = mysqli_query($conn,$find_item_id);
		$find_item_id_row = mysqli_fetch_assoc ($find_item_id2);
		$auction_item_id = $find_item_id_row["item_id"];

		$find_item_name_query = "SELECT item_name FROM items WHERE item_id = {$auction_item_id}";
		$find_item_name_query2 = mysqli_query($conn,$find_item_name_query);
		$find_item_name_row = mysqli_fetch_assoc($find_item_name_query2);
		$auction_item_name = $find_item_name_row;

		//outbid notification text
			$notif1 = "You have been outbidded in your auction for the following item: "; 
			$notif1 .= $auction_item_name;
			$notif1 .= ".\n The new bid is £";
			$notif1 .= $bid_value;
			$notif1 = wordwrap($notif1,70);
			//send outbid email
			

			mail("$last_user_email","You've been outbidded", $notif1);
		}
}


// close connection
  mysqli_close($conn);
?>

<script> 
	window.location.replace("bmx.php");
	</script> 
