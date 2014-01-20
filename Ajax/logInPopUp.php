<?php	
	
	$data			=	'';
	$data	.=	'<div id="popUpWrapper" style="background:#D9D9D9">';
	$data	.=	'<table style="color:#000;margin:0 0 0 35px">';	
	$data	.=	'<tr height="15px"></tr>';
	$data	.=	'<tr><td colspan="3" id="sucMsg" style="color:red"></td></tr>';
	$data	.=	'<tr height="20px"></tr>';
	$data	.=	'<tr><td style="text-align:left">UserName</td>';
	$data	.=	'<td style="text-align:left">:</td>';
	$data	.=	'<td style="text-align:left"><input type="text" name="username" id="username"/></td>';
	$data	.=	'</tr><tr height="25px"></tr>';
	$data	.=	'<tr><td style="text-align:left">Password</td>';
	$data	.=	'<td style="text-align:left">:</td>';
	$data	.=	'<td style="text-align:left"><input type="password" name="password" id="password"/></td>';
	$data	.=	'</tr><tr height="25px"></tr>';
	$data	.=	'<tr><td colspan="3" align="center"><input type="button" value="submit" onclick="return logInSubmit()"></td></tr><tr height="25px"></tr></table>';
	$data	.=	'</div>';
	echo $data;
?>
