<?php


// This page should only be accessed by logged in users with the "admin" role
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
    <title>Admin Owner Page</title>
</head>
<body>
    <h1>Admin Owner Page</h1>  
    <a href="insert.php">Add New Set</a>

    <h2>Delete a Set</h2>
    <form action="delete.php" method="post">
        <label for="set_id">Enter Set ID to Delete:</label>
        <input type="number" name="set_id" id="set_id" required>
        <button type="submit">Delete</button>
    </form>
</body>
</html>