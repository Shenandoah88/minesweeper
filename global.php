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
define("SERVERNAME", "sql201.epizy.com");
define("USERNAME","epiz_23998965");
define("PASSWORD", "JPAonEiREfurGzW");
define("DBNAME", "epiz_23998965_Users");


function session_valid_id($session_id)
{
    return preg_match('/^[-,a-zA-Z0-9]{1,128}$/', $session_id) > 0;
}


function buildDisplayBoard($gameBoard, $gameState, $gameOverCell, $name) {

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
                        lostGame($name);
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

function lostGame($name){

    $sql = "UPDATE Users
            SET active = 0
            WHERE username = '$name'";

    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    if ($conn->connect_error) {
        die("lostGame couldn't connect");
    }

    $conn->query($sql);

}

