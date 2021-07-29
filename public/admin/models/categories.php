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
    static function getAllCategory_RemoveAll()
    {
        $sql = self::$connection->prepare("SELECT * FROM categories WHERE category_name <> 'All'");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function deleteCategoryByID($category_id)
    {
        $sql = self::$connection->prepare("DELETE FROM categories WHERE category_id = ?");
        $sql->bind_param('i', $category_id);
        return $sql->execute();
    }

    static function getCategoryById($category_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM categories WHERE category_id = $category_id");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function insertCategories($category_name, $category_img)
    {
        $sql = self::$connection->prepare("INSERT INTO `categories`(`category_name`, `category_img`) VALUES (?, ?)");
        $sql->bind_param('ss', $category_name, $category_img);
        return $sql->execute();
    }

    static function updateCategories($category_id, $category_name, $category_img, $updated_at)
    {
        $sql = self::$connection->prepare("UPDATE categories SET category_name = ?
        ,category_img = ?, updated_at = ?
        WHERE category_id = ?");
        $sql->bind_param('sssi', $category_name, $category_img, $updated_at, $category_id);
        return $sql->execute();
    }

    static function getNewCategory()
    {
        $sql = self::$connection->prepare("SELECT * FROM categories WHERE category_name <> 'All' ORDER BY created_at DESC LIMIT 2");
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

    static function getAllCategories_andCreatePagination($page, $resultsPerPage)
    {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM categories order by updated_at ASC LIMIT $firstLink, $resultsPerPage");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
    
    static function paginate($url, $page, $totalResults, $resultsPerPage, $offset)
    {
        $totalLinks = ceil($totalResults / $resultsPerPage);
        $links = "";
        $from = $page - $offset;
        $to = $page + $offset;
        if ($from <= 0) {
            $from = 1;
            $to = $offset * 2;
        }
        if ($to > $totalLinks) {
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

    static function getCountProducts_ByCategory($category_id, $category_filter) {
        $sql = self::$connection->prepare("SELECT * FROM categories 
        JOIN products ON categories.category_id = products.$category_filter 
        WHERE categories.category_id = $category_id
        ");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
}