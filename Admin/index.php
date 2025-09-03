<?php

//this page is for logging into the admin pages
include "../Classes/database.php";
include "../Classes/users.php";
include "../Classes/sessions.php";
?>
<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Login</title>
</head>
<body>
    <form action="index.php" method="POST">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
