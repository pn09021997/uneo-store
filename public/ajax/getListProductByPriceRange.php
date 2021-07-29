<?php
require_once ('../../config.php');
require_once ('../models/db.php');
require_once ('../models/product.php');

$product = new Product();

$priceRange = (isset($_POST['priceRange'])) ? $_POST['priceRange']: 'NOT FOUND';
$categoryName = (isset($_POST['categoryName'])) ? $_POST['categoryName']: 'NOT FOUND';

$item = $product::getListProductByPriceRange($priceRange, $categoryName);
echo json_encode($item);

