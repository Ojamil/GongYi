<?php
require_once(dirname(__FILE__)."/basic/user.php");
require_once(dirname(__FILE__)."/basic/school.php");
require_once(dirname(__FILE__)."/basic/comity.php");

$comity = new Comity();
$cp = array(
		'cname'=>'GY',
		'password'=>'GY',
		'email'=>'gy@gmail.com',
		'phone'=>'+86 123',
		'weibo'=>'none',
		'description'=>'for test'
	);
$result = $comity->register( $cp );
$lf = array(
		'cname'=>"GY",
		'password'=>"GY"
	);
$result = $comity->login( $lf ); 
$result = $comity->getProfile( 1 );
$result = $comity->updateProfile( 1, array('password'=>'fuck') );

$required = array('aname'=>"Gong2Yi", 'description'=>"nothing", 'defaultScore'=>"2", 'timeBegin'=>'2012-12-12', 'timeEnd'=>"2012-2-2", 'address'=>"SYSU", 'cid'=>"1", 'maxNum'=>"10", 'applyDeadline'=>"2014-10-10", 'repeatable'=>"1", 'opt'=>"");
$result = $comity->createActivity( $required );

$school = new School();
$rf = array(
		'sname'=>"SYSU2",
		'password'=>"sser"
	);
$result = $school->register( $rf );
$result = $school->login( $rf );
$result = $school->getAllSchool();
$result = $school->getJob( 1 );

$user = new User();
$parameter = array(
		'email'=>"xu_jun_wei@126.com",
		'password'=>"10389030",
		'uname'=>"xjw",
		'gender'=>"1",
		'birthdate'=>"2013-1-1",
		'sid'=>'1',
		'telephone'=>'15902039135',
		'selfIntroduction'=>"developer"
	);

	
$result = $user->register( $parameter );
$ul = array(
		'uname'=>'xjw',
		'password'=>"10389030"
	);
$result = $user->login( $ul );
$result = $user->getProfile(2);
$result = $user->updateProfile( 3, array() );
$result = $user->joinActivity( 1, 1);
$result = $school->approveActivity( 1, 1);
$result = $comity->addActivityMember( 1, 1 );
$result = $comity->removeActivityMenber( 1, 1); 
var_dump( $result );
	
?>
