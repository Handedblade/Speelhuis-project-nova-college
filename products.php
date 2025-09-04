   <?php

    include "Classes/database.php";
    include "Classes/sets.php";
    include "Classes/brands.php";
    include "Classes/themes.php";

    $sets = Set::findAll();

    ?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="css/index.css">
       <title>Speel Huis</title>
   </head>

   <body>

       <nav class="navbar" aria-label="Main navigation">
           <a href="index.php">Speel Huis</a>
           <a href="products.php">Products</a>
           <a href="contact.php">Contact</a>
           <a href="Admin/index.php">Login</a>
       </nav>
       <?php
        if (isset($_GET['message'])) { ?>
            <b id="message"><?= $_GET['message'] ?></b>
        <?php } ?>

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
                       <td><a href="detail.php?id=<?= $set->id ?>">View Product</a></td>
                   </tr>
               <?php } ?>
           </tbody>
       </table>
   </body>

   </html>