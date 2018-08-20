<?php
	session_start();
	if(!isset($_SESSION["admin"]) )
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
			<li><a href="main.php" class="blue-text">Home</a></li>
			<li><a href="usr_mgmt.php" class="blue-text">User Management</a></li>
		
      </ul>
      <ul class="side-nav" id="mobile-demo">
			<li><a href="main.php" class="blue-text">Home</a></li>
			<li><a href="usr_mgmt.php" class="blue-text">User Management</a></li>
      </ul>
    </div>
  </nav>
	
			<div class="row">
				<h5 class="white-text center">Text Message People</h5>
			</div>
			<div class="row">
				<div class="col s12 m1">
					<p></p>
				</div>
				
			
				<div class="col s12 m4 card">
					<h6 class="blue-text center" style="padding:2%">Enter the number and text message to send the message.</h6>
					<form action="send_single.php" method="post"> 
						<div class='input-field'>
							<input id="phone" name="phone" class="blue-text" type="text"/>
							<label for="phone">Enter phone number</label>
						</div>
						<div class='input-field'>
							<input id="msg" name="msg" class="blue-text" type="text"/>
							<label for="phone">Enter MESSAGE</label>
						</div>
						<button class="blue white-text btn waves-effect waves-light" type="submit">SEND</button>
					</form>
				</div>
				
				<div class="col s12 m2">
					<p></p>
				</div>
				
				<div class="col s12 m4 card">
					<h6 class='blue-text center' style="padding:2%">Enter the message to send message to all the stored numbers.</h6>
				
					<form action="send_multiple.php" method="post"> 
						<div class='input-field'>
							<input id="msg_m" name="msg_m" class="blue-text" type="text"/>
							<label for="phone">Enter MESSAGE</label>
						</div>
						<button class="blue white-text btn waves-effect waves-light" type="submit">SEND</button>
					</form>
				
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