<?php
	require_once("../library/config.php");
	$emailId = $_POST['Email'];
	
		$usersSqlx	=	"SELECT id as aid FROM  admin WHERE admin_email='".	$emailId."' AND del_flag=0";
		$userRes	= 	mysql_query($usersSqlx);
		$usersRows	=	mysql_num_rows($userRes);

	if ($usersRows > 0) 
	{
		$result	=	1;
	}
	else
	{
		$result	=	0;
	}
	echo $result;
?>