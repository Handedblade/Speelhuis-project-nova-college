<?php


// This page should only be accessed by logged in users with the "admin" role
include "../Classes/users.php";
include "../Classes/database.php";
include "../Classes/brands.php";
include "../Classes/sessions.php";
include "../Classes/themes.php";
include "../Classes/sets.php";

$session = Session::findActiveSession();
if ($session == null) {
  header("location:index.php");
  exit;
}
$user = User::findById($session->userId);
if ($user->role != "admin") {
    header("Location:adminWorkerPage.php?message=permission denied");
    exit;
}

$sets = Set::findAll();

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
           <table border='1'>
           <thead>
               <th>Products</th>
               <th>Name</th>
               <th>Price</th>
               <th></th>
           </thead>
           <tbody>
               <?php

                foreach ($sets as $set) { 
                    $brand = Brand::findById($set->brandId)
                    ?>
                   <tr>
                       <td><img src="images/logos/<?= $brand->logo; ?>" width="75px"></td>
                       <td><?= $set->name ?></td>
                       <td><?= $set->price ?></td>
                       <td><a href="edit.php?id=<?= $set->id ?>">Edit Product</a></td>
                       <td><a href="delete.php?id=<?= $set->id ?>">delete Product</a></td>
                   </tr>
               <?php } ?>
           </tbody>
       </table>
</body>
</html>