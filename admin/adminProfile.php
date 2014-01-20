<?php
	require_once ("library/languageFile.php");
	require_once ("library/config.php");
	require_once ("library/functions.php");
	sessionCheck();
	$userId	=	$_SESSION['userId'];
	$adminSql	=	"SELECT admin_name,id,username,admin_email,admin_contactno FROM admin WHERE id=$userId AND del_flag=0";
	$adminRes	=	mysql_query($adminSql);
	while($adminRow	=	mysql_fetch_assoc($adminRes))
	{
		$adminId		=	$adminRow['id'];
		$adminName		=	$adminRow['admin_name'];
		$adminEmail		=	$adminRow['admin_email'];
		$adminUname		=	$adminRow['username'];
		$adminContct	=	$adminRow['admin_contactno'];
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
					<h3><?echo lang('ADMIN_PROF');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:60%;margin:0 0 0 20%">
							<div class="thumbnail">
								<div class="caption">
									<h5 align="right" style="margin-right:10px">
										<a href="editAdmin.php?aid=<?echo $adminId?>"><? echo lang('EDIT_PROF');?></a>
									</h5>
								</div>
								<div class="widget-content">
									<table style="color:#000000;width:100%;border:0px solid black;">
										<tr>
											<td style="width:20%;padding:10px;">Name</td>
											<td style="width:5%;padding:10px;">:</td>
											<td style="width:75%;padding:10px;"><? echo $adminName;?></td>
										</tr>
										<tr>
											<td style="width:20%;padding:10px;">UserName</td>
											<td style="width:5%;padding:10px;">:</td>
											<td style="width:75%;padding:10px;"><? echo $adminUname;?></td>
										</tr>
										<tr>
											<td style="width:20%;padding:10px;">Email</td>
											<td style="width:5%;padding:10px;">:</td>
											<td style="width:75%;padding:10px;"><? echo $adminEmail;?></td>
										</tr>
										<tr>
											<td style="width:20%;padding:10px;">Contact No.</td>
											<td style="width:5%;padding:10px;">:</td>
											<td style="width:75%;padding:10px;"><? echo $adminContct;?></td>
										</tr>
									</table>
								</div>
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
