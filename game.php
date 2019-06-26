<?php

include("global.php");

ini_set('display_startup_errors', 1);

ini_set('display_errors', 1);

error_reporting(-1);



session_start();

if (!isset($_SESSION['name'])) {

    die("go log in dummy");

}

$name = $_SESSION["name"];



$gameData = getGame($name);

if ($gameData) {

    if ($gameData['active'] == "1") { //use existing game

        echo "here";

        $gameState = json_decode($gameData['gamestate']);

        $gameBoard = json_decode($gameData['gameboard']);

} else { //generate new game

        echo "there";

        $gameState = buildGameBoard(); //tracks user interaction

        $gameBoard = buildGameBoard(); //tracks locations of mines

        $gameBoard = populateMines($gameBoard);

        $gameBoard = populateCounts($gameBoard);

        persistGame($name, $gameState, $gameBoard);

    }

    $displayBoard = buildDisplayBoard($gameBoard, $gameState, null, $name);

}

function getGame($name) {

    $sql = "SELECT * FROM Users 

            WHERE username = '$name'";



    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

    if ($conn->connect_error) {

        die("couldn't connect");

    }



    $result = $conn->query($sql);



    if ($result) {

        $row = mysqli_fetch_array($result);

        return $row;

    }

    return null;

}



function persistGame($name, $gameState, $gameBoard) {

    echo "1";

    echo $name;

    $gameBoardString = json_encode($gameBoard);

    $gameStateString = json_encode($gameState);

    $sql = "UPDATE Users

            SET gameboard = '$gameBoardString', gamestate = '$gameStateString', active = 1

            WHERE username = '$name'";



    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

    if ($conn->connect_error) {

        die("persistGame couldn't connect");

    }

    echo "2";



    $result = $conn->query($sql);

    echo "3";

    echo mysqli_error($conn);

}



function buildGameBoard() {



    $board = array();

    for ($x = 0; $x < XMAX; $x++) {

        for ($y = 0; $y < YMAX; $y++) {

            $board[$x][$y] = 0;

        }

    }



    return $board;

}





function populateMines($board) {



    $mineCount = MINE_COUNT;

    while ($mineCount > 0) {



        $xCoord = rand(0, XMAX -1);

        $yCoord = rand(0, YMAX -1);



        if ($board[$xCoord][$yCoord] == 0) {

            $board[$xCoord][$yCoord] = BOMB;

            $mineCount--;

        }

    }

    return $board;

}



function populateCounts($board) {



    for ($x = 0; $x < XMAX; $x++) {

        for($y = 0; $y < YMAX; $y++) {

            if ($board[$x][$y] != -1) {

                $board[$x][$y] = getCellCount($x, $y, $board);

            }



        }

    }



    return $board;

}



function getCellCount($xCoord, $yCoord, $board) {



    $xMin = $xCoord-1 >= 0 ? $xCoord-1 : 0;

    $xMax = $xCoord+1 < XMAX ? $xCoord+1 : XMAX-1;

    $yMin = $yCoord-1 >= 0 ? $yCoord-1 : 0;

    $yMax = $yCoord+1 < YMAX ? $yCoord+1 : YMAX-1;

    $mineCount = 0;



    for ($x = $xMin; $x <= $xMax; $x++) {

        for ($y = $yMin; $y <= $yMax; $y++) {

            if ($board[$x][$y] == -1) {

                $mineCount++;

            }

        }

    }



    return $mineCount;



}



//generate gameState



//persist the board





?>

<html>

<head>

	

    <title>Minesweeper Game</title>

    <link href="style.css" rel="stylesheet" type="text/css" media="all">

</head>

<body>

<h1>Ultra Minesweeper</h1>

<h1><?php

echo "Welcome  " .$_SESSION["name"];

?></h1>



<h4>By: Us</h4>







<script>

    

    var timerVar = setInterval(countTimer, 1000);

    var totalSeconds = 0;

    function countTimer() {

        ++totalSeconds;

        var hour = Math.floor(totalSeconds / 3600);

        var minute = Math.floor((totalSeconds - (hour*3600))/ 60);

        var seconds = totalSeconds - ((hour*3600) + (minute*60));

        

        document.getElementById("timer").innerHTML = hour + ":" + minute + ":" + seconds;

    }

    

    

</script>



<h2><div id="timer"></div></h2>

<form action="login.php" method="post">

<input type="submit" value="Logout" id="logout">
</form>


<?php

echo "<table id='board' oncontextmenu='return false;'>";

for ($y = 0; $y < YMAX; $y++) {

    echo "<tr>";

    for ($x = 0; $x < XMAX; $x++) {

        $className = "";

        switch ($displayBoard[$x][$y]) {

            case BOMB:

                $className = "bomb";

                break;

            case FLAGGED_CELL:

                $className = "flagged";

                break;

            case FAIL_BOMB:

                $className = "bomb red";

                break;

            case INCORRECT_FLAG:

                $className = "incorrect";

                break;

            case UNTOUCHED_CELL:

                $className = "untouched";

                break;

            default:

                break;

        }

        echo "<td class='" . $className . "' id='" . $x . ":" . $y . "'>" . $displayBoard[$x][$y] . "</td>";

    }

    echo "</tr>";

}

echo "</table><br><br>";



?>

<script src="logic.js"></script>

</body>

</html>