<?php

	class Auth
	{
		public $model;
		private $_username;
		private $_password;
		
		public function __construct($args = FALSE)
		{
			$this->model = new Model();
			
			if($args){
				$this->_username = isset($args['username']) && !empty($args['username']) ? $args['username'] : FALSE;
				$this->_password = isset($args['password']) && !empty($args['password']) ? $args['password'] : FALSE;
			}
			
			if(!$this->isLoggedIn() && ($this->_username && $this->_password)){
				$user = $this->_checkUser($this->_username, $this->_password);
				
				if($user){
					$this->_login($user);
				}				
			}			
		}
		
		private function _checkUser($username, $password){
			if($username && $password){
				return $this->model->DB->query('SELECT * FROM user WHERE email = "' . $this->_username . '" AND password = "' . md5($this->_password) . '"')->fetch(); 
			}
		}
		
		public function isLoggedIn()
		{
			if(!isset($_SESSION['loginTime']) || isset($_SESSION['loginTime']) && (time() - $_SESSION['loginTime']) > LOGIN_EXPIRE){
				if(isset($_SESSION['userID']) && isset($_SESSION['loginTime'])){
					unset($_SESSION['userID'], $_SESSION['loginTime']);
				}
				
				return FALSE;
			} else if(isset($_SESSION['loginTime']) && (time() - $_SESSION['loginTime']) <= LOGIN_EXPIRE) {
				$_SESSION['loginTime'] = time();
				
				return TRUE;
			}
		}

		private function _login($user)
		{
			$_SESSION['userID'] = $user['id'];
			$_SESSION['loginTime'] = time();
			
			$this->model->DB->prepare('UPDATE user SET last_login = ?, ip = ? WHERE id = ?')->execute(array($_SESSION['loginTime'], $_SERVER['REMOTE_ADDR'], $_SESSION['userID']));
			
			pre_r($user);
		}
		
		public function logout()
		{
			if($this->isLoggedIn()){
				unset($_SESSION['userID'], $_SESSION['loginTime']);
			}
		}
	}
