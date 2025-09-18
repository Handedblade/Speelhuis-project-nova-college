<?php

class Theme
{
    public int $id;
    public string $name;

    public static function findById($id) //finds a product's theme and returns it if found
    {
        $conn = new Database();
        $conn->start();

        $id = mysqli_real_escape_string($conn->connection, $id);

        $sql = "SELECT * FROM themes WHERE theme_id = '$id'";
        $result = $conn->connection->query($sql);

        $theme = null;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $theme = new Brand();
                $theme->id = $row['theme_id'];
                $theme->name = $row['theme_name'];
            }
        }

        $conn->close();

        return $theme;
    }
    public static function findAll() {
    $conn = new Database();
    $conn->start();

    $sql = "SELECT * FROM brands";
    $result = $conn->connection->query($sql);

    $brands = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $brand = new Brand();
            $brand->id = $row['brand_id'];
            $brand->name = $row['brand_name'];
            $brand->logo = $row['brand_logo'] ?? '';
            $brands[] = $brand;
        }
    }

    $conn->close();
    return $brands;
}
}

?>