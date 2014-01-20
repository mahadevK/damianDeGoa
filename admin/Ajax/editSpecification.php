<?php
	require_once ("../library/config.php");
	$proD 			= 	stripslashes($_POST['proD']);
	$prodPrice 		= 	stripslashes($_POST['prodPrice']);
	$matRial 		= 	stripslashes($_POST['matRial']);
	$siZe 			= 	stripslashes($_POST['siZe']);
	$prodcode 		= 	stripslashes($_POST['prodcode']);
	$prodAvalbty 	= 	stripslashes($_POST['prodAvalbty']);
	$prodDiscnt		=	stripslashes($_POST['prodDiscnt']);
	$prodHght		=	stripslashes($_POST['prodHght']);
	$prodWdth		=	stripslashes($_POST['prodWdth']);
	$prodWeight		=	stripslashes($_POST['prodWeight']);
	$prodBth		=	stripslashes($_POST['prodBth']);
	$prodStck		=	stripslashes($_POST['prodStck']);
	$specId			=	stripslashes($_POST['specId']);
	$dimnUnit		=	stripslashes($_POST['dimnUnit']);
	$dimnUnit2		=	stripslashes($_POST['dimnUnit2']);
	$dimnUnit4		=	stripslashes($_POST['dimnUnit4']);
	$weightUnit		=	stripslashes($_POST['weightUnit']);
	$tagval			=	$_POST['tagval'];
	$counttag		=	$_POST['counttag'];
	$prodWeghtVal	=	$prodWeight.' '.$weightUnit;
	$prodWdthVal	=	$prodWdth.' '.$dimnUnit;
	$prodBdthVal	=	$prodBth.' '.$dimnUnit4;
	$prodHghtVal	=	$prodHght.' '.$dimnUnit2;
	$del_flag	=	0;
	
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
	$UpdatedDte	=	date('Y-m-d G:i:s');
	$updateDte	=	'0000-00-00 0:0:0';
		
	$specSql 	=	"UPDATE prod_specification SET 	prod_id			=	$proD,
													spec_code		=	'".$prodcode."',
													prod_price		=	'".$prodPrice."',
													prod_discount	=	'".$prodDiscnt."',
													availibilty		=	'".$prodAvalbty."',
													stock			=	'".$prodStck."',
													prod_height		=	'".$prodHghtVal."',
													prod_width		=	'".$prodWdthVal."',
													prod_breadth	=	'".$prodBdthVal."',
													prod_weight		=	'".$prodWeghtVal."',
													size_id			=	'".$siZeId."',
													material_id		=	'".$matRialId."',
													updated_date	=	'".$UpdatedDte."',
													available_stock	=	'".$prodStck."'
													WHERE spec_id	=	'".$specId."'";
	$specStmnt = 	mysql_query($specSql);
	
	$tagsarr= array();
	$tagquery="select spec_vs_tags.tag_id as tid,tags.tag_name as tname from tags
				inner join spec_vs_tags on 	spec_vs_tags.tag_id=tags.id where
			   spec_vs_tags.spec_id=$specId and spec_vs_tags.del_flag=0	and tags.del_flag=0	";
			   
	$tagStmnt	=	mysql_query($tagquery);
	while ($rows = mysql_fetch_assoc($tagStmnt)) {
		$tname		=	$rows['tname'];
		$tagsarr[]	=	$rows['tid'];
	}
		if($counttag!=0)
		{
			/* if($counttag==1)
			{
				if(!in_array($tagval,$tagsarr))
				{
				 $tags="update spec_vs_tags set tag_id=:tagId  where spec_id=:SPECTID ";
					$tStmnt	=	$dbh->prepare($tags);
					$tStmnt->bindParam(':SPECTID',$specId);
					$tStmnt->bindParam(':tagId', $tagval);
					$tStmnt->execute();				 
				}
	
	
			}
			else
			{ */
			$tagarr=array();
			$newtagsDel=array();
			$newtagsIns=array();
		
			 $tagarr			=	explode(",", $tagval);
			
				$newtagsDel		=	array_diff($tagsarr,$tagarr);
				$newtagsIns		=	array_diff($tagarr,$tagsarr);
				
				
/* 				echo"<PRE>";
				print_r($newtagsDel);
				*/
				echo"<PRE>";
				print_r($newtagsIns); 
				foreach($newtagsDel as $val)
				{
				
					 if($val!=0 || $val!="")
				 {
					$deltag="update spec_vs_tags set del_flag=1  where spec_id=$specId and tag_id=$val";
					$delStmnt	=	mysql_query($deltag);
				}
				}
				foreach($newtagsIns as $value)
				{
				 
				 if($value!=0 || $value!="")
				 {
				
					$sqltag	=	"INSERT into spec_vs_tags(tag_id,spec_id) values($value,$specId)";
					$tagStmnt =  mysql_query($sqltag);
				}		
				}
				
			
			//}
		}
?>	