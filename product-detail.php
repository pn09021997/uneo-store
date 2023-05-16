<?php
session_start();
include_once('./config.php');
include_once('./public/models/db.php');
include_once('./public/models/product.php');
include_once('./public/models/categories.php');
include_once('./public/models/carts.php');
include_once('./public/models/cartsDetail.php');
include_once('./public/models/users.php');
include_once('./public/models/reviews.php');

$product = new Product;
$category = new Category;
$cart = new Cart;
$cartDetail = new CartDetail;
$user = new User;
$review = new Review;

$flag1 = true;
if (isset($_GET['productName'])) {
    $productName = str_replace('%', '', $_GET['productName']);
}
if (count($product::getProductByName($productName)) != 0) {
    $productMain = $product::getProductByName($productName)[0];
} else {
    $flag1 = false;
    $productMain = $product::getProducts_Trending()[0];
}

$flag = true;
$totalPrice = 0;
$userId = '';
if (isset($_SESSION['isLogin'])) {
    $userId = $_SESSION['isLogin']['user'];
    $userInfo = User::getUserInfo($userId)[0];
    $getOrder_ByCustomerId = $cart::getOrder_ByCustomerId($userId);
    $getOrder_ByOrderId = $cartDetail::getOrder_ByOrderId($getOrder_ByCustomerId[0]['id']);
} else {
    $flag = false;
}

$allReviews = Review::getReviews_ByProID($productMain['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="https://cdn.shopify.com/s/files/1/0076/1708/5530/files/ico_32x32.png?v=1614611758">

    <link rel="stylesheet" href="./public/css/product-detail-style.css">
    <title>uneo - <?php
                    if ($flag1 == true) {
                        echo $productName;
                    } else {
                        echo ('not found');
                    } ?></title>
    <style>
        #goTop {
            position: fixed;
            right: 10px;
            bottom: 10px;
            z-index: 1000;
            display: none;
            outline: none;
            background-color: transparent;
            border-radius: 50%;
            font-size: 1.1em;
            transition: .2s linear;
            outline: none;
        }

        #goTop:hover {
            border-color: #eb7025;
            background: #eb7025;
        }
    </style>
</head>

