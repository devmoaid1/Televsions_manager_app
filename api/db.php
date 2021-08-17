<?php
	//PDO
	function dbStart($address, $login, $password) 
	{
		try 
		{
			$db = new PDO($address, $login, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		} 
		catch(PDOException $e) 
		{
	    	echo 'ERROR: ' . $e->getMessage();
		}	
		
		return $db;
	}

	function prepareDbStatement($db,
								&$inserttelevisionstmt,
								&$selectAlltelevisionstmt,
								&$selecttelevisionsViaIdStmt,
								&$updatetelevisionstmt,
								&$deletetelevisionstmt
							    )
	{
		try 
		{		
			$inserttelevisionstmt = $db->prepare("INSERT INTO televisions(type, company, size, price) 
                                               VALUES (:type, :company, :size, :price)");		

			$selectAlltelevisionstmt = $db->prepare('SELECT *
											      FROM televisions
											      
												  ORDER BY televid ASC'); 	

			$selecttelevisionsViaIdStmt = $db->prepare('SELECT *
													FROM televisions
													WHERE televid = :televid'); 

			$updatetelevisionstmt = $db->prepare('UPDATE televisions
                 							   SET price = :price,
						                       size = :size
                 							   WHERE televid = :televid');

		
											   
	        $deletetelevisionstmt = $db->prepare('DELETE 
							                   FROM televisions
							                   WHERE televid = :televid'); 

							                   		
		} 
		catch(PDOException $e) 
		{
	    	echo 'ERROR: ' . $e->getMessage();	
		}	
	}

	$address = 'mysql:host=localhost;dbname=televisions;charset=utf8';
	$login = "root";
	$password = "";
	$db = null;
	$db = dbStart($address, 
	              $login, 
				  $password);
				  
	$inserttelevisionstmt = null;				  
	$selectAlltelevisionstmt = null;			  
	$selecttelevisionsViaIdStmt = null;	
	$updatetelevisionstmt = null;

	$deletetelevisionstmt = null;

	
	
					   
	prepareDbStatement($db,
					   $inserttelevisionstmt,
					   $selectAlltelevisionstmt,
					   $selecttelevisionsViaIdStmt,
					   $updatetelevisionstmt,
					   
					   $deletetelevisionstmt
					);