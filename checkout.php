<?php
include("pizza.php");
session_start();
if(!isset($_SESSION["user_id"]))
{
	header("location:index.php");
	exit;
}
else if(!isset($_SESSION["cart"]))
{
	$_SESSION["msg"]="No items in cart to place your order!";
	header("location:home.php");
	exit;
}

	include("connection.php");
		$id=$_SESSION["user_id"];
				$sql="select users.id,username,firstname,lastname,contact,email from (users join step1 on (users.id=step1.userid)) where users.id='$id'";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0)
				{
					$row=mysqli_fetch_assoc($result);
				}
				else
				{
					header("location:index.php?msg=Login First!");
					exit;
				}
		
?>


<!DOCTYPE html>
	<head>
		<title>
			CHECKOUT
		</title>
		
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <link href="css/material-dashboard.css" rel="stylesheet"/>	
    <link href="css/demo.css" rel="stylesheet" />
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
	
	</head>
	
		<body onload="fill_cart()">
		
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
					<li class="active"><a href="#">Place Your Order</a></li>
					<li><a href="home.php">Return to Dashboard</a></li>
				</ul>
			</div>
		</div>	
		
		</nav>
		
	
		<div class="container">
		
		
		<?php
		
				date_default_timezone_set("Asia/Kolkata");
				if(date("h:i:sa") > "06:00:00pm" && date("h:i:sa")<"12:00:00pm")
				{
					?>
				
				
				<div class="row">
						<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12" style="background:white;padding:3%">
					<h6 class="category" style='color:purple;text-align:center'>Customer Details</h6>
					<hr class="category"/>
					<h6 style="color:#EAABAB">Customer Name: &nbsp;<span class="category" style="color:purple"><?php echo $row["firstname"];?> <?php echo $row["lastname"];?></span></h6>
					<h6 style="color:#EAABAB">Email Address: &nbsp;<span style="color:purple"><?php echo $row["email"];?> </span></h6>
					<h6 style="color:#EAABAB">Contact Number: &nbsp;<span style="color:purple"><?php echo $row["contact"];?> </span></h6>
					<h6 style="color:#EAABAB">Deliver the order at: &nbsp;</h6>
					<form action="delivery_add.php" method="post" id="del_form">
					<?php
						$sql2="select add1,add2,city,pincode,addressid from step2 join address using (addressid) where step2.status='enabled' and userid='$id'";
						$result2=mysqli_query($conn,$sql2);
						if(mysqli_num_rows($result2)>0)
						{
							while($row2=mysqli_fetch_assoc($result2))
							{
								$a_id=$row2["addressid"];
								$add1=$row2["add1"];
								$add2=$row2["add2"];
								$city=$row2["city"];
								$pincode=$row2["pincode"];
								$address="<br/>".$add1.",<br/>".$add2.",<br/>".",<br/>".$city.",<br/>".$pincode;
								echo "<label><input type='radio' value='".$a_id."' id='".$a_id."' name='del_add' >".$address."</label>";
							}
						}
						else
						{
							echo "<p class='category'>No Addresses to Show!</p>";
						}
					?>
					<br>
						<button type='button' class='btn btn-danger' href="#new" data-toggle="modal">Add new Address</button>
					</form>
				</div>
				<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12"><br><br></div>
				<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12"  style="background:white;padding:3%;">
					
					<h6 class="category" style="text-align:center">Order Details</h6>
					<hr class="category">
					<div id="cart" style="height:20em;overflow-y:auto">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
				</div>
				<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
				</div>
				<div class="col-sm-12 col-lg-4 col-md-4 col-xs-12">
							<button type="button" class="btn btn-danger" onclick="proceed()" style="align:right;float:right">Proceed to Payment</button>
				</div>
			</div>
			

				
					
					
				<?php	
				
				}
				else
				{
					?>
					
						
					<div class="row" style="text-align:center">
						
						<h6 class="color:red" class="category">
							The store is closed now. So, unfortunately , you cannot place your order right now.<br>
							The open hours are : 6pm - 11pm. Hope to see you during the open hours. Thank You for visiting Stonebaked Pizza.  
						</h6>
					
					</div>
						
						
				
		<?php
				}
		?>
		
			
			
			
		</div>
			<div id="new" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add New Address</h4>
						</div>
						<div class="modal-body">
							<form action="add_new_address.php" method="post" id="new_form">
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
								<button class="btn btn-danger" type="button" onclick="validate()" >Add</button>
							</form>
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

function validate()
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

function proceed()
{
			var x=$('input[name=del_add]:checked','#del_form').val();
			if(x!=null)
			{
				document.getElementById("del_form").submit();
			}
			else
			{
				pop('Select a delivery address first!');
			}
}

function fill_cart(){
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
			    document.getElementById("cart").innerHTML=this.responseText;
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