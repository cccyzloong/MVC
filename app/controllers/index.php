<?php

	/**
	 * Index controller
	 */
	class index extends controller
	{
		public function __construct($args)
		{
			echo '<pre>';
			echo __CLASS__;
			
			parent::__construct($args);
		}
		
		public function run()
		{
			echo '<pre>';
			echo __METHOD__;
			
			echo '<pre>';
			print_r($this->Get);
			
			echo '<pre>';
			print_r($this->Post);
		}
	}
	