<?php
	require_once ("library/languageFile.php");
	require_once ("library/config.php");
	require_once ("library/functions.php");
	require_once("library/SqlFunctions.php");
	sessionCheck();
	$userId		=	$_SESSION['userId'];
	$prodID		= 	base64_decode($_REQUEST['prod']);
	$stmt		=	getProductDet($prodID);
	while ($row = mysql_fetch_assoc($stmt))
	{
		$proMainImgPath	=	'default.png';
		$prodctName		=	$row['name'];
		$CatgName		=	$row['cat_name'];
		$stockCode		=	$row['stock_code'];
		$prodDescrptn	=	$row['prod_descrptn'];
		$prodCode		=	$row['prod_code'];
		$material		=	$row['material'];
		$prod_diam1		=	$row['prod_diamension'];
		$prod_diam2		=	explode('/',$prod_diam1);
		$prod_diam		=	$prod_diam2[0].' '.$prod_diam2[1];
		$prod_price		=	$row['prod_price'];
		$prod_weight1	=	$row['prod_weight'];
		$prod_weight2	=	explode('/',$prod_weight1);
		$prod_weight	=	$prod_weight2[0].' '.$prod_weight2[1];
		$prod_discount	=	$row['prod_discount'];
		$stock			=	$row['stock'];
		if($row['main_img_path'] != ""){ $proMainImgPath	= $row['main_img_path']; }
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
		<link rel="stylesheet" type="text/css" href="css/common_overlay.css"/>
		
		<script type="text/javascript" src="scripts/jquery.min.js"></script>
		<script type="text/javascript" src="scripts/advetiser.min.js"></script>
		<script type="text/javascript" src="scripts/jquery.simplemodal.js"></script>
		<script type="text/javascript" src="scripts/popUp.js"></script>
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
						<li class="span4" style="width:100%;margin:0">
							<div class="thumbnail">
								<div class="caption"></div>
								<div class="widget-content" style="padding:3% 2% 2% 2%">
									<ul class="thumbnails">
										<li class="span5" style="width:100%">
											<div id="prodDetailsTop">
												<table id="prodDetails">
													<tr>
														<td style="float:left;width:30%;padding:1%">				
															<img src="../images/products/<? echo $proMainImgPath; ?>" alt="" style="width:190px;height:200px"/>
														</td>
														<td style="float:left;width:67%;text-align:left">
															<table style="float:left;width:100%">
																<tr>
																	<td style='float:left;width:100%;font-size:16px;'><b><u><? echo $prodctName; ?></u></b></td>
																</tr>
																<tr height="10px"></tr>
																<tr>
																	<td colspan='2' style='width:100%'>
																		<table style='float:left;width;100%'>
																			<tr><td style='width:100%px;float:left'> <b>Description : </b><? echo $prodDescrptn; ?></td></tr><tr height="3px"></tr>
																			<tr><td style='width:100%px;float:left'><b>Category : </b><? echo $CatgName; ?></td></tr><tr height="3px"></tr>
																			<tr><td style='width:100%px;float:left'><b>Stock Code : </b><? echo $stockCode; ?></td></tr><tr height="3px"></tr>
																			<tr><td style='width:100%px;float:left'><b>Product Code : </b><? echo $prodCode; ?></td></tr><tr height="3px"></tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</div>
											<div id="prodctDetails">
												<div id="leftHeader"></div>
												<div id="centerHeader2" style="width:97%">
													<table id="prodDetails2">
														<tr>
															<td width="22%" align="center"><b>Material</b></td>
															<td width="13%" align="center"><b>Diamension</b></td>
															<td width="13%" align="center"><b>Weight</b></td>
															<td width="13%" align="center"><b>Price (Rs.)</b></td>
															<td width="13%" align="center"><b>Discount (%)</b></td>
															<td width="13%" align="center"><b>Stock</b></td>
														</tr>
													</table>
												</div>
												<div id="rightHeader"></div>
												<div id="orderDetRes">
												<table id="orderDetails2">
													<tr>
														<td width="22%" align="center"><? echo $material; ?></td>
														<td width="13%" align="center"><? echo $prod_diam; ?></td>
														<td width="13%" align="center"><? echo $prod_weight; ?></td>
														<td width="13%" align="center"><? echo $prod_price; ?></td>
														<td width="13%" align="center"><? echo $prod_discount; ?></td>
														<td width="13%" align="center"><? echo $stock; ?></td>
													</tr>
												</table>
												</div>
											</div>
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
