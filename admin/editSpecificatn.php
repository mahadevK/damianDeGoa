<?php
	require_once ("library/languageFile.php");
	require_once ("library/config.php");
	require_once ("library/functions.php");
	require_once("library/SqlFunctions.php");
	sessionCheck();
	$userId		=	$_SESSION['userId'];
	
	$specId	=	base64_decode($_REQUEST['spec']);
	
	$specQuery	=	specQueRy($specId);
	$avbSel2	=	'';
	$avbSel1	=	'';
	while ($row = mysql_fetch_assoc($specQuery)) {
		$prod_id			=	$row['prod_id'];
		$prod_price			=	$row['prod_price'];
		$prod_discount		=	$row['prod_discount'];
		$prod_availibilty	=	$row['availibilty'];
		$prod_stock			=	$row['stock'];
		$prod_height		=	$row['prod_height'];
		$prod_width			=	$row['prod_width'];
		$prod_breadth		=	$row['prod_breadth'];
		$prod_weight		=	$row['prod_weight'];
		$size_id			=	$row['size_id'];
		$material_id		=	$row['material_id'];
		$spec_code		=	$row['spec_code'];
		if($prod_availibilty == 0){ $avbSel1 = 'selected';}else{ $avbSel2 = 'selected';}
		$prodHght			=	explode(" ",$prod_height);
		$prodWdth			=	explode(" ",$prod_width);
		$prodWght			=	explode(" ",$prod_weight);
		$prodbrdth			=	explode(" ",$prod_breadth);
	}
	$tagsarr= array();
	$tagquery="select  spec_vs_tags.id as stid,spec_vs_tags.tag_id as tid,tags.tag_name as tname from tags
				inner join spec_vs_tags on 	spec_vs_tags.tag_id=tags.id where
			   spec_vs_tags.spec_id=$specId and spec_vs_tags.del_flag=0	and tags.del_flag=0	";
			   
	$tagStmnt	=	mysql_query($tagquery);
	while ($rows1 = mysql_fetch_assoc($tagStmnt)) {
	
			$tname			=	$rows1['tname'];
			$tagsarr[]		=	$rows1['tid'];
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
			#prodWdth,#prodHght,#prodBth{
				width:30px;
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
					<h3><?echo lang('SPECFCTN');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:70%;margin:0 0 0 15%">
							<div class="thumbnail">
								<div class="caption">
									<h5 align="right" style="margin-right:10px">
										<a href="Specification.php"><? echo lang('VEW_PROD_SPEC');?></a>
									</h5>
								</div>
								<div class="widget-content">
									<table width="700px" align="center">
										<tr height="25px"><td colspan="3"><span style="color:red;" id="sucessMsg"></span></td></tr>
										<tr>
											<td width="120px"><?echo lang('PRODCTS');?> <span>*</span></td>
											<td style="width:30px">:</td>
											<td style="width:420px">
												<select id="proD" name="proD">
													<option value="">Select</option>
												<?
													$prodSql	=	prodQuery($userId);
													while($proDRow = mysql_fetch_assoc($prodSql))
													{
														$proDId		=	$proDRow['prod_id'];
														$proDName	=	$proDRow['name'];
														if($prod_id == $proDId){ $prodSel	=	'selected';}else{$prodSel	=	'';}
												?>
														<option value="<? echo $proDId;?>" <? echo $prodSel?>><? echo $proDName;?></option>
												<?
													}
												?>
												</select>
											</td>
										</tr>
												<tr height="5px"></tr>
										<tr>
											<td><?echo lang('CODE_LABL');?> <span>*</span></td>
											<td>:</td>
											<td><input type="text" name="prodcode" id="prodcode" value="<? echo $spec_code; ?>"/></td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('PROD_PRCE');?> <span>*</span></td>
											<td>:</td>
											<td><input type="text" name="prodPrice" id="prodPrice" value="<? echo $prod_price;?>"/></td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td width="120px"><?echo lang('MATRAL_LABL');?> <span>*</span></td>
											<td style="width:30px">:</td>
											<td style="width:420px">
												<select id="matRial" name="matRial" onchange="return checkOthrMAtral()">
													<option value="">Select</option>
												<?
													$matrSql	=	matrialQuery();
													while($matRialRow = mysql_fetch_assoc($matrSql))
													{
														$matRialId		=	$matRialRow['id'];
														$matRialName	=	$matRialRow['name'];
														if($material_id == $matRialId){ $matSel	=	'selected';}else{$matSel	=	'';}
											?>
														<option value="<? echo $matRialId;?>" <? echo $matSel;?>><? echo $matRialName;?></option>
												<?
													}
												?>
													<option value="9999">Other</option>
												</select>
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr style="display:none" id="matRialOthrTR">
											<td></td><td>:</td>
											<td><input type="text" name="matRialOthr" id="matRialOthr"/></td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td width="120px"><?echo lang('SIZE_LABL');?></td>
											<td style="width:30px">:</td>
											<td style="width:420px">
												<select id="siZe" name="siZe" onchange="return checkOthrSize()">
													<option value="">Select</option>
												<?
													$siZeSql	=	sizeQuery();
													while($siZeRow = mysql_fetch_assoc($siZeSql))
													{
														$siZeId		=	$siZeRow['id'];
														$siZeName	=	$siZeRow['size'];
														if($size_id == $siZeId){ $sizeSel	=	'selected';}else{$sizeSel	=	'';}
												?>
														<option value="<? echo $siZeId;?>" <? echo $sizeSel;?>><? echo $siZeName;?></option>
												<?
													}
												?>
													<option value="9999">Other</option>
												</select>
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr style="display:none" id="siZeOthrTR">
											<td></td><td>:</td>
											<td><input type="text" name="siZeOthr" id="siZeOthr"/></td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('PROD_DECNT');?></td>
											<td>:</td>
											<td>
												<input type="text" name="prodDiscnt" id="prodDiscnt" value="0" onchange="return calDiscntVal()"/> %
												&nbsp;&nbsp;<span id="discntVal" style="color:#000"></span>
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('PROD_AVABLTY');?> <span>*</span></td>
											<td>:</td>
											<td>
												<select id="prodAvalbty" name="prodAvalbty">
													<option value="">Select</option>
													<option value="0" <? echo $avbSel1 ?>>Available</option>
													<option value="1" <? echo $avbSel2 ?>>Unavailable</option>
												</select>
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('PROD_STCK');?> <span>*</span></td>
											<td>:</td>
											<td>
												<select id="prodStck" name="prodStck">
													<option value="">Select</option>
												<?
													$stckSel	=	'';
													$maxStck	=	lang('PROD_STCK_MAX');
													for($i=0;$i<=$maxStck;$i++){
													if($prod_stock == $i){$stckSel	=	'Selected';}else{$stckSel=''; }
												?>
													<option value="<? echo $i ?>" <? echo $stckSel ?>><? echo $i ?></option>
												<?	}	?>
												</select>
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('PROD_DIMENS_LAB');?></td>
											<td>:</td>
											<td>
											<?
												$unitFor	=	1;
												$unitSel	=	unitQuery($unitFor);
											?>
												<input type="text" name="prodWdth" id="prodWdth" value="<? echo $prodWdth[0]; ?>" />
												<select id="diamnUnit" name="diamnUnit" style="width:85px">
													<option value="">Select</option>
											<?
												while($uRow1 = mysql_fetch_assoc($unitSel))
												{
													if($prodWdth[1] == $uRow1['unit']){ $selWdth='selected';}else{$selWdth='';}
											?>
													<option value="<? echo $uRow1['unit']; ?>" <? echo $selWdth ?>><? echo $uRow1['unit']; ?></option>
											<?
												}
											?>
												</select>
												<input type="text" name="prodBth" id="prodBth" value="<? echo $prodbrdth[0]; ?>" />
												<select id="diamnUnit4" name="diamnUnit4" style="width:85px">
													<option value="">Select</option>
											<?
												while($uRow2 = mysql_fetch_assoc($unitSel))
												{
													if($prodbrdth[1] == $uRow1['unit']){ $selBdth='selected';}else{$selBdth='';}
											?>
													<option value="<? echo $uRow1['unit']; ?>" <? echo $selBdth ?>><? echo $uRow1['unit']; ?></option>
											<?
												}
											?>
												</select>
												&nbsp;&nbsp;&nbsp;
												<input type="text" name="prodHght" id="prodHght" value="<? echo $prodHght[0]; ?>" />
												<select id="diamnUnit2" name="diamnUnit2" style="width:85px">
													<option value="">Select</option>
											<?
												while($uRow3 = mysql_fetch_assoc($unitSel))
												{
													if($prodHght[1] == $uRow3['unit']){ $selHght='selected';}else{$selHght='';}
											?>
													<option value="<? echo $uRow3['unit']; ?>" <? echo $selHght ?>><? echo $uRow3['unit']; ?></option>
											<?
												}
											?>
												</select>
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr>
											<td><?echo lang('PROD_WEGHT_LAB'); ?></td>
											<td>:</td>
											<td>
												<input type="text" name="prodWeight" id="prodWeight" style="width:126px" value="<? echo $prodWght[0]; ?>" />&nbsp;&nbsp;&nbsp;
												<select id="wightUnit" name="wightUnit" style="width:128px">
													<option value="">Select</option>
											<?
												
												$unitFor	=	2;
												$unitSel2	=	unitQuery($unitFor);
												while($uRow4 = mysql_fetch_assoc($unitSel2))
												{
													if($prodWght[1] == $uRow4['unit']){ $selWght='selected';}else{$selWght='';}
											?>
													<option value="<? echo $uRow4['unit']; ?>" <? echo $selWght ?>><? echo $uRow4['unit']; ?></option>
											<?
												}
											?>
												</select>
											</td>
										</tr>
										<tr height="25px;"></tr>
										<tr height="5px"></tr>
									
										<tr>
											<td><?echo lang('TAGS');?></td>
											<td>:</td>
											<td>
										<?
											$tagSql	=	tagQuery($userId);
											while($tagRow	=	mysql_fetch_assoc($tagSql))
											{
												if(in_array($tagRow['id'],$tagsarr))
												{
													$selTag='checked';
												}
												else
												{
													$selTag='';
												} 
										?>
												<span style="float:left;width:187px;margin:0 0 0 5px;padding:5px 0px;border-bottom:1px  #000000;">
												<input id="tagscheck"  type="checkbox" style="float:left;" <? echo $selTag ?>   name="tagscheck" value="<?echo $tagRow['id']; ?>">
												<p style="float:left;width:162px;margin:3px 0 0 5px;color: #000000;"><?echo $tagRow['tag_name']; ?></p>
												</span>
										<?
											}
										?>
									
											</td>
										</tr>
										<tr height="5px"></tr>
										<tr height="5px"></tr>
										<tr height="25px"></tr>
										<tr>
											<td align="center" colspan="3">
												<input type="hidden" name="specId" id="specId" value="<?echo $specId ?>" />
												<input type="submit" name="prodSpecSub" id="prodSpecSub" value="Submit" onclick="return valEditSpecatn()">
												<input name="Cancel" type="button" id="Cancel" value="Cancel" onclick="window.location.href='Specification.php';" />
												<img src="images/loading.gif" alt="" style="display:none" id="loadingImg"/>
											</td>
										</tr>
										<tr height="25px"></tr>
									</table>
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
