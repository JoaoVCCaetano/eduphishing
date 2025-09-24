<?php
namespace App\Controllers;

class FormController {
    public function index() {
        // Verifica se o usuário está logado e com email verificado
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['verified'])) {
            $_SESSION['message'] = [
                'title' => 'Acesso Negado',
                'text' => 'Você precisa estar logado e com email verificado para acessar esta página.'
            ];
            header('Location: /');
            exit;
        }

        // Se chegou aqui, está logado e verificado
        include __DIR__ . '/../Views/form.php';
    }
}