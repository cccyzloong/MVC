<?php

	/**
	 * Index controller
	 */
	class LoginController extends Controller
	{
		public function __construct($args)
		{			
			parent::__construct($args);
		}
		
		public function run()
		{			
			$this->view->smarty->assign('session', $_SESSION);
			
			$this->view->smarty->display('login/run.tpl');
		}
	}
	