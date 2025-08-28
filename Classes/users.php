<?php

class User
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $username;
    public string $password;
    public string $role;

    public static function findByUsernameAndPassword($username, $password) //this function returns a single user based on the username and password that is passed through the parameters
    {
        $conn = new Database();
        $conn->start();

        $username = mysqli_real_escape_string($conn->connection, $username);
        $password = mysqli_real_escape_string($conn->connection, $password);

        $sql = "SELECT * FROM users WHERE user_username = '$username' AND user_password = '$password'";
        $result = $conn->connection->query($sql);

        $user = null;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user = new User();
                $user->id = $row['user_id'];
                $user->firstname = $row['user_firstname'];
                $user->lastname = $row['user_lastname'];
                $user->email = $row['user_email'];
                $user->username = $row['user_username'];
                $user->password = $row['user_password'];
                $user->role = $row['user_role'];
            }
        }

        $conn->close();

        return $user;
    }

    public function login() //logs the current user in by making a new session then placing the session key inside a cookie
    {
        include "session.php";

        $key = md5(uniqid(rand(), true));

        $session = new Session();
        $session->userId = $this->id;
        $session->key = $key;
        $session->start = date("Y-m-d H:i:s");
        $session->end = date("Y-m-d H:i:s", strtotime("+1 month"));
        $session->insert();

        setcookie("speelhuys-session-key", $key, strtotime("+1 month"), "/");
    }

}

?>