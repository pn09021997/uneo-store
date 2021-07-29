
<?php
require_once 'header-require-models.php';
$deleteResult = -1;
if (isset($_GET['id'])) {
    $getOrder_ByProductId = CartDetail::getOrder_ByProductId($_GET['id']);
    $getOrderDetail_ByProductId = OrderDetail::getOrderDetail_ByProductId($_GET['id']);
    if (count($getOrder_ByProductId) == 0 && count($getOrderDetail_ByProductId) == 0) {
        $removeReview_ById = Review::removeReview_ById($_GET['id']);
        $deleteResult = Product::deleteProductByID($_GET['id']);
    }
}
header("location:./index.php?deleteResult=".(int)$deleteResult);
