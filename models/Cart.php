<?php   
class Cart {
    private int $id;
    public int $user_id;
    public $date;

    public function __construct(int $id, int $user_id, $date) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->date = $date;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->user_id;
    }
    
    public function getDate(): DateTime {
        return $this->date;
    }
}
?>