<?php

	include("global.php");
		

	

	


//Create connection

$conn = new mysqli(servername, username, password, dbname);

//Check connection

if ($conn->connect_error) {

	die("Connection failed: " . $conn->connect_error);

}
	

if(isset($_POST["username"]) && isset($_POST["password"]))
{
	$username = $_POST["username"];
 	$password = $_POST["password"];
	$salt = 'this$*+Salt+is++&*Being((*()used))_)(for**&&*^security+@)#($reasons888786';
	$password = ($password.$salt);
	$password = hash('sha256', $password);
	$password = hash('sha256', $password);

$checkUsername = "SELECT * FROM Users WHERE username = '$username' ";
$resultUser = $conn->query($checkUsername);
$checkPassword = "SELECT * FROM Users WHERE password = '$password'";
$resultPass = $conn->query($checkPassword);

if($resultUser->num_rows > 0 && $resultPass->num_rows > 0){
echo "Welcome to Minesweeper, lets play!";
	//game.php
}else{
 echo "User and password combo do no exist, please create new user.";
}
}

if(isset($_POST['usernameNew']))
{
	$insertNew = "INSERT INTO Users(username, password, salt)
	VALUES('".$_POST['usernameNew']."', '".$_POST['passwordNew']."', 'this$*+Salt+is++&*Being((*()used))_)(for**&&*^security+@)#($reasons888786')";
	$conn->query($insertNew);

	$usernameNew = $_POST['usernameNew'];
 	$passwordNew = $_POST['passwordNew'];
	$salt = 'this$*+Salt+is++&*Being((*()used))_)(for**&&*^security+@)#($reasons888786';
	$passwordNew = ($passwordNew.$salt);
	$passwordNew = hash('sha256', $passwordNew);
	$passwordNew = hash('sha256', $passwordNew);

	$updateNew ="UPDATE Users SET password = '$passwordNew' WHERE username = '$usernameNew'";
	$conn->query($updateNew);
	
}	
$conn->close()

?>



<html>

    <head>

	

        <title>Minesweeper Login</title>

        <link href="style.css" rel="stylesheet" type="text/css" media="all">

    </head>

    <body>	    

        <script src="logic.js"></script>

		

		<h1><b>Existing User Login</b></h1>

		

		<Form action="" method="post">

			Username: <br>

			<input type="text" name="username">

			<br>

			Password: <br>

			<input type="text" name="password">

			<br>

			<br>

			<br>

			<input type="submit" value="Submit">

			</form>

		

		<h1><b>Create New User</b></h1>

			<Form action="" method="post">

			Username: <br>

			<input type="text" name="usernameNew">

			<br>

			Password:<br>

			<input type="text" name="passwordNew">

			<br>

			<br>

			<br>

			<input type="submit" value="Submit">

			</form>     

		

    </body>

</html>



