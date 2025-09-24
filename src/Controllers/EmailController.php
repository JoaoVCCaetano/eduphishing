<?php

namespace App\Controllers;

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;
use Exception;

class EmailController {

    public function send() {

        try {

            $sesClient = new SesClient([
                'version' => '2010-12-01',
                'region'  => getenv('AWS_REGION'),
                'credentials' => [
                    'key'    => getenv('AWS_ACCESS_KEY_ID'),
                    'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
                ],
            ]); 

            $senderEmail = getenv('AWS_SOURCE_EMAIL');
            if (!$senderEmail) {
                throw new Exception('AWS_SOURCE_EMAIL não definido');
            }

            $emailTemplates = [
                'Netflix' => __DIR__ . '/../Views/emails/netflix.html',
                'Facebook' => __DIR__ . '/../Views/emails/facebook.html',
                'Instagram' => __DIR__ . '/../Views/emails/instagram.html',
            ];

            $instagramLogo = __DIR__ . '/../../public/images/logo-carregamento.png';

            if ($_POST['opcao-select'] == 'Netflix') {
                $subject = 'Problemas com sua conta Netflix';
                $bodyHtml = file_get_contents($emailTemplates['Netflix']);
                $bodyText = '';
            }elseif ($_POST['opcao-select'] == 'Facebook') {
                $subject = 'Problemas com sua conta Facebook';
                $bodyHtml = file_get_contents($emailTemplates['Facebook']);
                $bodyText = '';

            }elseif ($_POST['opcao-select'] == 'Instagram') {
                $subject = 'Problemas com sua conta Instagram';
                $bodyHtml = file_get_contents($emailTemplates['Instagram']);
                $bodyText = '';
            }
        

            $result = $sesClient->sendEmail([
                'Destination' => [
                    'ToAddresses' => [$_POST['email']],
                ],
                'Message' => [
                    'Body' => [
                        'Text' => [
                            'Charset' => 'UTF-8',
                            'Data' => $bodyText,
                        ],
                        'Html' => [
                            'Charset' => 'UTF-8',
                            'Data' => $bodyHtml,
                        ],
                    ],
                    'Subject' => [
                        'Charset' => 'UTF-8',
                        'Data' => $subject,
                    ],
                ],
                'Source' => $senderEmail,
            ]);

        } catch (Exception $e) {
            error_log("Erro ao enviar email: " . $e->getMessage());
            $_SESSION['message'] = [
                'title' => 'Erro ao enviar email',
                'text' => 'Ocorreu um erro ao tentar enviar o email. Por favor, tente novamente.',
                'icon' => 'error'
            ];
            header('Location: /form');
            exit;
        }

        // Atualiza o último envio
        $db = new \App\Database\Database('db');
        $usuario = new \App\Models\User($db);
        if (!$usuario->setDate()) {
            $_SESSION['message'] = [
                'title' => 'Aviso',
                'text' => 'Email enviado, mas não foi possível atualizar a data do último envio.',
                'icon' => 'warning'
            ];
            header('Location: /form');
            exit;
        }

        $_SESSION['message'] = [
            'title' => 'Email enviado',
            'text' => 'Email disparado com sucesso para ' . $_POST['email'],
            'icon' => 'success'
        ];
        
        header('Location: /form');
        exit;

    }


}
