<?php
class Product{ 
    
    private $conn;
    private $productTable = "products";  
    public $id;
    public $name;
    public $price;
    public $size;
    public $type;
    
    public function __construct($db){
        $this->conn = $db;
    } 
	
	function read(){	
		$stmt = $this->conn->prepare(
			"SELECT * FROM ".$this->productTable." ORDER BY productID DESC");
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;

	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->productTable."
			(sku, productName, price, productSize, type)
			VALUES(?,?,?,?,?)");
		
		$this->sku = htmlspecialchars(strip_tags($this->sku));
		$this->productName = htmlspecialchars(strip_tags($this->productName));
		$this->price = htmlspecialchars(strip_tags($this->price));
		$this->productSize = htmlspecialchars(strip_tags($this->productSize));
		$this->type = htmlspecialchars(strip_tags($this->type));
		
		$stmt->bind_param("ssdss", $this->sku, $this->productName, $this->price, $this->productSize, $this->type);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	
	function delete(){
		
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->productTable." 
			WHERE productID = ?");
			
		$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>