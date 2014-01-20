<?php
	require_once ("library/languageFile.php");
	require_once ("../library/config.php");
	require_once ("library/functions.php");
	require_once ("library/SqlFunctions.php");
	sessionCheck();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta charset="utf-8" http-equiv="Content-Type" content="text/html" />
		<title><?echo lang('ADMIN_PANEL');?></title>
		<link type="image/x-icon" href="images/favicon.ico" rel="shortcut icon"/>
		<link href="../admin/css/main.min.css" rel="stylesheet" />
		<link href="../admin/css/main-busnes.css" rel="stylesheet" />
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
		<script type="text/javascript" src="../admin/scripts/jquery.min.js"></script>
		<script type="text/javascript" src="../admin/scripts/advetiser.min.js"></script>
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
					<h3><?echo lang('QUATN');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:80%;margin:0 0 0 9%">
							<div class="existingDiv" style="margin:0 0 0 25%">
								Customer Name : 
								<select id="custList" name="custList">
									<option value="">Select</option>
								<?
									$custQuery	=	getAllCustomer();
									while($custRow	=	mysql_fetch_array($custQuery))
									{
								?>
										<option value="<? echo $custRow['id']; ?>"><? echo $custRow['name']; ?></option>
								<?
									}
								?>
								<br /><br />
								<input type="submit" value="OK" onclick="return valCustSel()"/>
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
