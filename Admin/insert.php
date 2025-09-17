<?php

//this page should only be accessed by logged in users

//this page allows for adding a new set and then returns to the 
//adminWorker/adminOwner page depending on the users role
include "../Classes/sets.php";
include "../Classes/database.php";
include "../Classes/users.php";
include "../Classes/sessions.php";

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Controleer of gebruiker admin/worker/owner is
$user = User::findById($_SESSION['user_id']);
if ($user->user_role !== 'owner' && $user->user_role !== 'admin' && $user->user_role !== 'worker') {
    echo "Geen toegang.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')  //vanuit het sets.php formulier 
    {
    $set = new Set();
    $set->name = $_POST['set_name'] ?? '';
    $set->description = $_POST['set_description'] ?? '';
    $set->brandId = $_POST['set_brand_id'] ?? 0;
    $set->themeId = $_POST['set_theme_id'] ?? 0;
    $set->image = $_POST['set_image'] ?? '';
    $set->price = $_POST['set_price'] ?? 0.0;
    $set->age = $_POST['set_age'] ?? 0;
    $set->pieces = $_POST['set_pieces'] ?? 0;
    $set->stock = $_POST['set_stock'] ?? 0;
    
    $set->insert(); // opslaan in de database
    
    if ($user->user_role === 'owner') 
        {
        header("Location: adminOwnerPage.php");
    } else {
        header("Location: adminWorkerPage.php");
    }
    exit;
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe set toevoegen</title>
    <link rel="stylesheet" href="../css/insert.css">
</head>
<body>
    <main>
        <h1>Nieuwe set toevoegen</h1>

        <form method="POST" action="">
            <fieldset>
            
               <label for="set_name">Naam set:</label>
                <input type="text" id="set_name" name="set_name" required><br><br>

                <label for="set_description">Beschrijving:</label>
                <textarea id="set_description" name="set_description" required></textarea><br><br>

                <label for="set_brand_id">Brand ID:</label>
                <input type="number" id="set_brand_id" name="set_brand_id" required><br><br>

                <label for="set_theme_id">Theme ID:</label>
                <input type="number" id="set_theme_id" name="set_theme_id"><br><br>

                <label for="set_image">Afbeelding URL:</label>
                <input type="url" id="set_image" name="set_image"><br><br>

                <label for="set_price">Prijs (€):</label>
                <input type="number" id="set_price" name="set_price" step="0.01" required><br><br>

                <label for="set_age">Leeftijd:</label>
                <input type="number" id="set_age" name="set_age" required><br><br>

                <label for="set_pieces">Aantal stukken:</label>
                <input type="number" id="set_pieces" name="set_pieces" required><br><br>

                <label for="set_stock">Voorraad:</label>
                <input type="number" id="set_stock" name="set_stock" required><br><br>
            </fieldset>

            <input type="submit" value="Set toevoegen" class="submit-button">
        </form>

        <br>

        <?php if (isset($user) && property_exists($user, 'user_role')): ?>
            <a href="<?= $user->user_role === 'owner' ? 'adminOwnerPage.php' : 'adminWorkerPage.php'; ?>">Terug naar admin pagina</a>
        <?php endif; ?>
    </main>
</body>
</html>
