<?php

	session_start();
	if(!isset($_SESSION["recover_id"]))
	{
		echo "error";
	}
	else if($_REQUEST["q"]=="")
	{
		echo "error";
	}
	else
	{
		$id=$_SESSION["recover_id"];
		$code=$_REQUEST["q"];
		include("connection.php");
		$sql="select code from recovery where user_id='$id'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_assoc($result);
			$in_code=$row["code"];
		
			if($code==$in_code)
			{
				$sql2="delete from recovery where user_id='$id'";
				if(mysqli_query($conn,$sql2))
				{
					echo "done";
				}
				else
				{
					echo "error";
				}
			}
			else
			{
				echo "error";
			}
		}
		else
		{
			echo "error";
		}
	}

?>