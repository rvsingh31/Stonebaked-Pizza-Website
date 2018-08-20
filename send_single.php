<?php

	session_start();
	if(!isset($_SESSION["admin"]))
	{
		$_SESSION["msg"]="Login First!";
		header("location:admin.php");
		exit;
	}
include('remote_sms/way2sms-api.php');

$msg=$_POST["msg"];
$phone=$_POST["phone"];

if($msg=='' || $phone=='')
{
		$_SESSION["msg"]="Enter all details";
		header("location:msg.php");
		exit;
}

   sendWay2SMS ( "8460348865","cannotaccess",$phone,$msg);

   
   
		$_SESSION["msg"]="Message Sent!";
		header("location:msg.php");
		exit;
?>