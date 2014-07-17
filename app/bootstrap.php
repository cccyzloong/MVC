<?php
	
	require_once __DIR__ . '/lib/magics.php';
	
	/**
	 * Bootstrap
	 */
	class Bootstrap
	{
		private $_request;
		
		public function __construct($url = FALSE)
		{			
			session_start();
			
			$this->loadConfig();
			
			error_reporting(ERROR_TYPE);
			
			$this->_request = $this->sortRequest($url);
		}
		
		public function run()
		{			
			$controllerClass = ucfirst($this->_request['controller']) . 'Controller';
			$action = $this->_request['action'];
			
			if(!class_exists($controllerClass) || !method_exists($controllerClass, $action)){
				$controllerClass = ucfirst(ERROR_CONTROLLER) . 'Controller';
				$action = DEFAULT_ACTION;
			} 
			
			$controller = new $controllerClass($this->_request);
			$controller->$action();
		}
		
		private function sortRequest($request = FALSE)
		{
			if($request){
				$request = array_filter(explode('/', $request));
				
				$array = array();
				
				foreach ($request as $key => $value) {
					if($key == 0){ $array['controller'] = $value; unset($request[$key]); }
					if($key == 1){ $array['action'] = $value; unset($request[$key]); }
				}
				
				if(!isset($array['action'])){ $array['action'] = DEFAULT_ACTION; }
				
				if(count($request) > 0){
					$request = array_values($request);
					
					$array['get'] = array();
					
					foreach($request as $key => $value){
						if(isset($request[0])){
							$array['get'][$request[0]] = isset($request[1]) ? $request[1] : '';
							unset($request[0], $request[1]);
							
							if(count($request) > 0){
								$request = array_values($request);
							}
						}
					}
				}
				
				if(isset($_POST) && !empty($_POST)){
					$array['post'] = $_POST;
					unset($_POST);
				}
				
				unset($_GET);
			} else {
				$array = array('controller' => DEFAULT_CONTROLLER, 'action' => DEFAULT_ACTION);
				
				if(isset($_POST) && !empty($_POST)){
					$array['post'] = $_POST;
					unset($_POST);
				}
			}
			
			return $array;
		}

		private function loadConfig()
		{
			$config = parse_ini_file(__DIR__ . '/config.ini');
			
			foreach($config as $key => $value){
				define($key, $value);
			}
		}
	}
	