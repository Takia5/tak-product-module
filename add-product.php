<?php
  include_once 'config/Database.php';
  $database = new Database();
  $db = $database->getConnection();
  require "api.php";

  if(isset($_POST['sku'], $_POST['productName'],
    $_POST['price'], $_POST['productSize'], 
    $_POST['type'])){

        $sku = $_POST['sku'];
        $productName = $_POST['productName'];
        $price = $_POST['price'];
        $productSize = $_POST['productSize'];       
        $type = $_POST['type'];

    $postData = array (
        "sku"=> $sku,
        "productName"=>$productName,
        "price"=>$price,
        "productSize" => $productSize,
        "type" => $type
    );

    $response = requestApi(
      'POST', 'http://localhost/tak-product-module/controller/create.php', 
      json_encode($postData));
      header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <meta name="author" content="Takia">
    
    <title>Product List</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

     <!-- Website css -->
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  </head>

  <body>
    <div class="container">

      <form class="well form-horizontal" action="" method="post"  id="product_form">
        <fieldset>

          <!-- Form Name -->
          <div class="title title-flex">
              <h2>Product Add</h2>
              <div>
                <div class="button-group">
                  <ul class="button-group-list">
                    <li>                                        
                      <input value="Save" name="save" class="btn btn-success"  type="submit">
                    </li>

                    <li>
                      <button type="reset" onclick="location.href='index.php'" class="btn btn-warning">Cancel</button>
                    </li>
                  </ul>
                </div>
              </div>
          </div>
          <hr>

          <!-- SKU input-->

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">SKU</label>  
            <div class="col-sm-6">
              <input id="sku" name="sku" placeholder="Product SKU" class="form-control"  
              type="text" oninvalid="this.setCustomValidity('Please, submit required data!')"
              oninput="this.setCustomValidity('')" required>
            </div>
          </div>

          <!-- Name input-->

          <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Name</label> 
            <div class="col-sm-6">
              <input id="name" name="productName" placeholder="Product Name" class="form-control"  
              type="text" oninvalid="this.setCustomValidity('Please, submit required data!')"
            oninput="this.setCustomValidity('')" required>
            </div>
          </div>

          <!-- Price input-->
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Price($)</label>  
              <div class="col-sm-6">
                <input id="price" name="price" placeholder="Product price" class="form-control"
                type="number" min="1" oninvalid="this.setCustomValidity('Please, submit required data!')"
            oninput="this.setCustomValidity('')" required>
            </div>
          </div>
                

          <!-- Select Product Type -->
             
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Type Switcher</label>
              <div class="col-sm-6">
                <select id="productType" name="type" class="form-control selectpicker" >
                  <option value="">Select Product type</option>
                  <option value="Book">Book</option>
                  <option value="Furniture">Furniture</option>
                  <option value="DVD">DVD</option>       
                </select>
              </div>
          </div>

          <!-- DVD Size input-->

          <div id="DVD" class="form-group row hide">
            <label class="col-sm-2 col-form-label">Size</label>  
            <div class="col-sm-6">
              <input id="size" name="dvd_size" placeholder="Please, provide size..."
             class="form-control"  type="number" min="1" onkeyup="setValuesDvd()">
            </div>
          </div>

          <!-- Book Weight input-->

          <div id="Book" class="form-group row hide">
            <label class="col-sm-2 col-form-label" >Weight</label> 
              <div class="col-sm-6">
                <input name="book_weight" placeholder="Please, provide weight..." 
            id="weight" type="number" min="1" class="form-control"  onkeyup="setValuesBook(this.id)">
            </div>
          </div>

          <!-- Furniture Height input-->
          <div id = "Furniture" class="hide" >
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Height</label>  
                <div class="col-sm-6">
                  <input id="height" name="furniture_height" placeholder="Please, provide height..."
               class="form-control"  type="number" min="1" onkeyup="setValuesfuniture()">
              </div>
            </div>

            <!-- Furniture Width input-->

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Width</label>  
              <div class="col-sm-6">
                <input id="width" name="furniture_width" placeholder="Please, provide width..."
               class="form-control"  type="number" min="1" onkeyup="setValuesfuniture()">
              </div>
            </div>

            <!-- Furniture Length input-->

            <div class="form-group row">
              <label class="col-sm-2 col-form-label" >Length</label> 
                <div class="col-sm-6">
                  <input id="length" name="furniture_length" placeholder="Please, provide length..." 
              class="form-control"  type="number" min="1" onkeyup="setValuesfuniture()">
              </div>
            </div>
          </div>

          <input type="hidden" name="productSize" id="productSize" value="">

        </fieldset>
      </form>
    </div><!-- /.container -->

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="assets/js/product.js"></script>

  </body>
</html>