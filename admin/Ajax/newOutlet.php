<?php
	require_once('../library/config.php');
	session_start();
	$userId		=	$_SESSION['userId'];
	$outletName	=	$_POST['outletName'];
	$country	=	$_POST['country'];
	$state		=	$_POST['state'];
	$city		=	$_POST['city'];
	$date		=	date('Y-m-d');
	$outletId	=	$_POST['outletId'];
	if($outletId == "")
	{
		$outletSql	=	"INSERT INTO outlets (name,country,state,city,added_by,added_date,updated_date,del_flag)
						VALUES('".$outletName."','".$country."','".$state."','".$city."','".$userId."','".$date."','".$date."','0')";
		mysql_query($outletSql);
		echo "Outlet added successfully";
	}
	else
	{
		$outletSql2	=	"UPDATE outlets SET name='".$outletName."',country='".$country."',state='".$state."',city='".$city."',updated_date='".$date."' WHERE id=$outletId";
		mysql_query($outletSql2);
		echo "Outlet updated successfully";
	}
?>