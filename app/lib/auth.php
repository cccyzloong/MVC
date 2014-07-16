<?php

	class Auth
	{
		public $model;
		private $_username;
		private $_password;
		
		public function __construct($args = FALSE)
		{
			$this->model = new Model();
			
			//$user = $this->model->DB->query('SELECT * FROM user')->fetchAll();
			
			if($args){
				$this->_username = isset($args['username']) && !empty($args['username']) ? $args['username'] : FALSE;
				$this->_password = isset($args['password']) && !empty($args['password']) ? $args['password'] : FALSE;
			}
			
			if($this->_username && $this->_password){			
				//pre_r($this->_checkUser($this->_username, $this->_password));
			}
		}
		
		private function _checkUser($username, $password){
			if($this->_username && $this->_password){
				$stmt = $this->model->DB->prepare('SELECT * FROM user WHERE email = ? AND password = ?')->execute(array($this->_username, md5($this->_password))); 
				
				return $stmt->fetchAll(); 
			}
		}
	}
