var slideTime = 1000, topMargin;

function winOnResize() {
	xMoveTo('leftLinks', xPageX('leftColumn')+xWidth('leftColumn')+20, topMargin);
	xGetElementById('leftLinks').style.visibility = 'visible';
	winOnScroll(); // initial slide
}

function winOnScroll() {
	xSlideTo('leftLinks', xLeft('leftLinks'), xScrollTop() + topMargin, slideTime);
}

function setSlideTime(st) {
	st = parseInt(st);
	if (!isNaN(st)) slideTime = st;
	var e = xGetElementById('st');
	e.value = st;
	return false;
}
function serchProd()
{
	var catSel		=	$('select#catSelect').val();
	var catName		=	$('input#serchCatName').val();
	loadProdData();
}
/************************** Load Products Data *************************/
function loadProdData()
{
	$('#dataLoader').show();
	var catSel		=	$('select#catSelect').val();
	var prodName	=	$('input#serchCatName').val();
	var dataStrng	=	'catSel='+catSel+'&prodName='+prodName;
	$.ajax({
		type: "POST",
		url: "Ajax/prodDataProcess.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 
			$('#dataLoader').hide();
			if (!data) {
                $('#prodctContainer').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#prodctContainer').html(data);
			}
		}
	});
}

/********************** load Categry wise prodct **********************/
function serchCatProd()
{
	var catgId		=	$('select#catSelect').val();
	if(catgId == "")
	{
		/*alert('Please select category');
		$('select#catSelect').focus();
		return false;*/
		window.location = 'shop.php';
	}
	else
	{
		var prodName	=	$('input#serchCatName').val();
		loadCatgProd(1);
	}
}
function loadCatgProd(page)
{
	$('#dataLoader').show();
	var catgId		=	$('select#catSelect').val();
	var prodName	=	$('input#serchCatName').val();
	var checkValues = $('input[name=pricecheck]:checked').map(function()
    {
		return $(this).val();
    }).get();
			
	var dString	=	'catgId='+catgId+'&page='+page+'&prodName='+prodName+'&checkedvalues='+checkValues;
	$.ajax({
		type: "POST",
		url: "Ajax/catgProdData.php",
		cache: false,
		data:dString,
		success: function(data) { 
			$('#dataLoader').hide();
			if (!data) {
                $('#prodctContainer').html('<label style="color:#cd0000;margin:250px">No Records Found</td></tr>');
			} else {
                $('#prodctContainer').html(data);
			}
		}
	});
}
$('#prodctContainer .paginationDiv li.active').live('click',function(){
    var page = $(this).attr('p');
	loadCatgProd(page);
});
