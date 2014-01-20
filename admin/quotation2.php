<?php
	require_once("library/languageFile.php");
	require_once("library/config.php");
	require_once("library/functions.php");
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
					<h3><?echo lang('ADD_USERS');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:80%;margin:0 0 0 9%">
							<div class="thumbnail">
								<div class="widget-content" style="background:#fff;">
									<div class="quotatnFrmDiv">
										<table style="width:100%">
											<tr>
												<td style="width:68%">
													<table>
														<tr><td class="qtnFrmLis1"><img src="../images/LOGO.jpg" style="height:100px" alt=""/></td></tr>
														<tr><td><? echo lang('QUOTATN_FRM_T');?></td></tr>
														<tr><td><? echo lang('QUOTATN_FRM_A');?></td></tr>
													</table>
												</td>
												<td style="width:30%">
													<table>
														<tr><td>PHONE : 2417045, 24112126, 2413737</td></tr>
														<tr><td>FAX : 0832 - 24112127</td></tr>
														<tr><td>E-mail : ddg_goa@sancharnet.in</td></tr>
														<tr><td>damiandegoaa@dataone.in</td></tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
									<div class="quotatnFrmDiv midQtnFrmDiv">
										<table style="width:100%">
											<tr>
												<td style="width:68%">
													<table>
														<tr><td class="qtnFrmLis1"><img src="../images/LOGO.jpg" style="height:100px" alt=""/></td></tr>
														<tr><td><? echo lang('QUOTATN_FRM_T');?></td></tr>
														<tr><td><? echo lang('QUOTATN_FRM_A');?></td></tr>
													</table>
												</td>
												<td style="width:30%">
													<table>
														<tr><td>PHONE : 2417045, 24112126, 2413737</td></tr>
														<tr><td>FAX : 0832 - 24112127</td></tr>
														<tr><td>E-mail : ddg_goa@sancharnet.in</td></tr>
														<tr><td>damiandegoaa@dataone.in</td></tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
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
