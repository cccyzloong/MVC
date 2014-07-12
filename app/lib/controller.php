<?php

	class controller
	{
		public $Get;
		public $Post;
		public $view;
		public $model;
		
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
			
			$this->view = new view($args);
			
			$model = 'model_' . $args['controller'];

			$this->model = class_exists($model) ? new $model($args) : FALSE;
			
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
