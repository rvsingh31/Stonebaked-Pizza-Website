<?php
	
	
	if(!isset($_REQUEST["name"]))
	{
		echo json_encode(array("a" => "fail"));
	}
	else
	{
		include("connection.php");
		$id=$_REQUEST["name"];
		
		$sql="select * from items join item_photos using (item_id) where items.item_id='$id'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_assoc($result);
			$name=$row["name"];
			$ing=$row["ingredients"];
			$price=$row["price"];
			$url=$row["imageData"];
			echo json_encode(array("a" => $name, "b" => $ing, "c" => $price,"d" =>base64_encode($url)));
		}
		else{
			echo json_encode(array("a" => "fail"));
		}
	}
	
?>