<?php
	function catGQuery()
	{
		$catSql	=	"SELECT cat_name,cat_id FROM category WHERE del_flag=0";
		$catRes	=	mysql_query($catSql);
		return $catRes;
	}
	function prodQuery($spefId)
	{
		$prodctSql	=	"SELECT products.name,products.prod_id,prod_specification.prod_price,products.prod_code,
							products.prod_descrptn,prod_specification.prod_discount,prod_specification.availibilty,
							prod_specification.stock, prod_specification.prod_height, prod_specification.material_id, prod_specification.prod_width, prod_specification.size_id, prod_specification.available_stock,category.cat_name, material.name
						FROM products
						INNER JOIN prod_specification ON products.prod_id = prod_specification.prod_id
						INNER JOIN material ON material.id = prod_specification.material_id
						INNER JOIN category ON products.cat_id = category.cat_id
						WHERE products.del_flag=0 AND prod_specification.spec_id=$spefId";
		$prodctRes	=	mysql_query($prodctSql);
		return $prodctRes;
	}
	function prodImgQuery($productId)
	{
		$prodImgSql		=	"SELECT main_img_path,front_img_path,back_img_path,side_img_path FROM prodct_images WHERE prodct_id=$productId";
		$prodImgStmnt	=	mysql_query($prodImgSql);
		return $prodImgStmnt;
	}
?>