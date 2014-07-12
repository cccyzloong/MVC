<?php

	require_once('../app/bootstrap.php');
	
	$app = new bootstrap(isset($_GET['url']) ? $_GET['url'] : FALSE);
	$app->run();
