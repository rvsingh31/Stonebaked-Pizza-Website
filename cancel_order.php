<?php
	session_start();
	if(!isset($_SESSION["user_id"]))
	{
		header("location:index.php?msg=Login First!");
		exit;
	}
	else if(!isset($_REQUEST["order_id"]))
	{
		$_SESSION["msg"]="Order not Specified!";
		header("location:orders.php");
		exit;
	}
	
	$id=$_SESSION["user_id"];
	$order_id=$_REQUEST["order_id"];
	
	include("connection.php");
	
	$sql="select status,total_credits from orders where order_id='$order_id' and user_id='$id'";
	
	$result=mysqli_query($conn,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_assoc($result);
		$s=$row["status"];
		$credits=$row["total_credits"];
		$values=$_SESSION["values"];
		$old_credits=$values[1];
		$new_credits=$values[1]-$credits;
		$values[1]=$new_credits;
		$_SESSION["values"]=$values;
		if($s=="confirmed")
		{
			$_SESSION["msg"]="Order already Confirmed,Could not cancel now!";
			header("location:orders.php");
			exit;
		}
		else
		{
			
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
			
			$mail->Subject = 'One Order is CANCELLED!';
			$url=" http://www.stonebakedpizza.in/view2.php?order_id=".$order_id."&user_id=".$id;
			$mail->Body    = 'One user has cancelled an order placed moment ago . So ,make a note of that. Click here to view the order: '.$url."<br>-System.";
			if(!$mail->send())
			{		
					$_SESSION["msg"]="Error Sending Mail.Try Again Later!";
					header("location:view.php");
					exit;
			}
			else
			{
				$sql1="update orders set status='cancelled' where order_id='$order_id' and user_id='$id'";
				$sql2="update users set total_credits='$new_credits' where id='$id'";
				$query=$sql1.";".$sql2.";";
				if(mysqli_multi_query($conn,$query))
				{
					$_SESSION["msg"]="Order Cancelled!";
				}
				else
				{
					$_SESSION["msg"]="Order Could not be Cancelled!";
				}
				
				header("location:orders.php");
				exit;
			}
		}
	}
	else
	{
		$_SESSION["msg"]="Error Occured!";
		header("location:orders.php");
		exit;
	}

?>