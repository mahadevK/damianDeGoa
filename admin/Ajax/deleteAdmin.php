<?php
require_once('../library/config.php');
	
	$aid	=	$_POST['aid'];
	
	$delSql	=	"UPDATE admin SET del_flag=1 WHERE id=".$aid."";
	mysql_query($delSql);
?>