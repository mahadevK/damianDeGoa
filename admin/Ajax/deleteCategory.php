<?php
	require_once('../library/config.php');
	$catgId		=	$_POST['catgId'];
	
	$prodSql	=	"SELECT prod_id FROM products WHERE  cat_id=$catgId AND del_flag=0";
	$prodRow	=	mysql_query($prodSql);
	$numRows	=	mysql_num_rows($prodRow);
	if($numRows > 0)
	{
		$msg = 'Sorry! you cannot delete this category because products are associated with this category';
	}
	$subCSql	=	"SELECT id FROM sub_category WHERE  cat_id=$catgId AND del_flag=0";
	$subCRow	=	mysql_query($subCSql);
	$numSRows	=	mysql_num_rows($subCRow);
	if($numSRows > 0)
	{
		$msg = 'Sorry! you cannot delete this category because sub categories are associated with this category';
	}
	else
	{
		$delCatgSql	=	"UPDATE category SET del_flag=1 WHERE cat_id=$catgId";
		mysql_query($delCatgSql);
		$msg = 'Category deleted successfully';
	}
	echo $msg;
?>