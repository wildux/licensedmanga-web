<?php
ob_start();
session_start();

//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','joruntu');
define('DBNAME','manga');

$db = new PDO("mysql:host=".DBHOST.";port=8889;dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//set timezone
date_default_timezone_set('Europe/London');

//load classes as needed
function __autoload($class) {
   
	$class = strtolower($class);
	
	$classpath = 'classes/class.'.$class . '.php';
	if ( file_exists($classpath)) {
		require_once $classpath;
	} 		
	
	$classpath = '../classes/class.'.$class . '.php';
	if ( file_exists($classpath)) {
		require_once $classpath;
	}
	
	$classpath = '../../classes/class.'.$class . '.php';
	if ( file_exists($classpath)) {
		require_once $classpath;
	} 		
	 
}

$user = new User($db); 
include('functions.php');
