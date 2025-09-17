<?php
//this page should only be accessed by logged in users with the "admin" role

//this page deletes the selected set and then returns to the adminOwnerPage.php
include "../Classes/sets.php";
include "../Classes/database.php";
include "../Classes/users.php";
include "../Classes/sessions.php"; 

$session = Session::findActiveSession();
if ($session == null) {
  header("location:index.php");
  exit;
}

// Controleer of gebruiker admin/owner is
$user = User::findById($session->userId);
if ($user->role != "admin") {
    header("location: adminWorkerPage.php?message=permission denied");
    exit;
}
// Haal de set op via ID uit de URL
$setId = $_GET['id'] ?? null;
if (!$setId) {
    header("location: adminOwnerPage.php?message=no set id given");
    exit;
}

$set = Set::findById($setId);
if (!$set) {
    header("location: adminOwnerPage.php?message=set not found");
    exit;
}

// Verwijder de set
$set->delete(); // Zorg dat je een delete-methode hebt in je Set-class

header("Location: adminOwnerPage.php?message=delete succesfull");
exit;

?>