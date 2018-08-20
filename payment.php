<?php
session_start();
if(!isset($_SESSION["user_id"]))
{
	header("location:index.php");
	exit;
}
else if(!isset($_SESSION["cart"]) || !isset($_SESSION["grand_total"]) || !isset($_SESSION["credits"]))
{
	$_SESSION["msg"]="No items in cart to place your order!";
	header("location:home.php");
	exit;
}
else if( !isset($_SESSION["delivery_address"]) )
{
	
	$_SESSION["msg"]="Select a delivery Address first!";
	header("location:checkout.php");
	exit;
}

	include("connection.php");
	$id=$_SESSION["user_id"];
	$sql="select total_credits from users where id='$id'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_assoc($result);
		$cr=$row["total_credits"];
		if($cr>100)
		{
			$proceed="yes";
		}
		else
		{
			$proceed="no";
		}
	}
	else
	{
		header("location:index.php?msg=Login First!");
		exit;
	}
		
		$add_id=$_SESSION["delivery_address"];
									$add_query="select add1,add2,city,pincode from address where addressid='$add_id'";
									$add_res=mysqli_query($conn,$add_query);
									if(mysqli_num_rows($add_res)>0)
									{
										$add_row=mysqli_fetch_assoc($add_res);
										$add1=$add_row["add1"];
										$add2=$add_row["add2"];
										$city=$add_row["city"];
										$pincode=$add_row["pincode"];
										$address="<br/>".$add1.",<br/>".$add2.",<br/>".$city.",".$pincode;
									}
									else
									{
										$_SESSION[]="Some Error Occured!Try again Later!";
										header("location:home.php");
										exit;
									}
?>


<!DOCTYPE html>
	<head>
		<title>
			Pay for your Order
		</title>
		
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <link href="css/material-dashboard.css" rel="stylesheet"/>	
    <link href="css/demo.css" rel="stylesheet" />
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
	<style>
	#tool_tip{
		cursor:pointer;
	}
	</style>
	</head>
	
		<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
					<li class="active"><a href="#">Payment Method</a></li>
					<li><a href="checkout.php">Return to Order</a></li>
					<li><a href="home.php">Return to Dashboard</a></li>
				</ul>
			</div>
		</div>	
		
		</nav>
		
		<div class="container">
			<div class="row">
				<div class="col-xl-2 col-lg-2 col-md-2 col-sm-1 col-xs-1">
					
				</div>
				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-10 col-xs-10" style="background:white;padding:3%;">
					<h6 style="text-align:center">Complete your Order</h6> 
					<hr class="category"/>
						<button class="btn btn-primary" type="button" onclick="fill_cart()">Cart Information</button>
						<br>
						<h6 style="color:#EAABAB">Total items: &nbsp; <span style="color:purple"><?php echo $_SESSION["items_count"];?> </span></h6>
						<h6 style="color:#EAABAB">Total Amount: &nbsp; <span style="color:purple">Rs. <?php echo $_SESSION["grand_total"];?> </span></h6>
						<h6 style="color:#EAABAB">Earned Credits: &nbsp; <span style="color:purple"> <?php echo $_SESSION["credits"];?> </span></h6>
						<h6 style="color:#EAABAB">Delivery Charges <span style="color:red" id="tool_tip">( ? )</span>: &nbsp; <span style="color:purple">Rs.  
						<?php
							if($_SESSION["grand_total"]<300)
							{
								if(isset($_SESSION["delivery_charges"]))
								{
									$_SESSION["delivery_charges"]=20;
									
								}
								else
								{
									$_SESSION["delivery_charges"]=20;	
								}
								echo $_SESSION["delivery_charges"];
							}
							else
							{
								if(isset($_SESSION["delivery_charges"]))
								{
									$_SESSION["delivery_charges"]=0;
									
								}
								else
								{
									$_SESSION["delivery_charges"]=0;	
								}
								echo $_SESSION["delivery_charges"];
								
							}
						?>
						</span></h6>
						<h6 id="tool_tip_h" style="color:red;display:none" > Delivery of an order less than Rs. 300 will be charged Rs. 20 as home-delivery charges.</h6>
						<br>
						
						<h6 style="text-align:center" class="category">Mode of Payment</h6>
						<hr />
							<label><input type="radio" value="cod" name="method" id="cod_open" /> Cash on Delivery</label>
							<br>
							<div id="cod_div" style="display:none">
								<h6 style="color:#EAABAB">Delivery and Billing Address : &nbsp; <span style="color:purple"><?php echo $address;?> </span></h6>
								<br/>
								<a href="cod.php"><button type="button" class="btn btn-primary">Place Order</button></a>
								<p style="color:purple;opacity:0.8">NOTE: Once you click this button ,your order will be delivered at the given address, prior to which ,a confirmation mail will be sent on your registered email address.</p>
							</div>
							<br>
							<label><input type="radio" value="credits" name="method" id="credits_open" /> Use Your Existing Credits</label>
							<div id="cr_div" style="display:none">
								<?php if($proceed=="yes"){ ?>
										<h6 style="color:#EAABAB">Delivery and Billing Address : &nbsp; <span style="color:purple"><?php echo $address;?> </span></h6>
										<br>
									<h6 style="color:#EAABAB">Your Credits: &nbsp; <span style="color:purple"> <?php echo $cr;?> </span></h6>
								<form action="credit_method.php" method="post" id="credits_pay_form">	
									<div class="form-group label-floating">
									<label for="control-label">How many Credits do you want to use?</label>																					
									<input name="use_credits" id="use_credits" onchange="calc_final()" onfocus="clear_area()" class="form-control" type="text" value="<?php
																										
																										$final_amount=0;
																										
																										if($_SESSION["grand_total"]>$cr)
																										{
																											$final_amount=$_SESSION["grand_total"]-$cr;
																											echo $cr;
																										}
																										else
																										{
																											$final_amount=$cr-$_SESSION["grand_total"];
																											echo $_SESSION["grand_total"];
																										}
																											?>"/>
									</div>
									<br>
										<button type="button" class="btn btn-primary" id="proceed_cr_btn" onclick="check_credits()">Proceed</button>
									<div id="final_place" style="display:none">
									
									</div>
								</form>
								<?php }
								else
								{
										?>
										
									<h6 style="color:red" style="text-align:center">Your credits aren't sufficient enough to qualify for usage purpose ! Pay using COD.</h6>
								
								<?php
								}
								?>
							</div>
				</div>
				<div class="col-xl-2 col-lg-2 col-md-2 col-sm-1 col-xs-1" >
					
				</div>
			</div>
			
		</div>
			<div id="cart" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Your Order Details</h4>
						</div>
						<div class="modal-body" id="cart_info">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
		
			<footer class="footer">
				<div class="container-fluid">		
					<p class="copyright" style="align:center;text-align:center">
						&copy; <script>document.write(new Date().getFullYear())</script> <a href="#!">StoneBaked Pizza</a> , Developed By <a href="http://www.rvsingh31.github.io">Ravinder Singh</a>.
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


