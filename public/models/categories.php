<?php
class Category extends Db
{
    static function getAllCategory()
    {
        $sql = self::$connection->prepare("SELECT * FROM categories");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function getNewCategory()
    {
        $sql = self::$connection->prepare("SELECT * FROM categories WHERE category_name <> 'All' ORDER BY created_at DESC");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function getCategoryId($category_name)
    {
        $sql = self::$connection->prepare("SELECT * FROM categories WHERE categories.category_name = '$category_name'");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items[0]['category_id'];
    }
}