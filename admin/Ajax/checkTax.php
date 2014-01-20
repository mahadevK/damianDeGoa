<?php
	require_once ("../library/config.php");
	
	$taxId			=	stripslashes($_POST['taxNameId']);
	$checkTaxQry	=	"SELECT id FROM tax WHERE tax_id=$taxId AND del_flag=0";
	$checkTaxRes	=	mysql_query($checkTaxQry);
	$numRows		=	mysql_num_rows($checkTaxRes);
	echo $numRows;
?>