<?php
	include("global.php");
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);

	session_start();

	//reads the post body from the javascript
	$postBody = file_get_contents('php://input');
	$postObject = json_decode($postBody);

	$name = $_SESSION['name'];
	$name = "shen";
	$game = getStoredGame($name);
	$gameBoard = json_decode($game['gameboard']);
	$gameState = json_decode($game['gamestate']);
	$gameOverCell = processInput($name, $postObject->cell, $postObject->button, $gameBoard, $gameState);
	$displayBoard = buildDisplayBoard($gameBoard, $gameState, $gameOverCell);

	//build the response
	$response = (object)[];
	$response->displayBoard = $displayBoard;
	echo json_encode($response);

	function processInput($name, $cell, $button, &$gameBoard, &$gameState) {
		$gameOverCell = null;
		$cell = explode(":", $cell);
		$x = $cell[0];
		$y = $cell[1];

		if ($button == "left") {
			$gameState[$x][$y] = LEFT_CLICK;
			if ($gameBoard[$x][$y] == BOMB) {
				$gameOverCell = (object)[];
				$gameOverCell->x = $x;
				$gameOverCell->y = $y;
			}
		} else if ($button == "right") {
			if ($gameState[$x][$y] == NO_INTERACTION) {
				$gameState[$x][$y] = RIGHT_CLICK;
			} else if ($gameState[$x][$y] == RIGHT_CLICK) {
				$gameState[$x][$y] = NO_INTERACTION;
			}
		}

		storeChanges($name, $gameState);

		return $gameOverCell;
	}

	function storeChanges($name, $gameState) {
	    $sql = "UPDATE Users
	            SET gamestate = '" . json_encode($gameState) . "'
	            WHERE username = '" . $name . "'";

        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($conn->connect_error) {
            die("ouch");
        }

        $conn->query($sql);
    }

	function getStoredGame($name) {
		$sql = "SELECT * FROM Users WHERE username = '$name'";

		$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
		if ($conn->connect_error) {
			die("you suck");
		}

		$result = $conn->query($sql);

		if ($result) {
			$row = mysqli_fetch_array($result);
			return $row;
		}

		return null;
	}

