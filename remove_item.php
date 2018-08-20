<?php
	include("connection.php");
session_start();

	if(!isset($_SESSION["admin"]))
	{
		$_SESSION["msg"]="Login First!";
			header("location:admin.php");
			exit;
	}	
	
	$id=$_REQUEST["id"];
	$sql="delete from items where item_id='$id'";
	$sql2="delete from item_photos where item_id='$id'";
	$query=$sql.";".$sql2.";";
	if(mysqli_multi_query($conn,$query))
	{
		$_SESSION["msg"]="Removed!";
	}
	else
	{
		$_SESSION["msg"]="Could not Remove.Error Occured!";
	}	
	header("location:menu.php");
	exit;

?>