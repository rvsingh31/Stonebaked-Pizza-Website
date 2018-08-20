<?php
	session_start();
	if(!isset($_SESSION["admin"]))
	{
		$_SESSION["msg"]="Login First!";
		$_SESSION["url"]="http://www.stonebakedpizza.in/view.php?id=".$_REQUEST["order_id"]."&user_id=".$_REQUEST["user_id"];
		header("location:admin.php");
		exit;
	}
	else if(!isset($_GET["id"]) || !isset($_GET["user_id"]))
	{
		$_SESSION["msg"]="No order Selected";
		header("location:main.php");
		exit;
	}
	$order_id=$_GET["id"];
	$user_id=$_GET["user_id"];
	include("connection.php");
	$sql="select orders.order_id,date,add1,add2,city,pincode,total_cost,firstname,lastname,contact,email from orders join users on (orders.user_id=users.id) join address using (addressid) join step1 on (users.id=step1.userid) where order_id='$order_id' and orders.user_id='$user_id'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
			$row=mysqli_fetch_assoc($result);
	}
	else
	{
		$_SESSION["msg"]="Invalid Selection";
		header("location:main.php");
		exit;
	}
	$sql1="select * from order_details join items using (item_id) where order_id='$order_id';";
	$result1=mysqli_query($conn,$sql1);
	if(mysqli_num_rows($result1)>0)
	{
	}
	else
	{
		$_SESSION["msg"]="Invalid Selection";
		header("location:main.php");
		exit;
	}
?>


