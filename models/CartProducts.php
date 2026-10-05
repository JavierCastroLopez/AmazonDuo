<?php   
class CartProduct {
    private int $id;
    public int $cart_id;
    public int $product_id;
    public int $cantidad;

    public function __construct(int $cart_id, int $product_id, int $cantidad) {
        $this->cart_id = $cart_id;
        $this->product_id = $product_id;
        $this->cantidad = $cantidad;
    }

    public function getCartId(): int {
        return $this->cart_id;
    }

    public function getProductId(): int {
        return $this->product_id;
    }

    public function getCantidad(): int {
        return $this->cantidad;
    }
}