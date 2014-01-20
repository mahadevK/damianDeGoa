<div class="headerTopDiv">
	<? 
		if(isset($_SESSION['fullName']) && $_SESSION['fullName']!="")
		{
	?>
		<ul class="WelComeText">
			<li class="welComeLi">
				<? echo lang('WEL_CME');?>&nbsp;&nbsp;&nbsp;<? echo $_SESSION['fullName'];?>
			</li>
		</ul>
	<?
		}
	?>
</div>
<div class="container">
	<div id="logoDiv">
		<!--<img src="images/logo.jpg" alt="" />-->
	</div>
	<div id="headerMenuDiv">
		<ul class="nav pull-right">
			<li class="dropdown" id="eventsMenu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><? echo lang('ORDER');?><b class="caret"></b></a>
				<ul class="dropdown-menu" style="min-width:191px">
					<li><a href="customers.php"><? echo lang('CUSTOMER');?></a></li>
					<li><a href="customer_quotation.php"><? echo lang('QUATN');?></a></li>
                    <li><a href="orders.php"><? echo lang('ORDER');?></a></li>
				</ul> 
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><? echo lang('ADMIN_PROF');?><b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="adminProfile.php"><? echo lang('ADMIN_PROF');?></a></li>
					<li><a href="dashBoard.php"><? echo lang('DASHBORD_TIT');?></a></li>
					<li><a href="logout.php"><? echo lang('LOG_OUT');?></a></li>
				</ul>   
			 </li>
		</ul>
     </div>
</div>
