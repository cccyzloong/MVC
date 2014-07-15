<?php

	require_once('../app/bootstrap.php');
	
	$app = new Bootstrap(isset($_GET['url']) ? $_GET['url'] : FALSE);
	$app->run();
