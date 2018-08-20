<?php
session_start();
	if(!isset($_SESSION["admin"]))
	{
		$_SESSION["msg"]="Login First!";
		header("location:admin.php");
		exit;
	}
	include("connection.php");
	
	if(!isset($_REQUEST["id"]))
	{
		$_SESSION["msg"]="Error Occcured!";
		header("location:menu.php");
		exit;
	}
	
	$id=$_REQUEST["id"];
	$_SESSION["item_id"]=$id;
	
	header("location:change_details.php");
	exit;

?>