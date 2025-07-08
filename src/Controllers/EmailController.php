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
                'region'  => 'us-east-2',
                'credentials' => [
                    'key'    => $_ENV['AWS_ACCESS_KEY_ID'],
                    'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
                ],
            ]);

            $senderEmail = 'bernardoniehues01@gmail.com';

            $emailTemplates = [
                'Netflix' => __DIR__ . '/../../public/emails/netflix.html',
                'Facebook' => __DIR__ . '/../../public/emails/facebook.html',
                'Instagram' => __DIR__ . '/../../public/emails/instagram.html',
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

            exit ("Erro ao enviar e-mail: " . $e->getMessage());

        }

        $_SESSION['message']['title'] = 'Email enviado';
        $_SESSION['message']['text'] = 'Email disparado com sucesso para '.$_POST['email'];

        include __DIR__ . '/../Views/index.php';

    }


}
