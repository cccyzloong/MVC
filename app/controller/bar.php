<?php

	/**
	 * Bar controller
	 */
	class controller_bar extends controller
	{
		public function __construct($args)
		{
			//pre_r(__CLASS__);
			
			parent::__construct($args);
		}
		
		public function run()
		{
			pre_r(__METHOD__);
			
			$this->view->smarty->display('bar/run.tpl');
		}
	}
	