<?php
	require_once('../library/config.php');
	$catgId		=	$_POST['catgId'];
	
	$prodSql	=	"SELECT prod_id FROM products WHERE  cat_id=$catgId AND del_flag=0";
	$prodRow	=	mysql_query($prodSql);
	$numRows	=	mysql_num_rows($prodRow);
	if($numRows > 0)
	{
		$msg = 'Sorry! you cannot delete this role because products are associated with this category';
	}
	else
	{
		$delCatgSql	=	"UPDATE category SET del_flag=1 WHERE cat_id=$catgId";
		mysql_query($delCatgSql);
		$msg = 'Category deleted successfully';
	}
	echo $msg;
?>