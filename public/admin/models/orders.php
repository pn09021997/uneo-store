<?php 
class Order extends Db{
    static function getAllOrders()
    {
        $sql = self::$connection->prepare("SELECT * FROM orders
        ORDER BY orders.confirm ASC");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function getAllOrderUnConfirm()
    {
        $sql = self::$connection->prepare("SELECT * FROM orders WHERE orders.confirm = 0
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

    static function updateOrder($orderId)
    {
        $sql = self::$connection->prepare("UPDATE orders SET orders.confirm = 1 WHERE orders.order_id = ?");
        $sql->bind_param('i', $orderId);
        return $sql->execute();
    }

    static function cancelConfirmOrder($orderId)
    {
        $sql = self::$connection->prepare("UPDATE orders SET orders.confirm = 0 WHERE orders.order_id = ?");
        $sql->bind_param('i', $orderId);
        return $sql->execute();
    }
    
    static function paginate($url, $page, $totalResults, $resultsPerPage, $offset) {
        $totalLinks = ceil(floatval($totalResults)/floatval($resultsPerPage));
        $links = "";

        $from = $page - $offset;
        $to = $page + $offset;
        if($from <= 0) {
            $from = 1;
            $to = $offset * 2;
        }
        if($to > $totalLinks) {
            $to = $totalLinks;
        }

        $firstLink = "";
        $lastLink = "";
        $prevLink = "";
        $nextLink = "";
        // Trường hợp để xuất hiện $firstLink, $lastLink, $prevLink, $nextLink:
        if($page > 1) {
            $prev = $page - 1;
            $prevLink = "<a style=\"padding:10px;\" href='$url" . "page=$prev'>< Previous</a>";
            $firstLink = "<a style=\"padding:10px;\" href='$url" . "page=1'><< First</a>";
        }
        if($page < $totalLinks) {
            $next = $page + 1;
            $nextLink = "<a style=\"padding:10px;\" href='$url" . "page=$next'>Next ></a>";
            $lastLink = "<a style=\"padding:10px;\" href='$url" . "page=$totalLinks'>Last >></a>";
        }
        // $links:
        for($i=$from; $i<=$to; $i++) {
            if($page == $i) {
                $links = $links . "<a style=\"padding:10px;text-decoration:underline;color:red;font-weight:bold;\" href='$url" . "page=$i'>$i</a>";
            }
            else
            {
                $links = $links . "<a style=\"padding:10px;\" href='$url" . "page=$i'>$i</a>";
            }
        }
        return $firstLink . $prevLink . $links . $nextLink . $lastLink;
    }

    static function getOrders_andCreatePagination($page, $resultsPerPage) {
        $firstLink = ($page - 1) * $resultsPerPage;
        $sql = self::$connection->prepare("SELECT * FROM orders
        ORDER BY orders.created_at ASC LIMIT $firstLink, $resultsPerPage");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
}