<?php
	require_once('db.php');
	//require_once('getalltelevisions.php');
	$id = $_GET["televid"];

	try
	{
		$deletetelevisionstmt->execute(array(
	   	"televid" => "$id"
	   ));
		
	   echo json_encode(array(
	   	"deleteStatus" => true
	   ));

	   exit;
	}
	catch(PDOException $e) 
	{
	   $error = $e->getMessage();
		echo json_encode(array(
			"deleteStatus" => false, 
			"error" => $error
		));
		
	   exit;
	} 