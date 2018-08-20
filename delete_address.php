<?php
session_start();
	if(!isset($_SESSION["user_id"]))
	{
		header("location:index.php?msg=Login First!");
		exit;
	}
	else if(!isset($_REQUEST["id"]))
	{
		$_SESSION["msg"]="Select An Address to delete!";
		header("location:user.php");
		exit;		
	}
	$id=$_SESSION["user_id"];
	include("connection.php");
	include("enc_dec.php");
	
	$add_dec=$converter->safe_b64decode($_REQUEST["id"]);
	
	$sql="update step2 set status='disabled' where addressid='$add_dec' and userid='$id'";
	
	if(mysqli_query($conn,$sql))
	{
			$_SESSION["msg"]="Address Deleted!";
			header("location:user.php");
			exit;		
	}
	else
	{
		$_SESSION["msg"]="Error Occured!Try again Later!";
		header("location:user.php");
		exit;		
	}
?>