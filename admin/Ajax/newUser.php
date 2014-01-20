<?php
	require_once('../library/config.php');
	session_start();
	$userId			=	$_SESSION['userId'];
	$Name			=	$_POST['Name'];
	$outlet			=	$_POST['outlet'];
	$role			=	$_POST['role'];
	$userName		=	$_POST['userName'];
	$password		=	$_POST['password'];
	$emailId		=	$_POST['emailId'];
	$contactNo		=	$_POST['contactNo'];
	$address		=	$_POST['address'];
	$country		=	$_POST['country'];
	$state			=	$_POST['state'];
	$city			=	$_POST['city'];
	$pincode		=	$_POST['pincode'];
	$date			=	date('Y-m-d');
	$addeduserId	=	$_POST['addeduserId'];
	if($addeduserId == "")
	{
		$userSql	=	"INSERT INTO users (added_by,added_date,updated_date,user_name,username,password,user_emailid,user_contactno,
						user_address,user_country,user_state,user_city,pin_code,role_id,outlet_id,del_flag)
						VALUES('".$userId."','".$date."','".$date."','".$Name."','".$userName."','".md5($password)."','".$emailId."','".$contactNo."','".$address."','".$country."','".$state."','".$city."','".$pincode."','".$role."','".$outlet."','0')";
		mysql_query($userSql);
		echo "User added successfully";
	}
	else
	{
		$userSql2	=	"UPDATE users SET 
										added_by		=	'".$userId."',
										updated_date	=	'".$date."',
										user_name		=	'".$Name."',
										username		=	'".$userName."',
										user_emailid	=	'".$emailId."',
										user_contactno	=	'".$contactNo."',
										user_address	=	'".$address."',
										user_country	=	'".$country."',
										user_state		=	'".$state."',
										user_city		=	'".$city."',
										pin_code		=	'".$pincode."',
										role_id			=	'".$role."',
										outlet_id		=	'".$outlet."'										
						WHERE userId=$addeduserId";
		mysql_query($userSql2);
		echo "User updated successfully";
	}
?>