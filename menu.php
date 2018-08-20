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
				<h5 class="white-text center">Menu Management</h5>
			</div>
			<div class="row">
				<div class="col s12 m1">
					<p></p>
				</div>
				
			
				<div class="col s12 m4 card">
					<h6 class="teal-text center">Existing Items</h6>
					<hr>
					<div  style="height:30em;overflow-y:auto">
					<br>
					<?php
						$sql="select item_id,name from items ";
						$result=mysqli_query($conn,$sql);
						if(mysqli_num_rows($result)>0)
						{
							while($row=mysqli_fetch_assoc($result))
							{
								$o=$row["item_id"];
								$u=$row["name"];
								echo "<div class='row center'>
										<h6 class='blue-text'>Item Id: ".$o."</h6>
										<h6 class='blue-text'>Item Name: ".$u."</h6>
										<br>
										<a href='intr_change.php?id=".$o."'><button class='btn waves-effect waves-light blue lighten-2 white-text'>EDIT</button></a>
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
				
				<div class="col s12 m2">
					<p></p>
				</div>
				
				<div class="col s12 m4 card">
					<h6 class="teal-text center">Add New  Item</h6>
					<hr>
					<div >
						<br>
						<form action="add_new_item.php" method="post" id="add_form" enctype="multipart/form-data">
							<div class="input-field">
								<input id="name" name="name" type="text" />
								<label for="name">Name of Item</label>
							</div>
							<div class="input-field">
								<input id="ing" name="ing" type="text" />
								<label for="ing">Ingredients</label>
							</div>
							<div class="input-field">
								<input id="price" name="price" type="text" />
								<label for="price">Price</label>
							</div>
							<div class="input-field">
								<input id="credits" name="credits" type="text" />
								<label for="credits">Credits</label>
							</div>
							<div class="file-field input-field">
								<div class="btn">
									<span>File</span>
									<input type="file" id="pic" name="pic">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text">
								</div>
							</div>
							
								<button type="button" onclick="validate()" class="btn right waves-effect waves-light blue white-text">Add Item</button>
							<br>
							<br>
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