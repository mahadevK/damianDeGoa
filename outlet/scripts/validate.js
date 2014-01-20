function valCustSel()
{ 
	var custId	=	$('select#custList').val();
	if(custId == "")
	{
		alert('Please select customer');
		$('select#custList').focus();
		return false;
	}
	else
	{
		window.location='quotation.php?cust='+btoa(custId);
	}
}
/*--------------------------- QUOTATION FORM SCRIPT --------------------------------*/
function validateQtnFrm()
{
	var charstrng	=	/^[A-Za-z\s]+$/;
	var numstrng	=	/^[0-9]+$/; 
	var numstrngtwo	=	/^[-+]?[0-9]*\.?[0-9]*([eE][-+]?[0-9]+)?$/; 
	var quotnName	=	document.getElementById("QatnName");
	var quotnAdrs	=	document.getElementById("QatnAdrs");
	var quotnPhne	=	document.getElementById("QatnPhne");
	var quotnDte	=	document.getElementById("QatnDte");
	/*var quotnDelDte	=	document.getElementById("QatnDelDte");*/
	var quotnNo		=	document.getElementById("QatnNo");
	if(quotnName.value.trim() == "")
	{
		alert('Please enter Name');
		quotnName.focus();
		return false;
	}
	if(!charstrng.test(quotnName.value.trim())) 
	{ 
		alert("Please enter characters only");
		quotnName.focus();
		return false;
	}
	if(quotnAdrs.value.trim() == "")
	{
		alert('Please enter address');
		quotnAdrs.focus();
		return false;
	}
	if(quotnPhne.value.trim() == "")
	{
		alert('Please enter phone number');
		quotnPhne.focus();
		return false;
	}
	if(!numstrng.test(quotnPhne.value)) 
	{ 
		alert("Please enter numeric only");
		quotnPhne.focus();
		return false;
	}
	if(quotnDte.value.trim() == "")
	{
		alert('Please enter date');
		quotnDte.focus();
		return false;
	}
	/*if(quotnDelDte.value.trim() == "")
	{
		alert('Please enter delivey date');
		quotnDelDte.focus();
		return false;
	}*/
	var quatnRowCnt 	= 	document.getElementById("quatnRowCnt");
	var CounterValue 	= 	quatnRowCnt.value;
	var errorMsg		=	0;
	var errorMsgV		=	'';
	for(var i=0;i<CounterValue;i++)
	{
		var quotnTxt	=	document.getElementById("quatnTxt"+i);
		var quotnQty	=	document.getElementById("quatnQty"+i);
		var quotnUnit	=	document.getElementById("quatnUnit"+i);
		var quotnRate	=	document.getElementById("quatnRate"+i);
		var quotnAmnt	=	document.getElementById("quatnAmnt"+i);
		
		if(quotnTxt.value.trim() == "" || quotnQty.value.trim() == "" || quotnUnit.value.trim() == "" 
			|| quotnRate.value.trim() == "" || quotnAmnt.value.trim() == "")
		{
			errorMsg	=	1;
			errorMsgV	=	'Please enter all entries';
		}
		else if(!numstrng.test(quotnQty.value)) 
		{ 
			errorMsg	=	1;
			errorMsgV	=	'Please enter numeric only';
		}
		else if(!numstrngtwo.test(quotnRate.value)) 
		{ 
			errorMsg	=	1;
			errorMsgV	=	'Characters not allowded';
		}
	}
	if(errorMsg == 1)
	{
		alert('Please enter all entries')
		return false;
	}
}

