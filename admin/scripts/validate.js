/*------------------------- ADMIN VALIDATE FUNCTIONS -------------------------------*/
function validateadmin()
{
	var charstrng=/^[A-Za-z\s]+$/;
	var numstrng=/^[0-9]+$/; 
	var email = /^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i;
	var fname = document.getElementById('fname');
	if(fname.value.trim() == "")
	{
		alert('Please enter  Name');
		fname.focus();
		return false;
	}
	if(!charstrng.test(fname.value.trim()) ) 
	{ 
		alert("Please enter characters only");
		fname.focus();
		return false;
	}

	var username 	= 	document.getElementById('uname');
	//var uNameAvble	=	document.getElementById('uNameAvble');
	if(username.value.trim() == "")
	{
		alert('Please enter user name');
		username.focus();
		return false;
	}
/* 	else if(uNameAvble.value == 1)
	{
		alert('Username already exists');
		username.focus();
		return false;
	} */
	var password = document.getElementById('passwd');
	if(password.value.trim() == "")
	{
		alert('Please enter password');
		password.focus();
		return false;
	}
	var confPassw = document.getElementById('conpass');
	if(confPassw.value.trim() == "")
	{
		alert('Please confirm password');
		confPassw.focus();
		return false;
	}
	if(password.value.trim() != confPassw.value.trim())
	{
		alert('Password does not match');
		confPassw.focus();
		return false;
	}
		var mobile = document.getElementById('contact');
	if(mobile.value.trim() == "")
	{
		alert("Please enter the contact number");
			mobile.focus();
			return false;
	}
	if(!numstrng.test(mobile.value.trim()) ) 
	{ 
		alert("Please enter numbers only");
		mobile.focus();
		return false;
	}
	var membEmail 	= 	document.getElementById('email');
	var eamilAvble	=	document.getElementById('eamilAvble');
	
	
	if(membEmail.value.trim() == "")
	{
		alert('Please enter email id');
		membEmail.focus();
		return false;
	}
	else if(!email.test(membEmail.value))
	{
		alert('Please enter valid email id');
		membEmail.focus();
		return false;
	}
	else if(eamilAvble.value == 1)
	{
		alert('Email id already exists');
		membEmail.focus();
		return false;
	}
}

function validateadminEdit()
{
	var charstrng=/^[A-Za-z\s]+$/;
	var numstrng=/^[0-9]+$/; 
	var email = /^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i;
	var fname = document.getElementById('fname');
	if(fname.value.trim() == "")
	{
		alert('Please enter  Name');
		fname.focus();
		return false;
	}
	if(!charstrng.test(fname.value.trim()) ) 
	{ 
		alert("Please enter characters only");
		fname.focus();
		return false;
	}

	var username 	= 	document.getElementById('uname');
	//var uNameAvble	=	document.getElementById('uNameAvble');
	if(username.value.trim() == "")
	{
		alert('Please enter user name');
		username.focus();
		return false;
	}
/* 	else if(uNameAvble.value == 1)
	{
		alert('Username already exists');
		username.focus();
		return false;
	} */

		var mobile = document.getElementById('contact');
	if(mobile.value.trim() == "")
	{
		alert("Please enter the contact number");
			mobile.focus();
			return false;
	}
	if(!numstrng.test(mobile.value.trim()) ) 
	{ 
		alert("Please enter numbers only");
		mobile.focus();
		return false;
	}
	var membEmail 	= 	document.getElementById('email');
	var eamilAvble	=	document.getElementById('eamilAvble');
	
	
	if(membEmail.value.trim() == "")
	{
		alert('Please enter email id');
		membEmail.focus();
		return false;
	}
	else if(!email.test(membEmail.value))
	{
		alert('Please enter valid email id');
		membEmail.focus();
		return false;
	}
	else if(eamilAvble.value == 1)
	{
		alert('Email id already exists');
		membEmail.focus();
		return false;
	}
}
function checkEmailAvbty()
{ 
	var email = /^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i;
	var membEmail = document.getElementById('email');

	if(membEmail.value.trim() == "")
	{
		alert('Please enter email id');
		membEmail.focus();
		return false;
	}
	else if(!email.test(membEmail.value))
	{
		alert('Please enter valid email id');
		membEmail.focus();
		return false;
	}
	else
	{
		var dataStrng	=	'Email='+membEmail.value;
		$.ajax({
			type: "POST",
			url: "Ajax/checkEmail.php",
			cache: false,
			data:dataStrng,
			success: function(data) {
		
				if (data == 1) {
					alert('Email id already exists');
					membEmail.focus();
					document.getElementById('eamilAvble').value=1;
					return false;	
				}
				else
				{
					document.getElementById('eamilAvble').value=0;
				}
			}
		});
	}
}

