<?php
	require_once ("../library/config.php");
	session_start();
	$userId		=	$_SESSION['userId'];
	$date		=	date('Y-m-d');
	$tags 		= 	stripslashes($_POST['tags']);
	$tagsSql 	=	"INSERT INTO tags(tag_name,added_date,added_by,updated_date,del_flag) 
							VALUES ('".$tags."','".$date."','".$userId."','".$date."',0)";
	$tagStmnt = 	mysql_query($tagsSql);
	