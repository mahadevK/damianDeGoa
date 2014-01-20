<?php
	require_once("../library/config.php");
	$del_flag	=	0;
	$prodAvailble	=	0;
	$page 			= 	$_POST['page'];
	$cur_page 		= 	$page;
	$page -= 	1;
	$per_page 		= 	12;
	$previous_btn 	= 	true;
	$next_btn 		= 	true;
	$first_btn 		= 	true;
	$last_btn 		= 	true;
	$start 			= 	$page * $per_page;
	$msg			=	'';
	$catgId			=	$_POST['catgId'];
	$checkedvalues	=	$_POST['checkedvalues'];
	if($checkedvalues =="")
	{
		$price=" ";
	}
	if($checkedvalues ==1)
	{
		$price=" and prod_specification.prod_price <=500";
	}
	if($checkedvalues ==2)
	{
		$price="and prod_specification.prod_price between 500 and 1000";
	}
	if($checkedvalues ==3)
	{
		$price="and prod_specification.prod_price between 1001 and 2000";
	}
	if($checkedvalues ==4)
	{
		$price="and prod_specification.prod_price between 2001 and 3000";
	}
	if($checkedvalues ==5)
	{
		$price="and prod_specification.prod_price between 3001 and 4000";
	}
	if($checkedvalues ==6)
	{
		$price="and prod_specification.prod_price between 4001 and 5000";
	}

	$catWhre		=	"del_flag=0";
	if($catgId != "")
	{
		$catWhre .= " AND cat_id=$catgId";
	}
	$catSql		=	"SELECT cat_name,cat_id FROM category WHERE $catWhre";
	$catStmnt	=	mysql_query($catSql);
	while ($catRow = mysql_fetch_assoc($catStmnt)) { 
		$catName	=	$catRow['cat_name'];
		$catgryId	=	$catRow['cat_id'];
		$prodName	=	$_POST['prodName'];
 		$prodWhre	=	"products.del_flag=0 AND products.cat_id=$catgryId
							AND prod_specification.availibilty=$prodAvailble";
		if($prodName != "")
		{
			$prodWhre	.=	" AND products.name like '%".$prodName."%' ";
		}

		
		$prodctSql		=	"SELECT products.name,products.prod_id,products.prod_descrptn,
								prod_specification.prod_price,prod_specification.prod_discount,prod_specification.spec_id
								FROM products 
								INNER JOIN prod_specification ON products.prod_id=prod_specification.prod_id
								WHERE $prodWhre  $price group by  products.prod_id LIMIT $per_page OFFSET $start";
		$prodctStmnt	=	mysql_query($prodctSql);
		$msg .="<div style='float:left;width:760px'><ul>";
		$msg .="<li style='float:left;margin:0 0 25px 0;width:20px;color:blue'><img src='images/arrows.png' alt=''/></li>";
		$msg .="<li style='float:left;margin:0 0 25px 0;width:680px;color:blue'>".$catName."</li>";
		$msg .="<li style='float:left;margin:0 0 20px 0;width:760px;border:1px solid #D9D9D9'>";
		if (mysql_num_rows($prodctStmnt) > 0) {
			while ($prodctRow = mysql_fetch_assoc($prodctStmnt)) {
				$productId	=	$prodctRow['prod_id'];
				$prodctImgPath	=	'default.png';
				$prodImgSql	=	"SELECT main_img_path FROM prodct_images WHERE prodct_id=$productId";
				$prodImgStmnt	=	mysql_query($prodImgSql);
				while ($prodImgRow = mysql_fetch_assoc($prodImgStmnt)) {
					if($prodImgRow['main_img_path'] == "")
					{
						$prodctImgPath	=	'default.png';
					}
					else
					{
						$prodctImgPath	=	$prodImgRow['main_img_path'];
					}
				}
				$prdctId		=	base64_encode($prodctRow['spec_id']);
				$haskkey		=	md5($prodctRow['name']);
				$prdctPrce		=	round($prodctRow['prod_price'],2);
				$prdctdisPer	=	$prodctRow['prod_discount'];
				$prdctDis		=	(($prdctPrce * $prdctdisPer)/100);
				if($prdctDis > 0)
				{
					$prdctDisPrice	=	round(($prdctPrce - $prdctDis),2);
					$prodctActualPrice	=	'<strike>Rs. '.$prdctPrce.'</strike><br />Rs. '.$prdctDisPrice;
				}
				else
				{
					$prodctActualPrice	=	'Rs.'.$prdctPrce;
				}
				$prod_Name	=	substr($prodctRow['name'],0,12);
				$msg .="<table class='prodListView'><tr><td><a href='productDetails.php?prodct=$prdctId&hashKey=$haskkey'>";
				$msg .="<table style='float:left;width:175px;margin:5px'>";
				$msg .="<tr>";
				$msg .="<td colspan='2'><img src='images/products/$prodctImgPath' style='width:175px;height:175px' alt=''/></td>";
				$msg .="</tr>";
				$msg .="<tr>";
				$msg .="<td style='float:left;width:100px;text-align:left'>".$prod_Name."</td>";
				$msg .="<td style='float:left;width:70px;text-align:right'>".$prodctActualPrice."</td>";
				$msg .="</tr>";
				$msg .="</table></a>";
				$msg .="</td></tr></table>";
			}
		}
		else{
			$msg .="<table style='width:670px;margin:5px 0 5px 0'><tr><td style='text-align:center'>No Items Found</td></tr></table>";
		}
	}
	$msg .="</li></ul></div>";
	/* **************************************** Query To Get Total Count Of result *********************************/
	$query_pag_num 	= 	"SELECT products.prod_id FROM products 
						LEFT OUTER JOIN prodct_images ON products.prod_id=prodct_images.prodct_id
						INNER JOIN prod_specification ON products.prod_id=prod_specification.prod_id
						WHERE $prodWhre";
	$stmt 			= 	mysql_query($query_pag_num);
	$count 			=	mysql_num_rows($stmt);
	$no_of_paginations = ceil($count / $per_page);
	if($no_of_paginations > 0)
	{
		/************************************* Calculating the starting and endign values for the page ******************************************/
		if ($cur_page >= 7) 
		{
			$start_loop = $cur_page - 3;
			if ($no_of_paginations > $cur_page + 3)
				$end_loop = $cur_page + 3;
			else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) 
			{
				$start_loop = $no_of_paginations - 6;
				$end_loop = $no_of_paginations;
			} 
			else 
			{
				$end_loop = $no_of_paginations;
			}
		} 
		else 
		{
			$start_loop = 1;
			if ($no_of_paginations > 3)
				$end_loop = 3;
			else
				$end_loop = $no_of_paginations;
		}
			
		$msg .= "<div class='paginationDiv'><ul>";

		//***************************** Enable First Button ************************************//
		if ($first_btn && $cur_page > 1) 
		{
			$msg .= "<li p='1' class='active'>First</li>";
		} 
		else if ($first_btn) 
		{
			$msg .= "<li p='1' class='inactive'>First</li>";
		}

		//**************************** Enable Previous Button *********************************//
		if ($previous_btn && $cur_page > 1) 
		{
			$pre = $cur_page - 1;
			$msg .= "<li p='$pre' class='active'>Pre</li>";
		} 
		else if ($previous_btn) 
		{
			$msg .= "<li class='inactive'>Pre</li>";
		}
		for ($i = $cur_page; $i <= $cur_page; $i++) 
		{
			if ($cur_page == $i)
				$msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
			else
				$msg .= "<li p='$i' class='active'>{$i}</li>";
		}

		//**************************** Enable Next Button *********************************//
		if ($next_btn && $cur_page < $no_of_paginations) 
		{
			$nex = $cur_page + 1;
			$msg .= "<li p='$nex' class='active'>Next</li>";
		} else if ($next_btn) 
		{
			$msg .= "<li class='inactive'>Next</li>";
		}
		//**************************** Enable Last Button *********************************//
		if ($last_btn && $cur_page < $no_of_paginations) 
		{
			$msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
		} else if ($last_btn) 
		{
			$msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
		}
		$msg = $msg . "</ul>";
	}
	echo $msg;
?>