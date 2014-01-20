<?php 
	require_once ("library/languageFile.php");
	require_once ("../library/config.php");
	require_once ("library/functions.php");
	$error	=	'';

	if( isset($_POST['submit']) ) {
		$logInName 	= 	htmlentities($_POST['txtuser']);
		$logInPass 	= 	htmlentities($_POST['txtpass']);
		
		
		if($logInName && $logInPass){
		 $error=sessionStart($logInName,$logInPass);
		  
		}else{
			$error = "<strong>Invalid Username and Password</strong>";
		}
		
		/*$userpassw	=	md5($logInPass);
		if($logInName && $logInPass){
		$logInSql 	=	"SELECT admin_name,type FROM admin WHERE username =".$logInName."AND password=".$userpassw." AND del_flag=0";
		$userRes	= 	mysql_query($logInSql);
		$usersRows	=	mysql_num_rows($userRes);
		if($usersRows > 0)
		{
			$_SESSION['logInUName']		=	$logInName;
			$_SESSION['logInUPassw']	=	$userpassw;
			header('Location:dashBoard.php');
		}
		else 
		{
			$error	= 	"User Login Failed";
		}
		}else{
			$error = "Invalid Username and Password";
		}*/
	} 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title><?echo lang('ADMIN_PANEL');?></title>
		<link href="css/style.css" type="text/css" rel="stylesheet">
		<script type="text/javascript">
			function checkForm() { 
				var userName = document.getElementById('txtuser');
				if( userName.value.trim() == "") {
					alert("Please Enter User Name");
					userName.focus();
					return false;
				}
				var userPassw = document.getElementById('txtpass');
				if( userPassw.value.trim() == "" ) {
					alert("Please Enter Password");
					userPassw.focus();
					return false;
				}
			}
		</script>
		<style >
			#wrapper{
				height:525px;
			}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="mainWrapper">
				<div id="loginBox">
					<div id="adminBlock">
						<ul id="adminBlockUl">
							<li id="adminBlockLi1"><img src="../images/LOGO.jpg" style="width:300px;height:100px;"></li>
							<li id="adminBlockLi2"><b><?echo lang('ADMIN_CONTRL_PANEL');?></b></li>
						</ul>
					</div>
					<div id="errorMsgDiv"><span style="color:red"><?php echo $error; ?></span></div>
					<div id="userLoginBlock">
						<ul id="userLoginBlockUl">
							<li id="userLoginBlockli1"><?echo lang('USER_LOGIN_INFO');?></li>
							<li id="userLoginBlockli2">
								<form method="post" action="index.php">
									<table style="margin:10px 0 10px 0">
										<tr>
											<td  width="225" height="30" align="right" valign="middle" class="logintxt" ><b>User Name: </b>&nbsp;</td>
											<td  width="380" align="left" valign="middle">&nbsp;<input name="txtuser" type="text" id="txtuser"/></td>
										</tr>
										<tr>
											<td height="30" align="right" valign="middle" class="logintxt"><b>Password: </b>&nbsp;</td>
											<td align="left" valign="middle">&nbsp;<input name="txtpass" type="password" id="txtpass" /></td>
										</tr>
										<tr>
											<td height="30" colspan="2" align="center">  
											<div align="center">
												<input  name="submit" type="submit" value="Login" onclick="return checkForm()"/>
												&nbsp;&nbsp;&nbsp;<a href="forgotPasswrd.php"></a>
											</div></td>
										</tr>
									</table>
								</form>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
