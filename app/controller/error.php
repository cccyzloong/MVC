<?php

	/**
	 * Error controller
	 */
	class ErrorController extends Controller
	{
		public $controllerExist;
		public $actionExist;
		
		public function __construct($args)
		{
			//pre_r(__CLASS__);
			
			$this->controllerExist = class_exists(ucfirst($args['controller']) . 'Controller') ? TRUE : FALSE;
			$this->actionExist = method_exists(ucfirst($args['controller']) . 'Controller', $args['action']) ? TRUE : FALSE;
			
			parent::__construct($args);
		}
		
		public function run()
		{
			//pre_r(__METHOD__);
						
			$this->view->smarty->assign('controllerExist', $this->controllerExist);
			$this->view->smarty->assign('actionExist', $this->actionExist);
			
			$this->view->smarty->display('error/run.tpl');
		}
	}
	