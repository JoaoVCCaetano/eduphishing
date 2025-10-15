<?php

namespace App\Controllers;
use App\Models\User;

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
        $user = new User($db);
        $user = $user->getById($_SESSION['userId']);

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
                $_SESSION['fecharModal'] = true;
                header('Location: /');
                exit;
            }
        }
        
        // 5. Se todas as validações passarem, exibe o formulário
        include __DIR__ . '/../Views/form.php';
    }
}