<?php
	ini_set("date.timezone", "Asia/Kuala_Lumpur");
	
	require_once('db.php'); 
	//require_once('getalltelevisions.php');
	
	$type = $_POST["type"];
	$company = $_POST["company"];
	$size = $_POST["size"];
	$price = $_POST["price"];
	
	//insert into table contact
	try 
	{
		$inserttelevisionstmt->execute(array(
        	"type" => "$type", 
			"company" => "$company", 
			"size" => "$size",
			"price" => "$price"
		));
	}
	catch(PDOException $e) 
	{
		$errorMessage = $e->getMessage();
		$data = Array(
			"insertStatus" => false,
			"errorMessage" => $errorMessage
		);	
		echo json_encode($data);
		exit;
	}
	
	$data = Array(
		"insertStatus" => true,
		"type" => "$type", 
		"company" => "$company", 
		"size" => "$size",
		"price" => "$price"
	);
	
	echo json_encode($data);