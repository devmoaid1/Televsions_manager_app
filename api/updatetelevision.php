<?php
	require_once('db.php'); 
	
	$id = $_GET["televid"];
	
	$price = $_POST["price"];
	$size = $_POST["size"];
	
	
	//insert into database
	try 
	{
		$updatetelevisionstmt->execute(array(
			"size" => "$size", 
        	"price" => "$price", 
			"televid" => "$id"
		));
	}
	catch(PDOException $e) 
	{
		$errorMessage = $e->getMessage();
		$data = Array(
			"updateStatus" => false,
			"errorMessage" => $errorMessage
		);	
		echo json_encode($data);
		exit;
	}
	
	$data = Array(
		"updateStatus" => true,
		"price" => $price,
		"size" => $size,
		
	);
	
	echo json_encode($data);