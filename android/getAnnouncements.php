<?php
	require_once('../includes/config.php');	
	
	$stmt = $db->query('SELECT * FROM announcements ORDER BY day');	
	
	// array for JSON response
	$response = array();			
	
	if($stmt->rowCount() > 0) {	
		$response["licenses"] = array(); 
		while($result = $stmt->fetch()){
			
			$serie = array();
			$serie["id_serie"] = $result["id_serie"];
			$serie["day"] = $result["day"];         
			
			// ADD    
			array_push($response["licenses"], $serie);		
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
