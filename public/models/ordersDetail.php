<?php 
class OrderDetail extends Db{
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