<?php
	require_once('../library/config.php');
	$offerId 	= 	$_POST['offerId'];
	$sql		= 	"UPDATE offers SET del_flag=1 WHERE offer_id=$offerId";
	$stmt 		= 	mysql_query($sql);
?>