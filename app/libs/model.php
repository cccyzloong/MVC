<?php

	/**
	 * Model
	 */
	class model extends PDO
	{
		public $DB;
		
		function __construct($args) 
		{
			pre_r(__CLASS__);
			
			$this->DB = new PDO('mysql:host=localhost;dbname=mvc;charset=UTF8', 'root', 'beslic');
			$this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->DB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->DB->setAttribute(PDO::ATTR_PERSISTENT, TRUE);			
		}
	}
	