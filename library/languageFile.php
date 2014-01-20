<?php	 	
	function lang($phrase){
		static $lang = array(
		'PROJ_TITLE'	=> 	'Damian de Goa',
		'FOLLW_US'		=> 	'Follow Us',
		'CATGRY'		=> 	'Category',
		'SERCH'			=> 	'Search',
		'VIEW_CRT'		=>	'View Cart',
		'VEW_MRE'		=>	'View More',
	);
		return $lang[$phrase];
	}
	
?>