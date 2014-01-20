<?php
	require_once ("library/languageFile.php");
	require_once ("library/functions.php");
	require_once ("library/config.php");
	require_once ("library/sqlFunction.php");
	$catgryId	=	base64_decode($_REQUEST['catgry']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title><?php echo lang('PROJ_TITLE');?></title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="css/ajaxPagination.css" rel="stylesheet" type="text/css" media="screen" />
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
	<script type="text/javascript">
		window.onload = function(){
			loadCatgProd(1);
		}
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
					<input type="hidden" name="catgId" id="catgId" value="<? echo $catgryId ?>">
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
												if($catgryId == $catRow['cat_id']){ $catSletd = 'Selected';}else{ $catSletd = '';}
										?>
												<option value="<? echo $catRow['cat_id']; ?>" <? echo $catSletd ?>><? echo $catRow['cat_name']; ?></option>
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
											$proCartCntSql	=	"SELECT COUNT(product_id) FROM temp_orders WHERE ip_address='".$ipAddress."' AND del_flag=0";
											$count 			=	$dbh->query($proCartCntSql)->fetchColumn();*/
											$count	=	0;
										?>
										<label id="viewCrtLab"><a href="viewMyCart.php">View Cart(<? echo $count ?>)</a></label>
									</td>
								</tr>
							</table>
						</li>
					</ul>
				</div>
				<div id="productMainContner">
					<div id="leftContainer">
						<ul id="leftLinks" style="margin-top:260px;background:#D9D9D9;width:160px">	
							<li style="width:110px;margin:15px 0 15px 15px">
								<label class="serchTag" style="width:110px"> Price </label>
							</li>
							<li style="width:140px;margin:0 0 5px 5px">
								<input type="radio" name="pricecheck" onclick="loadCatgProd(1)" value="1" id="pricecheck1"> Rs. 500 & Below
							</li>
							<li style="width:140px;margin:0 0 5px 5px">
								<input type="radio" name="pricecheck" id="pricecheck2"  onclick="loadCatgProd(1)" value="2"> Rs. 501 - Rs. 1000
							</li>
							<li style="width:140px;margin:0 0 5px 5px">
								<input type="radio" name="pricecheck" id="pricecheck3" onclick="loadCatgProd(1)" value="3"> Rs. 1001 - Rs. 2000
							</li>
							<li style="width:140px;margin:0 0 5px 5px">
								<input type="radio" name="pricecheck" id="pricecheck4" onclick="loadCatgProd(1)" value="4"> Rs. 2001 - Rs. 3000
							</li>	
							<li style="width:140px;margin:0 0 5px 5px">
								<input type="radio" name="pricecheck" id="pricecheck5" onclick="loadCatgProd(1)" value="5"> Rs. 3001 - Rs. 4000
							</li>
							<li style="width:140px;margin:0 0 5px 5px">
								<input type="radio" name="pricecheck" id="pricecheck6" onclick="loadCatgProd(1)" value="6"> Rs. 4001 - Rs. 5000
							</li>
							<li style="width:110px;margin:15px 0 15px 15px">
								<label class="serchTag" style="width:110px">AVAILABILITY</label>
							</li>
							<li style="width:140px;margin:0 0 5px 5px">
								<input type="checkbox" name="" id=""> Exclude out of stock
							</li>
						</ul>								
					</div>
					<div id="prodctContainer">
						<img src="images/loader.gif" id="dataLoader" style="margin:100px 0 0 300px">
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
