











<?php







//global.php holds variables used throughout php



include("global.php");













//Create connection for MYSQL database



$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);







//Check connection



if ($conn->connect_error) {



    die("Connection failed: " . $conn->connect_error);



}



//checks if data is put in the username and password fields for existing users



if(isset($_POST["username"]) && isset($_POST["password"]))



{



    //session variable is this username if user already exists

    $_SESSION["name"] = $_POST["username"];



    //get username and password entered by user



    $username = $_POST["username"];



    $password = $_POST["password"];



    echo $password;



    //predetermined salt



    $salt = 'This_ISARIDICULOUS___PLACE_TOBESO___SILLY';



    //salt added to password



    $password = ($password.$salt);



    //first hash with salt



    $password = hash('sha256', $password);



    //second hash with salt



    $password = hash('sha256', $password);







    //checks to see if username exists



    $checkUsername = "SELECT * FROM User WHERE username = '$username' ";



    $resultUser = $conn->query($checkUsername);



    //checks to see if password exists



    $checkPassword = "SELECT * FROM User WHERE password = '$password'";



    $resultPass = $conn->query($checkPassword);



    //if the username and password exist...



    if($resultUser->num_rows > 0 && $resultPass->num_rows > 0){



        echo "Welcome to Minesweeper, lets play!";



        header("Location: http://minesweeperbombs.epizy.com/game.php");



    }else{



        echo "User and password combo do no exist, please create new user.";



    }



}











//does the same password hashing and salt as with existing user, but inserts into database for the new user



if(isset($_POST['usernameNew']))



{    //session variable name if new user



    $_SESSION["name"] = $_POST["usernameNew"];



    $insertNew = "INSERT INTO User(username, password, salt)



	VALUES('".$_POST['usernameNew']."', '".$_POST['passwordNew']."','This_ISARIDICULOUS___PLACE_TOBESO___SILLY')";



    $conn->query($insertNew);



    $usernameNew = $_POST['usernameNew'];



    $passwordNew = $_POST['passwordNew'];



    $salt = 'This_ISARIDICULOUS___PLACE_TOBESO___SILLY';



    $passwordNew = ($passwordNew.$salt);



    $passwordNew = hash('sha256', $passwordNew);



    $passwordNew = hash('sha256', $passwordNew);



    header("Location: http://ultraminesweeper.epizy.com/game.php");







    $updateNew ="UPDATE User SET password = '$passwordNew' WHERE username = '$usernameNew'";



    $conn->query($updateNew);}











$conn->close()







?>







<html>



<head>



    <title>Minesweeper Login</title>



    <link href="style.css" rel="stylesheet" type="text/css" media="all">



</head>



<body>



<h1><b>Existing User Login</b></h1>



<Form action="" method="post" >



    Username: <br>



    <input type="text" name="username" id="username">



    <br>



    Password: <br>



    <input type="text" name="password" id="password">



    <br>



    <br>



    <br>



    <input type="submit" value="Submit" id="submitExisting">



</form>







<h1><b>Create New User</b></h1>



<Form action="" method="post">



    Username: <br>



    <input type="text" name="usernameNew" id="usernameNew" >



    <br>



    Password:<br>



    <input type="text" name="passwordNew" id="passwordNew">



    <br>



    <br>



    <br>



    <input type="submit" value="Submit" id="submitNew">



</form>







<script src="logic.js"></script>



</body>



</html>































