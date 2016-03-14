<?php require_once("../includes/connection.php") ?>
<?php
//start session before anything else
  session_start();

  // errors print
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
?>


<html>
<body>

<form action="create_auction_load.php" method="post">
Start date: <input type="date" name="start-date"><br/>
Start time: <input type="time" name="start-time"><br/>
End date: <input type="date" name="end-date"><br/>
End time: <input type="time" name="end-time"><br/>
Start price: <input type="number" name="start-price"><br/>
<button type="submit" name="create-auction">Create auction</button>

</form>


<?php

 // close connection
  mysqli_close($conn);
?>

<!-- Site footer -->
      <footer class="footer">
        <p>&copy; 2016 Cool Crew Company, Inc.</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
