<?php
	require_once('../../library/config.php');
	$custId	=	$_POST['custId'];
	
	$delCustSql	=	"UPDATE customer SET del_flag=1 WHERE id=$custId";
	mysql_query($delCustSql);
	$msg = 'Customer deleted successfully';
	
	echo $msg;
?>