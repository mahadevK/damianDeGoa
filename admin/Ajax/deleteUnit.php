<?php
	require_once('../library/config.php');
	$unitId 	= 	$_POST['unitId'];
	$sql		= 	"UPDATE unit SET del_flag=1 WHERE id=$unitId";
	$stmt 		= 	mysql_query($sql);
?>