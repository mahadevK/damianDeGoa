<?php
	require_once ("../library/config.php");
	require_once ("../library/functions.php");
	$error		=	'';
	$logInName 	= 	htmlentities($_POST['username']);
	$logInPass 	= 	htmlentities($_POST['password']);
	$error		=	sessionStart($logInName,$logInPass);
	echo $error;
?>