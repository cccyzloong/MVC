<?php
	
	set_error_handler('errorHandler');
	spl_autoload_register('autoloadMVC');
	spl_autoload_register('autoloadMVCLibs');
	spl_autoload_register('autoloadLibs');
	
	function errorHandler($errno, $errstr, $errfile, $errline, $errcontex)
	{
		$message = '#' . $errno . ' <strong>' . $errstr . '</strong> in File <strong>' . $errfile . '</strong> on line <strong>' . $errline . '</strong>';
			
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
		$className = strtolower(str_replace(array('Controller', 'Model'), '', $class));
		$classSufix = strtolower(str_ireplace($className, '', $class));
		
		$file = __DIR__ . '/../' . $classSufix . '/' . $className . '.php';
		
		if(file_exists($file)){ //echo 'MVC: ' . $file . '<br />';
			include_once $file;
		}
	}
	
	function autoloadMVCLibs($class)
	{		
		$file = __DIR__ . '/mvc/' . lcfirst($class) . '.php';

		if(file_exists($file)){ //echo 'MVC Lib: ' . $file . '<br />';
			include_once $file;
		}
	}
	
	function autoloadLibs($class)
	{		
		$file = __DIR__ . '/' . lcfirst($class) . '.php';
		
		if(file_exists($file)){ //echo 'Libs: ' . $file  . '<br />';
			include_once $file;
		}
	}
