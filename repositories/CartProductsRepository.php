<?php

class CartProductsRepository {

    public function addProductToCart(int $cart_id, int $product_id, int $quantity = 1): void {
        global $db;
        // Si el producto ya está en el carrito, se suma la cantidad
        $query = "INSERT INTO cart_products (cart_id, product_id, quantity) 
                  VALUES ($cart_id, $product_id, $quantity)
                  ON DUPLICATE KEY UPDATE quantity = quantity + $quantity";
        $db->query($query);
    }

    public function removeProductFromCart(int $cart_id, int $product_id): void {
        global $db;
        $query = "DELETE FROM cart_products WHERE cart_id = $cart_id AND product_id = $product_id";
        $db->query($query);
    }

    public function getProductsByCartId(int $cart_id): array {
        global $db;
        $query = "SELECT * FROM cart_products WHERE cart_id = $cart_id";
        $result = $db->query($query);
        $cartProducts = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $cartProducts[] = new CartProduct((int)$row['cart_id'], (int)$row['product_id'], (int)$row['quantity']);
            }
        }

        return $cartProducts;
    }
    
    // Método extra para vaciar el carrito entero de una vez (útil tras comprar)
    public function clearCart(int $cart_id): void {
        global $db;
        $query = "DELETE FROM cart_products WHERE cart_id = $cart_id";
        $db->query($query);
    }
}
?>
