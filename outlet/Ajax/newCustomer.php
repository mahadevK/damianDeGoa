<?php
	require_once('../../library/config.php');
	session_start();
	$userId			=	$_SESSION['userId'];
	$Name			=	$_POST['Name'];
	$emailId		=	$_POST['emailId'];
	$contactNo		=	$_POST['contactNo'];
	$address		=	$_POST['address'];
	$country		=	$_POST['country'];
	$state			=	$_POST['state'];
	$city			=	$_POST['city'];
	$pincode		=	$_POST['pincode'];
	$date			=	date('Y-m-d');
	$customerId		=	$_POST['customerId'];
	if($customerId == "")
	{
		$custSql	=	"INSERT INTO customer (name,address,country,state,city,pincode,emailid,contactno, 		 
						added_by,added_date,updated_date,del_flag)
						VALUES('".$Name."','".$address."','".$country."','".$state."','".$city."','".$pincode."','".$emailId."','".$contactNo."','".$userId."','".$date."','".$date."','0')";
		mysql_query($custSql);
		$lastInsertId	=	mysql_insert_id();
		echo $lastInsertId;
	}
	else
	{
		$custSql2	=	"UPDATE customer SET 
										name			=	'".$Name."',
										address	=	'".$address."',
										country	=	'".$country."',
										state	=	'".$state."',
										city	=	'".$city."',
										pincode		=	'".$pincode."',
										emailid		=	'".$emailId."',
										contactno		=	'".$contactNo."',
										added_by		=	'".$userId."',
										updated_date	=	'".$date."'
							WHERE id=$customerId";
		mysql_query($custSql2);
		$lastInsertId	=	"";
	}
?>