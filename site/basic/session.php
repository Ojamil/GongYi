<?php 
	session_start();
	if( !isset( $_SESSION['id'] ) ){
		header('Location: /index.html');
		die("You should Login firstly.");
	}
?>
