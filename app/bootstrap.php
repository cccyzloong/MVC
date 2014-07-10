<?php
	
	/**
	 * Bootstrap
	 */
	class bootstrap
	{
		private $request;
		
		public function __construct($url = FALSE)
		{
			echo '<pre>';
			echo __CLASS__;
			
			$this->request = $this->sortRequest($url);
		}
		
		public function run()
		{
			echo '<pre>';
			echo __METHOD__;
			
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
				
				$action = isset($request['action']) && method_exists($controller, $request['action']) ? $request['action'] : 'run';
				
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
				}
				
				return $array;
			} else {
				$array = array('controller' => 'index');
				
				if(isset($_POST) && !empty($_POST)){
					$array['post'] = $_POST;
				}
				
				return $array;
			}
		}
	}
	