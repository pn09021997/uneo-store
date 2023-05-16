<?php
session_start();
include_once('./config.php');
include_once('./public/models/db.php');
include_once('./public/models/product.php');
include_once('./public/models/categories.php');
include_once('./public/models/carts.php');
include_once('./public/models/cartsDetail.php');
include_once('./public/models/users.php');


$product = new Product;
$category = new Category;
$cart = new Cart;
$cartDetail = new CartDetail;
$user = new User;

if (isset($_SESSION['isLogin']['admin'])) {
    header('location:./public/admin/index.php');
}

$flag = true;
$totalPrice = 0;
$userId = '';
if (isset($_SESSION['isLogin']) || isset($_COOKIE['isLogin'])) {
    $userId = $_SESSION['isLogin']['user'];
    if (isset($_COOKIE['isLogin'])) {
        $userId = $_COOKIE['isLogin'];
    }

    $getOrder_ByCustomerId = $cart::getOrder_ByCustomerId($userId);
    $getOrder_ByOrderId = $cartDetail::getOrder_ByOrderId($getOrder_ByCustomerId[0]['id']);
} else {
    $flag = false;
}
