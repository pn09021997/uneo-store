<?php
session_start();
if (!isset($_SESSION['isLogin']['admin'])) {
    header('location:../../index.php');
}

require_once "../../config.php";
require_once "./models/db.php";
require_once "./models/product.php";
require_once "./models/reviews.php";
require_once "./models/carts.php";
require_once "./models/cartsDetail.php";
require_once "./models/users.php";
require_once "./models/categories.php";
require_once "./models/orders.php";
require_once "./models/ordersDetail.php";

$product = new Product;
$review = new Review;
$cart = new Cart;
$cartDetail = new CartDetail;
$user = new User;
$category = new Category;
$order = new Order;
$orderDetail = new OrderDetail;