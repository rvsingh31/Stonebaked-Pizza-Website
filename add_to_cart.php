<?php
include("pizza.php");
	session_start();
	if($_SESSION["user_id"]!=null)
	{
		$id=$_SESSION["user_id"];
	}
	else
	{
		header("location:index.php?msg=Login First!");
		exit;
	}
	
		
		if(!isset($_REQUEST["name"]) || !isset($_REQUEST["qty"]) || !isset($_REQUEST["cheese"]) || !isset($_REQUEST["cheese_qty"]))
		{
			echo "not done";
			exit;
		}
	$item=$_REQUEST["name"];
	$qty=$_REQUEST["qty"];
	$ch=$_REQUEST["cheese"];
	$ch_qty=$_REQUEST["cheese_qty"];
	$i = str_replace("button_","",$item);
	$item_id=trim($i);	
	include("connection.php");
	
	if(!isset($_SESSION["cart"]))
	{
		$sql="select name,price,credits from items where item_id='$item_id'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_assoc($result);
			$n=$row["name"];
			$p=$row["price"];
			$e=$row["credits"];
			$o=new Pizza($item_id,$p,$ch,$qty,$ch_qty,$e,$n);
			$_SESSION["cart_count"]=1;
			$arr=array($item_id=>$o);
			$_SESSION["cart"]=$arr;
			echo "done";
		}
		else
		{
			echo "not done";
			exit;
		}
		
	}
	else
	{
		$arr=$_SESSION["cart"];
		$c=$_SESSION["cart_count"];
		if(array_key_exists($item_id,$arr))
		{
			$temp=$arr[$item_id];
			if($ch=="yes")
			{
					$temp->changeqty($qty);
					$temp->changecqty($ch_qty);
					$temp->setCheese("yes");
			}
			else
			{
					$temp->changeqty($qty);
			}
				$arr[$item_id]=$temp;
				$_SESSION["cart"]=$arr;
		}
		else
		{
						$sql1="select name,price,credits from items where item_id='$item_id'";
						$result1=mysqli_query($conn,$sql1);
						if(mysqli_num_rows($result1)>0)
						{
							$row1=mysqli_fetch_assoc($result1);
							$n=$row1["name"];
							$p=$row1["price"];
							$e=$row1["credits"];
							$o=new Pizza($item_id,$p,$ch,$qty,$ch_qty,$e,$n);
							$_SESSION["cart_count"]=1;
							$arr[$item_id]=$o;
							$_SESSION["cart"]=$arr;
						}
						else
						{
							echo "not done";
							exit;
						}
							
			
		}
		
		$c++;
		$_SESSION["cart_count"]=$c;
		echo "done";
	}
	
	
?>