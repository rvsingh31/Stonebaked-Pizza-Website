<?php
 include("connection.php");
 
if(isset($_GET['item_id'])) {
	$sql = "SELECT imageData FROM item_photos WHERE item_id=" . $_GET['item_id'];
	$result=mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['imageData'] ).'"/>';

}

?>