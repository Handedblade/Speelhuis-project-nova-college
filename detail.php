<?php

include "Classes/database.php";
include "Classes/sets.php";
include "Classes/brands.php";
include "Classes/themes.php";

if (isset($_GET['id'])) {
    $set = Set::findById($_GET['id']);
    if (is_null($set)) {
        header("location:products.php?message=product not found");
    }
    $brand = Brand::findById($set->brandId);
    if ($set->themeId != 0) {
        $theme = Theme::findById($set->themeId);
    }
} else {
    header("location:products.php?message=product not found");
}
