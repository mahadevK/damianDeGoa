<?php
	if($_POST['page'])
	{
		require_once('../../library/config.php');
		$del_flag		=	0;
		$page 			= 	$_POST['page'];
		$catSel 		= 	$_POST['catSel'];
		$ProdName 		= 	$_POST['ProdName'];
		$prodWhre		=	"products.del_flag=0";
		if($catSel	!= "")
		{
			$prodWhre	.=	" AND products.cat_id=$catSel";
		}
		if($ProdName != "")
		{
			$prodWhre	.=	" AND products.name like '%".$ProdName."%' ";
		}
		$cur_page 		= 	$page;
		$page -= 	1;
		$per_page 		= 	15;
		$previous_btn 	= 	true;
		$next_btn 		= 	true;
		$first_btn 		= 	true;
		$last_btn 		= 	true;
		$start 			= 	$page * $per_page;
		$msg 			= 	"";
		$sql	= 	"SELECT category.cat_name,products.name,products.stock_code,products.prod_id,prodct_images.main_img_path
					FROM products 
					INNER JOIN category ON products.cat_id=category.cat_id
					INNER JOIN prodct_images ON products.prod_id=prodct_images.prodct_id
					WHERE $prodWhre ORDER BY prod_id  LIMIT $start, $per_page";
		$stmt 	= 	mysql_query($sql);
		$nRows	=	mysql_num_rows($stmt);
		$pageCnt = 0;
		$msg .= "<div id='productsReslt2'>";
		if ($nRows > 0) {
			while ($row = mysql_fetch_assoc($stmt)) {
				$pageCnt	=	$pageCnt + 1;
				$proMainImgPath	=	'default.png';
				if($row['main_img_path'] != "")
				{
					$proMainImgPath	=	$row['main_img_path'];
				}
				$prodctName		=	$row['name'];
				$stockCode		=	$row['stock_code'];
				$CatgName		=	$row['cat_name'];
				$prod_id	=	$row['prod_id'];
				$haskkey	=	md5($prod_id);
				$msg .= "<table style='float:left;width:30%;margin:0 0 2% 3%;border:1px solid #000'><tr>";
				$msg .= "<td style='float:left;width:37%;padding:1%'>				
							<img src='../images/products/$proMainImgPath' alt='' style='width:100%;height:120px'/>
						</td>";
				$msg .= "<td style='float:left;width:60%;text-align:left'>
							<table style='float:left;width:100%'><tr>
								<td style='float:left;width:100%;font-size:16px;color:#AAE5ED'><a href='productDetail.php?prod=".base64_encode($prod_id)."&".$haskkey."'><b><u>$prodctName</u></b></a></td>
								</tr>";
				$msg .= "		<tr height='10px'></tr>";
				$msg .= "		<tr><td colspan='2' style='width:100%'>
									<table style='float:left;width;100%'><tr>
										<td style='width:100%px;float:left'> Category : $CatgName</td></tr>";
				$msg .=	"					<tr>
										<td style='width:100%px;float:left'>Stock Code : $stockCode</td></tr>";
				$msg .= "</table></td></tr></table></td>";
				$msg .= "</tr><tr><td style='float:left;width:99.2%;background:#D9D9D9;'></td></tr>";
				$msg .= "<tr>
							<td style='float:left;width:99%;text-align:right'>
							<a href='editProduct.php?prod=".base64_encode($prod_id)."&".$haskkey."'><img src='images/modify.gif' alt='' /></a>
							 / <a href='javascript:void(0)' onclick='return delProdct(".$prod_id.")'><img src='images/delete.gif' alit='' /></a></td></tr>";
				$msg .= "</table>";
			}
		}
		else
		{
			$msg .= "No Records Found";
		}
		$msg .= "</div>";
		$msg = $msg;
		

		/* **************************************** Query To Get Total Count Of result *********************************/
		$query_pag_num 		= 	"SELECT products.prod_id
								FROM products 
								INNER JOIN category ON products.cat_id=category.cat_id
								INNER JOIN prodct_images ON products.prod_id=prodct_images.prodct_id
								WHERE $prodWhre";
		$RES 				=	mysql_query($query_pag_num);
		$count				=	mysql_num_rows($RES);
		$no_of_paginations 	= 	ceil($count / $per_page);
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
			
			$msg .= "<div class='prodVewPagn'><ul>";

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
	}

?>