<?php
	require_once('../library/config.php');
	$SScatgId		=	$_POST['SScatgId'];
	
	/*$prodSql	=	"SELECT prod_id FROM products WHERE  cat_id=$catgId AND del_flag=0";
	$prodRow	=	mysql_query($prodSql);
	$numRows	=	mysql_num_rows($prodRow);
	if($numRows > 0)
	{
		$msg = 'Sorry! you cannot delete this category because products are associated with this category';
	}
	else
	{*/
		$delSCatgSql	=	"UPDATE sub_sub_category SET del_flag=1 WHERE id=$SScatgId";
		mysql_query($delSCatgSql);
		$msg = 'Sub Category deleted successfully';
//	}
	echo $msg;
?>