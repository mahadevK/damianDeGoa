<?php
	require_once ("../library/config.php");
	session_start();
	$userId			=	$_SESSION['userId'];
	$catgry 		= 	stripslashes($_POST['catgry']);
	$RsubCatg 		= 	stripslashes($_POST['rSubCatg']);
	$date			=	date('Y-m-d');
	$checkCatgSql	=	"SELECT cat_id FROM category WHERE cat_name='".$catgry."' AND del_flag=0";
	$checkCatgStmnt = 	mysql_query($checkCatgSql);
	$numRowCnt		=	mysql_num_rows($checkCatgStmnt);
	if($numRowCnt > 0)
	{
		echo "0";
	}
	else
	{
		$catgSql 	=	"INSERT INTO category(cat_name,has_sub_cat,added_by,added_date,updated_date,del_flag) 
						VALUES ('".$catgry."','".$RsubCatg."','".$userId."','".$date."','".$date."',0)";
		$catgStmnt = 	mysql_query($catgSql);
		echo "1";
	}
?>	