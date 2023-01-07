<?php

declare(strict_types=1);

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once  '../config/Database.php';
require_once  '../model/Product.php';
require_once  'BaseController.php';

class CreateController extends BaseController {

  public function __construct() {
    parent::__construct();
  }

  private $conn;
  private $product;

  public function create(Database $database, Product $product) {
    $this->conn = $database->getConnection();
    $this->product = $product;

    $data = json_decode(file_get_contents("php://input"));
    if (empty($data->sku) || empty($data->productName) || empty($data->price) || empty($data->productSize) || empty($data->type)) {
        $this->sendResponse(400, array("Unable to create product. Data is incomplete."));
      return;
    }

    $this->product->sku = $data->sku;
    $this->product->productName = $data->productName;
    $this->product->price = $data->price;
    $this->product->productSize = $data->productSize;
    $this->product->type = $data->type;
    
    if ($this->product->create()) {
      parent::sendResponse(201, "Product was created!");
    } else {
      parent::sendResponse(503, "Unable to create product.");
    }
  }
}

$database = new Database();
$product = new Product($database->getConnection());
$createController = new CreateController();
$createController->create($database, $product);
