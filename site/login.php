<?php
require_once(dirname(__FILE__).'/basic/tools.php');
require_once(dirname(__FILE__).'/basic/user.php');
require_once(dirname(__FILE__).'/basic/school.php');
require_once(dirname(__FILE__).'/basic/comity.php');
session_start();

if( !isset($_REQUEST['utype'] ) ) {
	die('Illegal Operation');
}

$operator = null;
switch( $_REQUEST['utype'] )
{	
case 'user':
	$operator = new User();
	break;
case 'comity':
	$operator = new Comity();
	break;
case 'school':
	$operator = new School();
	break;
default:
	die('Illegal User Type');
	break;
}

$utype = $_REQUEST['utype'];
unset($_REQUEST['utype']);
$result = $operator->login( $_REQUEST );
if( $result == null ){
	die( "Illegal" );
}
elseif( isset($result['id'] ) )
{
	$_SESSION['id'] = $result['id'];
	$_SESSION['utype'] = $utype;	
}
echo json_encode( $result );
?>
