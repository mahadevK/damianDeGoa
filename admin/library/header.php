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
			<? 
				if(isset($_SESSION['userType']) && $_SESSION['userType']==1)
				{
			?>
					<li class="dropdown" id="eventsMenu">
						<a href="adminList.php"><? echo lang('ADMIN_LIST');?></a>
					</li>
			<?
				}
				else if(isset($_SESSION['userType']) && $_SESSION['userType']==2)
				{
			?>
					<!--<li class="dropdown" id="eventsMenu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><? echo lang('ORDER');?><b class="caret"></b></a>
						<ul class="dropdown-menu" style="min-width:191px">
							<li><a href="customers.php"><? //echo lang('CUSTOMER');?></a></li>
							<li><a href="customer_quotation.php"><? //echo lang('QUATN');?></a></li>
						</ul> 
					</li>-->
					<li class="dropdown" id="eventsMenu">
						<a href="users.php"><? echo lang('USERS');?></a>
					</li>
					<li class="dropdown" id="eventsMenu">
						<a href="roles.php"><? echo lang('ROLES');?></a>
					</li>
					<li class="dropdown" id="eventsMenu">
						<a href="outlets.php"><? echo lang('OUTLETS');?></a>
					</li>
					<li class="dropdown" id="eventsMenu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><? echo lang('PROD_MANG');?><b class="caret"></b></a>
						<ul class="dropdown-menu" style="min-width:191px">
							<li><a href="Material.php"><? echo lang('MATERIAL');?></a></li>
							<li><a href="Units.php"><? echo lang('UNIT');?></a></li>
							<li><a href="Categories.php"><? echo lang('CATGRES');?></a></li>
							<li><a href="subCategories.php"><? echo lang('SUBCATGRES');?></a></li>
							<li><a href="SubSubCategories.php"><? echo lang('SUBSUBCATGRES');?></a></li>
							<li><a href="Products.php"><? echo lang('PRODCTS');?></a></li>
							<!--<li><a href="Specification.php"><? //echo lang('SPECFCTN');?></a></li>-->
							<li><a href="Offers.php"><? echo lang('OFFERS');?></a></li>
							<!--<li><a href="tags.php"><? //echo lang('TAGS');?></a></li>-->
							<li><a href="tax.php"><? echo lang('TAX');?></a></li>
						</ul> 
					</li>
			<?
				}
			?>
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
