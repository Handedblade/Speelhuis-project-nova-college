<?php

//this page should only be accessed by logged in users with the "employee" role
include "../Classes/users.php";
include "../Classes/database.php";
include "../Classes/brands.php";
include "../Classes/sessions.php";
include "../Classes/themes.php";
include "../Classes/sets.php";

$sets = Set::findAll();
$session = Session::findActiveSession();
if ($session == null) {
  header("location:index.php");
  exit;
}
$user = User::findById($session->userId);
if ($user->role == "admin" || $user->role == "owner") {
    header("Location:adminOwnerPage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/adminWorker.css">
    <title>Admin Worker Page</title>
    <h1>Admin Worker Page</h1>  
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
                       <td><img src="../images/logos/<?= $brand->logo; ?>" width="75px"></td>
                       <td><?= $set->name ?></td>
                       <td><?= $set->price ?></td>
                       <td><a href="edit.php?id=<?= $set->id ?>">edit Product</a></td>
                   </tr>
               <?php } ?>
           </tbody>
       </table>
</head>
</html>