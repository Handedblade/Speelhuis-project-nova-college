<?php
//this page should only be accessed by logged in users with the "admin" role

//this page deletes the selected set and then returns to the adminOwnerPage.php
include "../Classes/sets.php";
include "../Classes/database.php";
include "../Classes/users.php";
include "../Classes/sessions.php"; 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Controleer of gebruiker admin/owner is
$user = User::findById($_SESSION['user_id']);
if ($user->user_role !== 'owner' && $user->user_role !== 'admin') {
    echo "Geen toegang.";
    exit;
}
// Haal de set op via ID uit de URL
$set_id = $_GET['set_id'] ?? null;
if (!$set_id) {
    echo "Geen set geselecteerd.";
    exit;
}

$set = Set::findById($set_id);
if (!$set) {
    echo "Set niet gevonden.";
    exit;
}

// Verwijder de set
$set->delete(); // Zorg dat je een delete-methode hebt in je Set-class

header("Location: adminOwnerPage.php");
exit;

?>