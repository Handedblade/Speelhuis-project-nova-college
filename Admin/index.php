<?php
//this page is for logging into the admin pages
include "../Classes/database.php";
include "../Classes/users.php";

$username = null;
$password = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $gebruiker = User::findByUsernameAndPassword($username, $password);

        if ($gebruiker == null) {
            $error = "Verkeerde gebruikersnaam of wachtwoord!";
        } else {
            $gebruiker->login();
            header("location:adminWorkerPage.php");
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="nl">

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

            <?php if (!empty($error)): ?>
              <div class="alert alert-danger text-center"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php">
              <div class="mb-3">
                <label class="form-label">Gebruikersnaam</label>
                <input type="text" class="form-control" name="username" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Wachtwoord</label>
                <input type="password" class="form-control" name="password" required>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Inloggen</button>
              </div>
              <a href="../index.php">Terug naar Speel Huis</a>

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
