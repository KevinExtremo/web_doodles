<?php

namespace eXmarket;

class MarketItem
{
	private $database_id;
	private $eve_id;
	private $name;
	private $description;
	private $image_url;
	
	function __construct($database_id,$eve_id,$name,$description,$image_url)
	{
		$this->database_id = $database_id;
		$this->eve_id = $eve_id;
		$this->name = $name;
		$this->description = $description;
		$this->image_url = $image_url;
	}
}




?>