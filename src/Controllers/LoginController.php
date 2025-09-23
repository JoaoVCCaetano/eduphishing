<?php

namespace App\Controllers;

use App\Models\User;
use App\Database\Database;

class LoginController {

    public function form() {
        include __DIR__ . '/../Views/login.php';
    }

    public function authenticate() {

        $db = new Database('db');
        $usuario = new User($db);
        $usuario = $usuario->get($_POST['user'], $_POST['pass']);

        if ($usuario) {
            $_SESSION['userId'] = $usuario;
            header('Location: /');
            exit;
        } else {
            $_SESSION['login_error'] = 'Usuário ou senha inválidos';
            header('Location: /login');
            exit;
        }
    }
}
