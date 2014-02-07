<?php
	require_once('../../library/config.php');
	require_once('../library/SqlFunctions.php');
	session_start();
	$userId		=	$_SESSION['userId'];
	$customerId	=	$_POST['customerId'];
	$msg		=	'<div id="myCartHeaderLeft"></div>
							<div id="myCartHeaderMid">
								<table id="myCartResultTab">
									<tr>
										<td style="width:500px;text-align:center" colspan="2"><b>ITEM</b></td>
										<td style="width:180px;text-align:center"><b>PRICE</b></td>
										<td style="width:180px;text-align:center"><b>QUANTITY</b></td>
										<td style="width:180px;text-align:center"><b>SUBTOTAL</b></td>
										<td style="width:50px;text-align:center"></td>
									</tr>
								</table>
							</div>
							<div id="myCartHeaderRght"></div>';
	$msg .= "<div id='myCartResult2'><table id='myCartResultTab'>";
	$mycartData		=	myCartData($customerId);
	$totalPrice		=	0;
	$sr				=	0;
	$shipngChrge	=	0;
	while($mycartRow	=	mysql_fetch_array($mycartData))
	{
		$prodImg	=	$mycartRow['main_img_path'];
		if($prodImg	== ''){
			$prodImg	=	'default.png';
		}
		$prodName	=	$mycartRow['name'];
		$prodStock	=	$mycartRow['stock'];
		$price		=	$mycartRow['item_price'];
		$Qunty		=	$mycartRow['item_qty'];
		$ProdId		=	$mycartRow['prod_id'];
		$recId		=	$mycartRow['id'];
		//$bgColor	=	'#A6E5EE';
		$bgColor	=	'#A6E5EE';
		$sr	=	$sr+1;
		if($sr%2 == 0){	$bgColor	=	'#D0EEF0';}
		$selected	=	'';
		$prod_qty	=	"<select style='width:60px;' class='serchTag' id='itemQuant$sr' name='itemQuant$sr'>";
		for($j=1;$j<=$prodStock;$j++)
		{	
			if($Qunty == $j){ $selected	=	'selected';}else{ $selected = '';}
			$prod_qty	.=	"<option value='$j' $selected>$j</option>";
		}
		$prod_qty	.=	"</select>";
		$subTotal	=	($price*$Qunty);
		$totalPrice	=	($totalPrice+$subTotal);
		
		$msg .= "<tr style='background:$bgColor'>";
		$msg .= "<td style='width:155px;text-align:left'><img src='../images/products/$prodImg' alt='' style='width:150px;height:150px'/></td>";
		$msg .= "<td style='width:345px;text-align:left'><b>Name : </b>".$prodName."</td>";
		$msg .= "<td style='width:180px;text-align:center'>Rs. ".$price."</td>";
		$msg .= "<td style='width:180px;text-align:center'>".$prod_qty."</td>";
		$msg .= "<td style='width:180px;text-align:center'>Rs. <span id='subTot$sr'>".$subTotal."</span></td>";
		$msg .= "<td style='width:50px;text-align:center'><img src='images/cancel.png' alt='' id='canCart' onclick='return canCartProdct($recId,$customerId)'/></td></tr>";
		$msg	.=	"<tr height='5px'></tr>";
	}
		$msg	.=	"<tr>";
		$msg	.=	"<td colspan='6' style='background:#A6E5EE'><table>";
		$msg	.=	"<tr><td style='width:650px;text-align:right'> </td>";
		$msg	.=	"<td style='width:150px;text-align:center'></td></tr>";
		$msg	.=	"</tr>";
		$msg	.=	"<tr><td style='width:875px;text-align:right'>Total : </td>";
		$msg	.=	"<td style='width:190px;text-align:center'>Rs. <span id='finalTot'>".($totalPrice+$shipngChrge)."</span></td></tr>";
		$msg	.=	"</tr></table>";
		$msg	.=	"<table style='margin:20px 0 10px 10px'><tr><td style='width:810px'><a href='javascript:void(0)' onclick='return contShopng($customerId)'><img src='images/contshop.png' alt=''/></a></td>";
		$msg	.=	"<td id='egift'>";
		$msg	.=	"<table style='float:left;margin:0 0 0 115px'><tr><td></td></tr></table>";
		$msg	.=	"<td style='width:160px'><input type='image' name='checkOut' id='checkOut' src='images/procdCheck.png'><input type='hidden' name='srNo' id='srNo' value='$sr'/></td>";
		$msg	.=	"</td></tr></table>";
	echo $msg;
?>