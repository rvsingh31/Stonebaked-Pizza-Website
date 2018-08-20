<?php
session_start();
	if(!isset($_SESSION["admin"]))
	{
		$_SESSION["msg"]="Login First!";
		header("location:admin.php");
		exit;
	}
	else if(!isset($_GET["order_id"]) || !isset($_GET["user_id"]))
	{
		$_SESSION["msg"]="No order Selected";
		header("location:main.php");
		exit;
	}
	$order_id=$_GET["order_id"];
	$user_id=$_GET["user_id"];
	include("connection.php");
	
	
	$sql="update orders set status='delivered' where order_id='$order_id' and user_id='$user_id'";
	if(mysqli_query($conn,$sql))
	{
		$_SESSION["msg"]="Order Delivered!";
	}
	else
	{
		$_SESSION["msg"]="Order could not be confirmed!Sorry.";
	}
	
			header("location:main.php");
			exit;
?>