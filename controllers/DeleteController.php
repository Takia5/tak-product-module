<?php

declare(strict_types=1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
require_once  '../config/Database.php';
require_once  '../model/Product.php';
require_once  'BaseController.php';

class DeleteController extends BaseController {

  public function __construct() {
    parent::__construct();
  }

  private $conn;
  private $product;

  public function delete(Database $database, Product $product) {
    $this->conn = $database->getConnection();
    $this->product = $product;

    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->id)) {
      $this->product->id = $data->id;
      if ($this->product->delete()) {
        parent::sendResponse(200, "Product was deleted.");
      } else {
        parent::sendResponse(503, "Unable to delete product.");
      }
    } else {
      parent::sendResponse(400, "Unable to delete product. Data is incomplete.");
    }
  }
}

// create an instance of the database and product object
$database = new Database();
$product = new Product($database->getConnection());

// create the deleteController object
$deleteController = new DeleteController();

// call the delete method
$deleteController->delete($database, $product);
?>
