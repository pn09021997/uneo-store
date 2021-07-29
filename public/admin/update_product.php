<?php
require_once 'header-require-models.php';
?>
<?php
$pro_image = (strlen($_POST['newImg']) > 0) ? $_POST['newImg'] : $_POST['currentImg'];
$updateResult = -1;
$id = '';

if (
    isset($_POST['name'])
    && isset($_POST['category_id'])
    && isset($_POST['price'])
    && isset($_POST['description'])
    && isset($_POST['receipt'])
) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $receipt = $_POST['receipt'];
    $updated_at = (new DateTime('now'))->format('Y-m-d H:i:s');
    $updateResult = checkProductOfCarts_Orders($id);
}
header("location:./form_update.php?functionType=products&id=$id&updateResult=".(int)$updateResult);

function checkProductOfCarts_Orders($productId) {
    $flag = true;
    $updateResult = -1;
    if (count(CartDetail::getOrder_ByProductId($productId)) > 0) {
        $flag = false;
    }  
    if (count(OrderDetail::getListOrdersDetail_Confirm($productId)) > 0) {
        $flag = false;
    } 
    if ($flag == true) {
        $updateResult = Product::updateProduct($id, $name, $category, $price, $pro_image, $description, $updated_at, $receipt);
    }  
    return $updateResult;
} 

