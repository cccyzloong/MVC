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
				$user = $this->_checkUser($this->_username, $this->_password);
				$_SESSION['loged_user_id'] = $user['id'];
				
				pre_r($user);
			}
		}
		
		private function _checkUser($username, $password){
			if($this->_username && $this->_password){
				return $this->model->DB->query('SELECT * FROM user WHERE email = "' . $this->_username . '" AND password = "' . md5($this->_password) . '"')->fetch(); 
			}
		}
	}
