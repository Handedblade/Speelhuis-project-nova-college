<?php
include "Classes/database.php";
include "Classes/sets.php";
include "Classes/brands.php";
include "Classes/themes.php";

if (isset($_GET['id'])) {
    $set = Set::findById($_GET['id']);
    if (is_null($set)) {
        header("location:products.php?message=product not found");
    }
    $brand = Brand::findById($set->brandId);
    if ($set->themeId != 0) {
        $theme = Theme::findById($set->themeId);
    }
} else {
    header("location:products.php?message=product not found");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($set->name); ?></title>
    <link rel="stylesheet" href="detail.css">
</head>
<body>
    <div class="detail-container">
        <div class="product-image">
            <?php if (!empty($set->image)): ?>
                <img src="<?php echo htmlspecialchars($set->image); ?>" alt="<?php echo htmlspecialchars($set->name); ?>">
            <?php endif; ?>
        </div>

        <div class="product-card">
            <h1><?php echo htmlspecialchars($set->name); ?></h1>
            <p class="price">&euro;<?php echo number_format($set->price, 2); ?></p>
            <p><strong>Beschrijving:</strong> <?php echo htmlspecialchars($set->description); ?></p>
            <p><strong>Merk:</strong> <?php echo htmlspecialchars($brand->name); ?></p>
            <?php if (isset($theme)): ?>
                <p><strong>Thema:</strong> <?php echo htmlspecialchars($theme->name); ?></p>
            <?php endif; ?>
            <p><strong>Leeftijd:</strong> <?php echo htmlspecialchars($set->age); ?>+</p>
            <p><strong>Stuks:</strong> <?php echo htmlspecialchars($set->pieces); ?></p>
            <p><strong>Op voorraad:</strong> <?php echo htmlspecialchars($set->stock); ?></p>

            <div class="buttons">
                <a href="products.php" class="btn btn-back">← Terug</a>
            </div>
        </div>
    </div>
</body>
</html>
