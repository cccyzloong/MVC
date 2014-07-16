<?php

	class Auth extends Model
	{
		public $model;
		private $_username;
		private $_password;
		
		public function __construct($args = FALSE)
		{
			//$this->model = parent::__construct();
			
			//$user = $this->model->DB->query('SELECT * FROM user')->fetchAll();
			
			if($args){
				$this->_username = isset($args['username']) && !empty($args['username']) ? $args['username'] : FALSE;
				$this->_password = isset($args['password']) && !empty($args['password']) ? $args['password'] : FALSE;
			}
			
			if($this->_username && $this->_password){			
				pre_r($this->_checkUser());
			}
		}
		
		private function _checkUser(){
			if($this->_username && $this->_password){
				return $this->model->DB->query('SELECT * FROM user')->fetchAll();
			}
		}
	}
