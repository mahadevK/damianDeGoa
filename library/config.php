<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="damiandegoa"; // Database name  
/* 
 $host="localhost"; // Host name 
$username="karbensc_mahadev"; // Mysql username 
$password="U#B}cdvhwck}"; // Mysql password 
$db_name="karbensc_damiandegoa"; // Database name   */


// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
?>