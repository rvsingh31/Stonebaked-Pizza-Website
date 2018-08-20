<?php
session_start();
	if(!isset($_SESSION["recover_id"]))
	{
		$_SESSION["msg"]="Some Error Occured!";
		header("location:changepassword.php");
		exit;
	}
	else if(!isset($_POST["p"]) || !isset($_POST["rp"]))
	{
		$_SESSION["msg"]="All fields are necessary!";
		header("location:changepassword.php");
		exit;
	}
	else
	{
		$id=$_SESSION["recover_id"];
		echo $id;
		include("connection.php");
		include("enc_dec.php");
		$p=$_POST["p"];
		$rp=$_POST["rp"];
		if($p==$rp)
		{
			$encoded = $converter->safe_b64encode($p);
			$sql="update users set password='$encoded' where id='$id'";
			if(mysqli_query($conn,$sql))
			{
				header("location:index.php?msg=Password Reset Complete.&type=1");
				exit;
			}
			else
			{
				$_SESSION["msg"]="Error Occured!";
				header("location:changepassword.php");
				exit;
			}
		}
		else
		{
			$_SESSION["msg"]="Both passwords don\'t password!";
			header("location:changepassword.php");
			exit;
		}
	
	}
		
?>