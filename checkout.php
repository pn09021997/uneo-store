<?php 
session_start();
include_once ('./config.php');
include_once ('./public/models/db.php');
include_once ('./public/models/product.php');
include_once ('./public/models/categories.php');
include_once ('./public/models/carts.php');
include_once ('./public/models/cartsDetail.php');
include_once ('./public/models/users.php');
include_once ('./public/models/orders.php');
include_once ('./public/models/ordersDetail.php');

$product = new Product;
$category = new Category;
$cart = new Cart;
$cartDetail = new CartDetail;
$user = new User;
$order = new Order;
$orderDetail = new OrderDetail;

if (!isset($_SESSION['isLogin'])) {
    header('location:./index.php');
} 

$checkOutResult = -1;
if (isset($_POST['cartId'])
    && isset($_POST['address'])
    && isset($_POST['phone'])
    && isset($_POST['email'])
    && isset($_POST['instruction'])
    && isset($_POST['totalPrice'])) {
        $cartId = $_POST['cartId'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $instruction = $_POST['instruction'];
        $totalPrice = $_POST['totalPrice'];

        //Pass List Products To OrderDetail table
        $arrProducts_Cart = CartDetail::getOrder_ByOrderId($cartId);
        OrderDetail::passListProducts_ToOrderDetail($arrProducts_Cart);
        CartDetail::removeProducts_CartId($cartId);

        $checkOutResult = Order::insertOrder($cartId, $address, $phone, $email, $instruction, $totalPrice);
    } 

header('location:./cart.php?checkOutResult='.(int)$checkOutResult);



