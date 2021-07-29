<?php
class CartDetail extends Db
{
    static function getAllOrder()
    {
        $sql = self::$connection->prepare("SELECT * FROM carts_detail");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }


    static function getOrder_ByOrderId($cart_id)    
    {
        $sql = self::$connection->prepare("SELECT * FROM carts_detail WHERE cart_id = ?");
        $sql->bind_param('i', $cart_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    
    static function getOrder_Product($productId, $cart_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM carts_detail WHERE productid = ? AND cart_id = ?");
        $sql->bind_param('ii', $productId, $cart_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function insertOrder($cart_id, $productId, $quantity, $price)
    {
        $sql = self::$connection->prepare("INSERT INTO carts_detail(cart_id, productid, quantity, price) VALUES (?,?,?,?)");
        $sql->bind_param('iiii', $cart_id, $productId, $quantity, $price);
        return $sql->execute();
    }

    static function updateCart($cart_id, $productId, $quantity, $price)
    {
        $sql = self::$connection->prepare("UPDATE carts_detail SET quantity = $quantity, price = $price WHERE productid = $productId AND cart_id = $cart_id");
        return $sql->execute();
    }

    static function removeProduct_ById($cart_id, $productId)
    {
        $sql = self::$connection->prepare("DELETE FROM carts_detail WHERE productid = $productId AND cart_id = $cart_id");
        return $sql->execute();
    }

    static function removeAll()
    {
        $sql = self::$connection->prepare("DELETE FROM carts_detail");
        return $sql->execute();
    }

    static function removeProducts_CartId($cartId)
    {
        $sql = self::$connection->prepare("DELETE FROM carts_detail WHERE carts_detail.cart_id");
        return $sql->execute();
    }
}
