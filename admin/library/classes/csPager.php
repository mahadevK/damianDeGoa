<?php
/*
-Programme Developed by Roem Technologies Goa.
-Disclaimer: Company does not hold any responsibility for any change in the code other than ROEM Employee's.
*/
/**
 * Paging the records from a table
 *
 */
class pager
{
	/**
	 * Sql query for which records are generated
	 *
	 * @var string
	 */
    var $sql;
    /**
     * Query string parameter name
     *
     * @var string
     */
    var $getvar;
    var $rows;
    var $start;
    var $getvar_val;
    var $pager;
    var $result;
    /**
     * Constructor for pager class
     *
     * @param string $sql
     * @param string $getvar
     * @param string $length
     */
    function __construct($sql,$getvar,$length)
    {
        $this->result=null;
        $this->sql = $sql;
        $this->getvar = $getvar;
        $this->rows = 0;
        $this->start = 0;
        $this->getvar_val = 1;
        $this->pager = null;
        $this->SetLength($length);
        $this->GetStart();
        $this->doQuery();
    }
    //Sets $length
    /**
     * Sets length for the results
     *
     * @param integer $length
     */
  function SetLength($length)
  {
      $this->length = (int)$length;
      if($this->length<0)
      {
          $this->length = 0;
      }
  }
  
  /**
   * Query the table
   *
   */
  function doQuery()
  {
      $sql = trim($this->sql);
      $sql = substr($sql,6);
      $sql = 'SELECT SQL_CALC_FOUND_ROWS '.$sql.' limit '.$this->start.', '.$this->length;
      $this->result = mysql_query($sql);
      $sql = "SELECT FOUND_ROWS()";
      $result = mysql_query($sql);
      $this->rows = mysql_result($result,0);
  }
  
  //getvar_val() gets the
  //$getvar_val is a positive integer - > 0
  function Set_Getvar_val()
  {
      $this->getvar_val = (int)$_GET[$this->getvar];
      if($this->getvar_val<1)
      {
          $this->getvar_val = 1;
      }
  }

  //Gets the start of the data
  function GetStart()
  {
      $this->Set_Getvar_val();
      $this->start = (($this->getvar_val-1)*$this->length);
  }
  /**
   * Shows the pager in browser
   *
   * @param string $next
   * @param string $last
   * @param string $separator
   * @return string
   */
    function show($next="&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;",$last="&nbsp;&nbsp;&nbsp;<&nbsp;&nbsp;&nbsp;",$separator=" ",$boldCurrent=0)
    {
        $array = $this->pager();
        $str = array();
        foreach($array as $k => $v)
        {
		
            if($k!='next'&&$k!='last')
            {
                if(($k==$this->getvar_val) and ($boldCurrent==0))
                {
                    $str[] = "<font style='color:#ad925b;margin-left:6px;margin-right:6px;'>".$k."</font>";
                }
                else
                {
				    $submitPage=$this->getCurrentUrl()."=".$k;
                    //$str[] = '<a href="'.$v.'">'.$k.'</a>';
					$str[] = "<a href=javascript:pagerSubmit(\"".$submitPage."\");>".$k."</a>";
                }
            }
        }
		 $currentPage = $this->start / $this->length + 1;
        $str = implode($separator, $str);
        $rt = $array['last']===null?"":"<a href=javascript:pagerSubmit(\"".$this->getCurrentUrl()."=".( $currentPage-1)."\");>".$last."</a>".$separator;
        $rt .= $str.$separator;
        $rt .= $array['next']===null?"":"<a href=javascript:pagerSubmit(\"".$this->getCurrentUrl()."=".( $currentPage+1)."\");>".$next."</a>";
		$currentPage=$this->start / $this->length + 1;
		//$rt .= "<font style='font-weight:normal;font-size:10px;color:#000;'>Page <input type='text' style='width:20px;text-align:center;font-size:10px;' class='textbox' value='".($currentPage)."' name='txtTablePager'  id='txtTablePager'  onkeypress='return pagerSubmit(event,\"".$this->getCurrentUrl()."\",this,".(ceil(($this->rows/$this->length))).");' maxlength='4' > of ".(ceil(($this->rows/$this->length)))." pages</font>";
	  return $rt;

    }
    function getCurrentUrl()
	{
		$path = $_GET;
		$newpath = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1)."?";
		foreach($path as $key => $value)
		{
			if($key!=$this->getvar)
			{
				$newpath .= $key."=".$value;
				$newpath .="&amp;";
			}
		}
		$newpath .= $this->getvar;
		return   $newpath;
	}
     //Returns an array of the links arround the given point
    //['next'] => next page
    //['last'] => last page
    function pager($margin=10)
    {
        $path = $_GET;
        $newpath = $PHP_SELF."?";
        foreach($path as $key => $value)
        {
            if($key!=$this->getvar)
            {
                $newpath .= $key."=".$value;
                $newpath .="&amp;";
            }
        }
        $newpath .= $this->getvar;

        $linkpaths = array();
        $current = $this->start / $this->length + 1;
        $pages = ceil(($this->rows/$this->length));
        $pagerstart = $current-$margin;
        $pagerstart = ($pagerstart<1)?1:$pagerstart;
        $pagerend = $current+$margin;
		
        // echo "//".$current."//".$pagerstart." // ".$pagerend;
		// if($margin>25)
		// {
			// $pagerstart=$current;
			// $pagerend=25;			
		// }
        $pagerend = ( $pagerend > $pages ) ? ( ceil( ( $this->rows / $this->length ) ) ): $pagerend;

        for($i=$pagerstart;$i < ($pagerend+1);$i++)
        {
            $linkpaths[$i] = $newpath."=".($i);
        }
        if($linkpaths[($current+1)]!=null)
        {
            $linkpaths['next']=$linkpaths[($current+1)];
        }
        if($linkpaths[($current-1)]!=null)
        {
            $linkpaths['last']=$linkpaths[($current-1)];
        }
		 
        return $linkpaths;
    }
}
?>
