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
		<script type="text/javascript" src="scripts/jquery.min.js"></script>
		<script type="text/javascript" src="scripts/advetiser.min.js"></script>
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
					<h3><?echo lang('DASHBORD_TIT');?></h3>
				</div>
				<!--<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4">
							<div class="thumbnail">
								<div class="caption">
									<h4 align="center"><? echo lang('EVNTS_HEDER');?></h4>
								</div>
								<div class="widget-content">
									<span id="dashEvntsResult"><img src="images/loader.gif" style="margin:40px 0 0 200px" alt=""/></span>                                                                                                            
								</div>
								<div class="widget-footer" id="evntDashViewAll">
									<h6 align="right"><a href="restEvents.php"><? echo lang('VIEW_ALL');?></a></h6>
								</div>
							</div>
						</li>
						<li class="span4">
							<div class="thumbnail">
								<div class="caption">
									<h4 align="center"><? echo lang('BIDS_HEDER');?></h4>
								</div>
								<div class="widget-content">
									<span id="dashBidsResult"><img src="images/loader.gif" style="margin:40px 0 0 200px;" alt=""/></span> 
								</div>
								<div class="widget-footer" id="bidsDashViewAll">
									<input type="hidden" name="advtUsrId" id="advtUsrId" value="<? echo $advtId?>" />
									<h6 align="right"><a href="myBids.php"><? echo lang('VIEW_ALL');?></a></h6>
								</div>
							</div>
						</li>
					</ul>
				</div>-->
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:80%;margin:0 0 0 10%">
							<div class="thumbnail">
								
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
