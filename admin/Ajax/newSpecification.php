<?php
	require_once ("../library/config.php");
	session_start();
	$proD 			= 	stripslashes($_POST['proD']);
	$prodPrice 		= 	stripslashes($_POST['prodPrice']);
	$matRial 		= 	stripslashes($_POST['matRial']);
	$siZe 			= 	stripslashes($_POST['siZe']);
	$prodAvalbty 	= 	stripslashes($_POST['prodAvalbty']);
	$prodDiscnt		=	stripslashes($_POST['prodDiscnt']);
	$prodHght		=	stripslashes($_POST['prodHght']);
	$prodWdth		=	stripslashes($_POST['prodWdth']);
	$prodBth		=	stripslashes($_POST['prodBth']);
	$prodWeight		=	stripslashes($_POST['prodWeight']);
	$prodStck		=	stripslashes($_POST['prodStck']);
	$dimnUnit		=	stripslashes($_POST['dimnUnit']);
	$dimnUnit1		=	stripslashes($_POST['dimnUnit1']);
	$dimnUnit2		=	stripslashes($_POST['dimnUnit2']);
	$weightUnit		=	stripslashes($_POST['weightUnit']);
	$prodcode		=	stripslashes($_POST['prodcode']);
	$tagval			=	$_POST['tagval'];
	$counttag		=	$_POST['counttag'];
	$prodWeghtVal	=	$prodWeight.' '.$weightUnit;
	$prodWdthVal	=	$prodWdth.' '.$dimnUnit;
	$prodBthVal		=	$prodBth.' '.$dimnUnit1;
	$prodHghtVal	=	$prodHght.' '.$dimnUnit2;
	$userId			=	$_SESSION['userId'];
	$date			=	date('Y-m-d');
	if($matRial	==	'9999')
	{
		/********************** Other Material Insert Query ******************************************/
		$matRialOthr 	= 	stripslashes($_POST['matRialOthr']);
		$delFlag		=	0;
		$othrMatsql		=	"INSERT INTO material(name,added_by,added_date,del_flag) 
							VALUES('".$matRialOthr."','".$userId."','".$date."','0')";
		$othrMatstmnt	=	mysql_query($othrMatsql);
		
		$matRialId = mysql_insert_id();
	}
	else{
		$matRialId	=	$matRial;
	}
	if($siZe	==	'9999')
	{
		/********************** Other Size Insert Query ******************************************/
		$siZeOthr 		= 	stripslashes($_POST['siZeOthr']);
		$delFlag		=	0;
		$othrSiZesql	=	"INSERT INTO sizes (size,added_by,added_date,del_flag) 
							VALUES('".$siZeOthr."','".$userId."','".$date."','0')";
		$othrSizstmnt	=	mysql_query($othrSiZesql);
		$siZeId 		= 	mysql_insert_id();
	}
	else{
		$siZeId	=	$siZe;
	}
	$checkSpecSql	=	"SELECT spec_id FROM prod_specification 
						WHERE (size_id='".$siZe."' AND prod_id='".$proD."' AND material_id='".$matRial."') OR ( spec_code='".$prodcode."') AND del_flag='0'";
	$checkSpecStmnt = 	mysql_query($checkSpecSql);
	$numRowCnt		=	mysql_num_rows($checkSpecStmnt);
	
	if($numRowCnt > 0)
	{
		echo "0";
	}
	else
	{
		$addedDte	=	date('Y-m-d G:i:s');
		$updateDte	=	'0000-00-00 0:0:0';

		echo $specSql 	=	"INSERT INTO prod_specification(prod_id,spec_code,prod_price,prod_discount,availibilty,stock,prod_height,prod_width,prod_breadth,prod_weight,size_id,material_id,added_date,updated_date,available_stock,added_by,del_flag) 
		VALUES ('".$proD."','".$prodcode."','".$prodPrice."','".$prodDiscnt."','".$prodAvalbty."','".$prodStck."','".$prodHghtVal."','".$prodWdthVal."','".$prodBthVal."','".$prodWeghtVal."','".$siZeId."','".$matRialId."','".$addedDte."','".$updateDte."','".$prodStck."','".$userId."','0')";
						
		$specStmnt 	= 	mysql_query($specSql);
		$specid 	=	mysql_insert_id();							
	
		if($counttag!=0)
		{
			if($counttag == 1)
			{
				$sqltag		=	"INSERT into spec_vs_tags(tag_id,spec_id) values('".$tagval."','".$specid."')";
				$tagStmnt 	=  mysql_query($sqltag);
			}
			else
			{
				$tagarr			=	explode(",", $tagval);
			 
				for($i=0;$i<$counttag;$i++)
				{
					$tagid 		= 	$tagarr[$i];
					$sqltag		=	"INSERT into spec_vs_tags(tag_id,spec_id) values('".$tagid."','".$specid."')";
					$tagStmnt 	=  mysql_query($sqltag);
				}
			}
		
		}
		echo "1";
	}
?>	