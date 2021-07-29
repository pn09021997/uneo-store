<?php
require_once ('../../config.php');
require_once ('../models/db.php');
require_once ('../models/product.php');

$product = new Product();
$columnName = (isset($_POST['columnName'])) ? $_POST['columnName'] : 'NOT FOUND';
$criteria = (isset($_POST['criteria'])) ? $_POST['criteria'] : 'NOT FOUND';
$categoryName = (isset($_POST['categoryName'])) ? $_POST['categoryName'] : 'NOT FOUND';

$item = $product::getProductByCriteria($columnName, $criteria, $categoryName);
echo json_encode($item);