<?php
# check parameter (only contain all required parameter )
function check_parameter( $required, $source )
{
	if(count($required) != count($source) )
	{
		return false;
	}

	foreach( $required as $key )
	{
		if( !isset($source[$key]) )
		{
			return false;
		}
	}

	return true;
}

# encrypt passwd
function encrypt_password($password)
{
	return sha1($password);
}

# connect database
function connect_database()
{
	$mysqli = new mysqli('localhost', 'GongYiAdmin', 'GongYiAdmin', 'GongYi');
	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') '
			. $mysqli->connect_error);
	}
	return $mysqli;
}

?>


<?php
# # testing code
# $required = array('name', 'password');
# $source = array('name'=>'xjw', 'password'=>'tmp');
# var_dump( check_parameter( $required, $source ) );
# $required[] = 'email';
# var_dump( check_parameter( $required, $source ) );
# $required = array('name', 'passwd');
# var_dump( check_parameter( $required, $source ) );
# $required = array('name');
# var_dump( check_parameter( $required, $source ) );

# var_dump( encrypt_password(""));

?>
