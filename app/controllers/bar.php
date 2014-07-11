<?php

	/**
	 * Bar controller
	 */
	class controller_bar extends controller
	{
		public function __construct($args)
		{
			//$this->pre_r(__CLASS__);
			
			parent::__construct($args);
		}
		
		public function run()
		{
			//$this->pre_r(__METHOD__);
			//$this->pre_r($this->Get);
			//$this->pre_r($this->Post);
			
			$this->view->smarty->display('bar/run.tpl');
		}
	}
	