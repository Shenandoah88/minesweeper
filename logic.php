<?php
	include("global.php");
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);

	//reads the post body from the javascript
	$postBody = file_get_contents('php://input');
	$postObject = json_decode($postBody);

	//build the response
	$response = (object)[];
	//these are just demo of how it works
	$response->cell = $postObject->cell;
	$response->button = $postObject->button;

//	$response->displayBoard = $displayBoard; //TODO put the actual displayboard in here

	echo json_encode($response);