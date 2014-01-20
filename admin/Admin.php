<?php
	require_once ("library/languageFile.php");
	require_once ("library/config.php");
	require_once ("library/functions.php");
	sessionCheck();
	$userId	=	$_SESSION['userId'];
		if(isset($_POST['submit']))
		{
				$fname 		= 	$_POST['fname'];
				$uname 		= 	$_POST['uname'];
				$passwd 	= 	md5($_POST['passwd']);
				$conpass 	= 	$_POST['conpass'];
				$contact 	= 	$_POST['contact'];
				$email 		= 	$_POST['email'];
				$del_flag	=	0;
				$type		=	2;
				
				
		 $addAdminQ="INSERT into admin (admin_name,username,password,admin_email,type,admin_contactno,del_flag) 
					VALUES('".$fname."','".$uname."','".$passwd."','".$email."','".$type."','".$contact."','".$del_flag."')";
					
		        mysql_query($addAdminQ) or die('Error, query failed : ' . mysql_error()); 
				

		header('Location:adminList.php');
		
		}
	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta charset="utf-8" http-equiv="Content-Type" content="text/html" />
		<title><?echo lang('ADMIN_PANEL');?></title>
		<link type="image/x-icon" href="images/favicon.ico" rel="shortcut icon"/>
		<link href="css/main.min.css" rel="stylesheet" />
		<link href="css/main-busnes.css" rel="stylesheet" />
		<!--[if IE 7] [if IE 8]>
			<style type="text/css">
				.content{
					padding:100px 0 0 0;
				}
				.row-fluid .span4 {
					width: 48.629%;
				}
			</style>
		<![endif]-->
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/ajaxPagination.css"/>
		<script type="text/javascript" src="scripts/jquery.min.js"></script>
		<script type="text/javascript" src="scripts/advetiser.min.js"></script>
		<script type="text/javascript" src="scripts/validate.js"></script>
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<?include('library/header.php');?>
			</div>
		</div>
		<div class="content">
			<div class="container">
				<div class="page-header">
					<h3><?echo lang('CREATE_ADMIN');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:60%;margin:0 0 0 20%">
							<div class="thumbnail">
								<div class="caption">
									<h5 align="right" style="margin-right:10px">
										<a href="Material.php"><? //echo lang('VEW_MATRL');?></a>
									</h5>
								</div>
								<form action="Admin.php"  method="POST"  >
								<div class="widget-content">
									<table style="color:#000000;width:700px;border:0px solid black;>
										<tr height="30px"><td><span style="color:red;" id="sucessMsg"></span></td></tr>
										<tr>
											<td style="width:5%;padding:5px;">
												 Name<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;: 
												</td>
												<td style="width:5%;padding:5px;">
												<input type="text" name="fname" id="fname" style="width:200px">
											</td>
										</tr>

										<tr>	
											<td style="width:5%;padding:5px;">
												User Name<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;: 
												</td>
												<td style="width:5%;padding:5px;">
												<input type="text" name="uname" id="uname" style="width:200px">
											</td>
										</tr>
											<tr>	
											<td style="width:5%;padding:5px;">
												Password<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;: 
												</td>
												<td style="width:5%;padding:5px;">
												<input type="password" name="passwd" id="passwd" style="width:200px">
											</td>
										</tr>
											<tr>	
											<td style="width:5%;padding:5px;">
												Confirm Password<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;: 
												</td>
												<td style="width:5%;padding:5px;">
												<input type="password" name="conpass" id="conpass" style="width:200px">
											</td>
										</tr>
													<tr>	
											<td style="width:5%;padding:5px;">
												Contact No<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;: 
												</td>
												<td style="width:5%;padding:5px;">
												<input type="text" name="contact" id="contact" style="width:200px">
											</td>
										</tr>
													<tr>	
											<td style="width:5%;padding:5px;">
												Email Id<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;: 
												</td>
												<td style="width:5%;padding:5px;">
												<input type="text" name="email" id="email" style="width:200px" onchange="return checkEmailAvbty()">
												<input type="hidden" name="eamilAvble" id="eamilAvble" value="0" />
											</td>
										</tr>
										<tr height="25px;"></tr>
										<tr>
											<td colspan="2" align="center">
												<input type="submit" name="submit" id="submit" value="Submit" onclick=" return validateadmin()">&nbsp;&nbsp;&nbsp; 
												<input name="Cancel" type="button" id="Cancel" value="Cancel" onclick="window.location.href='dashBoard.php';" />
												<img src="images/loading.gif" alt="" style="display:none" id="loadingImg"/>
											</td>
										</tr>
									</table>
								</div>
								</form>
								<div class="widget-footer"></div>
							</div>
						</li>
					</ul>
			  </div>
			</div>
		</div>
		<div class="footerDiv">
			<? include('library/footer.php'); ?>
		</div>
	</body>
</html>
