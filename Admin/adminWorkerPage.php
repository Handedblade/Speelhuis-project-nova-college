<?php

//this page should only be accessed by logged in users with the "employee" role
include "../Classes/users.php";
include "../Classes/database.php";
include "../Classes/brands.php";
include "../Classes/sessions.php";
include "../Classes/themes.php";
include "../Classes/sets.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Admin Worker Page</title>
    <h1>Admin Worker Page</h1>  
    <a href="insert.php">Add New Set</a>
</head>
</html>