<?php
	require_once('../../library/config.php');
	session_start();
	$userId			=	$_SESSION['userId'];
	$customerId		=	$_POST['customerId'];
	$prodId			=	$_POST['prodId'];
	$status			=	$_POST['status'];
	$prodQty		=	$_POST['prodQty'];
	$prodPrice		=	$_POST['prodPrice'];
	$msg			=	'';
	
	$checkProdSql	=	"SELECT id FROM temp_orders WHERE prod_id=$prodId AND cust_id=$customerId AND del_flag=0";
	$checkProdRes	=	mysql_query($checkProdSql);
	$numRows		=	mysql_num_rows($checkProdRes);
	if($numRows > 0)
	{
		$msg	=	1;
	}
	else
	{
		$insertProdSql	=	"INSERT INTO temp_orders(prod_id,item_qty,item_price,ip_address,placed_by,cust_id,specification,status,del_flag)
								VALUES('$prodId','$prodQty','".$prodPrice."','','$userId','$customerId','','$status',0)";
		mysql_query($insertProdSql);
		$msg	=	'';
	}
	echo $msg;
?>