<?php
    session_start();
    include_once ('./config.php');
    include_once ('./public/models/db.php');
    include_once ('./public/models/reviews.php');
    include_once ('./public/models/product.php');

    $review = new Review;
    $product = new Product;
    $productName = '';
    if (isset($_GET['review'])) {
        if (isset($_GET['productId']) 
        && isset($_GET['customer-name'])
        && isset($_GET['customer-email'])
        && isset($_GET['review-title'])
        && isset($_GET['content'])){
            $productId = $_GET['productId'];
            $reviewerName = $_GET['customer-name'];
            $reviewerEmail = $_GET['customer-email'];
            $reviewTitle = $_GET['review-title'];
            $content = '<p>'.$_GET['content'].'</p>';
            Review::insertReview($productId, $reviewerName, $reviewerEmail, $reviewTitle ,$content);
            $productName = Product::getProductById($productId)[0]['name'];
        }
    }
    header('location:./product-detail.php?productName='.$productName);