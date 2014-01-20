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
		$catGry	=	$_POST['catgry'];
		if($catGry	==	'999999')
		{
			$date		=	date('Y-m-d G:i:s');
			/********************** Other Category Insert Query ******************************************/
			$catGOthr	=	$_POST['catGOthr'];
			$catGId		=	addCategory($catGOthr,$userId,$date);
			
		}
		else{
			$catGId	=	$catGry;
		}	
		$prodID			=	$_POST['prodId'];
		$prod_name		=	$_POST['prodName'];
		$prod_descrptn	=	$_POST['prodDesc'];
		$stock_code		=	$_POST['stckCode'];
		$delFlag		=	0;
		$updateDte		=	date('Y-m-d G:i:s');
		/*************************************** product insert Query *********************************************************/
		$prodCtSql		=	updateProduct($prod_name,$prod_descrptn,$catGId,$stock_code,$updateDte,$prodID);
		
		/*********************************** Products Images Insert Query *************************************/
		$prod_main_img	=	'';
		$prod_frnt_img	=	'';
		$prod_bck_img	=	'';
		$prod_sde_img	=	'';
		$delFlag		=	0;
		$prodMainImg	=	$_FILES['prodMainImg']['name'];
		if($prodMainImg != "")
		{
			if ($_FILES['prodMainImg']['type']=="image/jpg" || $_FILES['prodMainImg']['type']=="image/jpeg" || $_FILES['prodMainImg']['type']=="image/pjpeg" || $_FILES['prodMainImg']['type']=="image/gif" || $_FILES['prodMainImg']['type']=="image/png" || $_FILES['prodMainImg']['type']=="image/tif" || $_FILES['prodMainImg']['type']=="image/tiff" ) 
			{
				$prod_main_img 	= 	time()."_".strtolower($_FILES['prodMainImg']['name']);
				@move_uploaded_file($_FILES['prodMainImg']['tmp_name'],"../images/products/".$prod_main_img);
			}
		}
		else{
			$prod_main_img = $_POST['mainPrvImg'];
		}
		$prodFrntImg	=	$_FILES['prodFrntImg']['name'];
		if($prodFrntImg != "")
		{
			if ($_FILES['prodFrntImg']['type']=="image/jpg" || $_FILES['prodFrntImg']['type']=="image/jpeg" || $_FILES['prodFrntImg']['type']=="image/pjpeg" || $_FILES['prodFrntImg']['type']=="image/gif" || $_FILES['prodFrntImg']['type']=="image/png" || $_FILES['prodFrntImg']['type']=="image/tif" || $_FILES['prodFrntImg']['type']=="image/tiff" ) 
			{
				$prod_frnt_img 	= 	time()."_".strtolower($_FILES['prodFrntImg']['name']);
				@move_uploaded_file($_FILES['prodFrntImg']['tmp_name'],"../images/products/".$prod_frnt_img);
			}
		}
		else{
			$prod_frnt_img = $_POST['frntPrvImg'];
		}
		$prodBckImg	=	$_FILES['prodBckImg']['name'];
		if($prodBckImg != "")
		{
			if ($_FILES['prodBckImg']['type']=="image/jpg" || $_FILES['prodBckImg']['type']=="image/jpeg" || $_FILES['prodBckImg']['type']=="image/pjpeg" || $_FILES['prodBckImg']['type']=="image/gif" || $_FILES['prodBckImg']['type']=="image/png" || $_FILES['prodBckImg']['type']=="image/tif" || $_FILES['prodBckImg']['type']=="image/tiff" ) 
			{
				$prod_bck_img 	= 	time()."_".strtolower($_FILES['prodBckImg']['name']);
				@move_uploaded_file($_FILES['prodBckImg']['tmp_name'],"../images/products/".$prod_bck_img);
			}
		}
		else{
			$prod_bck_img = $_POST['bckPrvImg'];
		}
		$prodSdeImg	=	$_FILES['prodSdeImg']['name'];
		if($prodSdeImg != "")
		{
			if ($_FILES['prodSdeImg']['type']=="image/jpg" || $_FILES['prodSdeImg']['type']=="image/jpeg" || $_FILES['prodSdeImg']['type']=="image/pjpeg" || $_FILES['prodSdeImg']['type']=="image/gif" || $_FILES['prodSdeImg']['type']=="image/png" || $_FILES['prodSdeImg']['type']=="image/tif" || $_FILES['prodSdeImg']['type']=="image/tiff" ) 
			{
				$prod_sde_img 	= 	time()."_".strtolower($_FILES['prodSdeImg']['name']);
				@move_uploaded_file($_FILES['prodSdeImg']['tmp_name'],"../images/products/".$prod_sde_img);
			}
		}
		else{
			$prod_sde_img = $_POST['sdePrvImg'];
		}
		
		$prodImgSql	=	updateProdImg($prod_main_img,$prod_frnt_img,$prod_bck_img,$prod_sde_img,$prodID);
		
		$msg	=	'Product sucessfully edited';
		echo  "<META HTTP-EQUIV=\"Refresh\" Content=\"1;URL=Products.php\">";
	}
	else
	{
		$productId	=	base64_decode($_REQUEST['prod']);
		$delFlag	=	0;
		$stmnt		=	getProductQuery($productId);
		while ($row = mysql_fetch_assoc($stmnt)) {
			$prod_name		=	$row['name'];
			$prod_descrptn	=	$row['prod_descrptn'];
			$cat_id			=	$row['cat_id'];
			$stock_code		=	$row['stock_code'];
			if($row['main_img_path'] == ""){ $main_img_path = 'default.png';}else{ $main_img_path = $row['main_img_path']; }
			if($row['front_img_path'] == ""){ $front_img_path = 'default.png';}else{ $front_img_path = $row['front_img_path']; }
			if($row['back_img_path'] == ""){ $back_img_path = 'default.png';}else{ $back_img_path = $row['back_img_path']; }
			if($row['side_img_path'] == ""){ $side_img_path = 'default.png';}else{ $side_img_path = $row['side_img_path']; }
		}
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
			input[type='file']{
				width:200px;
			}
			.filebutton {
				float: left;
				height: 20px;
				display: inline-block;
				outline: 0 none;
				cursor: pointer;
				border: 1px solid #CCCCCC;
				border-radius: 5px 5px 5px 5px;
				box-shadow: 0 0 1px #fff inset;
				color: #555555;
				margin-left: 3px;
				padding: 6px 12px;
				background: #DDDDDD;
				background:-moz-linear-gradient(top, #EEEEEE 0%, #DDDDDD 100%);
				background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #EEEEEE), color-stop(100%, #DDDDDD));filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#EEEEEE', endColorstr='#DDDDDD', GradientType=0);
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
									<form method="POST" action="editProduct.php" name="addProdFrm" id="addProdFrm" enctype="multipart/form-data" autocomplete="off">
										<table width="100%" align="center">
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
														
															if($cat_id == $catRow['cat_id'])
															{
																$catSel	=	'Selected';
															}
															else
															{
																$catSel	= '';
															}
													?>
															<option value="<? echo $catRow['cat_id'];?>" <? echo $catSel; ?>><? echo $catRow['cat_name'];?></option>
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
												<td><input type="text" name="prodName" id="prodName" value="<?echo $prod_name ?>"/></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_DESC');?></td>
												<td>:</td>
												<td><textarea type="text" name="prodDesc" id="prodDesc"><?echo $prod_descrptn ?></textarea></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('STCK_CDE');?> <span>*</span></td>
												<td>:</td>
												<td><input type="text" name="stckCode" id="stckCode" value="<?echo $stock_code ?>"/></td>
											</tr>
											<tr height="15px"></tr>
											<tr>
												<td colspan="3">
													<table>
														<tr>
															<td style="text-align:center"><?echo lang('PROD_MAIN_IMG');?><input type="hidden" name="mainPrvImg" id="mainPrvImg" value="<? echo $main_img_path;?>" /></td>
															<td style="text-align:center"><?echo lang('PROD_FRNT_IMG');?><input type="hidden" name="frntPrvImg" id="frntPrvImg" value="<? echo $front_img_path;?>" /></td>
														</tr>
														<tr height="5px"></tr>
														<tr><td colspan="2" style="background:#D9D9D9"></td></tr>
														<tr height="5px"></tr>
														<tr>
															<td style="width:300px;text-align:center"><img src="../images/products/<? echo $main_img_path;?>" alt="" style="width:150px;height:150px;"/></td>
															<td style="width:300px;text-align:center"><img src="../images/products/<? echo $front_img_path;?>" alt="" style="width:150px;height:150px;"/></td>
														</tr>
														<tr height="5px"></tr>
														<tr>
															<td><input type="File" name="prodMainImg" id="prodMainImg" class="filebutton"/></td>
															<td><input type="File" name="prodFrntImg" id="prodFrntImg" class="filebutton"/></td>
														</tr>
														<tr height="10px"></tr>
														<tr><td colspan="2" style="background:#D9D9D9"></td></tr>
														<tr height="10px"></tr>
														<tr>
															<td style="text-align:center"><?echo lang('PROD_BCK_IMG');?><input type="hidden" name="bckPrvImg" id="bckPrvImg" value="<? echo $back_img_path;?>" /></td>
															<td style="text-align:center"><?echo lang('PROD_SDE_IMG');?><input type="hidden" name="sdePrvImg" id="sdePrvImg" value="<? echo $side_img_path;?>" /></td>
														</tr>
														<tr height="5px"></tr>
														<tr><td colspan="2" style="background:#D9D9D9"></td></tr>
														<tr height="5px"></tr>
														<tr>
															<td style="width:300px;text-align:center"><img src="../images/products/<? echo $back_img_path;?>" alt="" style="width:150px;height:150px;"/></td>
															<td style="width:300px;text-align:center"><img src="../images/products/<? echo $side_img_path;?>" alt="" style="width:150px;height:150px;" /></td>
														</tr>
														<tr height="5px"></tr>
														<tr>
															<td><input type="File" name="prodBckImg" id="prodBckImg" class="filebutton"/></td>
															<td><input type="File" name="prodSdeImg" id="prodSdeImg" class="filebutton"/></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr height="35px;"></tr>
											<tr>
												<td align="center" colspan="3">
													<input type="hidden" id="prodId" name="prodId" value="<? echo $productId;?>" />
													<input type="submit" name="prodSub" id="prodSub" value="Submit" onclick="return valEditProdct()">
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
