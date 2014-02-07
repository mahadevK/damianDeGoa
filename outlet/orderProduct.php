<?php
	require_once ("library/languageFile.php");
	require_once ("../library/config.php");
	require_once ("library/functions.php");
	require_once ("library/SqlFunctions.php");
	sessionCheck();
	$customerId	=	base64_decode($_REQUEST['customer']);
	$userId		=	$_SESSION['userId'];
	$cartCount	=	getCartCount($customerId);;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta charset="utf-8" http-equiv="Content-Type" content="text/html" />
		<title><?echo lang('ADMIN_PANEL');?></title>
		<link type="image/x-icon" href="images/favicon.ico" rel="shortcut icon"/>
		<link href="../admin/css/main.min.css" rel="stylesheet" />
		<link href="../admin/css/main-busnes.css" rel="stylesheet" />
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
		<link rel="stylesheet" type="text/css" href="css/popUp.css"/>
		<link rel="stylesheet" type="text/css" href="css/pagination.css"/>
		<script type="text/javascript" src="../admin/scripts/jquery.min.js"></script>
		<script type="text/javascript" src="../admin/scripts/advetiser.min.js"></script>
		<script type="text/javascript" src="scripts/popUp.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				getProducts(1);
			});
		</script>
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
					<h3><?echo lang('ORDER_FLOW');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:98%;">
							<input type="hidden" name="customerId" id="customerId" value="<? echo $customerId; ?>" />
							<div class="prodOrderLDiv" id="orderPRODDv">
								<ul id="prodOrdrHedrUl">
									<li class="ordrPMenuVisted" id="extProd"><span style="margin:0 0 0 15px"><? echo lang('EXST_PROD_MENU');?></span></li>
									<li class="ordrPMenu" id="semiCProd"><span style="margin:0 0 0 15px"><? echo lang('SEMICUST_PROD_MENU');?></span></li>
									<li class="ordrPMenu" id="fullCProd"><span style="margin:0 0 0 15px"><? echo lang('FULLCUST_PROD_MENU');?></span></li>
									<li class="ordrPMenu2"></li>
									<li class="ordrPMenu3">
										<span  style='margin:0 0 0 6px;'>
											<input type="hidden" id="cartProdCnt" value="<? echo $cartCount?>" />
											<u><a href="javascript:void(0)" onclick="return showMyCart(<? echo $customerId?>)">View Cart (<span id="cartCount"><? echo $cartCount?></span>)</a>
										</span>
									</li>
								</ul>
								<ul id="checkOutFormUl">
									<li id="checkOutFormLi">
										<div id="productsReslt" style="margin:10px 0 0 0"><img src="images/loader.gif" style="margin:40px 0 0 423px;" alt=""/></div> 
									</li>
								</ul>
							</div>
						</li>
					</ul>
			  </div>
			</div>
		</div>
		<div class="footerDiv">
			<? include('library/footer.php'); ?>
		</div>
		<!-- POP UP DIV -->
		<div id="backgroundPopup"></div>
		<div id="toPopup">
			<div id="popup_content">
				<div id="presentnForm" class="popupForm">
					<img src="images/loader.gif" alt=""/>
				</div>
			</div>
		</div>
	</body>
</html>
