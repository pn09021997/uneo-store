<?php 
class OrderDetail extends Db{
    static function getAllOrders() {
        $sql = self::$connection->prepare("SELECT * FROM orders_detail");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    } 

    static function getOrderDetail_ByProductId($productId) {
        $sql = self::$connection->prepare("SELECT * FROM orders_detail WHERE orders_detail.productid = ?");
        $sql->bind_param('i', $productId);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    } 

    static function getListOrdersDetail_Confirm($productId) {
        $sql = self::$connection->prepare("SELECT * FROM orders_detail 
        WHERE orders_detail.productid = ?");
        $sql->bind_param('i', $productId);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    } 

    static function getOrderDetail_ByCartId($orderId) {
        $sql = self::$connection->prepare("SELECT * FROM orders_detail WHERE orders_detail.cart_id = ?");
        $sql->bind_param('i', $orderId);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    } 

    static function passListProducts_ToOrderDetail($arrProducts_Cart)
    {
        $queriesItem = "";
        foreach ($arrProducts_Cart as $key => $value) {
            $queriesItem = $queriesItem."(".$value['cart_id'].", " 
            .$value['productid'].", ".$value['quantity'].", ".$value['price']."),";
        }
        $queriesTxt = "INSERT INTO orders_detail (cart_id, productid, quantity, price)
        VALUES ".$queriesItem;
        $queries = substr($queriesTxt, 0, strlen($queriesTxt) - 1);

        $sql = self::$connection->prepare($queries);
        return $sql->execute();
    }
}