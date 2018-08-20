<?php
	include("enc_dec.php");
	include("connection.php");
	$u=$_POST["username"];
	$p=$_POST["password"];
	
	if(empty($u) || empty($p))
	{
		header("location:index.php?msg=Please enter Login Details");
		exit;
	}
/*
	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
  {
        //your site secret key
		$secret = "6LdQ1g8UAAAAAMLnB_bE05K48_Z0rEycLg0LdR7W";
        
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
		{
			$username=mysqli_real_escape_string($conn,text_input($u));
				$password=mysqli_real_escape_string($conn,text_input($p));
			$encoded = $converter->safe_b64encode($password );
	
				$sql="select * from users where username like binary '$username' and password like binary '$encoded'";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0)
				{
					$r=mysqli_fetch_assoc($result);
					session_start();
					$_SESSION["user_id"]=$r["id"];
					$_SESSION["username"]=$r["username"];
					$_SESSION["fullname"]=$r["firstname"]." ".$r["lastname"];
					$_SESSION["step1"]=$r["step1"];
					$_SESSION["step2"]=$r["step2"];
					$_SESSION["email_address"]=$r["email_address"];
					$values=array($r["orders"],$r["total_credits"],$r["feedbacks"],$r["suggestions"]);
					$_SESSION["values"]=$values;
					header("location:home.php");
					exit;
				}
				else
				{
					header("location:index.php?msg=Incorrect Credentials!&type=0");
					exit;

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
  
  
  
  */
  
			$username=mysqli_real_escape_string($conn,text_input($u));
				$password=mysqli_real_escape_string($conn,text_input($p));
	//		$encoded = $converter->safe_b64encode($password );
						$encoded = $converter->encode($password );
				$sql="select * from users where username like binary '$username' and password like binary '$encoded'";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0)
				{
					$r=mysqli_fetch_assoc($result);
					session_start();
					$_SESSION["user_id"]=$r["id"];
					$_SESSION["username"]=$r["username"];
					$_SESSION["fullname"]=$r["firstname"]." ".$r["lastname"];
					$_SESSION["step1"]=$r["step1"];
					$_SESSION["step2"]=$r["step2"];
					$_SESSION["email_address"]=$r["email_address"];
					$values=array($r["orders"],$r["total_credits"],$r["feedbacks"],$r["suggestions"]);
					$_SESSION["values"]=$values;
					header("location:home.php");
					exit;
				}
			
				  
  function text_input($variable)
	{
		$variable=trim($variable);
		$varible=stripslashes($variable);
		$variable=htmlspecialchars($variable);
		return $variable;
	}

?>