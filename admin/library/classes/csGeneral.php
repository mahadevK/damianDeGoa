<?php	/**
	 * General Class 
	 * 
	 */
	class general {		function getFormField($formField)				{			$formField=trim($formField);			if(get_magic_quotes_gpc()==1)			{				return $formField;			}			else 			{				return addslashes($formField);			}		}		function fillDDl($table, $sub_query='',$selectedIndex=0)		{			$link=$GLOBALS['link'];			$query = "SELECT $table[value], $table[option]  FROM $table[name] "; 			if ($sub_query) {				$query .= $sub_query;			}			$result = mysql_query($query);			while ($res = mysql_fetch_row($result)) 			{  				$selected="";				if($selectedIndex==$res[0])				{					$selected=" selected ";				}				$option .= "<option value=\"$res[0]\" $selected >$res[1]</option>\n";			}			return $option;		}		function encrypt($string, $key)		{			$result = "";			for($i=0; $i<strlen($string); $i++)			{				$char = substr($string, $i, 1);				$keychar = substr($key, ($i % strlen($key))-1, 1);				$char = chr(ord($char)+ord($keychar));				$result.=$char;			}			return base64_encode($result);		}		function decrypt($string, $key)		{			$result = "";			$string = base64_decode($string);			for($i=0; $i<strlen($string); $i++)			{				$char = substr($string, $i, 1);				$keychar = substr($key, ($i % strlen($key))-1, 1);				$char = chr(ord($char)-ord($keychar));				$result.=$char;			}			return $result;		}		function getPK($tableName,$columnName)		{			$link=$GLOBALS['link'];			$strQry="select coalesce(max(".$columnName."),0)+1 as PK from ".$tableName;			$result=mysql_query($strQry,$link);			$row=mysql_fetch_array($result);			return $row[0];		}	}?>