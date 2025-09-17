<?php

include "../Classes/database.php";
include "../Classes/sets.php";
include "../Classes/brands.php";
include "../Classes/themes.php";

$deletedSets = Set::findDeleted(); // ALTER TABLE sets ADD COLUMN deleted TINYINT(1) NOT NULL DEFAULT 0; dit toegevoegen in mijn SQL om de kolom toe te voegen doe dat ook in je SQL :)))))


?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Prullenbak - Verwijderde Sets</title>
    <link rel="stylesheet" href="../css/prullenbak.css">
</head>
<body>
    <h1>Prullenbak</h1>
    <a href="../Admin/adminOwnerPage.php">← Terug naar overzicht</a>
    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Beschrijving</th>
                <th>Herstel</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($deletedSets as $set): ?>
                <tr>
                    <td><?php echo htmlspecialchars($set->name); ?></td>
                    <td><?php echo htmlspecialchars($set->description); ?></td>
                    <td>
                        <form action="restore.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $set->id; ?>">
                            <button type="submit">Herstel</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($deletedSets)): ?>
                <tr><td colspan="3">Geen verwijderde sets.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>