/*------------------------- OUTLET VALIDATE FUNCTION -----------------------------*/
function validateOutlet()
{
	var charstrng	=	/^[A-Za-z\s]+$/;
	var outletName 	= 	$.trim($('input#outletName').val());
	var country 	= 	$.trim($('select#country').val());
	var state	 	= 	$.trim($('select#state').val());
	var city	 	= 	$.trim($('input#city').val());
	
	if(outletName == "")
	{
		alert('Please enter name of the outlet');
		$('input#outletName').focus();
		return false;
	}
	if(!charstrng.test(outletName) ) 
	{ 
		alert("Please enter characters only");
		$('input#outletName').focus();
		return false;
	}
	if(country == "")
	{
		alert('Please select country');
		$('select#country').focus();
		return false;
	}
	if(state == "")
	{
		alert('Please select state');
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
	else
	{
		var outletId =	$('input#outletId').val();
		$('input#submit').hide();
		$('input#Cancel').hide();
		$('#loadingImg').show();
		var dataStrng	=	'outletName='+outletName+'&country='+country+'&state='+state+'&city='+city+'&outletId='+outletId;
		$.ajax({
			type: "POST",
			url: "Ajax/newOutlet.php",
			cache: false,
			data:dataStrng,
			success: function(data) {
				alert(data);
				window.location='outlets.php';
			}
		});
	}
}
 
/*------------------------- USERS VALIDATE FUNCTION -----------------------------------*/
function validateUser()
{
	var email 		= 	/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i;
	var charstrng	=	/^[A-Za-z\s]+$/;
	var numstrng	=	/^[0-9]+$/; 
	var name 		= 	$.trim($('input#name').val());
	var outlet 		= 	$.trim($('select#outlet').val());
	var role		= 	$.trim($('select#role').val());
	var userName	= 	$.trim($('input#userName').val());
	var password 	= 	$.trim($('input#password').val());
	var confPassw 	= 	$.trim($('input#confpassword').val());
	var emailId		= 	$.trim($('input#emailId').val());
	var contactNo	= 	$.trim($('input#contactNo').val());
	var address	 	= 	$.trim($('textarea#address').val());
	var country	 	= 	$.trim($('select#country').val());
	var state	 	= 	$.trim($('select#state').val());
	var city	 	= 	$.trim($('input#city').val());
	var pinCode	 	= 	$.trim($('input#pinCode').val());
	var editUsrId	= 	$.trim($('input#userId').val());
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
	if(outlet == "")
	{
		alert('Please select outlet');
		$('select#outlet').focus();
		return false;
	}
	if(role == "")
	{
		alert('Please select role');
		$('select#role').focus();
		return false;
	}
	if(userName == "")
	{
		alert('Please enter username');
		$('input#userName').focus();
		return false;
	}
	if(editUsrId == "")
	{
		if(password == "")
		{
			alert('Please enter password');
			$('input#password').focus();
			return false;
		}
		if(confPassw == "")
		{
			alert('Please confirm password');
			$('input#confpassword').focus();
			return false;
		}
		if(password != confPassw)
		{
			alert('Password does not match');
			$('input#password').focus();
			return false;
		}
	}
	if(emailId == "")
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
	if(country == "")
	{
		alert('Please enter country');
		$('select#country').focus();
		return false;
	}
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
	if(pinCode == "")
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
	}
	else
	{
		$('input#submit').hide();
		$('input#Cancel').hide();
		$('#loadingImg').show();
		var dataStrng	=	'Name='+name+'&outlet='+outlet+'&role='+role+'&userName='+userName+'&password='+password+'&emailId='+emailId+
							'&contactNo='+contactNo+'&address='+address+'&country='+country+'&state='+state+'&city='+city+'&pincode='+pinCode+'&addeduserId='+editUsrId;
		$.ajax({
			type: "POST",
			url: "Ajax/newUser.php",
			cache: false,
			data:dataStrng,
			success: function(data) {
				alert(data);
				window.location='users.php';
			}
		});
	}
}

