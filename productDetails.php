<?php
	require_once ("library/languageFile.php");
	require_once ("library/functions.php");
	require_once ("library/config.php");
	require_once ("library/sqlFunction.php");
	$specId		=	base64_decode($_REQUEST['prodct']);
	if($specId !=""){	$_SESSION['ITMSPECID']	=	$specId;}
	else{	$specId	=	$_SESSION['ITMSPECID'];}
	$del_flag	=	0;
	$sizeDropDwn	=	'';
	$prodSql		=	prodQuery($specId);
	while ($prodctRow = mysql_fetch_assoc($prodSql)) {
		$CatgryName		=	$prodctRow['cat_name'];
		$prodctName		=	$prodctRow['name'];
		$prodctCode		=	$prodctRow['prod_code'];
		$prodctDetls	=	$prodctRow['prod_descrptn'];
		$productId		=	$prodctRow['prod_id'];
		$materialname		=	$prodctRow['name'];
		$prodheight		=	$prodctRow['prod_height'];
		if($productId !="")
		{
			$_SESSION['PRDUCTID']	=	$productId;
		}
		else
		{
			$productId	=	$_SESSION['PRDUCTID'];
		}
		$proMainImgPath	=	'default.png';
		$proFrntImgPath	=	'default.png';
		$proBckImgPath	=	'default.png';
		$proSdeImgPath	=	'default.png';
		$proPriCEVal	=	0;
		$prodImgStmnt	=	prodImgQuery($productId);
		while ($prodImgRow = mysql_fetch_assoc($prodImgStmnt)) {
			if($prodImgRow['main_img_path'] == "")
			{
				$proMainImgPath	=	'default.png';
			}
			else
			{
				$proMainImgPath	=	$prodImgRow['main_img_path'];
			}
			if($prodImgRow['front_img_path'] == "")
			{
				$proFrntImgPath	=	'default.png';
			}
			else
			{
				$proFrntImgPath	=	$prodImgRow['front_img_path'];
			}
			if($prodImgRow['back_img_path'] == "")
			{
				$proBckImgPath	=	'default.png';
			}
			else
			{
				$proBckImgPath	=	$prodImgRow['back_img_path'];
			}
			if($prodImgRow['side_img_path'] == "")
			{
				$proSdeImgPath	=	'default.png';
			}
			else
			{
				$proSdeImgPath	=	$prodImgRow['side_img_path'];
			}
		}
		$prod_stoct_optn=	"<select style='width:100px;' class='serchTag' id='itemQuant' name='itemQuant'>";
		$prod_stock		=	$prodctRow['stock'];
		$prdctPrce		=	round($prodctRow['prod_price'],2);
		$prdctdisPer	=	$prodctRow['prod_discount'];
		$prdctDis		=	(($prdctPrce * $prdctdisPer)/100);
		if($prdctDis > 0)
		{
			$prdctDisPrice	=	round(($prdctPrce - $prdctDis),2);
			$prodctActualPrice	=	'<strike>Price Rs. '.$prdctPrce.'</strike><br />Offer Price Rs. '.$prdctDisPrice;
			
			$proPriCEVal	=	$prdctDisPrice;
		}
		else
		{
			$prodctActualPrice	=	'Price Rs.'.$prdctPrce;
			$proPriCEVal			=	$prdctPrce;
		}
		$prod_stoct_optn	.="<option value=''></option>";
		if($prodctRow['availibilty'] == '0' && $prod_stock != '0')
		{
			$prodctAvaible	= 'In Stock';
			for($i=1;$i<=$prod_stock;$i++){
				$prod_stoct_optn	.=	"<option value='$i'>$i</option>";
			}
		}
		else
		{
			$prodctAvaible	= 'Not In Stock';
			$prod_stoct_optn	.=	"<option value='0'>0</option>";
		}
		$prod_stoct_optn	.=	"</select>";
		$itemSizeId		=	$prodctRow['size_id'];
		if($itemSizeId == '' || $itemSizeId == '0')
		{
			$prodSizeDisp 	= 	'none';
		}
		else
		{
			$prodSizeDisp	=	'';
			$sizeDropDwn	=	"";
			$sizeDropDwn	.= "<select style='width:120px' class='serchTag' onchange='return getItemPrice()' id='itemSize' name='itemSize'>";	
			$sizeSql1		=	"SELECT size,id FROM sizes WHERE id=$itemSizeId";
			$sizesStmnt1	=	mysql_query($sizeSql1);
			while ($sizesRow1 = mysql_fetch_assoc($sizesStmnt1)) {
				$size1		=	$sizesRow1['size'];
				$sizeId1	=	$sizesRow1['id'];	
				$sizeDropDwn	.="<option value=''></option>
								   <option value='".$sizeId1."' >".$size1."</option>";
			}
			$sizesSql		=	"SELECT sizes.size,sizes.id 
								FROM prod_specification 
								INNER JOIN sizes ON prod_specification.size_id=sizes.id
								WHERE sizes.del_flag=0 AND prod_specification.prod_id=$productId AND sizes.id!=$itemSizeId";
			$sizesStmnt		=	mysql_query($sizesSql);
			while ($sizesRow = mysql_fetch_assoc($sizesStmnt)) {
				$sizeId		=	$sizesRow['id'];	
				$size		=	$sizesRow['size'];
				$sizeDropDwn	.="<option value='".$sizeId."'>".$size."</option>";
			}
			$sizeDropDwn	.= "</select>";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title><?php echo lang('PROJ_TITLE');?></title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="highslide/highslide.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script src="scripts/product.js" type="text/javascript"></script>
	<script src="scripts/x_core.js" type="text/javascript"></script>
	<script src="scripts/xslideto.js" type="text/javascript"></script>
	<script type="text/javascript">
		xAddEventListener(window, 'load',
		  function () {
			topMargin = xPageY('leftColumn');
			winOnResize(); // set initial position
			xAddEventListener(window, 'resize', winOnResize, false);
			xAddEventListener(window, 'scroll', winOnScroll, false);
			 }, false
		);
	</script>
	<!--<script src="scripts/shopping.js" type="text/javascript"></script>-->
	<script src="highslide/highslide.js" type="text/javascript"></script>
	<script type="text/javascript">
		hs.graphicsDir = 'highslide/graphics/';
		hs.outlineType = 'outer-glow';
	</script>
</head>
<body>
	<div id="wrapper">
		<div id="mainWrapper">
			<div id="headerDiv">
				<?php require_once("library/header.php");?>
			</div>
			<div id="mainContainerDiv">
				<div id="prodctSerchContainer">
					<ul id="prodctSerchUl">
						<li style="width:155px;float:left;color:#BA3C4A;margin:13px 0 0 0"><b><? echo lang('CATGRY');?></b></li>
						<li style="width:760px;float:left;background:#D9D9D9">
							<table style="padding:3px">
								<tr>
									<td style="width:50px"><? echo lang('SERCH');?> </td>
									<td style="width:20px"> : </td>
									<td style="width:230px"> 
										<select id="catSelect" class="serchTag" style="width:220px">
											<option value="">All</option>
										<?
											$catGSql	=	catGQuery();
											while ($catRow = mysql_fetch_assoc($catGSql)) {
										?>
												<option value="<? echo $catRow['cat_id']; ?>"><? echo $catRow['cat_name']; ?></option>
										<?
											}	
										?>
										</select>
									</td>
									<td style="width:270px">
										<input type="text" id="serchCatName" name="serchCatName" class="serchTag" style="width:270px;height:23px">
									</td>
									<td style="width:40px">
										<img src="images/search.png" alt="" style="margin:-1px 0 0 -6px" onclick="return serchCatProd()"/>
									</td>
									<td style="width:100px" id="viewCart">
										<?
											/*$ipAddress		=	$_SERVER["REMOTE_ADDR"];
											//$ipAddress		=	get_client_ip();
											//$date			=	('Y-m-d');
											$proCartCntSql	=	"SELECT COUNT(product_id) FROM temp_orders WHERE ip_address='".$ipAddress."' AND del_flag=0";
											$count 			=	$dbh->query($proCartCntSql)->fetchColumn();*/
											$count	=	0;
										?>
										<label id="viewCrtLab"><a href="viewMyCart.php"><? echo lang('VIEW_CRT')?> (<span id="cartCount"><? echo $count ?></span>)</a></label>
									</td>
								</tr>
							</table>
						</li>
					</ul>
				</div>
				<div id="productMainContner">
					<div id="leftContainer">
						<ul id="leftLinks" style="margin-top:260px">
							<?
								$catGSql	=	catGQuery();
								while ($catRow = mysql_fetch_assoc($catGSql)) {
									$catId		=	base64_encode($catRow['cat_id']);
									$haskKey	=	md5($catRow['cat_name']);
							?>
							<li><a id="left_link_Support" href="allProducts.php?catgry=<?echo $catId;?>&haskKey=<? echo $haskKey?>"><? echo $catRow['cat_name'];?></a></li>
							<li style="background:url('images/inside_dotted_line.jpg') repeat-x 0 0;margin:5px 0 5px 0px;height:3px;width:130px;"></li>
							<?	}?>
						</ul>										
					</div>
					<div id="prodctContainer">
						<ul>
							<li style="float:left;margin:0 0 25px 0;width:720px;color:blue">Categories-><?echo $CatgryName; ?>-><? echo $prodctName;?></li>
							<li style="float:left;margin:0 0 25px 0;width:720px">
								<table style="float:left;width:720px;margin:0">
									<tr>
										<td style="float:left;width:220px;text-align:left">
											<a href="images/products/<?echo $proMainImgPath;?>" class="highslide" onclick="return hs.expand(this)" rel="highslide">
												<img src="images/products/<?echo $proMainImgPath;?>" alt="" style="width:197px;height:204px" class="prodDetVewImg"/><br /><br />
											</a>
											<a href="images/products/<?echo $proFrntImgPath;?>" class="highslide" onclick="return hs.expand(this)" rel="highslide">
												<img src="images/products/<?echo $proFrntImgPath;?>" alt="" style="width:60px;height:60px" class="prodDetVewImg"/>
											</a>
											<a href="images/products/<?echo $proBckImgPath;?>" class="highslide" onclick="return hs.expand(this)" rel="highslide">
												<img src="images/products/<?echo $proBckImgPath;?>" alt="" style="width:60px;height:60px" class="prodDetVewImg"/>
											</a>
											<a href="images/products/<?echo $proSdeImgPath;?>" class="highslide" onclick="return hs.expand(this)" rel="highslide">
												<img src="images/products/<?echo $proSdeImgPath;?>" alt="" style="width:60px;height:60px" class="prodDetVewImg"/>
											</a>
										</td>
										<td style="float:left;width:490px;text-align:left">
											<table style="float:left;width:490px">
												<tr>
													<td style="float:left;width:330px;font-size:18px;color:#AAE5ED"><b><?echo $prodctName;?></b></td>
													<td style="float:left;width:140px;text-align:right">
														<b><span id="itemActPrice"><?echo $prodctActualPrice;?></span></b>
														<input type="hidden" name="itemPRice" id="itemPRice" value="<?echo $proPriCEVal;?>" />
													</td>
												</tr>
												<tr><td colspan="2" style="height:0.2px;width:480px;background:#D9D9D9"></td></tr>
												<tr height="20px"></tr>
												<tr>
													<td colspan="2" style="width:470px"> 
														<table style="float:left;width;470px">
															<tr>
																<td style="width:90px;float:left"><b>Item Code : </b></td>
																<td style="width:360px;float:left"><? echo $prodctCode;?></td>
															</tr>
															<tr height="10px"></tr>
															<tr>
																<td style="width:90px;float:left"><b>Details : </b></td>
																<td style="width:360px;float:left;text-align:justify"><? echo $prodctDetls;?>  </td>
															</tr>
															<tr height="10px"></tr>
															<tr>
																<td style="width:90px;float:left"><b>Height : </b></td>
																<td style="width:360px;float:left;text-align:justify"><? echo $prodheight;?></td>
															</tr>
															<tr height="10px"></tr>
															<tr>
																<td style="width:90px;float:left"><b>Material : </b></td>
																<td style="width:360px;float:left;text-align:justify"><? echo	$materialname;?></td>
															</tr>
															<tr height="10px"></tr>
															<tr>
																<td style="width:90px;float:left"><b>Availability : </b></td>
																<td style="width:360px;float:left"><span id="itmAvbty"><? echo $prodctAvaible;?></span></span></td>
															</tr>
															<tr height="10px"></tr>
															<tr>
																<td style="width:470px;float:left">
																	<table>
																		<tr>
																			<td style="width:200px;display:<? echo $prodSizeDisp;?>">	<span class="serchTag" >Size: </span>
																				<? echo $sizeDropDwn ?>
																			</td>
																			<td style="width:200px">
																				<span class="serchTag">Qty: </span><span id="qtyOptions"><? echo $prod_stoct_optn?></span>
																			</td>
																			<td style="width:130px">
																				<img src="images/loading.gif" alt="" id="loadingImg" style="display:none;"/>
																				<img src="images/addcart.png" alt="" id="addToCart" name="addToCart" style="cursor:pointer"/>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div id="footer">
				<?php require_once("library/footer.php");?>
			</div>
		</div>
	</div>
</body>
</html>
