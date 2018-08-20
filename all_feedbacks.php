<?php
include("pizza.php");
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
		
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title> User Feedbacks </title>

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
	                <li class="active">
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
						<a class="navbar-brand" href="#"></a>
					</div>
					
				</div>
			</nav>

	        <div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="purple">
	                                <h4 class="title">This is what our customers believe</h4>
								</div>
	                            <div class="card-content">
								<?php
									$sql="select * from feedbacks join users on(feedbacks.user_id=users.id) where status='enabled' ";
									$result=mysqli_query($conn,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row=mysqli_fetch_assoc($result))
										{
											echo "<div class='row' style='text-align:left;padding:2%'>
													<h6 class='category'><i class='fa fa-quote-left' aria-hidden='true'></i> &nbsp;&nbsp;&nbsp;".$row["feedback"]."</h6>
														<br>
														<p class='category' style='padding-left:15%'><i>-&nbsp;&nbsp;&nbsp;  ".$row["firstname"]." ".$row["lastname"]."</i></p>
													</div>";
										}
									}
								
								?>
								
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
