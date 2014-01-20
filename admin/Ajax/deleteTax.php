<?php
	require_once ("../library/config.php");
	$taxId		=	stripslashes($_POST['taxId']);
	$delTaxQry	=	"UPDATE tax SET del_flag=1 WHERE id=$taxId";
	mysql_query($delTaxQry);
?>