<?php
include("pizza.php");
session_start();

	if(!isset($_SESSION["user_id"]))
	{
			header("location:index.php?msg=Login First!");
			exit;		
	}
		$name=$_SESSION["fullname"];
		include("connection.php");
		include("enc_dec.php");
		$id=$_SESSION["user_id"];
		$sql1="select firstname,lastname,username,password,contact,email from users join step1 on (users.id=step1.userid) where users.id='$id'";
		$sql2="select step2.addressid,add1,add2,city,pincode from step2 join address using (addressid) where step2.userid='$id' and step2.status='enabled'";
		
		$result1=mysqli_query($conn,$sql1);
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result1)<=0)
		{
			$_SESSION["msg"]="Update Profile first!";
			header("location:home.php");
			exit;
		}
		$row=mysqli_fetch_assoc($result1);
		if(mysqli_num_rows($result2)<=0)
		{
			$_SESSION["msg"]="Update Profile first!";
			header("location:home.php");
			exit;
		}
		
		$decoded=$converter->safe_b64decode($row["password"]);
		$password_cnt="";
		for($i=0;$i<strlen($decoded);$i++)
		{
			$password_cnt.="*";
		}
		
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title> Edit Profile </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <link href="css/material-dashboard.css" rel="stylesheet"/>	
    <link href="css/demo.css" rel="stylesheet" />
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
	  <style>
	  
	  .dont-break-out {

  overflow-wrap: break-word;
  word-wrap: break-word;

  -ms-word-break: break-all;
  word-break: break-all;
  word-break: break-word;

  -ms-hyphens: auto;
  -moz-hyphens: auto;
  -webkit-hyphens: auto;
  hyphens: auto;

}
		
			.item_hover:hover{
				background:	#EEEEEE;
			}
			
			.item_hover{
				transition:all .3s ease-in;
			}
			
			
	  </style>
	  
	</head>
