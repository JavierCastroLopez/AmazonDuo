<?php   
class User {
    private int $id;
    public string $username;
    public function __construct(int $id, string $username) {
        $this->id = $id;
        $this->username = $username;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }
}
?>