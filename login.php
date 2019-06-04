<?php
	include("global.php");
	//Get username and password, hash the password, then hash the password again adding the salt. 
	$username = $_POST['username'];
	$password = $_POST['password'];
	$salt = 'this$*+Salt+is++&*Being((*()used))_)(for**&&*^security+@)#($reasons888786';
	$password = hash('sha256', $password);
	$password = hash('sha256', $password.$salt);
	
	
	
$servername = "sql111.epizy.com";
$username = "epiz_23985290";
$password = "3fRx6d6h";
$dbname = "epiz_23985290_minesweeper";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}




$checkUsername = "SELECT username FROM User WHERE username = '"$username"'";
$username = $conn->query($checkExists);

$checkPass = "SELECT password FROM User WHERE username = '"$username"'";
$password = $conn->query($checkPass);

if($username == TRUE && $password == TRUE) 
	{
	echo "User exists and password is correct! Continue to play....";
	}
if($username == TRUE && $password != TRUE)
	{
		echo "Username is correct, Password is not correct. Try again."
	}
if($username != TRUE)
	{	
		$insertUser = "INSERT INTO Users (username, password, salt)
					   VALUES('".$_POST['username']."', '".$password."', '".$salt."')";

		$newUser = $conn->query($insertUser);			   
	}
else 
	{
		echo "Create new User to the right";
	}

$mysqli0>close()
?>
<html>
    <head>
	
        <title>Minesweeper Login</title>
        <link href="style.css" rel="stylesheet" type="text/css" media="all">
    </head>
    <body>	    
        <script src="logic.js"></script>
		
		<h1 style="text-align:left;"><b>Existing User Login</b></h1>
		
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
		
		<h1 style="text-align:right;"><b>Create New User</b></h1>
			<Form action="" method="post">
			Username: <br>
			<input type="text" name="username">
			<br>
			Password:
			<input type="text" name="password">
			<br>
			<br>
			<br>
			<input type="submit" value="Submit">
			</form>     
		
    </body>
</html>