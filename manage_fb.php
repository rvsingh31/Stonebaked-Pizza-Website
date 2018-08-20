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
				<h5 class="white-text center">User's Suggestions</h5>
			</div>
			<div class="row">
				<div class="col s12 m3">
					<p></p>
				</div>
				
			
				<div class="col s12 m6 card">
					<?php
					$sql="select * from feedbacks";
					$result=mysqli_query($conn,$sql);
					if(mysqli_num_rows($result)>0)
					{
							while($row=mysqli_fetch_assoc($result))
						{
							echo "<div class='row center'>
								<h6 class='blue-text'>Feedbacks : ".$row["feedback"]."</h6>";
								if($row["status"]=="disabled")
								{
									echo "<a href='enable_disable.php?type=show&feedback=".$row["feedback"]."&id=".$row["user_id"]."'><button class='btn waves-effect waves-light blue white-text'>SHOW</button></a>";
								}
								else
								{
									echo "<a href='enable_disable.php?type=hide&feedback=".$row["feedback"]."&id=".$row["user_id"]."'><button class='btn waves-effect waves-light blue white-text'>HIDE</button></a>";		
								}
								
								echo "<br>
								<hr>
							</div>";
						}

					}
					else
					{
						echo "<h6 class='blue-text center' style='padding:5%'>NO RESULTS TO SHOW!! </h6>";
					}
					?>
				
				</div>
				
				<div class="col s12 m3">
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