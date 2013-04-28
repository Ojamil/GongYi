<?php
	require_once('./tools.php');
	require_once('./actor.php');

	class User extends Actor
	{
		public function register($parameter){
		}
		
		public function login($name, $password){
		}

		public function getProfile($uid)
		{
		}

		public function updateProfile($parameter)
		{
		}

		public function joinActivity($uid, $aid)
		{
		}

		public function exitActicity( $uid, $aid)
		{
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
