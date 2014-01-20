<?php
	require_once ("../library/config.php");
	session_start();
	$units 		= 	stripslashes($_POST['units']);
	$unitFor 	= 	stripslashes($_POST['unitFor']);
	$del_flag	=	0;
	$checkUnitSql	=	"SELECT id FROM unit WHERE unit='".$units."' AND unit_for=$unitFor AND del_flag=0";
	$checkUnitStmnt = 	mysql_query($checkUnitSql);
	$numRowCnt	=	mysql_num_rows($checkUnitStmnt);
	if($numRowCnt > 0)
	{
		echo "0";
	}
	else
	{
		$userId		=	$_SESSION['userId'];
		$date		=	date('Y-m-d');
		$unitSql 	=	"INSERT INTO unit(unit,unit_for,added_by,added_date,del_flag) 
						VALUES ('".$units."','".$unitFor."','".$userId."','".$date."',0)";
		$unitStmnt = 	mysql_query($unitSql);
		echo "1";
	}
?>	