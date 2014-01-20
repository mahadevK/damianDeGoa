<?php
	require_once ("../library/config.php");
	session_start();
	$userId			=	$_SESSION['userId'];
	$date			=	date('Y-m-d');
	$taxNameId 		= 	stripslashes($_POST['taxNameId']);
	$taxVal 		= 	stripslashes($_POST['taxVal']);
	$taxNId 		= 	stripslashes($_POST['taxNId']);
	if($taxNId == "")
	{
		$taxSql 	=	"INSERT INTO tax(tax_id,tax_amount,added_by,added_date,updated_date,del_flag) 
							VALUES ('".$taxNameId."','".$taxVal."','".$userId."','".$date."','".$date."',0)";
		$taxStmnt 	= 	mysql_query($taxSql);
		echo "Tax Added successfully";
	}
	else
	{
		$taxSql2	=	"UPDATE tax SET tax_id='".$taxNameId."',tax_amount='".$taxVal."',updated_date='".$date."' WHERE id=$taxNId";	
		mysql_query($taxSql2);
		echo "Tax Edited successfully";
	}
	