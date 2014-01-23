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
		$catGId			=	$_POST['catgry'];
		$Subcatgry		=	$_POST['Subcatgry'];
		$SubSubcatgry	=	$_POST['SubSubcatgry'];
		$prod_name		=	stripslashes($_POST['prodName']);
		$prod_descrptn	=	stripslashes($_POST['prodDesc']);
		$stock_code		=	stripslashes($_POST['stckCode']);
		$prod_price		=	stripslashes($_POST['prodPrice']);
		$prodStck		=	stripslashes($_POST['prodStck']);
		$color_polish	=	stripslashes($_POST['colorpolish']);
		$material		=	stripslashes($_POST['fabric']);
		$prod_discount	=	stripslashes($_POST['prodDiscnt']);
		$availablity	=	stripslashes($_POST['prodAvalbty']);
		$prodWdth		=	stripslashes($_POST['prodWdth']);
		$prodBth		=	stripslashes($_POST['prodBth']);
		$prodHght		=	stripslashes($_POST['prodHght']);
		$diamnUnit2		=	$_POST['diamnUnit2'];
		$prodWeight		=	stripslashes($_POST['prodWeight']);
		$wightUnit		=	$_POST['wightUnit'];
		$prod_diamsion	=	'';
		$prod_weight	=	'';
		if($prodWdth != "")
		{
			$prod_diamsion	=	$prodWdth.'*'.$prodBth.'*'.$prodHght.'/'.$diamnUnit2;
		}
		$prod_weight	=	$prodWeight.'/'.$wightUnit;
		
		$prodID			=	$_POST['prodId'];
		
		/*************************************** product insert Query *********************************************************/
		$prodCtSql		=	updateProduct($prod_name,$prod_descrptn,$stock_code,$prod_price,$prodStck,$color_polish,$material,$prod_discount,									$availablity,$prod_diamsion,$prod_weight,$prodID,$catGId,$Subcatgry,$SubSubcatgry);
		
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
		$productId		=	base64_decode($_REQUEST['prod']);
		$delFlag		=	0;
		$stmnt			=	getProductQuery($productId);
		$prod_discount	=	0;
		while ($row = mysql_fetch_assoc($stmnt)) {
			$prod_name			=	$row['name'];
			$prod_descrptn		=	$row['prod_descrptn'];
			$cat_id				=	$row['cat_id'];
			$stock_code			=	$row['stock_code'];
			$prod_price			=	$row['prod_price'];
			$color_polish		=	$row['color_polish'];
			$material			=	$row['material'];
			$prod_discount		=	$row['prod_discount'];
			$availablity		=	$row['availablity'];
			$prod_diamension	=	$row['prod_diamension'];
			$prod_weight		=	$row['prod_weight'];
			$sub_catg_id		=	$row['sub_catg_id'];
			$sub_sub_catg_id	=	$row['sub_sub_catg_id'];
			$stock				=	$row['stock'];
			$diam_one			=	explode('/',$prod_diamension);
			$diam_two			=	explode('*',$diam_one[0]);
			$wght_one			=	explode('/',$prod_weight);
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
													<select id="catgry" name="catgry" onchange="return loadSubCatg()">
														<option value="">Select</option>
													<?
														$catgRes		=	categQuery($userId);
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
													<?
														$ScatgRes		=	getSubCatg($sub_catg_id);
														while ($ScatRow	=	mysql_fetch_assoc($ScatgRes)) {
													?>
														<option value="<? echo $ScatRow['id'];?>" selected><? echo $ScatRow['sub_catg_name'];?></option>
													<?
														}
													?>
														
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
													<?
														$SScatgRes		=	getSubSubCatg($sub_sub_catg_id);
														while ($SScatRow	=	mysql_fetch_assoc($SScatgRes)) {
													?>
														<option value="<? echo $SScatRow['id'];?>" selected><? echo $SScatRow['sub_catg_name'];?></option>
													<?
														}
													?>
													</select>
												</td>
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
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_PRCE');?> <span>*</span></td>
												<td>:</td>
												<td><input type="text" name="prodPrice" id="prodPrice" style="width:300px" value="<?echo $prod_price ?>" /></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('PROD_STCK');?> <span>*</span></td>
												<td>:</td>
												<td>
													<input type="text" id="prodStck" name="prodStck" style="width:300px" value="<?echo $stock ?>" />
												</td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td><?echo lang('COLOR_POLSH');?> </td>
												<td>:</td>
												<td><input type="text" name="colorpolish" id="colorpolish" style="width:300px" value="<?echo $color_polish ?>" /></td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('MATRAL_LABL');?> </td>
												<td style="width:20px">:</td>
												<td style="width:430px">
													<input type="text" name="fabric" id="fabric" style="width:300px" value="<?echo $material ?>" />
												</td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('PROD_DECNT');?></td>
												<td style="width:20px">:</td>
												<td style="width:430px">
													<input type="text" name="prodDiscnt" id="prodDiscnt" onchange="return calDiscntVal()" style="width:300px" value="<? echo $prod_discount ?>"/> %
													&nbsp;&nbsp;<span id="discntVal" style="color:#000"></span>
												</td>
											</tr>
											<tr height="5px"></tr>
											<tr>
												<td width="150px"><?echo lang('PROD_AVABLTY');?> <span>*</span></td>
												<td style="width:20px">:</td>
												<td style="width:430px">
													<select id="prodAvalbty" name="prodAvalbty">
														<?
															$sel1	=	'';
															$sel2	=	'';
															if($availablity == 0){$sel1='selected';}else{$sel2='selected';}
														?>
														<option value="">Select</option>
														<option value="0" <? echo $sel1;?>>Available</option>
														<option value="1" <? echo $sel2;?>>Unavailable</option>
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
													<input type="text" name="prodWdth" id="prodWdth" style="width:40px" value="<? echo $diam_two[0]?>">
													*&nbsp;&nbsp;&nbsp;
													<input type="text" name="prodBth" id="prodBth" style="width:40px" value="<? echo $diam_two[1]?>">
													*&nbsp;&nbsp;&nbsp;
													<input type="text" name="prodHght" id="prodHght" style="width:40px" value="<? echo $diam_two[2]?>">
													<select id="diamnUnit2" name="diamnUnit2" style="width:80px">
														<option value="">Select</option>
												<?
													while($uRow3 = mysql_fetch_assoc($unitSel))
													{
														if($diam_one[1] == $uRow3['unit']){$dunitS	=	'selected';}else{$dunitS='';}
														
												?>
														<option value="<? echo $uRow3['unit']; ?>" <? echo $dunitS;?>><? echo $uRow3['unit']; ?></option>
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
													<input type="text" name="prodWeight" id="prodWeight" style="width:126px" value="<? echo $wght_one[0] ?>">&nbsp;&nbsp;&nbsp;
													<select id="wightUnit" name="wightUnit" style="width:128px">
														<option value="">Select</option>
												<?
													$unitFor	=	2;
													$unitSel2	=	unitQuery($unitFor);
													while($uRow4 = mysql_fetch_assoc($unitSel2))
													{
														if($wght_one[1] == $uRow4['unit']){$WunitS	=	'selected';}else{$WunitS='';}
												?>
														<option value="<? echo $uRow4['unit']; ?>" <? echo $WunitS;?>><? echo $uRow4['unit']; ?></option>
												<?
													}
												?>
													</select>
												</td>
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
