<?php	
	session_start();
	function sessionStart($user,$pass){
		$query 	=	"SELECT user_name,username,password,userId FROM `users` WHERE username = '".$user."' AND password ='".md5($pass)."' AND del_flag=0";
		$row 	= 	mysql_query($query);
		if(mysql_num_rows($row)) { 
			$result = mysql_fetch_assoc($row);
			$_SESSION['userName']	=	$result["username"];
			$_SESSION['fullName']	=	$result["user_name"];
			$_SESSION['userPassw']	=	$result["password"];
			$_SESSION["userId"] 	= 	$result["userId"];
			$_SESSION["time"] 		= 	time();
			$error= "0";
		} else { 
			$error= "1";
		}
		return $error;
	}

	function sessionCheck(){
		$q 	=	"SELECT user_name,username,password,userId FROM `users` WHERE username = '".$_SESSION['userName']."' AND password ='".md5($_SESSION['userPassw'])."' AND del_flag=0";
		$rw = 	mysql_query($q);
		if(mysql_num_rows($rw)) { 
			$re 	= 	mysql_fetch_assoc($rw);
			$_SESSION['userName']	=	$result["username"];
			$_SESSION['fullName']	=	$result["user_name"];
			$_SESSION['userPassw']	=	$result["password"];
			$_SESSION["time"] 		= 	time();
			$_SESSION["userId"] 	= 	$result["userId"];
		}
		if( !isset($_SESSION["userName"]) ) {
				header("location: index.php");
			}
	}

	function sessionDestroy(){
		global $SESSION;
		unset($_SESSION["userName"]);
		unset($_SESSION['fullName']);
		unset($_SESSION['time']);
		unset($_SESSION['userPassw']);
		unset($_SESSION["userId"]);
		session_destroy();
		header("location: index.php");
	}