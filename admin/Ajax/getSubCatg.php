<?php
	require_once('../library/config.php');
	$catgId		=	$_POST['catgId'];
	$msg		=	'<option value="">Select</option>';
	$subCatgSql	=	"SELECT sub_catg_name,id FROM sub_category WHERE cat_id='".$catgId."' AND del_flag=0";
	$subCatgRes	=	mysql_query($subCatgSql);
	$numRows	=	mysql_num_rows($subCatgRes);
	if($numRows > 0)
	{
		while($subCatgRow	=	mysql_fetch_array($subCatgRes))
		{
			$msg	.=	"<option value='".$subCatgRow['id']."'>".$subCatgRow['sub_catg_name']."</option>";
		}
	}
	echo $msg;
?>