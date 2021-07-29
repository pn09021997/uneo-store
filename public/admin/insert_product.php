<?php
require_once 'header-require-models.php';
?>
<?php
 $insertResult = -1;
 if (
     isset($_POST['name'])
     && isset($_POST['category_id'])
     && isset($_POST['price'])
     && isset($_POST['description'])
     && isset($_POST['newImg'])
     && isset($_POST['receipt'])
 ) {
     $name = $_POST['name'];
     $category_id = $_POST['category_id'];
     $price = $_POST['price'];
     $description = $_POST['description'];
     $pro_image = $_POST['newImg'];
     $receipt = $_POST['receipt'];
     $getAllProduct = Product::getAllProductsAdmin();
     $flag = true;
     foreach ($getAllProduct as $value) {
         if ($value['name'] == $name) {
             $flag = false;
         }
     }
     if ($flag == true) {
        $insertResult = Product::insertProduct($name, $category_id, $price, $pro_image, $description, $receipt);
     }
 }
 header("location:./form.php?functionType=products&insertResult=".(int)$insertResult);