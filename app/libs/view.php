<?php

	class view
	{
		public $smarty;
		
		public function __construct($args)
		{
			pre_r(__CLASS__);
			
			include_once __DIR__ . '/Smarty/libs/Smarty.class.php';
			
			$this->smarty = new Smarty();
			$this->smarty->template_dir = __DIR__ . '/../templates/';
			$this->smarty->compile_dir = __DIR__ . '/../temp/templates_c/';
			$this->smarty->config_dir = __DIR__ . '/../temp/configs/';
			$this->smarty->cache_dir = __DIR__ . '/../temp/cache/';
			
			$this->smarty->assign('controller', $args['controller']);
			$this->smarty->assign('action', isset($args['action']) ? $args['action'] : FALSE);
			
			//$this->smarty->debugging = TRUE;
		}
	}
