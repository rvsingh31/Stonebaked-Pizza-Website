<?php
	session_start();
	unset($_SESSION["cart"]);

	unset($_SESSION["cart_count"]);
	session_destroy();
	
	header("location:index.php?msg=Logged Out&type=1");
	exit;
?>