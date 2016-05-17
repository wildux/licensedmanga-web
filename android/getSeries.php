<?php
	require_once('../includes/config.php');	
	
	$stmt = $db->query('SELECT * FROM series ORDER BY title');	
	
	// array for JSON response
	$response = array();			
	
	if($stmt->rowCount() > 0) {	
		$response["series"] = array();
		while($result = $stmt->fetch()){
			
			$serie = array();
			$serie["id"] = $result["id"];
			$serie["title"] = $result["title"];
			$serie["orig_title"] = $result["orig_title"];
			$serie["description"] = $result["description"];
			$serie["tags"] = $result["tags"];
			$serie["type"] = $result["type"];    
			$serie["state"] = $result["state"];      
			
			// ADD    
			array_push($response["series"], $serie);		
		}  
		// OK
		$response["success"] = 1;
	 
		header('Content-type: application/json');		
		echo json_encode($response);
		//var_dump($response);
	}
    else {
		$response["success"] = 0;	
		$response["msg"] = 'No results'; 
		header('Content-type: application/json');
		echo json_encode($response);
	}
    
    
    
?>
