<?php
session_start();
	if(!isset($_SESSION["admin"]) || !isset($_REQUEST["type"]) || !isset($_REQUEST["id"]) || !isset($_REQUEST["feedback"]))
	{
		$_SESSION["msg"]="Login First!";
		header("location:admin.php");
		exit;
	}
	include("connection.php");
	$type=$_REQUEST["type"];
	$id=$_REQUEST["id"];
	$fb=$_REQUEST["feedback"];
	
	if($type=="show")
	{
		$sql="update feedbacks set status='enabled' where user_id='$id' and feedback='$fb'";
		
	}
	else
	{
		$sql="update feedbacks set status='disabled' where user_id='$id' and feedback='$fb'";
	}
	if(mysqli_query($conn,$sql))
	{
		$_SESSION["msg"]="Status Updated! ";
		header("location:manage_fb.php");
		exit;
	}
	else
	{
		$_SESSION["msg"]="Could not Update! ";
		header("location:manage_fb.php");
		exit;
	}
?>