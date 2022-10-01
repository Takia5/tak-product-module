<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../model/Product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->sku) && !empty($data->productName) &&
!empty($data->price) && !empty($data->productSize) &&
!empty($data->type)){    

    $product->sku = $data->sku;
    $product->productName = $data->productName;
    $product->price = $data->price;
	$product->productSize = $data->productSize;
    $product->type = $data->type;
    
    if($product->create()){         
        http_response_code(201);         
        echo json_encode(array("Product was created!"));
    } else{         
        http_response_code(503);        
        echo json_encode(array("Unable to create product."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("Unable to create product. Data is incomplete."));
}
?>