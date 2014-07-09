<?php
	
	error_reporting(E_ALL);
	
	require_once('../app/bootstrap.php');
	
	$app = new bootstrap($_GET['url']);
	$app->run();
