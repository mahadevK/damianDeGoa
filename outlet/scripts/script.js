/***************************** CUSTOMER SCRIPT ************************************************/
function getCustomers(page) {
	var data = "page="+page;
	$.ajax({
		url: "Ajax/getCustomers.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#customerResult').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#customerResult').html(data);
			}
		}
	});
}
$('#customerResult .customerListPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getCustomers(page);
});
function delCustomer(custId)
{

	var msg = confirm('Are you sure you want to delete this customer??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "custId="+custId;
		$.ajax({
			url: "Ajax/deleteCust.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert(data);
				getCustomers(1);
			}
		});
	}
}

/***************************** CUSTOMER SCRIPT ************************************************/
function getOrders(page) {
	var data = "page="+page;
	$.ajax({
		url: "Ajax/getOrders.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#orderResult').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#orderResult').html(data);
			}
		}
	});
}
$('#orderResult .orderListPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getOrders(page);
});
/*function delCustomer(custId)
{

	var msg = confirm('Are you sure you want to delete this customer??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "custId="+custId;
		$.ajax({
			url: "Ajax/deleteCust.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert(data);
				getCustomers(1);
			}
		});
	}
}*/
/*----------------------------- PRODUCT SCRIPT -------------------------------*/
function serchProd()
{
	var catSel		=	$('select#catSelect').val();
	var ProdName	=	$('input#serchCatName').val();
	getProducts(1);
}
function getProducts(page) {
	var catSel		=	$('select#catSelect').val();
	var ProdName	=	$('input#serchCatName').val();
	var data 	= 	"page="+page+"&catSel="+catSel+"&ProdName="+ProdName;
	$.ajax({
		url: "Ajax/listProducts.php",
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