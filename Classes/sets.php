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

    public static function findById($id)
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
                $set->stock = $row['set_stock'];
                $set->themeId = $row['set_theme_id'] ?? 0;
            }
        }

        $conn->close();

        return $set;
    }

    public static function findAll()
    {
        $conn = new Database();
        $conn->start();

        $result = $conn->connection->query("SELECT * FROM sets WHERE set_deleted = 0");
        $sql = "SELECT * FROM sets WHERE deleted = 0";

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
                $set->themeId = $row['set_theme_id'] ?? 0;
                $sets[] = $set;
            }
        }

        $conn->close();

        return $sets;
    }
    public static function findDeleted()
    {
        $conn = new Database();
        $conn->start();

        $result = $conn->connection->query("SELECT * FROM sets WHERE set_deleted = 1");

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
                $set->themeId = $row['set_theme_id'] ?? 0;
                $sets[] = $set;
            }
        }

        $conn->close();

        return $sets;
    }
public function restore()
{
    $conn = new Database();
    $conn->start();

    $id = mysqli_real_escape_string($conn->connection, $this->id);

    $sql = "UPDATE sets SET set_deleted = 0 WHERE set_id = $id";
    $conn->connection->query($sql);

    $conn->close();
}

    // Toegevoegde filter-methode
    public static function filter($filters)
    {
        $conn = new Database();
        $conn->start();

        $sql = "SELECT * FROM sets WHERE 1=1";
        $params = [];

        if (!empty($filters['brand'])) {
            $brandId = mysqli_real_escape_string($conn->connection, $filters['brand']);
            $sql .= " AND set_brand_id = '$brandId'";
        }
        if (!empty($filters['theme'])) {
            $themeId = mysqli_real_escape_string($conn->connection, $filters['theme']);
            $sql .= " AND set_theme_id = '$themeId'";
        }
        if (!empty($filters['age'])) {
            $age = mysqli_real_escape_string($conn->connection, $filters['age']);
            $sql .= " AND set_age >= '$age'";
        }
        if (!empty($filters['pieces'])) {
            $pieces = mysqli_real_escape_string($conn->connection, $filters['pieces']);
            $sql .= " AND set_pieces >= '$pieces'";
        }
        if (!empty($filters['price'])) {
            $price = mysqli_real_escape_string($conn->connection, $filters['price']);
            $sql .= " AND set_price <= '$price'";
        }

        $result = $conn->connection->query($sql);

        $sets = [];

        if ($result && $result->num_rows > 0) {
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
                $set->themeId = $row['set_theme_id'] ?? 0;
                $sets[] = $set;
            }
        }

        $conn->close();

        return $sets;
    }

    public function save()
    {
        if (isset($this->id) && $this->id > 0) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function update()
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
            set_brand_id = '" . $brandId . "',
            set_theme_id = '" . $themeId . "',
            set_image = '" . $image . "',
            set_price = '" . $price . "',
            set_age = '" . $age . "',
            set_pieces = '" . $pieces . "',
            set_stock = '" . $stock . "'
        WHERE
            set_id = " . $id . "
        ";

        $conn->connection->query($sql);

        $conn->close();
    }

    public function insert()
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
                set_brand_id,
                set_theme_id,
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
        )";

        $conn->connection->query($sql);

        $conn->close();
    }

    
public function delete()
{
    $conn = new Database();
    $conn->start();

    $id = mysqli_real_escape_string($conn->connection, $this->id);

    $sql = "UPDATE sets SET set_deleted = 1 WHERE set_id = $id";
    $conn->connection->query($sql);

    $conn->close();
}
}

?>