<body>

	<div class="wrapper">
	    <div class="sidebar" data-color="purple" data-image="img/sidebar-1.jpg">
		<div class="logo">
				<a href="#" class="simple-text">
				<?php echo $name;?>
				</a>
			</div>

	    	<div class="sidebar-wrapper">
				<ul class="nav">
	                <li>
	                    <a href="home.php">
	                        <i class="material-icons">dashboard</i>
	                        <p>Dashboard</p>
	                    </a>
	                </li>
	                <li class="active">
	                    <a href="user.php">
	                        <i class="material-icons">person</i>
	                        <p>User Profile</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="all_feedbacks.php">
	                        <i class="material-icons">content_paste</i>
	                        <p>User Feedbacks</p>
	                    </a>
	                </li>
					<li>
	                    <a href="logout.php">
	                        <i class="material-icons">exit_to_app</i>
	                        <p>Sign Out</p>
	                    </a>
	                </li>
	            </ul>
	    	</div>
	    </div>

	    <div class="main-panel">
			<nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Profile</a>
					</div>
					
				</div>
			</nav>

	        <div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="purple">
	                                <h4 class="title">Edit Profile</h4>
								</div>
	                            <div class="card-content">
								<br>
								<h6 class="category" style="text-align:right">Personal Information</h6>
								<br>
	                                <div class="row">
										<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
											<h6 class="category" style="text-align:center">Name: <span style="color:purple"><?php echo $row["firstname"]." ".$row["lastname"];?></span> </h6>
											<br>
											<div id="name_btn" style="text-align:center">
												<button type="button" id="ch_name_btn" class="btn btn-primary">CHANGE</button>
											</div>
											<div id="ch_name_div" style="display:none">
												<div class="row">
													<form action="update.php?type=firstname" id="fn_form" method="post">	
														<div style="text-align:center" class="col-sm-6 col-xs-6 col-md-6 col-lg-6 form-group label-floating">
															<label class="control-label">First Name</label>
															<input type="text" name="new_firstname" id="new_firstname" class="form-control">
															<br>
															<button type="button" class="btn btn-secondary" onclick="validate('firstname')">UPDATE</button>
														</div>
													</form>
													<form action="update.php?type=lastname"  id="ln_form" method="post">	
														<div style="text-align:center" class="col-sm-6 col-xs-6 col-md-6 col-lg-6 form-group label-floating">
															<label class="control-label">Last Name</label>
															<input type="text" name="new_lastname" id="new_lastname"  class="form-control">
															<br>
															<button type="button" class="btn btn-secondary" onclick="validate('lastname')">UPDATE</button>
														</div>
													</form>
													<br>
													<div id="name_toggle" style="text-align:center">
														<button type="button" id="toggle_name_btn" class="btn btn-primary">HIDE</button>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
											<h6 class="category" style="text-align:center">Username: <span style="color:purple"><?php echo $row["username"];?></span> </h6>
											<br>
											<div id="username_btn" style="text-align:center">
												<button type="button" id="ch_username_btn" class="btn btn-primary">CHANGE</button>
											</div>
											<div id="ch_username_div" style="display:none">
												<form action="update.php?type=username" id="un_form" method="post">	
													<div class="row">
														<div style="text-align:center" class="col-sm12 col-xs-12 col-lg-12 col-md-12 form-group label-floating">
															<label class="control-label">UserName</label>
																<input type="text" name="new_username" id="new_username" class="form-control">
																<br>
																<button type="button" class="btn btn-secondary" onclick="validate('username')">UPDATE</button>
														</div>
													</div>
												</form>
												<br>
												<div id="username_toggle" style="text-align:center">
														<button type="button" id="toggle_username_btn" class="btn btn-primary">HIDE</button>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
											<h6 class="category" style="text-align:center">Password: <span style="color:purple"><?php echo $password_cnt;?></span> </h6>
											<br>
											<div id="password_btn" style="text-align:center">
												<button type="button" id="ch_password_btn" class="btn btn-primary">CHANGE</button>
											</div>
											<div id="ch_password_div" style="display:none">
												<form action="update.php?type=password"  id="pd_form" method="post">	
													<div class="row">
														<div style="text-align:center" class="col-sm12 col-xs-12 col-lg-12 col-md-12 ">
															<div class="form-group label-floating">	
																<label class="control-label">Password</label>
																<input type="password" name="new_password" id="new_password" class="form-control">
															</div>
															<div class="form-group label-floating">	
																<label class="control-label">Password(Again)</label>
																<input type="password" name="new_repassword"id="new_repassword" class="form-control">
															</div>
																<br>
																<button type="button" class="btn btn-secondary"  onclick="validate('password')">UPDATE</button>
														</div>
													</div>
												</form>
												<br>
												<div id="password_toggle" style="text-align:center">
														<button type="button" id="toggle_password_btn" class="btn btn-primary">HIDE</button>
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
											<h6 class="category" style="text-align:center">Contact Number: <span style="color:purple"><?php echo $row["contact"];?></span> </h6>
											<br>
											<div id="contact_btn" style="text-align:center">
												<button type="button" id="ch_contact_btn" class="btn btn-primary">CHANGE</button>
											</div>
											<div id="ch_contact_div" style="display:none">
												<form action="update.php?type=contact" id="ct_form" method="post">	
													<div class="row">
														<div style="text-align:center" class="col-sm12 col-xs-12 col-lg-12 col-md-12 form-group label-floating">
															<label class="control-label">Contact</label>
																<input type="text" name="new_contact" id="new_contact" class="form-control">
																<br>
																<button type="button" class="btn btn-secondary"  onclick="validate('contact')">UPDATE</button>
														</div>
													</div>
												</form>
												<br>
												<div id="contact_toggle" style="text-align:center">
														<button type="button" id="toggle_contact_btn" class="btn btn-primary">HIDE</button>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
											<h6 class="category" style="text-align:center">Email Address: <span style="color:purple"><?php echo $row["email"];?></span> </h6>
											<br>
											<div id="email_btn" style="text-align:center">
												<button type="button" id="ch_email_btn" class="btn btn-primary">CHANGE</button>
											</div>
											<div id="ch_email_div" style="display:none">
												<form action="update.php?type=email" id="em_form" method="post">	
													<div class="row">
														<div style="text-align:center" class="col-sm12 col-xs-12 col-lg-12 col-md-12 form-group label-floating">
															<label class="control-label">Email</label>
																<input type="text" name="new_email" id="new_email" class="form-control">
																<br>
																<button type="button" class="btn btn-secondary"  onclick="validate('email')">UPDATE</button>
														</div>
													</div>
												</form>
												<br>
												<div id="email_toggle" style="text-align:center">
														<button type="button" id="toggle_email_btn" class="btn btn-primary">HIDE</button>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
										</div>
									</div>
									<br>
									<h6 class="category"  style="text-align:right">Address Information</h6>
									<br>
									<div id="show_address_btn" style="text-align:left">
										<button type="button" id="show_address" class="btn btn-primary">SHOW EXISTING ADDRESSES</button>
									</div>
									<br>
							<div id="address_div" style="display:none">
										<?php
										$c=0;
											while($row2=mysqli_fetch_assoc($result2))
											{
												$c++;
												$add1=$row2["add1"];
												$add2=$row2["add2"];
												$city=$row2["city"];
												$pincode=$row2["pincode"];
												$addressid=$row2["addressid"];
												$add_enc=$converter->safe_b64encode($addressid);
												?>
													<hr class="category">
														<h6 class="category">Address Line 1: <span style="color:purple"><?php echo $add1;?></span>
														<br>
														Address Line 2: <span style="color:purple"><?php echo $add2;?></span>
														<br>
														City: <span style="color:purple"><?php echo $city;?></span>
														<br>
														Pincode: <span style="color:purple"><?php  echo $pincode; ?></span></h6>
														<div style="text-align:right">
															<a href="delete_address.php?id=<?php echo $add_enc;?>"><button type="button" class="btn btn-primary">DELETE</button></a>
														</div>
														
															<hr class="category">
															<br>
												<?php
											}
										?>
									<div style="text-align:left"  id="hide_address_btn">
										<button type="button" id="hide_address" class="btn btn-primary">HIDE </button>
									</div>		
									
								
	                        </div>
							<br>
								<button type='button' id="new_address_btn" class='btn btn-primary'>Add new Address</button>
							<div id="new_address_div" style="display:none">
							<br>
								<h6 class="category">Add New Address</h6>
								<br>
								<form action="add_new_address.php?type=user" method="post" id="new_form">
								<div class="form-group label-floating">
										<label class="control-label">Address Line 1</label>
										<input type="text" name="add1" id="add1" class="form-control" >
								</div>
								<div class="form-group label-floating">
										<label class="control-label">Address Line 2</label>
										<input type="text" name="add2" id="add2" class="form-control" >
								</div>
								<div class="form-group label-floating">
										<label class="control-label">City</label>
										<input type="text" name="city" id="city" class="form-control" >
								</div>
								<div class="form-group label-floating">
										<label class="control-label">Pincode</label>
										<input type="text" name="pincode" id="pincode" class="form-control" >
								</div>
								<br>
								<h6 class="category" style="color:red">All fields are necessary.</h6>
								<button class="btn btn-primary" type="button" onclick="val()" >Add</button>
							</form>
							
							<button type='button' id="hide_new_address_btn" class='btn btn-primary' data-target="#" data-toggle="modal">Hide</button>
							</div>
			
						</div>

	                </div>
	            </div>
	        </div>
			
			
			

	        <footer class="footer">
				<div class="container-fluid">
					
					<p class="copyright pull-right">
						&copy; <script>document.write(new Date().getFullYear())</script> <a href="#!">StoneBaked Pizza</a> , Developed By <a href="http://rvsingh31.github.io">Ravinder Singh</a>.
					</p>
				</div>
			</footer>
			
			
			
			
	    </div>
	</div>


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

