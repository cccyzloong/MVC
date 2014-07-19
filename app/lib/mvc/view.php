<?php

	class View
	{
		public $smarty;
		
		public function __construct($args)
		{			
			include_once __DIR__ . '/../Smarty/libs/Smarty.class.php';
			
			$this->smarty = new Smarty();
			$this->smarty->template_dir = __DIR__ . '/../../templates/';
			$this->smarty->compile_dir = __DIR__ . '/../../temp/templates_c/';
			$this->smarty->config_dir = __DIR__ . '/../../temp/configs/';
			$this->smarty->cache_dir = __DIR__ . '/../../temp/cache/';
			
			//$this->smarty->compile_check = FALSE;
			//$this->smarty->force_compile = TRUE;
			
			//$this->smarty->caching = FALSE;						
			//$this->smarty->debugging = TRUE;
		}
	}
