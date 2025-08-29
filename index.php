<?php

//this page is for showing a brief overview of all the sets/products, no login required.
include "Classes/database.php";
include "Classes/sets.php";
include "Classes/brands.php";
include "Classes/themes.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>speel hyuis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        /* Navbar styles */
        .navbar {
            background-color: #000000;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        /* Main content styles */
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Navigation bar -->
    <div class="navbar">
        <a href="#home">Speel huis</a>
        <a href="#products">Products</a>
        <a href="#contact">Contact</a>
        <a href="login"> Login </a
    </div>

    <!-- Main content -->
    <div class="content" id="home">
        <h1>Welcome to our Website</h1>
        <p>This is the home page. Feel free to browse our products or get in touch with us!</p>
    </div>

    <div class="content" id="products">
        <h2>Our Products</h2>
        <p>Here are some of the great products we offer.</p>
    </div>

    <div class="content" id="contact">
        <h2>Contact Us</h2>
        <p>You can reach us via email at contact@example.com</p>
    </div>

</body>
</html>

