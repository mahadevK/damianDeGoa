function logInPopUp(){
	//alert(spaceId);
	$('#basic-modal-content').modal();
		
	$.ajax({
	url: 'Ajax/logInPopUp.php',
	type: 'POST',
	cache: false,
	success: function(data){
		$('#basic-modal-content').modal();
		$('#simplemodal-container').css('top','160px');
		$('#simplemodal-container').css('left','500px');
		$('.simplemodal-wrap').html(data);
	}
	});	
}

function logInSubmit()
{
	var username	=	$('input#username').val();
	var password	=	$('input#password').val();
	if(username == "")
	{
		$('#sucMsg').html('Please enter username');
		$('input#username').focus();
		return false;
	}
	if(password == "")
	{
		$('#sucMsg').html('Please enter password');
		$('input#password').focus();
		return false;
	}
	var dataString	=	"username="+username+"&password="+password;
	$.ajax({
	url: 'Ajax/logInProcess.php',
	type: 'POST',
	data:dataString,
	cache: false,
	success: function(data){
		if(data == 0)
		{
			var sussMsg	=	'<span style="color:red;font:18px">log In Successful</span>';
			$('#popUpWrapper').html(sussMsg);
			window.location = "index.php";
		}
		else
		{
			$('#sucMsg').html('Incorrect username & Password');
			$('input#username').val('');
			$('input#password').val('');
		}
	}
	});
}
