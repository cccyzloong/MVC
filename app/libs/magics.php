<?php
	
	set_error_handler('errorHandler');
	
	function errorHandler($errno, $errstr, $errfile, $errline, $errcontex)
	{
		$message = '#' . $errno . ' in Class: ' . __CLASS__ . ' and Method: ' . __METHOD__ . ' on line: ' . $errline;
		
		echo '<pre>';
		echo $message;
		echo '</pre>';
		
		error_log($message);
	}
	
	function pre_r($data = FALSE)
	{
		if($data){
			echo '<pre>';
				if(is_array($data) || is_object($data)){
					print_r($data);
				} else {
					echo $data;
				}
			echo '</pre>';
		}
	}