function clear_area()
{
		if($("#final_place").is(':visible'))
		{
			$("#final_place").slideUp();
			setTimeout(function(){$("#proceed_cr_btn").fadeIn();},500);
		}
}

	$(document).on('click','#tool_tip',function(){
		
		if($("#tool_tip_h").is(":visible"))
		{
			$("#tool_tip_h").slideUp();
		}
		else
		{
			$("#tool_tip_h").slideDown();
		}
	});
	
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

$(document).on('click','#credits_open',function(){
	if($("#credits_open").prop('checked'))
	{
		$("#cod_div").slideUp();
		setTimeout(function(){$("#cr_div").slideDown();},500);
		
	}
});

$(document).on('click','#cod_open',function(){
	if($("#cod_open").prop('checked'))
	{
		$("#cr_div").slideUp();
		setTimeout(function(){$("#cod_div").slideDown();},500);
		
	}
	
	
});

function calc_final()
{
	var credits=<?php echo $cr?>;
	var entered_credits=document.getElementById("use_credits").value;
	if(entered_credits>credits)
	{
		pop("Invalid Amount Entered!");
	}
}

function check_credits()
{
	var credits=<?php echo $cr?>;
	var total=<?php echo $_SESSION["grand_total"]?>;
	var entered_credits=document.getElementById("use_credits").value;
	if(entered_credits>credits)
	{
		pop("Invalid Amount Entered!");
	}

	else if(entered_credits>total)
	{
		pop("Invalid Amount Entered!");
	}
	else
	{
		var left=total-entered_credits;	
			$("#proceed_cr_btn").fadeOut();
		document.getElementById("final_place").innerHTML="<h6 style='color:#EAABAB'>Final Amount: &nbsp; <span style='color:purple'>Rs. "+left+" </span></h6>		<button type='button' class='btn btn-primary' onclick='final_validate()'>Place Order</button>";
		$("#final_place").slideDown();
	}
}

function final_validate()
{
	
		var entered_credits=document.getElementById("use_credits").value;
		if(entered_credits=='')
		{
			pop('Mention a specific amount');
		}
		else
		{
				document.getElementById("credits_pay_form").submit();
		}
}

function fill_cart(){
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
			    document.getElementById("cart_info").innerHTML=this.responseText;
				$("#cart").modal('show');
			}
        };
        xmlhttp.open("GET", "get_cart.php", true);
        xmlhttp.send();
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