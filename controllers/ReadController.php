<?php

declare(strict_types=1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once  '../config/Database.php';
require_once  '../model/Product.php';
require_once  'BaseController.php';

class ReadController extends BaseController {

  public function __construct() {
    parent::__construct();
  }
  
  public function read() {
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);

    // Get the product ID from the URL query string, if it exists
    $product->id = (isset($_GET['productID']) && $_GET['productID']) ? $_GET['productID'] : '0';

    $result = $product->read();

    if($result->num_rows > 0) {    
      $products_arr=[];
      $products_arr["data"]=[]; 
      while ($row = $result->fetch_assoc()) {   
        extract($row); 
        $product_item = array(
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
       parent::sendResponse(200, $products_arr);
    } else { 
      // set response code - 404 Not found
       parent::sendResponse(404, "No products found!");
    }
  }
}

$readController = new ReadController();
$readController->read();