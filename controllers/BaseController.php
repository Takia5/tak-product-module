<?php
class BaseController {
  public function __construct() {
    //
  }

  protected function sendResponse(int $statusCode, $response) {
    http_response_code($statusCode);
    echo json_encode($response);
  }
}
?>
