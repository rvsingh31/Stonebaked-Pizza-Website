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
	$return_string="<button type='button' class='btn btn-simple btn-danger' id='clear_cart_btn'>Clear Cart</button><br/>";
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
				if($o->getQty()>1)
				{
					$return_string.="<div class='col-sm-6 col-lg-6 col-md-6 col-xs-6'>
										<button type='button' data-toggle='modal' href='#remove' data-qty='".$o->getQty()."' data-cqty='".$o->getC_Qty()."' data-rid='".$o->getItem()."' class='btn btn-danger btn-simple'>Remove</button>
									</div>";
				}
				else
				{
					$return_string.="<div class='col-sm-6 col-lg-6 col-md-6 col-xs-6'>
										<button type='button' data-id='".$o->getItem()."' data-toggle='modal' href='#remove2' class='btn btn-danger btn-simple'>Remove</button>
									</div>";
				}
								
							$return_string.="</div>";
			
			$return_string.="</div><hr class='category'/>";
			
			
		$credits+=$o->getC();
		$grand_total+=$o->getCost();
	}
	
	$return_string.="<br><h5 class='category'>Total items: ".$count."</h5>";
	$return_string.="<h5 class='category'>Credits Earned: ".$credits."</h5>";
	$return_string.="<h5 class='category'>TOTAL: Rs. ".$grand_total."</h5>";
	$return_string.="<br><a href='checkout.php'><button class='btn' style='background:#ED4E4B;align:right'>Proceed to Checkout</button></a>";
	$_SESSION["grand_total"]=$grand_total;
	$_SESSION["credits"]=$credits;
	$_SESSION["items_count"]=$count;
	echo $return_string;
	
}
else
{
	echo "<h5 class='category' style='align:center'>No Items to Show!</h5>";
}


?>