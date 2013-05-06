<?php
	require_once(dirname(__FILE__)."/tools.php");
	require_once(dirname(__FILE__)."/actor.php");
	
	class Comity extends Actor
	{
		public function register($parameter){
			$required = array('cname', 'password', 'email', 'phone', 'weibo', 'description' );
			$ret = null;
			
			if( check_parameter( $required, $parameter) )
			{
				$parameter['password'] = encrypt_password( $parameter['password'] );
				$seg_str = implode(',', $required);
				$values = array();
				foreach( $required as $seg )
				{
					$values[] = "'".$parameter[$seg]."'"; 
				}
				$values_str = implode( ',', $values );

				$query_str = "insert into Comity($seg_str) values($values_str)";
				$ret['result'] = $this->mysqli->query( $query_str );
			}

			return $ret;
		}
		
		public function login($parameter){
			$ret = null;

			$required = array('cname', 'password');	
			if( check_parameter( $required, $parameter ) )
			{
				$cname = $parameter['cname'];
				$password = $parameter['password'];
				$password =encrypt_password( $password );

				$query_str = "select cid as id from Comity where cname='$cname' and password='$password'";
				$result = $this->mysqli->query( $query_str );
				$ret = $result->fetch_assoc();
				if( !$ret ){
					$ret = array();
				}
				$result->close();
			}	

			return $ret;
		}

		public function getProfile($cid)
		{
			$ret = null;
			$query_str = "select * from Comity where cid=$cid";
			$result = $this->mysqli->query( $query_str );
			if( !$this->mysqli->error )
			{
				$ret = $result->fetch_assoc();
				$result->close();

				if( $ret ){
					unset( $ret['password'] );
				}
				else{
					$ret = array();
				}
			}
			else{
				die( $this->mysqli->error );
			}
		
			return $ret;
		}

		public function updateProfile($cid, $parameter)
		{
			$opt = array('email', 'password', 'phone', 'weibo', 'description');
			if( isset($parameter['password']) )
			{
				$parameter['password'] = encrypt_password($parameter['password']);
			}
			
			$check = true;
			$values = array();

			foreach( $parameter as $left=>$right )
			{
				if( in_array( $left, $opt ))
				{
					$values[] = "$left = '".$right."'";
				}
				else{
					$check = false;
					break;
				}
			}

			if( !$check )
			{
				die("parameter error");
			}

			$values[] = "cid=$cid";
			$str = implode(',', $values);
			$query_str = "update Comity set $str where cid=$cid";
			$ret['result'] = $this->mysqli->query( $query_str );
			return $ret;
		}

		public function createActivity($parameter)
		{
			$required = array('aname', 'description', 'defaultScore', 'timeBegin', 'timeEnd', 'address', 'cid', 'maxNum', 'applyDeadline', 'repeatable', 'opt');

			$ret = array();
			if( check_parameter( $required, $parameter ) )
			{
				$values = array();
				foreach( $required as $key )
				{
					$values[] = "'".$parameter[$key]."'";
				}
				$parm_str = implode(',', $required);
				$values_str = implode(',', $values);

				$query_str = "insert into Activity($parm_str) values($values_str)";
				$ret['result'] = $this->mysqli->query( $query_str );
			}
			else{
				die("parameter error");
			}

			return $ret;
		}

		public function addActivityMember($aid, $uid)
		{
			$query_str = "update Apply set isApprove=true where aid=$aid and uid=$uid";

			$ret = array();
			$ret['result'] = $this->mysqli->query( $query_str );

			return $ret;
		}

		public function removeActivityMenber( $aid, $uid)
		{
			$query_str = "update Apply set isApprove=false where aid=$aid and uid=$uid";

			$ret = array();
			$ret['result'] = $this->mysqli->query( $query_str );

			return $ret;
		}

		public function rewardGYTime($aid, $uid)
		{
		}
	}
?>
