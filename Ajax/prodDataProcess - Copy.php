<ul>
<?
	require_once ("../library/config.php");
	$catSel		=	$_POST['catSel'];
	$prodName	=	$_POST['prodName'];
	$del_flag	=	0;
	$catWhre	=	"del_flag=0";
	if($catSel != "")
	{
		$catWhre .= " AND cat_id=$catSel";
	}
	$catSql		=	"SELECT cat_name,cat_id FROM category WHERE $catWhre";
	$catStmnt3	=	mysql_query($catSql);
	while ($catRow3 = mysql_fetch_assoc($catStmnt3)) { 
		$catId		=	base64_encode($catRow3['cat_id']);
		$haskKey	=	md5($catRow3['cat_name']);
?>
		<li style="float:left;margin:0 0 0 0;width:20px;">
			<img src="images/arrows.png" alt=""/>
		</li>
		<li style="float:left;margin:0 0 0 0;width:615px;color:blue">
			<? echo $catRow3['cat_name']; ?>
		</li>
		<li style="float:left;margin:0 0 0 0;width:65px;">
			<a href="allProducts.php?catgry=<?echo $catId;?>&haskKey=<? echo $haskKey?>">View More</a>
		</li>
		<li style="float:left;margin:0 0 0 0;width:20px;color:blue">
			<img src="images/arrows.png" alt=""/></a>
		</li>
		<li style="float:left;margin:15px 0 15px 0;width:715px;border:1px solid #D9D9D9">
<?
		$prodAvailble	=	0;
		$del_flag		=	0;
		$catgId			=	$catRow3['cat_id'];
		$prodWhre		=	"products.del_flag=0 AND products.cat_id=$catgId
							AND prod_specification.availibilty=$prodAvailble";
		if($prodName != "")
		{
			$prodWhre	.=	" AND products.name like '%".$prodName."%' ";
		}
		
		$prodctSql		=	"select products.name,products.prod_id,products.prod_descrptn,
						        prod_specification.prod_price,prod_specification.prod_discount,prod_specification.spec_id,
						        prodct_images.main_img_path
							FROM products 
							INNER JOIN prod_specification on products.prod_id=prod_specification.prod_id
							LEFT OUTER JOIN prodct_images ON products.prod_id=prodct_images.prodct_id
							WHERE $prodWhre GROUP BY(prod_specification.prod_id) LIMIT 3";
		$prodctStmnt	=	mysql_query($prodctSql);
		if (mysql_num_rows($prodctStmnt) > 0) {
			while ($prodctRow = mysql_fetch_assoc($prodctStmnt)) {
				$productId		=	$prodctRow['prod_id'];
				$prodctImgPath	=	'default.png';
				if($prodctRow['main_img_path'] == "")
				{
					$prodctImgPath	=	'default.png';
				}
				else
				{
					$prodctImgPath	=	$prodctRow['main_img_path'];
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
				$prod_Name	=	substr($prodctRow['name'],0,17);
		?>
				<table class="prodListView"><tr><td>
					<a href="productDetails.php?prodct=<?echo $prdctId?>&hashKey=<?echo $haskkey?>">
					<table style="float:left;width:175px;margin:5px">
						<tr>
							<td colspan="2"><img src="images/products/<?echo $prodctImgPath;?>" style="width:175px;height:175px" alt=""/></td>
						</tr>
						<tr>
							<td style="float:left;width:100px;text-align:left;color:#000"><?echo $prod_Name;?></td>
							<td style="float:left;width:70px;text-align:right;color:#000"><?echo $prodctActualPrice;?></td>
						</tr>
					</table></a>
				</td></tr></table>
	<?		} 
		}
		else
		{
	?>
			<table style="width:670px;margin:5px 0 5px 0"><tr><td style="text-align:center">No Items Found</td></tr></table>
	<?
		}
	?>
		</li>
	<?
		}	
	?>
</ul>