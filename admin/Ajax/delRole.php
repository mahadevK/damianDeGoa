<?php
	require_once('../library/config.php');
	$roleId	=	$_POST['roleId'];
	
	$usersSql	=	"SELECT userId FROM users WHERE role_id=$roleId AND del_flag=0";
	$usersRow	=	mysql_query($usersSql);
	$numRows	=	mysql_num_rows($usersRow);
	if($numRows > 0)
	{
		$msg = 'Sorry! you cannot delete this role because users are associated with this role';
	}
	else
	{
		$delRoleSql	=	"UPDATE roles SET del_flag=1 WHERE id=$roleId";
		mysql_query($delRoleSql);
		$msg = 'Role deleted successfully';
	}
	echo $msg;
?>