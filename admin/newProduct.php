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
		$catGId	=	'';
		$userId		=	$_SESSION['userId'];
		$date	=	date('Y-m-d');
		$catGry	=	$_POST['catgry'];
		if($catGry	==	'999999')
		{
			/********************** Other Category Insert Query ******************************************/
			$catGOthr	=	$_POST['catGOthr'];
			$catGId		=	addCategory($catGOthr,$userId,$date);
		}
		else{
			$catGId	=	$catGry;
		}
		$prodName	=	$_POST['prodName'];
		$prodDesc	=	$_POST['prodDesc'];
		$stckCde	=	$_POST['stckCode'];
		$delFlag	=	0;
		$numchars2 	= 	rand(100,1000);
		$prodCode 	= 	'PROD'.$numchars2;
		
		$addedDte	=	date('Y-m-d G:i:s');
		$updateDte	=	'0000-00-00 0:0:0';
		/*************************************** product insert Query *********************************************************/
		$prodCtSql		=	"INSERT INTO products (name,prod_code,stock_code,prod_descrptn,cat_id,added_by,added_date,updated_date,del_flag)
							VALUES('".$prodName."','".$prodCode."','".$stckCde."','".$prodDesc."','".$catGId."','".$userId."','".$addedDte."','".$addedDte."',0)";
		$prodCtStmnt	=	mysql_query($prodCtSql);
		$prOdId = mysql_insert_id();
		
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
		$prodImgSql		=	"INSERT INTO prodct_images (prodct_id,main_img_path,front_img_path,back_img_path,side_img_path,del_flag)
							VALUES('".$prOdId."','".$prod_main_img."','".$prod_frnt_img."','".$prod_bck_img."','".$prod_sde_img."',0)";
		$prodImgStmnt	=	mysql_query($prodImgSql);
		
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
			textarea,input[type='text']{
				width:300px;
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
						<li class="span4" style="width:60%;margin:0 0 0 20%">
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
												<td width="120px"><?echo lang('CATGRES');?> <span>*</span></td>
												<td style="width:30px">:</td>
												<td style="width:420px">
													<select id="catgry" name="catgry" onchange="return checkOthrCatg()">
														<option value="">Select</option>
													<?
														$catgRes	=	categQuery($userId);
														while ($catRow	=	mysql_fetch_assoc($catgRes)) {
													?>
															<option value="<? echo $catRow['cat_id'];?>"><? echo $catRow['cat_name'];?></option>
													<?
														}
													?>
														<option value="999999">Other</option>
													</select>
												</td>
											</tr>
											<tr height="5px"></tr>
											<tr style="display:none" id="catGOthrTR">
												<td></td><td>:</td>
												<td><input type="text" name="catGOthr" id="catGOthr"/></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_NME');?> <span>*</span></td>
												<td>:</td>
												<td><input type="text" name="prodName" id="prodName"/></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_DESC');?></td>
												<td>:</td>
												<td><textarea type="text" name="prodDesc" id="prodDesc"></textarea></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('STCK_CDE');?> <span>*</span></td>
												<td>:</td>
												<td><input type="text" name="stckCode" id="stckCode" /></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_MAIN_IMG');?></td>
												<td>:</td>
												<td><input type="File" name="prodMainImg" id="prodMainImg" /></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_FRNT_IMG');?></td>
												<td>:</td>
												<td><input type="File" name="prodFrntImg" id="prodFrntImg" /></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_BCK_IMG');?></td>
												<td>:</td>
												<td><input type="File" name="prodBckImg" id="prodBckImg" /></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_SDE_IMG');?></td>
												<td>:</td>
												<td><input type="File" name="prodSdeImg" id="prodSdeImg" /></td>
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
