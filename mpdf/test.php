<?php
	require_once('mpdf.php');
	 
	$mpdf = new mPDF();
	$mpdf->WriteHTML('<p align="justify"><b>dg&nbsp;</b>dgbbf</p>');
	
	$mpdf->WriteHTML('<p align="justify">Nulla felis erat, imperdiet eu, ullamcorper non, nonummy quis, elit. Suspendisse
	potenti. Ut a eros at ligula vehicula pretium. Maecenas feugiat pede vel risus. Nulla et lectus. Fusce
	eleifend neque sit amet erat. Integer consectetuer nulla non orci. Morbi feugiat pulvinar dolor. Cras
	odio. Donec mattis, nisi id euismod auctor, neque metus pellentesque risus, at eleifend lacus sapien
	et risus. Phasellus metus. Phasellus feugiat, lectus ac aliquam molestie, leo lacus tincidunt turpis,
	vel aliquam quam odio et sapien. Mauris ante pede, auctor ac, suscipit quis, malesuada sed, nulla.
	Integer sit amet odio sit amet lectus luctus euismod. Donec et nulla. Sed quis orci.</p></br></br>');
	
	$mpdf->WriteHTML('<p align="justify">Nulla felis erat, imperdiet eu, ullamcorper non, nonummy quis, elit. Suspendisse
	potenti. Ut a eros at ligula vehicula pretium. Maecenas feugiat pede vel risus. Nulla et lectus. Fusce
	eleifend neque sit amet erat. Integer consectetuer nulla non orci. Morbi feugiat pulvinar dolor. Cras
	odio. Donec mattis, nisi id euismod auctor, neque metus pellentesque risus, at eleifend lacus sapien
	et risus. Phasellus metus. Phasellus feugiat, lectus ac aliquam molestie, leo lacus tincidunt turpis,
	vel aliquam quam odio et sapien. Mauris ante pede, auctor ac, suscipit quis, malesuada sed, nulla.
	Integer sit amet odio sit amet lectus luctus euismod. Donec et nulla. Sed quis orci.</p>');
	
	
	$mpdf->Output();
	exit;
?>