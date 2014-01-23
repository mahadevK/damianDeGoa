<?php
	require_once ("../library/config.php");
	session_start();
	$userId			=	$_SESSION['userId'];
	$catgry 		= 	stripslashes($_POST['catgry']);
	$Subcatgry 		= 	stripslashes($_POST['subcatgry']);
	$RsubCatg 		= 	stripslashes($_POST['rSubCatg']);
	$date			=	date('Y-m-d');
	$checkCatgSql	=	"SELECT id FROM sub_category WHERE sub_catg_name='".$Subcatgry."' AND cat_id='".$catgry."' AND del_flag=0";
	$checkCatgStmnt = 	mysql_query($checkCatgSql);
	$numRowCnt		=	mysql_num_rows($checkCatgStmnt);
	if($numRowCnt > 0)
	{
		echo "0";
	}
	else
	{
		$scatgSql 	=	"INSERT INTO sub_category(sub_catg_name,cat_id,has_sub_catg,added_by,added_date,updated_date,del_flag) 
						VALUES ('".$Subcatgry."','".$catgry."','".$RsubCatg."','".$userId."','".$date."','".$date."',0)";
		$catgStmnt = 	mysql_query($scatgSql);
		echo "1";
	}
?>	