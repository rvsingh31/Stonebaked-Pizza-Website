<?php
session_start();
$item_id=$_SESSION["item_id"];
include("connection.php");
	$name='pic';
	
if(count($_FILES) > 0) {
	if(is_uploaded_file($_FILES[$name]['tmp_name'])) {
		$imgData =addslashes(file_get_contents($_FILES[$name]['tmp_name']));
		
				$sql="select * from item_photos where item_id='$item_id'";
					$check=mysqli_query($conn,$sql);
					if(mysqli_num_rows($check)>0)
					{
						echo "in";
						$query = "UPDATE item_photos set imageData= '$imgData' where item_id='$item_id'";
					
					}
					else
					{
						$query = "INSERT INTO item_photos(item_id,imageData) VALUES('$item_id','$imgData')";
					}
		
			if(mysqli_query($conn,$query)) {
				$_SESSION["msg"]="Updated Item Image!";
						header("location:menu.php");
						exit;
			}
			else
			{
					$_SESSION["msg"]="Some Error Occured while uploading!";
						header("location:menu.php");
						exit;
			}
		}
	}

?>	