<?php
	include("global.php");
	
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
	$conn->close();
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
			<input type="text" name="username">
			<br>
			Password:<br>
			<input type="text" name="password">
			<br>
			<br>
			<br>
			<input type="submit" value="Submit">
			</form>     
		
    </body>
</html>

