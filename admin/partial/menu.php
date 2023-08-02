<?php 

    include('../config/constants.php');
    include('./partial/login-check.php');

?>

<html>
    <head>
        <title>Food Order Website-Home page</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
        <link rel="shortcut icon" href="../img/logo.png" />
    </head>

    <body>
        <!-- Menu Section Starts-->
        <div id="header" class="menu">
            <div class="wrapper text-center">
                <ul>
                    <li><i class="fa-solid fa-house" style="color: #ff7b17;"></i><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-best_seller.php">Best seller</a></li>
                    <li><a href="manage-order.php">Orders</a></li>
                    <li><a href="reports.php">Reports</a></li>
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section End -->