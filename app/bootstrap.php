<?php
	
	/**
	 * Bootstrap
	 */
	class bootstrap
	{
		private $request;
		
		public function __construct($url = FALSE)
		{
			//$this->pre_r(__CLASS__);
			
			set_error_handler(array($this, 'errorHandler'));
			
			$this->request = $this->sortRequest($url);
		}
		
		public function run()
		{
			//$this->pre_r(__METHOD__);
			
			$this->autoload($this->request);
		}
		
		private function autoload($request)
		{			
			$controllerClassName = $request['controller'];
			$file = __DIR__ . '/controllers/' . $controllerClassName . '.php';
			
			include_once __DIR__ . '/libs/controller.php';
			
			if(file_exists($file)){
				include_once $file;
				
				$controller = new $controllerClassName($this->request);
				
				$action = $request['action'];
				
				$controller->$action();
			}		
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
				
				if(!isset($array['action'])){ $array['action'] = 'run'; }
				
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
				
				return $array;
			} else {
				$array = array('controller' => 'index', 'action' => 'run');
				
				if(isset($_POST) && !empty($_POST)){
					$array['post'] = $_POST;
					unset($_POST);
				}
				
				return $array;
			}
		}

		public function errorHandler($errno, $errstr, $errfile, $errline, $errcontex)
		{
			$message = '#' . $errno . ' in Class: ' . __CLASS__ . ' and Method: ' . __METHOD__ . ' on line: ' . $errline;
			
			echo '<div style="color:red">';
			echo $message;
			echo '</div>';
			
			error_log($message);
		}
		
		public static function pre_r($data = FALSE)
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
	}
	