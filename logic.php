<?php
	include("global.php");
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);

	//reads the post body from the javascript
	$postBody = file_get_contents('php://input');
	$postObject = json_decode($postBody);

	//TODO get gameboard and gamestate from DB

	$game = getStoredGame("123");
	$gameBoard = json_decode($game['gameBoard']);
	$gameState = json_decode($game['gameState']);
	$gameOverCell = processInput($postObject->cell, $postObject->button, $gameBoard, $gameState);
	$displayBoard = buildDisplayBoard($gameBoard, $gameState, $gameOverCell);

	//build the response
	$response = (object)[];
	$response->displayBoard = $displayBoard;
	echo json_encode($response);

	function processInput($cell, $button, &$gameBoard, &$gameState) {
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

		return $gameOverCell;
	}

	function getStoredGame($sessionId) {
		$sql = "SELECT * FROM Game WHERE sessionID = " . $sessionId;

		$conn = new mysqli(servername, username, password, dbname);
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

