<?php

class Brand
{
    public int $id;
    public string $name;
    public string $logo;

    public static function findById($id) //finds a product's brand and returns it if found
    {
        $conn = new Database();
        $conn->start();

        $id = mysqli_real_escape_string($conn->connection, $id);

        $sql = "SELECT * FROM brands WHERE brand_id = '$id'";
        $result = $conn->connection->query($sql);

        $brand = null;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $brand = new Brand();
                $brand->id = $row['brand_id'];
                $brand->name = $row['brand_name'];
                $brand->logo = $row['brand_logo'];
            }
        }

        $conn->close();

        return $brand;
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