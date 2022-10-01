<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../model/Product.php';

$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);

$product->id = (isset($_GET['productID']) && $_GET['productID']) ? $_GET['productID'] : '0';

$result = $product->read();

if($result->num_rows > 0){    
    $products_arr=array();
    $products_arr["data"]=array(); 
	while ($row = $result->fetch_assoc()) { 	
        extract($row); 
        $product_item=array(
            "productID" => $productID,
            "sku" => $sku,
			"productName" => $productName,
            "price" => $price,	
            "productSize" => $productSize,
            "type" => $type
        ); 
       array_push($products_arr["data"], $product_item);
    } 
    // set response code - 200 OK
    http_response_code(200); 
    // show products data in json format
    echo json_encode($products_arr);
}else{ 
    // set response code - 404 Not found
    http_response_code(404); 
    // tell the user no products found
    echo json_encode(
        array("No products found!")
    );
} 