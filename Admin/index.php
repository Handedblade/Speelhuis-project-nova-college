<?php

//this page is for logging into the admin pages
include "../Classes/database.php";
include "../Classes/users.php";
?>
<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Login</title>
</head>
<body>
    <form action="index.php" method="POST">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <?php

    $username = null;
    $password = null;

    if (isset($_POST["username"]) && isset($_POST["password"])) //makes a new session and cookie if the correct username and password have been entered
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $gebruiker = User::findByUsernameAndPassword($username, $password);

        if ($gebruiker == null) {
            echo "Wrong username or password";
        } else {
            $gebruiker->login();
            header("location:adminWorkerPage.php");
            exit;
        }
    }

    ?>
</body>
</html>
