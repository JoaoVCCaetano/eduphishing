<?php

namespace App\Controllers;

use DateTime;
use App\Database\Database;

class IndexController {

    public function index() {
        include __DIR__ . '/../Views/index.php';
    }

    public function form(){
        if (!isset($_SESSION['userId'])) {
            $_SESSION['message'] = [
                'title' => 'Acesso restrito',
                'text' => 'Faça login para acessar o envio de e-mail.'
            ];
            header('Location: /');
            exit;
        }

        $db = new Database('db');
        $pdo = $db->connect();
        $stmt = $pdo->prepare('SELECT email_verified, dateTimeSendEmail FROM user WHERE id = ?');
        $stmt->execute([$_SESSION['userId']]);
        $user = $stmt->fetch();

        if (!$user || !$user['email_verified']) {
            $_SESSION['message'] = [
                'title' => 'Aguardando confirmação',
                'text' => 'Confirme seu e-mail para liberar o envio.'
            ];
            header('Location: /');
            exit;
        }

        // 4. Verificação de data: Limite de 24 horas
        if (!empty($user['dateTimeSendEmail'])) {
            $ultimaDataEnvio = new DateTime($user['dateTimeSendEmail']);
            $dataAtual = new DateTime();
            $diferenca = $dataAtual->diff($ultimaDataEnvio);
            $diferencaEmHoras = $diferenca->h + ($diferenca->days * 24);

            if ($diferencaEmHoras < 24) {
                $horasRestantes = 24 - $diferencaEmHoras;
                $_SESSION['message'] = [
                    'title' => 'Envio limitado',
                    'text' => "Aguarde $horasRestantes horas para enviar o próximo e-mail."
                ];
                header('Location: /');
                exit;
            }
        }
        
        // 5. Se todas as validações passarem, exibe o formulário
        include __DIR__ . '/../Views/form.php';
    }
}