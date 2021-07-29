<?php
class Product extends Db
{

    static function getListSubImageById($productId)
    {
        $sql = self::$connection->prepare("SELECT * FROM products JOIN sub_image ON products.id = sub_image.product_id
        WHERE products.id = $productId");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    static function getProductById($productId)
    {
        $sql = self::$connection->prepare("SELECT * FROM products JOIN categories ON products.category = categories.category_id
        WHERE products.id = $productId");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function getProductByName($productName)
    {
        $sql = self::$connection->prepare("SELECT * FROM products JOIN categories ON products.category = categories.category_id
        WHERE products.name LIKE '%$productName%'");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function getListProductByPriceRange($priceRange, $categoryName)
    {
        if ($categoryName == 'All') {
            $queries =  "SELECT * FROM products JOIN categories ON products.category = categories.category_id 
            WHERE products.price < $priceRange ORDER BY products.created_at ASC";
        } else {
            $queries =  "SELECT * FROM products JOIN categories ON products.category = categories.category_id 
            WHERE products.price < $priceRange AND categories.category_name = '$categoryName' ORDER BY  products.created_at ASC";
        }
        $queries = 
        $sql = self::$connection->prepare($queries);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function getProductByCriteria($columnName, $criteria, $categoryName)
    {   if ($categoryName == 'All') {
            $txt = 'default_category';
        } else {
            $txt = 'category';
        }
        $sql = self::$connection->prepare("SELECT * FROM products JOIN categories ON products.$txt = categories.category_id
        JOIN sub_image ON products.id = sub_image.product_id
        WHERE categories.category_name = '$categoryName'
        ORDER BY products.$columnName $criteria");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function getProductByCategory($category_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products JOIN categories ON products.category = categories.category_id
        JOIN sub_image ON products.id = sub_image.product_id
        WHERE categories.category_id = $category_id
        ORDER BY products.created_at ASC");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function getAllProduct()
    {
        $sql = self::$connection->prepare("SELECT * FROM products JOIN categories ON products.default_category = categories.category_id JOIN sub_image ON products.id = sub_image.product_id ORDER BY products.created_at ASC");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    static function getAllProductsAdmin()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY products.created_at DESC");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function getProducts_Trending()
    {
        $sql = self::$connection->prepare("SELECT * FROM products JOIN sub_image ON products.id = sub_image.product_id 
        JOIN categories ON products.category = categories.category_id
        ORDER BY vote DESC LIMIT 4");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function updateQtyReceiptProduct($productId, $updateQty)
    {
        $sql = self::$connection->prepare("UPDATE products SET products.receipt = $updateQty WHERE products.id = $productId");

        return $sql->execute();
    }
}