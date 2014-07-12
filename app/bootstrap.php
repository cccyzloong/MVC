<?php
	
	require_once __DIR__ . '/lib/magics.php';
	
	/**
	 * Bootstrap
	 */
	class bootstrap
	{
		private $request;
		
		public function __construct($url = FALSE)
		{
			//pre_r(__CLASS__);
			
			$this->loadConfig();
			
			error_reporting(error_type);
			
			$this->request = $this->sortRequest($url);
		}
		
		public function run()
		{
			//pre_r(__METHOD__);
			
			$controllerClass = 'controller_' . $this->request['controller'];
			$action = $this->request['action'];
			
			if(!class_exists($controllerClass)){
				$controllerClass = 'controller_' . error_controller;
				$action = 'run';
			} 
			
			$controller = new $controllerClass($this->request);
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
				
				if(!isset($array['action'])){ $array['action'] = default_action; }
				
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
				$array = array('controller' => default_controller, 'action' => default_action);
				
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
	