<?php
    include("global.php");
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);

	$gameBoard = array();
    for ($x = 0; $x < XMAX; $x++) {
        for ($y = 0; $y < YMAX; $y++) {
            $gameBoard[$x][$y] = "test" . $x . " " . $y;
        }
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