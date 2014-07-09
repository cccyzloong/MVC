<?php

	/**
	 * Bootstrap
	 */
	class bootstrap
	{
		public $url;
		public $smarty;
		
		public function __construct($url = FALSE)
		{			
			if($url != FALSE){
				$this->url = array_filter(explode('/', $url));				
			}		
		}
		
		public function run()
		{
			echo '<pre>';
			echo __METHOD__;
			
			echo '<pre>';
			print_r($this->url);
			
			$this->smarty = $this->initSmarty();
		}
		
		public function initSmarty()
		{
			require_once 'libs/Smarty/libs/Smarty.class.php';
		}
	}
	