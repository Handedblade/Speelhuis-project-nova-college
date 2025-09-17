<?php
// filepath: c:\xampp\htdocs\github\Speelhuis-project-nova-college\Admin\restore.php


include "../Classes/database.php";
include "../Classes/sets.php";
include "../Classes/brands.php";
include "../Classes/themes.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $set = Set::findById($_POST['id']);
    if ($set) {
        $set->restore(); // Zorg dat je deze methode in je Set-class hebt
    }
}

header("Location: prullenbak.php");
exit;