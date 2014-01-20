<?php
	require_once("library/languageFile.php");
	require_once("library/config.php");
	require_once("library/functions.php");
	require_once("library/SqlFunctions.php");
	sessionCheck();
	$userId		=	$_SESSION['userId'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta charset="utf-8" http-equiv="Content-Type" content="text/html" />
		<title><?echo lang('ADMIN_PANEL');?></title>
		<link type="image/x-icon" href="images/favicon.ico" rel="shortcut icon"/>
		<link href="css/main.min.css" rel="stylesheet" />
		<link href="css/main-busnes.css" rel="stylesheet" />
		<!--[if IE 7] [if IE 8]>
			<style type="text/css">
				.content{
					padding:100px 0 0 0;
				}
				.row-fluid .span4 {
					width: 48.629%;
				}
			</style>
		<![endif]-->
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<script type="text/javascript" src="scripts/jquery.min.js"></script>
		<script type="text/javascript" src="scripts/advetiser.min.js"></script>
		<script type="text/javascript" src="scripts/validate.js"></script>
		<script type="text/javascript" src="scripts/countries.js"></script>
		<script language="javascript">
			$(window).load(function(){
				print_country("country");
			})
			
		</script>	
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<?include('library/header.php');?>
			</div>
		</div>
		<div class="content">
			<div class="container">
				<div class="page-header">
					<h3><?echo lang('ADD_USERS');?></h3>
				</div>
				<div class="row-fluid">
					<ul class="thumbnails">
						<li class="span4" style="width:60%;margin:0 0 0 20%">
							<div class="thumbnail">
								<div class="widget-content">
									<table style="color:#000000;width:700px;border:0px solid black;>
										<tr height="30px"><td><span style="color:red;" id="sucessMsg"></span></td></tr>
										<tr>
											<td style="width:15%;padding:5px;">
												Name<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<input type="text" name="name" id="name" style="width:291px">
											</td>
										</tr>
										<tr>
											<td style="width:15%;padding:5px;">
												Outlet<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<select id="outlet" name="outlet" style="width:306px">
													<option value="">Select</option>
													<? 
														$outletRes = outletQuery($userId);
														while($outletRow = mysql_fetch_assoc($outletRes))
														{
													?>
															<option value="<?=$outletRow['id']?>"><?=$outletRow['name']?></option>
													<?
														}
													?>
											</td>
										</tr>
										<tr>
											<td style="width:15%;padding:5px;">
												Role<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<select id="role" name="role" style="width:306px">
													<option value="">Select</option>
													<? 
														$roleRes = roleQuery($userId);
														while($roleRow = mysql_fetch_assoc($roleRes))
														{
													?>
															<option value="<?=$roleRow['id']?>"><?=$roleRow['role']?></option>
													<?
														}
													?>
											</td>
										</tr>
										<tr>
											<td style="width:15%;padding:5px;">
												UserName<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<input type="text" name="userName" id="userName" style="width:291px">
											</td>
										</tr>
										<tr>
											<td style="width:15%;padding:5px;">
												Password<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<input type="password" name="password" id="password" style="width:291px">
											</td>
										</tr>
										<tr>
											<td style="width:15%;padding:5px;">
												Confirm Password<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<input type="password" name="confpassword" id="confpassword" style="width:291px">
											</td>
										</tr>
										<tr>
											<td style="width:15%;padding:5px;">
												Email Id<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<input type="text" name="emailId" id="emailId" style="width:291px">
											</td>
										</tr>
										<tr>
											<td style="width:15%;padding:5px;">
												Contact No.<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<input type="text" name="contactNo" id="contactNo" style="width:291px">
											</td>
										</tr>
										<tr>
											<td style="width:15%;padding:5px;">
												Address<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<textarea type="text" name="address" id="address" style="width:291px"></textarea>
											</td>
										</tr>
										<tr>
											<td style="width:15%;padding:5px;">
												Country<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<select onchange="print_state('state',this.selectedIndex)" id="country" name ="country" style="width:306px"></select>
											</td>
										</tr>
										<tr>	
											<td style="width:15%;padding:5px;">
												State<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<select name ="state" id ="state" style="width:306px"></select>
											</td>
										</tr>
										<tr>	
											<td style="width:15%;padding:5px;">
												City<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:5%;padding:5px;">
												<input type="text" name="city" id="city" style="width:291px" />
											</td>
										</tr>
										<tr>
											<td style="width:15%;padding:5px;">
												Pin Code<span style="color:red">*</span>
											</td>
											<td style="width:5%;padding:5px;">:</td>
											<td style="width:35%;padding:5px;">
												<input type="text" name="pinCode" id="pinCode" style="width:291px">
											</td>
										</tr>
										<tr height="25px;"></tr>
										<tr>
											<td colspan="3" align="center">
												<input type="submit" name="submit" id="submit" value="Submit" onclick="return validateUser()">&nbsp;&nbsp;&nbsp; 
												<input name="Cancel" type="button" id="Cancel" value="Cancel" onclick="window.location.href='users.php';" />
												<img src="images/loading.gif" alt="" style="display:none" id="loadingImg"/>
												<input type="hidden" name="userId" id="userId" />
											</td>
										</tr>
									</table>
								</div>
								</form>
								<div class="widget-footer"></div>
							</div>
						</li>
					</ul>
			  </div>
			</div>
		</div>
		<div class="footerDiv">
			<? include('library/footer.php'); ?>
		</div>
	</body>
</html>
