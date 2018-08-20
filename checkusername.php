<?php
	$type="";
	if(isset($_REQUEST["type"]))
	{
		$type="recover";
	}
	include("connection.php");
	$str=$_REQUEST["q"];
	$sql="select * from users where username like binary '$str'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		if($type=="recover")
		{
			session_start();
			$row=mysqli_fetch_assoc($result);
			$_SESSION["recover_id"]=$row["id"];
			$_SESSION["mail"]=$row["email_address"];
					echo "no error";
		}
		else
		{
					echo "error";
		}
	}
	else
	{
			if($type=="recover")
				{
						echo "error";
				}
				else
				{
					echo "no error";
				}
	}
	
?>