<?php
	require_once ("library/languageFile.php");
	require_once ("../library/config.php");
	require_once ("library/functions.php");
	require_once("library/SqlFunctions.php");
	sessionCheck();
	$userId		=	$_SESSION['userId'];
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
		<link rel="stylesheet" type="text/css" href="css/pagination.css"/>
		<script type="text/javascript" src="../admin/scripts/jquery.min.js"></script>
		<script type="text/javascript" src="../admin/scripts/advetiser.min.js"></script>
		<script type="text/javascript" src="scripts/script.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				getProducts(1);
			});
		</script>
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
					<h3><?echo lang('PRODCTS');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:100%;margin:0 0 0 0%">
							<div class="thumbnail">
								<!--<div class="caption">
									<h5 align="right" style="margin-right:10px">
										<a href="newProduct.php"><? //echo lang('ADD_PROD');?></a>
									</h5>
								</div>-->
								<div class="widget-content">
									<ul class="thumbnails">
										<li class="span5" style="width:100%">
											<table style="margin:0 0 0 240px;">
												<tr>
													<td style="width:50px"><? echo lang('SERCH');?> </td>
													<td style="width:20px"> : </td>
													<td style="width:200px"> 
														<select id="catSelect" class="serchTag" style="width:190px;height:32px">
															<option value="">All</option>
														<?
															$catgRes	=	categQuery($userId);
															while ($catRow	=	mysql_fetch_assoc($catgRes)) {
														?>
																<option value="<? echo $catRow['cat_id']; ?>"><? echo $catRow['cat_name']; ?></option>
														<?
															}	
														?>
														</select>
													</td>
													<td style="width:300px">
														<input type="text" id="serchCatName" name="serchCatName" class="serchTag" style="width:300px;height:23px">
													</td>
													<td style="width:40px">
														<img src="images/search.png" alt="" style="margin:-9px 0 0 -4px" onclick="return serchProd()"/>
													</td>
												</tr>
											</table>
										</li>
										<li class="span5" style="width:100%">
											<div id="productsReslt"><img src="images/loader.gif" style="margin:40px 0 0 423px;" alt=""/></div> 
										</li>
									</ul>
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
