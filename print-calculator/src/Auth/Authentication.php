<?php

namespace Auth;

use Utils\Database;

class Authentication
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            return true;
        }

        return false;
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['user_id']);
    }

    public function getUserRole()
    {
        return $_SESSION['role'] ?? null;
    }

    public function register($username, $password, $role)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }
}