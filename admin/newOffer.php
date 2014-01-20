<?php
	require_once ("library/languageFile.php");
	require_once ("library/config.php");
	require_once ("library/functions.php");
	require_once("library/SqlFunctions.php");
	sessionCheck();
	$userId		=	$_SESSION['userId'];
	$msg		=	'';
	$offerName	=	'';
	$startDte	=	'';
	$endDte		=	'';
	if(isset($_POST['offersSub']) || isset($_POST['offersSub_x']))
	{
		$userId		=	$_SESSION['userId'];
		$offerName 	= 	$_POST['offerName'];
		$startDte 	= 	$_POST['startDte'];
		$endDte 	= 	$_POST['endDte'];
		$oferCatg 	= 	$_POST['oferCatg'];
		$Status		=	1;
		$date		=	date('Y-m-d');
		$banerImg	=	$_FILES['bannerImg']['name'];
		if ($_FILES['bannerImg']['type']=="image/jpg" || $_FILES['bannerImg']['type']=="image/jpeg" || $_FILES['bannerImg']['type']=="image/pjpeg" || $_FILES['bannerImg']['type']=="image/gif" || $_FILES['bannerImg']['type']=="image/png" || $_FILES['bannerImg']['type']=="image/tif" || $_FILES['bannerImg']['type']=="image/tiff" ) 
		{
			list($width, $height, $type, $attr) = getimagesize($_FILES['bannerImg']['tmp_name']);
			/*if((($width < 900) || ($height < 250)) || (($width > 950) || ($height > 300))) {
				$msg = "Please check the Image size. width: 950px, Max height:250px";	
			} else {*/
				$offer_img 	= 	time()."_".strtolower($_FILES['bannerImg']['name']);
				@move_uploaded_file($_FILES['bannerImg']['tmp_name'],"../images/offers/".$offer_img);
			//}
		}
		if($msg == "")
		{
			$sql	=	"INSERT INTO offers (offer_name,start_date,end_date,banner_img_path,catids,status,added_by,added_date,
											updated_date,del_flag)
						VALUES('".$offerName."','".$startDte."','".$endDte."','".$offer_img."','".$oferCatg."','".$Status."',
								'".$userId."','".$date."','".$date."',0)";
			$stmnt	=	mysql_query($sql);
			$msg = "Offer Added Sucessfully";
			echo  "<META HTTP-EQUIV=\"Refresh\" Content=\"1;URL=Offers.php\">";
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
		<link href="css/jsDatePick_ltr.min.css" media="all" type="text/css" rel="stylesheet">
		<style type="text/css">
			select{
				width:280px;
			}
			textarea,input[type='text']{
				width:266px;
			}
			textarea{
				resize:none;
			}
			span{
				color:red;
			}
			#prodWdth,#prodHght{
				width:30px;
			}
		</style>
		<script type="text/javascript" src="scripts/jquery.min.js"></script>
		<script type="text/javascript" src="scripts/advetiser.min.js"></script>
		<script type="text/javascript" src="scripts/validate.js"></script>
		<script src="scripts/jsDatePick.min.1.3.js" type="text/javascript"></script>
		<script type="text/javascript">
			window.onload = function(){
				new JsDatePick({
					useMode:2,
					target:"startDte",
					dateFormat:"%Y-%m-%d"
				});
				new JsDatePick({
					useMode:2,
					target:"endDte",
					dateFormat:"%Y-%m-%d"
				});
			};
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
					<h3><?echo lang('OFFERS');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:60%;margin:0 0 0 20%">
							<div class="thumbnail">
								<div class="caption">
									<h5 align="right" style="margin-right:10px">
										<a href="Offers.php"><? echo lang('VEW_OFFER');?></a>
									</h5>
								</div>
								<div class="widget-content">
									<form method="POST" action="newOffer.php" name="addProdFrm" id="addProdFrm" enctype="multipart/form-data" autocomplete="off">
									<table width="600px" align="center">
										<tr height="25px"><td colspan="3"><span style="color:red;" id="sucessMsg"><? echo $msg;?></span></td></tr>
										<tr>
											<td><?echo lang('OFFER_NAME');?> <span>*</span></td>
											<td>:</td>
											<td><input type="text" name="offerName" id="offerName" value="<?echo $offerName ?>"/></td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('STRT_DTE');?> <span>*</span></td>
											<td>:</td>
											<td>
												<input type="text" name="startDte" id="startDte" value="<?echo $startDte ?>" readonly />
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('END_DTE');?> <span>*</span></td>
											<td>:</td>
											<td>
												<input type="text" name="endDte" id="endDte" value="<?echo $endDte ?>" readonly />
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('OFER_BANER_IMG');?> <span>*</span></td>
											<td>:</td>
											<td>
												<input type="file" name="bannerImg" id="bannerImg"/> (950px * 250px)
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('CATGRES');?> <span>*</span></td>
											<td>:</td>
											<td>
												<select id="oferCatg" name="oferCatg" multiple >
											<?
												$catgRes	=	categQuery($userId);
												while($row = mysql_fetch_assoc($catgRes))
												{
											?>
													<option value="<? echo $row['cat_id']; ?>"><? echo $row['cat_name']; ?></option>
											<?
												}
											?>
												</select>
											</td>
										</tr>
										<tr height="25px;"></tr>
										<tr>
											<td align="center" colspan="3">
												<input type="submit" name="offersSub" id="offersSub" value="Submit" onclick="return valOffers()">
												<input name="Cancel" type="button" id="Cancel" value="Cancel" onclick="window.location.href='Offers.php';" />
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
