<?php 
	require_once ("library/languageFile.php");
	require_once ("library/functions.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html id="homeBody">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title><?echo lang('PROJ_TITLE');?></title>
		<link href="css/style.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/common_overlay.css"/>
		<link href="css/orbit-1.2.3.css" rel="stylesheet" type="text/css" media="screen" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="scripts/jquery.orbit-1.2.3.min.js"></script>
		<script type="text/javascript">
			$(window).load(function() {
				$('#banner').orbit();
			});
		</script>
		<script type="text/javascript" src="scripts/jquery.simplemodal.js"></script>
		<script type="text/javascript" src="scripts/popUp.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="mainWrapper">
				<div id="headerDiv">
					<? include ('library/header.php');?>
				</div>
				<div id="mainContainerDiv">
					<div id="mainSliderDiv">
						<div id="banner">
							<img src="images/slider/slider_one.jpg" style="width:860px;height:400px" alt="" />
							<img src="images/slider/slider_two.jpg" style="width:860px;height:400px" alt="" />
							<img src="images/slider/slider_three.jpg" style="width:860px;height:400px" alt="" />
							<img src="images/slider/slider_four.jpg" style="width:860px;height:400px" alt="" />
							<img src="images/slider/slider_five.jpg" style="width:860px;height:400px" alt="" />
							<img src="images/slider/slider_six.jpg" style="width:860px;height:400px" alt="" />
						</div>
						<div id="slideOverlayDiv">
						<ul id="slideOverlayUl">
							<li style="width:450px;floar:left;margin:0 10px 0 0">Luxury that has to impress us before we impress you</li>
							<li style="width:450px;floar:left;margin:0 0 0 10px">Damian De Goa</li>
						</ul>
					</div>
					</div>
				</div>
				<div id="footerDiv">
					<? include ('library/footer.php');?>
				</div>
			</div>
		</div>
	</body>
</html>
