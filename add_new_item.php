<?php
session_start();
	if(!isset($_SESSION["admin"]))
	{
		$_SESSION["msg"]="Login First";
		header("location:admin.php");
		exit;
	}
	$n=$_POST["name"];
	$ing=$_POST["ing"];
	$price=$_POST["price"];
	$credits=$_POST["credits"];
	$name="pic";
	
	if($n=="" || $price=="" || $credits=="" || count($_FILES) <= 0) 
	{
		$_SESSION["msg"]="Enter all details";
		header("location:menu.php");
		exit;
	}
	else	
	{
				include("connection.php");
	
	
		
		$sql="insert into items(name,ingredients,price,credits,type) values('$n','$ing','$price','$credits','pizza')";
		if(mysqli_query($conn,$sql))
		{
			$sql1="select item_id from items where name='$n' and price='$price' and credits='$credits'";
			$result=mysqli_query($conn,$sql1);
			$row=mysqli_fetch_assoc($result);
			$item_id=$row["item_id"];
			if(is_uploaded_file($_FILES[$name]['tmp_name'])) {
				$imgData =addslashes(file_get_contents($_FILES[$name]['tmp_name']));
		
				$sql="select * from item_photos where item_id='$item_id'";
					$check=mysqli_query($conn,$sql);
					if(mysqli_num_rows($check)>0)
					{
						$query = "UPDATE item_photos set imageData= '$imgData' where item_id='$item_id'";
					
					}
					else
					{
						$query = "INSERT INTO item_photos(item_id,imageData) VALUES('$item_id','$imgData')";
					}
		
				if(mysqli_query($conn,$query)) {
					$_SESSION["msg"]="New Item Added!";
						header("location:menu.php");
						exit;
				}
				else
				{
					$_SESSION["msg"]="Some Error Occured while adding!";
						header("location:menu.php");
						exit;
				}
			}
			else
			{
					$_SESSION["msg"]="Some Error Occured while adding!";
						header("location:menu.php");
						exit;
			}
		}
		else
		{
					$_SESSION["msg"]="Some Error Occured while adding!";
						header("location:menu.php");
						exit;
		}
	
	
	
	}
?>