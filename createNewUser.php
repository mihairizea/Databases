<?php
        var_dump($_POST); echo "<br />";
        $user = array();
        $user["firstName"] = $_POST["firstName"];
        $user["familyName"] = $_POST["familyName"];
        var_dump($user);


        function getUser()
        {
          $user = array();
          $user["firstName"] = $_POST["firstName"];
          $user["familyName"] = $_POST["familyName"];
          return $user;
}
        $newUser = getUser();
        var_dump($newUser);
?>