<?php

include "Classes/database.php";
include "Classes/sets.php";
include "Classes/brands.php";
include "Classes/themes.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = 1;
}

$set = Set::findById($id);
if (is_null($set)) {
    header("location: products.php");
}

$brand = Brand::findById($set->brandId);
if ($set->themeId != 0) {
    $theme = Theme::findById($set->themeId);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?= $set->name ?></title>
    <link rel="stylesheet" href="detail.css">
</head>
<body> 
    <div class="detail-container">
        <div class="product-image">
            <?php if (!empty($set->image)): ?>
                <img src="images/sets/<?= $set->image ?>" alt="<?= $set->name ?>">
            <?php endif; ?>
        </div> 
        
        <div class="product-info">
            <h1><?= $set->name ?></h1> 
            <p class="price">€<?= $set->price ?></p>
            <p><strong>Beschrijving:</strong> <?= $set->description ?></p> 
            <p><strong>Merk:</strong> <?= $brand->name ?></p>
            <?php if (isset($theme)): ?>
                <p><strong>Thema:</strong> <?= $theme->name ?></p>
            <?php endif; ?>
            <p><strong>Leeftijd:</strong> <?= $set->age ?>+</p>
            <p><strong>Stuks:</strong> <?= $set->pieces ?></p>
            <p><strong>Voorraad:</strong> <?= $set->stock ?></p>
            
            <a href="products.php">Terug naar overzicht</a>
        </div>
    </div>
</body>
</html>