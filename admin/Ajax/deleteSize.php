<?php
	require_once('../library/config.php');
	$sizeId 	= 	$_POST['sizeId'];
	$sql		= 	"UPDATE sizes SET del_flag=1 WHERE id=$sizeId";
	$stmt 		= 	mysql_query($sql);
?>