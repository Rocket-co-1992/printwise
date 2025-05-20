<?php

namespace App\Controllers;

use App\Auth\Authentication;
use App\Models\User;

class AuthController
{
    private $auth;

    public function __construct()
    {
        $this->auth = new Authentication();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->auth->login($username, $password)) {
                header('Location: /dashboard');
                exit;
            } else {
                $error = 'Invalid username or password.';
                // Render login view with error
                echo $this->render('auth/login.twig', ['error' => $error]);
            }
        } else {
            // Render login view
            echo $this->render('auth/login.twig');
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'operator'; // Default role

            $user = new User();
            if ($user->create($username, $password, $role)) {
                header('Location: /login');
                exit;
            } else {
                $error = 'Registration failed. Please try again.';
                // Render registration view with error
                echo $this->render('auth/register.twig', ['error' => $error]);
            }
        } else {
            // Render registration view
            echo $this->render('auth/register.twig');
        }
    }

    public function logout()
    {
        $this->auth->logout();
        header('Location: /login');
        exit;
    }

    private function render($template, $data = [])
    {
        // Assuming Twig is set up and available
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $twig = new \Twig\Environment($loader);
        return $twig->render($template, $data);
    }
}