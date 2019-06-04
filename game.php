<?php
    include("global.php");
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);

	$gameBoard = buildGameBoard();
	echo json_encode($gameBoard);
	echo "<br><br><br>";
	$gameBoard = populateMines($gameBoard);
	echo json_encode($gameBoard);
	echo "<br><br><br>";
	$gameBoard = populateCounts($gameBoard);
	echo json_encode($gameBoard);
	echo "<br><br><br>";

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

	        $xCoord = rand(0, XMAX-1);
			$yCoord = rand(0, YMAX-1);

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

		echo "xCoord = " . $xCoord . " and yCoord = " . $yCoord . "<br>";
		echo "xMin = " . $xMin . " and yMin = " . $yMin . "<br>";
		echo "xMax = " . $xMax . " and yMax = " . $yMax . "<br>";
		for ($x = $xMin; $x <= $xMax; $x++) {
		    for ($y = $yMin; $y <= $yMax; $y++) {
		        echo "      inside: x = " . $x . " and y = " . $y . "<br>";
		        if ($x != $xCoord && $y != $yCoord) {
		            if ($board[$x][$y] == -1) {
		                $mineCount++;
                    }
                }
            }
        }
		echo "mineCount = " . $mineCount . "<br>";
		echo "<br>";

        return $mineCount;

    }



?>
<html>
    <head>
        <title>Minesweeper Game</title>
        <link href="style.css" rel="stylesheet" type="text/css" media="all">
    </head>
    <body>
        <?= json_encode($gameBoard) ?>

        <script src="logic.js"></script>
    </body>
</html>