<?php
	require_once('../library/config.php');
	$prodId 	= 	$_POST['prodId'];
	$sql		= 	"UPDATE products SET del_flag=1 WHERE prod_id=$prodId";
	$stmt 		= 	mysql_query($sql);
	
	$sql1		= 	"UPDATE prodct_images SET del_flag=1 WHERE prodct_id=$prodId";
	$stmt1 		= 	mysql_query($sql1);
	
	$sql2		= 	"UPDATE prod_specification SET del_flag=1 WHERE prod_id=$prodId";
	$stmt2 		= 	mysql_query($sql2);
	
?>