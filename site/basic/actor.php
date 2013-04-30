<?php
require_once(dirname(__FILE__)."/tools.php");

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
