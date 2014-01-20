<?php
	require_once('../library/config.php');
	$tagId 		= 	$_POST['tagId'];
	$sql		= 	"UPDATE tags SET del_flag=1 WHERE id=$tagId";
	$stmt 		= 	mysql_query($sql);
?>