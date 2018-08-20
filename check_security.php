<?php
	session_start();
	if(!isset($_REQUEST["sec_que"]) || !isset($_REQUEST["answer"]) || !isset($_SESSION["recover_id"]))
	{
		echo "error";
	}
	include("connection.php");
	$sec_que=$_REQUEST["sec_que"];
	$answer=$_REQUEST["answer"];
	$user_id=$_SESSION["recover_id"];
	$sql="select qno,answer from step1 where userid='$user_id'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_assoc($result);
		if($row["qno"]==$sec_que && $row["answer"]==$answer)
		{
				echo "no error";
		}
		else
		{
				echo "wrong";
		}
	}
	else
	{
			echo "not_found";	
	}
?>