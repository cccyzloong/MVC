<?php

	class controller
	{
		public $Get;
		public $Post;
		public $view;
		
		public function __construct($args)
		{
			//$this->pre_r(__CLASS__);
			
			if(isset($args['get'])){
				$this->Get = $args['get'];
				unset($args['get']);
			}
			
			if(isset($args['post'])){
				$this->Post = $args['post'];
				unset($args['post']);
			}
			
			$this->loadView($args);
			
			$this->view->smarty->assign('get', $this->Get);
			$this->view->smarty->assign('post', $this->Post);
		}
		
		private function loadView($args)
		{
			include_once __DIR__ . '/view.php';
			
			$this->view = new view($args);
		}
		
		public static function pre_r($data = FALSE)
		{
			if($data){
				echo '<pre>';
				if(is_array($data) || is_object($data)){
					print_r($data);
				} else {
					echo $data;
				}
				echo '</pre>';
			}
		}
	}
