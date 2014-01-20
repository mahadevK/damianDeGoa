<?
	if(isset($_SESSION["userName"]) && $_SESSION["userName"] != "")
	{
		$Log	=	'<a href="logOut.php">Log Out</a>';
	}
	else
	{
		$Log	=	'<a href="javascript:void(0)" onclick="logInPopUp();">Sign In</a>';
	}
?>
<div id="topHeader"></div>
<div id="MiddleHeader">
	<div id="logoContainer">
		<div id="logoDiv">
			<img src="images/LOGO.jpg" style="width:380px;height:100px" alt="" />
		</div>
		<div id="searchDiv">
			<ul class="headerUl">
				<li style="width:200px;float:left">Finest Furniture Showroom in Goa</li>
				<li style="width:200px;float:left">Search For Products</li>
			</ul>
		</div>
		<div id="loginDiv">
			<ul class="headerUl2">
				<li style="width:200px;float:left">Shopping Cart - Rs 0</li>
				<li style="width:200px;float:left"><? echo $Log;?></li>
			</ul>
		</div>
	</div>
</div>
<div id="bottomHeader">
	<div id="menuDiv">
		<ul id="menuUl">
			<li style="float:left;width:60px;text-align:center" class="home"><a href="index.php">HOME</a></li>
			<li style="float:left;width:60px;margin:0 0 0 20px;text-align:center" class="shop"><a href="shop.php">SHOP</a></li>
			<li style="float:left;width:100px;margin:0 0 0 20px;text-align:center"><a href="#">MY ACCOUNT</a></li>
			<li style="float:left;width:100px;margin:0 0 0 20px;text-align:center"><a href="#">CONTACT US</a></li>
			<li style="float:left;width:100px;margin:0 0 0 20px;text-align:center"><a href="#">CUSTOMIZATION</a></li>
		</ul>
	</div>
	<div id="seperaterDiv"></div>
</div>