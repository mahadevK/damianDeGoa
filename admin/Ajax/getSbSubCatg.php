<?php
	require_once('../library/config.php');
	$SbcatgId		=	$_POST['Subcatgry'];
	$msg		=	'<option value="">Select</option>';
	$SsubCatgSql	=	"SELECT sub_catg_name,id FROM sub_sub_category WHERE sub_cat_id='".$SbcatgId."' AND del_flag=0";
	$SsubCatgRes	=	mysql_query($SsubCatgSql);
	$numRows	=	mysql_num_rows($SsubCatgRes);
	if($numRows > 0)
	{
		while($SsubCatgRow	=	mysql_fetch_array($SsubCatgRes))
		{
			$msg	.=	"<option value='".$SsubCatgRow['id']."'>".$SsubCatgRow['sub_catg_name']."</option>";
		}
	}
	echo $msg;
?>