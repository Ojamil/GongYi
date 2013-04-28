<?php
require_once( './tools.php' );
require_once( './actor.php' );

class School extends Actor
{	
	public function register($parameter)
	{
		$ret = null;

		$required = array('sname', 'password');
		if( check_parameter( $required, $parameter) )
		{
			$sname = $parameter['sname'];
			$password = encrypt_password( $parameter['password'] );
			$query_str = "insert into School(`sname`, `password`) values('$sname', '$password')";	
			$ret = $this->mysqli->query( $query_str );
		}

		return $ret;		
	}

	public function login($parameter)
	{
		$ret = null;

		$required = array('sname', 'password');
		if( check_parameter( $required, $parameter) )
		{
			$sname = $parameter['sname'];
			$password = encrypt_password( $parameter['password'] );
			$query_str = "select sid from School where sname='$sname' and password='$password'";	
			$result = $this->mysqli->query( $query_str );
			if( $result ){
				$ret = $result->fetch_assoc();
				$result->close();
			}
		}

		return $ret;	
	}


	public function getAllSchool()
	{
		$query_str = "select sid, sname from School;";
		$result = $this->mysqli->query( $query_str );

		$ret = array();
		if( $result ){		
			while( $row = $result->fetch_assoc() )
			{
				$ret[] = $row;
			}
			$result->close();	
		}
		return $ret;	
	}

	public function getJob($sid)
	{
	}

	public function approveActivity($sid, $aid)
	{
	}

	public function denyActivity( $sid, $aid)
	{
	}	
}

$school  =  new School();
$parameter = array(
		'sname' => "xjw2",
		'password' => "xjw"
	);
var_dump( $school->register( $parameter ) );
var_dump( $school->login( $parameter ) );
echo json_encode($school->getAllSchool( $parameter ) );

?>
