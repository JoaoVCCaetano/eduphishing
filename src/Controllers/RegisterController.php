<?php

namespace App\Controllers;

use App\Models\User;
use App\Database\Database;

class RegisterController {

    public function form() {
        include __DIR__ . '/../Views/register.php';
    }

    public function register() {

        $db = new Database('db');
        $usuario = new User($db);
        $usuario = $usuario->add($_POST['user'], $_POST['pass']);

        header('Location: /');
        exit;
    }
}
