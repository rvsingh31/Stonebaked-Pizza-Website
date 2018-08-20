<?php
	session_start();
	if(!isset($_SESSION["user_id"]))
	{
		header("location:index.php?msg=Login First");
		exit;
	}
	
	$user_id=$_SESSION["user_id"];
	$email=$_POST["email"];
	$number=$_POST["number"];
	$sec_que=$_POST["sec_que"];
	$answer=$_POST["answer"];
	$add1=$_POST["add1"];
	$add2=$_POST["add2"];
	$city=$_POST["city"];
	$pincode=$_POST["pincode"];
	
	
	if($email=="" || $number=="" || $sec_que=="" || $answer=="" || $add1=="" || $add2=="" || $city=="" || $pincode=="")
	{
		$_SESSION["msg"]="All fields are required!";
		header("location:home.php");
		exit;
	}
	else
	{
		$details=array($email,$number,$sec_que,$answer,$add1,$add2,$city,$pincode);
		
		$_SESSION["details"]=$details;
		

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
$mail->isHTML(false);                                  // Set email format to HTML

$mail->Subject = 'Email Verification';
$mail->Body    = 'Hello Customer,<br>Welcome to Stonebaked Pizza . We are happy to have you as our customer.Hope you would enjoy our pizzas.<br>But first,Use this verfication code :   <i>  '.$code.'</i>      to verify your email address.<br>Thank You.';

if(!$mail->send())
	{
		$_SESSION["msg"]="Error Sending Verification Email.Try Again Later!";
		header("location:home.php");
		exit;
	
	}
	else {
		
		include("connection.php");
		$sql="insert into verify_mail(user_id,code) values('$user_id','$code')";
		if(mysqli_query($conn,$sql))
		{
			header("location:verify.php");
			exit;
		}
		else
		{
			$_SESSION["msg"]="Error Occcured";
			header("location:home.php");
			exit;
	
		}
	}
	
	
		
	}

	
	
?>
