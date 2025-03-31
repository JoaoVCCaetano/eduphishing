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
                'region'  => 'us-east-1',
                'credentials' => [
                    'key'    => 'SEU_ACCESS_KEY',
                    'secret' => 'SEU_SECRET_KEY',
                ],
            ]);

            $senderEmail = 'seu-email@dominio.com';
            $subject = 'Teste de E-mail AWS SES';
            $bodyText = 'Este é um e-mail de teste enviado via AWS SES.';
            $bodyHtml = '<h1>Teste de E-mail</h1><p>Este é um e-mail de teste enviado via AWS SES.</p>';

        

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

            exit ("Erro ao enviar e-mail: " . $e->getMessage());

        }

        $_SESSION['message']['title'] = 'Email enviado';
        $_SESSION['message']['text'] = 'Email disparado com sucesso para '.$_POST['email'];

        include __DIR__ . '/../Views/index.php';

    }


}
