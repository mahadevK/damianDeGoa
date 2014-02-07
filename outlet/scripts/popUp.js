$(function($) {
	$('#toPopup').hide();
	$("#ExtngCustFlow").click(function() {	
		var page	=	1;
		loadExstCustF(page);
		return false;
	});
	$("#newCustFlow").click(function() {	
		loadNewCustF();
		return false;
	});
	$("#extProd").click(function() {
		$("#extProd").removeClass('ordrPMenu');
		$("#extProd").addClass('ordrPMenuVisted');
		$("#semiCProd").addClass('ordrPMenu');
		$("#fullCProd").addClass('ordrPMenu');
		getProducts(1);
	});
	$("#semiCProd").click(function() {
		$("#semiCProd").removeClass('ordrPMenu');
		$("#semiCProd").addClass('ordrPMenuVisted');
		$("#extProd").addClass('ordrPMenu');
		$("#fullCProd").addClass('ordrPMenu');
		//getProducts(1);
		$('#productsReslt').html('<label style="color:#cd0000;">Here the Existing products will be displayed which can be customised and added to the cart</td></tr>');
	});
	$("#fullCProd").click(function() {
		$("#fullCProd").removeClass('ordrPMenu');
		$("#fullCProd").addClass('ordrPMenuVisted');
		$("#extProd").addClass('ordrPMenu');
		$("#semiCProd").addClass('ordrPMenu');
		$('#productsReslt').html('<label style="color:#cd0000;">Here the Full Customised products will be displayed which can be added to the cart</td></tr>');
	});
});
function loadExstCustF(page) {	
	popUpOpen();
	var data = "page="+page;
	$.ajax({
		url: "Ajax/extCustomer.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
				popUpClose();
				$('#customerResult').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
				popUpClose();
                $('#customerResult').html(data);
			}
		}
	});
}
$('#customerResult .customerListPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   loadExstCustPopup(page);
});
function loadNewCustF()
{
	popUpOpen();
	$.ajax({
		url: "Ajax/newCustomerF.php",
		type: "POST",
		cache: false,
		success: function (data) {
			if (!data) {
				popUpClose();
				$('#customerResult').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
				popUpClose();
                $('#customerResult').html(data);
			}
		}
	});
}
function popUpOpen()
{
	$("#toPopup").fadeIn(0500); 
	$("#backgroundPopup").css("opacity", "0.7"); 
	$("#backgroundPopup").fadeIn(0500);
}
function popUpClose()
{
	$('#toPopup').hide();
	$("#toPopup").fadeOut("normal");
	$("#backgroundPopup").fadeOut("normal");
}
function validateCustomer()
{
	var email 		= 	/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i;
	var charstrng	=	/^[A-Za-z\s]+$/;
	var numstrng	=	/^[0-9]+$/; 
	var name 		= 	$.trim($('input#name').val());
	var emailId		= 	$.trim($('input#emailId').val());
	var contactNo	= 	$.trim($('input#contactNo').val());
	var address	 	= 	$.trim($('textarea#address').val());
	var country	 	= 	$.trim($('select#country').val());
	var state	 	= 	$.trim($('select#state').val());
	var city	 	= 	$.trim($('input#city').val());
	var pinCode	 	= 	$.trim($('input#pinCode').val());
	var customerId	= 	$.trim($('input#customerId').val());
	if(name == "")
	{
		alert('Please enter name');
		$('input#name').focus();
		return false;
	}
	if(!charstrng.test(name) ) 
	{ 
		alert("Please enter characters only");
		$('input#name').focus();
		return false;
	}
	/*if(emailId == "")
	{
		alert('Please enter email id');
		$('input#emailId').focus();
		return false;
	}
	else if(!email.test(emailId))
	{
		alert('Please enter valid email id');
		$('input#emailId').focus();
		return false;
	}*/
	if(emailId != "")
	{
		if(!email.test(emailId))
		{
			alert('Please enter valid email id');
			$('input#emailId').focus();
			return false;
		}
	}
	if(contactNo == "")
	{
		alert('Please enter contact no');
		$('input#contactNo').focus();
		return false;
	}
	if(!numstrng.test(contactNo) ) 
	{ 
		alert("Please enter numbers only");
		$('input#contactNo').focus();
		return false;
	}
	if(address == "")
	{
		alert('Please enter address');
		$('textarea#address').focus();
		return false;
	}
	/*if(country == "")
	{
		alert('Please enter country');
		$('select#country').focus();
		return false;
	}*/
	if(state == "")
	{
		alert('Please enter state');
		$('select#state').focus();
		return false;
	}
	if(city == "")
	{
		alert('Please enter city');
		$('input#city').focus();
		return false;
	}
	if(!charstrng.test(city) ) 
	{ 
		alert("Please enter characters only");
		$('input#city').focus();
		return false;
	}
	/*if(pinCode == "")
	{
		alert('Please enter pin code');
		$('input#pinCode').focus();
		return false;
	}
	if(!numstrng.test(pinCode) ) 
	{ 
		alert("Please enter numbers only");
		$('input#pinCode').focus();
		return false;
	}*/
	if(pinCode != "")
	{	
		if(!numstrng.test(pinCode) ) 
		{ 
			alert("Please enter numbers only");
			$('input#pinCode').focus();
			return false;
		}
	}
	$('input#submit').hide();
	$('#loadingImg').show();
	var dataStrng	=	'Name='+name+'&emailId='+emailId+
							'&contactNo='+contactNo+'&address='+address+'&country='+country+'&state='+state+'&city='+city+'&pincode='+pinCode+'&customerId='+customerId;
	
	$.ajax({
		type: "POST",
		url: "Ajax/newCustomer.php",
		cache: false,
		data:dataStrng,
		success: function(data) {
			if(data != "")
			{
				window.location='orderProduct.php?customer='+btoa(data);
			}
		}
	});
}
/*------------------------- PROD SCRIPT --------------------------------------------*/
/*function serchProd()
{
	var catSel		=	$('select#catSelect').val();
	var ProdName	=	$('input#serchCatName').val();
	getProducts(1);
}*/
function getProducts(page) {
	/*var catSel		=	$('select#catSelect').val();
	var ProdName	=	$('input#serchCatName').val();
	var data 	= 	"page="+page+"&catSel="+catSel+"&ProdName="+ProdName;*/
	var data 	= 	"page="+page;
	$.ajax({
		url: "Ajax/ordrProdList.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#productsReslt').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#productsReslt').html(data);
			}
		}
	});
}
	
