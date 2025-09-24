<?php
namespace App\Controllers;

use App\Database\Database;
use App\Models\User;

class VerifyEmailController {
    public function verify() {
        $token = $_GET['token'] ?? '';
        if (!$token) {
            $_SESSION['message'] = [
                'title' => 'Token inválido',
                'text' => 'O link de verificação está incorreto ou expirado.'
            ];
            header('Location: /');
            exit;
        }

        $db = new Database('db');
        $usuario = new User($db);
        $result = $usuario->verifyEmail($token);

        if ($result) {
            // Loga o usuário após verificar o email
            $_SESSION['user_id'] = $result;
            $_SESSION['verified'] = true;
            
            $_SESSION['message'] = [
                'title' => 'Email confirmado',
                'text' => 'Seu email foi confirmado com sucesso!'
            ];
            header('Location: /form');
            exit;
        }

        $_SESSION['message'] = [
            'title' => 'Erro',
            'text' => 'Token inválido ou expirado.'
        ];
        header('Location: /');
        exit;
    }
}
