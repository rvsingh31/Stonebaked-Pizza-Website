<?php
	session_start();
	if(!isset($_SESSION["admin"]))
	{
		$_SESSION["msg"]="Login First!";
		header("location:admin.php");
		exit;
	}
	include("connection.php");
	$id=$_SESSION["item_id"];

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
    <div class="nav-wrapper ">
      <a href="#" class="blue-text">Admin Panel</a>
      <ul id="nav-mobile" class="blue-text right hide-on-med-and-down">
        <li><a href="main.php" class="blue-text">Home</a></li>
		<li><a href="menu.php" class="blue-text">Menu Management</a></li>
      </ul>
    </div>
  </nav>
	
			<div class="row">
				<h5 class="white-text center">Edit Item Details</h5>
			</div>
			<div class="row">
				<div class="col s12 m3">
					<p></p>
				</div>
				
			
				<div class="col s12 m6 card">
					<br>
					<?php
						$sql="select * from items where item_id='$id'";
						$result=mysqli_query($conn,$sql);
						if(mysqli_num_rows($result)>0)
						{
							while($row=mysqli_fetch_assoc($result))
							{
								$item_id=$row["item_id"];
								$u=$row["name"];
								$ing=$row["ingredients"];
								$p=$row["price"];
								$c=$row["credits"];
								echo "<div class='row center'>
										<h6 class='blue-text'>Item Name: ".$u."</h6>
										<h6 class='blue-text'>Ingredients: ".$ing."</h6>
										<h6 class='blue-text'>Price: ".$p."</h6>
										<h6 class='blue-text'>Credits: ".$c."</h6>
										<br>
										<hr style='width:40%'>
									</div>";
							}
						}
						else
						{
							echo "<h6 class='blue-text center'>No such Item!</h6>";
						}
					?>
				
			<form action="update_item.php?type=name" method="post" id="update_name">
				<fieldset><legend><h6 class="blue-text center">Enter New Name</h6></legend>
						<div class="input-field" >
							<input type="text" id="new_name" name="new_name" />
							<label id="new_name">New Name</label>
						</div>
					<button class="btn blue lighten-2 white-text waves-effect waves-light"  type="button" onclick="val_item('name')">CHANGE</button>
				</fieldset>
			</form>
			<form action="update_item.php?type=ingredients" method="post" id="update_ing">
				<fieldset><legend><h6 class="blue-text center">Enter New Ingredients</h6></legend>
						<div class="input-field" >
							<input type="text" id="new_ing" name="new_ing" />
							<label id="new_ing">New Ingredients</label>
						</div>
					<button class="btn blue lighten-2 white-text waves-effect waves-light" type="button" onclick="val_item('ing')">CHANGE</button>
				</fieldset>
			</form>
			<form action="update_item.php?type=price" method="post" id="update_price">
				<fieldset><legend><h6 class="blue-text center">Enter New Price</h6></legend>
						<div class="input-field" >
							<input type="text" id="new_price" name="new_price" />
							<label id="new_price">New Price</label>
						</div>
					<button class="btn blue lighten-2 white-text waves-effect waves-light" type="button" onclick="val_item('price')">CHANGE</button>
				</fieldset>
			</form>
					
			<form action="update_item.php?type=credits" method="post" id="update_credits">
				<fieldset><legend><h6 class="blue-text center">Enter New Credits</h6></legend>
						<div class="input-field" >
							<input type="text" id="new_credits" name="new_credits" />
							<label id="new_credits">New Credits</label>
						</div>
					<button class="btn blue lighten-2 white-text waves-effect waves-light" type="button" onclick="val_item('credits')">CHANGE</button>
				</fieldset>
			</form>
				
  <form action="change_pic.php" enctype="multipart/form-data" method="post">
	<fieldset><legend><h6 class="blue-text center">Enter new Image</h6></legend>
    <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" name="pic" id="pic">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
	<button class="btn blue lighten-2 white-text waves-effect waves-light" type="submit">CHANGE</button>
	</fieldset>
  </form>
        <br>
		<div style="text-align:center">
			<a href="remove_item.php?id=<?php echo $item_id; ?>"><button class="btn waves-effect waves-light blue white-text center">REMOVE ITEM</button></a>
		<div>	
			<br>
			<br>
				</div>
				
				<div class="col s12 m3">
					<p></p>
				</div>
				
				
				
			</div>
			
			
			

      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  
	  <script>
		function val_item(str)
		{
			if(str=="name")
			{
				var value=document.getElementById("new_name").value;
				if(value=="")
				{
					Materialize.toast('Specify the required field',2000);
				}
				else
				{
					document.getElementById("update_name").submit();
				}
			}
			else if(str=="ing")
			{
				var value=document.getElementById("new_ing").value;
				if(value=="")
				{
					Materialize.toast('Specify the required field',2000);
				}
				else
				{
					document.getElementById("update_ing").submit();
				}
			}
			else if(str=="price")
			{
				var value=document.getElementById("new_price").value;
				if(value=="")
				{
					Materialize.toast('Specify the required field',2000);
				}
				else
				{
					document.getElementById("update_price").submit();
				}
			}
			else if(str=="credits")
			{
				var value=document.getElementById("new_credits").value;
				if(value=="")
				{
					Materialize.toast('Specify the required field',2000);
				}
				else
				{
					document.getElementById("update_credits").submit();
				}
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