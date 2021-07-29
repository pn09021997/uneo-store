<?php
require_once 'header-require-models.php';
?>
<?php
    $insertResult = -1;
    if(isset($_GET['category_name'])) {
        $category_name = $_GET['category_name'];
        $category_img = $_GET['newImg'];
        $getAllCategory = Category::getAllCategory();
        $flag = true;
        foreach ($getAllCategory as $value) {
            if ($value['category_name'] == $category_name) {
                $flag == false;
            } 
        }
        if ($flag == true) {
            $insertResult = Category::insertCategories($category_name, $category_img);
        }
    }
header("location:./form.php?functionType=categories&insertResult=".(int)$insertResult);
