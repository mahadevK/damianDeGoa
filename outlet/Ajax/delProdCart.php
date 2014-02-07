<?php
	require_once('../../library/config.php');
	require_once('../library/SqlFunctions.php');
	$customerId	=	$_POST['customerId'];
	$recrdId	=	$_POST['recrdId'];
	
	$delCartProd	=	"UPDATE temp_orders SET del_flag=1 WHERE id=$recrdId";
	mysql_query($delCartProd);
	$cartCnt	=	0;
	$cartCnt	=	getCartCount($customerId);
	echo $cartCnt."|".$customerId;
?>