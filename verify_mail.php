<!DOCTYPE html>
	<head>
		<title>
			Password Recovery
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
			<h4 class="category" style="text-align:center">Verify The Code</h4>
			
			<br>
			<br>
			<div class="row">
				<div class="col-xl-2 col-lg-3 col-md-3 col-sm-12"></div>
				<div class="col-xl-5 col-lg-6 col-md-6 col-sm-12"  style="background:white;padding:3%">
						<h6 class="category">
						 A verification code has been sent to your registered email-address specified.
						Enter the code mentioned in the mail here to change your password.
						</h6>
						
						<div class="form-group label-floating">
							<label class="control-label">Verification Code</label>
							<input type="text" name="code" id="code" class="form-control" >
						</div>
						<button class="btn btn-primary pull-right" type="button" onclick="check()">Verify</button>
					
				</div>
				<div class="col-xl-2 col-lg-3 col-md-3 col-sm-12"></div>
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
		pop('Enter the code First!');
	}
	else
	{
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				alert(this.responseText);
			    if($.trim(this.responseText)=="done")
				{
					alert("in");
					$(location).attr('href', 'http://www.stonebakedpizza.in/changepassword.php');
				}
				else
				{
						pop('Mentioned Code is incorrect!');						
				}
            }
        };
        xmlhttp.open("POST", "ajax_check_code.php?q="+s, true);
        xmlhttp.send();
	
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