<?php
/**
 * This class used for zip related functions
 * 
 */
 class csZip
 {
	//update user print in zip format
	function downloadPrintZip($userid=0)
	{
		$link=$GLOBALS['link'];
		//get user details
		$strUserQry="select user_name,fname,lname from user_mas where del_flag=0 and user_id=".$userid;
		 $resultuser=mysql_query($strUserQry,$link);
		 $username="";
		 $userUid="";
		  while($rowuser=mysql_fetch_array($resultuser))
		 {
		     $username=$rowuser["fname"] ." " .$rowuser["lname"];
		     $userUid=$rowuser["user_name"];
		 }
		 $userUid=strtolower( $userUid);
		 $username=strtolower($username);
		 if( $userUid=="")
		 {
		  exit;
		 }
		 else
		 {
		   if(!is_dir("downloads/".$userUid)) //Check whether Year folder exists
			{
			 	mkdir("downloads/".$userUid,0777 ); //Create folder with 0777 permission
			}
		 }
		$zip = new ZipArchive();
		$filename = "downloads/".$userUid."/".$username."_prints.zip";
		if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
		   exit("cannot open <".$filename.">\n");
		}
		$strQry="select print_id,print_key,print_filename,print_filepath,print_title from tms_tmp.print_mas where  print_approvedstatus=1 and active_flag=0 and del_flag=0 and added_by=".$userid;
		$result=mysql_query($strQry,$link);
		$printTitle="";
		$filesCount=0;
		 while($row=mysql_fetch_array($result))
		 {
			$ext = substr($row["print_filename"], strrpos($row["print_filename"], '.') + 1);	
		    $printTitle=$row["print_title"]."_".$row["print_key"].".".$ext;
			if(file_exists($row["print_filepath"]."/".$row["print_filename"]))
			{
				$filesCount=$filesCount+1;
			    $zip->addFile($row["print_filepath"]."/".$row["print_filename"], "$printTitle");
			    $zip->renameName($row["print_filename"], $printTitle);
			}
		}
		$zip->close();
		if($filesCount>0)
		{
		  $this->zipFileDownload($filename);
		 return 	$filename;
		}
		else
		{
		 return "";
		}
		 return "";
	}
	function zipFileDownload($filepath)
	{
	   header("location:download.php?file=".$filepath);
	}
 }
?>
