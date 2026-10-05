<?php   
class User {
    private int $id;
    public string $username;
    public string $password;

    public function __construct(int $id, string $username, string $password) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }
}
?>