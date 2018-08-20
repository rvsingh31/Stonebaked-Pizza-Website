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
		
		if(!isset($_POST["fb"]))
		{
			$_SESSION["msg"]="Enter feedback first!";
			header("location:feedbacks.php");
			exit;
		}
		$id=$_SESSION["user_id"];
		$values=$_SESSION["values"];
		$fb=$_POST["fb"];
	
	include("connection.php");
	$c=++$values[2];
	$sql="insert into feedbacks(user_id,feedback) values('$id','$fb')";
	$sql2="update users set feedbacks='$c' where id='$id'";
	$sql=$sql.";".$sql2;
	if(mysqli_multi_query($conn,$sql))
	{
		$values[2]=$c;
		$_SESSION["values"]=$values;
		$_SESSION["msg"]="Feedback saved!";
		header("location:home.php");
		exit;
		}
	else
	{
		$_SESSION["msg"]="Feedback could not be saved!";
		header("location:home.php");
		exit;
	}
	
?>