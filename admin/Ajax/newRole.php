<?php
	require_once('../library/config.php');
	session_start();
	$userId	=	$_SESSION['userId'];
	$role	=	$_POST['role'];
	$roleId	=	$_POST['roleId'];
	$date	=	date('Y-m-d');
	if($roleId == "")
	{
		$roleSql	=	"INSERT INTO roles (role,added_by,added_date,updated_date,del_flag)
						VALUES('".$role."','".$userId."','".$date."','".$date."','0')";
		mysql_query($roleSql);
		echo "Role added successfully";
	}
	else
	{
		$roleSql2	=	"UPDATE roles SET role='".$role."',updated_date='".$date."' WHERE id=$roleId";
		mysql_query($roleSql2);
		echo "Role updated successfully";
	}
?>