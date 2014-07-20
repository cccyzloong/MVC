<?php

	class LoginController extends Controller
	{
		public function __construct($args)
		{			
			parent::__construct($args);
		}
		
		public function indexAction()
		{
			$this->view->setMetaTitle('Login');
									
			$this->view->smarty->assign('session', $_SESSION);
			
			$this->view->smarty->display('login/index.tpl');
		}
	}
	