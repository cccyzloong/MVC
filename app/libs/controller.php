<?php

	class controller
	{
		public $Get;
		public $Post;
		public $view;
		public $model;
		
		public function __construct($args)
		{
			pre_r(__CLASS__);
			
			if(isset($args['get'])){
				$this->Get = $args['get'];
				unset($args['get']);
			}
			
			if(isset($args['post'])){
				$this->Post = $args['post'];
				unset($args['post']);
			}
			
			$this->loadView($args);
			
			$this->loadModel($args);
			
			$this->view->smarty->assign('get', $this->Get);
			$this->view->smarty->assign('post', $this->Post);
		}
		
		private function loadView($args)
		{
			include_once __DIR__ . '/view.php';
			
			$this->view = new view($args);
		}
		
		private function loadModel($args)
		{
			$file = __DIR__ . '/../models/' . $args['controller'] . '.php';
			$model = 'model_' . $args['controller'];
			
			if(file_exists($file)){
				include_once __DIR__ . '/model.php';
				include_once $file;
				
				$this->model = new $model($args);
			} else {
				return FALSE;
			}
		}
	}
