<?php
	require_once('../includes/config.php');	
	
	$stmt = $db->query('SELECT * FROM volumes');	
	
	// array for JSON response
	$response = array();		
	
	if($stmt->rowCount() > 0) {	
		$response["volumes"] = array();		 
		while($result = $stmt->fetch()){
			
			$volume = array();
			$volume["id"] = $result["id"];
			$volume["id_serie"] = $result["id_serie"];                
			$volume["number"] = $result["number"]; 
			$volume["price"] = $result["price"]; 
			$volume["price_can"] = $result["price_can"]; 
			$volume["release_date"] = $result["release_date"]; 
			$volume["comments"] = $result["comments"];
			
			// ADD    
			array_push($response["volumes"], $volume);		
		}  
		// OK
		$response["success"] = 1;
	 
		header('Content-type: application/json');
		echo json_encode($response);
	}
	else {
		$response["success"] = 0;	
		$response["msg"] = 'No results'; 
		header('Content-type: application/json');
		echo json_encode($response);
	}   
    
    
    
?>