<!DOCTYPE html>
  <html>
    <head>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  <style>
		
	  </style>
	  
	  
    </head>

    <body class="blue lighten-2">
	<nav class="white">
		<ul>
			<li>
			<a href="#!" class="teal-text">Order Information</a>
			</li>
			<li class="right">
				<a href="main.php" class="teal-text" >Home</a>
			</li>
		</ul>
	</nav>
	<br>
	<br>
	

		<div class="row">
			<div class="col s12 m1">
				<p></p>
			</div>
			
			<div class="col s12 m5 card" style="padding:3%">
				<h6 class="teal-text center">Details regarding the order</h6>
				<hr>
				<br>
				<h6 class="blue-text">Order-Id:<?php echo $row["order_id"];?> </h6>
				<br>
				<h6 class="blue-text">Date:<?php echo $row["date"];?> </h6>
				<br>
				<hr>
				<h6 class="teal-text center">Customer Details</h6>
				<hr>
				<h6 class="blue-text">Name:<?php echo $row["firstname"]." ".$row["lastname"];?> </h6>
				<h6 class="blue-text">Contact-Number:<?php echo $row["contact"];?> </h6>
				<h6 class="blue-text">Email:<?php echo $row["email"];?> </h6>
				<hr>
				<h6 class="teal-text center">Order</h6>
				<hr>
				<hr style='width:50%'>
				<?php
					while($row1=mysqli_fetch_assoc($result1))
					{
						$c_qty=$row1["cheese_qty"];
						$total_qty=$row1["total_qty"];
						$name=$row1["name"];
						echo "<h6 class='blue-text center'>Item-Name: ".$name."</h6>
								<br>
							<h6 class='blue-text center'>Total Quantity: ".$total_qty."</h6>
							<br>
							<h6 class='blue-text center'>No. of Extra Cheese: ".$c_qty."</h6>
							<br>
							<hr style='width:50%'>
							";
						
					}
				?>
				<hr>
				<h6 class="blue-text center">Total Cost:Rs. <?php echo $row["total_cost"];?> </h6>
				<br>
				<h6 class="blue-text center">Delivery Address:<?php echo $row["add1"].",".$row["add2"].",".$row["city"].",".$row["pincode"];?> </h6>
				<br>
				
				
				
			</div>
			
			<div class="col s12 m1">
				<p></p>
			</div>
			
			
			<div class="col s12 m5 card" style="padding:3%">
				<h6 class="teal-text center">Take Appropriate Action</h6>
				<hr>
				<br>
				<?php 
					$link="send_mail.php?email=".$row["email"]."&order_id=".$order_id."&user_id=".$user_id;
				?>
				<div class="center">
					<button id="confirm_btn" type="button" class="btn blue white-text waves-effect waves-light">CONFIRM ORDER</button>
				</div>
				<div id="confirm_div" style="display:none">
				<br>	
					<h6 class="teal-text center"> Confirm Order ?</h6>
					<br>
					<i class="teal-text">NOTE: After you press 'SEND CONFIRMATION MAIL', customer will be sent a confirmation mail for his/her order and delivery will be initiated.</i>
					<form action="<?php echo $link."&type=confirm";?>" method="post" id="confirm_form">
						<div class="input-field ">
							<input id="time" type="text" name="time">
							<label for="time">Enter estimated time of Delivery</label>
						</div>
						<br>
						<div class="center">
							<button type="button" class="btn teal waves-effect waves-light" onclick="check_confirm()">SEND CONFIRMATION MAIL </button>
						</div>
					</form>
				</div>
				<br>
				<br>
				<div class="center">
					<button id="cancel_btn" type="button" class="btn blue white-text waves-effect waves-light">CANCEL ORDER</button>
				</div>
				<div id="cancel_div" style="display:none">
				<br>
						<h6 class="teal-text center"> Cancel Order ?</h6>
					<i class="teal-text">NOTE: After you press 'SEND CANCELLATION MAIL', customer will be sent a cancellation mail for his/her order specifying that his/her order has been cancelled.If possible , make a call to specify the reason!</i>	
						<h6 class="blue-text">Contact-Number:<?php echo $row["contact"];?> </h6>	
						<form action="<?php echo $link."&type=cancel";?>" method="post"  id="cancel_form">
							<br>
							<div class="input-field col s12">
								<select name="reason" id="reason">
									<option value="" class="blue-text" disabled selected>Choose your option</option>
									<option value="1">Not enough Ingredients </option>
									<option value="2">Address out of reach.</option>
									<option value="3">Store is Closed.</option>
								</select>
								<label>Specify the Reason</label>
							</div>
							<div class="center">
								<button type="button" class="btn teal waves-effect waves-light" onclick="check_cancel()">SEND CANCELLATION MAIL </button>
							</div>
						</form>
				</div>
			</div>
			
			<div class="col s12 m1">
				<p></p>
			</div>
			
		</div>
	
	
	
	
	
	
	
	  <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	  <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script>
		
		function check_confirm()
		{
			var time=document.getElementById("time").value;
			if(time=='')
			{
				Materialize.toast('Enter the estimated time of delivery',2000);
			}
			else
			{
				document.getElementById("confirm_form").submit();
			}
		
		}
		
		function check_cancel()
		{
			var r=document.getElementById("reason").value;
			if(r=='')
			{
				Materialize.toast('Specify the Reason first!',2000);
			}
			else
			{
				document.getElementById("cancel_form").submit();
			}
		
		}
		
		
		$(document).ready(function(){
		
			 $('select').material_select();
			 
			$("#confirm_btn").click(function(){
				
				if($("#confirm_div").is(':visible'))
				{
						$("#confirm_div").slideUp();	
				}
				else
				{
					if($("#cancel_div").is(':visible'))
					{
						$("#cancel_div").slideUp();
						setTimeout(function(){$("#confirm_div").slideDown();},500);
					}
					else
					{
						$("#confirm_div").slideDown();
					}
				}
				
			});
			
			
			$("#cancel_btn").click(function(){
				
				
				if($("#cancel_div").is(':visible'))
				{
						$("#cancel_div").slideUp();	
				}
				else
				{
					if($("#confirm_div").is(':visible'))
					{
						$("#confirm_div").slideUp();
						setTimeout(function(){$("#cancel_div").slideDown();},500);
					}
					else
					{
						$("#cancel_div").slideDown();
					}
				}
				
			});
		});
	  
	  </script>
		<?php
		
		if(isset($_SESSION["msg"]) && !empty($_SESSION["msg"]))
		{
			?>
				<script>
					var msg="<?php echo $_SESSION["msg"]; ?>";
					if(msg!="")
					{
						Materialize.toast(msg,2000);
					}
				</script>
				
			<?php
			
			unset($_SESSION["msg"]);
		}
	
	?>
</body>
  </html>