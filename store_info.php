<?php
	session_start();
	if(!isset($_SESSION["user_id"]))
	{
		header("location:index.php?msg=Login First");
		exit;
	}
	else if(!isset($_SESSION["details"]))
	{
		$_SESSION["msg"]="Enter Details first!";
		header("location:home.php");
		exit;
	}
	else if($_POST["code"]=="")
	{
		$_SESSION["msg"]="Enter the verification code first";
		header("location:verify.php");
		exit;
	}
	include("connection.php");

		$details=$_SESSION["details"];
	$id=$_SESSION["user_id"];
	$code=$_POST["code"];
	
	$sql="select code from verify_mail where user_id='$id'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_assoc($result);
		$in_code=$row["code"];
		
		if($code==$in_code)
		{
			$aid="address_".$id."_".mt_rand(1,1000);
			$sql="update users set step1='complete' , step2='complete' where id='$id'";
			$sql1="insert into step1(userid,email,contact,qno,answer) values('$id','$details[0]','$details[1]','$details[2]','$details[3]')";
			$sql2="insert into step2(userid,addressid) values('$id','$aid')";
			$sql3="insert into address(addressid,add1,add2,city,pincode) values('$aid','$details[4]','$details[5]','$details[6]','$details[7]')";
			$sql4="delete from verify_mail where user_id='$id'";
			$query=$sql1.";".$sql2.";".$sql3.";".$sql.";".$sql4.";";
			if(mysqli_multi_query($conn,$query))
			{
				
					$_SESSION["msg"]="Profile Updated!";
					$_SESSION["step1"]="complete";
					$_SESSION["step2"]="complete";
					
					header("location:home.php");
					exit;
		
			}
			else
			{
				
					$_SESSION["msg"]="Error occured .Try Again Later!";
					header("location:home.php");
					exit;
			
			}
			
		}
		else
		{
			
			$_SESSION["msg"]="Verification code entered is wrong!";
			header("location:verify.php");
			exit;
		
		}
	}
	else
	{
		header("location:index.php?msg=Login First");
		exit;
	}
	
?>