<?php
	require_once('../../library/config.php');
	require_once ("../library/SqlFunctions.php");
	$customerId 	= 	$_POST['customerId'];
	
	$cartCount	=	getCartCount($customerId);
	echo $cartCount;
?>