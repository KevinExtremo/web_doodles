<?php

namespace eXspace;

class SpaceSystem
{
	private $database_id;
	private $eve_id;
	private $name;
	private $description;
	private $security_status;
	
	function __construct($database_id, $eve_id,$name,$description,$security_status)
	{
		$this->database_id = $database_id;
		$this->eve_id = $eve_id;
		$this->name = $name;
		$this->description = $description;
		$this->security_status = $security_status;
	}
}




?>