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
    <link rel="stylesheet" href="css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speel Huis</title>
</head>
<body>

    <!-- Navigation bar -->
    <nav class="navbar" aria-label="Main navigation">
        <a href="index.php">Speel Huis</a>
        <a href="products.php">Products</a>
        <a href="contact.php">Contact</a>
        <a href="Admin/index.php">Login</a>
    </nav>

    <main>
        <section class="content" id="home">
            <h1>Welcome to our Website</h1>
            <p>This is the home page. Feel free to browse our products or get in touch with us!</p>
        </section>

        <section class="content" id="products">
            <h2>About our Speel Huys</h2>
            <p>Speel huys is the first project we have gotten where we have to work in a group. The goal of this project is to boost our teamwork capabilities and learn how to use github with multiple people. For this project we had to make an website with a catalog of lego / dulpo. This catalog needs 2 features. It needs a filter and a button where if you press on a product you get send to different page with more details about this said product.</p>
        </section>

        <section class="content" id="contact">
            <h2>If you have any questions you can check the contact page</h2>
            <p>You can find our email, phone number and our main building location.</p>
        </section>
    </main>

</body>
</html>