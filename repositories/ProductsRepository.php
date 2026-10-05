<?php

class ProductsRepository {

    public function getAllProducts(): array {
        global $db;
        $query = "SELECT * FROM products";
        $result = $db->query($query);
        $products = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $products[] = new Product((int)$row['id'], $row['name'], (float)$row['price'], (int)$row['stock']);
            }
        }

        return $products;
    }
    
    public function getProductById($id): ?Product {
        global $db;
        $query = "SELECT * FROM products WHERE id = $id";
        $result = $db->query($query);

        if ($result && $row = $result->fetch_assoc()) {
            return new Product((int)$row['id'], $row['name'], (float)$row['price'], (int)$row['stock']);
        } else {
            return null;
        }
    }

    public function updateStock(int $product_id, int $quantity): void {
        global $db;
        $query = "UPDATE products SET stock = stock - $quantity WHERE id = $product_id";
        $db->query($query);
    }
    
}

?>