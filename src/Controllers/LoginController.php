<?php

namespace App\Controllers;

class LoginController {
    public function showLoginForm() {
        include __DIR__ . '/../Views/login.php';
    }

    public function authenticate() {
        $user = $_POST['user'] ?? '';
        $pass = $_POST['pass'] ?? '';
        if ($user === 'be' && $pass === 'be') {
            $_SESSION['user'] = $user;
            header('Location: /');
            exit;
        } else {
            $_SESSION['login_error'] = 'Usuário ou senha inválidos';
            header('Location: /login');
            exit;
        }
    }
}
