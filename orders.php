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

	<title> Your Orders </title>

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
						<a class="navbar-brand" href="#">Your Orders</a>
					</div>
					<div class="collapse navbar-collapse">
					
					</div>
				</div>
			</nav>

	        <div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                     <ul class="nav nav-pills">
								<li><a data-toggle="pill" href="#confirmed">Confirmed Orders</a></li>
								<li class="active"><a data-toggle="pill" href="#open">Open Orders</a></li>
								<li><a data-toggle="pill" href="#cancel">Cancelled Orders</a></li>
						</ul>
						<div class="tab-content">
							<div id="confirmed" class="tab-pane fade">
							<br>
								<div class="row">
									<div class="col-sm-12 col-xs-12 col-lg-1 col-md-1">
									</div>
									<div class="col-sm-12 col-xs-12 col-lg-10 col-md-10">
									<?php
									
										if(mysqli_num_rows($confirm_result)>0)
										{
											while($all_rows=mysqli_fetch_assoc($confirm_result))
											{
												$order_id=$all_rows["order_id"];
												$date=$all_rows["date"];
												$total=$all_rows["total_cost"];
												$credits=$all_rows["total_credits"];
												$status=$all_rows["status"];
												$address=$all_rows["add1"].",".$all_rows["add2"].",".$all_rows["city"].",".$all_rows["pincode"];
												$add_id=$all_rows["addressid"];
												if($status=="delivered")
												{
													echo "<div class='card' style='background:#8DE0F4'>";
												}
												else
												{
													echo "<div class='card'>";
												}
												?>
												
													<div class="row" style="padding:3%">
														<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
															<h6 class="category">STATUS : <span style="color:purple"><?php echo $status; ?></span></h6>
														</div>
														<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
															<h6 class="category">TOTAL :<span style="color:purple">Rs. <?php echo $total; ?></span></h6>
														</div>
														<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
															<h6 class="category">Earned Credits : <span style="color:purple"><?php echo $credits; ?></span></h6>
														</div>
													</div>
													<div class="row" style="padding:3%">
														<div>
														<?php
															
																$all_items="select * from order_details join items using (item_id) where order_id='$order_id'";
																$items=mysqli_query($conn,$all_items);
																while($co_item=mysqli_fetch_assoc($items))
																{
															?>
																<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
																<h5 style="color:purple"><?php echo $co_item["name"];?></h5>
																		<h6 class="category">Total Quantity : <span style="color:purple"><?php echo $co_item["total_qty"]; ?></span></h6>
																<?php
																	if($co_item["cheese_qty"]>0)
																	{
																	?>
																		<h6 class="category">Extra Cheese in : <span style="color:purple"><?php echo $co_item["cheese_qty"]; ?></span></h6>
																
														<?php
																	}
																	?>
																	
																	<hr>
																	
																	</div>
														<?php		
																}
												
														?>
														
														</div>
													
													</div>
													
													<div class="row" style="padding:3%">
														<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
																	<h6 class="category dont-break-out">Delivery and Billing Address : <span style="color:purple"><?php echo $address; ?></span></h6>
														</div>
													</div>
													
													
												</div>
												<br>
										<?php		
											}
										}
										else
										{
											echo "<h6 class='category' style='text-align : center'>No Orders to Show!</h6>";
										}
									?>
									</div>
									<div class="col-sm-12 col-xs-12 col-lg-1 col-md-1">
									</div>
								</div>
							</div>
							<div id="open" class="tab-pane fade in active">
							<br>
								<h5>NOTE: An open order can only be cancelled until the Admin do not confirm it! Once the order is confirmed, it cannot be cancelled.</h5>
								<br>
								<div class="row">
									<div class="col-sm-12 col-xs-12 col-lg-1 col-md-1">
									</div>
									<div class="col-sm-12 col-xs-12 col-lg-10 col-md-10">
									<?php
									
										if(mysqli_num_rows($open_result)>0)
										{
											while($open_rows=mysqli_fetch_assoc($open_result))
											{
												$o_order_id=$open_rows["order_id"];
												$o_date=$open_rows["date"];
												$o_total=$open_rows["total_cost"];
												$o_credits=$open_rows["total_credits"];
												$o_status=$open_rows["status"];
												$o_address=$open_rows["add1"].",".$open_rows["add2"].",".$open_rows["city"].",".$open_rows["pincode"];
												$o_add_id=$open_rows["addressid"];
												
												
												?>
												
												<div class="card">
													<div class="row" style="padding:3%">
														<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
															<h6 class="category">STATUS : <span style="color:purple"><?php echo $o_status; ?></span></h6>
														</div>
														<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
															<h6 class="category">TOTAL :<span style="color:purple">Rs. <?php echo $o_total; ?></span></h6>
														</div>
														<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
															<h6 class="category">Earned Credits : <span style="color:purple"><?php echo $o_credits; ?></span></h6>
														</div>
													</div>
													
													<div class="row" style="padding:3%">
														<div>
														<?php
															
																$open_items="select * from order_details join items using (item_id) where order_id='$o_order_id'";
																$op=mysqli_query($conn,$open_items);
																while($op_item=mysqli_fetch_assoc($op))
																{
															?>
																<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
																<h5 style="color:purple"><?php echo $op_item["name"];?></h5>
																		<h6 class="category">Total Quantity : <span style="color:purple"><?php echo $op_item["total_qty"]; ?></span></h6>
																<?php
																	if($op_item["cheese_qty"]>0)
																	{
																	?>
																		<h6 class="category">Extra Cheese in : <span style="color:purple"><?php echo $op_item["cheese_qty"]; ?></span></h6>
																
														<?php
																	}
																	?>
																	
																	<hr>
																	
																	</div>
														<?php		
																}
												
														?>
														</div>
													</div>
													
													<div class="row" style="padding:3%">
														<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
																	<h6 class="category dont-break-out">Delivery and Billing Address : <span style="color:purple"><?php echo $o_address; ?></span></h6>
														</div>
													</div>
																<div style="text-align:right"> 	
																		<a href="cancel_order.php?order_id=<?php echo $o_order_id;?>"><button type="button" class="btn btn-primary">CANCEL ORDER</button></a>
																	</div>
												</div>
												<br>
										<?php		
											}
										}
										else
										{
											echo "<h6 class='category' style='text-align : center'>No Orders to Show!</h6>";
										}
									?>
									</div>
									<div class="col-sm-12 col-xs-12 col-lg-1 col-md-1">
									</div>
								</div>
							</div>
							<div id="cancel" class="tab-pane fade">
							<br>
								<div class="row">
									<div class="col-sm-12 col-xs-12 col-lg-1 col-md-1">
									</div>
									<div class="col-sm-12 col-xs-12 col-lg-10 col-md-10">
									<?php
									
										if(mysqli_num_rows($cancel_result)>0)
										{
											while($cancel_rows=mysqli_fetch_assoc($cancel_result))
											{
												$c_order_id=$cancel_rows["order_id"];
												$c_date=$cancel_rows["date"];
												$c_total=$cancel_rows["total_cost"];
												$c_credits=$cancel_rows["total_credits"];
												$c_status=$cancel_rows["status"];
												$c_address=$cancel_rows["add1"].",".$cancel_rows["add2"].",".$cancel_rows["city"].",".$cancel_rows["pincode"];
												$c_add_id=$cancel_rows["addressid"];
												
												
												?>
												
												<div class="card">
													<div class="row" style="padding:3%">
														<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
															<h6 class="category">STATUS : <span style="color:purple"><?php echo $c_status; ?></span></h6>
														</div>
														<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
															<h6 class="category">TOTAL :<span style="color:purple">Rs. <?php echo $c_total; ?></span></h6>
														</div>
														<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
															<h6 class="category">Earned Credits : <span style="color:purple"><?php echo $c_credits; ?></span></h6>
														</div>
													</div>
													
													<div class="row" style="padding:3%">
														<div>
														<?php
															
																$can_items="select * from order_details join items using (item_id) where order_id='$c_order_id'";
																$cc=mysqli_query($conn,$can_items);
																while($cc_item=mysqli_fetch_assoc($cc))
																{
															?>
																<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
																<h5 style="color:purple"><?php echo $cc_item["name"];?></h5>
																		<h6 class="category">Total Quantity : <span style="color:purple"><?php echo $cc_item["total_qty"]; ?></span></h6>
																<?php
																	if($cc_item["cheese_qty"]>0)
																	{
																	?>
																		<h6 class="category">Extra Cheese in : <span style="color:purple"><?php echo $cc_item["cheese_qty"]; ?></span></h6>
																
														<?php
																	}
																	?>
																	
																	<hr>
																	
																	</div>
														<?php		
																}
												
														?>
														</div>
													</div>
													
													<div class="row" style="padding:3%">
														<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
																	<h6 class="category dont-break-out">Delivery and Billing Address : <span style="color:purple"><?php echo $c_address; ?></span></h6>
														</div>
													</div>
												</div>
												<br>
										<?php		
											}
										}
										else
										{
											echo "<h6 class='category' style='text-align : center'>No Orders to Show!</h6>";
										}
									?>
									</div>
									<div class="col-sm-12 col-xs-12 col-lg-1 col-md-1">
									</div>
								</div>
								
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
