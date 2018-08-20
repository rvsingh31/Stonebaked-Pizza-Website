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
	  <li><a href="earnings.php" class="blue-text">Earnings</a></li>
	  <li><a href="msg.php" class="blue-text">Message People</a></li>
	  <li><a href="usr_mgmt.php" class="blue-text">User Mangement</a></li>
        <li><a href="menu.php" class="blue-text">Menu Mangement</a></li>
		<li><a href="logout2.php" class="blue-text">Sign Out</a></li>
    	
      </ul>
      <ul class="side-nav" id="mobile-demo">
	  <li><a href="earnings.php" class="blue-text">Earnings</a></li>
	    <li><a href="msg.php" class="blue-text">Message People</a></li>
	  <li><a href="usr_mgmt.php" class="blue-text">User Mangement</a></li>
        <li><a href="menu.php" class="blue-text">Menu Mangement</a></li>
		<li><a href="logout2.php" class="blue-text">Sign Out</a></li>
      </ul>
    </div>
  </nav>
	
	
			<div class="row">
				<h5 class="white-text center">Earnings</h5>
			</div>
			<div class="row">
				<div class="col s12 m1">
					<p></p>
				</div>
				
			
				<div class="col s12 m4 card">
					<h6 class="teal-text center" style="padding:4%">TODAY's Earnings</h6>
					<?php
					$date=date("Y-m-d");
					$sql="select order_id,user_id from orders where date='$date'";
						$result=mysqli_query($conn,$sql);
						if(mysqli_num_rows($result)>0)
						{
							while($row=mysqli_fetch_assoc($result))
							{
								
								echo "<div class='row center'>
								<a href='view2.php?id=".$row["order_id"]."&user_id=".$row["user_id"]."'><h6 class='red-text center' style='padding:2%'>Order ID: ".$row["order_id"]."</h6></a> 
								<hr>
								</div>";
							}
						}
						else
						{	
							echo "<h6 class='blue-text center' style='padding:5%'>NO RESULTS TO SHOW!! </h6>";
						}
					?>
					
					<br>
					
					<?php
					$date=date("Y-m-d");
					$sql1="select count(*) as count,sum(total_cost) as total from orders where date='$date'";
						$result1=mysqli_query($conn,$sql1);
						if(mysqli_num_rows($result1)>0)
						{
							while($row1=mysqli_fetch_assoc($result1))
							{
								
								echo "<div class='row center'>
								<h5 class='blue-text center' style='padding:1%'>Total Earning: Rs. ".$row1["total"]."</h5>
								<br>
								<h5 class='blue-text center' style='padding:1%'>Total Orders: ".$row1["count"]."</h5>
								<br>
								</div>";
							}
						}
						else
						{	
							echo "<h6 class='blue-text center' style='padding:5%'>NO RESULTS TO SHOW!! </h6>";
						}
					?>
					
				</div>
				
				<div class="col s12 m2">
					<p></p>
				</div>
				
				
				<div class="col s12 m4 card" style="height:35em;overflow-y:auto">
					<h6 class="teal-text center" style="padding:4%">Monthly Earnings</h6>
					
					<?php
					$date=date("Y-m-d");
					$sql="select order_id,user_id from orders where date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
						$result=mysqli_query($conn,$sql);
						if(mysqli_num_rows($result)>0)
						{
							while($row=mysqli_fetch_assoc($result))
							{
								
								echo "<div class='row center'>
								<a href='view2.php?id=".$row["order_id"]."&user_id=".$row["user_id"]."'><h6 class='red-text center' style='padding:2%'>Order ID: ".$row["order_id"]."</h6></a> 
								<hr>
								</div>";
							}
						}
						else
						{	
							echo "<h6 class='blue-text center' style='padding:5%'>NO RESULTS TO SHOW!! </h6>";
						}
					?>
					
					<br>
					
					<?php
					$date=date("Y-m-d");
					$sql1="select count(*) as count,sum(total_cost) as total from orders where date> DATE_SUB(NOW(), INTERVAL 1 MONTH)";
						$result1=mysqli_query($conn,$sql1);
						if(mysqli_num_rows($result1)>0)
						{
							while($row1=mysqli_fetch_assoc($result1))
							{
								
								echo "<div class='row center'>
								<h5 class='blue-text center' style='padding:1%'>Total Earning: Rs. ".$row1["total"]."</h5>
								<br>
								<h5 class='blue-text center' style='padding:1%'>Total Orders: ".$row1["count"]."</h5>
								<br>
								</div>";
							}
						}
						else
						{	
							echo "<h6 class='blue-text center' style='padding:5%'>NO RESULTS TO SHOW!! </h6>";
						}
					?>
					
				</div>
				
				
				<div class="col s12 m1">
					<p></p>
				</div>
				
			</div>
			
			
			

      <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
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
  