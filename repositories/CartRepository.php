<?php

class CartRepository {

    public function createCart(int $user_id): int {
        global $db;
        $query = "INSERT INTO carts (user_id) VALUES ($user_id)";
        $db->query($query);
        return $db->insert_id;
    }

    public function getCartById(int $id): ?Cart {
        global $db;
        $query = "SELECT * FROM carts WHERE id = $id";
        $result = $db->query($query);

        if ($result && $row = $result->fetch_assoc()) {
            return new Cart((int)$row['id'], (int)$row['user_id'], $row['date']);
        } else {
            return null;
        }
    }

    public function getCartsByUserId(int $user_id): array {
        global $db;
        $query = "SELECT * FROM carts WHERE user_id = $user_id ORDER BY date DESC";
        $result = $db->query($query);
        $carts = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $carts[] = new Cart((int)$row['id'], (int)$row['user_id'], $row['date']);
            }
        }

        return $carts;
    }
}
?>
