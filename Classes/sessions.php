<?php

class Session
{
    public int $id;
    public int $userId;
    public string $key;
    public string $start;
    public string $end;

    public function insert() //inserts a new session into the database for later reference
    {
        $conn = new Database();
        $conn->start();

        $sql = "INSERT INTO sessions (
            session_user_id,
            session_key,
            session_start,
            session_end
        ) VALUES (
            '" . $this->userId . "',
            '" . $this->key . "',
            '" . $this->start . "',
            '" . $this->end . "'
        )";

        $conn->connection->query($sql);

        $conn->close();
    }

    public static function findActiveSession() //returns an active session if one is found based on the current session cookie
    {
        $session = null;

        if (isset($_COOKIE["speelhuys-session-key"])) {

            $conn = new Database();
            $conn->start();

            $key = mysqli_real_escape_string($conn->connection, $_COOKIE["speelhuys-session-key"]);

            $query = "SELECT * FROM sessions WHERE session_key = '$key' AND session_end > '" . date("Y-m-d H:i:s") . "'";
            $resultaat = $conn->connection->query($query);

            if ($resultaat->num_rows > 0) {
                $rij = $resultaat->fetch_assoc();

                $session = new Session();
                $session->id = $rij['session_id'];
                $session->userId = $rij['session_user_id'];
                $session->key = $rij['session_key'];
                $session->start = $rij['session_start'];
                $session->end = $rij['session_end'];
            }

            $conn->close();
        }
        return $session;
    }
}

?>