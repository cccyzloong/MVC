<?php
	
	class model_index extends model
	{
		public function __construct($args)
		{
			parent::__construct($args);
		}
		
		public function getData()
		{
			return $this->DB->query('SELECT * FROM user')->fetchAll();
		}
		
		public function insertData($args)
		{
			//$this->DB->prepare("INSERT INTO user (firstname, lastname) VALUES (?)")->execute(array(implode(',', array_values($args))));
		}
	}
