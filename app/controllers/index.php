<?php

	/**
	 * Index controller
	 */
	class index
	{
		
		function __construct($arg = FALSE)
		{
			if($arg != FALSE){
				echo '<pre>';
				echo __METHOD__;
				
				echo '<pre>';
				print_r($arg);
			}
		}
	}
	