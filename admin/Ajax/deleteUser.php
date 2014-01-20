<?php
	require_once('../library/config.php');
	$userId	=	$_POST['userId'];
	
	$delUserSql	=	"UPDATE users SET del_flag=1 WHERE userId=$userId";
	mysql_query($delUserSql);
	$msg = 'User deleted successfully';
	
	echo $msg;
?>