<?php
	
	class model_index extends model
	{
		public function __construct($args)
		{
			//pre_r(__CLASS__);
			
			parent::__construct($args);
		}
		
		public function getData()
		{
			//pre_r(__METHOD__);
			
			return $this->DB->query('SELECT * FROM user')->fetchAll();;
		}
		
		public function insertData($args)
		{
			//pre_r(__METHOD__);
			
			$this->DB->prepare('INSERT INTO user (firstname, lastname) VALUES (?, ?)')->execute(array($args['firstname'], $args['lastname']));
		}
	}
