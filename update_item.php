<?php
	session_start();
	if(!isset($_SESSION["admin"]))
	{
		$_SESSION["msg"]="Login First!";
		header("location:admin.php");
		exit;
	}
	include("connection.php");
	$id=$_SESSION["item_id"];

	$type=$_REQUEST["type"];
	if($type=="name")
	{
		$value=$_POST["new_name"];
		$sql="update items set name='$value' where item_id='$id'";
	}
	else if($type=="price")
	{
		$value=$_POST["new_price"];
		$sql="update items set price='$value' where item_id='$id'";
		
	}
	else if($type=="credits")
	{
		$value=$_POST["new_credits"];
		$sql="update items set credits='$value' where item_id='$id'";
		
	}
	else if($type=="ingredients")
	{
		$value=$_POST["new_ing"];
		$sql="update items set ingredients='$value' where item_id='$id'";
		
	}
	
	if(mysqli_query($conn,$sql))
	{
		$_SESSION["msg"]="Updated Successfully";
	}
	else
	{
				$_SESSION["msg"]="Could not Update";
	}
		header("location:menu.php");
		exit;

?>