<body>
    <button id="goTop">&#11165;</button>
    <div class="wrapper">
        <header class="top-header">
            <!-- Search Modal -->
            <div class="modal fade " id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-body mt-5">
                            <p>WHAT ARE YOU LOOKING FOR?</p>
                            <input type="text" placeholder="Search Product..." class="search" id="searchInput">
                            <hr>
                        </div>
                        <ul id="searchList" class="list-group px-3 pb-3" style='list-style: none'>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Login Modal -->
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <div class="container py-5">
                                <?php
                                if ($flag == false) {
                                    if (isset($_GET['register'])) {
                                ?>
                                        <h5 class='text-danger'>REGISTER FAIL !!!</h5>
                                    <?php } ?>
                                    <h1>Login</h1>
                                    <form action="./public/login/user-interaction.php" method="post">
                                        <select name="permission" id="permission" class='my-3'>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                        <input type="text" placeholder="Email..." name="username" style="width: 100%; border: none;" class="my-3" required>
                                        <input type="password" placeholder="Password..." name="password" style="width: 100%; border: none;" class="my-3" required>
                                        <button class="btn btn-dark mt-3 btn-block btn-signin py-3" type="submit" value="Signin" name="login">Sign In</button>
                                    </form>
                                    <button class="btn btn-dark mt-3 btn-block btn-signin py-3" data-toggle="modal" data-target="#registerModal">REGISTER</button>
                                    <button class='text-center text-danger' id='btn-readme' data-toggle="modal" data-target="#readMeModal">READ ME</button>
                                <?php } else { ?>
                                    <div class='text-center'>
                                        <h1 class='text-info'>Welcome Back</h1>
                                        <a href="./public/login/logout.php" class='btn btn-outline-info mt-3 btn-block'>Logout</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register Modal -->
            <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <div class="container py-5">
                                <h1>REGISTER</h1>
                                <form action="./public/login/user-interaction.php" method="post">
                                    <input type="text" placeholder="Email..." name="username" style="width: 100%; border: none;" class="my-3" required>
                                    <input type="password" placeholder="Password..." name="password" style="width: 100%; border: none;" class="my-3" required>
                                    <input type="password" placeholder="Confirm Password..." name="password2" style="width: 100%; border: none;" class="my-3" required>
                                    <button class="btn btn-dark mt-3 btn-block btn-signin py-3" type="submit" value="register" name="register">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Read Me Modal -->
            <div class="modal fade" id="readMeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <div class="container py-5">
                                <h1>READ ME</h1>
                                <table id='readme-result' class='text-center'>
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>phuong123</td>
                                            <td>phuong123</td>
                                            <td>User</td>
                                        </tr>
                                        <tr>
                                            <td>admin</td>
                                            <td>admin</td>
                                            <td>Admin</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class='text-danger mt-3'>User account will be use in store and for Admin is Store Manager !.Tks for enjoy my project</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Bar Modal -->
            <div class="modal fade" id="sideBarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container py-5">
                                <div class="top-content">
                                    <a href="#">
                                        <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/files/logo_360x.png?v=1609091045" alt="logo-img" class="img-fluid logo-img">
                                    </a>
                                    <a href="#" class="votes"><i class="far fa-heart mx-5"></i></a>
                                    <a href="#" class="exchanges"><i class="fas fa-exchange-alt"></i></a>
                                </div>
                                <div class="body-content my-5">
                                    <p class="mb-5">Time to shop! Find your favorite product, check the latest
                                        collection & don’t
                                        miss out the best siscounts with Letta!</p>
                                    <h5 class="my-5">Instagram Uneox</h5>
                                    <h4>Newsletter</h4>
                                    <div class="form-email">
                                        <input type="email" placeholder="Youremail" class="email">
                                        <button class="btn-send-email"><i class="fas fa-envelope"></i></button>
                                    </div>
                                </div>
                                <div class="footer-content">
                                    <ul class='social-contact-list'>
                                        <li class="social-item">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="social-item">
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="social-item"><a href="#">
                                                <i class="fab fa-pinterest"></i></a></li>
                                        <li class="social-item"><a href="#">
                                                <i class="fab fa-instagram-square"></i></a>
                                        </li>
                                        <li class="social-item"><a href="#">
                                                <i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cart Modal -->
            <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body mb-4">
                            <?php
                            if ($flag == true) {
                            ?>
                                <div class="cart-header">
                                    <table>
                                        <?php foreach ($getOrder_ByOrderId as $key => $value) :
                                            $totalPrice += $value['price'];
                                            $arrProduct = $product::getProductById($value['productid'])[0];
                                        ?>
                                            <tr>
                                                <td class="product-img">
                                                    <img src="<?= $arrProduct['pro_image'] ?>" alt="" class="img-fluid" width="80px" height="80px">
                                                </td>
                                                <td class="product-info">
                                                    <a href='./product-detail.php?productName=<?= $arrProduct['name'] ?>' class="product-title"><?= $arrProduct['name'] ?></a>
                                                    <p class="product-price">$<?= $arrProduct['price'] ?> <span class="product-qty">x <?= $value['quantity'] ?></span></p>
                                                </td>
                                                <td class="tools">
                                                    <a href="./cart-interaction.php?productName=r<?= $arrProduct['name'] ?>">x</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                                <div class="cart-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <p>Total:</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <p class="total-price">$<?= $totalPrice ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-footer text-center">
                                    <button class="btn-checkout my-4">Check out</button>
                                    <a href="./cart.php" class="view-cart">View Cart</a>
                                </div>
                            <?php } else { ?>
                                <h1 class='text-center text-info'>Please Login First !!!</h1>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-lg-4">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./index.php">
                        <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/files/logo_360x.png?v=1609091045" alt="logo-img" class="img-fluid logo-img">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form action='product-detail.php' method='GET' class="form-inline my-2 search-form-mobile">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" name='productName'>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                        <ul class="navbar-nav mr-auto" style='z-index: 1;'>
                            <li class="nav-item dropdown active mx-3 d-layout">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    LAYOUT
                                </a>
                                <div class="mobile-hidden">
                                    <div class="dropdown-content layout-content">
                                        <div class="row">
                                            <div class="col-lg-2 column">
                                                <h5>DEMOS HOME</h5>
                                                <ul style="list-style: none;">
                                                    <li><a href="#">Home-v1</a></li>
                                                    <li><a href="#">Home-v2</a></li>
                                                    <li><a href="#">Home-v3</a></li>
                                                    <li><a href="#">Home-v4</a></li>
                                                    <li><a href="#">Home-v5</a></li>
                                                    <li><a href="#">Home-v6</a></li>
                                                    <li><a href="#">Home-v7</a></li>
                                                    <li><a href="#">Home-v8</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-2 column">
                                                <h5>DEMOS LAYOUTS</h5>
                                                <ul style="list-style: none;">
                                                    <li><a href="#">Home-v1</a></li>
                                                    <li><a href="#">Home-v2</a></li>
                                                    <li><a href="#">Home-v3</a></li>
                                                    <li><a href="#">Home-v4</a></li>
                                                    <li><a href="#">Home-v5</a></li>
                                                    <li><a href="#">Home-v6</a></li>
                                                    <li><a href="#">Home-v7</a></li>
                                                    <li><a href="#">Home-v8</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-2 column">
                                                <h5>COLLECTIONS</h5>
                                                <a href="#">Home-v1</a>
                                                <a href="#">Home-v2</a>
                                                <a href="#">Home-v3</a>
                                                <a href="#">Home-v4</a>
                                                <a href="#">Home-v5</a>
                                                <a href="#">Home-v6</a>
                                                <a href="#">Home-v7</a>
                                                <a href="#">Home-v8</a>
                                            </div>
                                            <div class="col-lg-6 column">
                                                <a href="#">
                                                    <div style="background: url('https://cdn.shopify.com/s/files/1/0076/1708/5530/files/h13-i4_413x.jpg?v=1614096919') no-repeat; width: 600px; height: 600px; padding: 120px;">
                                                        <h2 class="text-white">SALE OFF 15%</h2>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-mobile dropdown-layout-mobile" aria-labelledby="navbarDropdown">
                                    <a href="#">Demos Home</a>
                                    <a href="#">Demos Layouts</a>
                                    <a href="#">Collections</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown mx-3 d-layout">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    SHOP
                                </a>
                                <div class="mobile-hidden">
                                    <div class="dropdown-content layout-content">
                                        <div class="row">
                                            <div class="col-lg-3 column">
                                                <h5>DEMOS HOME</h5>
                                                <ul style="list-style: none;">
                                                    <li><a href="#">Home-v1</a></li>
                                                    <li><a href="#">Home-v2</a></li>
                                                    <li><a href="#">Home-v3</a></li>
                                                    <li><a href="#">Home-v4</a></li>
                                                    <li><a href="#">Home-v5</a></li>
                                                    <li><a href="#">Home-v6</a></li>
                                                    <li><a href="#">Home-v7</a></li>
                                                    <li><a href="#">Home-v8</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-2 column">
                                                <h5>DEMOS LAYOUTS</h5>
                                                <ul style="list-style: none;">
                                                    <li><a href="#">Home-v1</a></li>
                                                    <li><a href="#">Home-v2</a></li>
                                                    <li><a href="#">Home-v3</a></li>
                                                    <li><a href="#">Home-v4</a></li>
                                                    <li><a href="#">Home-v5</a></li>
                                                    <li><a href="#">Home-v6</a></li>
                                                    <li><a href="#">Home-v7</a></li>
                                                    <li><a href="#">Home-v8</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3 column">
                                                <a href="#">
                                                    <div style="background: url('https://cdn.shopify.com/s/files/1/0415/5382/1854/files/m5_300x.jpg?v=1597333530') no-repeat; width: 600px; height: 600px; padding: 120px;">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-4 column">
                                                <a href="#">
                                                    <div style="background: url('https://cdn.shopify.com/s/files/1/0076/1708/5530/files/mn_1_300x.jpg?v=1617465403') no-repeat; width: 600px; height: 600px; padding: 120px;">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-mobile dropdown-layout-mobile" aria-labelledby="navbarDropdown">
                                    <a href="#">Demos Home</a>
                                    <a href="#">Demos Layouts</a>
                                    <a href="#">Collections</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown mx-3 d-layout">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    LOOKBOOK
                                </a>
                                <div class="mobile-hidden">
                                    <div class="dropdown-content layout-content">
                                        <div class="row pr-5" style="justify-content: space-between;">
                                            <div class="col-lg-3 column">
                                                <a href="#">
                                                    <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/files/u1_300x.jpg?v=1617387578" alt="" class="img-fluid" style="width: 100%; height: auto;">
                                                    <h5 class="text-center text-dark mt-3">Furnitures</h5>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 column">
                                                <a href="#">
                                                    <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/files/u2_300x.jpg?v=1617387578" alt="" class="img-fluid" style="width: 100%; height: auto;">
                                                    <h5 class="text-center text-dark mt-3">Chairs</h5>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 column">
                                                <a href="#">
                                                    <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/files/u3_300x.jpg?v=1617387578" alt="" class="img-fluid" style="width: 100%; height: auto;">
                                                    <h5 class="text-center text-dark mt-3">Sofas</h5>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 column">
                                                <a href="#">
                                                    <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/files/u4_300x.jpg?v=1617387578" alt="" class="img-fluid" style="width: 100%; height: auto;">
                                                    <h5 class="text-center text-dark mt-3">Stools</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-mobile dropdown-layout-mobile" aria-labelledby="navbarDropdown">
                                    <a href="#">Demos Home</a>
                                    <a href="#">Demos Layouts</a>
                                    <a href="#">Collections</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown mx-3 d-layout">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    BLOG
                                </a>
                                <div class="mobile-hidden">
                                    <div class="dropdown-content layout-content">
                                        <div class="row">
                                            <div class="col-lg-3 column">
                                                <h5>DEMOS HOME</h5>
                                                <ul style="list-style: none;">
                                                    <li><a href="#">Home-v1</a></li>
                                                    <li><a href="#">Home-v2</a></li>
                                                    <li><a href="#">Home-v3</a></li>
                                                    <li><a href="#">Home-v4</a></li>
                                                    <li><a href="#">Home-v5</a></li>
                                                    <li><a href="#">Home-v6</a></li>
                                                    <li><a href="#">Home-v7</a></li>
                                                    <li><a href="#">Home-v8</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-mobile dropdown-layout-mobile" aria-labelledby="navbarDropdown">
                                    <a href="#">Demos Home</a>
                                    <a href="#">Demos Layouts</a>
                                    <a href="#">Collections</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown mx-3 d-layout">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    PAGE
                                </a>
                                <div class="mobile-hidden">
                                    <div class="dropdown-content layout-content">
                                        <div class="row">
                                            <div class="col-lg-3 column">
                                                <h5>DEMOS HOME</h5>
                                                <ul style="list-style: none;">
                                                    <li><a href="#">Home-v1</a></li>
                                                    <li><a href="#">Home-v2</a></li>
                                                    <li><a href="#">Home-v3</a></li>
                                                    <li><a href="#">Home-v4</a></li>
                                                    <li><a href="#">Home-v5</a></li>
                                                    <li><a href="#">Home-v6</a></li>
                                                    <li><a href="#">Home-v7</a></li>
                                                    <li><a href="#">Home-v8</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-mobile dropdown-layout-mobile" aria-labelledby="navbarDropdown">
                                    <a href="#">Demos Home</a>
                                    <a href="#">Demos Layouts</a>
                                    <a href="#">Collections</a>
                                </div>
                            </li>
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="#">CONTACT</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown mobile-hidden">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Currency
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">
                                        <img src="./public/images/download.svg" alt="" class="img-fluid"> USD
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img src="./public/images/download (1).svg" alt="" class="img-fluid"> EUR
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img src="./public/images/download (2).svg" alt="" class="img-fluid"> AUD
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img src="./public/images/download (3).svg" alt="" class="img-fluid"> GBP
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img src="./public/images/download (4).svg" alt="" class="img-fluid"> JPY
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img src="./public/images/download (5).svg" alt="" class="img-fluid"> INR
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item mobile-hidden">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-search" data-toggle="modal" data-target="#searchModal"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <?php if (isset($_SESSION['isLogin']['user'])) { ?>
                                        <i class="far fa-user text-danger" data-toggle="modal" data-target="#loginModal"></i>
                                    <?php } else { ?>
                                        <i class="far fa-user" data-toggle="modal" data-target="#loginModal"></i>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link cart" href="#">
                                    <i class="fas fa-shopping-cart" data-toggle="modal" data-target="#cartModal"></i>
                                </a>
                            </li>
                            <li class="nav-item mobile-hidden">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-bars" data-toggle="modal" data-target="#sideBarModal"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Banner -->
            <div class="banner">
                <div class="banner-format text-center py-4" style="background: #ffefe6">
                    <h2 class="product-name">
                        <?php
                        if ($flag1 == false) {
                            echo "We not found product you want. Here is our best vote product !!!";
                        } else {
                            echo $productName;
                        }
                        ?>
                    </h2>
                    <p>
                        <span><a href="./index.php" class="home-link">Home</a></span> / <span><a class="category-title" href="./collection.php?categoryName=<?= $productMain['category_name'] ?>"><?= $productMain['category_name'] ?></a></span>
                    </p>
                </div>
            </div>
        </header>
        <!-- Product -->
        <div class="products">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-img text-center">
                            <div class="img-product-item main-img" style="background: url('<?= $productMain['pro_image'] ?>') no-repeat center center / cover; height: 530px;">
                            </div>
                            <div class="product-item-type mobile-hidden mb-4 mt-4">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?= $productMain['pro_image'] ?>" alt="" class="img-fluid sub-img">
                                    </div>
                                    <?php
                                    $listSubImg = $product::getListSubImageById($productMain['id']);
                                    foreach ($listSubImg as $key => $value) :
                                    ?>
                                        <div class="col-3">
                                            <img src="<?= $value['image_name'] ?>" alt="" class="img-fluid sub-img">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-info pl-lg-5">
                            <h1 class="product-title"><?= $productMain['name'] ?></h1>
                            <p class="product-price">$<?= $productMain['price'] ?></p>
                            <div class="tools my-5">
                                <div class="row">
                                    <div class="col-lg-6 col-md-3 mb-sm-3">
                                        <form action="./cart-interaction.php" method='get'>
                                            <input type="hidden" name="productName" id="productName" value="p<?= $productMain['name'] ?>" />
                                            <input type="number" name="product-qty" id="product-qty" class="my-1" min="1" value="1">
                                            <button class="btn-addcart my-1" type="submit" value="addcart" name="addcart">Add To Cart</button>
                                        </form>
                                    </div>
                                    <div class="col-lg-6 col-md-3 mb-sm-3">
                                        <a href='./cart-interaction.php?productName=P<?= $productMain['name'] ?>' class="btn-buynow my-1">Buy It
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="collection-info">
                                <p>Category: <span class="collection-title"><?= $productMain['category_name'] ?></span></p>
                                <p>Available: <span class="available">
                                        <?php
                                        if ($productMain['receipt'] > 0) {
                                            echo "Available";
                                        } else {
                                            echo "Un Available";
                                        }
                                        ?>
                                    </span></p>
                            </div>
                            <hr>
                            <div class="share-media">
                                <p class="share-title">Share: </p>
                                <ul>
                                    <li class="list-item1"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="list-item1"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-item1"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                    <li class="list-item1"><a href="#"><i class="fab fa-instagram-square"></i></a>
                                    </li>
                                    <li class="list-item1"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Description -->
        <div class="comments">
            <div class="container my-5">
                <div class="product-selected my-3">
                    <div class="row">
                        <div class="col-6">
                            <button class="btn-product-selected text-left" id="btnDesc">Description</button>
                        </div>
                        <div class="col-6">
                            <button class="btn-product-selected text-right" id="btnReviewForm">Reviews (<span class="review-qty"><?= count($allReviews) ?></span>)</button>
                        </div>
                    </div>
                </div>

                <div class="product-slide mt-5">
                    <div id="desc-slide">
                        <p><?= $productMain['description'] ?></p>
                    </div>
                    <div id="review-slide">
                        <div class="row d-flex justify-content-center" id="preReviewForm">
                            <div class="col-lg-6">
                                <p class="review-form-title">
                                    Customer Reviews
                                </p>
                                <div class="review-slide">
                                    <p class="review-notifite"></p>
                                </div>
                            </div>
                            <div class="col-lg-6 justify-content-end">
                                <button id="btn-openReviewForm">Write A Review</button>
                                <button id="btn-openReviewView">View</button>
                            </div>
                        </div>
                        <div id="review-form">
                            <hr>
                            <p class="title">
                                Write a review
                            </p>
                            <div class="content-form">
                                <form action="./up-review.php" method="get" target="_blank">
                                    <input type="hidden" name="productId" id="productId" value="<?= $productMain['id'] ?>" />
                                    <input type="text" name="customer-name" id="customer-name" placeholder="Enter your name" required value=<?php if ($flag == true) {
                                                                                                                                                echo $userInfo['username'];
                                                                                                                                            } else {
                                                                                                                                                echo '';
                                                                                                                                            } ?>>
                                    <input type="text" name="customer-email" id="customer-email" placeholder=<?php if ($flag == true) {
                                                                                                                    echo $userInfo['username'] . '@gmail.com';
                                                                                                                } else {
                                                                                                                    echo ('Enter your email');
                                                                                                                } ?> required>
                                    <br>
                                    <input type="text" name="review-title" id="review-title" placeholder="Give your review a title">
                                    <br>
                                    <textarea name="content" id="content" rows="5" placeholder="Write your comments here" required></textarea>
                                    <button type="submit" class="btn-submit" name='review' value='review'>SUBMIT REVIEW</button>
                                </form>
                            </div>
                        </div>
                        <div id="reviewView">
                            <?php
                            $reviewPage = 1;
                            $reviewsPerPage = 3;
                            $totalReviews = count(Review::getReviews_ByProID($productMain['id']));
                            if (isset($_GET['page']) == TRUE) {
                                $reviewPage = $_GET['page'];
                            }
                            $list_of_reviews = Review::getReviews_ByProID_andCreatePagination($productMain['id'], $reviewPage, $reviewsPerPage);
                            foreach ($list_of_reviews as $key => $value) :
                            ?>
                                <div class="review-view-item pt-2 text-dark">
                                    <h5 style="color: #797979;">Name: <?= $value['reviewer_name'] ?></h5>
                                    <p>Title : <?= $value['review_title'] ?></p>
                                    <p><?= $value['content'] ?></p>
                                    <span>
                                        <p>
                                            Laters:
                                            <?php $time = strtotime($value['created_at']);
                                            echo $mysqldate = date('F j, Y g:i a', $time); ?>
                                        </p>
                                    </span>
                                    <hr>
                                </div>
                            <?php endforeach; ?>
                            <div style="text-align:center;">
                                <?php echo Review::paginate("product-detail.php?productName=" . $productName . "&", $reviewPage, $totalReviews, $reviewsPerPage, 1); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related product -->
        <div class="related-product">
            <div class="container-fluid">
                <h2 class="text-center">Related product</h2>
                <div class="products">
                    <div class="row">
                        <?php
                        $arrRelatedProducts = array_slice($product::getProductByCategory($productMain['category_id']), 0, 3);
                        foreach ($arrRelatedProducts as $key => $value) :
                        ?>
                            <div class="col-lg-3 col-sm-6 product-layout">
                                <div class="product-item text-center">
                                    <div class="img-product-item" style="background: url('<?= $value['pro_image'] ?>') no-repeat; height: 300px; background-size: cover;">
                                        <a href="#" class="vote"><i class="far fa-heart"></i></a>
                                        <a href='./cart-interaction.php?productName=p<?= $value['name'] ?>' class="btn-cart">
                                            + Add To Cart
                                        </a>
                                    </div>
                                    <div class="overlay" style="background: url('<?= $value['image_name'] ?>') no-repeat; background-size: cover;">
                                    </div>
                                    <div class="product-item-info mt-4">
                                        <a href="./product-detail.php?productName=<?= $value['name'] ?>" class="product-item-title" target="_blank">
                                            <p><?= $value['name'] ?></p>
                                        </a>
                                        <?php if ($value['sale'] == 1) { ?>
                                            <p class="desc-price">On Sale From <span class="price">$<?= $value['price'] ?></span></p>
                                        <?php
                                        } else {
                                        ?>
                                            <p class="desc-price">From <span class="price">$<?= $value['price'] ?></span></p>
                                    </div>
                                </div>
                            </div>
                    <?php }
                                    endforeach;
                    ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="./collection.php?categoryName=<?= $productMain['category_name'] ?>" target='_blank' class="btn-backcollectionpage">
                <i class="fas fa-long-arrow-alt-left"></i> Back to <?= $productMain['category_name'] ?>
            </a>
        </div>
        <?php include('./footer.php') ?>