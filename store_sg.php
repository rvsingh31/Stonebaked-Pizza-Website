<?php

	session_start();
	if(isset($_SESSION["user_id"]))
	{
		$name=$_SESSION["fullname"];
	}
	else
	{
			header("location:index.php?msg=Login First!&type=0");
			exit;
	}
		
		if(!isset($_POST["sg"]))
		{
			$_SESSION["msg"]="Enter suggestion first!";
			header("location:home.php");
			exit;
		}
		$id=$_SESSION["user_id"];
		$values=$_SESSION["values"];
		$fb=$_POST["sg"];
	
	include("connection.php");
	$c=++$values[3];
	$sql="insert into suggestions(user_id,suggestion) values('$id','$fb')";
	$sql2="update users set suggestions='$c' where id='$id'";
	$sql=$sql.";".$sql2;
	if(mysqli_multi_query($conn,$sql))
	{
		$values[3]=$c;
		$_SESSION["values"]=$values;
		$_SESSION["msg"]="Suggestion saved!";
		header("location:home.php");
		exit;
		}
	else
	{
		$_SESSION["msg"]="Suggestion could not be saved!";
		header("location:home.php");
		exit;
	}
	
?>