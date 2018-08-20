<?php
	session_start();
	unset($_SESSION["cart"]);

	unset($_SESSION["cart_count"]);
	session_destroy();
	
	header("location:admin.php");
	exit;
?>