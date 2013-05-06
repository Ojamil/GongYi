<?php
require_once(dirname(__FILE__).'/basic/tools.php');
require_once(dirname(__FILE__).'/basic/user.php');
require_once(dirname(__FILE__).'/basic/school.php');
require_once(dirname(__FILE__).'/basic/comity.php');

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

unset($_REQUEST['utype']);
$result = $operator->register( $_REQUEST );
echo json_encode( $result );
?>
