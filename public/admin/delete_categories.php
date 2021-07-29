<?php
require_once 'header-require-models.php';
$deleteResult = -1;
if (isset($_GET['category_id'])) {
    // Kiểm tra xem có còn sản phẩm nào thuộc manufacture đó hay không, nếu còn thì không được xóa.
    if (count(Product::getProductByCategory($_GET['category_id'])) == 0) {
        $deleteResult = Category::deleteCategoryByID($_GET['category_id']);
    }
}
header("location:categories.php?deleteResult=".(int)$deleteResult);