/*----------------------------------- CATEGORY VALIDATE SCRIPT ------------------------------*/
function valCategory()
{
	var catgry		=	$.trim($('input#catgry').val());
	var charstrng	=	/^[A-Za-z\s]+$/;
	if(catgry == "")
	{
		alert('Please enter category');
		$('input#catgry').focus();
		return false;
	}
	if(!charstrng.test(catgry) ) 
	{ 
		alert("Please enter characters only");
		$('input#catgry').focus();
		return false;
	}
	$('#submit').hide();
	$('#Cancel').hide();
	$('#loadingImg').show();
	var rSubCatg	=	$("input:radio[name=RsubCatg]:checked").val();
	var dataStrng	=	'catgry='+catgry+'&rSubCatg='+rSubCatg;
	$.ajax({
		type: "POST",
		url: "Ajax/newCategory.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 	
			if(data == 0)
			{
				alert('Similar Category already exist');
				$('#loadingImg').hide();
				$('#submit').show();
				$('#Cancel').show();
			}
			else{
				$('#loadingImg').hide();
				alert('Category added sucessfully');
				window.location='Categories.php';
			}
		}
	});
}
/*----------------------------------- SUB CATEGORY VALIDATE SCRIPT ------------------------------*/
function valSubCategory()
{
	var charstrng	=	/^[A-Za-z\s]+$/;
	var catgry		=	$.trim($('select#catgry').val());
	if(catgry == "")
	{
		alert('Please select category');
		$('select#catgry').focus();
		return false;
	}
	var subcatgry		=	$.trim($('input#Subcatgry').val());
	if(subcatgry == "")
	{
		alert('Please enter sub category');
		$('input#Subcatgry').focus();
		return false;
	}
	if(!charstrng.test(subcatgry) ) 
	{ 
		alert("Please enter characters only");
		$('input#Subcatgry').focus();
		return false;
	}
	$('#submit').hide();
	$('#Cancel').hide();
	$('#loadingImg').show();
	var rSubCatg	=	$("input:radio[name=RsubCatg]:checked").val();
	var dataStrng	=	'subcatgry='+subcatgry+'&rSubCatg='+rSubCatg+'&catgry='+catgry;
	$.ajax({
		type: "POST",
		url: "Ajax/newSubCategory.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 	
			if(data == 0)
			{
				alert('Similar Category already exist');
				$('#loadingImg').hide();
				$('#submit').show();
				$('#Cancel').show();
			}
			else{
				$('#loadingImg').hide();
				alert('Sub Category added sucessfully');
				window.location='subCategories.php';
			}
		}
	});
}
/*-------------------------- SUB SUB CATEGORY SCRIPT -------------------------------*/
function valSubSCategory()
{
	var charstrng	=	/^[A-Za-z\s]+$/;
	var catgry		=	$.trim($('select#catgry').val());
	if(catgry == "")
	{
		alert('Please select category');
		$('select#catgry').focus();
		return false;
	}
	var Subcatgry		=	$.trim($('select#Subcatgry').val());
	if(Subcatgry == "")
	{
		alert('Please select sub category');
		$('select#Subcatgry').focus();
		return false;
	}
	var SubSubcatgry		=	$.trim($('input#SubSubcatgry').val());
	if(SubSubcatgry == "")
	{
		alert('Please enter sub category');
		$('input#SubSubcatgry').focus();
		return false;
	}
	if(!charstrng.test(SubSubcatgry) ) 
	{ 
		alert("Please enter characters only");
		$('input#SubSubcatgry').focus();
		return false;
	}
	$('#submit').hide();
	$('#Cancel').hide();
	$('#loadingImg').show();
	var dataStrng	=	'SubSubcatgry='+SubSubcatgry+'&Subcatgry='+Subcatgry+'&catgry='+catgry;
	$.ajax({
		type: "POST",
		url: "Ajax/newSSubCategory.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 	
			if(data == 0)
			{
				alert('Similar Category already exist');
				$('#loadingImg').hide();
				$('#submit').show();
				$('#Cancel').show();
			}
			else{
				$('#loadingImg').hide();
				alert('Sub Category added sucessfully');
				window.location='SubSubCategories.php';
			}
		}
	});
}
function loadSubCatg()
{
	var catgId = $('select#catgry').val();
	if(catgId == "")
	{
		alert('Please select category');
		$('select#catgry').focus();
		return false;
	}
	else
	{
		$('#Subcatgry').hide();
		$('#subCatgLdng').show();
		var data = "catgId="+catgId;
		$.ajax({
			url: "Ajax/getSubCatg.php",
			type: "POST",
			data: data,
			cache: false,
			success: function (data) {
				$('#Subcatgry').show();
				$('#subCatgLdng').hide();
				$('#Subcatgry').html(data);
			}
		});
	}
}
/*--------------------------- PRODUCT VALIDATE SCRIPT ------------------------------------*/
function checkOthrCatg(){
	var catgry	=	$('select#catgry').val();
	if(catgry == "999999")
	{
		$('#catGOthrTR').show();
	}
	else
	{
		$('#catGOthrTR').hide();
	}
}
function valProdct()
{
	var catgry	=	$('select#catgry').val();
	if(catgry == "")
	{
		alert('Please select category');
		$('select#catgry').focus();
		return false;
	}
	if(catgry == "999999")
	{
		var catgOthr	=	$.trim($('input#catGOthr').val());
		if(catgOthr == "")
		{
			alert('Please enter other category');
			$('input#catGOthr').focus();
			return false;
		}
	}
	var prodName	=	$.trim($('input#prodName').val());
	if(prodName == "")
	{
		alert('Please enter product name');
		$('input#prodName').focus();
		return false;
	}
	var stckCode	=	$.trim($('input#stckCode').val());
	if(stckCode == "")
	{
		alert('Please enter stock code');
		$('input#stckCode').focus();
		return false;
	}
	else{
		$('#prodSub').hide();
		$('#Cancel').hide();
		$('#loadingImg').show();
		return true;
	}
}
/*------------------------------ SPECIFICATION VALIDATE SCRIPT ---------------------------------------*/
function valSpecatn()
{
	var numstrng	=	/^[0-9]+$/; 
	var numstrngtwo	=	/^[-+]?[0-9]*\.?[0-9]*([eE][-+]?[0-9]+)?$/; 
	var regexp 		= 	/^[0-9]+(\.[0-9]{1,2})?$/;
	var proD	=	$('select#proD').val();
	if(proD == "")
	{
		alert('Please select product');
		$('select#proD').focus();
		return false;
	}
	var prodPrice	=	$('input#prodPrice').val();
	var prodcode	=	$('input#prodcode').val();
	if(prodPrice == "")
	{
		alert('Please enter product price');
		$('input#prodPrice').focus();
		return false;
	}
	if(!numstrngtwo.test(prodPrice)) 
	{ 
		alert("Please enter numeric only");
		$('input#prodPrice').focus();
		return false;
	}
	if(!regexp.test(prodPrice) )
	{
		alert("Please enter only two decimal places");
		$('input#prodPrice').focus();
		return false;
	}
	if(prodcode == "")
	{
		alert('Please enter the code');
		$('input#prodcode').focus();
		return false;
	}
	/*var matRial	=	$('select#matRial').val();
	if(matRial == "")
	{
		alert('Please select product material');
		$('select#matRial').focus();
		return false;
	}
	if(matRial == "9999")
	{
		var matRialOthr	=	$.trim($('input#matRialOthr').val());
		if(matRialOthr == "")
		{
			alert('Please enter other material');
			$('input#matRialOthr').focus();
			return false;
		}
	}
	var siZe	=	$('select#siZe').val();
	if(siZe == "9999")
	{
		var siZeOthr	=	$.trim($('input#siZeOthr').val());
		if(siZeOthr == "")
		{
			alert('Please enter other size');
			$('input#siZeOthr').focus();
			return false;
		}
	}*/
	var prodAvalbty	=	$('select#prodAvalbty').val();
	if(prodAvalbty == "")
	{
		alert('Please select product availability');
		$('select#prodAvalbty').focus();
		return false;
	}
	var prodStck	=	$('input#prodStck').val();
	if(prodStck == "")
	{
		alert('Please enter product stock');
		$('input#prodStck').focus();
		return false;
	}
	if(!numstrng.test(prodStck)) 
	{ 
		alert("Please enter integer value only");
		$('input#prodStck').focus();
		return false;
	}
	/*var prodWdth	=	$('input#prodWdth').val();
	var prodHght	=	$('input#prodHght').val();
	var prodBth		=	$('input#prodBth').val();
	var dimnUnit	=	$('select#diamnUnit').val();
	var dimnUnit1	=	$('select#diamnUnit1').val();
	var dimnUnit2	=	$('select#diamnUnit2').val();
	

	if(prodWdth != "")
	{
		if(!numstrng.test(prodWdth))
		{
			alert('Please enter integer only');
			$('input#prodWdth').focus();
			return false;
		}
		if(dimnUnit == "")
		{
			alert('Please select diamension unit');
			$('input#diamnUnit').focus();
			return false;
		}
		if(prodBth == "")
		{
			alert('Please enter product breadth');
			$('input#prodBth').focus();
			return false;
		}
	}
	if(prodBth != "")
	{
		if(!numstrng.test(prodBth))
		{
			alert('Please enter integer only');
			$('input#prodBth').focus();
			return false;
		}
		if(dimnUnit1 == "")
		{
			alert('Please select diamension unit');
			$('input#diamnUnit1').focus();
			return false;
		}
		if(prodHght == "")
		{
			alert('Please enter product height');
			$('input#prodHght').focus();
			return false;
		}
	}
	if(prodHght != "")
	{
		if(!numstrng.test(prodHght))
		{
			alert('Please enter integer only');
			$('input#prodHght').focus();
			return false;
		}
		if(dimnUnit2 == "")
		{
			alert('Please select diamension unit');
			$('input#dimnUnit2').focus();
			return false;
		}
		if(prodWdth == "")
		{
			alert('Please enter product width');
			$('input#prodWdth').focus();
			return false;
		}
	}
	if(dimnUnit != dimnUnit1 || dimnUnit != dimnUnit2 || dimnUnit1 != dimnUnit2 )
	{
			alert('Units must be same');
			return false;
	}
	var prodWeight	=	$('input#prodWeight').val();
	var weightUnit	=	$('select#wightUnit').val();
	if(prodWeight != "")
	{
		if(!numstrngtwo.test(prodWeight))
		{
			alert('Please enter integer only');
			$('input#prodWeight').focus();
			return false;
		}
		if(weightUnit == "")
		{
			alert('Please select weight unit');
			$('input#wightUnit').focus();
			return false;
		}
	}*/
	
	var prodDiscnt	=	$('input#prodDiscnt').val();
	
	var checktags   =   $('input[name=tagscheck]:checked').map(function()
	{
		return $(this).val();
	}).get();
						
	var checkcount  =   checktags.length;

	
	$('#prodSpecSub').hide();
	$('#Cancel').hide();
	$('#loadingImg').show();
	var dataStrng	=	'proD='+proD+'&prodPrice='+prodPrice+'&prodAvalbty='+prodAvalbty+
						'&prodDiscnt='+prodDiscnt+'&prodStck='+prodStck+
						+'&prodcode='+prodcode+'&tagval='+checktags+'&counttag='+checkcount;
						
	$.ajax({
		type: "POST",
		url: "Ajax/newSpecification.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 	
			if(data == 0)
			{
				var susMsg	=	'Product with similar Specification already exist';
				$('#sucessMsg').html(susMsg);
				$('#loadingImg').hide();
				$('#prodSpecSub').show();
				$('#Cancel').show();
			}
			else{
				$('#loadingImg').hide();
				var susMsg	=	'Specification added sucessfully';
				$('#sucessMsg').html(susMsg);
				setTimeout("window.location='Specification.php'",800);
			}
		}
	});
}
/*----------------------------- MATERIAL SCRIPT -----------------------------------*/
function valMaterial()
{
	var material	=	$.trim($('input#material').val());
	if(material == "")
	{
		alert('Please enter material');
		$('input#material').focus();
		return false;
	}
	$('#submit').hide();
	$('#Cancel').hide();
	$('#loadingImg').show();
	var dataStrng	=	'material='+material;
	$.ajax({
		type: "POST",
		url: "Ajax/newMatrial.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 	
			if(data == 0)
			{
				var susMsg	=	'Similar material already exist';
				$('#sucessMsg').html(susMsg);
				$('#loadingImg').hide();
				$('#submit').show();
				$('#Cancel').show();
			}
			else{
				$('#loadingImg').hide();
				var susMsg	=	'Material added sucessfully';
				$('#sucessMsg').html(susMsg);
				setTimeout("window.location='Material.php'",800);
			}
		}
	});
}
/*------------------------- SCRIPT FOR UNITS -----------------------------------------*/
function valUnits()
{
	var charstrng	=	/^[A-Za-z\s]+$/;
	var units		=	$.trim($('input#units').val());
	if(units == "")
	{
		alert('Please enter unit');
		$('input#units').focus();
		return false;
	}
	else if(!charstrng.test(units))
	{
		alert("Please enter characters only");
		$('input#units').focus();
		return false;
	}
	var unitFor	=	$('select#unitFor').val();
	if(unitFor == "")
	{
		alert('Please select unit for');
		$('select#unitFor').focus();
		return false;
	}
	$('#submit').hide();
	$('#Cancel').hide();
	$('#loadingImg').show();
	var dataStrng	=	'units='+units+'&unitFor='+unitFor;
	$.ajax({
		type: "POST",
		url: "Ajax/newUnits.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 	
			if(data == 0)
			{
				var susMsg	=	'Similar unit already exist';
				$('#sucessMsg').html(susMsg);
				$('#loadingImg').hide();
				$('#submit').show();
				$('#Cancel').show();
			}
			else{
				$('#loadingImg').hide();
				var susMsg	=	'Unit added sucessfully';
				$('#sucessMsg').html(susMsg);
				setTimeout("window.location='Units.php'",800);
			}
		}
	});
}
/*------------------------------- SPECIFICATION SCRIPT -------------------------------------*/
function valSpecatn()
{
	var numstrng	=	/^[0-9]+$/; 
	var numstrngtwo	=	/^[-+]?[0-9]*\.?[0-9]*([eE][-+]?[0-9]+)?$/; 
	var regexp 		= 	/^[0-9]+(\.[0-9]{1,2})?$/;
	var proD	=	$('select#proD').val();
	if(proD == "")
	{
		alert('Please select product');
		$('select#proD').focus();
		return false;
	}
		
	
	var prodPrice	=	$('input#prodPrice').val();
	var prodcode	=	$('input#prodcode').val();
	if(prodPrice == "")
	{
		alert('Please enter product price');
		$('input#prodPrice').focus();
		return false;
	}
	if(!numstrngtwo.test(prodPrice)) 
	{ 
		alert("Please enter numeric only");
		$('input#prodPrice').focus();
		return false;
	}
	if(!regexp.test(prodPrice) )
	{
		alert("Please enter only two decimal places");
		$('input#prodPrice').focus();
		return false;
	}
	if(prodcode == "")
	{
		alert('Please enter the code');
		$('input#prodcode').focus();
		return false;
	}
	var matRial	=	$('select#matRial').val();
	if(matRial == "")
	{
		alert('Please select product material');
		$('select#matRial').focus();
		return false;
	}
	if(matRial == "9999")
	{
		var matRialOthr	=	$.trim($('input#matRialOthr').val());
		if(matRialOthr == "")
		{
			alert('Please enter other material');
			$('input#matRialOthr').focus();
			return false;
		}
	}
	var siZe	=	$('select#siZe').val();
	if(siZe == "9999")
	{
		var siZeOthr	=	$.trim($('input#siZeOthr').val());
		if(siZeOthr == "")
		{
			alert('Please enter other size');
			$('input#siZeOthr').focus();
			return false;
		}
	}
	var prodAvalbty	=	$('select#prodAvalbty').val();
	if(prodAvalbty == "")
	{
		alert('Please select product availability');
		$('select#prodAvalbty').focus();
		return false;
	}
	var prodStck	=	$('input#prodStck').val();
	if(prodStck == "")
	{
		alert('Please enter product stock');
		$('input#prodStck').focus();
		return false;
	}
	if(!numstrng.test(prodStck)) 
	{ 
		alert("Please enter integer value only");
		$('input#prodStck').focus();
		return false;
	}
	var prodWdth	=	$('input#prodWdth').val();
	var prodHght	=	$('input#prodHght').val();
	var prodBth		=	$('input#prodBth').val();
	var dimnUnit	=	$('select#diamnUnit').val();
	var dimnUnit1	=	$('select#diamnUnit1').val();
	var dimnUnit2	=	$('select#diamnUnit2').val();
	

	if(prodWdth != "")
	{
		if(!numstrng.test(prodWdth))
		{
			alert('Please enter integer only');
			$('input#prodWdth').focus();
			return false;
		}
		if(dimnUnit == "")
		{
			alert('Please select diamension unit');
			$('input#diamnUnit').focus();
			return false;
		}
		if(prodBth == "")
		{
			alert('Please enter product breadth');
			$('input#prodBth').focus();
			return false;
		}
	}
		if(prodBth != "")
	{
		if(!numstrng.test(prodBth))
		{
			alert('Please enter integer only');
			$('input#prodBth').focus();
			return false;
		}
		if(dimnUnit1 == "")
		{
			alert('Please select diamension unit');
			$('input#diamnUnit1').focus();
			return false;
		}
		if(prodHght == "")
		{
			alert('Please enter product height');
			$('input#prodHght').focus();
			return false;
		}
	}
	if(prodHght != "")
	{
		if(!numstrng.test(prodHght))
		{
			alert('Please enter integer only');
			$('input#prodHght').focus();
			return false;
		}
		if(dimnUnit2 == "")
		{
			alert('Please select diamension unit');
			$('input#dimnUnit2').focus();
			return false;
		}
		if(prodWdth == "")
		{
			alert('Please enter product width');
			$('input#prodWdth').focus();
			return false;
		}
	}
	if(dimnUnit != dimnUnit1 || dimnUnit != dimnUnit2 || dimnUnit1 != dimnUnit2 )
	{
			alert('Units must be same');
			return false;
	}
	var prodWeight	=	$('input#prodWeight').val();
	var weightUnit	=	$('select#wightUnit').val();
	if(prodWeight != "")
	{
		if(!numstrngtwo.test(prodWeight))
		{
			alert('Please enter integer only');
			$('input#prodWeight').focus();
			return false;
		}
		if(weightUnit == "")
		{
			alert('Please select weight unit');
			$('input#wightUnit').focus();
			return false;
		}
	}
	
	var prodDiscnt	=	$('input#prodDiscnt').val();
	
	var checktags   =   $('input[name=tagscheck]:checked').map(function()
						{
							 return $(this).val();
						}).get();
						
	var checkcount  =   checktags.length;

	
	$('#prodSpecSub').hide();
	$('#Cancel').hide();
	$('#loadingImg').show();
	var dataStrng	=	'proD='+proD+'&prodPrice='+prodPrice+'&matRial='+matRial+'&siZe='+siZe+'&prodAvalbty='+prodAvalbty+
						'&matRialOthr='+matRialOthr+'&siZeOthr='+siZeOthr+'&prodDiscnt='+prodDiscnt+'&prodStck='+prodStck+
						'&prodWdth='+prodWdth+'&prodBth='+prodBth+'&prodHght='+prodHght+'&prodWeight='+prodWeight+'&dimnUnit='+dimnUnit+'&dimnUnit1='+dimnUnit1+'&dimnUnit2='+dimnUnit2+'&weightUnit='+weightUnit+'&prodcode='+prodcode+'&tagval='+checktags+'&counttag='+checkcount;
						
	$.ajax({
		type: "POST",
		url: "Ajax/newSpecification.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 	
			if(data == 0)
			{
				var susMsg	=	'Product with similar Specification already exist';
				$('#sucessMsg').html(susMsg);
				$('#loadingImg').hide();
				$('#prodSpecSub').show();
				$('#Cancel').show();
			}
			else{
				$('#loadingImg').hide();
				var susMsg	=	'Specification added sucessfully';
				$('#sucessMsg').html(susMsg);
				setTimeout("window.location='Specification.php'",800);
			}
		}
	});
}

