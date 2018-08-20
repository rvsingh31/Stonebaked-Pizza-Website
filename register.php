<?php
	include("connection.php");
	include("enc_dec.php");
	require_once('recaptchalib.php');
  
  
  if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
  {
        //your site secret key
		$secret = "6LdQ1g8UAAAAAMLnB_bE05K48_Z0rEycLg0LdR7W";
        
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
		{
			$fn=$_POST["r_firstname"];
			$ln=$_POST["r_lastname"];
			$un=$_POST["r_username"];
			$pd=$_POST["r_password"];
			$e=$_POST["r_email"];
			if(!empty($fn) && !empty($ln) && !empty($un) && !empty($pd) && !empty($e) )
			{
				$encoded = $converter->safe_b64encode($pd);
				$sql="insert into users(firstname,lastname,username,password,email_address,step1,step2) values('$fn','$ln','$un','$encoded','$e','incomplete','incomplete')";
				if(mysqli_query($conn,$sql))
				{
					header("location:index.php?msg=Registered.You are good to go&type=1");
					exit;
				}
				else
				{
					header("location:index.php?msg=Some Error Occured,Try Again Later!&type=0");
					exit;

				}
			}
		}
		else
		{
			header("location:index.php?msg=Captcha Not Entered Correctly!&type=0");
			exit;
		}
  }
  else
  {
			header("location:index.php?msg=Captcha Not Entered!!&type=0");
			exit;
  }
  
  
  
  
  
  
			
?>