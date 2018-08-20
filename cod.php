<?php
	include("pizza.php");
	include("connection.php");
	session_start();
	if(!isset($_SESSION["user_id"]))
	{
		header("location:index.php?msg=Login First!");
		exit;
	}
	else if(!isset($_SESSION["cart"]) || !isset($_SESSION["grand_total"]) || !isset($_SESSION["credits"]))
	{
		$_SESSION["msg"]="No items in cart to place your order!";
		header("location:home.php");
		exit;
	}	
	else if( !isset($_SESSION["delivery_address"]) )
	{	
		$_SESSION["msg"]="Select a delivery Address first!";
		header("location:checkout.php");
		exit;
	}
	$id=$_SESSION["user_id"];
	$charges=$_SESSION["delivery_charges"];
	$s="select orders,total_credits from users where id='$id'";
	$r=mysqli_query($conn,$s);
	$old_credits=0;
	$old_orders=0;
	if(mysqli_num_rows($r)>0)
	{
		$credits_row=mysqli_fetch_assoc($r);
		$old_credits=$credits_row["total_credits"];
		$old_orders=$credits_row["orders"];
	}
	else
	{
		header("location:index.php?msg=Login First!");
		exit;
	}
	
	date_default_timezone_set("Asia/Kolkata");
		
		$date=date("Y-m-d");
		$order_id=$id."_".date("d-m-Y")."_".date("h:i:sa");
		$total_cost=$_SESSION["grand_total"];
		$total_credits=$_SESSION["credits"];                        // add to update_credits table
	//	$new_credits=$total_credits+$old_credits;
		$new_orders=++$old_orders;
		$arr=$_SESSION["cart"];
		$add=$_SESSION["delivery_address"];
		$sql="";
		$total_cost=$total_cost+$charges;
		foreach($arr as $x => $o) 
		{
			$item=$o->getItem();
			$qty=$o->getQty();
			$c_qty=$o->getC_Qty();
			$sql.="insert into order_details(order_id,item_id,cheese_qty,total_qty) values('$order_id','$item','$c_qty','$qty');";
			
		}
		
		$sql2="insert into orders(order_id,user_id,addressid,date,total_cost,total_credits,status,delivery_charges) values('$order_id','$id','$add','$date','$total_cost','$total_credits','placed','$charges')";
		//$sql3="update users set total_credits='$new_credits',orders='$new_orders' where id='$id'";
		
		$sql3="insert into update_credits(user_id,order_id,credits) values('$id','$order_id','$total_credits')";
		
		$query=$sql.$sql2.";".$sql3.";";
	
			require 'PHPMailer/PHPMailerAutoload.php';
include("connection.php");
	
$mail = new PHPMailer;


$mail->isSMTP();                         
$mail->Host = 'smtp.gmail.com';  
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'ownerofmysite@gmail.com';                 // SMTP username
$mail->Password = 'splitwise';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('ownerofmysite@gmail.com');
$mail->addAddress('ownerofmysite@gmail.com');               // Name is optional
$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'New Order Arrived!Confirmation Needed.';
	$mail->Body    = 'There has been a new order placed .Your confirmation is needed to process the order.You are required to take necessary action for the new order.<br> The order id is: '.$order_id.'<br>Login at the admin panel or click the link below:<br> http://www.stonebakedpizza.in/view.php?order_id='.$order_id.'&user_id='.$id.' <br>-SYSTEM.';
		if(!$mail->send())
		{
			$_SESSION["msg"]="Error Sending Mail.Try Again Later!";
			header("location:payment.php");
			exit;
		}
	else
	{
			if(mysqli_multi_query($conn,$query))
		{
			unset($_SESSION["cart"]);
			unset($_SESSION["cart_count"]);
			unset($_SESSION["delivery_address"]);
			unset($_SESSION["grand_total"]);
			unset($_SESSION["credits"]);
			$values=$_SESSION["values"];
		//	$values[1]=$new_credits;
			$values[0]=$new_orders;
			$_SESSION["values"]=$values;
			$_SESSION["msg"]="Your Order has been placed.Wait for the confirmation email!";
			header("location:home.php");
			exit;
		}
		else
		{
						unset($_SESSION["cart"]);
						unset($_SESSION["cart_count"]);
						unset($_SESSION["delivery_address"]);
						unset($_SESSION["grand_total"]);
						unset($_SESSION["credits"]);
		
					$_SESSION["msg"]="Some Error Occured!Try Again Later!!";
					header("location:home.php");
					exit;
		}
	}

		
?>