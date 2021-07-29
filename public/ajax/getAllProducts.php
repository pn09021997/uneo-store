<?php
require_once ('../../config.php');
require_once ('../models/db.php');
require_once ('../models/product.php');

$product = new Product();
$item = $product::getAllProduct();
echo json_encode($item);    
