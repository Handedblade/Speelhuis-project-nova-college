<?php
include "Classes/database.php";
include "Classes/sets.php";
include "Classes/brands.php";
include "Classes/themes.php";

$brands = Brand::findAll();
$themes = Theme::findAll();

$filters = [
    'brand' => $_GET['brand'] ?? '',
    'theme' => $_GET['theme'] ?? ''
];

$sets = Set::filter($filters);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Speel Huis - Producten</title>
</head>

<body>

    <!-- Navigatie -->
    <nav class="navbar" aria-label="Main navigation">
        <a href="index.php">Speel Huis</a>
        <a href="products.php">Products</a>
        <a href="contact.php">Contact</a>
        <a href="Admin/index.php">Login</a>
    </nav>

    <?php if (isset($_GET['message'])): ?>
        <b id="message"><?= $_GET['message'] ?></b>
    <?php endif; ?>

    <!-- Pagina container -->
    <div class="page-container">

        <!-- Sidebar met filters -->
        <aside class="sidebar">
            <form method="get">
                <h3>Filteren</h3>

                <div class="filter-group">
                    <label for="brand">Merk</label>
                    <select name="brand" id="brand">
                        <option value="">Alle merken</option>
                        <?php foreach ($brands as $brand): ?>
                            <option value="<?= $brand->id ?>" <?= ($filters['brand'] == $brand->id) ? 'selected' : '' ?>>
                                <?= $brand->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="theme">Thema</label>
                    <select name="theme" id="theme">
                        <option value="">Alle thema's</option>
                        <?php foreach ($themes as $theme): ?>
                            <option value="<?= $theme->id ?>" <?= ($filters['theme'] == $theme->id) ? 'selected' : '' ?>>
                                <?= $theme->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit">Filter toepassen</button>
            </form>
        </aside>

        <!-- Productenlijst -->
        <main class="product-list">
            <table>
                <thead>
                    <tr>
                        <th>Merk</th>
                        <th>Naam</th>
                        <th>Prijs</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sets as $set): 
                        $brand = Brand::findById($set->brandId); ?>
                        <tr>
                            <td>
                                <?php if (!empty($brand->logo)): ?>
                                    <img src="images/logos/<?= $brand->logo; ?>" width="75px">
                                <?php else: ?>
                                    <?= $brand->name ?>
                                <?php endif; ?>
                            </td>
                            <td><?= $set->name ?></td>
                            <td>&euro;<?= number_format($set->price, 2) ?></td>
                            <td><a href="detail.php?id=<?= $set->id ?>">Bekijk product</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>

    </div> <!-- einde .page-container -->

</body>
</html>
