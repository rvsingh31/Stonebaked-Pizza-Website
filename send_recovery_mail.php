<?php

session_start();
echo $_SESSION["recover_id"]." ".$_SESSION["mail"];


	if(!isset($_SESSION["recover_id"]) || !isset($_SESSION["mail"]))
	{
		$_SESSION["msg"]="Error Occured!";
		header("location:recover.php");
		exit;
	}
	
	$id=$_SESSION["recover_id"];
	$email=$_SESSION["mail"];
	
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 14; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $code=$randomString;

		//VERFIY MAIL
		
		
		require 'PHPMailer/PHPMailerAutoload.php';


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
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Email Verification';
$mail->Body    = 'Hello User,<br> A Passsword Recovery has been requested . To change your password , use this verfication code :  <i>'.$code.'   </i>  .<br>Thank You.';

if(!$mail->send())
	{
		$_SESSION["msg"]="Error Sending Verification Email.Try Again Later!";
		header("location:recover.php");
		exit;
	
	}
	else {
		
		include("connection.php");
		$sql="insert into recovery(user_id,code) values('$id','$code')";
		if(mysqli_query($conn,$sql))
		{
			header("location:verify_mail.php");
			exit;
		}
		else
		{
			$_SESSION["msg"]="Error Occcured";
			header("location:recover.php");
			exit;
	
		}
	}
	
	
		

	
?>