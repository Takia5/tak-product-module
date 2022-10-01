<?php 
    include_once 'config/Database.php';
    $database = new Database();
    $db = $database->getConnection();
    require "api.php";

    if(isset($_POST['delete'])){

        $id = $_POST['delete'];
        foreach ($id as $key => $value) {
           $postData = array (
            "id"=> $value
           );

           $response = requestApi(
            'POST', 'http://localhost/tak-product-module/controller/delete.php', 
            json_encode($postData)); 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="StarBuy Product Module">
    <meta name="keywords" content="StarBuy Product List">
    <meta name="author" content="Takia">

    <title>Product Add</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    
    <!-- Website css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <div class="container py-5">
        <form class="well form-horizontal" action="" method="post">
            <fieldset>
            <!-- Title Section Start -->
                <div class="title title-flex">
                    <div>
                        <h2>Product List</h2>
                    </div>
                    <div class="button-group">
                        <ul class="button-group-list">
                            <li>                                        
                                <input formaction="add-product.php" value="ADD" class="btn btn-success"  type="submit">
                            </li>

                            <li>
                                <input id="delete-product-btn" value="MASS DELETE" class="btn btn-danger"  type="submit">
                            </li>
                        </ul>
                    </div>
                </div>
            <!-- Title Section End -->

            <hr>

            <!-- Product Section Start -->
                    <div class="row">
                        <?php
                            $response = requestApi('GET', 'http://localhost/tak-product-module/controller/read.php', false);

                            $decodedText = html_entity_decode($response);
                            $json = json_decode($response, true);
                            
                            if (empty($json['data'])) {
                                echo("No products found!");
                            } else{
                                foreach($json['data'] as $x => $val) {
                        ?>

                         <div class="col-lg-3 pb-4">
                            <div class="card">
                            
                            <div class="card-body"><p><input class="delete-checkbox" type="checkbox" name="delete[]" value="<?php echo $val['productID']; ?>"></p>
                              <h6><?php echo $val['sku']; ?></h6>
                              <h5><?php echo $val['productName']; ?></h5>
                              <h6 class="price"><?php echo $val['price']; ?>.00 $</h6>
                              <h5><?php echo $val['productSize']; ?></h5>
                            </div>
                        </div>
                        </div> 
                        <?php }} ?>
                    </div>
                <!-- Product Section End -->
            </fieldset>
        </form>
    </div>

</body>

</html>