<?php
	require_once(dirname(__FILE__)."/tools.php");
	require_once(dirname(__FILE__)."/actor.php");

	class User extends Actor
	{
		public function register($parameter){
			$required = array('email', 'password', 'uname', 'gender', 'birthdate', 'sid', 'telephone', 'selfIntroduction');
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

				$query_str = "insert into User($seg_str) values($values_str)";
				$ret['result'] = $this->mysqli->query( $query_str );

			#	if( !$ret['result'] )
			#	{
			#		echo $query_str;
			#		die( $this->mysqli->error );
			#	}
			}
			# else{
			# 	die("parameter inconsist.");
			# }

			return $ret;	
		}
		
		public function login($parameter){
			$ret = null;

			$required = array('uname', 'password');	
			if( check_parameter( $required, $parameter ) )
			{
				$cname = $parameter['uname'];
				$password = $parameter['password'];
				$password =encrypt_password( $password );

				$query_str = "select uid from User where uname='$cname' and password='$password'";
				$result = $this->mysqli->query( $query_str );
				$ret = $result->fetch_assoc();
				if( !$ret ){
					$ret = array();
				}
				$result->close();
			}	

			return $ret;
		}

		public function getProfile($uid)
		{
			$ret = null;
			$query_str = "select * from User where uid=$uid";
			$result = $this->mysqli->query( $query_str );
			if( !$this->mysqli->error )
			{
				$ret = $result->fetch_assoc();
				if( $ret ){
					unset($ret['password']);
				}
				else{
					$ret = array();
				}
				$result->close();
			}
			else{
				die( $this->mysqli->error );
			}
		
			return $ret;

		}

		public function updateProfile($uid, $parameter)
		{
			$opt = array('email', 'password', 'telephone', 'selfIntroduction');
			if( isset($parameter['password']) )
			{
				$parameter['password'] = encrypt_password($parameter['password']);
			}
			
			$check = true;
			$values = array();

			foreach( $parameter as $left=>$right )
			{
				if( in_array( $left, $opt))
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

			$values[] = "uid=$uid";
			$str = implode(',', $values);
			$query_str = "update User set $str where uid=$uid";
			$ret['result'] = $this->mysqli->query( $query_str );
			return $ret;
		}

		public function joinActivity($uid, $aid)
		{
			$query_str = "insert into Apply(aid, uid, isApprove) values($aid, $uid, false)";
			$ret = array();
			$ret['result'] = $this->mysqli->query( $query_str );
			
			return $ret;	
		}

		public function exitActicity( $uid, $aid)
		{
			$query_str = "delete from Apply where aid=$aid and uid=$uid";
			$ret = array();

			$ret['result'] = $this->query( $query_str );

			return $ret;
		}

		public function getHistory($uid)
		{
		}

		public function getProcessing($uid)
		{
		}

		public function getGYTime($uid)
		{
		}
	}
?>
