<?php
session_start();
	if(!isset($_SESSION["admin"]))
	{
		$_SESSION["msg"]="Login First!";
		header("location:admin.php");
		exit;
	}
	else if(!isset($_REQUEST["email"]) || !isset($_REQUEST["type"]) || !isset($_REQUEST["order_id"]) || !isset($_REQUEST["user_id"]))
	{
		$_SESSION["msg"]="Specify Email and type first!";
		header("location:view.php");
		exit;
	}
	$type=$_REQUEST["type"];
	$email=$_REQUEST["email"];
	
	
		require 'PHPMailer/PHPMailerAutoload.php';
include("connection.php");
$order_id=$_REQUEST["order_id"];
$user_id=$_REQUEST["user_id"];
$mail = new PHPMailer;


$mail->isSMTP();                         
$mail->Host = 'smtp.gmail.com';  
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'ownerofmysite@gmail.com';                 // SMTP username
$mail->Password = 'splitwise';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('ownerofmysite@gmail.com');
$mail->addAddress($email);               // Name is optional
$mail->isHTML(false);                                  // Set email format to HTML

if($type=="confirm")
{
	
$sql1="update orders set status='confirmed' where order_id='$order_id' and user_id='$user_id'";
	$up="select credits,total_credits from users join update_credits on(users.id=update_credits.user_id) where order_id='$order_id' and user_id='$user_id' ";
$rsset=mysqli_query($conn,$up);
$row=mysqli_fetch_assoc($rsset);
$add_credits=$row["credits"];
$old_credits=$row["total_credits"];
	$new_credits=$old_credits+$add_credits;
	$sql2="update users set total_credits='$new_credits' where id='$user_id'";
	$sql3="delete from update_credits where order_id='$order_id' and user_id='$user_id'";
	$sql=$sql1.";".$sql2.";".$sql3.";";

	
	$time=$_POST["time"];
		$mail->Subject = 'Your Order has been Confirmed.';
		$mail->Body    = 'This is to inform you that your order has been confirmed.It will be delivered in nearly about '.$time.' minutes.Please keep the amount ready.Thank You for visiting Stonebaked Pizza.';

}
else
{
	
	$sql1="update orders set status='cancelled' where order_id='$order_id' and user_id='$user_id'";
	$sql3="delete from update_credits where order_id='$order_id' and user_id='$user_id'";
	$sql=$sql1.";".$sql3.";";
	$reason=$_POST["reason"];
	$r="";
	if($reason==1)
	{
		$r="due to unavailability of resources and ingredients.";
	}
	else
	{
				$r="as the specified delivery address is out of range.";
	}
		$mail->Subject = 'Your Order has been Cancelled.';
		$mail->Body    = 'This is to inform you that your order has been cancelled unfortunately by our Admin '.$r.' We are sorry for the inconvenience caused .Thank You for visiting Stonebaked Pizza.';
}

if(!$mail->send())
	{
		$_SESSION["msg"]="Error Sending Mail.Try Again Later!";
		header("location:view.php");
		exit;
	}
	else
	{
		if($type=="confirm")
		{
			$_SESSION["msg"]="Order Confirmed!";
		}
		else
		{
			$_SESSION["msg"]="Order Cancelled!";
		}
		
		if(mysqli_multi_query($conn,$sql))
		{
			header("location:main.php");
			exit;
		}
		else
		{
			$_SESSION["msg"]="Mail Sent but some Error Occured in Database!";
			header("location:main.php");
			exit;
		}
		
		
	}
?>