function valEditSpecatn()
{
	var numstrng	=	/^[0-9]+$/; 
	var numstrngtwo	=	/^[-+]?[0-9]*\.?[0-9]*([eE][-+]?[0-9]+)?$/; 
	var regexp 		= 	/^[0-9]+(\.[0-9]{1,2})?$/;
	var proD	=	$('select#proD').val();
	var prodcode	=	$('input#prodcode').val();

	if(proD == "")
	{
		alert('Please select product');
		$('select#proD').focus();
		return false;
	}
			if(prodcode == "")
	{
		alert('Please enter the code');
		$('input#prodcode').focus();
		return false;
	}
	
	var prodPrice	=	$('input#prodPrice').val();
	if(prodPrice == "")
	{
		alert('Please enter product price');
		$('input#prodPrice').focus();
		return false;
	}
	if(!numstrngtwo.test(prodPrice)) 
	{ 
		alert("Please enter numeric only");
		$('input#prodPrice').focus();
		return false;
	}
	if(!regexp.test(prodPrice) )
	{
		alert("Please enter only two decimal places");
		$('input#prodPrice').focus();
		return false;
	}
	var matRial	=	$('select#matRial').val();
	if(matRial == "")
	{
		alert('Please select product material');
		$('select#matRial').focus();
		return false;
	}
	if(matRial == "9999")
	{
		var matRialOthr	=	$.trim($('input#matRialOthr').val());
		if(matRialOthr == "")
		{
			alert('Please enter other material');
			$('input#matRialOthr').focus();
			return false;
		}
	}
	var siZe	=	$('select#siZe').val();
	if(siZe == "9999")
	{
		var siZeOthr	=	$.trim($('input#siZeOthr').val());
		if(siZeOthr == "")
		{
			alert('Please enter other size');
			$('input#siZeOthr').focus();
			return false;
		}
	}
	var prodAvalbty	=	$('select#prodAvalbty').val();
	if(prodAvalbty == "")
	{
		alert('Please select product availability');
		$('select#prodAvalbty').focus();
		return false;
	}
	var prodStck	=	$('select#prodStck').val();
	if(prodStck == "")
	{
		alert('Please select product stock');
		$('select#prodStck').focus();
		return false;
	}
	var prodWdth	=	$('input#prodWdth').val();
	var prodHght	=	$('input#prodHght').val();
	var prodBth		=	$('input#prodBth').val();
	var dimnUnit	=	$('select#diamnUnit').val();
	var dimnUnit2	=	$('select#diamnUnit2').val();
	var dimnUnit4	=	$('select#diamnUnit4').val();
	if(prodWdth != "")
	{
		if(!numstrng.test(prodWdth))
		{
			alert('Please enter integer only');
			$('input#prodWdth').focus();
			return false;
		}
		if(dimnUnit == "")
		{
			alert('Please select diamension unit');
			$('input#diamnUnit').focus();
			return false;
		}
		if(prodBth == "")
		{
			alert('Please enter product Breadth');
			$('input#prodBth').focus();
			return false;
		}
	}
			if(prodBth != "")
	{
		if(!numstrng.test(prodBth))
		{
			alert('Please enter integer only');
			$('input#prodBth').focus();
			return false;
		}
		if(dimnUnit4 == "")
		{
			alert('Please select diamension unit');
			$('input#dimnUnit4').focus();
			return false;
		}
		if(prodHght == "")
		{
			alert('Please enter product height');
			$('input#prodHght').focus();
			return false;
		}
	}
	
	if(prodHght != "")
	{
		if(!numstrng.test(prodHght))
		{
			alert('Please enter integer only');
			$('input#prodHght').focus();
			return false;
		}
		if(dimnUnit2 == "")
		{
			alert('Please select diamension unit');
			$('input#dimnUnit2').focus();
			return false;
		}
		if(prodWdth == "")
		{
			alert('Please enter product width');
			$('input#prodWdth').focus();
			return false;
		}
	}
		if(dimnUnit != dimnUnit4 || dimnUnit != dimnUnit2 || dimnUnit4 != dimnUnit2 )
	{
			alert('Units must be same');
			return false;
	}
	
	var prodWeight	=	$('input#prodWeight').val();
	var weightUnit	=	$('select#wightUnit').val();
	if(prodWeight != "")
	{
		if(!numstrngtwo.test(prodWeight))
		{
			alert('Please enter integer only');
			$('input#prodWeight').focus();
			return false;
		}
		if(weightUnit == "")
		{
			alert('Please select weight unit');
			$('input#wightUnit').focus();
			return false;
		}
	}
	
	var checktags   =   $('input[name=tagscheck]:checked').map(function()
						{
							 return $(this).val();
						}).get();
						
	var checkcount  =   checktags.length;
	if(checkcount==1)
	{
	checktags=checktags+",";
	}

	var prodDiscnt	=	$('input#prodDiscnt').val();
	var specId		=	$('input#specId').val();
	$('#prodSpecSub').hide();
	$('#Cancel').hide();
	$('#loadingImg').show();
	var dataStrng	=	'proD='+proD+'&prodPrice='+prodPrice+'&matRial='+matRial+'&siZe='+siZe+'&prodAvalbty='+prodAvalbty+
						'&matRialOthr='+matRialOthr+'&siZeOthr='+siZeOthr+'&prodDiscnt='+prodDiscnt+'&prodStck='+prodStck+
						'&prodWdth='+prodWdth+'&prodHght='+prodHght+'&prodWeight='+prodWeight+'&specId='+specId+'&dimnUnit='+dimnUnit+'&dimnUnit2='+dimnUnit2+'&weightUnit='+weightUnit+'&prodBth='+prodBth+'&dimnUnit4='+dimnUnit4+'&tagval='+checktags+'&counttag='+checkcount+'&prodcode='+prodcode;
	
	$.ajax({
		type: "POST",
		url: "Ajax/editSpecification.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 
	
			$('#loadingImg').hide();
			var susMsg	=	'Specification edited sucessfully';
			$('#sucessMsg').html(susMsg);
			setTimeout("window.location='Specification.php'",800);
		}
	});
}
function checkOthrMAtral(){
	var matRial	=	$('select#matRial').val();
	if(matRial == "9999")
	{
		$('#matRialOthrTR').show();
	}
	else
	{
		$('#matRialOthrTR').hide();
	}
}
function checkOthrSize(){
	var siZe	=	$('select#siZe').val();
	if(siZe == "9999")
	{
		$('#siZeOthrTR').show();
	}
	else
	{
		$('#siZeOthrTR').hide();
	}
}
/*------------------------------ CALCULATE DISCOUNT VAL -------------------------------------*/
function calDiscntVal()
{	
	var numstrngtwo	=	/^[-+]?[0-9]*\.?[0-9]*([eE][-+]?[0-9]+)?$/; 
	var prodPrice	=	$.trim($('input#prodPrice').val());
	var prodDiscnt	=	$.trim($('input#prodDiscnt').val());
	if(prodPrice == "")
	{
		alert('Please enter price');
		$('input#prodPrice').focus();
		return false;
	}
	else
	{
		if(!numstrngtwo.test(prodDiscnt)) 
		{ 
			alert("Please enter numeric only");
			$('input#prodDiscnt').focus();
			return false;
		}
		var discntVal	=	Math.round((parseFloat(prodPrice)*parseFloat(prodDiscnt))/(parseInt(100)));
		$('#discntVal').html('= Rs. '+discntVal);
	}
}
/*------------------------------- OFFER SCRIPT ------------------------------------------------*/
function valOffers()
{
	var offerName	=	$.trim($('input#offerName').val());
	if(offerName == "")
	{
		alert('Please enter offer name');
		$('input#offerName').focus();
		return false;
	}
	var startDte	=	$.trim($('input#startDte').val());
	if(startDte == "")
	{
		alert('Please select offer start date');
		$('input#startDte').focus();
		return false;
	}
	var endDte	=	$.trim($('input#endDte').val());
	if(endDte == "")
	{
		alert('Please select offer end date');
		$('input#endDte').focus();
		return false;
	}
	var eDate = new Date(endDte);
	var sDate = new Date(startDte);
	if(startDte!= '' && startDte!= '' && sDate> eDate)
	{
		alert("Please ensure that the End Date is greater than or equal to the Start Date.");
		return false;
	}
	var bannerImg	=	$.trim($('input#bannerImg').val());
	if(bannerImg == "")
	{
		alert('Please select banner image');
		$('input#bannerImg').focus();
		return false;
	}
	var oferCatg	=	$.trim($('select#oferCatg').val());
	if(oferCatg == "")
	{
		alert('Please select category');
		$('input#oferCatg').focus();
		return false;
	}
	return true;
}
function valEditOffers()
{
	var offerName	=	$.trim($('input#offerName').val());
	if(offerName == "")
	{
		alert('Please enter offer name');
		$('input#offerName').focus();
		return false;
	}
	var startDte	=	$.trim($('input#startDte').val());
	if(startDte == "")
	{
		alert('Please select offer start date');
		$('input#startDte').focus();
		return false;
	}
	var endDte	=	$.trim($('input#endDte').val());
	if(endDte == "")
	{
		alert('Please select offer end date');
		$('input#endDte').focus();
		return false;
	}
	var eDate = new Date(endDte);
	var sDate = new Date(startDte);
	if(startDte!= '' && startDte!= '' && sDate> eDate)
	{
		alert("Please ensure that the End Date is greater than or equal to the Start Date.");
		return false;
	}
	var bannerImg	=	$.trim($('input#bannerImg').val());
	var banerPrev	=	$.trim($('input#prevImg').val());
	if(bannerImg == "" && banerPrev == "")
	{
		alert('Please select banner image');
		$('input#bannerImg').focus();
		return false;
	}
	var oferCatg	=	$.trim($('select#oferCatg').val());
	if(oferCatg == "")
	{
		alert('Please select category');
		$('input#oferCatg').focus();
		return false;
	}
	return true;
}

