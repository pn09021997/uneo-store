<?php
require_once 'header-require-models.php';
?>
<?php
    $updateResult = -1;
    $category_id = '';
    if(isset($_GET['category_id']) 
    && isset($_GET['category_name'])
    && isset($_GET['currentImg'])
    && isset($_GET['newImg'])) {
        $category_id = $_GET['category_id'];
        $category_img = (strlen($_GET['newImg']) == 0) ? $_GET['currentImg'] : $_GET['newImg'];
        $updated_at = (new DateTime('now'))->format('Y-m-d H:i:s');
        $getProductByCategory = Product::getProductByCategory($category_id);
        if (count($getProductByCategory) == 0) {
            $updateResult = Category::updateCategories($category_id, $_GET['category_name'], $category_img, $updated_at);
        }
    }
header("location:./form_update.php?functionType=categories&category_id=$category_id&updateResult=".(int)$updateResult);
