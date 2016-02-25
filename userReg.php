<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 

    <?php
// define variables and set to empty values
$fNameErr = $lNameErr = $usernameErr = $passwordErr =  $ageErr = $addressErr = $emailErr = $genderErr = $CardErr = "";
$fName = $lName = $username = $password = $age = $address = $email = $gender = $card = "";

// verify if required fields are empty and print error if so
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["fName"])) {
     $fNameErr = "All fields are required!";
   } else {
     $fName = test_input($_POST["fName"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }

   if (empty($_POST["lName"])) {
     $lNameErr = "All fields are required!";
   } else {
     $lName = test_input($_POST["lName"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }

   if (empty($_POST["username"])) {
     $usernameErr = "All fields are required!";
   } else {
     $username = test_input($_POST["username"]);
   }

   if (empty($_POST["password"])) {
     $passwordErr = "All fields are required!";
   } else {
     $password = test_input($_POST["password"]);
     if (!preg_match("/^[a-zA-Z0-9 ]*$/",$name)) {
       $nameErr = "Only letters, numbers and white space allowed"; 
     }
   }

   if (empty($_POST["age"])) {
     $ageErr = "All fields are required!";
   } else {
     $age = test_input($_POST["age"]);
     if (!preg_match("/^[0-9 ]*$/",$name)) {
       $nameErr = "Only integers allowed"; 
     }
   }

   if (empty($_POST["address"])) {
     $addressErr = "All fields are required!";
   } else {
     $address = test_input($_POST["address"]);
     if (!preg_match("/^[a-zA-Z]*$/",$name)) {
       $nameErr = "Only letters, numbers and white space allowed"; 
     }
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "All fields are required!";
   } else {
     $email = test_input($_POST["email"]);
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }

   if (empty($_POST["gender"])) {
     $genderErr = "All fields are required!";
   } else {
     $gender = test_input($_POST["gender"]);
   }

   if (empty($_POST["card"])) {
     $cardErr = "All fields are required!";
   } else {
     $card = test_input($_POST["card"]);
     if (!preg_match("/^[0-9 ]*$/",$name)) {
       $nameErr = "Only integers allowed"; //could specify format later
     }
   }
}

// test function
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>



    <!-- html form  -->
    <h2> New User Registration Form</h2>
    <p><span class="error">* required field.</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    </br>
      

        <!-- <label for="fName" class="sr-only">First Name</label> -->
        Firstname: <input type="text" name="fName" id="fName" value="<?php echo $fName ;?>">
        <!-- <h5>Firstname*</h5> <input type="text" id="fName" class="form-control" placeholder="First Name" required autofocus> -->
        <span class="error"> *<?php echo $fNameErr;?></span>
        </br>
        </br>
   
        <!-- <label for="lName" class="sr-only">Last Name</label> -->
        Lastname: <input type="text" name="lName" id="lName" value="<?php echo $lName ;?>">
        <!-- <h5>Lastname*</h5> <input type="text" id="lName" class="form-control" placeholder="Last Name" required> -->
        <span class="error"> *<?php echo $lNameErr;?></span>
        </br>
        </br>

        <!-- <label for="username" class="sr-only">Username</label> -->
        Username: <input type="text" name="username" id="username" value="<?php echo $username ;?>">
        <!-- <h5>Username*</h5> <input type="text" id="username" class="form-control" placeholder="Username" required> -->
        <span class="error"> *<?php echo $usernameErr;?></span>
        </br>
        </br>

        <!-- <label for="password" class="sr-only">Password</label> -->
        Password: <input type="text" name="password" id="password" value="<?php echo $password ;?>">
        <!-- <h5>Password*</h5> <input type="password" id="password" class="form-control" placeholder="Password" required> -->
        <span class="error"> *<?php echo $passwordErr;?></span>
        </br>
        </br>

        <!-- <label for="age" class="sr-only">Age</label> -->
        Age: <input type="text" name="age" id="age" value="<?php echo $age ;?>">
        <!-- <h5>Age*</h5> <input type="text" id="age" class="form-control" placeholder="Age" required> -->
        <span class="error"> *<?php echo $ageErr;?></span>
        </br>
        </br>

        Gender:
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">Female
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>  value="male">Male
        <span class="error">* <?php echo $genderErr;?></span>
        </br>
        </br>

        <!-- <label for="address" class="sr-only">Address</label> -->
        Address: <input type="text" name="address" id="address" value="<?php echo $address ;?>">
        <!-- <h5>Address*</h5> <input type="text" id="address" class="form-control" placeholder="Address" required> -->
        <span class="error"> *<?php echo $addressErr;?></span>
        </br>
        </br>

        <!-- <label for="email" class="sr-only">Email</label> -->
        Email: <input type="text" name="email" id="email" value="<?php echo $email;?>">
        <!-- <h5>Email*</h5> <input type="text" id="email" class="form-control" placeholder="Email" required> -->
        <span class="error"> *<?php echo $emailErr;?></span>
        </br>
        </br>

        <!-- <label for="card" class="sr-only">Card</label> -->
        Card Number: <input type="text" name="card" id="card" value="<?php echo $card ;?>">
        <!-- <h5>Card Number*</h5> <input type="text" id="card" class="form-control" placeholder="Card Number" required> -->
        <span class="error"> *<?php echo $cardErr;?></span>
        </br>
        </br>

        <!-- <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Male
          </br>
            <input type="checkbox" value="remember-me"> Female
          </label>
        </div> -->

        <input type="submit" name="submit" value="Submit">
      </form>

      

  </body>
</html>
