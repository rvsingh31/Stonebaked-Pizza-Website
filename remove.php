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
	
	if(!isset($_REQUEST["id"]) || !isset($_SESSION["cart"]) || !isset($_REQUEST["type"])  || !isset($_REQUEST["sel_type"]) || !isset($_REQUEST["choice"]) || !isset($_REQUEST["entry"]))
	{
		echo "not done";
	}
	else
	{
		
		if($_REQUEST["type"]=="multiple")
		{
			
			$sel_type=$_REQUEST["sel_type"];
			$choice=$_REQUEST["choice"];
			$entry=$_REQUEST["entry"];
		
			
			$id=$_REQUEST["id"];
		
			$arr=$_SESSION["cart"];
			$object=$arr[$id];
			if($sel_type=="all")
			{
				unset($arr[$id]);
				if(count($arr)==0)
				{
					unset($_SESSION["cart"]);
					unset($_SESSION["cart_count"]);
				
				}
				else
				{
					$count=$_SESSION["cart_count"];
				$count--;
				$_SESSION["cart_count"]=$count;
				$_SESSION["cart"]=$arr;
				
				}
					echo "done";
			}
			else if($sel_type=="ch_some")
			{
				$del_val=$entry;
				$old_val=$object->getQty();
				if( $del_val==0)
				{
							echo "not done";
							exit;
				}
				else
				{
						if($del_val>$old_val)
						{
							echo "not done";
							exit;
						}
						$new_val=$old_val-$del_val;
						$object->setQty($new_val);
						$arr[$id]=$object;
						$_SESSION["cart"]=$arr;
						echo "done";
				}
				
			}	
			else
			{
				if($sel_type=="cheese")
				{
					if($choice=="all")
					{
						$old_val=$object->getC_Qty();
						$object->setC_Qty(0);
						$temp=$object->getQty();
						$temp-=$old_val;
						if($temp==0)
						{
							unset($arr[$id]);
							$_SESSION["cart"]=$arr;
						}
						else
						{
							$object->setQty($temp);
							$object->setCheese("no");
							$arr[$id]=$object;
							$_SESSION["cart"]=$arr;
						
						}
						echo "done";
					}
					else
					{
						$old_val=$object->getC_Qty();
						if($old_val<$entry || $entry==0)
						{
							echo "not done";
							exit;
						}
						else
						{
							$temp=$object->getQty();
							$old_val-=$entry;
							$object->setC_Qty($old_val);
							$temp-=$entry;
							$object->setQty($temp);
							$arr[$id]=$object;
							$_SESSION["cart"]=$arr;
							echo "done";
						}
					}
					
				}
				else
				{
					if($choice=="all")
					{
						$c_val=$object->getC_Qty();
							$object->setQty($c_val);
							$arr[$id]=$object;
							$_SESSION["cart"]=$arr;
							echo "done";
						
					}
					else
					{
							$old_val=$object->getQty();
							$c_val=$object->getC_Qty();
							$old_val-=$c_val;
							if($entry>$old_val || $entry==0)
							{
								echo "not done";
								exit;
							}
							$new=$object->getQty();
							$new-=$entry;
							$object->setQty($new);
							$arr[$id]=$object;
							$_SESSION["cart"]=$arr;
							echo "done";
						
					}
					
				}
			}
		}
		else
		{
			$id=$_REQUEST["id"];
			$arr=$_SESSION["cart"];
			unset($arr[$id]);
			if(count($arr)==0)
			{
				unset($_SESSION["cart"]);
				unset($_SESSION["cart_count"]);
			}
			else
			{
				$old_count=$_SESSION["cart_count"];
				$old_count--;
				$_SESSION["cart_count"]=$old_count;
				$_SESSION["cart"]=$arr;
			}
			echo "done";
		}
	}
	
?>