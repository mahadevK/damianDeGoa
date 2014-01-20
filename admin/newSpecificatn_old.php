<?php
	require_once ("library/languageFile.php");
	require_once ("library/config.php");
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
		<style type="text/css">
			select{
				width:280px;
			}
			textarea,input[type='text']{
				width:266px;
			}
			textarea{
				resize:none;
			}
			span{
				color:red;
			}
			#prodWdth,#prodHght,#prodBth{
				width:30px;
			}
		</style>
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
					<h3><?echo lang('SPECFCTN');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:60%;margin:0 0 0 20%">
							<div class="thumbnail">
								<div class="caption">
									<h5 align="right" style="margin-right:10px">
										<a href="Specification.php"><? echo lang('VEW_PROD_SPEC');?></a>
									</h5>
								</div>
								<div class="widget-content">
									<table width="600px" align="center">
										<tr height="25px"><td colspan="3"><span style="color:red;" id="sucessMsg"></span></td></tr>
										<tr>
											<td width="120px"><?echo lang('PRODCTS');?> <span>*</span></td>
											<td style="width:30px">:</td>
											<td style="width:420px">
												<select id="proD" name="proD">
													<option value="">Select</option>
												<?
													$prodRes	=	prodQuery($userId);
													while($proDRow = mysql_fetch_assoc($prodRes))
													{
														$proDId		=	$proDRow['prod_id'];
														$proDName	=	$proDRow['name'];
												?>
														<option value="<? echo $proDId;?>"><? echo $proDName;?></option>
												<?
													}
												?>
												</select>
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('PROD_PRCE');?> <span>*</span></td>
											<td>:</td>
											<td><input type="text" name="prodPrice" id="prodPrice"/></td>
										</tr>
											<tr height="5px"></tr>
										<tr>
											<td><?echo lang('CODE_LABL');?> <span>*</span></td>
											<td>:</td>
											<td><input type="text" name="prodcode" id="prodcode"/></td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('PROD_DECNT');?></td>
											<td>:</td>
											<td>
												<input type="text" name="prodDiscnt" id="prodDiscnt" value="0" onchange="return calDiscntVal()"/> %
												&nbsp;&nbsp;<span id="discntVal" style="color:#000"></span>
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('PROD_AVABLTY');?> <span>*</span></td>
											<td>:</td>
											<td>
												<select id="prodAvalbty" name="prodAvalbty">
													<option value="">Select</option>
													<option value="0">Available</option>
													<option value="1">Unavailable</option>
												</select>
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('PROD_STCK');?> <span>*</span></td>
											<td>:</td>
											<td>
												<input type="text" id="prodStck" name="prodStck" />
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr height="5px"></tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('TAGS_MENU');?></td>
											<td>:</td>
											<td>
										<?
											$tagRes	=	tagQuery($userId);
											while($tagsRow	=	mysql_fetch_assoc($tagRes))
											{
										?>
												<span style="float:left;width:187px;margin:0 0 0 5px;padding:5px 0px;border-bottom:1px  #000000;">
													<input id="tagscheck"  type="checkbox" style="float:left;"  name="tagscheck" value="<?echo $tagsRow['id']; ?>">
													<p style="float:left;width:162px;margin:3px 0 0 5px;color: #000000;"><?echo $tagsRow['tag_name']; ?></p>
												</span>
										<?
											}
										?>
									
											</td>
										</tr>
										
										<tr height="25px;"></tr>
										<tr>
											<td align="center" colspan="3">
												<input type="submit" name="prodSpecSub" id="prodSpecSub" value="Submit" onclick="return valSpecatn()">
												<input name="Cancel" type="button" id="Cancel" value="Cancel" onclick="window.location.href='Specification.php';" />
												<img src="images/loading.gif" alt="" style="display:none" id="loadingImg"/>
											</td>
										</tr>
										<tr height="25px"></tr>
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
