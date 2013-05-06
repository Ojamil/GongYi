<?php
require_once(dirname(__FILE__)."/tools.php");
require_once(dirname(__FILE__)."/actor.php");
	
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
			$ret['result'] = $this->mysqli->query( $query_str );
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
			$query_str = "select sid as id from School where sname='$sname' and password='$password'";	
			$result = $this->mysqli->query( $query_str );
			if( $result ){
				$ret = $result->fetch_assoc();
				if( !$ret ){
					$ret = array();
				}
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
		$query_str = "select aid, aname, Activity.cid, cname 
					  from Activity, Comity
					  where Activity.cid = Comity.cid AND aid in (
							select aid 
					  		from Apply, User
							where Apply.uid = User.uid AND User.sid = $sid 
					  )
					  group by aid";
		$result = $this->mysqli->query( $query_str );

		$ret = array();
		if( !$this->mysqli->error ){
			while( $row = $result->fetch_assoc() ){
				$ret[] = $row;
			}
			$result->close();
		}
		else{
			die($this->mysqli->error);
		}
	
		return $ret;
	}

	public function approveActivity($sid, $aid)
	{
		$query_str = "insert into Autho(aid, sid) values($aid, $sid)";
		
		$ret['result'] = $this->mysqli->query( $query_str );

		return $ret;
	}

	public function denyActivity( $sid, $aid)
	{
		$query_str = "delete from Autho where sid=$sid and aid=$aid";
		
		$ret['result'] = $this->mysqli->query( $query_str );

		return $ret;
	}	
}

# $school  =  new School();
# $parameter = array(
# 		'sname' => "xjw2",
# 		'password' => "xjw"
# 	);
# var_dump( $school->register( $parameter ) );
# var_dump( $school->login( $parameter ) );
# echo json_encode($school->getAllSchool( $parameter ) );

?>
