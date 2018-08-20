<?php

	session_start();
	if(!isset($_SESSION["user_id"]))
	{
		header("location:index.php?msg=Login First!");
		exit;
	}
	include("connection.php");
	$add1=$_POST["add1"];
	$add2=$_POST["add2"];
	$city=$_POST["city"];
	$pincode=$_POST["pincode"];
	if(empty($add1) || empty($add2) || empty($city) || empty($pincode))
	{
		$_SESSION["msg"]="Enter all fields as asked!";
		header("location:checkout.php");
		exit;
	}
	else
	{
		$id=$_SESSION["user_id"];
		$aid="address_".$id."_".mt_rand(1,1000);
	//	echo $aid;
		$sql1="insert into step2(userid,addressid) values('$id','$aid')";
		$sql2="insert into address(addressid,add1,add2,city,pincode) values('$aid','$add1','$add2','$city','$pincode')";
		$sql=$sql1.";".$sql2.";";
		if(mysqli_multi_query($conn,$sql))
		{
			$_SESSION["msg"]="Address added!";
		//	echo "done";
			if(isset($_GET["type"]) )
			{
				header("location:user.php");
				exit;				
			}
			else
			{
				header("location:checkout.php");
				exit;			
			}
		}
		else
		{
		//	echo "not done";
			$_SESSION["msg"]="Error Occured!";
				if(isset($_GET["type"]) )
				{
					header("location:user.php");
					exit;				
				}
				else
				{
					header("location:checkout.php");
					exit;			
				}
		
		}
	}
	
	
?>