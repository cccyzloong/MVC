<?php

	/**
	 * Model
	 */
	class model extends PDO
	{
		public $DB;
		
		function __construct($args) 
		{
			//pre_r(__CLASS__);
			
			$this->DB = new PDO('mysql:host=' . DB_host . ';dbname=' . DB_name . ';charset=' . DB_charset, DB_user, DB_password);
			$this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->DB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->DB->setAttribute(PDO::ATTR_PERSISTENT, TRUE);			
		}
	}
	