<?php require_once("../includes/connection.php") ?>
<?php
//start session before anything else
  session_start();

  // errors print
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../css/favicon.ico">

    <?php echo "<title>" . $_GET["id"] . "</title>"?>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/justified-nav.css" rel="stylesheet">

  </head>

  <body>

    <?php
      $queryString = "SELECT * FROM items WHERE item_id = " . $_GET["id"];
      $item = mysqli_fetch_assoc(mysqli_query($conn, $queryString));
    ?>

    <div class="row">
      <div class="col-lg-4">
        <h2><?php echo $item["item_name"] ?></h2>
        <p><?php echo $item["item_description"] ?></p>
      </div>
    </div>

    <div class="container">

    	<div class="jumbotron">

      </br>
      </br>
      </br>

        <div>

          <?php

$queryString = "SELECT auction_id FROM auction WHERE item_id = " . $_GET["id"];
$auction_id = mysqli_fetch_assoc(mysqli_query($conn, $queryString))["auction_id"];


$find_end_time_query = "SELECT end_time FROM auction WHERE auction_id = {$auction_id}";
$find_end_time_query2 = mysqli_query($conn,$find_end_time_query);
$find_end_time_row = mysqli_fetch_assoc($find_end_time_query2);
$end_time = $find_end_time_row["end_time"];


$find_counter_query = "SELECT bid_counter FROM auction WHERE auction_id = {$auction_id}";
$find_counter_query2 = mysqli_query($conn,$find_counter_query);
$find_counter_row = mysqli_fetch_assoc($find_counter_query2);
$counter = $find_counter_row["bid_counter"];
echo "This item has received "; echo $counter; echo " bids so far";


?>

<br/><?php echo "Auction ends in:"; ?>
<div id="timer-wrap"></div>



    <script type="text/javascript">
      var deadline = '<?php echo $end_time; ?>';
      var timeNow = new Date();
      var remaining = Date.parse(deadline) - Date.parse(timeNow);
      var seconds = Math.floor((remaining/1000) % 60);
      var minutes = Math.floor((remaining/(1000*60)) % 60);
      var hours = Math.floor((remaining/(1000*60*60)) % 24);
      var days = Math.floor(remaining/(1000*60*60*24));

      var wrap = document.getElementById('timer-wrap');

      timer();
      var timeInterval = setInterval(timer, 1000);

      function timer() {
        if (seconds !== 0) {
          seconds--;
          updateCounter();
        } else {
          seconds = 59;
          if (minutes !== 0) {
            minutes--;
            updateCounter();
          } else {
            minutes = 59;
            if (hours !== 0) {
              hours--;
              updateCounter();
            } else {
              hours = 23;
              if (days !== 0) {
                days--;
                updateCounter();
              } else {
                clearInterval(timeInterval);
                displayTimeOut();
              }
            }
          }
        }
      }

      function updateCounter() {
        wrap.innerHTML =
          'Days: ' + days + '<br/>' +
          'Hours: ' + hours + '<br/>' +
          'Minutes: ' + minutes + '<br/>' +
          'Seconds: ' + seconds + '<br/>';
      }

      function displayTimeOut() {
        wrap.innerHTML = "Time is up";
      }
    </script>

   </div>

 </br>
 </br>
 </br>

<!-- make bid  -->
   <div>
    <form action="make_bid_load_email.php" method="post">
Value you want to pay: <input type="number" name="bid-value"><br/>
<!-- NEED TO PUT A CHECK HERE THAT THE VALUE INPUTED IS LARGER THAN THE VALUE OF THE LAST BID AND THAT OF THE STARTING PRICE -->
<button type="submit" name="make-bid">Submit bid</button>
</form>
   </div>



  </body>
</html>

<?php require_once("../includes/footer.php") ?>
