<?php

namespace App\Repository;

use App\Core\Database;
use App\Model\User;

class UserRepository
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM user");
        $query->execute();

        return $query->fetchAll();
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch();
        return $user ?: null;
    }
}
