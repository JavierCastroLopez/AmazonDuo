<?php

class UserRepository {

    public function getUserById($id) {
        global $db;
        $query = "SELECT * FROM users WHERE id = $id";
        $result = $db->query($query);

        if ($result && $row = $result->fetch_assoc()) {
            return new User((int)$row['id'], $row['username']);
        } else {
            return null;
        }
    }

}
