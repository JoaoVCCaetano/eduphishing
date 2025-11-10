<?php

namespace App\Controllers;

use App\Models\User;
use App\Database\Database;
use App\Utils\EmailSender;

class RegisterController {

    public function form() {
        include __DIR__ . '/../Views/register.php';
    }

    public function register() {
        $db = new Database('db');
        $usuario = new User($db);
        $token = $usuario->add($_POST['email'], $_POST['pass']);
        $message = null; // Initialize message variable
        if ($token === 'duplicate') {
            $message = [
                'title' => 'E-mail já cadastrado',
                'text' => 'Este e-mail já está registrado. Faça login ou utilize outro e-mail.'
            ];
        } elseif ($token) {
            EmailSender::sendVerification($_POST['email'], $token);
            $message = [
                'title' => 'Verifique seu e-mail',
                'text' => 'Enviamos um link de confirmação para seu e-mail. Confirme para liberar o envio.'
            ];
            $_SESSION['fecharModal'] = true;
        }
        //if ($message) $_SESSION['message'] = $message;
        header('Location: /');
        exit;
    }
}
