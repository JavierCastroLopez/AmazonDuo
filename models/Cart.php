<?php   
class Cart {
    private int $id;
    public int $user_id;
    public $fecha_compra;

    public function __construct(int $id, int $user_id, $fecha_compra) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->fecha_compra = $fecha_compra;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->user_id;
    }
    
    public function getFechaCompra(): DateTime {
        return $this->fecha_compra;
    }
}
?>