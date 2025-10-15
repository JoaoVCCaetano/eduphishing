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
        $usuarioModel = new User($db);
        $usuario = $usuarioModel->get($_POST['user'], $_POST['pass']);

        if ($usuario) {
            // Verifica se o email está confirmado
            if (!isset($usuario['email_verified'])) {
                $message = [
                    'title' => 'Confirme seu e-mail',
                    'text' => 'Você precisa confirmar seu e-mail para realizar o login.'
                ];
            } else {
                $_SESSION['userId'] = $usuario['id'];
                $message = [
                    'title' => 'Login realizado',
                    'text' => 'Login efetuado com sucesso!'
                ];
                
            }

            $_SESSION['fecharModal'] = true;
            
            if ($message) {
                $_SESSION['message'] = $message;
            } 

            header('Location: /');
            exit;
        } else {
            $_SESSION['login_error'] = 'Usuário ou senha inválidos';
            header('Location: /login');
            exit;
        }
    }
}
