<?php
	if($_POST['page'])
	{
		require_once('../../library/config.php');
		session_start();
		$userId			=	$_SESSION['userId'];
		$page 			= 	$_POST['page'];
		$cur_page 		= 	$page;
		$page -= 	1;
		$per_page 		= 	20;
		$previous_btn 	= 	true;
		$next_btn 		= 	true;
		$first_btn 		= 	true;
		$last_btn 		= 	true;
		$start 			= 	$page * $per_page;
		$msg 			= 	"";
		$del_flag		=	0;
		$prodAvailble	=	0;
		$sql	=	"SELECT name,city,pincode,emailid,contactno,id
					FROM customer 
					WHERE del_flag=0 AND added_by =$userId ORDER BY id LIMIT $per_page OFFSET $start";
		$stmt 	= 	mysql_query($sql);
		
		$pageCnt = 0;
		$msg .=	"<div id='leftHeader'></div><div id='centerHeader2' style='width:97%'>";
		$msg .=	"<table style='margin:.8% 0 0 0;width:100%'><tr>
				<td width='20%' align='center'><b>Name</b></td>
				<td width='20%' align='center'><b>City</b></td>
				<td width='20%' align='center'><b>Pin Code</b></td>
				<td width='18%' align='center'><b>Email</b></td>
				<td width='15%' align='center'><b>Contact No</b></td>
				<td width='7%' align='center'><b>Select</b></td></tr></table></div>
				<div id='rightHeader'></div>";
		$msg .= "<div id='customerResult2'><table style='margin-left:0;width:100%'>";
		if (mysql_num_rows($stmt) > 0) {
			while ($row = mysql_fetch_array($stmt)) {
				$pageCnt	=	$pageCnt + 1;
				$name		=	$row['name'];
				$emailId	=	$row['emailid'];
				$contactNo	=	$row['contactno'];
				$city		=	$row['city'];
				$pincode	=	$row['pincode'];
				$custId		=	$row['id'];
				$msg .= "<tr>";
				$msg .= "<td style='width:20%;text-align:center'>".$name."</td>";
				$msg .= "<td style='width:20%;text-align:center'>".$city."</td>";
				$msg .= "<td style='width:20%;text-align:center'>".$pincode."</td>";
				$msg .= "<td style='width:18%;text-align:center'>".$emailId."</td>";
				$msg .= "<td style='width:15%;text-align:center'>".$contactNo."</td>";
				$msg .= "<td style='width:7%;text-align:center'>
							<input type='radio' name='extCustSel' id='extCustSel' value='".$custId."' />
						</td>";
				$msg .= "</tr><tr height='10px'></tr>";	
			}
		}
		else
		{
			$msg .= "<tr><td colspan='2' align='center'>No Records Found</td></tr>";
		}
		$msg .= "</table></div>";
		$msg = $msg;
		

		/* **************************************** Query To Get Total Count Of result *********************************/
		$query_pag_num 		= 	"SELECT id FROM customer 
								WHERE del_flag=0 AND added_by =$userId";
		$queryRow 			=	mysql_query($query_pag_num);
		$count				=	mysql_num_rows($queryRow);
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
			
			$msg .= "<div class='customerListPagn'><ul>";

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
			$msg = $msg . "</ul></div>";
		}
		if (mysql_num_rows($stmt) > 0) {
			$msg .= "<ul style='width:90px;margin:25px 0 0 0px;float:right'><li><input type='button' name='nextFlow' value='Next Step' onclick='return nextOrdrFlow()'/></li></ul>";
		}
		echo $msg;
	}

?>