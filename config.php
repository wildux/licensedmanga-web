<?php
	if (session_status() == PHP_SESSION_NONE){
		//ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
		//ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 7);
		//ini_set('session.save_path', '/sessions');
		session_start();
	 }
?>
