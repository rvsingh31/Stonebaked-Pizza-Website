<?php
	session_start();
	if(!isset($_SESSION["admin"]))
	{
		$_SESSION["msg"]="Login First!";
		header("location:admin.php");
		exit;
	}
	include("connection.php");
?>
<!DOCTYPE html>

  <html>
    <head>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="blue lighten-3">
	
  <nav class="white">
    <div class="nav-wrapper">
	 <a href="#" class="blue-text">Admin Panel</a>
           <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons blue-text">menu</i></a>
      <ul class="right hide-on-med-and-down">
	  <li><a href="manage_fb.php" class="blue-text">Manage Feedbacks</a></li>
	  <li><a href="earnings.php" class="blue-text">Earnings</a></li>
	  <li><a href="msg.php" class="blue-text">Message People</a></li>
	  <li><a href="usr_mgmt.php" class="blue-text">User Mangement</a></li>
        <li><a href="menu.php" class="blue-text">Menu Mangement</a></li>
		<li><a href="logout2.php" class="blue-text">Sign Out</a></li>
    	
      </ul>
      <ul class="side-nav" id="mobile-demo">
	  <li><a href="manage_fb.php" class="blue-text">Manage Feedbacks</a></li>
	  <li><a href="earnings.php" class="blue-text">Earnings</a></li>
	    <li><a href="msg.php" class="blue-text">Message People</a></li>
	  <li><a href="usr_mgmt.php" class="blue-text">User Mangement</a></li>
        <li><a href="menu.php" class="blue-text">Menu Mangement</a></li>
		<li><a href="logout2.php" class="blue-text">Sign Out</a></li>
      </ul>
    </div>
  </nav>
	
	
			<div class="row">
				<h5 class="white-text center">Order Details</h5>
			<div class="row">
				<div class="col s12 m1">
					<p></p>
				</div>
				
			
				<div class="col s12 m4 card">
					<h6 class="teal-text center">New Orders</h6>
					<hr>
					<div  style="height:20em;overflow-y:auto">
					<br>
					<?php
						$sql="select order_id,user_id from orders where status='placed' order by date DESC";
						$result=mysqli_query($conn,$sql);
						if(mysqli_num_rows($result)>0)
						{
							while($row=mysqli_fetch_assoc($result))
							{
								$o=$row["order_id"];
								$u=$row["user_id"];
								echo "<div class='row center'>
										<h6 class='blue-text'>Order Id: ".$o."</h6>
										<br>
										<a href='view.php?id=".$o."&user_id=".$u."'><button class='btn waves-effect waves-light blue lighten-2 white-text'>Take Action</button></a>
										<hr style='width:40%'>
									</div>";
							}
						}
						else
						{
							echo "<h6 class='blue-text center'>No new Orders!</h6>";
						}
					?>
					</div>
				</div>
				
				<div class="col s12 m2">
					<p></p>
				</div>
				
				<div class="col s12 m4">
				<div class="center">
					<button type="button" class="btn blue-text white waves-effect waves-light" id="confirm_order_btn">SHOW CONFIRMED ORDERS</button>	
				</div>
				<div style="display:none" class="card" id="confirm_order_div">
					<h6 class="teal-text center">Confirmed Orders</h6>
					<hr>
					<div  style="height:20em;overflow-y:auto">
					<br>
					<?php
						$sql1="select order_id,user_id from orders where status='confirmed' order by date DESC";
						$result1=mysqli_query($conn,$sql1);
						if(mysqli_num_rows($result1)>0)
						{
							$c=0;
							while($row1=mysqli_fetch_assoc($result1))
							{
								$o=$row1["order_id"];
								$u=$row1["user_id"];
								echo "<div class='row center'>
										<h6 class='blue-text'>Order Id: ".$o."</h6>
										<br>
										<button type='button' id='button_".$c."' data-oid='".$o."' data-uid='".$u."' class='btn waves-effect waves-light blue lighten-2 white-text' onclick='call_modal(this.id)'>DELIVERED ?</button>
										<hr style='width:40%'>
									</div>";
								$c++;
							}
						}
						else
						{
							echo "<h6 class='blue-text center'>No Confirmed Orders!</h6>";
						}
					?>
					</div>
				</div>
				</div>
				
				<div class="col s12 m1">
					<p></p>
				</div>
				
			</div>
			
			<div class="row">
			
				<div class="col s12 m1">
					<p></p>
				</div>
				
				<div class="col s12 m4">
				<div class="center">
					<button type="button" class="btn blue-text white waves-effect waves-light" id="deliver_order_btn">SHOW DELIVERED ORDERS</button>	
				</div>
				<div style="display:none" id="deliver_order_div" class="card">
				
					<h6 class="teal-text center">Delivered Orders</h6>
					<hr>
					<div  style="height:20em;overflow-y:auto">
					<br>
					<?php
						$sql2="select order_id,user_id from orders where status='delivered' order by date DESC";
						$result2=mysqli_query($conn,$sql2);
						if(mysqli_num_rows($result2)>0)
						{
							while($row2=mysqli_fetch_assoc($result2))
							{
								$o=$row2["order_id"];
								$u=$row2["user_id"];
								echo "<div class='row center'>
										<h6 class='blue-text'>Order Id: ".$o."</h6>
										<br>
										<a href='view2.php?id=".$o."&user_id=".$u."'><button class='btn waves-effect waves-light blue lighten-2 white-text'>VIEW ORDER</button></a>
										<hr style='width:40%'>
									</div>";
							}
						}
						else
						{
							echo "<h6 class='blue-text center'>No Delivered Orders!</h6>";
						}
					?>
					</div>
					</div>
				</div>
				
				<div class="col s12 m2">
					<p></p>
				</div>
				
				<div class="col s12 m4">
				<div class="center">
					<button type="button" class="btn blue-text white waves-effect waves-light" id="cancel_order_btn">SHOW CANCELLED ORDERS</button>	
				</div>
				<div style="display:none" class="card" id="cancel_order_div">
				
					<h6 class="teal-text center">Cancelled Orders</h6>
					<hr>
					<div  style="height:20em;overflow-y:auto">
					<br>
					<?php
						$sql3="select order_id,user_id from orders where status='cancelled' order by date DESC";
						$result3=mysqli_query($conn,$sql3);
						if(mysqli_num_rows($result3)>0)
						{
							while($row3=mysqli_fetch_assoc($result3))
							{
								$o=$row3["order_id"];
								$u=$row3["user_id"];
								echo "<div class='row center'>
										<h6 class='blue-text'>Order Id: ".$o."</h6>
										<br>
										<a href='view2.php?id=".$o."&user_id=".$u."'><button class='btn waves-effect waves-light blue lighten-2 white-text'>VIEW ORDER</button></a>
										<hr style='width:40%'>
									</div>";
							}
						}
						else
						{
							echo "<h6 class='blue-text center'>No Cancelled Orders!</h6>";
						}
					?>
					</div>
					</div>
				</div>
				
				<div class="col s12 m1">
					<p></p>
				</div>
				
			</div>
			</div>
			
			<div id="deliver_modal" class="modal">
				<div class="modal-content">
					<h5 class="blue-text">Is the Order Delivered?</h5>
				</div>
				<div class="modal-footer">
							<div id="dy_btn">
							</div>
			
				</div>
			</div>

       <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	   <script type="text/javascript" src="js/materialize.min.js"></script>
	  
	  <script>
		function call_modal(btn_id)
			{
				var order_id=$("#"+btn_id).data("oid");
				var user_id=$("#"+btn_id).data("uid");
				document.getElementById("dy_btn").innerHTML="<a href='#!' class='modal-action modal-close waves-effect waves-red btn-flat red-text'>Close</a><a href='/delivered.php?order_id="+order_id+"&user_id="+user_id+"' class='modal-action modal-close waves-effect waves-blue btn-flat blue-text'>YES</a>";
				$('#deliver_modal').modal('open');
			}
			
	  
		$(document).ready(function(){
			
			 $('.modal').modal();
			 
			$("#confirm_order_btn").click(function(){
				if($("#confirm_order_div").is(':visible'))
				{
					$("#confirm_order_div").slideUp();
				}
				else
				{
					$("#confirm_order_div").slideDown();
				}
			});
			
			$("#cancel_order_btn").click(function(){
				if($("#cancel_order_div").is(':visible'))
				{
					$("#cancel_order_div").slideUp();
				}
				else
				{
					$("#cancel_order_div").slideDown();
				}
			});
			
			$("#deliver_order_btn").click(function(){
				if($("#deliver_order_div").is(':visible'))
				{
					$("#deliver_order_div").slideUp();
				}
				else
				{
					$("#deliver_order_div").slideDown();
				}
			});
		});
	  </script>
	  
	  <script>
		$(document).ready(function(){
			
			$(".button-collapse").sideNav();
        
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