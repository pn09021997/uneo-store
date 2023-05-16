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
    {
        if ($categoryName == 'All') {
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

    static function getProductByCategory_Admin($category_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products JOIN categories ON products.category = categories.category_id 
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

    static function getProduct_ByID($productId)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE products.id = $productId");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    static function deleteProductByID($productId)
    {
        $sql = self::$connection->prepare("DELETE FROM products WHERE products.id = ?");
        $sql->bind_param('i', $productId);
        return $sql->execute();
    }

    static function updateProduct($id, $name, $category_id, $price, $pro_image, $description, $updated_at, $receipt)
    {
        $sql = self::$connection->prepare("UPDATE products SET name= ?, category= ?, price= ?, pro_image= ?, 
        description= ?, updated_at= ?, receipt= ? WHERE id= ?");
        $sql->bind_param('siisssii', $categoryName, $category_id, $price, $pro_image, $description, $updated_at, $receipt, $id);
        return $sql->execute();
    }

    static function insertProduct($name, $category_id, $price, $pro_image, $description, $receipt)
    {
        $sql = self::$connection->prepare("INSERT INTO products (name, category, price, pro_image, description, receipt)
        VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param('siissi', $name, $category_id, $price, $pro_image, $description, $receipt);
        return $sql->execute();
    }

    static function getAllProducts_andCreatePagination($page, $resultsPerPage)
    {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM products order by created_at DESC LIMIT $firstLink, $resultsPerPage");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
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

    static function searchProduct($keyword)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE name like '%$keyword%'");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
    //(SEARCHING + Paging/Pagination) Tìm kiếm sản phẩm và Phân trang:

    static function searchProduct_andCreatePagination($keyword, $page, $resultsPerPage)
    {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM products WHERE name like '%$keyword%' ORDER BY created_at ASC LIMIT $firstLink, $resultsPerPage");
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
        if ($page > 1) {
            $prev = $page - 1;
            $prevLink = "<a style=\"padding:10px;\" href='$url" . "page=$prev'>< Previous</a>";
            $firstLink = "<a style=\"padding:10px;\" href='$url" . "page=1'><< First</a>";
        }
        if ($page < $totalLinks) {
            $next = $page + 1;
            $nextLink = "<a style=\"padding:10px;\" href='$url" . "page=$next'>Next ></a>";
            $lastLink = "<a style=\"padding:10px;\" href='$url" . "page=$totalLinks'>Last >></a>";
        }
        // $links:
        for ($i = $from; $i <= $to; $i++) {
            if ($page == $i) {
                $links = $links . "<a style=\"padding:10px;text-decoration:underline;color:red;font-weight:bold;\" href='$url" . "page=$i'>$i</a>";
            } else {
                $links = $links . "<a style=\"padding:10px;\" href='$url" . "page=$i'>$i</a>";
            }
        }
        return $firstLink . $prevLink . $links . $nextLink . $lastLink;
    }
}
