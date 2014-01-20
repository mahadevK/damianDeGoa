<?php
	require_once ("library/languageFile.php");
	require_once ("library/config.php");
	require_once ("library/functions.php");
	sessionCheck();
	$outletId	=	base64_decode($_REQUEST['outlet']);
	if(isset($outletId) || ($outletId != ""))
	{
		$getOutletSql	=	"SELECT name,state,city,country FROM outlets WHERE del_flag=0 AND id=$outletId";
		$getOutletRes	=	mysql_query($getOutletSql);
		while($getOutletRow	=	mysql_fetch_assoc($getOutletRes))
		{
			$outletName	=	$getOutletRow['name'];
			$country	=	$getOutletRow['country'];
			$state		=	$getOutletRow['state'];
			$city		=	$getOutletRow['city'];
		}
	}
	else
	{
		$outletName	=	"";
		$country	=	"";
		$state		=	"";
		$city		=	"";
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
		<script type="text/javascript" src="scripts/editcountries.js"></script>
		<script language="javascript">
			$(window).load(function(){
				print_country2("country");
			})
			
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
					<h3><?echo lang('CREATE_OUTLET');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:60%;margin:0 0 0 20%">
							<div class="thumbnail">
								<div class="widget-content">
									<input type="hidden" name="edtCntry" id="edtCntry" value="<? echo $country?>">
									<input type="hidden" name="edtState" id="edtState" value="<? echo $state?>">
									<table style="color:#000000;width:700px;border:0px solid black;>
										<tr height="30px"><td><span style="color:red;" id="sucessMsg"></span></td></tr>
										<tr>
											<td style="width:5%;padding:5px;">
												 Name<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;: 
												</td>
												<td style="width:5%;padding:5px;">
												<input type="text" name="outletName" id="outletName" style="width:291px" value="<? echo $outletName;?>">
											</td>
										</tr>
										<tr>
											<td style="width:5%;padding:5px;">
												 Country<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;: 
											</td>
											<td style="width:5%;padding:5px;">
												<select onchange="print_state('state',this.selectedIndex)" id="country" name ="country" style="width:306px"></select>
											</td>
										</tr>
										<tr>	
											<td style="width:5%;padding:5px;">
												State<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;: 
											</td>
											<td style="width:5%;padding:5px;">
												<select name ="state" id ="state" style="width:306px"></select>
											</td>
										</tr>
										<tr>	
											<td style="width:5%;padding:5px;">
												City<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;: 
											</td>
											<td style="width:5%;padding:5px;">
												<input type="text" name="city" id="city" style="width:291px" value="<? echo $city;?>"/>
											</td>
										</tr>
											
										<tr height="25px;"></tr>
										<tr>
											<td colspan="2" align="center">
												<input type="submit" name="submit" id="submit" value="Submit" onclick="return validateOutlet()">&nbsp;&nbsp;&nbsp; 
												<input name="Cancel" type="button" id="Cancel" value="Cancel" onclick="window.location.href='outlets.php';" />
												<img src="images/loading.gif" alt="" style="display:none" id="loadingImg"/>
												<input type="hidden" name="outletId" id="outletId" value="<?echo $outletId;?>" />
											</td>
										</tr>
									</table>
								</div>
								</form>
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
