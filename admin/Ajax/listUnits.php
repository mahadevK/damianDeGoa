<?php
	if($_POST['page'])
	{
		require_once('../library/config.php');
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
		$sql	= 	"SELECT unit,id,unit_for FROM unit 
					WHERE del_flag=0 ORDER BY id LIMIT $per_page OFFSET $start";
		$stmt 	= 	mysql_query($sql);
		$pageCnt = 0;
		$msg .= "<div id='sizesReslt2'><table style='margin-left:16px'>";
		if (mysql_num_rows($stmt) > 0) {
			while ($row = mysql_fetch_assoc($stmt)) {
				$pageCnt	=	$pageCnt + 1;
				if($row['unit_for'] == 1){ $unitFor	=	'Diamension(width*breadth*height)';}else if($row['unit_for'] == 2){$unitFor	=	'Weight';}
				$msg .= "<tr>";
				$msg .= "<td style='width:230px;text-align:center'>".$row['unit']."</td>";
				$msg .= "<td style='width:200px;text-align:center'>".$unitFor."</td>";
				$msg .= "<td style='width:100px;text-align:center'>
						<a href='javascript:void(0)' onclick='return delUnit(".$row['id'].")'><img src='images/delete.gif' alit='' /></a></td>";
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
		$query_pag_num 		= 	"SELECT id FROM unit WHERE del_flag=0";
		$stmntQ 			=	mysql_query($query_pag_num);
		$count 				=	mysql_num_rows($stmntQ);
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
			
			$msg .= "<div class='unitVewPagn'><ul>";

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
			//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
			//$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
			//$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
			$msg = $msg . "</ul>";
		}
		echo $msg;
	}

?>