/*---------------------------- TAG SCRIPT -----------------------------------*/
function valTags()
{
	var charstrng	=	/^[A-Za-z\s]+$/;
	var tags		=	$.trim($('input#tags').val());

	if(tags == "")
	{
		alert("Please enter tags");
		$('input#tags').focus();
		return false;
	}
	
	if(!charstrng.test(tags))
	{
		alert("Please enter characters only");
		$('input#tags').focus();
		return false;
	}
	
	$('#submit').hide();
	$('#Cancel').hide();
	$('#loadingImg').show();
	var dataStrng	='tags='+tags;
	$.ajax({
		type: "POST",
		url: "Ajax/newTags.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 	
			$('#loadingImg').hide();
				var susMsg	=	'Tag added sucessfully';
				$('#sucessMsg').html(susMsg);
				setTimeout("window.location='tags.php'",800);
		}
	});
}
/*---------------------------- TAX SCRIPT -----------------------------------*/
function valTax()
{
	var numstrngtwo	=	/^[-+]?[0-9]*\.?[0-9]*([eE][-+]?[0-9]+)?$/;
	var taxName		=	$('select#taxName').val();
	if(taxName == "")
	{
		alert("Please select tax");
		$('select#taxName').focus();
		return false;
	}
	var taxValue		=	$.trim($('input#taxVal').val());
	if(taxValue == "")
	{
		alert("Please enter tax value");
		$('input#taxVal').focus();
		return false;
	}
	if(!numstrngtwo.test(taxValue)) 
	{ 
		alert("Characters not allowded");
		$('input#taxVal').focus();
		return false;
	}
	var taxNId	=	$.trim($('input#taxNId').val());
	$('#submit').hide();
	$('#Cancel').hide();
	$('#loadingImg').show();
	var dataStrng	='taxNameId='+taxName+'&taxVal='+taxValue+'&taxNId='+taxNId;
	$.ajax({
		type: "POST",
		url: "Ajax/newTax.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 	
			$('#loadingImg').hide();
				var susMsg	=	data;
				$('#sucessMsg').html(susMsg);
				setTimeout("window.location='tax.php'",800);
		}
	});
}
function checkTax()
{
	var taxName		=	$('select#taxName').val();
	if(taxName != "")
	{
		var dataStrng	='taxNameId='+taxName;
		$.ajax({
			type: "POST",
			url: "Ajax/checkTax.php",
			cache: false,
			data:dataStrng,
			success: function(data) { 
				if(data > 0)
				{
					alert("Tax already added");
					$('select#taxName').val('');
					return false;
				}
			}
		});
	}
}
