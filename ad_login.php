


<?php
	$u=$_POST["username"];
	$p=$_POST["password"];
	
	if($u=="" || $p=="")
	{
		header("location:admin.php?msg=Enter Credentials!");
		exit;
	}
	else	
	{
		
			if($u=="dhaval" && $p=="Dhaval8081@")
			{
				session_start();
				$_SESSION["admin"]="yes";
				if(isset($_SESSION["url"]))
				{
					$u="location:".$_SESSION["url"];
					header($u);
					unset($_SESSION["url"]);
					unset($_SESSION["msg"]);
					exit;
				}
				else
				{
					header("location:main.php");
					exit;
				}
			}
			else
			{
				$_SESSION["msg"]="Incorrect Credentials!";
						header("location:admin.php");
						exit;
			}
		
	}
?>