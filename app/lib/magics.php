<?php
	
	//set_error_handler('errorHandler');
	spl_autoload_register('autoloadMVC');
	spl_autoload_register('autoloadLibs');
	
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
	
	function autoloadMVC($class)
	{
		$class = lcfirst(str_replace('Controller', '', $class));
		
		$file = __DIR__ . '/../controllers/' . $class . '.php';
			
		if(file_exists($file)){
			include_once __DIR__ . '/controller.php';
			include_once $file;
		}
	}

	function autoloadLibs($class)
	{		
		$file = __DIR__ . '/' . $class . '.php';
		
		if(file_exists($file)){
			include_once $file;
		}
	}
