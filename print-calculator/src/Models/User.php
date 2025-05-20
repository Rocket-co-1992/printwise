<?php

namespace App\Models;

use App\Utils\Database;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function createUser($data)
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $stmt->bindParam(':role', $data['role']);
        return $stmt->execute();
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateUser($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id");
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }
}