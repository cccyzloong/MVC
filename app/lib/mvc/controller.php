<?php

	class Controller
	{
		public $Get;
		public $Post;
		public $view;
		public $model;
		private $_auth;
		
		public function __construct($args)
		{
			//pre_r(__CLASS__);
			
			if(isset($args['get'])){
				$this->Get = $args['get'];
				unset($args['get']);
			}
			
			if(isset($args['post'])){
				$this->Post = $args['post'];
				unset($args['post']);
			}
			
			$this->view = new View($args);
			
			$model = ucfirst($args['controller']) . 'Model';

			$this->model = class_exists($model) ? new $model($args) : FALSE;
			
			$this->_auth = new Auth($this->Post);
			//$this->_auth->logout();
			
			$this->view->smarty->assign('controller', $args['controller']);
			$this->view->smarty->assign('action', isset($args['action']) ? $args['action'] : FALSE);
			$this->view->smarty->assign('get', $this->Get);
			$this->view->smarty->assign('post', $this->Post);
		}
		
		public function redirect($location = FALSE)
		{
			$location = $location && !empty($location) ? $location : '/';
			$location = $location[0] != '/' ? '/' . $location : $location;
			
			header('Location: ' . $location);
		}
	}
