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
            $_SESSION['userId'] = $usuario;
            // Verifica se o email está confirmado
            if (isset($usuario['email_verified']) && !$usuario['email_verified']) {
                $msgTitle = 'Confirme seu e-mail';
                $msgText = 'Você precisa confirmar seu e-mail antes de acessar o formulário.';
                $msgIcon = 'info';
                $redirect = '/';
            } else {
                $msgTitle = 'Login realizado';
                $msgText = 'Login efetuado com sucesso!';
                $msgIcon = 'success';
                $redirect = '/form';
            }
            // Se for requisição AJAX/modal, exibe mensagem e fecha modal
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) || (isset($_SERVER['HTTP_SEC_FETCH_MODE']) && $_SERVER['HTTP_SEC_FETCH_MODE'] === 'iframe')) {
                echo '<script>window.parent.Fancybox.close(); window.parent.Swal.fire({title: "'.$msgTitle.'", text: "'.$msgText.'", icon: "'.$msgIcon.'", confirmButtonText: "OK"}).then(() => { window.parent.location.href = "'.$redirect.'"; });</script>';
                exit;
            }
            header('Location: '.$redirect);
            exit;
        } else {
            $_SESSION['login_error'] = 'Usuário ou senha inválidos';
            header('Location: /login');
            exit;
        }
    }
}
