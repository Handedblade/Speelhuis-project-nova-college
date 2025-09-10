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
    <title>Set toevoegen</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <h1>Nieuwe set toevoegen</h1>
    <form method="POST">
        <label>Naam set:</label>
        <input type="text" name="set_name" required><br><br>
        
        <label>Beschrijving:</label>
        <textarea name="set_description" required></textarea><br><br>
        
        <label>Brand ID:</label>
        <input type="number" name="set_brand_id" required><br><br>
        
        <label>Theme ID:</label>
        <input type="number" name="set_theme_id"><br><br>
        
        <label>Afbeelding URL:</label>
        <input type="text" name="set_image"><br><br>
        
        <label>Prijs:</label>
        <input type="number" step="0.01" name="set_price" required><br><br>
        
        <label>Leeftijd:</label>
        <input type="number" name="set_age" required><br><br>
        
        <label>Aantal stukken:</label>
        <input type="number" name="set_pieces" required><br><br>
        
        <label>Voorraad:</label>
        <input type="number" name="set_stock" required><br><br>
        
        <input type="submit" value="Set toevoegen">
        <br>
    <a href="<?php echo ($user->user_role === 'owner') ? 'adminOwnerPage.php' : 'adminWorkerPage.php'; ?>">Terug naar admin pagina</a>
    </form>
    
    
</body>
</html>