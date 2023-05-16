<?php
include('./header.php');
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
    <link rel="stylesheet" href="./public/css/home.css">
    <title>uneo</title>
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

                                    <?php
                                    } ?>
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
                                <?php
                                } else { ?>
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
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <div class="container py-5">
                                <h1>REGISTER</h1>
                                <form action="./public/login/user-interaction.php" method="post">
                                    <input type="text" placeholder="Your username must be between 8 and 30 characters long, no contain special characters (@, _, -,...)" name="username" style="width: 100%; border: none;" class="my-3" required>
                                    <input type="password" placeholder="Your password must be between 8 and 16 characters long, must contain at least 1 uppercase character, 1 lowercase character, 1 number" name="password" style="width: 100%; border: none;" class="my-3" required>
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
                                        collection & don ’t
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
                                            $arrProduct = $product::getProductById($value['productid'])[0]; ?>
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
                            <?php
                            } else { ?>
                                <h1 class='text-center text-info'>Please Login First !!!</h1>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-lg-4">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
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
                <div class="container-fluid">
                    <div class="slide-pagination">
                        <span class='page'>01</span> / <span class="total-page" style="font-size: 1rem; font-weight: 500;">2</span>
                    </div>
                    <div class="banner-slide" style="background: url(https://cdn.shopify.com/s/files/1/0076/1708/5530/files/s2_1512x.jpg?v=1607016667) center center / cover no-repeat; height: 650px; background-size: cover ; ">
                        <div class="product-info">
                            <div class="collection">
                                <span class="collection-title" id='category-title'>LIGHTING</span>
                                <br>
                                <span class="collection-year" id='category-year'>2020</span>
                            </div>
                            <p class="product-title">
                                CHIATO
                            </p>
                            <p>FROM <span class="product-price mb-5">$650.00</span></p>
                            <a href="#" class="btn-shopping mt-4">Shop The Colors</a>
                        </div>
                        <div class="mobile-hidden">
                            <span class="banner-slide-controls1" id="btn-slide-prev1"><i class="fas fa-chevron-left"></i></span>
                            <span class="banner-slide-controls1" id="btn-slide-next1"><i class="fas fa-chevron-right"></i></span>
                        </div>
                        <div class="banner-slide-controls2">
                            <button class="btn-dot-slide" id="btn-slide-prev2"></button>
                            <button class="btn-dot-slide" id="btn-slide-next2"></button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Categories -->
        <div class="categories my-4">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $arrNewCategories = [];
                    foreach ($category::getNewCategory() as $key => $value) {
                        $txt = Product::getProductByCategory($value['category_id']);
                        if (count($txt) > 0) {
                            array_push($arrNewCategories, $value);
                        }
                        if (count($arrNewCategories) == 2) {
                            break;
                        }
                    }
                    foreach ($arrNewCategories as $key => $value) :
                    ?>
                        <div class="col-lg-6 col-sm-12 my-3">
                            <a href="./collection.php?categoryName=<?= $value['category_name'] ?>" class="category-item">
                                <div class="column" style="position: relative;">
                                    <div>
                                        <figure><img src="<?= $value['category_img'] ?>" class="img-fluid" /></figure>
                                    </div>
                                </div>
                                <span class="category-info">
                                    <h3><?= $value['category_name'] ?></h3>
                                    <p>
                                        <?= count($product::getProductByCategory($value['category_id'])); ?> Items
                                    </p>
                                </span>
                            </a>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>

        <!-- Trending Products Of Weeks -->
        <div class="trending-of-weeks text-center">
            <div class="container-fluid">
                <h1 class="title">Trending This Weeks</h1>
                <p class="desc">Find a bright ideal to suit your taste with our great selection of suspension, wall,
                    floor and table lights.</p>
                <div class="products my-5">
                    <div class="row">
                        <?php
                        foreach ($product::getProducts_Trending() as $key => $value) :
                        ?>
                            <div class="col-lg-3 col-sm-6">
                                <div class="product-item my-4">
                                    <div class="img-product-item" style="background: url('<?= $value['pro_image'] ?>') no-repeat; height: 300px; background-size: cover;">
                                        <a href="#" class="vote"><i class="far fa-heart"></i></a>
                                        <a href='./cart-interaction.php?productName=p<?= $value['name'] ?>' class="btn-cart">
                                            + Add To Cart
                                        </a>
                                    </div>
                                    <div class="overlay" style="background: url('<?= $value['image_name'] ?>') no-repeat; background-size: cover;">
                                    </div>

                                    <div class="product-item-info mt-4">
                                        <a href="./product-detail.php?productName=<?= $value['name'] ?>" class="product-item-title">
                                            <p><?= $value['name'] ?></p>
                                        </a>
                                        <?php
                                        if ($value['sale'] == 1) {
                                        ?>
                                            <p class="price">On sale form $<?= $value['price'] ?></p>
                                        <?php
                                        } else { ?>
                                            <p class="price">Form $<?= $value['price'] ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>

        </div>
        <hr>
        <!-- New Design -->
        <div class="new-design">
            <div class="container-fluid">
                <div class="categories">
                    <div class="row">
                        <div class="col-lg-6">
                            <h1 class="title">New Design</h1>
                        </div>
                        <div class="col-lg-6">
                            <div class="categories-items d-flex justify-content-end my-3">
                                <ul class="list-categories">
                                    <?php foreach ($category::getAllCategory() as $key => $value) :
                                        if ($key == 0) {
                                    ?>
                                            <li class="list-category-item list-item" id=<?= $value['category_id'] ?> active><?= $value['category_name'] ?></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="list-category-item list-item" id=<?= $value['category_id'] ?>><?= $value['category_name'] ?></li>
                                    <?php
                                        }
                                    endforeach;
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="products my-5 text-center">
                    <div class="row" id='categories-result'>
                        <div class="col-lg-6">
                            <a href="./collection.php?categoryName=All" class="product-item" id='categories-info'>
                                <div class="img-product-item mb-4" <?php
                                                                    $txt = array_slice(Product::getAllProduct(), 0, 4);
                                                                    ?> style="background: url('<?= $txt[0]['category_img'] ?>') center center / cover no-repeat; height: 780px;">
                                    <span class="product-info">
                                        <h3>All</h3>
                                        <p>15 products</p>
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="row" id='productList'>
                                <?php
                                foreach ($txt as $key => $value) :
                                ?>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="product-item">
                                            <div class="img-product-item" style="background: url('<?= $value['pro_image'] ?>') no-repeat; height: 300px; background-size: cover;">
                                                <a href="#" class="vote"><i class="far fa-heart"></i></a>
                                                <a href='./cart-interaction.php?productName=p<?= $value['name'] ?>' class="btn-cart">
                                                    + Add To Cart
                                                </a>
                                                <?php if ($value['sale'] == 0) {
                                                ?>
                                                    <span class="onsale">ONSALE</span>
                                                <?php } ?>

                                            </div>
                                            <div class="overlay" style="background: url('<?= $value['image_name'] ?>') no-repeat; background-size: cover;">
                                            </div>
                                            <div class="product-item-info mt-4">
                                                <a href="./product-detail.php?productName=<?= $value['name'] ?>" class="product-item-title" target="_blank">
                                                    <p><?= $value['name'] ?></p>
                                                </a>
                                                <?php
                                                if ($value['sale'] == 1) {
                                                ?>
                                                    <p class="desc-price"><span class="price">Form $<?= $value['price'] ?></span></p>
                                                <?php
                                                } else { ?>
                                                    <p class="desc-price"><span class="price">On Sale Form $<?= $value['price'] ?></span></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Discover -->
        <div class="discover">
            <div class="container">
                <div style="background: url('https://cdn.shopify.com/s/files/1/0076/1708/5530/files/b1_1920x.jpg?v=1609084589') no-repeat center center / cover; height: 750px; background-size: cover;">
                    <div class="discover-content text-white">
                        <div class="mb-5 collection-title">
                            LIGHTING
                            <br>
                            2018
                        </div>
                        <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/files/home1_image_layout_1.png?v=1609088119" alt="" class="img-fluid">
                        <br>
                        <a href="#" class="mt-5 btn-discover">DISCOVER
                            NOW</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Blog -->
        <div class="our-blogs">
            <div class="container-fluid">
                <div class="our-blogs-header text-center mb-5">
                    <h1 class="title">Our Blogs</h1>
                    <p class="desc">Find a bright ideal to suit your taste with our great selection of suspension, wall,
                        floor and table lights.</p>
                </div>

                <div class="blog-item mobile-hidden">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="blog-item-content">
                                <div class="blog-item-header">
                                    <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/articles/blog11_1728x.jpg?v=1609344075" style="height: 415px; width: 420px;" alt="" class="img-fluid">
                                    <h4 class="title my-3">
                                        <a href="#">Should you use a Shave Cream or Shave Gel ?</a>
                                    </h4>
                                </div>
                                <div class="blog-item-body">
                                    <p><span><a href="#">LOOK</a>, <a href="#">NEWS</a></span> / <span>February 9,
                                            2020</span></p>
                                    <hr style="width: 90px;" class="mt-5 mb-4">
                                    <p>The first thing you need to do is sit down and set your goals. Diana...</p>
                                </div>
                                <a href="#" class="btn-loadmore mt-5">+ Read more</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="blog-item-content">
                                <div class="blog-item-header">
                                    <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/articles/b8_900x.jpg?v=1608651515" style="height: 415px; width: 420px;" alt="" class="img-fluid">
                                    <h4 class="title my-3">
                                        <a href="#">Easy Family Home Work Outs</a>
                                    </h4>
                                </div>
                                <div class="blog-item-body">
                                    <p><span><a href="#">FAMILY</a>, <a href="#">FASHION</a>, <a href="#">SALE</a>, <a href="#">SUMMER</a></span> / <span>February 9,
                                            2020</span></p>
                                    <hr style="width: 90px;" class="mt-5 mb-4">
                                    <p>Even though most of Utah has fully opened up – we’ve been having fun doing...</p>

                                </div>
                                <a href="#" class="btn-loadmore mt-5">+ Read more</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="blog-item-content">
                                <div class="blog-item-header">
                                    <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/articles/b5_900x.jpg?v=1608651517" style="height: 415px; width: 420px;" alt="" class="img-fluid">
                                    <h4 class="title my-3">
                                        <a href="#">4 Ways To Wear A Button-Up Shirt</a>
                                    </h4>
                                </div>
                                <div class="blog-item-body">
                                    <p><span><a href="#">SALE</a>, <a href="#">WEAR</a></span> / <span>February 9,
                                            2020</span></p>
                                    <hr style="width: 90px;" class="mt-5 mb-4">
                                    <p>Hey guys! I wanted to share the ‘Best of’ multiple categories from the Nordstrom
                                        Sale,...</p>

                                </div>
                                <a href="#" class="btn-loadmore mt-5">+ Read more</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="blog-item-moblie">
                    <div class="blog-item-content">
                        <div class="blog-item-header">
                            <div class="slide">
                                <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/articles/b5_900x.jpg?v=1608651517" style="height: 450px; width: 100%;" alt="" class="img-fluid" id="blog-img">
                                <span class="slide-controls" id="btn-prev"><i class="far fa-arrow-alt-circle-left"></i></span>
                                <span class="slide-controls" id="btn-next"><i class="far fa-arrow-alt-circle-right"></i></span>
                            </div>

                            <h4 class="title my-3">
                                <a href="#" id="blog-title">4 Ways To Wear A Button-Up Shirt</a>
                            </h4>
                        </div>
                        <div class="blog-item-body">
                            <p><span id="blog-categories"><a href="#">SALE</a>, <a href="#">WEAR</a></span> / <span id="blog-date">February 9,
                                    2020</span></p>
                            <hr style="width: 90px;" class="mt-5 mb-4">
                            <p id="blog-content">Hey guys! I wanted to share the ‘Best of’ multiple categories from the
                                Nordstrom
                                Sale,...</p>

                        </div>
                        <a href="#" class="btn-loadmore mt-5">+ Read more</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Of Customer -->
        <div class="comments px-4">
            <div class="container-fluid">
                <div class="comment-format">
                    <p>
                        <span class="desc">Very good Design. Flexible. Fast
                            Support.</span> <span class="title">— Steve John
                            (customer)</span>
                    </p>
                </div>
            </div>
        </div>
        <?php
        include('./footer.php');
        ?>