<?php

	/**
	 * Index controller
	 */
	class IndexController extends Controller
	{
		public function __construct($args)
		{			
			parent::__construct($args);
		}
		
		public function run()
		{
			$this->view->smarty->display('index/run.tpl');
		}
	}
	