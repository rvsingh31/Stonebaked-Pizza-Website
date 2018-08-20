<!DOCTYPE html>
  <html>
    <head>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="blue lighten-2">
	<br>
	<br>
	<br>
	<div class="row">
		<div class="col s12 m4">
			<p></p>
		</div>
		
		<div class="col s12 m4 card">
			<h5 class="teal-text center">Admin Panel</h5>
			<br>
	
			<form action="ad_login.php" method="post" id="login_form">
				<div class="input-field">
					<input id="username" type="text" class="teal-text" name="username">
					<label for="username">Username</label>
				</div>
				<div class="input-field">
					<input id="password" type="password" class="teal-text" name="password">
					<label for="password">Password</label>
				</div>
				
				<br>
				<button class="btn waves-effect waves-light teal white-text" type="button"  onclick="validate()" >Log In</button>
				<br>
				<br>
			</form>
		</div>
		
		<div class="col s12 m4">
			<p></p>
		</div>
	</div>
	
	
	
	
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
		
	<script type="text/javascript">
		function validate()
		{
			
			var u=document.getElementById("username").value;
			var p=document.getElementById("password").value;
			if(u=='' || p=='')
			{
				Materialize.toast('Empty Fields not allowed',2000);
			}
			else
			{
				document.getElementById("login_form").submit();
			}
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
						Materialize.toast(msg,2000);
					}
				</script>
				
			<?php
			
			unset($_SESSION["msg"]);
		}
	
	?>
	</body>
  </html>