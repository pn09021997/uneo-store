<?php
require_once 'header-require-models.php';
$deleteResult = -1;
if (isset($_GET['id']) == TRUE) {
    $idUser = $_GET['id'];
    $cart_id = Cart::getOrder_ByCustomerId($idUser)[0]['id'];
    var_dump($cart_id);
    $getOrder_ByOrderId = CartDetail::getOrder_ByOrderId($cart_id);
    $flag = true;
    if (count($getOrder_ByOrderId) > 0) {
        $flag = false;
    }

    if ($flag == true) {
        $deleteResult = User::deleteUserByID($_GET['id']);
    } 
}
header("location:./users.php?deleteResult=".(int)$deleteResult);
