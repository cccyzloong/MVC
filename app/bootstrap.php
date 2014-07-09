<?php

	/**
	 * Bootstrap
	 */
	class bootstrap
	{
		private $url;
		public $smarty;
		
		public function __construct($url = FALSE)
		{
			$this->url = $url;
			
			echo '<pre>';
			echo __METHOD__;
		}
		
		public function run()
		{
			$this->route($this->url);
			
			echo '<pre>';
			echo __METHOD__;
			
			echo '<pre>';
			print_r($this->url);
		}
		
		private function route($url = FALSE)
		{
			if($url && !empty($url) && count($url) > 0){
				$this->url = array_filter(explode('/', $url));
				
				$this->initModules();
				$this->initModels();
				$this->initViews();
				$this->initControllers();
			} else {
				include_once 'controllers/index.php';
				
				$controller = new index();								
			}
		}
		
		private function initModules()
		{
			$file = 'modules/' . $this->url[0] . '.php';
			
			if(file_exists($file)){
				include_once $file;
				unset($this->url[0]);
			} else {
				return FALSE;
			}
		}
		
		private function initModels()
		{
			$file = 'models/' . $this->url[0] . '.php';
			
			if(file_exists($file)){
				include_once $file;
				unset($this->url[0]);
			} else {
				return FALSE;				
			}
		}
		
		private function initViews()
		{
			$file = 'views/' . $this->url[0] . '.php';
			
			if(file_exists($file)){
				include_once $file;
				unset($this->url[0]);
			} else {
				return FALSE;				
			}	
		}
		
		private function initControllers()
		{
			$file = 'controllers/' . $this->url[0] . '.php';
			
			if(file_exists($file)){
				include_once $file;
				unset($this->url[0]);
			} else {
				return FALSE;				
			}
		}		
	}
	