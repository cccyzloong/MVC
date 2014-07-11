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
	}
