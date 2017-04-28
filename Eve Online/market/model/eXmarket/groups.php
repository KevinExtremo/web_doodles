<?php

namespace eXmarket;

class MarketGroup
{
	private $database_id;
	private $eve_id;
	private $name;
	private $description;
	
	function __construct($database_id, $eve_id,$name,$description)
	{
		$this->database_id = $database_id;
		$this->eve_id = $eve_id;
		$this->name = $name;
		$this->description = $description;
	}
}




?>