$(document).ready(function(){
	
	$("#ch_name_btn").click(function(){
	
		$("#name_btn").slideUp();
		setTimeout(function(){$("#ch_name_div").slideDown();},500);
	});
	$("#toggle_name_btn").click(function(){
	
		$("#ch_name_div").slideUp();
		setTimeout(function(){$("#name_btn").slideDown();},500);
	});
	
	$("#ch_username_btn").click(function(){
	
		$("#username_btn").slideUp();
		setTimeout(function(){$("#ch_username_div").slideDown();},500);
	});
	$("#toggle_username_btn").click(function(){
	
		$("#ch_username_div").slideUp();
		setTimeout(function(){$("#username_btn").slideDown();},500);
	});
	
	$("#ch_password_btn").click(function(){
	
		$("#password_btn").slideUp();
		setTimeout(function(){$("#ch_password_div").slideDown();},500);
	});
	$("#toggle_password_btn").click(function(){
	
		$("#ch_password_div").slideUp();
		setTimeout(function(){$("#password_btn").slideDown();},500);
	});
	
	$("#ch_contact_btn").click(function(){
	
		$("#contact_btn").slideUp();
		setTimeout(function(){$("#ch_contact_div").slideDown();},500);
	});
	$("#toggle_contact_btn").click(function(){
	
		$("#ch_contact_div").slideUp();
		setTimeout(function(){$("#contact_btn").slideDown();},500);
	});
	
	$("#ch_email_btn").click(function(){
	
		$("#email_btn").slideUp();
		setTimeout(function(){$("#ch_email_div").slideDown();},500);
	});
	$("#toggle_email_btn").click(function(){
	
		$("#ch_email_div").slideUp();
		setTimeout(function(){$("#email_btn").slideDown();},500);
	});
	
	$("#show_address").click(function(){
	
		$("#show_address_btn").slideUp();
		setTimeout(function(){$("#address_div").slideDown();},500);
	});
	$("#hide_address").click(function(){
	
		$("#address_div").slideUp();
		setTimeout(function(){$("#show_address_btn").slideDown();},500);
	});
	
	$("#new_address_btn").click(function(){
	
		$("#new_address_btn").slideUp();
		setTimeout(function(){$("#new_address_div").slideDown();},500);
	});
	$("#hide_new_address_btn").click(function(){
	
		$("#new_address_div").slideUp();
		setTimeout(function(){$("#new_address_btn").slideDown();},500);
	});
});
	
