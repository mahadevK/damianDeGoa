<?php
	require_once ("../library/config.php");
	session_start();
	$userId			=	$_SESSION['userId'];
	$catgry 		= 	stripslashes($_POST['catgry']);
	$Subcatgry 		= 	stripslashes($_POST['Subcatgry']);
	$SubSubcatgry 	= 	stripslashes($_POST['SubSubcatgry']);
	$date			=	date('Y-m-d');
	$checkCatgSql	=	"SELECT id FROM sub_sub_category WHERE sub_catg_name='".$SubSubcatgry."' AND sub_cat_id='".$Subcatgry."' 
						AND cat_id='".$catgry."' AND del_flag=0";
	$checkCatgStmnt = 	mysql_query($checkCatgSql);
	$numRowCnt		=	mysql_num_rows($checkCatgStmnt);
	if($numRowCnt > 0)
	{
		echo "0";
	}
	else
	{
		$SscatgSql 	=	"INSERT INTO sub_sub_category(sub_catg_name,cat_id,sub_cat_id,added_by,added_date,updated_date,del_flag) 
						VALUES ('".$SubSubcatgry."','".$catgry."','".$Subcatgry."','".$userId."','".$date."','".$date."',0)";
		$SScatgStnt = 	mysql_query($SscatgSql);
		echo "1";
	}
?>	