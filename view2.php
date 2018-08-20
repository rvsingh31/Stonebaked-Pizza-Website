<?php
	session_start();
	if(!isset($_SESSION["admin"]))
	{
		$_SESSION["msg"]="Login First!";
		$_SESSION["url"]="http://www.stonebakedpizza.in/view2.php?id=".$_REQUEST["order_id"]."&user_id=".$_REQUEST["user_id"];
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
	$sql="select orders.order_id,date,add1,add2,city,pincode,total_cost,firstname,lastname,contact,email,status from orders join users on (orders.user_id=users.id) join address using (addressid) join step1 on (users.id=step1.userid) where order_id='$order_id' and orders.user_id='$user_id'";
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
			<div class="col s12 m3">
				<p></p>
			</div>
			
			<div class="col s12 m6 card" style="padding:3%">
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
				<hr>
				<br>
				<h6 class="blue-text center">STATUS:  <?php echo $row["status"];?> </h6>
				<br>
				
				
				
			</div>
			
			<div class="col s12 m3">
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