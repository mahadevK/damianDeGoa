<?php
	global $SESSION;
	session_start();
	unset($_SESSION["logInUName"]);
	unset($_SESSION['logInUPassw']);
	session_destroy();
	header("location: index.php");
?>