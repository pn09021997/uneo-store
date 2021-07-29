<?php
require_once 'header-require-models.php';



if (isset($_GET['action']) 
    && isset($_GET['cartId'])
    && isset($_GET['orderId'])) {
    $action = $_GET['action'];
    $orderId = $_GET['orderId'];
    
    if ($action == 'confirm') {
        $resultConfirm = -1;
        $listProducts = [];
        $cartsDetail = OrderDetail:: getOrderDetail_ByCartId($_GET['cartId']);  
        foreach ($cartsDetail as $key => $value) {
            array_push($listProducts, [$value['productid'] => $value['quantity']]);
        }

        $resultConfirm = confirmOrder($orderId, $listProducts);
        header('location:./orders.php?resultConfirm='.$resultConfirm);
    } else if ($action == 'cancelconfirm') {
        $resultCancel = -1;

        $resultCancel = cancelConfirm($orderId);
        header('location:./orders.php?resultCancel='.$resultCancel);
    } 
} else {
    header('location:./orders.php');
}


function cancelConfirm($orderId) {
    $resultCancel = -1;
    $resultCancel = Order::cancelConfirmOrder($orderId);
    return $resultCancel;
} 

function confirmOrder($orderId, $listProducts) {
    $resultConfirm = -1;
    if (checkQtyReceipt($listProducts)) {
        $resultConfirm = Order::updateOrder($orderId);
    }
    return $resultConfirm;
} 

function checkQtyReceipt($listProducts) {
    $products = [];
    foreach ($listProducts as $key => $value) {
        array_push($products, array_keys($value));
    }
        
    foreach ($products as $key => $value) {
        $orderQty = '';
        foreach ($listProducts as $key2 => $value2) {
            if (array_keys($value2)[0] == $value[0]) {
                $orderQty = array_values($value2)[0];
            } 
        }
        $currentQty = Product::getProduct_ByID($value[0])[0]['receipt'];     
        if ($currentQty < $orderQty) {
            return -1;
        }
    }
    return 1;
} 

