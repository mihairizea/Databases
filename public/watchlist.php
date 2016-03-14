<?php require_once("../includes/connection.php") ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Watch List</title>
    </head>
    <body>
    <form name="watchlist" action="watchlist.php" method="get">
	<input type="submit" value="Add to Watchlist" >


<!-- Add auction to watchlist -->

<?php
function add_auction_to_watchlist($user_id, $auction_id)
{
    global $conn;
    $w_user_id = $user_id;
    $w_auction_id = $auction_id;
    $add_query = "INSERT INTO watchlist (";
    $add_query .= "auction_id, user_id ) ";
    $add_query .= "VALUES ({$w_auction_id}, {$w_user_id})";
    $result = mysqli_query($conn, $add_query);
    return $result;
}
?>

<!-- Auction item already in users watchlist -->
<?php
function auction_already_in_watchlist($user_id, $auction_id)
{
    global $conn;
    $query = "SELECT auction_id FROM watchlist WHERE user_id = {$w_user_id} AND auction_id = {$w_auction_id}";
    $watched_auction_item = mysqli_query($conn, $query);
    // returns true if the user is already watching the auction item
    return mysqli_num_rows($watched_auction_item) > 0 ? true : false;
}
?>



<!-- Remove auction item from watchlist -->
<?php
function remove_auction_from_watchlist($watch_id)
{
    global $conn;
    $w_watch_id = mysqli_real_escape_string($watch_id);
    $remove_query = "DELETE FROM watchlist ";
    $remove_query .= "WHERE watch_id = {$w_watch_id}";
    $result = mysqli_query($conn, $remove_query);
    return $result;
}
?>


<!-- View users watchlist  -->

<?php
function view_watched_items($user_id)
{
    global $conn;
    $w_user_id = mysqli_real_escape_string($user_id);
    $watchlist_query = "SELECT * FROM watchlist w ";
    $watchlist_query .= "JOIN auction a ";
    $watchlist_query .= "ON w.auction_id = a.auction_id ";
    $watchlist_query .= "JOIN item i ";
    $watchlist_query .= "ON a.item_id = i.item_id ";
    $watchlist_query .= "WHERE w.user_id = {$w_user_id} ";
    $watchlist_query .= "ORDER BY a.auctionEnd ASC";
    $result = mysqli_query($conn, $watchlist_query);
    // confirm_query($result);
    return $result;
}
?>



<?php
//echo "Watch items in auction";
// $auction_id will come from main menu, watchlist button will add auction item to watchlist table
// use auction_id to get user_id to add auction item to watchlist
$auction_id = $_GET['auction_id'];
$user_id = $_SESSION['user_id'];
$item_id = $_GET['item_id'];
// check that auctionID and userID are available
if (isset($auction_id) && isset($user_id)) {
    if (auction_already_in_watchlist($user_id, $auction_id)) {
            // display a message if the auction item exists in users watchlist
        $_SESSION['watchlist_message'] = "You are already watching this auction";
        redirect_to("auction.php?auction={$item_id}"); // RENAME AUCTION PAGE TO THE FILE IT IS SAVED AS ? 
        
    } 
    else {
        // Add auction to watchlist
        add_auction_to_watchlist($_SESSION['user_id'], $_GET['auction_id']);
        $_SESSION['watchlist_message'] = "Auction was added to your Watch List.";
        redirect_to("auction.php?auction={$item_id}"); // RENAME AUCTION PAGE TO THE FILE IT IS SAVED AS ? 
    }
}
//echo "action successfully triggered";
?>

  </form>
  </body>
</html>