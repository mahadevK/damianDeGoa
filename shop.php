<?php
	require_once ("library/languageFile.php");
	require_once ("library/functions.php");
	require_once ("library/config.php");
	require_once ("library/sqlFunction.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title><?php echo lang('PROJ_TITLE');?></title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link href="css/style.css" type="text/css" rel="stylesheet">
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
			loadProdData();
		}
	</script>
</head>
<body id="shopBody">
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
										<select id="catSelect" class="serchTag" style="width:220px;height:32px">
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
										<img src="images/search.png" alt="" style="margin:-1px 0 0 -6px" onclick="return serchProd()"/>
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
										<label id="viewCrtLab" style="margin:0 0 1px 0"><a href="viewMyCart.php"><? echo lang('VIEW_CRT')?> (<? echo $count ?>)</a></label>
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
