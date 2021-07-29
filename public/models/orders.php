<?php 
class Order extends Db{
    static function getAllOrders()
    {
        $sql = self::$connection->prepare("SELECT * FROM orders
        ORDER BY orders.created_at ASC");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function insertOrder($cartId, $address, $phone, $email, $instruction, $totalPrice)
    {
        $sql = self::$connection->prepare("INSERT INTO orders (cart_id, address, phone, email, instructions, total_price)
        VALUES (?, ?, ? ,? , ?, ?)");
        $sql->bind_param('isissi', $cartId, $address, $phone, $email, $instruction,$totalPrice);
        return $sql->execute();
    }
}