function val()
{
	var add1=document.getElementById("add1").value;
	var add2=document.getElementById("add2").value;
	var city=document.getElementById("city").value;
	var pincode=document.getElementById("pincode").value;

		if(add1=='' || add2=='' || city=='' || pincode=='')
		{
			pop('All fields are necessary!');
		}
		else if(pincode.match(/\D/g))
		{
			pop('Pincode should be a number.');
		}
		else
		{
			document.getElementById("new_form").submit();
		}
	
}

	
	
	
	
function validate(type)
{
	if(type=="firstname")
	{
		var value=document.getElementById("new_firstname").value;
		if(value=='')
		{
			pop('Input field cannot be empty');
		}
		else
		{
			document.getElementById("fn_form").submit();
		}
	}
	else if(type=="lastname")
	{
		var value=document.getElementById("new_lastname").value;
		if(value=='')
		{
			pop('Input field cannot be empty');
		}
		else
		{
			document.getElementById("ln_form").submit();
		}
	}
	else if(type=="username")
	{
		var value=document.getElementById("new_username").value;
		if(value=='')
		{
			pop('Input field cannot be empty');
		}
		else
		{
			document.getElementById("un_form").submit();
		}
	}
	else if(type=="password")
	{
		var value1=document.getElementById("new_password").value;
		var value2=document.getElementById("new_repassword").value;
		
		if(value=='' || value2=='')
		{
			pop('Input field cannot be empty');
		}
		else if(value1!=value2)
		{
			pop('Both passwords don\'t match');
		}
		else
		{
				document.getElementById("pd_form").submit();
		}
	}
	else if(type=="contact")
	{
		var value=document.getElementById("new_contact").value;
		if(value=='')
		{
			pop('Input field cannot be empty');
		}
		if(value.length!=10)
		{
			pop('Invalid Contact Number');			
		}
		else if(value.match(/\D/g))
		{
			pop('Contact should be a number');
		}
		else
		{
			document.getElementById("ct_form").submit();
		}
	}
	else if(type=="email")
	{
		var value=document.getElementById("new_email").value;
		if(value=='')
		{
			pop('Input field cannot be empty');
		}
		else if(validateEmail(value)!==true)
		{
			pop('Email Address is Invalid!');
		}
		else
		{
			document.getElementById("em_form").submit();
		}
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
