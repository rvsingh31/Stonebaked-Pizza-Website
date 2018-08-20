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
		
$values=$_SESSION["values"];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title> Dashboard </title>

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
	 
	<div class="wrapper" >     
	 <div class="sidebar" data-color="purple" data-image="img/sidebar-1.jpg">
		
			<div class="logo">
				<a href="#" class="simple-text">
				<?php echo $name;?>
				</a>
			</div>

	    	<div class="sidebar-wrapper">
	            <ul class="nav">
	                <li class="active">
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
						<a class="navbar-brand" href="#">Dashboard</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="#view_cart" id="view_cart_btn" data-toggle="modal">
									<i class="material-icons">shopping_cart</i>
								<!--	<span class="notification"><?php 
										
								/*		if(isset($_SESSION["cart_count"]))
										{
											echo $_SESSION["cart_count"];
										}
										else
										{
											echo "0";
										}
									*/
										?>
									
									</span>
									-->
									<p class="hidden-lg hidden-md">Your Cart</p>
								</a>
							</li>
							
						</ul>
					</div>
				</div>
			</nav>

			<div class="content">
				<div class="container-fluid">
					
	<?php if($_SESSION["step1"]!="complete" || $_SESSION["step2"]!="complete" ){ ?>				
					<div class="row card">
					
							<h6 class="category" style="padding-right:2%;text-align:right">COMPLETE YOUR PROFILE</h6>						
						<br/>
							<h6 style="padding-left:2%;color:purple">PERSONAL INFORMATION</h6>
							<br>
						<div class="card-content">
							<div id="step1" >
							<form method="post" action="intr.php" id="profile_form">
								<div class="form-group label-floating">
										<label class="control-label">Email address</label>
										<input type="email" name="email" value="<?php echo $_SESSION["email_address"];?>" id="email" readonly="readonly" class="form-control" >
								</div>
								<div class="form-group label-floating">
										<label class="control-label">Contact Number</label>
										<input type="text" name="number" id="number" class="form-control" >
								</div>
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
								<br/>
								<h6 style="color:purple">ADDRESS INFORMATION</h6>
								<br/>
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
								
								<button class="btn btn-primary pull-right" type="button" onclick="step1_check()">Finish</button>
							</form>
							
							<br>
							<h6 class="category" style="color:red">All Fields are Required.</h6>
						</div>
							
						</div>
					
					</div>
				<?php
				}
				else
				{
				?>
				<div>
					<div class="row">
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="orange">
									<i class="material-icons">content_copy</i>
								</div>
								<div class="card-content">
									<p class="category">Your Orders</p>
									<h3 class="title"><?php echo $values[0]; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">library_books</i> <a href="orders.php">Order Details</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="green">
									<i class="material-icons">stars</i>
								</div>
								<div class="card-content">
									<p class="category">Earned Credits</p>
									<h3 class="title"><?php echo $values[1]; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">date_range</i> Till Date
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="red">
									<i class="material-icons">info_outline</i>
								</div>
								<div class="card-content">
									<p class="category">Feedbacks</p>
									<h3 class="title"><?php echo $values[2]; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">local_offer</i><a href="feedbacks.php"> Provide Feedbacks</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="blue">
									<i class="material-icons">content_paste</i>
								</div>
								<div class="card-content">
									<p class="category">Suggestions</p>
									<h3 class="title">+<?php echo $values[3]; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">archive</i> <a href="#suggest" data-toggle="modal" >Suggest your Custom Dish</a>
									</div>
								</div>
							</div>
						</div>
					</div>

					

					<div class="row">
					
					
						<div class="col-lg-6 col-md-12">
							<div class="card">
	                            <div class="card-header" data-background-color="red">
	                                <h4 class="title">Menu</h4>
	                                <p class="category">The dishes that you'll love to have.</p>
	                            </div>
	                            <div class="card-content table-responsive" style="height:30em;overflow-y:auto">
	                                <?php 
										$menu="select * from items where type!='add'";
										$result=mysqli_query($conn,$menu);
										while($row=mysqli_fetch_assoc($result))
										{
											$id=$row["item_id"];
											$name=$row["name"];
											$ingredients=$row["ingredients"];
											$price=$row["price"];
											$type=$row["type"];
											?>
											
										<div class="row item_hover">
											<div class="col-lg-6 col-sm-6 col-md-6">
													<h6><?php echo $name;?></h6>
											</div>
											<div class="col-lg-6 col-sm-6 col-md-6">
												<a class="btn btn-primary btn-simple open-modal" href="#details" data-toggle="modal" data-id="<?php echo $id; ?>">
																<i class="material-icons">info</i> DETAILS
												</a>
											</div>
										</div>
										
										<hr class="category"/>
										
										<?php
										}
										
									?>
	                            </div>
	                        </div>
						</div>
					
					
					
					
					
						<div class="col-lg-6 col-md-12">
							<div class="card card-nav-tabs">
								<div class="card-header" data-background-color="red">
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
											<span class="nav-tabs-title">Place a New Order:</span>
											<ul class="nav nav-tabs" data-tabs="tabs">
												<li class="active">
													<a href="#profile" data-toggle="tab">
														<i class="material-icons">keyboard_arrow_down</i>
														Select Dishes
													<div class="ripple-container"></div></a>
												</li>
												
												<li class="" id="load">
													<a href="#settings" data-toggle="tab">
														<i class="material-icons">shopping_cart</i>
														Cart
													<div class="ripple-container"></div></a>
												</li>
											</ul>
										</div>
									</div>
								</div>

								<div class="card-content" >
									<div class="tab-content">
										<div class="tab-pane active" id="profile" style="height:30em;overflow-y:auto">
											<?php 
												$menu2="select * from items order by type desc";
												$res=mysqli_query($conn,$menu2);
												while($row2=mysqli_fetch_assoc($res))
												{
													$id2=$row2["item_id"];
													$name2=$row2["name"];
													$price2=$row2["price"];
											?>
												<div class="row item_hover">
													<div class="col-lg-5 col-sm-6 col-md-5">
														<h6><?php echo $name2;?></h6>
													</div>
													<div class="col-lg-3 col-sm-3 col-md-3">
														<h6>Rs.<?php echo $price2;?></h6>	
													</div>
													<div class="col-lg-4 col-sm-3 col-md-4">
														<button class="btn" style="background:#ED4E4B;align:right" href="#add" data-toggle="modal" data-name="<?php echo $id2; ?>">ADD</button>
													</div>
												</div>
										
												<hr class="category"/>
												
												
												<?php
												
												}
													
											?>
										</div>
										
										<div class="tab-pane" id="settings" style="height:30em;overflow-y:auto">
											
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					
					</div>
					
					<?php
				}
					?>
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
	
				

	<div id="details" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div style="align:center;text-align:center" id="wait_details">
						<img src="images/ring.svg"/>
				</div>
		<div id="details_div">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="item_name"></h4>
				</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-8 col-sm-12 col-lg-8">
						<h5 class="category dont-break-out" id="ing_main"></h5>
						<h5 class="category"><span style="color:purple">Price</span>: <span id="price"></span></h5>
					</div>
					<div class="col-md-4 col-sm-12 col-lg-4" id="item_load">
				 	</div>
				</div>   
			</div> 
			<div class='modal-footer'>
				<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			</div>
		</div>
			</div>
		
		</div>
	</div>
	
	
	
	<div id="remove" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Remove Item?</h4>
				</div>
				<div class="modal-body">
					<h5 class="category">As the mentioned item is not a single item ,
					so enter the quantity to be removed.</h5>
					<h6>Total Quantity: <span id="quantity"></span></h6>
					
					<h6 style="color:purple">Quantity to be removed from the cart:</h6>
					<div class="row" id="rem_rows">
						<div class="row" id="d1" style="display:none"> 
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6" >
								<h6>Below listed are the pizzas with cheese,mention the quantity you want to remove:</h6>
								<input type="text" class="form-control" id="ch_1" value="" />
								<div id="ch_1_btn">
								</div>
							</div>
							
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6" >
								<h6>Below listed are the pizzas without cheese,mention the quantity you want to remove:</h6>
								<input type="text" class="form-control" id="ch_2" value="" />		
								<div id="ch_2_btn">
								</div>
							</div>
						</div>
						
						<div class="row" id="d2" style="display:none"> 
							
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6" >
								<h6 class="category">All Pizzas are without Cheese.Enter the amount of pizza which you want to REMOVE:</h6>
								<input type="text" class="form-control" id="ch_3" value="" />		
								<div id="ch_3_btn">
								</div>
							</div>
						</div>
					</div>
					<hr class="category"/>
					
					<div id="remove_btn">
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			</div>

			</div>

		</div>
	</div>
	
	<div id="remove2" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Remove Item?</h4>
				</div>
			<div class="modal-body">
					<h5 class="category">Remove this item from the cart?</h5>
					<div id="remove2_btn">
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			</div>

			</div>

		</div>
	</div>
	

	<div id="suggest" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Suggest A Dish</h4>
				</div>
			<div class="modal-body">
		
				<h6 class="category">Note: Want your own dish to be in our menu ,Well let us know the recipe and if selected,your dish will be included in our menu.</h6>
					<form method="post" action="store_sg.php" id="sg_form">
					<div class="form-group label-floating">
							<label class="control-label">Provide Details</label>
							<textarea type="text" maxlength='250' rows="5" name="sg" id="sg" class="form-control" ></textarea>
						<button class="btn btn-primary" type="button" onclick="val_sg()">SUBMIT</button>
					</div>
					</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			</div>

			</div>

		</div>
	</div>
	
	
	<div id="add" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<div class="modal-content">
			<div style="align:center;text-align:center" id="wait_add">
						<img src="images/ring.svg"/>
				</div>
			<div id="add_div">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="item_name_2"></h4>
				</div>
				<div class="modal-body">
				<div class="row">
					<div class="col-md-8 col-sm-12 col-lg-8">
						<h5 class="category dont-break-out" id="ing_main_2"></h5>
						<h5 class="category"><span style="color:purple">Price</span>: <span id="price_2"></span></h5>
					</div>
					<div class="col-md-4 col-sm-12 col-lg-4" id="item_load2">
						
					</div>
				</div>
				<div class="row">
						<div class="col-sm-4 col-md-4 col-lg-4">
							 <div class="form-group">
								<label for="sel1">Quantity:</label>
								<select class="form-control" id="qty" name="qty" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0' onblur="this.size=0;">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
								</select>
							</div>
						</div>
						<div class="col-sm-8 col-md-8 col-lg-8">
						</div>
				</div>
				<div class="row">
					<div class="checkbox">
						<label><input type="checkbox" id="cheese" value="" />Extra Cheese (Rs. 50 / pizza )</label>
					</div>
					<br/>
					<div id="show_dp" style="display:none">
					<p class="category">In how many pizza (out of total), would you like to apply extra cheese?</p>
					<select class="form-control" id="c_qty" name="c_qty" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;">
					</select>
					</div>
					
				</div>
				<div class="row" id="cart_button">
				<!--	<button type="button" class="btn" style="background:#ED4E4B;align:right">Add to Cart</button>
				-->
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			</div>
		</div>
			</div>

		</div>
	</div>
	
	
	<div id="view_cart" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<!--<div style="align:center;text-align:center" id="wait_details3">
						<img src="images/ring.svg"/>
				</div>
				
				-->
		<div>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="item_name">Your Cart</h4>
				</div>
			<div class="modal-body">
				<div id="view_cart_div"> 
				</div>   
			</div> 
			<div class='modal-footer'>
				<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			</div>
		</div>
			</div>
		
		</div>
	</div>

	

	<script src="js/jquery-3.1.0.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/material.min.js" type="text/javascript"></script>

	
	<script src="js/bootstrap-notify.js"></script>

	
	<!-- Material Dashboard javascript methods -->
	<script src="js/material-dashboard.js"></script>

	<script src="js/demo.js"></script>
	<script type="text/javascript">

	$('#view_cart').on('show.bs.modal', function(e) {

		
		 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {	
                document.getElementById("view_cart_div").innerHTML = this.responseText;
        	}
        };
        xmlhttp.open("GET", "load.php", true);
        xmlhttp.send();
	
	});
	
	
	
	$("#qty").change(function(){
		call_again();
	});
	
	$(document).on('click','#cheese',function(){
		
		var ch="";
		if($('#cheese').prop('checked')){
	
			ch="yes";
			load_options();
		}
		else
		{
			ch="no";
					$("#show_dp").fadeOut();
				 $('#c_qty').html('');
				 
		}
		
	});
	
	function load_options()
	{
				var qty=document.getElementById("qty").value;
			
			for(var a=1;a<=parseInt(qty);a++)
			{
				var x = document.createElement("OPTION");
				x.setAttribute("value", a);
				var t = document.createTextNode(a);
				x.appendChild(t);
				document.getElementById("c_qty").appendChild(x);	
			}
			$("#show_dp").fadeIn();
	
	}
	
	function call_again()
	{
			
			if($('#cheese').prop('checked')){
				
				$("#show_dp").fadeOut();
				$('#c_qty').html('');
				load_options();
			}
			else
			{
				
			}
				
	}
	

	$('#details').on('show.bs.modal', function(e) {

		var itemid = $(e.relatedTarget).data('id');
		
		call_ajax(itemid);
	});
	
	$('#remove').on('show.bs.modal', function(e) {
		
		if($("#view_cart").hasClass("in"))
		{
			$("#view_cart").modal('hide');
		}
		
		var itemid = $(e.relatedTarget).data('rid');
		var qty = $(e.relatedTarget).data('qty');
		var c_qty = $(e.relatedTarget).data('cqty');
		
		if(parseInt(c_qty)!=0)
		{
			var wt_c=parseInt(qty)-parseInt(c_qty);
			document.getElementById("ch_1").value=c_qty;
			document.getElementById("ch_2").value=wt_c;
			var x='cheese';
			var y='without_cheese';
			document.getElementById("ch_1_btn").innerHTML="<button class='btn' type='button' onclick='remove_from_cart("+itemid+","+wt_c+","+c_qty+",\""+x+"\")' style='background:#ED4E4B;align:right'>Remove</button>";
			document.getElementById("ch_2_btn").innerHTML="<button class='btn' type='button' onclick='remove_from_cart("+itemid+","+wt_c+","+c_qty+",\""+y+"\")' style='background:#ED4E4B;align:right'>Remove</button>";
			$("#d2").fadeOut();
			$("#d1").fadeIn();
		}
		else
		{
			$("#d1").fadeOut();
			document.getElementById("ch_3").value=qty;
			var y='ch_all';
					document.getElementById("ch_3_btn").innerHTML="<button class='btn' type='button' onclick='remove_from_cart("+itemid+","+qty+",0,\""+y+"\")' style='background:#ED4E4B;align:right'>Remove</button>";
			$("#d2").fadeIn();
			
		}
		var y='all';
		document.getElementById("remove_btn").innerHTML="<button class='btn' type='button' onclick='remove_from_cart("+itemid+","+wt_c+","+c_qty+",\""+y+"\")' style='background:#ED4E4B;align:right'>Remove all</button>";
	
			document.getElementById("quantity").innerHTML=qty;
		
	});
	
	$('#remove2').on('show.bs.modal', function(e) {

		if($("#view_cart").hasClass("in"))
		{
			$("#view_cart").modal('hide');
		}

		
		var itemid = $(e.relatedTarget).data('id');
		document.getElementById("remove2_btn").innerHTML="<button class='btn' type='button' onclick='remove_from_cart2("+itemid+")' style='background:#ED4E4B;align:right'>Remove</button>";
	});
	
	function remove_from_cart(itemid,qty,c_qty,type)
	{
		if(type=="all")
		{
				call_ajax3(itemid,"multiple",type,"all",0);
		}
		else if(type=="ch_all")
		{
			var del_val=document.getElementById("ch_3").value;
			if(del_val==0)
			{
					pop('No item Exists!');
			}
			else
			{
					
				if(del_val==qty)
				{
					call_ajax3(itemid,"multiple","all","all",0);
				}
				else if(del_val>qty)
				{
					pop('Error Occured!');
				}
				else
				{
						call_ajax3(itemid,"multiple",type,"ch_some",del_val);	
				}
			}
			
		}
		else
		{
			if(type=="cheese")
			{
				var ch_1=document.getElementById("ch_1").value;
				 if(ch_1==0)
				{
					pop('No item exists!');
				}
				else
				{
								
					if(ch_1==c_qty)
					{
						call_ajax3(itemid,"multiple",type,"all",ch_1);
					}
					else if(ch_1>c_qty)
					{
						$("#remove").modal('hide');
						pop('Invalid Entry');
					}
					else
					{
					call_ajax3(itemid,"multiple",type,"some",ch_1);
					}
		
				}
			}
			else
			{
				var ch_2=document.getElementById("ch_2").value;
				if(ch_2==0)
				{
					pop('No item exists!');
				}
				else
				{
				
					if(ch_2==qty)
					{	
							call_ajax3(itemid,"multiple",type,"all",ch_2);
					}
					else if(ch_2>qty)
					{
						$("#remove").modal('hide');
						pop('Invalid Entry');
					}
					else
					{
							call_ajax3(itemid,"multiple",type,"some",ch_2);
					}
				}
					
			}
		
		}
		
	}
	
	
	function call_ajax3(id,type,sel_type,choice,entry){
			 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
			if(type=="multiple")
			{
					$("#remove").modal('hide');
			}
			else
			{
					$("#remove2").modal('hide');
			}
			
				if($.trim(this.responseText)=="done")
				{
					load();
					pop("Removed!");
				}
				else
				{
					load();
					pop("Error Occured!");
				}
            }
        };
		
			xmlhttp.open("POST", "remove.php?id="+id+"&type="+type+"&sel_type="+sel_type+"&choice="+choice+"&entry="+entry, true); 
		xmlhttp.send();
		
	}
	
	
	
	
	function remove_from_cart2(itemid)
	{
		
			call_ajax3(itemid,"single","all","all",0);
	}
	
	
	$('#add').on('show.bs.modal', function(e) {

		var i = $(e.relatedTarget).data('name');
		if($('#cheese').prop('checked')){
				$("#show_dp").fadeOut();
				$('#c_qty').html('');
			$('#cheese').prop('checked', false);
		}
	//	alert(i);
		call_ajax2(i);
	});
	
	function call_ajax2(id){
		$('#wait_add').show();
			$('#add_div').hide();
		$.ajax
		({
			type: "POST",
			url: "getdetails.php",
			dataType: 'json',
			data: ({name: id}),
			cache: false,
			success: function(data)
			{
				if(data.a=="fail")
				{	
					$("#add").modal('hide');
					pop("Error Occured!");
				}
				else
				{
					document.getElementById("item_name_2").innerHTML=data.a;
					if(data.b=="")
					{
						document.getElementById("ing_main_2").innerHTML="";	
					}
					else
					{
						document.getElementById("ing_main_2").innerHTML="<span style='color:purple'>Ingredients</span>: "+data.b;
					}
					document.getElementById("price_2").innerHTML=data.c;
							document.getElementById("cart_button").innerHTML="<button type='button' id='button_"+id+"' onclick='add_to_cart(this.id)' class='btn' style='background:#ED4E4B;align:right'>Add to Cart</button>";
							var x = document.createElement("IMG");
					x.setAttribute("src", "data:image/jpeg;base64,"+data.d);
					x.setAttribute("width", "70%");
					x.setAttribute("width", "70%");
					$('div#item_load2 > img').remove();
					document.getElementById("item_load2").appendChild(x);
				}


			},
			error: function(){
				pop('Error Occured!');
			},complete: function(){
					$('#wait_add').hide();
					$('#add_div').show();
				}
		});
	}
	
	$(document).on('click','#load',function(){
		
		load();
	});
	
	function load(){
		
		 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("settings").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "load.php", true);
        xmlhttp.send();
	}
	
	$(document).on('click','#clear_cart_btn',function(){
		 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if($.trim(this.responseText)=="done")
				{
					load();
					pop('Cleared Cart!');
				}
				else
				{
					load();
					pop('Error Occured!');
				}
            }
        };
        xmlhttp.open("GET", "clear.php", true);
        xmlhttp.send();
	});
	
	function call_ajax(id){
			$('#wait_details').show();
			$('#details_div').hide();
		$.ajax
		({
			type: "POST",
			url: "getdetails.php",
			dataType: 'json',
			data: ({name: id}),
			cache: false,
			success: function(data)
			{
				
				if(data.a=="fail")
				{	
					$("#details").modal('hide');
					pop("Error Occured!");
				}
				else
				{
					document.getElementById("item_name").innerHTML=data.a;
					if(data.b=="")
					{
						document.getElementById("ing_main").innerHTML="";	
					}
					else
					{
						document.getElementById("ing_main").innerHTML="<span style='color:purple'>Ingredients</span>: "+data.b;
					}
					document.getElementById("price").innerHTML="Rs. "+data.c;
					var x = document.createElement("IMG");
					x.setAttribute("src", "data:image/jpeg;base64,"+data.d);
					x.setAttribute("width", "70%");
					x.setAttribute("width", "70%");
					$('div#item_load > img').remove();
					document.getElementById("item_load").appendChild(x);
				}
			},
			error: function(){
				pop('Error Occured!');
			},complete: function(){
					$('#wait_details').hide();
					$('#details_div').show();
				}
		});
	}
	
	
	function add_to_cart(id){
		var ch="";
		var c_qty=0;
		if($('#cheese').prop('checked')){
			ch="yes";
			c_qty=document.getElementById("c_qty").value;
		}
		else
		{
			ch="no";
		}
		
		var val=document.getElementById("qty").value;
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
			    if($.trim(this.responseText)=="done")
				{
						$("#add").modal('hide');
						pop('Added to Cart!');
				}
				else
				{
					pop('Error Occured!');
				}
            }
        };
        xmlhttp.open("GET", "add_to_cart.php?name="+id+"&qty="+val+"&cheese="+ch+"&cheese_qty="+c_qty, true);
        xmlhttp.send();
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
		
		
		
		
		function step1_check(){
			var email=document.getElementById("email").value;
			var number=document.getElementById("number").value;
			var sec_que=document.getElementById("sec_que").value;
			var answer=document.getElementById("answer").value;
			var add1=document.getElementById("add1").value;
			var add2=document.getElementById("add2").value;
			var city=document.getElementById("city").value;
			var pincode=document.getElementById("pincode").value;
			
		if(email=="" || number=="" || sec_que==""|| answer==""|| add1==""|| add2==""|| city==""|| pincode=="")
		{
			pop('All Fields are required');
		}
		else if(number.match(/\D/g))
		{
			pop('Contact number should be a number');
		}
		else if(number.length!=10)
		{
			pop('Contact number is not valid');
		}
		else if(pincode.match(/\D/g))
		{
			pop('Pincode should be a number.');
		}
		else if(validateEmail(email)!==true)
		{
			pop('Email Address is Invalid!');
		}
		else
		{
			document.getElementById("profile_form").submit();
		}
			
			
	}
		
		
		function validateEmail(email) 
		{
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		}
		
		
		function val_sg()
		{
			var input = document.getElementById("sg").value;
			if(input=="")
			{
				pop("Provide Suggestion First!");
			}
			else
			{
				document.getElementById("sg_form").submit();
			}
		}
		
			</script>
			
			
		<?php
			
			if(isset($_SERVER['HTTP_REFERER']))
			{
					
				$url=$_SERVER['HTTP_REFERER'];

				preg_match('/\/[a-z0-9]+.php/', $url, $match);

				$page = array_shift($match);
				
				if($page=="/index.php")
				{
					?>
					<script>
						
			
					$(document).ready(function(){
							pop('Welcome to StoneBaked Pizza');
					});

					</script>
						
					<?php
				}
			}
		?>		
	
	
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
