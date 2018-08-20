<?php
session_start();
if(!isset($_SESSION["user_id"]))
{
	header("location:index.php?msg=Login First!");
	exit;
}
else if(!isset($_SESSION["details"]))
{
	$_SESSION["msg"]="Error Occured.Try Again Later";
	header("location:home.php");
	exit;
}

$details=$_SESSION["details"];
?>


<!DOCTYPE html>
	<head>
		<title>
			Email Verification
		</title>
		
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <link href="css/material-dashboard.css" rel="stylesheet"/>	
    <link href="css/demo.css" rel="stylesheet" />
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
	
	</head>
	
		<body>
		
		<div class="container">
			<h4 class="category" style="text-align:center">Verify your Email Address</h4>
			<br>
			<br>
			<div class="row">
				<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12" style="background:white;padding:3%">
					<p style="color:purple">Your Information</p>
					<h6 class="category">Email Address: &nbsp;&nbsp; <?php echo $details[0];?></h6>
					<h6 class="category">Contact Number: &nbsp;&nbsp; <?php echo $details[1];?></h6>
					<h6 class="category">Address Line 1: &nbsp;&nbsp; <?php echo $details[4];?></h6>
					<h6 class="category">Address Line 2: &nbsp;&nbsp; <?php echo $details[5];?></h6>
					<h6 class="category">City: &nbsp;&nbsp; <?php echo $details[6];?></h6>
					<h6 class="category">Pincode: &nbsp;&nbsp; <?php echo $details[7];?></h6>
				
					<p class="text-align:right;padding-right:2%">Security Question and Answer have also been recorded but not shown here.</p>
				</div>
				<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12"></div>
				<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12"  style="background:white;padding:3%">
					<h6 class="category">
						This information is not saved in the system and are temporary .
						To save your details , a verification code has been sent to the email-address specified.
						Enter the code mentioned in the mail here to verify your email address.
					</h6>
				
					<form method="post" action="store_info.php" id="code_form">
						<div class="form-group label-floating">
							<label class="control-label">Verification Code</label>
							<input type="text" name="code" id="code" class="form-control" >
						</div>
						<button class="btn btn-primary pull-right" type="button" onclick="check()">Verify</button>
					</form>
				</div>
			</div>
		</div>
			<footer class="footer">
				<div class="container-fluid">		
					<p class="copyright" style="align:center;text-align:center">
						&copy; <script>document.write(new Date().getFullYear())</script> <a href="#!">StoneBaked Pizza</a> , Developed By <a href="#!">Ravinder Singh</a>.
					</p>
				</div>
			</footer>
	
	
	
	
	<script src="js/jquery-3.1.0.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/material.min.js" type="text/javascript"></script>

	
	<script src="js/bootstrap-notify.js"></script>

	
	<!-- Material Dashboard javascript methods -->
	<script src="js/material-dashboard.js"></script>

	<script src="js/demo.js"></script>
	
	<script>
				
function pop(x)
{
		$.notify({
					icon_type: 'img',
					icon: 'images/bell.png',
					message: x,
				},{
					element: 'body',
					icon_type: 'img',
					position: null,
					type: "danger",
					allow_dismiss: true,
					newest_on_top: false,
					showProgressbar: false,
					placement: {
						from: "top",
						align: "right"
					},
					offset: 20,
					spacing: 30,
				});
		
}

function check(){
	
	var s=document.getElementById("code").value;
	if(s=="")
	{
		pop('Enter the Verification Code!');
	}
	else
	{
		document.getElementById("code_form").submit();
	}
}


	</script>
	
	<?php
		
		if(isset($_SESSION["msg"]) && !empty($_SESSION["msg"]))
		{
			?>
				<script>
					var msg="<?php echo $_SESSION["msg"]; ?>";
					if(msg!="")
					{
						pop(msg);
					}
				</script>
				
			<?php
			
			unset($_SESSION["msg"]);
		}
	
	?>
		</body>

</html>