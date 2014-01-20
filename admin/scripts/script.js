/*********************************************** GET ADMIN LIST************************************************************/
function getAdmin(page) {
	var data = "page="+page;
	$.ajax({
		url: "Ajax/listAdmins.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#adminReslt').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#adminReslt').html(data);
			}
		}
	});
}
	
$('#adminReslt .listVewPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getAdmin(page);
}); 
function delAdmin(adminId)
{

	var msg = confirm('Are you sure you want to delete??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "aid="+adminId;
		$.ajax({
			url: "Ajax/deleteAdmin.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert('Size deleted sucessfully');
				getAdmin(1);
			}
		});
	}
}
/*********************************************** END ************************************************************/



/*********************************************** GET OUTLET LIST************************************************************/
function getOutlets(page) {
	var data = "page="+page;
	$.ajax({
		url: "Ajax/getOutlets.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#outletReslt').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#outletReslt').html(data);
			}
		}
	});
}
	
$('#outletReslt .outletListPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getOutlets(page);
}); 
function delOutlet(outletId)
{

	var msg = confirm('Are you sure you want to delete??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "outId="+outletId;
		$.ajax({
			url: "Ajax/deleteOutlet.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert(data);
				getOutlets(1);
			}
		});
	}
}
/*********************************************** END ************************************************************/



/************************************MYCAHNGE ******************************************************/
/***************************** ROLES SCRIPT ************************************************/
function getRoles(page) {
	var data = "page="+page;
	$.ajax({
		url: "Ajax/getRoles.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#rolesResult').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#rolesResult').html(data);
			}
		}
	});
}
$('#rolesResult .rolesListPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getRoles(page);
});
function validateRole() {
	var charstrng 	= 	/^[A-Za-z\s]+$/;
	var role 		= 	$.trim($('input#role').val());
	var roleId		=	$.trim($('input#roleId').val());
	if(role == "")
	{
		alert('Please enter role');
		$('input#role').focus();
		return false;
	}
	if(!charstrng.test(role) ) 
	{	
		alert("Please enter characters only");
		$('input#role').focus();
		return false;
	}
	var data = 'role='+role+'&roleId='+roleId;
	$.ajax({
		url: "Ajax/newRole.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			alert(data);
			window.location='roles.php'
			return true;
		}
	});
}
function delRole(roleId)
{
	var msg = confirm('Are you sure you want to delete this role ??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "roleId="+roleId;
		$.ajax({
			url: "Ajax/delRole.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert(data);
				getRoles(1);
			}
		});
	}
}
/***************************** USERS SCRIPT ************************************************/
function getUsers(page) {
	var data = "page="+page;
	$.ajax({
		url: "Ajax/getUsers.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#usersResult').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#usersResult').html(data);
			}
		}
	});
}
$('#usersResult .usersListPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getUsers(page);
});
function delUser(userId)
{

	var msg = confirm('Are you sure you want to delete this user??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "userId="+userId;
		$.ajax({
			url: "Ajax/deleteUser.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert(data);
				getUsers(1);
			}
		});
	}
}
/*-------------------------------------- CATEGORY SCRIPT ----------------------------------*/
function getCategory(page) {
	var data = "&page="+page;
	$.ajax({
		url: "Ajax/listCategory.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#categoryReslt').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#categoryReslt').html(data);
			}
		}
	});
}
	
$('#categoryReslt .catgVewPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getCategory(page);
});
function delCategory(catgId)
{
	var msg = confirm('Are you sure you want to delete this category ??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "catgId="+catgId;
		$.ajax({
			url: "Ajax/deleteCategory.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert(data);
				getCategory(1);
			}
		});
	}
}

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
function delProdct(prodId)
{
	var msg = confirm('Are you sure you want to delete this product ??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "prodId="+prodId;
		$.ajax({
			url: "Ajax/deleteProduct.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert('Product deleted sucessfully');
				getProducts(1);
			}
		});
	}
}
/*------------------------------------- SIZE SCRIPT ----------------------------------------------------*/
function getSizes(page) {
	var data = "page="+page;
	$.ajax({
		url: "Ajax/listSizes.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#sizesReslt').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#sizesReslt').html(data);
			}
		}
	});
}
	
