<?php
session_start();
require_once "./config.php";
require_once "./public/models/db.php";
require_once "./public/models/product.php";
require_once "./public/models/users.php";
require_once "./public/models/cartsDetail.php";
require_once "./public/models/carts.php";
$product = new Product;
$user = new User;
$cartDetail = new CartDetail;
$cart = new Cart;



if (isset($_SESSION['isLogin']['user'])) {
    $userId = $_SESSION['isLogin']['user'];
    if (count($user::getUserName($userId)) != 0) {
        if (isset($_GET['productName'])) {
            $productName = str_replace('%', '', $_GET['productName']);
            if ($productName[0] == 'r' 
            || $productName[0] == 'p' 
            || $productName[0] == 'm'
            || $productName[0] == 'R'
            || $productName[0] == 'P'
            || $productName[0] == 'M') {
                if (isset($_GET['addcart'])){
                    if (isset($_GET['productName']) && isset($_GET['product-qty'])) {
                        $productName = substr(str_replace('+', '', $_GET['productName']), 1, strlen($_GET['productName']));
                        $qty = $_GET['product-qty'];
                        $checkProduct = Product::getProductByName($productName);
                        $cartId = Cart::getOrder_ByCustomerId($userId)[0]['id'];
                        $resultAddCart = addCart($checkProduct, $cartId, $qty);
                        if ($resultAddCart == -1) {
                            header('location:./product-detail.php?productName='.$productName.'&resultAddCart='.$resultAddCart);
                        } else {
                            header('location:./product-detail.php?productName='.$productName);
                        }
                    }
                } else {
                    cartConfig($productName, $userId);
                }
            }
        }
    }
} else {
    header('location:./index.php');
}



function cartConfig($productName, $userId){
    $txtlocation = 'location:./index.php';
    if ($productName[0] == 'R'
        || $productName[0] == 'P'
        || $productName[0] == 'M') { 
        $txtlocation = 'location:./cart.php';
    } 
    $newCriteria = strtolower($productName[0]);
    $newProductName = substr($productName, 1);
    $checkProduct = Product::getProductByName($newProductName);
    $cartId = Cart::getOrder_ByCustomerId($userId)[0]['id'];
    if (count($checkProduct) != 0) {

        switch ($newCriteria) {
        case 'r':
            $totalQty = 0;
            $getOrder_ByOrderId = CartDetail::getOrder_ByOrderId($cartId);
            foreach ($getOrder_ByOrderId as $value) {
                if ($value['productid'] == $checkProduct[0]['id']) {
                    $totalQty += $value['quantity'];
                    $removeProduct_ById =  CartDetail::removeProduct_ById($cartId, $checkProduct[0]['id']);
                }
            }

            $currentQty = Product::getProductById($checkProduct[0]['id'])[0]['receipt'];
            Product::updateQtyReceiptProduct($checkProduct[0]['id'], $currentQty + $totalQty);
            break;
        case 'm':
            $getOrder_ByProductId = CartDetail::getOrder_Product($checkProduct[0]['id'], $cartId);
            $qty = $getOrder_ByProductId[0]['quantity'];
            if ($qty == 1) {
                $removeProduct_ById =  CartDetail::removeProduct_ById($cartId, $checkProduct[0]['id']);
            } else {
                $oldQuantity = $getOrder_ByProductId[0]['quantity'];
                $price = $checkProduct[0]['price'];
                $newTolalPrice = ($oldQuantity - 1) * $price;
                $UpdateOrder = CartDetail::updateCart($cartId, $checkProduct[0]['id'], ($oldQuantity - 1), $newTolalPrice);
            }

            $currentQty = Product::getProductById($checkProduct[0]['id'])[0]['receipt'];
            Product::updateQtyReceiptProduct($checkProduct[0]['id'], $currentQty + 1);
            break;
        case 'p':
            $qty = 1;
            $resultAddCart = addCart($checkProduct, $cartId, $qty);
            if ($resultAddCart == -1) {
                header($txtlocation.'?resultAddCart='.$resultAddCart);
            } 
            break;
        default:
            break;
        }
    }
    header($txtlocation);
}

function addCart($checkProduct, $cartId, $qty){

    $currentQty = Product::getProductById($checkProduct[0]['id'])[0]['receipt'];
    $updateQty = $currentQty - $qty;

    if ($updateQty >= 0) { 
        $getOrder_ByProductId = CartDetail::getOrder_Product($checkProduct[0]['id'], $cartId);
        if (count($getOrder_ByProductId) != 0) {
            $oldQuantity = $getOrder_ByProductId[0]['quantity'];
            $oldPrice = $getOrder_ByProductId[0]['price'];
            $totalPrice = $oldQuantity * $checkProduct[0]['price'];
            $newTolalPrice = $oldPrice + $totalPrice;
            $newQuantity = $oldQuantity + $qty;

            $updateOrder = CartDetail::updateCart($cartId, $checkProduct[0]['id'], $newQuantity, $newTolalPrice);
        } else {
            $newTolalPrice = $checkProduct[0]['price'];
            $newQuantity = $qty;

            $updateOrder = CartDetail::insertOrder($cartId, $checkProduct[0]['id'], $newQuantity, $newTolalPrice);
        } 

        Product::updateQtyReceiptProduct($checkProduct[0]['id'], $updateQty);
        return 1;
    } else {
        return -1;
    }
}