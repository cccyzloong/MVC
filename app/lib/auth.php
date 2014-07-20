<?php

	class Auth
	{
		public $model;
		private $_username;
		private $_password;
		public $error = FALSE;
		
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
				$hash = md5($password);
					
				$stmt = $this->model->DB->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
				$stmt->execute(array($username, $hash));
				$user = $stmt->fetch();

				if($user && !empty($user)){
					if($user['status'] == 0){
						$this->error = 'Benutzerkonto wurde nicht aktiviert.';
						
						return FALSE;
					} else if($user['status'] == 2){
						$this->error = 'Dieser Benutzerkonto wurde gesperrt, bis: ' . date('d.m.Y H:i:s', $user['blocked_until']);
						
						return FALSE;
					} else {
						return $user;
					}
				} else {
					$stmt = $this->model->DB->prepare('SELECT email FROM user WHERE email = ?');
					$stmt->execute(array($username));
					$hasUsername = $stmt->fetch();
					
					if($hasUsername !== FALSE){
						$stmt = $this->model->DB->prepare('SELECT password FROM user WHERE password = ?');
						$stmt->execute(array($hash));
						$hasPassword = $stmt->fetch();
						
						if($hasPassword !== FALSE){						
							return $user;
						} else {
							$this->error = 'Sie haben falsche Zugangsdaten eingegeben! Bitte versuchen Sie es erneut. ';
							
							$this->model->DB->prepare('UPDATE user SET login_fails = login_fails + 1')->execute(array($username, $hash));
							
							$stmt = $this->model->DB->prepare('SELECT login_fails FROM user WHERE email = ?');
							$stmt->execute(array($username));
							$loginFails = $stmt->fetch();
							$loginFails = $loginFails['login_fails'];
							
							$this->error .= 'Sie haben noch ' . (MAX_LOGIN_FAILS - $loginFails) . ' Versuch(e)!';
							
							if(MAX_LOGIN_FAILS <= $loginFails){
								$blockedUntil = strtotime('+1 day');
								
								$this->model->DB->prepare('UPDATE user SET status = ? AND blocked_until = ? WHERE email = ?')->execute(array('2', $blockedUntil, $username));
								
								$this->error = 'Dieser Benutzerkonto wurde gesperrt, bis: ' . date('d.m.Y H:i:s', $blockedUntil);
							}
							
							return FALSE;
						}
					} else {
						$this->error = 'Benutzerkonto exsistiert nicht!';
											
						return FALSE;
					}
				}
			} else {
				return FALSE;
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
		}
		
		public function logout()
		{
			if($this->isLoggedIn()){
				unset($_SESSION['userID'], $_SESSION['loginTime']);
			}
		}
	}
