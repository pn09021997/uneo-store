<?php
require_once ('../../config.php');
require_once ('../models/db.php');
require_once ('../models/product.php');

$product = new Product();

$categoryId = (isset($_POST['categoryID'])) ? $_POST['categoryID']: 'ID NOT FOUND';
$item = Product::getProductByCategory($categoryId);
echo json_encode($item);    
