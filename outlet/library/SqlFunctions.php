<?php	 	
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
	function categQuery($userId){
		$query 	=	"SELECT cat_name,cat_id
					FROM `category` WHERE added_by = '".$userId."' AND del_flag=0";
		$row 	= 	mysql_query($query);
		return $row;
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
	function getCartCount($customerId)
	{
		$getCartProdSql	=	"SELECT id FROM temp_orders WHERE cust_id=$customerId AND del_flag=0";	
		$getCartProdRes	=	mysql_query($getCartProdSql);
		$cartCount		=	mysql_num_rows($getCartProdRes);
		return $cartCount;
	}
	function myCartData($customerId)
	{
		$mycartDataSql	=	"SELECT products.name,products.stock,temp_orders.item_qty,temp_orders.item_price,
							temp_orders.prod_id,prodct_images.main_img_path,temp_orders.id
							FROM temp_orders
							INNER JOIN products ON products.prod_id=temp_orders.prod_id
							INNER JOIN prodct_images ON products.prod_id=prodct_images.prodct_id
							WHERE temp_orders.cust_id=$customerId AND temp_orders.del_flag=0";
		$mycartDataRes	=	mysql_query($mycartDataSql);
		return $mycartDataRes;
	}
?>