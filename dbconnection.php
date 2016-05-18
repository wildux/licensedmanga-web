<?php
    // DB INFO
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "manga";     
    //$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
     
   	// CONNECTION
    /*try 
    {        
        //$db = new PDO("mysql:host={$servername};dbname={$dbname};charset=utf8", $username, $password, $options);
        $conn = new mysqli($servername, $username, $password, $dbname); 
    }
     Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}  
    catch(PDOException $ex) 
    {       
        die("Failed to connect to the database");
    }     
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
     
            
    header('Content-Type: text/html; charset=utf-8');       
    */
    
    
    // SESSION
    //session_start();
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");  
