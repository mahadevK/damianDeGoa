<?php
	if(isset($_POST['printQuotn']) || isset($_POST['printQuotn_x']))
	{
		require_once('../mpdf/mpdf.php');
		$mpdf 		= 	new mPDF('utf-8', 'A4');
		$counter	=	$_POST['quatnRowCnt'];
		/*-------------------------------- TOP HEADER ------------------------------------------------*/
		$mpdf->WriteHTML('<div class="quotatnFrmDiv">');
		$mpdf->WriteHTML('<table style="width:100%"><tr><td style="width:68%">');
		$mpdf->WriteHTML('<table><tr><td>');
		$mpdf->WriteHTML('<img src="../images/LOGO.jpg" style="height:100px" alt=""/>');
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('<tr><td style="padding:1.2% 0 0 0">');
		$mpdf->WriteHTML('Interior Design Consultants Incorporated');
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('<tr><td style="padding:1.2% 0 0 0">');
		$mpdf->WriteHTML('903/1,DAMIAN HOUSE, PORVORIM, BARDEZ-GOA 403501');
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('</td></tr></table></td>');
		$mpdf->WriteHTML('<td style="width:30%">');
		$mpdf->WriteHTML('<table><tr><td>');
		$mpdf->WriteHTML('PHONE : 2417045, 24112126, 2413737');
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('<tr><td>');
		$mpdf->WriteHTML('FAX : 0832 - 24112127');
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('<tr><td>');
		$mpdf->WriteHTML('E-mail : ddg_goa@sancharnet.in');
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('<tr><td>');
		$mpdf->WriteHTML('damiandegoaa@dataone.in');
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('</td></tr></table></td></tr></table>');
		$mpdf->WriteHTML('</td></tr></table>');
		$mpdf->WriteHTML('</div>');
		
		/*-------------------------------- CUSTOMER DETAILS ------------------------------------------------*/
		$quotnName		=	$_POST['QatnName'];
		$quotnAdrs		=	$_POST['QatnAdrs'];
		$quotnPhne		=	$_POST['QatnPhne'];
		$quotnDte		=	$_POST['QatnDte'];
		$quotnDelDte	=	$_POST['QatnDelDte'];
		
		$mpdf->WriteHTML('<div style="width:100%;margin:3% 0 0 0">');
		$mpdf->WriteHTML('<table style="width:100%"><tr><td style="width:68%">');
		$mpdf->WriteHTML('<table><tr><td>');
		$mpdf->WriteHTML('<b>Name</b> '.$quotnName);
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('<tr height="10px"></tr>');
		$mpdf->WriteHTML('<tr><td>');
		$mpdf->WriteHTML('<b>Address</b> '.$quotnAdrs);
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('<tr height="10px"></tr>');
		$mpdf->WriteHTML('<tr><td>');
		$mpdf->WriteHTML('<b>Phone</b> '.$quotnPhne);
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('</td></tr></table></td>');
		$mpdf->WriteHTML('<td style="width:30%">');
		$mpdf->WriteHTML('<table><tr><td>');
		$mpdf->WriteHTML('<b>Date</b> '.$quotnDte);
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('<tr><td>');
		$mpdf->WriteHTML('<b>Dely Date</b> '.$quotnDelDte);
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('</td></tr></table></td></tr></table>');
		$mpdf->WriteHTML('</td></tr></table>');	
		$mpdf->WriteHTML('</div>');
		
		/*-------------------------------- QUOTATION DETAILS ------------------------------------------------*/
		$mpdf->WriteHTML('<div style="width:100%;">');
		$mpdf->WriteHTML('<table style="width:100%;border:1px solid #000">');
		$mpdf->WriteHTML('<tr><td style="width:53.6%;border-bottom:1px solid #000;border-right:1px solid #000;text-align:center">');
		$mpdf->WriteHTML('DESCRIPTION');
		$mpdf->WriteHTML('</td>');
		$mpdf->WriteHTML('<td style="width:8%;border-bottom:1px solid #000;border-right:1px solid #000;text-align:center">');
		$mpdf->WriteHTML('QTY');
		$mpdf->WriteHTML('</td>');
		$mpdf->WriteHTML('<td style="width:8%;border-bottom:1px solid #000;border-right:1px solid #000;text-align:center">');
		$mpdf->WriteHTML('UNIT');
		$mpdf->WriteHTML('</td>');
		$mpdf->WriteHTML('<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;text-align:center">');
		$mpdf->WriteHTML('RATE');
		$mpdf->WriteHTML('</td>');
		$mpdf->WriteHTML('<td style="width:17%;border-bottom:1px solid #000;text-align:center">');
		$mpdf->WriteHTML('AMOUNT');
		$mpdf->WriteHTML('</td>');
		$mpdf->WriteHTML('</tr>');	
		for($i=0;$i<$counter;$i++)
		{
			/*------------------------- GET POST VALUE -------------------------------*/
			$quotnTxt	=	$_POST['quatnTxt'.$i];
			$quotnQty	=	$_POST['quatnQty'.$i];
			$quotnUnit	=	$_POST['quatnUnit'.$i];
			$quotnRate	=	$_POST['quatnRate'.$i];
			$quotnAmnt	=	$_POST['quatnAmnt'.$i];
			$mpdf->WriteHTML('<tr><td style="width:53.6%;text-align:center">');
			$mpdf->WriteHTML($quotnTxt);
			$mpdf->WriteHTML('</td>');
			$mpdf->WriteHTML('<td style="width:8%;border-left:1px solid #000;text-align:center">');
			$mpdf->WriteHTML($quotnQty);
			$mpdf->WriteHTML('</td>');
			$mpdf->WriteHTML('<td style="width:8%;border-left:1px solid #000;text-align:center">');
			$mpdf->WriteHTML($quotnUnit);
			$mpdf->WriteHTML('</td>');
			$mpdf->WriteHTML('<td style="width:15%;border-left:1px solid #000;text-align:center">');
			$mpdf->WriteHTML($quotnRate);
			$mpdf->WriteHTML('</td>');
			$mpdf->WriteHTML('<td style="width:17%;border-left:1px solid #000;text-align:center">');
			$mpdf->WriteHTML($quotnAmnt);
			$mpdf->WriteHTML('</td>');
			$mpdf->WriteHTML('</tr>');	
			$mpdf->WriteHTML('<tr height="10px" ></tr>');
		}
		$mpdf->WriteHTML('</table>');
		/*-------------------------------- QUOTATION DETAILS TWO ------------------------------------------------*/
		$totalAmount	=	$_POST['amtTotal'];
		$exciseTax		=	$_POST['excseTax'];
		$serviceTax		=	$_POST['servceTax'];
		$finalAmount	=	$_POST['finTotal'];
		$mpdf->WriteHTML('<table style="width:100%;border-left:1px solid #000;">');
		$mpdf->WriteHTML('<tr><td style="width:53.5%;">');
		$mpdf->WriteHTML('<table style="width:97%;margin:0 0 0 3%;font-size:12px">');
		$mpdf->WriteHTML('<tr><td>ADVANCE REQUIRED</td></tr>');	
		$mpdf->WriteHTML('<tr><td>1</td></tr>');
		$mpdf->WriteHTML('<tr><td>2</td></tr>');
		$mpdf->WriteHTML('</table></td>');
		$mpdf->WriteHTML('<td style="width:47.5%;">');
		$mpdf->WriteHTML('<table style="width:100%;border:1px solid #000;float:right">');
		$mpdf->WriteHTML('<tr><td style="width:50%;border-right:1px solid #000;border-bottom:1px solid #000">Total</td>');
		$mpdf->WriteHTML('<td style="width:50%;border-bottom:1px solid #000;text-align:right">');
		$mpdf->WriteHTML($totalAmount);
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('<tr><td style="width:50%;border-right:1px solid #000;border-bottom:1px solid #000">Excise</td>');
		$mpdf->WriteHTML('<td style="width:50%;border-bottom:1px solid #000;text-align:right">');
		$mpdf->WriteHTML($exciseTax);
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('<tr><td style="width:50%;border-right:1px solid #000;border-bottom:1px solid #000">Total</td>');
		$mpdf->WriteHTML('<td style="width:50%;border-bottom:1px solid #000;text-align:right">');
		$mpdf->WriteHTML($finalAmount);
		$mpdf->WriteHTML('</td></tr>');
		$mpdf->WriteHTML('<tr><td style="width:50%;border-right:1px solid #000">S.T</td>');
		$mpdf->WriteHTML('<td style="width:50%;text-align:right">');
		$mpdf->WriteHTML($serviceTax);
		$mpdf->WriteHTML('</td></tr></table></td>');
		$mpdf->WriteHTML('</tr></table>');
		
		/*-------------------------------- QUOTATION DETAILS THREE------------------------------------------------*/
		$grantAmount	=	$_POST['grntTotal'];
		$mpdf->WriteHTML('<table style="width:100%;border-left:1px solid #000;border-right:1px solid #000">');
		$mpdf->WriteHTML('<tr><td style="width:53.5%;text-align:right;border-right:1px solid #000">G. TOTAL  </td>');
		$mpdf->WriteHTML('<td style="width:45%;">');
		$mpdf->WriteHTML('<table style="width:100%;">');
		$mpdf->WriteHTML('<tr><td style="width:30.6%;border-right:1px solid #000;" colspan="2"></td>');
		$mpdf->WriteHTML('<td style="width:20%;border-right:1px solid #000;"></td>');
		$mpdf->WriteHTML('<td style="width:20%;">');
		$mpdf->WriteHTML($grantAmount);
		$mpdf->WriteHTML('</td></tr></table></td></tr></table>');
		$mpdf->WriteHTML('</div>');
		
		/*-------------------------------- QUOTATION FOOTER------------------------------------------------*/
		$mpdf->WriteHTML('<div class="quotatnFrmDiv">');
		$mpdf->WriteHTML('<table style="width:100%;border:1px solid #000;">');
		$mpdf->WriteHTML('<tr>');
		$mpdf->WriteHTML('<td style="width:53.5%;font-size:12px">');
		$mpdf->WriteHTML('<table style="width:97%;margin:0 0 0 3%;font-size:14px">');
		$mpdf->WriteHTML('<tr><td><b><u>TERMS & CONDITIONS FOR BUSINESS</u></b></td></tr>');
		$mpdf->WriteHTML('<tr><td>50% Advance Against Order</td></tr>');
		$mpdf->WriteHTML('<tr><td>50% Balance Payments Before Delivery</td></tr>');
		$mpdf->WriteHTML('<tr><td>Delivery Charges Extra</td></tr>');
		$mpdf->WriteHTML('<tr><td>Taxes & Duties Will be charged as & when applicable</td></tr>');
		$mpdf->WriteHTML('<tr><td style="padding:8% 0 0 0">Client Signature</td></tr>');
		$mpdf->WriteHTML('</table></td>');
		$mpdf->WriteHTML('<td style="width:47%;border-left:1px solid #000;">');
		$mpdf->WriteHTML('<table style="width:97%;text-align:right">');
		$mpdf->WriteHTML('<tr><td>For<b> Damian de Goa</b></td></tr>');
		$mpdf->WriteHTML('<tr><td></td></tr><tr><td></td></tr>');
		$mpdf->WriteHTML('<tr><td></td></tr><tr><td></td></tr>');
		$mpdf->WriteHTML('<tr><td></td></tr><tr><td></td></tr></table></td></tr></table>');
		$mpdf->WriteHTML('</div>');
		$mpdf->Output();
	}
	else
	{
		header('Location:quotation.php');
	}
?>