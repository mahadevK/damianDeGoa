<?php	 	
	function outletQuery($userId){
		$query 	=	"SELECT name,id FROM `outlets` WHERE added_by = '".$userId."' AND del_flag=0";
		$row 	= 	mysql_query($query);
		return $row;
	}
	function roleQuery($userId){
		$query 	=	"SELECT role,id FROM `roles` WHERE added_by = '".$userId."' AND del_flag=0";
		$row 	= 	mysql_query($query);
		return $row;
	}
	function userQuery($userId){
		$query 	=	"SELECT user_name,username,user_emailid,user_contactno,user_address,user_country,user_state,user_city,pin_code,role_id,
					outlet_id
					FROM `users` WHERE userId = '".$userId."' AND del_flag=0";
		$row 	= 	mysql_query($query);
		return $row;
	}
	function categQuery($userId){
		$query 	=	"SELECT cat_name,cat_id
					FROM `category` WHERE added_by = '".$userId."' AND del_flag=0";
		$row 	= 	mysql_query($query);
		return $row;
	}
	function getProductQuery($productId){
		$productSql	=	"SELECT products.name,products.prod_descrptn,products.cat_id,products.stock_code,
						prodct_images.main_img_path,prodct_images.front_img_path,prodct_images.back_img_path,prodct_images.side_img_path
						FROM  products
						INNER JOIN prodct_images ON products.prod_id=prodct_images.prodct_id
						WHERE products.del_flag=0 AND products.prod_id=$productId";
		$stmnt		=	mysql_query($productSql);
		return $stmnt;
	}
	function getProductDet($prodID)
	{
		$sql	= 	"SELECT category.cat_name,products.name,products.stock_code,products.prod_descrptn,
				prodct_images.main_img_path,products.prod_code
				FROM products 
				INNER JOIN category ON products.cat_id=category.cat_id
				INNER JOIN prodct_images ON products.prod_id=prodct_images.prodct_id
				WHERE products.del_flag=0 AND products.prod_id=$prodID";
		$stmt 	= 	mysql_query($sql);
		return $stmt;
	}
	function prodQuery($userId)
	{
		$proDSql	=	"SELECT prod_id,name FROM products WHERE del_flag=0 AND added_by=$userId";
		$queryRes	=	mysql_query($proDSql);
		return $queryRes;
	}
	function updateProdImg($prod_main_img,$prod_frnt_img,$prod_bck_img,$prod_sde_img,$prodID)
	{
		$prodImgSql		=	"UPDATE prodct_images SET main_img_path='".$prod_main_img."',front_img_path='".$prod_frnt_img."',
								back_img_path='".$prod_bck_img."',side_img_path='".$prod_sde_img."'
							WHERE prodct_id=$prodID";
		$prodImgStmnt	=	mysql_query($prodImgSql);
	}
	function updateProduct($prod_name,$prod_descrptn,$catGId,$stock_code,$updateDte,$prodID)
	{
		$prodCtSql		=	"UPDATE products SET name='".$prod_name."',prod_descrptn='".$prod_descrptn."',cat_id='".$catGId."',
							stock_code='".$stock_code."',updated_date='".$updateDte."'
							WHERE prod_id='".$prodID."'";
		$prodCtStmnt	=	mysql_query($prodCtSql);
	}
	function addCategory($catGOthr,$userId,$date)
	{
		$othrCatGsql	=	"INSERT INTO category (cat_name,added_by,added_date,updated_date,del_flag) 
								VALUES('".$catGOthr."','".$userId."','".$date."','".$date."',0)";
		$othrCatGstmnt	=	mysql_query($othrCatGsql);
			
		$catGId = mysql_insert_id();
		return $catGId;
	}
	function tagQuery($userId)
	{
		$tagsQuery	=	"SELECT id,tag_name from tags where del_flag=0 AND added_by=$userId";
		$tagsRes	=	mysql_query($tagsQuery);
		return $tagsRes;
	}
	function matrialQuery()
	{
		$matRialSql		=	"SELECT id,name FROM material WHERE del_flag=0";
		$matrialRes		=	mysql_query($matRialSql);
		return $matrialRes;
	}
	function sizeQuery()
	{
		$siZeSql	=	"SELECT id,size FROM sizes WHERE del_flag=0";
		$sizeRes	=	mysql_query($siZeSql);
		return $sizeRes;
	}
	function unitQuery($unitFor)
	{
		$unitSel1	=	"SELECT unit FROM unit WHERE unit_for=$unitFor AND del_flag=0";
		$unitRes	=	mysql_query($unitSel1);
		return $unitRes;
	}
	function specQueRy($specId)
	{
		$specQuery	=	"SELECT prod_id,prod_price,spec_code,prod_discount,availibilty,stock,prod_height,
							prod_width,prod_breadth,prod_weight,size_id,material_id
						FROM prod_specification
						WHERE spec_id=$specId";
		$specRslt	=	mysql_query($specQuery);
		return $specRslt;
	}
	function customerQuery($customerId)
	{
		$custQry	=	"SELECT name,address,country,state,city,pincode,emailid,contactno FROM customer WHERE del_flag=0 AND id=$customerId";
		$custRes	=	mysql_query($custQry);
		return $custRes;
	}
	function getTaxQry()
	{
		$taxQry	=	"SELECT tax_name,id FROM taxmaster WHERE del_flag=0";
		$taxRes	=	mysql_query($taxQry);
		return $taxRes;
	}	
	function taxResQry($taxId)
	{
		$taxResQry	=	"SELECT tax_id,tax_amount FROM tax WHERE id=$taxId";
		$taxResStmt	=	mysql_query($taxResQry);
		return $taxResStmt;
	}
	function getAllCustomer()
	{
		$custQry2	=	"SELECT name,id FROM customer WHERE del_flag=0";
		$custRes2	=	mysql_query($custQry2);
		return $custRes2;
	}
?>