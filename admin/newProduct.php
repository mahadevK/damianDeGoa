<?php
	require_once ("library/languageFile.php");
	require_once ("library/config.php");
	require_once ("library/functions.php");
	require_once("library/SqlFunctions.php");
	sessionCheck();
	$userId		=	$_SESSION['userId'];
	$msg	=	'';
	if(isset($_POST['prodSub']) || isset($_POST['prodSub_x']))
	{
		$userId			=	$_SESSION['userId'];
		$date			=	date('Y-m-d');
		$catGId			=	$_POST['catgry'];
		$Subcatgry		=	$_POST['Subcatgry'];
		$SubSubcatgry	=	$_POST['SubSubcatgry'];
		$prodName		=	stripslashes($_POST['prodName']);
		$prodDesc		=	stripslashes($_POST['prodDesc']);
		$stckCde		=	stripslashes($_POST['stckCode']);
		$prodPrice		=	stripslashes($_POST['prodPrice']);
		$prodStck		=	stripslashes($_POST['prodStck']);
		$colrpolish		=	stripslashes($_POST['colorpolish']);
		$fabric			=	stripslashes($_POST['fabric']);
		$prodDiscnt		=	stripslashes($_POST['prodDiscnt']);
		$prodAvbty		=	stripslashes($_POST['prodAvalbty']);
		$prodWdth		=	stripslashes($_POST['prodWdth']);
		$prodBth		=	stripslashes($_POST['prodBth']);
		$prodHght		=	stripslashes($_POST['prodHght']);
		$diamnUnit2		=	$_POST['diamnUnit2'];
		$prodWeight		=	stripslashes($_POST['prodWeight']);
		$wightUnit		=	$_POST['wightUnit'];
		$prod_diamsion	=	'';
		if($prodWdth != "")
		{
			$prod_diamsion	=	$prodWdth.'*'.$prodBth.'*'.$prodHght.'/'.$diamnUnit2;
		}
		$prod_weight	=	$prodWeight.'/'.$wightUnit;
		$delFlag		=	0;
		$numchars2 		= 	rand(100,1000);
		$prodCode 		= 	'PROD'.$numchars2;
		
		
		/*************************************** product insert Query *********************************************************/
		$prOdId		=	prodInsertQry($prodName,$prodCode,$stckCde,$prodDesc,$prodPrice,$prodStck,$colrpolish,$fabric,$prodDiscnt,
							$prodAvbty,$prod_diamsion,$prod_weight,$catGId,$Subcatgry,$SubSubcatgry,$userId);
		
		
		/*********************************** Products Images Insert Query *************************************/
		$prod_main_img	=	'';
		$prod_frnt_img	=	'';
		$prod_bck_img	=	'';
		$prod_sde_img	=	'';
		$delFlag		=	0;
		$prodMainImg	=	$_FILES['prodMainImg']['name'];
		if ($_FILES['prodMainImg']['type']=="image/jpg" || $_FILES['prodMainImg']['type']=="image/jpeg" || $_FILES['prodMainImg']['type']=="image/pjpeg" || $_FILES['prodMainImg']['type']=="image/gif" || $_FILES['prodMainImg']['type']=="image/png" || $_FILES['prodMainImg']['type']=="image/tif" || $_FILES['prodMainImg']['type']=="image/tiff" ) 
		{
			$prod_main_img 	= 	time()."_".strtolower($_FILES['prodMainImg']['name']);
			@move_uploaded_file($_FILES['prodMainImg']['tmp_name'],"../images/products/".$prod_main_img);
		}
		$prodFrntImg	=	$_FILES['prodFrntImg']['name'];
		if ($_FILES['prodFrntImg']['type']=="image/jpg" || $_FILES['prodFrntImg']['type']=="image/jpeg" || $_FILES['prodFrntImg']['type']=="image/pjpeg" || $_FILES['prodFrntImg']['type']=="image/gif" || $_FILES['prodFrntImg']['type']=="image/png" || $_FILES['prodFrntImg']['type']=="image/tif" || $_FILES['prodFrntImg']['type']=="image/tiff" ) 
		{
			$prod_frnt_img 	= 	time()."_".strtolower($_FILES['prodFrntImg']['name']);
			@move_uploaded_file($_FILES['prodFrntImg']['tmp_name'],"../images/products/".$prod_frnt_img);
		}
		$prodBckImg	=	$_FILES['prodBckImg']['name'];
		if ($_FILES['prodBckImg']['type']=="image/jpg" || $_FILES['prodBckImg']['type']=="image/jpeg" || $_FILES['prodBckImg']['type']=="image/pjpeg" || $_FILES['prodBckImg']['type']=="image/gif" || $_FILES['prodBckImg']['type']=="image/png" || $_FILES['prodBckImg']['type']=="image/tif" || $_FILES['prodBckImg']['type']=="image/tiff" ) 
		{
			$prod_bck_img 	= 	time()."_".strtolower($_FILES['prodBckImg']['name']);
			@move_uploaded_file($_FILES['prodBckImg']['tmp_name'],"../images/products/".$prod_bck_img);
		}
		$prodSdeImg	=	$_FILES['prodSdeImg']['name'];
		if ($_FILES['prodSdeImg']['type']=="image/jpg" || $_FILES['prodSdeImg']['type']=="image/jpeg" || $_FILES['prodSdeImg']['type']=="image/pjpeg" || $_FILES['prodSdeImg']['type']=="image/gif" || $_FILES['prodSdeImg']['type']=="image/png" || $_FILES['prodSdeImg']['type']=="image/tif" || $_FILES['prodSdeImg']['type']=="image/tiff" ) 
		{
			$prod_sde_img 	= 	time()."_".strtolower($_FILES['prodSdeImg']['name']);
			@move_uploaded_file($_FILES['prodSdeImg']['tmp_name'],"../images/products/".$prod_sde_img);
		}
		$prodImgSql		=	InsertProdImg($prOdId,$prod_main_img,$prod_frnt_img,$prod_bck_img,$prod_sde_img);
		$msg	=	'Product sucessfully added';
		echo  "<META HTTP-EQUIV=\"Refresh\" Content=\"1;URL=Products.php\">";
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
		<style type="text/css">
			select{
				width:307px;
			}
			textarea{
				resize:none;
			}
			span{
				color:red;
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
					<h3><?echo lang('PRODCTS');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:70%;margin:0 0 0 15%">
							<div class="thumbnail">
								<div class="caption">
									<h5 align="right" style="margin-right:10px">
										<a href="Products.php"><? echo lang('VEW_PROD');?></a>
									</h5>
								</div>
								<div class="widget-content">
									<form method="POST" action="newProduct.php" name="addProdFrm" id="addProdFrm" enctype="multipart/form-data" autocomplete="off">
										<table width="600px" align="center">
											<tr height="25px"><td colspan="3"><span id="sucessMsg"><? echo $msg;?></span></td></tr>
											<tr>
												<td width="150px"><?echo lang('CATGRES');?> <span>*</span></td>
												<td style="width:20px">:</td>
												<td style="width:430px">
													<select id="catgry" name="catgry" onchange="return loadSubCatg()">
														<option value="">Select</option>
													<?
														$catgRes	=	categQuery($userId);
														while ($catRow	=	mysql_fetch_assoc($catgRes)) {
													?>
															<option value="<? echo $catRow['cat_id'];?>"><? echo $catRow['cat_name'];?></option>
													<?
														}
													?>
													</select>
												</td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px">
													<?echo lang('SUBCATGRES');?> <span>*</span></td>
												<td width="20px">:</td>
												<td width="430px">
													<img src="images/loading.gif" alt="" style="display:none;margin:0 0 0 187px" id="subCatgLdng"/>
													<select id="Subcatgry" name="Subcatgry" onchange="return loadSbSubCatg()">
														<option value="">Select</option>
													</select>
												</td>
											</tr>
											<tr height="5px;"></tr>
											<tr>
												<td width="150px">
													<?echo lang('SUBSUBCATGRES');?></td>
												<td width="20px">:</td>
												<td width="430px">
													<img src="images/loading.gif" alt="" style="display:none;margin:0 0 0 187px" id="SsubCatgLdng"/>
													<select id="SubSubcatgry" name="SubSubcatgry">
														<option value="">Select</option>
													</select>
												</td>
											</tr>
											<tr height="25px;"></tr>
											<tr>
												<td><?echo lang('PROD_NME');?> <span>*</span></td>
												<td>:</td>
												<td><input type="text" name="prodName" id="prodName" style="width:300px"/></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_DESC');?></td>
												<td>:</td>
												<td><textarea type="text" name="prodDesc" id="prodDesc" style="width:300px"></textarea></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('STCK_CDE');?> <span>*</span></td>
												<td>:</td>
												<td><input type="text" name="stckCode" id="stckCode" style="width:300px" /></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_PRCE');?> <span>*</span></td>
												<td>:</td>
												<td><input type="text" name="prodPrice" id="prodPrice" style="width:300px"/></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_STCK');?> <span>*</span></td>
												<td>:</td>
												<td>
													<input type="text" id="prodStck" name="prodStck" style="width:300px"/>
												</td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('COLOR_POLSH');?> </td>
												<td>:</td>
												<td><input type="text" name="colorpolish" id="colorpolish" style="width:300px"/></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('MATRAL_LABL');?> </td>
												<td style="width:20px">:</td>
												<td style="width:430px">
													<input type="text" name="fabric" id="fabric" style="width:300px"/>
												</td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('PROD_DECNT');?></td>
												<td style="width:20px">:</td>
												<td style="width:430px">
													<input type="text" name="prodDiscnt" id="prodDiscnt" value="0" onchange="return calDiscntVal()" style="width:300px"/> %
													&nbsp;&nbsp;<span id="discntVal" style="color:#000"></span>
												</td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('PROD_AVABLTY');?> <span>*</span></td>
												<td style="width:20px">:</td>
												<td style="width:430px">
													<select id="prodAvalbty" name="prodAvalbty">
														<option value="">Select</option>
														<option value="0">Available</option>
														<option value="1">Unavailable</option>
													</select>
												</td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('PROD_DIMENS_LAB');?></td>
												<td style="width:20px">:</td>
												<td style="width:430px">
												<?
													$unitFor	=	1;
													$unitSel	=	unitQuery($unitFor);
												?>
													<input type="text" name="prodWdth" id="prodWdth" style="width:40px">
													*&nbsp;&nbsp;&nbsp;
													<input type="text" name="prodBth" id="prodBth" style="width:40px">
													*&nbsp;&nbsp;&nbsp;
													<input type="text" name="prodHght" id="prodHght" style="width:40px">
													<select id="diamnUnit2" name="diamnUnit2" style="width:80px">
														<option value="">Select</option>
												<?
													while($uRow3 = mysql_fetch_assoc($unitSel))
													{
												?>
														<option value="<? echo $uRow3['unit']; ?>"><? echo $uRow3['unit']; ?></option>
												<?
													}
												?>
													</select>
												</td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('PROD_WEGHT_LAB');?></td>
												<td style="width:20px">:</td>
												<td style="width:430px">
													<input type="text" name="prodWeight" id="prodWeight" style="width:126px">&nbsp;&nbsp;&nbsp;
													<select id="wightUnit" name="wightUnit" style="width:128px">
														<option value="">Select</option>
												<?
													$unitFor	=	2;
													$unitSel2	=	unitQuery($unitFor);
													while($uRow4 = mysql_fetch_assoc($unitSel2))
													{
												?>
														<option value="<? echo $uRow4['unit']; ?>"><? echo $uRow4['unit']; ?></option>
												<?
													}
												?>
													</select>
												</td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('PROD_MAIN_IMG');?></td>
												<td style="width:20px">:</td>
												<td style="width:430px"><input type="File" name="prodMainImg" id="prodMainImg" /></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('PROD_FRNT_IMG');?></td>
												<td style="width:20px">:</td>
												<td style="width:430px"><input type="File" name="prodFrntImg" id="prodFrntImg" /></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('PROD_BCK_IMG');?></td>
												<td style="width:20px">:</td>
												<td style="width:430px"><input type="File" name="prodBckImg" id="prodBckImg" /></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('PROD_SDE_IMG');?></td>
												<td style="width:20px">:</td>
												<td style="width:430px"><input type="File" name="prodSdeImg" id="prodSdeImg" /></td>
											</tr>
											<tr height="25px;"></tr>
											<tr>
												<td align="center" colspan="3">
													<input type="submit" name="prodSub" id="prodSub" value="Submit" onclick="return valProdct()">
													<input name="Cancel" type="button" id="Cancel" value="Cancel" onclick="window.location.href='Products.php';" />
													<img src="images/loading.gif" alt="" style="display:none" id="loadingImg"/>
												</td>
											</tr>
											<tr height="25px"></tr>
										</table>
									</form>
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
