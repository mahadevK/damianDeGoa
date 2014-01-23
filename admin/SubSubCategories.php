<?php
	require_once ("library/languageFile.php");
	require_once ("library/config.php");
	require_once ("library/functions.php");
	sessionCheck();
	
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
		<link rel="stylesheet" type="text/css" href="css/pagination.css"/>
		<script type="text/javascript" src="scripts/jquery.min.js"></script>
		<script type="text/javascript" src="scripts/advetiser.min.js"></script>
		<script type="text/javascript" src="scripts/script.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				getSubSubCategory(1);
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
					<h3><?echo lang('SUBSUBCATGRES');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:70%;margin:0 0 0 20%">
							<div class="thumbnail">
								<div class="caption">
									<h5 align="right" style="margin-right:10px">
										<a href="newSubSubCategory.php"><? echo lang('ADD_SSUBCATG');?></a>
									</h5>
								</div>
								<div class="widget-content">
									<div id="topHeaderDiv">
										<div id="leftHeader"></div>
										<div id="centerHeader" style="width:670px">
											<table style="margin:5px 0 0 0">
												<tr>
													<td width="235px" align="center"><b><?echo lang('CATGRES');?></b></td>
													<td width="235px" align="center"><b><?echo lang('SUBCATGRES');?></b></td>
													<td width="235px" align="center"><b><?echo lang('SUBSUBCATGRES');?></b></td>
													<td width="60px" align="center"><b><?echo lang('ACTN');?></b></td>
												</tr>
											</table>
										</div>
										<div id="rightHeader"></div>
									</div>
									<ul class="thumbnails">
										<li class="span5" style="width:98%">
											<div id="categoryReslt" style="width:700px;"><img src="images/loader.gif" style="margin:40px 0 0 200px;" alt=""/></div> 
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
