<?php

class Set
{
    public int $id;
    public string $name;
    public string $description;
    public int $brandId;
    public int $themeId;
    public string $image;
    public float $price;
    public int $age;
    public int $pieces;
    public int $stock;

    public static function findById($id) //finds a product and returns it if found
    {
        $conn = new Database();
        $conn->start();

        $id = mysqli_real_escape_string($conn->connection, $id);

        $sql = "SELECT * FROM sets WHERE set_id = '$id'";
        $result = $conn->connection->query($sql);

        $set = null;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $set = new Set();
                $set->id = $row['set_id'];
                $set->name = $row['set_name'];
                $set->description = $row['set_description'];
                $set->brandId = $row['set_brand_id'];
                $set->image = $row['set_image'];
                $set->price = $row['set_price'];
                $set->age = $row['set_age'];
                $set->pieces = $row['set_pieces'];
                $set->stock = $row['set_stock'];                if ($row['set_theme_id'] != null) {
                    $set->themeId = $row['set_theme_id'];
                } else {
                    $set->themeId = 0;
                }
            }
        }

        $conn->close();

        return $set;
    }

    public static function findAll() //returns every product in the form of an array
    {
        $conn = new Database();
        $conn->start();

        $sql = "SELECT * FROM sets";
        $result = $conn->connection->query($sql);

        $sets = [];


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $set = new Set();
                $set->id = $row['set_id'];
                $set->name = $row['set_name'];
                $set->description = $row['set_description'];
                $set->brandId = $row['set_brand_id'];
                $set->image = $row['set_image'];
                $set->price = $row['set_price'];
                $set->age = $row['set_age'];
                $set->pieces = $row['set_pieces'];
                $set->stock = $row['set_stock'];
                if ($row['set_theme_id'] != null) {
                    $set->themeId = $row['set_theme_id'];
                } else {
                    $set->themeId = 0;
                }
                $sets[] = $set;
            }
        }

        $conn->close();

        return $sets;
    }

    public function update() //updates an existing set
    {
        $conn = new Database();
        $conn->start();

        $id = mysqli_real_escape_string($conn->connection, $this->id);
        $name = mysqli_real_escape_string($conn->connection, $this->name);
        $description = mysqli_real_escape_string($conn->connection, $this->description);
        $brandId = mysqli_real_escape_string($conn->connection, $this->brandId);
        $themeId = mysqli_real_escape_string($conn->connection, $this->themeId);
        $image = mysqli_real_escape_string($conn->connection, $this->image);
        $price = mysqli_real_escape_string($conn->connection, $this->price);
        $age = mysqli_real_escape_string($conn->connection, $this->age);
        $pieces = mysqli_real_escape_string($conn->connection, $this->pieces);
        $stock = mysqli_real_escape_string($conn->connection, $this->stock);

        $sql = "
        UPDATE
            sets
        SET
            set_name = '" . $name . "',
            set_description = '" . $description . "',
            set_brandId = '" . $brandId . "',
            set_themeId = '" . $themeId . "',
            set_image = '" . $image . "',
            set_price = '" . $price . "',
            set_age = '" . $age . "',
            set_pieces = '" . $pieces . "',
            set_stock = '" . $stock . "',
        WHERE
            set_id = " . $id . "
        ";

        $conn->connection->query($sql);

        $conn->close();
    }

    public function insert() //inserts a new set
    {
        $conn = new Database();
        $conn->start();

        $name = mysqli_real_escape_string($conn->connection, $this->name);
        $description = mysqli_real_escape_string($conn->connection, $this->description);
        $brandId = mysqli_real_escape_string($conn->connection, $this->brandId);
        $themeId = mysqli_real_escape_string($conn->connection, $this->themeId);
        $image = mysqli_real_escape_string($conn->connection, $this->image);
        $price = mysqli_real_escape_string($conn->connection, $this->price);
        $age = mysqli_real_escape_string($conn->connection, $this->age);
        $pieces = mysqli_real_escape_string($conn->connection, $this->pieces);
        $stock = mysqli_real_escape_string($conn->connection, $this->stock);

        $sql = "
        INSERT INTO
            sets (
                set_name,
                set_description,
                set_brandId,
                set_themeId,
                set_image,
                set_price,
                set_age,
                set_pieces,
                set_stock
        ) VALUES (
            '" . $name . "',
            '" . $description . "',
            '" . $brandId . "',
            '" . $themeId . "',
            '" . $image . "',
            '" . $price . "',
            '" . $age . "',
            '" . $pieces . "',
            '" . $stock . "'
        )"; // Kan je hier een uitleg geven Ryan??
        //dit is gewoon de insert functie die we in eerdere projecten hebben gebruikt om een nieuw object toe te voegen aan de database

        $conn->connection->query($sql);

        $conn->close();
    }

    public function delete() //deletes an existing set
    {
        $conn = new Database();
        $conn->start();

        $id = mysqli_real_escape_string($conn->connection, $this->id);

        $sql = "DELETE FROM sets WHERE set_id = $id";
        $conn->connection->query($sql);

        $conn->close();
    }
}

?>