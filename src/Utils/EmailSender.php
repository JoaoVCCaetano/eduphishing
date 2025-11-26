<?php
namespace App\Utils;

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

class EmailSender {
    private $sesClient;
    private $sourceEmail;

    public function __construct() {
        $this->sesClient = new SesClient([
            'version' => 'latest',
            'region'  => getenv('AWS_REGION'),
            'credentials' => [
                'key'    => getenv('AWS_ACCESS_KEY_ID'),
                'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $this->sourceEmail = getenv('AWS_SOURCE_EMAIL');
        if (!$this->sourceEmail) {
            throw new \Exception('AWS_SOURCE_EMAIL não definido');
        }
    }

    public static function sendVerification($to, $token) {
        try {
            $emailSender = new self();
            $subject = 'Confirme seu e-mail';
            $body = 'Clique no link para confirmar seu e-mail: ' . getenv('APP_URL') . '/verify-email?token=' . $token;
            
            return $emailSender->sendEmail($to, $subject, $body);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function sendPasswordResetEmail($to, $resetLink) {
        $subject = 'Redefinição de Senha - EduPhishing';
        
        $bodyHtml = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            line-height: 1.6; 
            color: #333; 
            background: #f4f4f4; 
            padding: 20px;
        }

        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background: #fff; 
            border-radius: 10px; 
            overflow: hidden; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .header { 
            background: #e67c1c; 
            color: white; 
            padding: 28px; 
            text-align: center; 
            font-size: 22px; 
            font-weight: bold;
        }

        .content { 
            padding: 30px; 
        }

        .button { 
            display: inline-block; 
            padding: 14px 26px; 
            background: #e67c1c; 
            color: white; 
            text-decoration: none; 
            border-radius: 5px; 
            font-weight: bold; 
            font-size: 16px; 
            transition: background .2s; 
        }

        .button:hover { 
            background: #d35400; 
        }

        .warning { 
            background: #fff3cd; 
            border-left: 4px solid #e67c1c; 
            padding: 15px; 
            margin: 20px 0; 
            border-radius: 4px;
        }

        .footer { 
            text-align: center; 
            margin-top: 20px; 
            padding: 20px; 
            font-size: 12px; 
            color: #666; 
        }

        .link-box {
            word-break: break-all; 
            background: #fafafa; 
            padding: 12px; 
            border: 1px solid #ddd; 
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="header">Redefinição de Senha</div>

        <div class="content">
            <p>Olá,</p>

            <p>Recebemos uma solicitação para redefinir a senha da sua conta no <strong>EduPhishing</strong>.</p>

            <p>Para criar uma nova senha, clique no botão abaixo:</p>

            <p style="text-align:center;">
                <a href="' . $resetLink . '" class="button">Redefinir Minha Senha</a>
            </p>

            <p>Ou copie e cole este link no seu navegador:</p>

            <div class="link-box">' . $resetLink . '</div>

            <div class="warning">
                <strong>⚠️ Importante:</strong> Este link expira em 1 hora e só pode ser usado uma vez.
            </div>

            <p><strong>Não solicitou esta redefinição?</strong><br>
            Basta ignorar este e-mail. Sua senha permanecerá a mesma.</p>
        </div>

        <div class="footer">
            <p>EduPhishing - Plataforma Educacional de Conscientização sobre Phishing</p>
            <p>E-mail automático — não responda.</p>
        </div>

    </div>

</body>
</html>';


        $bodyText = "Redefinição de Senha - EduPhishing\n\n" .
                    "Recebemos uma solicitação para redefinir a senha da sua conta.\n\n" .
                    "Para criar uma nova senha, acesse o link abaixo:\n" .
                    $resetLink . "\n\n" .
                    "Este link expira em 1 hora e só pode ser usado uma vez.\n\n" .
                    "Se você não solicitou esta redefinição, ignore este e-mail.";

        return $this->sendEmail($to, $subject, $bodyText, $bodyHtml);
    }

    public function sendEmail($to, $subject, $bodyText, $bodyHtml = null) {
        try {
            $params = [
                'Source' => $this->sourceEmail,
                'Destination' => [
                    'ToAddresses' => [$to],
                ],
                'Message' => [
                    'Subject' => [
                        'Data' => $subject,
                        'Charset' => 'UTF-8',
                    ],
                    'Body' => [
                        'Text' => [
                            'Data' => $bodyText,
                            'Charset' => 'UTF-8',
                        ],
                    ],
                ],
            ];

            if ($bodyHtml) {
                $params['Message']['Body']['Html'] = [
                    'Data' => $bodyHtml,
                    'Charset' => 'UTF-8',
                ];
            }

            $result = $this->sesClient->sendEmail($params);
            return true;
        } catch (AwsException $e) {
            throw $e;
        }
    }
}