$('#productsReslt .prodVewPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getProducts(page);
});
/*-------------------------- ORDER FLOW ------------------------------------------*/
function nextOrdrFlow()
{
	var custId	=	$("input:radio[name=extCustSel]:checked").val();
	if($('input[name=extCustSel]:checked').length<=0)
	{
		alert("Please select customer to proceed");
		return false;
	}
	else
	{
		window.location='orderProduct.php?customer='+btoa(custId);
	}
}

/*---------------------------- ADD PRODUCT TO CART -------------------------------*/
function getCartCunt(customerId)
{
	var data 	= 	"customerId="+customerId;
	$.ajax({
		url: "Ajax/getCartCount.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			$('#cartProdCnt').html(data);
			$('#cartCount').html(data)
		}
	});	
}
function addProdToCart(prodId,prodPrice)
{
	
	var customerId	=	$('input#customerId').val();
	var status		=	1;
	var prodQty		=	$('select#qnty'+prodId).val();
	if(prodQty == "")
	{
		alert('Please select quantity to purchase');
		return false;
	}
	popUpOpen();
	var data 	= 	"customerId="+customerId+"&prodId="+prodId+"&status="+status+"&prodQty="+prodQty+"&prodPrice="+prodPrice;
	$.ajax({
		url: "Ajax/addProdToCart.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (data == 1) {
                alert('This Product is already added to the cart');
				popUpClose();
				return false;
			} else {
                alert('Product added to your cart');
				popUpClose();
				getCartCunt(customerId)
				return false;
			}
		}
	});
}
function showMyCart(customerId)
{
	var cartCnt	=	$('#cartProdCnt').val();
	if(cartCnt == 0)
	{
		alert('No Products available to the cart');
		return false;
	}
	popUpOpen();
	var data 	= 	"customerId="+customerId;
	$.ajax({
		url: "Ajax/showMyCart.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			popUpClose();
			$('#orderPRODDv').html(data);
			return false;
		}
	});
}
function contShopng(customerId)
{
	window.location='orderProduct.php?customer='+btoa(customerId);
}
function canCartProdct(recrdId,customerId)
{
	var data 	= 	"recrdId="+recrdId+'&customerId='+customerId;
	$.ajax({
		url: "Ajax/delProdCart.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			alert("Product deleted from the cart");
			var splitDt	=	data.split("|");
			if(splitDt[0] > 0)
			{
				showMyCart(splitDt[1]);
				return false;
			}
			else
			{
				window.location='orderProduct.php?customer='+btoa(splitDt[1]);
			}
		}
	});
}