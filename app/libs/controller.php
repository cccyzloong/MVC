<?php

	class controller
	{
		public $Get;
		public $Post;
		private $controller;
		private $action;
		
		public function __construct($args)
		{
			echo '<pre>';
			echo __CLASS__;
			
			$this->Get = $args['get'];
			unset($args['get']);
			
			if(isset($args['post'])){
				$this->Post = $args['post'];				
				unset($args['post']);
			}
			
			$this->controller = $args['controller'];
		}
		
		public function run()
		{
			echo '<pre>';
			echo __METHOD__;
			
			$controller = new $this->controller();
			$controller->run();
		}
		
		public function foo()
		{
			echo '<pre>';
			echo __METHOD__;
		}
	}