function addQutatnRow()
{
	var quatnRowCnt 	= 	document.getElementById("quatnRowCnt");
	var CounterValue 	= 	quatnRowCnt.value;
	var errorMsg		=	0;
	for(var i=0;i<CounterValue;i++)
	{
		var quotnTxt	=	document.getElementById("quatnTxt"+i);
		var quotnQty	=	document.getElementById("quatnQty"+i);
		var quotnUnit	=	document.getElementById("quatnUnit"+i);
		var quotnRate	=	document.getElementById("quatnRate"+i);
		var quotnAmnt	=	document.getElementById("quatnAmnt"+i);
		
		if(quotnTxt.value.trim() == "" || quotnQty.value.trim() == "" || quotnUnit.value.trim() == "" 
			|| quotnRate.value.trim() == "" || quotnAmnt.value.trim() == "")
		{
			errorMsg	=	1;
		}
	}
	if(errorMsg == 1)
	{
		alert('Please enter all previous entries')
		return false;
	}
	var tbody 			= 	document.getElementById("quatnTable").getElementsByTagName("tbody")[0];
	
	var row1 = document.createElement("tr");
		
	var data1 				= 	document.createElement("td");
		data1.className		=	"leftTdBrder";
		qautnTxt 			= 	document.createElement("Textarea");
		qautnTxt.name		=	"quatnTxt"+CounterValue;
		qautnTxt.id			=	"quatnTxt"+CounterValue;
		qautnTxt.className	=	"Qtatntxtarea";
		data1.appendChild(qautnTxt);
		row1.appendChild(data1);
		tbody.appendChild(row1);
		
	var data2 				= 	document.createElement("td");
		data2.className		=	"leftTdBrder";
		qautnQty			= 	document.createElement("input");
		qautnQty.type		=	"text";
		qautnQty.name		=	"quatnQty"+CounterValue;
		qautnQty.id			=	"quatnQty"+CounterValue;
		qautnQty.className	=	"QuatnInput3";
		qautnQty.onchange 	= 	function(){return calQuotnAmount(CounterValue);};
		data2.appendChild(qautnQty);
		row1.appendChild(data2);
		tbody.appendChild(row1);
	
	var data3 				= 	document.createElement("td");
		data3.className		=	"leftTdBrder";
		qautnUnit			= 	document.createElement("input");
		qautnUnit.type		=	"text";
		qautnUnit.name		=	"quatnUnit"+CounterValue;
		qautnUnit.id			=	"quatnUnit"+CounterValue;
		qautnUnit.className	=	"QuatnInput3";
		data3.appendChild(qautnUnit);
		row1.appendChild(data3);
		tbody.appendChild(row1);
	
	var data4 				= 	document.createElement("td");
		data4.className		=	"leftTdBrder";
		qautnRate			= 	document.createElement("input");
		qautnRate.type		=	"text";
		qautnRate.name		=	"quatnRate"+CounterValue;
		qautnRate.id		=	"quatnRate"+CounterValue;
		qautnRate.className	=	"QuatnInput4";
		qautnRate.onchange 	= 	function(){return calQuotnAmount(CounterValue);};
		data4.appendChild(qautnRate);
		row1.appendChild(data4);
		tbody.appendChild(row1);
	
	var data5 				= 	document.createElement("td");
		data5.className		=	"leftTdBrder rightTdBrer";
		qautnAmnt			= 	document.createElement("input");
		qautnAmnt.type		=	"text";
		qautnAmnt.name		=	"quatnAmnt"+CounterValue;
		qautnAmnt.id		=	"quatnAmnt"+CounterValue;
		qautnAmnt.className	=	"QuatnInput4";
		qautnAmnt.readOnly	=	true;
		data5.appendChild(qautnAmnt);
		row1.appendChild(data5);
		tbody.appendChild(row1);
		
	document.getElementById("quatnRowCnt").value=parseInt(CounterValue)+parseInt(1);
	document.getElementById('delteMonRow').style.display = '';
}
function delMondayrow()
{
	var quatnRowCnt 	= 	document.getElementById("quatnRowCnt");
	var CounterValue 	= 	quatnRowCnt.value;
	var Cvalue 			= 	CounterValue;
	document.getElementById("quatnTable").deleteRow(Cvalue);
	document.getElementById("quatnRowCnt").value=parseInt(CounterValue)-parseInt(1);
	if(Cvalue == 2)
	{
		document.getElementById('delteMonRow').style.display = 'none';
	}
}
function calQuotnAmount(count)
{
	var numstrng	=	/^[0-9]+$/; 
	var numstrngtwo	=	/^[-+]?[0-9]*\.?[0-9]*([eE][-+]?[0-9]+)?$/;
	/*---------------------------- Calculation for Amount (Quntity * Rate)  ---------------------------*/
	var qunty	=	document.getElementById('quatnQty'+count);
	if(qunty.value.trim() == ""){ var quntyVal = 0}
	else{ 
		if(!numstrng.test(qunty.value)) 
		{ 
			alert("Please enter numeric only");
			qunty.focus();
			return false;
		}
		var quntyVal = qunty.value
	};
	var rate	=	document.getElementById('quatnRate'+count);
	if(rate.value.trim() == ""){ var rateVal = 0}
	else{ 
		if(!numstrngtwo.test(rate.value)) 
		{ 
			alert("Characters not allowded");
			rate.focus();
			return false;
		}
		var rateVal = rate.value
	};
	var amount	=	(parseFloat(quntyVal)*parseFloat(rateVal));
	document.getElementById('quatnAmnt'+count).value	=	amount;
	
	/*---------------------------- Calculation for Total Amount ---------------------------*/
	var quatnRowCnt 	= 	document.getElementById("quatnRowCnt");
	var CounterValue 	= 	quatnRowCnt.value;
	var amtTotalVal 		= 	0;
	for(var amt=0;amt<CounterValue;amt++)
	{
		var amount_val	=	 document.getElementById('quatnAmnt'+amt).value
		amtTotalVal		=	(parseFloat(amtTotalVal)+parseFloat(amount_val));
	}
	document.getElementById('amtTotal').value		=	amtTotalVal;
	document.getElementById('amtTot').innerHTML	=	amtTotalVal;
	
	var ExciseTax		=	document.getElementById("excseTax").value;
	var Excse_amount	=	(parseFloat(ExciseTax)+parseFloat(amtTotalVal));
	document.getElementById('finTotal').value		=	Excse_amount;
	document.getElementById('finalTot').innerHTML	=	Excse_amount;
	
	var serviceTax	=	document.getElementById("excseTax").value;
	var grantTotal	=	(parseFloat(Excse_amount)+parseFloat(serviceTax));
	document.getElementById('grntTotal').value		=	grantTotal;
	document.getElementById('grntTot').innerHTML	=	grantTotal;
}
/*------------------------- CUSTOMER VALIDATE FUNCTION -----------------------------------*/
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
	$('input#Cancel').hide();
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
				window.location='quotation.php?cust='+btoa(data);
			}
			else
			{
				alert("Customer updated successfully");
				window.location='customers.php';
			}
		}
	});
}