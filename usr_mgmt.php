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
	   <li><a href="main.php" class="blue-text">Home</a></li>
		<li><a href="logout2.php" class="blue-text">Sign Out</a></li>
     	
      </ul>
      <ul class="side-nav" id="mobile-demo">
   <li><a href="main.php" class="blue-text">Home</a></li>
		<li><a href="logout2.php" class="blue-text">Sign Out</a></li>
     	 
	 </ul>
    </div>
  </nav>
	
	
			<div class="row">
				<h5 class="white-text center">User Management</h5>
			</div>
			<div class="row">
				<div class="col s12 m3">
					<p></p>
				</div>
				
			
				<div class="col s12 m6 card">
					<h6 class="teal-text center">Existing Users</h6>
					<hr>
					<div  style="height:30em;overflow-y:auto">
					<br>
					<?php
						$sql="select id,firstname,lastname from users ";
						$result=mysqli_query($conn,$sql);
						if(mysqli_num_rows($result)>0)
						{
							while($row=mysqli_fetch_assoc($result))
							{
								$o=$row["id"];
								$u=$row["firstname"];
								$p=$row["lastname"];
								echo "<div class='row center'>
										<h6 class='blue-text'>User Id: ".$o."</h6>
										<h6 class='blue-text'>User Name: ".$u." ".$p."</h6>
										<br>
										<a href='intr_change2.php?id=".$o."'><button class='btn waves-effect waves-light blue lighten-2 white-text'>View</button></a>
										<hr style='width:40%'>
									</div>";
							}
						}
						else
						{
							echo "<h6 class='blue-text center'>No Items!</h6>";
						}
					?>
					</div>
				</div>
				
				<div class="col s12 m3">
					<p></p>
				</div>
				
			</div>
			
     <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	 <script type="text/javascript" src="js/materialize.min.js"></script>
	  	
		<script>
			function validate()
			{
				var name=document.getElementById("name").value;
				var price=document.getElementById("price").value;
				var credits=document.getElementById("credits").value;
				var file=document.getElementById("pic").value;


					if(name=="" || price=="" || credits=="" || file=="")
					{
						Materialize.toast('Enter all fields',2000);
					}
					else
					{
						document.getElementById("add_form").submit();	
					}
					
			}
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