<?php
	require_once('../library/config.php');
	$specId 	= 	$_POST['specId'];
	$sql		= 	"UPDATE prod_specification SET del_flag=1 WHERE spec_id=$specId";
	$stmt 		= 	mysql_query($sql);
?>