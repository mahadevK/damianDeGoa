function orderQuantity(spaceId,orderID){
	//alert(spaceId);
	$('#basic-modal-content').modal();
		
	var data = 'spaceId=' + spaceId+'&orderID='+orderID ;
	$.ajax({
	url: 'Ajax/orderQuntPopUp.php',
	type: 'POST',
	data: data,
	cache: false,
	success: function(data){
		$('#basic-modal-content').modal();
		$('#simplemodal-container').css('top','160px');
		$('#simplemodal-container').css('left','500px');
		$('.simplemodal-wrap').html(data);
	}
	});	
}
function subOrderQunt(orderDetId)
{
	var quntity	=	$('select#ordrQunt').val();
	if(quntity == "")
	{
		alert('Please select quantity');
		$('select#ordrQunt').focus();
		return false;
	}
	var data = 'orderDetId=' + orderDetId+'&quntity='+quntity;
	$.ajax({
	url: 'Ajax/changeQunty.php',
	type: 'POST',
	data: data,
	cache: false,
	success: function(data){
		var sussMsg	=	'Quantity updated sucessfully';
		$('.simplemodal-wrap').html(sussMsg);
		setTimeout("window.location='orderDetails.php?orderId="+data+"'",500);
	}
	});
}
function valOderDetSubmtn()
{
	var totCnt	= $('input#totCnt').val();
	var cnt		=	0;
	for(var i=1;i<=totCnt;i++)
	{
		var detQunty		=	$('input#detOrdrQnt'+i).val();
		var StckQunty		=	$('input#avblStck'+i).val();
		var prodName		=	$('input#detProdName'+i).val();
		var approve 	= 	document.getElementById("aprRej"+i);
		if(approve.checked == false)
		{
		}
		else
		{
			cnt	=	1;
			if(parseInt(detQunty) > parseInt(StckQunty))
			{
				alert('Order Quantity out of stock for product '+ prodName);
				return false;
				
			}
		}
	}
	if(cnt == 0)
	{
		alert('No Product is approved');
		return false;
	}
	return true;
}
function valPrewSub()
{
	var logisTicEmail	=	$.trim($('input#logisTicEmail').val());
	var validemail 		= 	/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i;
	if(logisTicEmail == "")
	{
		alert('Please enter logistic email id');
		$('input#logisTicEmail').focus();
		return false;
	}
	else if(!validemail.test(logisTicEmail)){
		alert('Please enter valid email id');
		$('input#logisTicEmail').focus();
		return false;
	}
	var ordrDetIds	=	$('input#ordrDetIds').val();
	var orderId		=	$('input#ordrId').val();
	$('#ordrPrevSub').hide();
	$('#Cancel').hide();
	$('#loadingImg').show();
	var data = 'orderId=' + orderId+'&ordrDetIds='+ordrDetIds+'&logisTicEmail='+logisTicEmail;
	$.ajax({
	url: 'Ajax/sendLogisticMail.php',
	type: 'POST',
	data: data,
	cache: false,
	success: function(data){
		$('#loadingImg').hide();
		var sussMsg	=	'<tr><td><span style="color:red"><b>Order Send to logistic</b></span></td></tr>';
		$('.sucessMsg').html(sussMsg);
		setTimeout("window.location='Orders.php'",800);
	}
	});
}
/******************************** Tracking Code POP Up ************************************/
function orderTrackCode(orderID){
	//alert(spaceId);
	$('#basic-modal-content').modal();
		
	var data = 'orderID='+orderID ;
	$.ajax({
	url: 'Ajax/trackngCodePopUp.php',
	type: 'POST',
	data: data,
	cache: false,
	success: function(data){
		$('#basic-modal-content').modal();
		$('#simplemodal-container').css('top','160px');
		$('#simplemodal-container').css('left','500px');
		$('.simplemodal-wrap').html(data);
	}
	});	
}
function subTrackCode(orderId)
{
	var trackCode	=	$('input#trackCode').val();
	if(trackCode == "")
	{
		alert('Please enter tracking code');
		$('input#trackCode').focus();
		return false;
	}
	var data = 'orderId='+orderId+'&trackCode='+trackCode;
	$.ajax({
	url: 'Ajax/changeTrackngCode.php',
	type: 'POST',
	data: data,
	cache: false,
	success: function(data){
		var sussMsg	=	'Tracking Code updated sucessfully';
		$('.simplemodal-wrap').html(sussMsg);
		setTimeout("window.location='Orders.php'",500);
	}
	});
}