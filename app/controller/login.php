<?php

	/**
	 * Index controller
	 */
	class LoginController extends Controller
	{
		public function __construct($args)
		{
			//pre_r(__CLASS__);
			
			parent::__construct($args);
		}
		
		public function run()
		{
			//pre_r(__METHOD__);
			
			$this->view->smarty->assign('session', $_SESSION);
			
			$this->view->smarty->display('login/run.tpl');
		}
	}
	