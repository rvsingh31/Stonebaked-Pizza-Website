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
			<h4 class="category" style="text-align:center">Recover Your Password</h4>
			
			<br>
			<br>
			<div class="row">
				<div class="col-xl-2 col-lg-3 col-md-3 col-sm-12"></div>
				<div class="col-xl-5 col-lg-6 col-md-6 col-sm-12"  style="background:white;padding:3%">
					<div id="username_check">
						<h6 class="category">
							Enter your registered username for verification
						</h6>
						<div class="form-group label-floating">
							<label class="control-label">Username</label>
							<input type="text" name="username" id="username" class="form-control" >
						</div>
						<div style="text-align:right">
							<button class="btn btn-primary" type="button" onclick="check()">Verify</button>
						</div>
					</div>
					<div id="recover_div" style="display:none">
						<h6 class="category">
							There are two ways to recover your password.<br>Either answer the security question or request a recovery mail.
						</h6>
						<div class="form-group">
							<label for="sec_que">Security Question</label>
								<select class="form-control" id="sec_que" name="sec_que">
									<option value="1">What is the name of your favorite childhood friend?</option>
									<option value="2">What school did you attend for sixth grade?</option>
									<option value="3">In what city or town was your first job?</option>
									<option value="4">What was your childhood nickname?</option>
								</select>
						</div>
						<div class="form-group label-floating">
									<label class="control-label">Answer</label>
									<input type="text" name="answer" id="answer" class="form-control" >
						</div>
						<div style="text-align:right">
							<button class="btn btn-primary" type="button" onclick="check_security()">CHECK ANSWER</button>
						</div>
						<br>
						<h6 class="category">NOTE: On clicking 'SEND RECOVERY MAIL' , a verification code will be sent to your registered email address, provide the verification code to change your password.</h6>
						<div style="text-align:right">
							<a href="send_recovery_mail.php"><button class="btn btn-primary " type="button">SEND RECOVERY MAIL</button></a>
						</div>
						<br>
					</div>
					<h6 class="category">For any kind of help , call +91-900800760 .</h6>
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
	
	var s=document.getElementById("username").value;
	if(s=="")
	{
		pop('Enter Username First!');
	}
	else
	{
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
			    if($.trim(this.responseText)=="error")
				{
					pop('Username Doesn\'t exists!');						
				}
				else
				{
					$("#username_check").fadeOut();
					setTimeout(function(){$("#recover_div").fadeIn();},400);
				}
            }
        };
        xmlhttp.open("POST", "checkusername.php?q="+s+"&type=recover", true);
        xmlhttp.send();
	
	}
}


function check_security()
{
			var sec_que=document.getElementById("sec_que").value;
			var answer=document.getElementById("answer").value;
			if(sec_que=='' || answer=='' )
			{
				pop('All fields are required');
			}
			else
			{
				var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						if($.trim(this.responseText)=="no error")
						{
							$(location).attr('href', 'http://www.stonebakedpizza.in/changepassword.php');
						}
						else if($.trim(this.responseText)=="not_found")
						{
								pop('You haven\'t completed your profile,so select RECOVERY EMAIL option to recover your password!');
						} 
						else if($.trim(this.responseText)=="wrong")
						{
							pop('Entered Question/Answer is incorrect!');
						}
						else if($.trim(this.responseText)=="error")
						{
							pop('Enter all details');
						}
					}
				};
				xmlhttp.open("POST", "check_security.php?sec_que="+sec_que+"&answer="+answer, true);
				xmlhttp.send();
				
			}

			
}
		function validateEmail(email) 
		{
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
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