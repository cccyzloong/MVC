<?php

	class Controller
	{
		public $GET;
		public $POST;
		public $model;
		public $view;		
		private $_auth;
		
		public function __construct($args)
		{			
			$this->_setGetAndPost($args);
			
			$this->view = new View($args);
			
			$model = ucfirst($args['controller']) . 'Model';

			$this->model = class_exists($model) ? new $model($args) : FALSE;
			
			$this->_auth = new Auth($this->POST);
			
			if($args['controller'] != LOGIN_CONTROLLER && !$this->_auth->isLoggedIn()){
				$this->redirect(LOGIN_CONTROLLER);
			}
			
			if($this->_auth->isLoggedIn() && $args['controller'] == LOGIN_CONTROLLER){
				$this->redirect('/');
			}
			
			if(isset($this->POST['logout']) && $this->POST['logout'] && $this->_auth->isLoggedIn()){
				$this->_auth->logout();
				
				if($args['controller'] != LOGIN_CONTROLLER){
					$this->redirect(LOGIN_CONTROLLER);
				}
			}
			
			if($this->_auth->error){
				$this->view->smarty->assign('alert', $this->_auth->error);
			}
				
			$this->view->smarty->assign('isLoggedIn', $this->_auth->isLoggedIn());
			$this->view->smarty->assign('controller', $args['controller']);
			$this->view->smarty->assign('action', isset($args['action']) ? $args['action'] : FALSE);
			$this->view->smarty->assign('get', $this->GET);
			$this->view->smarty->assign('post', $this->POST);
		}
		
		private function _setGetAndPost($args)
		{
			if(isset($args['get'])){
				$this->GET = $args['get'];
				unset($args['get']);
			}
			
			if(isset($args['post'])){
				$this->POST = $args['post'];
				unset($args['post']);
			}
		}
		
		public function redirect($location = FALSE)
		{
			$location = $location && !empty($location) ? $location : '/';
			$location = $location[0] != '/' ? '/' . $location : $location;
			
			header('Location: ' . $location);
		}
	}
