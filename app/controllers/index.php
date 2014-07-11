<?php

	/**
	 * Index controller
	 */
	class controller_index extends controller
	{
		public function __construct($args)
		{
			//$this->pre_r(__CLASS__);
			
			parent::__construct($args);
		}
		
		public function run()
		{
			//$this->pre_r(__METHOD__);
			//$this->pre_r($this->Get);
			//$this->pre_r($this->Post);
			
			$this->view->smarty->display('index/run.tpl');
		}
		
		public function foo()
		{
			//$this->pre_r(__METHOD__);						
			
			if($this->Post){
				$this->model->insertData($this->Post);
			}
						
			$this->view->smarty->assign('data', $this->model->getData());
			
			$this->view->smarty->display('index/foo.tpl');
		}
	}
	