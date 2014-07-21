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
			
			$this->_username = isset($args['username']) && !empty($args['username']) ? $args['username'] : FALSE;
			$this->_password = isset($args['password']) && !empty($args['password']) ? $args['password'] : FALSE;
			
			if(!$this->isLoggedIn() && ($this->_username != FALSE && $this->_password != FALSE)){
				$user = $this->_getUserAndHandleAuth($this->_username, $this->_password);
				
				if($user != FALSE){
					$this->_login($user);
				}
			}
		}
		
		private function _getUserAndHandleAuth($username, $password){		
			$stmt = $this->model->DB->prepare('SELECT * FROM user WHERE email = ?');
			$stmt->execute(array($username));
			$user = $stmt->fetch();
			
			if($user && !empty($user)){
				$id = $user['id'];
				$loginFails = $user['login_fails'];
				$status = $user['status'];
				$blockedUntil = $user['blocked_until'];
				$hash = $user['password'];
				
				$ip = $_SERVER['REMOTE_ADDR'];
				$timeStamp = time();
				$blockUntil = strtotime('+' . USER_BLOCKED_TIME . ' seconds', $timeStamp);
				
				switch ($status) {
					case 0:
						
						if($this->_checkPassword($password, $user['password'])){
							$this->error = 'AUTH_ACCOUNT_NOT_ACTIVATED';
						} else {
							$this->error = 'AUTH_WRONG_LOGIN_DATA';
						}
						
						return FALSE;
						
						break;
					
					case 1:
						
						if((MAX_LOGIN_FAILS - $loginFails) > 1){
							if($this->_checkPassword($password, $hash)){
								$this->model->DB->prepare('UPDATE user SET last_login = ?, login_ip = ?, login_fails = ?, login_fail_ip = ? WHERE id = ?')->execute(array($timeStamp, $ip, 0, '', $id));
								
								return $user;
							} else {
								$this->model->DB->prepare('UPDATE user SET login_fails = login_fails + 1, login_fails_sum = login_fails_sum + 1, login_fail_ip = ? WHERE id = ?')->execute(array($ip, $id));
								
								$this->error = 'AUTH_WRONG_LOGIN_DATA';
								
								return FALSE;
							}							
						} else {
							$this->model->DB->prepare('UPDATE user SET status = ?, blocked_until = ?, login_fail_ip = ?, login_fails = login_fails + 1, login_fails_sum = login_fails_sum + 1 WHERE id = ?')->execute(array(2, $blockUntil, $ip, $id));
							
							$this->error = 'AUTH_ACCOUNT_BLOCKED ' . date('d.m.Y H:i:s', $blockUntil);
							
							return FALSE;
						}
						
						break;
					
					case 2:
						
						if($timeStamp >= $blockedUntil){							
							if($this->_checkPassword($password, $hash)){
								$this->model->DB->prepare('UPDATE user SET status = ?, last_login = ?, login_ip = ?, login_fails = ?, login_fail_ip = ?, blocked_until = ? WHERE id = ?')->execute(array(1, $timeStamp, $ip, 0, '', 0, $id));
								
								return $user;
							} else {
								$this->model->DB->prepare('UPDATE user SET status = ?, login_fails = ?, login_fails_sum = ?, login_fail_ip = ?, blocked_until = ? WHERE id = ?')->execute(array(1, 1, 1, $ip, 0, $id));
								
								$this->error = 'AUTH_WRONG_LOGIN_DATA';
								
								return FALSE;	
							}							
						} else {							
							$this->error = 'AUTH_ACCOUNT_BLOCKED ' . date('d.m.Y H:i:s', $blockedUntil);
							
							return FALSE;
						}
						
						break;
					
					default:
						return FALSE;
						break;
				}
			} else {
				$this->error = 'AUTH_WRONG_LOGIN_DATA';
				
				return FALSE;
			}
		}
		
		private function _checkPassword($password, $hash = FALSE)
		{
			if(!empty($hash)){
				$hashedPassword = md5($password);
				
				if($hashedPassword == $hash){
					return TRUE;
				} else {
					return FALSE;
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
			} else {
				return FALSE;
			}
		}

		private function _login($user)
		{
			$_SESSION['userID'] = $user['id'];
			$_SESSION['loginTime'] = $user['last_login'];
		}
		
		public function logout()
		{
			if($this->isLoggedIn()){
				unset($_SESSION['userID'], $_SESSION['loginTime']);
			}
		}
	}
