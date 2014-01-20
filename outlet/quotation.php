<?php
	require_once ("library/languageFile.php");
	require_once ("../library/config.php");
	require_once ("library/functions.php");
	require_once ("library/SqlFunctions.php");
	sessionCheck();
	
	$customerId	=	base64_decode($_REQUEST['cust']);
	$custQery	=	customerQuery($customerId);
	while($custRes	=	mysql_fetch_assoc($custQery))
	{
		$custName	=	$custRes['name'];
		$custAdd	=	$custRes['address'];
		$custPhne	=	$custRes['contactno'];
	}
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
		<link href="../admin/css/jsDatePick_ltr.min.css" media="all" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../admin/scripts/jquery.min.js"></script>
		<script type="text/javascript" src="../admin/scripts/advetiser.min.js"></script>
		<script type="text/javascript" src="scripts/validate.js"></script>
		<script src="../admin/scripts/jsDatePick.min.1.3.js" type="text/javascript"></script>
		<script type="text/javascript">
			window.onload = function(){
				/*new JsDatePick({
					useMode:2,
					target:"QatnDelDte",
					dateFormat:"%Y-%m-%d"
				});*/
				new JsDatePick({
					useMode:2,
					target:"QatnDte",
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
					<h3><?echo lang('QUATN');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:80%;margin:0 0 0 9%">
							<div class="thumbnail">
								<div class="caption">
									<h5 align="center">
										<? echo lang('QUOTATN_FRM');?>
									</h5>
								</div>
								<form method="post" action="quotationPrint.php" target="_blank"/>
								<div class="widget-content" style="background:#fff;">
									<div class="quotatnFrmDiv">
										<table style="width:100%">
											<tr>
												<td style="width:68%">
													<table>
														<tr><td class="qtnFrmLis1"><img src="../images/LOGO.jpg" style="height:100px" alt=""/></td></tr><tr height="10px"></tr>
														<tr><td><? echo lang('QUOTATN_FRM_T');?></td></tr><tr height="10px"></tr>
														<tr><td><? echo lang('QUOTATN_FRM_A');?></td></tr>
													</table>
												</td>
												<td style="width:30%">
													<table>
														<tr><td>PHONE : 2417045, 24112126, 2413737</td></tr>
														<tr><td>FAX : 0832 - 24112127</td></tr>
														<tr><td>E-mail : ddg_goa@sancharnet.in</td></tr>
														<tr><td>damiandegoaa@dataone.in</td></tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
									<div class="quotatnFrmDiv midQtnFrmDiv">
										<table style="width:100%">
											<tr>
												<td style="width:68%">
													<table>
														<tr>
															<td class="qtnFrmLis1">Name 
																&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="QatnName" id="QatnName" class="QuatnInput" value="<? echo $custName ?>" readonly /></td>
														</tr><tr height="10px"></tr>
														<tr><td>Address &nbsp;<input type="text" name="QatnAdrs" id="QatnAdrs" class="QuatnInput" value="<? echo $custAdd ?>" readonly/></td></tr><tr height="10px"></tr>
														<tr><td>Phone &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="QatnPhne" id="QatnPhne" class="QuatnInput" value="<? echo $custPhne ?>" readonly/></td></tr>
													</table>
												</td>
												<td style="width:30%">
													<table>
														<tr><td>Quotation No. <input type="text" name="QatnNo" id="QatnNo" class="QuatnInput2" readonly/></td></tr>
														<tr><td>Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="QatnDte" id="QatnDte" class="QuatnInput2" readonly value="<?echo date('Y-m-d') ?>"/></td></tr><tr height="10px"></tr>
														<!--<tr><td>Dely. Date <input type="text" name="QatnDelDte" id="QatnDelDte" class="QuatnInput2" readonly/></td></tr>-->
													</table>
												</td>
											</tr>
										</table>
									</div>
									<div class="quotatnFrmDiv" style="height:20px">
										<span style="float:right">
											<a href="javascript:void(0)" onclick="return addQutatnRow();"><img src="images/add.png"></a>
											<a href="javascript:void(0)" onclick="delMondayrow();" style="display:none" id="delteMonRow"> <img src="images/remove.png"></a>
											<input type="hidden" name="quatnRowCnt" id="quatnRowCnt" value="1">
										</span>
									</div>
									<div class="quotatnFrmDiv decQtnFrmDiv">
										<table style="width:100%;" id="quatnTable" name="quatnTable">
											<tr>
												<td style="width:55%;border:1px solid #000;text-align:center">DESCRIPTION</td>
												<td style="width:8%;border:1px solid #000;text-align:center">QTY</td>
												<td style="width:8%;border:1px solid #000;text-align:center">UNIT</td>
												<td style="width:14%;border:1px solid #000;text-align:center">RATE</td>
												<td style="width:15%;border:1px solid #000;text-align:center">AMOUNT</td>
											</tr>
											<tr>
												<td style="width:55%;" class="leftTdBrder">
													<textarea name="quatnTxt0" id="quatnTxt0" class="Qtatntxtarea"></textarea>
												</td>
												<td style="width:8%;" class="leftTdBrder">
													<input type="text" name="quatnQty0" id="quatnQty0" class="QuatnInput3" onchange="calQuotnAmount(0)"/>
												</td>
												<td style="width:8%;" class="leftTdBrder">
													<input type="text" name="quatnUnit0" id="quatnUnit0" class="QuatnInput3"/>
												</td>
												<td style="width:14%;" class="leftTdBrder">
													<input type="text" name="quatnRate0" id="quatnRate0" class="QuatnInput4" onchange="return calQuotnAmount(0)"/>
												</td>
												<td style="width:15%;" class="leftTdBrder rightTdBrer">
													<input type="text" name="quatnAmnt0" id="quatnAmnt0" class="QuatnInput4" readonly />
												</td>
											</tr>
										</table>
										<table style="width:100%;" class="leftTdBrder rightTdBrer">
											<tr>
												<td style="width:55%;" class="rightTdBrer">
													<table style="width:97%;margin:0 0 0 3%;font-size:12px">
														<tr><td>ADVANCE REQUIRED </td></tr>
														<tr><td class="topPadding">1</td></tr>
														<tr><td class="topPadding">2</td></tr>
													</table>
												</td>
												<td style="width:45%;"  class="topBrder">
													<table style="width:100%">
														<tr>
															<td style="width:16.6%;" class="rightTdBrer"></td>
															<td style="width:78%;">
																<table style="width:100%">
																	<tr>
																		<td style="width:17.4%;" class="rightTdBrer btmBrder">
																			Total
																			<input type="hidden" name="amtTotal" id="amtTotal" value="0">
																		</td>
																		<td style="width:31.6%;" class="rightTdBrer btmBrder"></td>
																		<td style="width:33%;" class="btmBrder" id="amtTot"></td>
																	</tr>
																	<tr>
																		<td style="width:17.4%;" class="rightTdBrer btmBrder">
																			Excise
																			<input type="hidden" name="excseTax" id="excseTax" value="1" />
																		</td>
																		<td style="width:31.6%;" class="rightTdBrer btmBrder"></td>
																		<td style="width:33%;" class="btmBrder"></td>
																	</tr>
																	<tr>
																		<td style="width:17.4%;" class="rightTdBrer btmBrder">
																			Total
																			<input type="hidden" name="finTotal" id="finTotal" value="0">
																		</td>
																		<td style="width:31.6%;" class="rightTdBrer btmBrder"></td>
																		<td style="width:33%;" class="btmBrder" id="finalTot"></td>
																	</tr>
																	<tr>
																		<td style="width:17.4%;" class="rightTdBrer">
																			S.T
																			<input type="hidden" name="servceTax" id="servceTax" value="1">
																		</td>
																		<td style="width:31.6%;" class="rightTdBrer"></td>
																		<td style="width:33%;" class=""></td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										<table style="width:100%;" class="leftTdBrder rightTdBrer">
											<tr>
												<td style="width:55%;text-align:right;" class="rightTdBrer">
													G. TOTAL&nbsp;&nbsp;<input type="hidden" name="grntTotal" id="grntTotal" value="0">
												</td>
												<td style="width:45%;" class="topBrder">
													<table style="width:100%">
														<tr>
															<td style="width:16.6%;" class="rightTdBrer"></td>
															<td style="width:78%;">
																<table style="width:100%;height:30px">
																	<tr>
																		<td style="width:17.4%;" class="rightTdBrer "></td>
																		<td style="width:31.6%;" class="rightTdBrer "></td>
																		<td style="width:33%;" class="" id="grntTot"></td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
									<div class="quotatnFrmDiv">
										<table style="width:100%;">
											<tr>
												<td style="width:55%;border:1px solid #000;font-size:12px">
													<table style="width:97%;margin:0 0 0 3%">
														<tr><td><b><u>TERMS & CONDITIONS FOR BUSINESS</u></b></td></tr>
														<tr><td>50% Advance Against Order</td></tr>
														<tr><td>50% Balance Payments Before Delivery</td></tr>
														<tr><td>Taxes & Duties Will be charged as & when applicable</td></tr>
														<tr height="20px"></tr>
														<tr><td>Client' Signature</td></tr>
													</table>	
												</td>
												<td style="width:45%;border:1px solid #000;">
													<table style="width:97%;text-align:right">
														<tr><td>For<b> Damian de Goa</b></td></tr>
														<tr><td></td></tr><tr><td></td></tr>
														<tr><td></td></tr><tr><td></td></tr>
														<tr><td></td></tr><tr><td></td></tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="widget-footer" style="text-align:center">
									<!--<a href="quotationPrint.php" style="color:orange" target="_blank">
										Create
									</a>-->
									<input type="submit" value="create" name="printQuotn" onclick="return validateQtnFrm()"/>
									<input type="button" value="skip" name="skipQuotn" onclick="window.location='dashboard.php'"/>
								</div>
								</form>
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
