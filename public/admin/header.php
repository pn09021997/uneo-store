<?php

require_once 'header-require-models.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="https://cdn.shopify.com/s/files/1/0076/1708/5530/files/ico_32x32.png?v=1614611758" >
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/uniform.css" />
    <link rel="stylesheet" href="css/select2.css" />
    <link rel="stylesheet" href="css/matrix-style.css" />
    <link rel="stylesheet" href="css/matrix-media.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style type="text/css">
        ul.pagination {
            list-style: none;
            float: right;
        }

        ul.pagination li.active {
            font-weight: bold
        }

        ul.pagination li {
            display: flex;
            padding: 10px
        }

        input[value='Search'] {
            margin-bottom: 10px;
        }
        #header >a {
            margin-left: 50px;
        }

        .mobile-hidden{
            display: none;   
        }
        @media only screen and (min-width: 992px) {
            .mobile-hidden{
                display: block;
            }
        }

        .confirm-order {
            background: #000;
        } 
    </style>
</head>

<body>
    <!--Header-part-->
    <div id="header">
    </div>
    <!--close-Header-part-->
    <!--top-Header-menu-->
    <?php require_once "element_navbar.php"; ?>
    <!--sidebar-menu-->
    <div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-th"></i>Tables</a>
        <ul>
            <li><a href="index.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
            <li> <a href="categories.php"><i class="icon icon-th-list"></i> <span>Categories</span></a></li>
            <li> <a href="users.php"><i class="icon icon-th-list"></i> <span>Users</span></a></li>
        </ul>
    </div>