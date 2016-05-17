<?php
require_once('includes/config.php');

$user->logout();
header("Location: ".$_SERVER['HTTP_REFERER']); 
exit;
