<?php
namespace App\Model;

class User {
    const DBTYPES = [
        "id" => "id",
        "username" => "varchar(255)",
        "password" => "varchar(255)",
        "role" => "varchar(255)",
    ];
    private ?int $id = null;
    private ?string $username = null;
    private ?string $password = null;
    private ?string $role = null;

    
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    public function getUsername(): ?string
    {
        return $this->username;
    }
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }


    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function setPassword(?string $password): void
    {
        $conf = json_decode(file_get_contents(__DIR__ . '/../../conf/hashing.json'),true);
        $confUser = $conf["User"];

        $hashed = password_hash($password, constant($confUser["algorithm"]), [
            "cost" => constant($confUser["cost"]),
        ]);
        $this->password = $hashed;
    }


    public function getRole(): ?string
    {
        return $this->role;
    }
    public function getRoles(): array
    {
        $conf = json_decode(file_get_contents(__DIR__ . '/../../conf/roles_hierarchy.json'),true);
        $current = $this->role;
        $roles = [$current];
        while (isset($conf[$current])) {
            $roles[] = $conf[$current];
            $current = $conf[$current];
        }
        return $roles;
    }
    public function setRole($role): void
    {
        $this->role = $role;
    }
}
