<?php
require_once('./tools.php');

class Actor
{
	protected $mysqli;
	public function __construct()
	{
		$this->mysqli = connect_database(); 
	}	

	public function __destruct()
	{
		$this->mysqli->close();
	}
}	


?>