$('#sizesReslt .sizeList li.active').live('click',function(){
   var page = $(this).attr('p');
   getSizes(page);
}); 
function delSize(sizeId)
{
	var msg = confirm('Are you sure you want to delete this size ??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "sizeId="+sizeId;
		$.ajax({
			url: "Ajax/deleteSize.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert('Size deleted sucessfully');
				getSizes(1);
			}
		});
	}
}

/*------------------------------ MATERIAL SCIPT -------------------------------*/
/*********************** Material Script **********************************/
function getMaterial(page) {
	var data = "page="+page;
	$.ajax({
		url: "Ajax/listMaterial.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#matrlReslt').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#matrlReslt').html(data);
			}
		}
	});
}
	
$('#matrlReslt .matrialPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getMaterial(page);
});
function delMatrial(matrlId)
{
	var msg = confirm('Are you sure you want to delete this material ??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "matrlId="+matrlId;
		$.ajax({
			url: "Ajax/deleteMatrial.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert('Material deleted sucessfully');
				getMaterial(1);
			}
		});
	}
}
/*----------------------- UNITS SCRIPT ---------------------------------------------*/
function getUnits(page) {
	var data = "page="+page;
	$.ajax({
		url: "Ajax/listUnits.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#unitsReslt').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#unitsReslt').html(data);
			}
		}
	});
}
	
$('#unitsReslt .unitVewPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getUnits(page);
});
function delUnit(unitId)
{
	var msg = confirm('Are you sure you want to delete this unit ??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "unitId="+unitId;
		$.ajax({
			url: "Ajax/deleteUnit.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert('Unit deleted sucessfully');
				getUnits(1);
			}
		});
	}
}
/*----------------------------- SPECIFICATION SCRIPT --------------------------------------*/
function getSpecificatn(page) {
	var data = "&page="+page;
	$.ajax({
		url: "Ajax/listSpecificatn.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#specatnReslt').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#specatnReslt').html(data);
			}
		}
	});
}
	
$('#specatnReslt .spectnPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getSpecificatn(page);
}); 
function delSpec(specId)
{
	var msg = confirm('Are you sure you want to delete this specification ??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "specId="+specId;
		$.ajax({
			url: "Ajax/deleteSpec.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert('Specification deleted sucessfully');
				getSpecificatn(1);
			}
		});
	}
}
/*------------------------- OFFER SCRIPT -------------------------------*/
function getOffers(page) {
	var data = "page="+page;
	$.ajax({
		url: "Ajax/listOffers.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
			if (!data) {
                $('#offersReslt').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#offersReslt').html(data);
			}
		}
	});
}
	
$('#offersReslt .offerVewPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getOffers(page);
}); 
function delOffer(offerId)
{
	var msg = confirm('Are you sure you want to delete this offer ??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "offerId="+offerId;
		$.ajax({
			url: "Ajax/deleteOffer.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert('Offer deleted sucessfully');
				getOffers(1);
			}
		});
	}
}
/*-------------------------------- TAGS SCRIPT ------------------------------*/
function getTags(page) {

	var data = "page="+page;
	$.ajax({
		url: "Ajax/listTags.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
	
		
			if (!data) {
                $('#tagsReslt').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#tagsReslt').html(data);
			}
		}
	});
}
	
$('#tagsReslt .tagVewPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getTags(page);
});
function delTag(tagId)
{
	var msg = confirm('Are you sure you want to delete this tag ??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "tagId="+tagId;
		$.ajax({
			url: "Ajax/deleteTag.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert('Tag deleted sucessfully');
				getTags(1);
			}
		});
	}
}
/*-------------------------------- TAX SCRIPT ------------------------------*/
function getTax(page) {

	var data = "page="+page;
	$.ajax({
		url: "Ajax/listTax.php",
		type: "POST",
		data: data,
		cache: false,
		success: function (data) {
	
		
			if (!data) {
                $('#taxReslt').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#taxReslt').html(data);
			}
		}
	});
}
	
$('#taxReslt .taxVewPagn li.active').live('click',function(){
   var page = $(this).attr('p');
   getTax(page);
});
function delTax(taxId)
{
	var msg = confirm('Are you sure you want to delete this tax ??');
	if(!msg)
	{
		return false;
	}
	else
	{
		var data = "taxId="+taxId;
		$.ajax({
			url: "Ajax/deleteTax.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				alert('Tax deleted sucessfully');
				getTax(1);
			}
		});
	}
}