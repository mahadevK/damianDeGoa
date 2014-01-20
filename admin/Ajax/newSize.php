<?php
	require_once ("../library/config.php");
	session_start();
	$size 		= 	$_POST['size'];
	$checkSizeSql	=	"SELECT id FROM sizes WHERE size='".$size."' AND del_flag=0";
	$checkSizeStmnt = 	mysql_query($checkSizeSql);
	$numRowCnt	=	mysql_num_rows($checkSizeStmnt);
	if($numRowCnt > 0)
	{
		echo "0";
	}
	else
	{
		$userId		=	$_SESSION['userId'];
		$date		=	date('Y-m-d');
		$sizeSql 	=	"INSERT INTO sizes(size,added_by,added_date,del_flag) 
						VALUES ('".$size."',$userId,'".$date."',0)";
		$sizeStmnt = 	mysql_query($sizeSql);
		echo "1";
	}
?>	