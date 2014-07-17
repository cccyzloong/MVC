<?php

	class Controller
	{
		public $Get;
		public $Post;
		public $model;
		public $view;		
		private $_auth;
		
		public function __construct($args)
		{			
			$this->_setGetAndPost($args);
			
			$this->view = new View($args);
			
			$model = ucfirst($args['controller']) . 'Model';

			$this->model = class_exists($model) ? new $model($args) : FALSE;
			
			$this->_auth = new Auth($this->Post);
			
			if($args['controller'] != LOGIN_CONTROLLER && !$this->_auth->isLoggedIn()){
				$this->redirect(LOGIN_CONTROLLER);
			}
			
			if($this->_auth->isLoggedIn() && $args['controller'] == LOGIN_CONTROLLER){
				$this->redirect(DEFAULT_CONTROLLER);
			}
			
			if(isset($this->Post['logout']) && $this->Post['logout'] && $this->_auth->isLoggedIn()){
				$this->_auth->logout();
				
				if($args['controller'] != LOGIN_CONTROLLER){
					$this->redirect(LOGIN_CONTROLLER);
				}
			}
						
			$this->view->smarty->assign('isLoggedIn', $this->_auth->isLoggedIn());
			$this->view->smarty->assign('controller', $args['controller']);
			$this->view->smarty->assign('action', isset($args['action']) ? $args['action'] : FALSE);
			$this->view->smarty->assign('get', $this->Get);
			$this->view->smarty->assign('post', $this->Post);
		}
		
		private function _setGetAndPost($args)
		{
			if(isset($args['get'])){
				$this->Get = $args['get'];
				unset($args['get']);
			}
			
			if(isset($args['post'])){
				$this->Post = $args['post'];
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
