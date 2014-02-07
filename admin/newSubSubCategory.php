<?php
	require_once ("library/languageFile.php");
	require_once ("library/config.php");
	require_once ("library/functions.php");
	require_once ("library/SqlFunctions.php");
	sessionCheck();
	$userId			=	$_SESSION['userId'];	
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
					<h3><?echo lang('SUBSUBCATGRES');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:60%;margin:0 0 0 20%">
							<div class="thumbnail">
								<div class="caption">
									<h5 align="right" style="margin-right:10px">
										<a href="SubSubCategories.php"><? echo lang('VEW_SSUBCATG');?></a>
									</h5>
								</div>
								<div class="widget-content">
									<table width="600px" align="center">
										<tr height="30px"><td><span style="color:red;" id="sucessMsg"></span></td></tr>
										<tr>
											<td width="150px">
												<?echo lang('CATGRES');?></td>
											<td width="20px">:</td>
											<td width="430px">
												<select id="catgry" name="catgry" style="width:430px" onchange="return loadSubCatg()">
													<option value="">Select</option>
												<?
													$catgRes	=	categQuery2($userId);
													while($catgRow	=	mysql_fetch_array($catgRes))
													{
												?>
														<option value="<? echo $catgRow['cat_id'] ?>"><? echo $catgRow['cat_name'] ?></option>
												<?
													}
												?>
											</td>
										</tr>
										<tr>
											<td width="150px">
												<?echo lang('SUBCATGRES');?></td>
											<td width="20px">:</td>
											<td width="430px">
												<img src="images/loading.gif" alt="" style="display:none;margin:0 0 0 187px" id="subCatgLdng"/>
												<select id="Subcatgry" name="Subcatgry" style="width:430px">
													<option value="">Select</option>
												<?
													$subcatgRes	=	subCategQuery($userId);
													while($subcatgRow	=	mysql_fetch_array($subcatgRes))
													{
												?>
														<option value="<? echo $subcatgRow['id'] ?>"><? echo $subcatgRow['sub_catg_name'] ?></option>
												<?
													}
												?>
											</td>
										</tr>
										<tr height="25px;"></tr>
										<tr>
											<td width="150px">
												<?echo lang('SUBSUBCATGRES');?></td>
											<td width="20px">:</td>
											<td width="430px">
												<input type="text" name="SubSubcatgry" id="SubSubcatgry" style="width:416px">
											</td>
										</tr>
										<tr height="25px;"></tr>
										<tr>
											<td align="center" colspan="3">
												<input type="submit" name="submit" id="submit" value="Submit" onclick="return valSubSCategory()">&nbsp;&nbsp;&nbsp;&nbsp; 
												<input name="Cancel" type="button" id="Cancel" value="Cancel" onclick="window.location.href='SubSubCategories.php';" />
												<img src="images/loading.gif" alt="" style="display:none" id="loadingImg"/>
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
