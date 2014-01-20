<?php
	require_once ("../library/config.php");
	$material 	= 	stripslashes($_POST['material']);
	$del_flag	=	0;
	$checkMatrSql	=	"SELECT id FROM material WHERE name='".$material."' AND del_flag=0";
	$checkMatrStmnt = 	mysql_query($checkMatrSql);
	$numRowCnt	=	mysql_num_rows($checkMatrStmnt);
	if($numRowCnt > 0)
	{
		echo "0";
	}
	else
	{
		$userId		=	$_SESSION['userId'];
		$date		=	date('Y-m-d');
		$matrlSql 	=	"INSERT INTO material(name,added_by,added_date,del_flag) 
						VALUES ('".$material."','".$userId."','".$date."',0)";
		$matrlStmnt = 	mysql_query($matrlSql);
		echo "1";
	}
?>	