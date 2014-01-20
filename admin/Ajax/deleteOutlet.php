<?php
	require_once('../library/config.php');
	$outId	=	$_POST['outId'];
	
	$usersSql	=	"SELECT userId FROM users WHERE outlet_id=$outId AND del_flag=0";
	$usersRow	=	mysql_query($usersSql);
	$numRows	=	mysql_num_rows($usersRow);
	if($numRows > 0)
	{
		$msg = 'Sorry! you cannot delete this outlet because users are associated with this outlet';
	}
	else
	{
		$delOutletSql	=	"UPDATE outlets SET del_flag=1 WHERE id=$outId";
		mysql_query($delOutletSql);
		$msg = 'Outlet deleted successfully';
	}
	echo $msg;
?>