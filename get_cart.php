
<?php
	include("pizza.php");
	session_start();
	
	if($_SESSION["user_id"]==null)
	{
		header("location:index.php?msg=Login First!");
		exit;
		
	}
	include("connection.php");
if(isset($_SESSION["cart"]))
{
	$arr=$_SESSION["cart"];
	$count=count($arr);
	if($count==0)
	{
		unset($_SESSION["cart"]);
			unset($_SESSION["cart_count"]);
		echo "<h5 class='category' style='align:center'>No Items to Show!</h5>";
		exit;
	}
	$credits=0;
	$grand_total=0;
	$return_string="";
	foreach($arr as $x => $o) 
	{
		$cheese=$o->getC_Qty();
						
			$return_string.="<div class='item_hover'>";
				$return_string.="<div class='row'>
									<div class='col-sm-10 col-md-10 col-lg-10 col-xs-10'>
											<h6 style='color:purple'>".$o->getName()."</h6>
									</div>
									<div class='col-sm-2 col-md-2 col-lg-2 col-xs-2'>
											<h6 style='color:purple'></h6>
									</div>
								</div>";
				$return_string.="<div class='row'>
										<div class='col-sm-6 col-lg-6 col-md-6 col-xs-6'>
											<h6 class='category'>Total Quantity: ".$o->getQty()."</h6>
										</div>
										<div  class='col-sm-6 col-lg-6 col-md-6 col-xs-6'>
												<h6 class='category'>Rs.".$o->getQtyCost()."</h6> 
										</div>
									</div>";
				if($cheese!=0)
				{
					$return_string.="<div class='row'>
										<div class='col-sm-6 col-lg-6 col-md-6 col-xs-6'>
											<h6 class='category'>Extra Cheese: ".$o->getC_Qty()."</h6>
										</div>
										<div  class='col-sm-6 col-lg-6 col-md-6 col-xs-6'>
												<h6 class='category'>Rs.".$o->getC_QtyCost()."</h6> 
										</div>
									</div>";
				
				}				
				$return_string.="<div class='row'>
										<div class='col-sm-6 col-lg-6 col-md-6 col-xs-6'>
											<h6 style='color:purple'>TOTAL : Rs.".$o->getCost()."</h6>
										</div>";
								
							$return_string.="</div>";
			
			$return_string.="</div><hr class='category'/>";
			
			
		$credits+=$o->getC();
		$grand_total+=$o->getCost();
	}
	
	$return_string.="<br><h5 class='category' style='color:purple'>Total items: ".$count."</h5>";
	$return_string.="<h5 class='category'  style='color:purple'>Credits Earned: ".$credits."</h5>";
	$return_string.="<h5 class='category' style='color:purple'>TOTAL: Rs. ".$grand_total."</h5>";
	
	echo $return_string;
	
}
else
{
	echo "<h5 class='category' style='align:center'>No Items to Show!</h5>";
}


?>
