

<?php

//this page should only be accessed by logged in users

//this page allows for editing the selected set and then returns to the 
//adminWorker/adminOwner page depending on the users role
include "../Classes/sets.php";
include "../Classes/database.php";
include "../Classes/users.php";
include "../Classes/sessions.php";

$session = Session::findActiveSession();
if ($session == null) {
  header("location:index.php");
  exit;
}

// Haal de set op via ID uit de URL
$set_id = $_GET['id'] ?? null;
if (!$set_id) {
    echo "Geen set geselecteerd.";
    exit;
}

$set = Set::findById($set_id);
if (!$set) {
    echo "Set niet gevonden.";
    exit;
}

// Verwerk het formulier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $set->name = $_POST['set_name'] ?? $set->name;
    $set->description = $_POST['set_description'] ?? $set->description;
    $set->save(); // Zorg dat je een save-methode hebt

    $user = User::findById($_SESSION['user_id']);
    if ($user->user_role === 'owner') {
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
    <title>Set bewerken</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <h1>Set bewerken</h1>
    <form method="POST">
        <label>Naam set:</label>
        <input type="text" name="set_name" value="<?php echo htmlspecialchars($set->name); ?>" required><br>
        <label>Beschrijving:</label>
        <textarea name="set_description" required><?php echo htmlspecialchars($set->description); ?></textarea><br>
        <input type="submit" value="Opslaan">
    </form>
</body>
</html>