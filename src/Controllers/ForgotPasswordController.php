<?php

namespace App\Controllers;

use App\Models\User;
use App\Database\Database;
use App\Utils\EmailSender;

class ForgotPasswordController {

    public function form() {
        include __DIR__ . '/../Views/forgot-password.php';
    }

    public function sendResetLink() {
        $email = $_POST['email'] ?? '';

        if (empty($email)) {
            $_SESSION['message'] = [
                'title' => 'Erro',
                'text' => 'Por favor, informe seu e-mail.',
                'icon' => 'error'
            ];
            header('Location: /forgot-password');
            exit;
        }

        $db = new Database('db');
        $userModel = new User($db);

        // Verifica se o usuário existe
        $user = $userModel->getByEmail($email);
        
        if (!$user) {
            // Por segurança, não informamos se o e-mail existe ou não
            $_SESSION['message'] = [
                'title' => 'E-mail Enviado',
                'text' => 'Se o e-mail informado estiver cadastrado, você receberá instruções para redefinir sua senha.',
                'icon' => 'success'
            ];
            header('Location: /login');
            exit;
        }

        // Gera token de reset
        $token = $userModel->generatePasswordResetToken($user['id']);

        if (!$token) {
            $_SESSION['message'] = [
                'title' => 'Erro',
                'text' => 'Ocorreu um erro ao processar sua solicitação. Tente novamente.',
                'icon' => 'error'
            ];
            header('Location: /forgot-password');
            exit;
        }

        // Envia e-mail com link de reset
        try {
            $resetLink = getenv('APP_URL') . "/reset-password?token=" . $token;
            $emailSender = new EmailSender();
            $emailSender->sendPasswordResetEmail($email, $resetLink);

            $_SESSION['message'] = [
                'title' => 'E-mail Enviado',
                'text' => 'Enviamos instruções para redefinir sua senha para o e-mail informado.',
                'icon' => 'success'
            ];
        } catch (\Exception $e) {
            error_log("Erro ao enviar e-mail de reset: " . $e->getMessage());
            $_SESSION['message'] = [
                'title' => 'Erro',
                'text' => 'Não foi possível enviar o e-mail. Tente novamente mais tarde.',
                'icon' => 'error'
            ];
        }

        header('Location: /login');
        exit;
    }

    public function showResetForm() {
        $token = $_GET['token'] ?? '';

        if (empty($token)) {
            $_SESSION['message'] = [
                'title' => 'Erro',
                'text' => 'Token inválido ou expirado.',
                'icon' => 'error'
            ];
            header('Location: /login');
            exit;
        }

        // Verifica se o token é válido
        $db = new Database('db');
        $userModel = new User($db);
        $user = $userModel->getUserByResetToken($token);

        if (!$user) {
            $_SESSION['message'] = [
                'title' => 'Erro',
                'text' => 'Token inválido ou expirado.',
                'icon' => 'error'
            ];
            header('Location: /login');
            exit;
        }

        include __DIR__ . '/../Views/reset-password.php';
    }

    public function resetPassword() {
        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (empty($token) || empty($password) || empty($confirmPassword)) {
            $_SESSION['message'] = [
                'title' => 'Erro',
                'text' => 'Todos os campos são obrigatórios.',
                'icon' => 'error'
            ];
            header('Location: /reset-password?token=' . $token);
            exit;
        }

        if ($password !== $confirmPassword) {
            $_SESSION['message'] = [
                'title' => 'Erro',
                'text' => 'As senhas não coincidem.',
                'icon' => 'error'
            ];
            header('Location: /reset-password?token=' . $token);
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['message'] = [
                'title' => 'Erro',
                'text' => 'A senha deve ter no mínimo 6 caracteres.',
                'icon' => 'error'
            ];
            header('Location: /reset-password?token=' . $token);
            exit;
        }

        $db = new Database('db');
        $userModel = new User($db);

        // Verifica se o token é válido
        $user = $userModel->getUserByResetToken($token);

        if (!$user) {
            $_SESSION['message'] = [
                'title' => 'Erro',
                'text' => 'Token inválido ou expirado.',
                'icon' => 'error'
            ];
            header('Location: /login');
            exit;
        }

        // Reseta a senha
        $result = $userModel->resetPassword($user['id'], $password);

        if ($result) {
            $_SESSION['message'] = [
                'title' => 'Sucesso',
                'text' => 'Sua senha foi redefinida com sucesso! Faça login com sua nova senha.',
                'icon' => 'success'
            ];
        } else {
            $_SESSION['message'] = [
                'title' => 'Erro',
                'text' => 'Ocorreu um erro ao redefinir sua senha. Tente novamente.',
                'icon' => 'error'
            ];
        }

        header('Location: /login');
        exit;
    }
}
