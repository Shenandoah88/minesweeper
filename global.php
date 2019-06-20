<?php
	//put anything that could be used in more than one php file in here so we only have to declare it once
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);

	//******** CONSTANTS *********
	define("XMAX", 9);
	define("YMAX", 9);
	define("MINE_COUNT", 10);
	define("INCORRECT_FLAG", -5);
	define("FAIL_BOMB", -4);
	define("UNTOUCHED_CELL", -3);
	define("FLAGGED_CELL", -2);
	define("BOMB", -1);
	define("LEFT_CLICK", 1);
	define("RIGHT_CLICK", -1);
	define("NO_INTERACTION", 0);
	define("servername", "sql201.epizy.com");
	define("username","epiz_23998965");
	define("password", "JPAonEiREfurGzW");
	define("dbname", "epiz_23998965_Users");

	function buildDisplayBoard($gameBoard, $gameState, $gameOverCell) {

		$displayBoard = array();
		for ($x = 0; $x < XMAX; $x++) {
			for ($y = 0; $y < YMAX; $y++) {
				$cellValue = UNTOUCHED_CELL;
				switch ($gameState[$x][$y]) {
					case RIGHT_CLICK: //user flagged the cell (right)
						if ($gameOverCell && $gameBoard[$x][$y] == BOMB) {
							$cellValue = INCORRECT_FLAG;
						} else {
							$cellValue = FLAGGED_CELL;
						}
						break;
					case LEFT_CLICK: //reveal the true value of the cell
						if ($gameBoard[$x][$y] == BOMB && $gameOverCell->x == $x && $gameOverCell->y == $y) {
							$cellValue = FAIL_BOMB;
						} else {
							$cellValue = $gameBoard[$x][$y];
						}
						break;
					case 0: default:
					if ($gameOverCell) {
						$cellValue = $gameBoard[$x][$y];
					}
					break;
				}
				$displayBoard[$x][$y] = $cellValue;
			}
		}
		return $displayBoard;
	}

