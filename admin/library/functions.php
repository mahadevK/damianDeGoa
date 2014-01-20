<?php	 	
	session_start();	
	function sessionStart($user,$pass){
		$query 	=	"SELECT admin_name,type,username,password,id FROM `admin` WHERE username = '".$user."' AND password ='".md5($pass)."' AND del_flag=0";
		$row 	= 	mysql_query($query);
		if(mysql_num_rows($row)) { 
			$result = mysql_fetch_assoc($row);
			session_start();
			$_SESSION['userName']	=	$result["username"];
			$_SESSION['fullName']	=	$result["admin_name"];
			$_SESSION['userPassw']	=	$result["password"];
			$_SESSION["userType"] 	= 	$result["type"];
			$_SESSION["userId"] 	= 	$result["id"];
			$_SESSION["time"] 		= 	time();
			header('Location:dashBoard.php');
			
		} else { 
			$error= " <strong>User Login Failed</strong>";
			return $error;
		}
	}

	function sessionCheck(){
		$q 	=	"SELECT admin_name,type,username,password FROM `admin` WHERE username = '".$_SESSION['userName']."' AND password ='".md5($_SESSION['userPassw'])."' AND del_flag=0";
		$rw = 	mysql_query($q);
		if(mysql_num_rows($rw)) { 
			$re 	= 	mysql_fetch_assoc($rw);
			$_SESSION['userName']	=	$result["username"];
			$_SESSION['fullName']	=	$result["admin_name"];
			$_SESSION['userPassw']	=	$result["password"];
			$_SESSION["userType"] 	= 	$result["type"];
			$_SESSION["time"] 		= 	time();
			$_SESSION["userId"] 	= 	$result["id"];
			
		}
		if( !isset($_SESSION["userName"]) ) {
				header("location: index.php");
			}
	}

	function sessionDestroy(){
		global $SESSION;
		session_start();
		unset($_SESSION["userName"]);
		unset($_SESSION['fullName']);
		unset($_SESSION['time']);
		unset($_SESSION['userPassw']);
		unset($_SESSION['userType']);
		unset($_SESSION["userId"]);
		session_destroy();
		header("location: index.php");
	}