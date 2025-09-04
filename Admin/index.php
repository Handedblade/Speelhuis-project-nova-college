<?php

//this page is for logging into the admin pages
include "../Classes/database.php";
include "../Classes/users.php";
?>
<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/index.css">
    <title>Login</title>
</head>
<body>
    <!-- Navigation bar -->
    <nav class="navbar" aria-label="Main navigation">
        <a href="../index.php">Speel Huis</a>
        <a href="../products.php">Products</a>
        <a href="../contact.php">Contact</a>
        <a href="index.php">Login</a>
    </nav>

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
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Pagina</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light d-flex align-items-center" style="height: 100vh;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">

        <div class="card shadow-lg">
          <div class="card-body">
            <h3 class="text-center mb-4">Log in</h3>

            <form name="stad" method="post" action="create.php">
              <div class="mb-3">
                <label class="form-label">Gebruikersnaam</label>
                <input type="text" class="form-control" name="naam" value="" />
              </div>

              <div class="mb-3">
                <label class="form-label">Wachtwoord</label>
                <input type="text" class="form-control" name="ww" value="" />
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Inloggen</button>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>