<?php
	require_once ("library/languageFile.php");
	require_once ("library/config.php");
	require_once ("library/functions.php");
	sessionCheck();
	if(isset($_REQUEST['role']) && ($_REQUEST['role']!=""))
	{
		$roleId		=	base64_decode($_REQUEST['role']);
		$sql	=	"SELECT role FROM roles WHERE del_flag=0 AND id=$roleId";
		$stmt 	= 	mysql_query($sql);
		while ($row = mysql_fetch_array($stmt)) {
			$role		=	$row['role'];
		}
	}
	else
	{
		$roleId	=	'';
		$role	=	'';
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
		<script type="text/javascript" src="scripts/script.js"></script>
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
					<h3><?echo lang('NEW_ROLE');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:60%;margin:0 0 0 20%">
							<div class="thumbnail">
								<div class="caption"></div>
								<div class="widget-content">
									<table style="color:#000000;width:700px;border:0px solid black;>
										<tr height="30px"><td><span style="color:red;" id="sucessMsg"></span></td></tr>
										<tr>
											<td style="width:5%;padding:5px;">
												Role<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;: 
												</td>
												<td style="width:5%;padding:5px;">
												<input type="text" name="role" id="role" style="width:200px" value="<? echo $role ?>">
												<input type="hidden" name="roleId" id="roleId" value="<? echo $roleId ?>">
											</td>
										</tr>
										<tr height="25px;"></tr>
										<tr>
											<td colspan="2" align="center">
												<input type="submit" name="submit" id="submit" value="Submit" onclick="return validateRole()">&nbsp;&nbsp;&nbsp; 
												<input name="Cancel" type="button" id="Cancel" value="Cancel" onclick="window.location.href='dashBoard.php';" />
											</td>
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
