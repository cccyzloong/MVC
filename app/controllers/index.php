<?php

	/**
	 * Index controller
	 */
	class controller_index extends controller
	{
		public function __construct($args)
		{
			pre_r(__CLASS__);
			
			parent::__construct($args);
		}
		
		public function run()
		{
			pre_r(__METHOD__);
			
			$this->view->smarty->display('index/run.tpl');
		}
		
		public function foo()
		{
			pre_r(__METHOD__);						
			
			if($this->Post){
				$this->model->insertData($this->Post);
			}
						
			$this->view->smarty->assign('data', $this->model->getData());
			
			$this->view->smarty->display('index/foo.tpl');
		}
	}
	