<?php
	session_start();
	if(!isset($_SESSION["user_id"]))
	{
		header("location:index.php?msg=Login First!");
		exit;
	}
	else if(!isset($_POST["del_add"]))
	{
		$_SESSION["msg"]="Select a delivery Address first!";
		header("location:checkout.php");
		exit;
	}
	$_SESSION["delivery_address"]=$_POST[del_add];
	header("location:payment.php");
	exit;
?>