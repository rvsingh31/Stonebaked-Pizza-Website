<?php

class Pizza {
    public $item_id;
	public $name;
    public $price=0;
	public $cheese;
	public $qty=0;
	public $c_qty=0;
	public $credits=0;
	 public function __construct($item_id,$price,$cheese,$qty,$c_qty,$credits,$name)
    {
        $this->item_id = $item_id;
		$this->price = $price;
		$this->cheese = $cheese;
		$this->qty = $qty;
		$this->c_qty=$c_qty;
		$this->credits=$credits;
		$this->name=$name;
    }
    
    public function getCheese() {
        return $this->cheese;
    }
	
	
    public function getName() {
        return $this->name;
    }
	
    public function getCredits() {
        return $this->credits;
    }
	
	public function getC() {
        return $this->credits*$this->qty;
    }
	
    public function getC_Qty() {
        return $this->c_qty;
    }
	
    public function getQty() {
        return $this->qty;
    }
	
    public function setItem($x) {
        $this->item_id = $x;
    }
	
	
    public function setPrice($x) {
        $this->price = $x;
    }
	
    public function setName($x) {
        $this->name = $x;
    }
	
    public function setCheese($x) {
        $this->cheese = $x;
    }
	
    public function setC_Qty($x) {
        $this->c_qty = $x;
    }
	
    public function setQty($x) {
        $this->qty = $x;
    }
	
	public function setCredits($x) {
        $this->credits = $x;
    }
	
	public function getItem() {
        return $this->item_id;
    }
	
    public function getPrice() {
        return $this->price;
    }
	
	public function changeqty($x) {
        $val=$this->qty;
		$val=$val+$x;
		$this->qty=$val;
		
    }
	
	public function changecqty($x) {
        $val=$this->c_qty;
		$val=$val+$x;
		$this->c_qty=$val;
		
    }
	
	public function getCost(){
		if($this->cheese=="yes")
		{
			$val=($this->qty*$this->price)+(50*$this->c_qty);
		}
		else
		{
			$val=($this->qty*$this->price);
		}
		return $val;
	}
	
	public function getQtyCost()
	{
		$val=$this->qty*$this->price;
		return $val;
	}
	
	
	public function getC_QtyCost()
	{
		$val=$this->c_qty*50;
		return $val;
	}
	
	public function creditsAll()
	{
		return $this->credits*$this->qty;
	}
	
}

?> 