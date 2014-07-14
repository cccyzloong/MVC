<?php

	/**
	 * Error controller
	 */
	class ErrorController extends Controller
	{
		public function __construct($args)
		{
			//pre_r(__CLASS__);
			
			parent::__construct($args);
		}
		
		public function run()
		{
			//pre_r(__METHOD__);
			
			$this->view->smarty->display('error/run.tpl');
		}
	}
	