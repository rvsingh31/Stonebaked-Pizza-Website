<?php

	session_start();
	if(!isset($_SESSION["user_id"]))
	{
		header("location:index.php?msg=Login First!");
		exit;
	}
	if(!isset($_REQUEST["type"]))
	{
		$_SESSION["msg"]="Select any field to update!";
		header("location:user.php");
		exit;	
	}
	$id=$_SESSION["user_id"];
	include("enc_dec.php");
	include("connection.php");
	
	$type=$_REQUEST["type"];
	
	
	if($type=="firstname")
	{
		$value=$_POST["new_firstname"];
		$sql="update users set firstname='$value' where id='$id'";
	}
	else if($type=="lastname")
	{
		$value=$_POST["new_lastname"];
		$sql="update users set lastname='$value' where id='$id'";	
	}
	else if($type=="username")
	{
		$value=$_POST["new_username"];
		$sql="update users set username='$value' where id='$id'";
	}
	else if($type=="password")
	{
		$value=$_POST["new_password"];
		$value2=$_POST["new_repassword"];
		if($value!=$value2)
		{
			$_SESSION["msg"]="Both Passwords don\'t match";
			header("location:user.php");
			exit;
		}
		else
		{
			$encoded=$converter->safe_b64encode($value);
			$sql="update users set password ='$encoded' where id='$id'";		
		}
	}
	else if($type=="contact")
	{
		$value=$_POST["new_contact"];
		$sql="update step1 set contact='$value' where userid='$id'";
	}
	else if($type=="email")
	{
		$value=$_POST["new_email"];
		$sql="update step1 set email='$value' where userid='$id'";	
	}
	
	
	if(mysqli_query($conn,$sql))
	{
		$_SESSION["msg"]="Profile Updated";
	}
	else
	{
		$_SESSION["msg"]="Error in Updating.Try Again Later!";		
	}
	header("location:user.php");
	exit;
?>