<?php
	require_once('../library/config.php');
	$matrlId 	= 	$_POST['matrlId'];
	$sql		= 	"UPDATE material SET del_flag=1 WHERE id=$matrlId";
	$stmt 		= 	mysql_query($sql);
?>