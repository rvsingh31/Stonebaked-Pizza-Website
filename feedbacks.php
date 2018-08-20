<?php
	
	session_start();
	if(isset($_SESSION["user_id"]))
	{
		$name=$_SESSION["fullname"];
		include("connection.php");
	}
	else
		{
			header("location:index.php?msg=Login First!&type=0");
			exit;
		}
		$id=$_SESSION["user_id"];
		include("connection.php");
		
		$confirm="select * from orders join address using (addressid) where user_id='$id' and status in ('confirmed','delivered') ";
		$confirm_result=mysqli_query($conn,$confirm);
		
		$open="select * from orders join address using (addressid) where user_id='$id' and status = 'placed' ";
		$open_result=mysqli_query($conn,$open);
		
		$cancel="select * from orders join address using (addressid) where user_id='$id' and status = 'cancelled'";
		$cancel_result=mysqli_query($conn,$cancel);
										
		
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title> Feedbacks </title>

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
	                <li>
	                    <a href="user.php">
	                        <i class="material-icons">person</i>
	                        <p>User Profile</p>
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
						<a class="navbar-brand" href="#"></a>
					</div>
					<div class="collapse navbar-collapse">
					
					</div>
				</div>
			</nav>

	        <div class="content">
	            <div class="container-fluid">
				<div class="row">
					<div class="col sm-12 col-xs-12 col-lg-1 col-md-1"> 
					</div>
					
					<div class="col-sm-12 col-xs-12 col-lg-10 col-md-10">
						<div class="card">
	                            <div class="card-header" data-background-color="purple">
	                                <h4 class="title">Provide Your Feedback</h4>
	                            </div>
	                            <div class="card-content">
								<br>
									<h6 class="category">
									Note: You can mention your reviews based on your previous order experiences,delivery feedbacks,pizza reviews
									your dislikes as well as the negative points in UI(website) . We will definitely work on our shortcomings 
									and try to improve.
									
									</h6>
									
									<form action="store_fb.php" method="post" id="fb_form">
									<div class="form-group label-floating">
										<label class="control-label">Your Review/Feedback</label>
										<textarea class="form-control" rows="5" maxlength='250' id="fb" name="fb"></textarea>
									</div>
									<br>
									<button  type="button" onclick="val()" class="btn btn-primary">SEND</button>
									</form>
	                            </div>
	                     </div>
					</div>
					<div class="col sm-12 col-xs-12 col-lg-2 col-md-2"> 
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
	
	function val()
	{
		var input = document.getElementById("fb").value;
		if(input=='')
		{
			pop('Enter feedback first!');
		}
		else
		{
			document.getElementById("fb_form").submit();
		}
	}
			
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
