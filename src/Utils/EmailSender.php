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
            error_log($e->getMessage());
            return false;
        }
    }

    public function sendPasswordResetEmail($to, $resetLink) {
        $subject = 'Redefinição de Senha - EduPhishing';
        
        $bodyHtml = '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
                .button { display: inline-block; padding: 15px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 20px 0; }
                .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
                .warning { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>🔐 Redefinição de Senha</h1>
                </div>
                <div class="content">
                    <p>Olá,</p>
                    <p>Recebemos uma solicitação para redefinir a senha da sua conta no <strong>EduPhishing</strong>.</p>
                    <p>Para criar uma nova senha, clique no botão abaixo:</p>
                    <div style="text-align: center;">
                        <a href="' . $resetLink . '" class="button">Redefinir Minha Senha</a>
                    </div>
                    <p>Ou copie e cole este link no seu navegador:</p>
                    <p style="word-break: break-all; background: #fff; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">' . $resetLink . '</p>
                    <div class="warning">
                        <strong>⚠️ Importante:</strong> Este link expira em 1 hora e só pode ser usado uma vez.
                    </div>
                    <p><strong>Não solicitou esta redefinição?</strong><br>Se você não pediu para redefinir sua senha, pode ignorar este e-mail com segurança. Sua senha atual permanecerá inalterada.</p>
                </div>
                <div class="footer">
                    <p>EduPhishing - Plataforma Educacional de Conscientização sobre Phishing</p>
                    <p>Este é um e-mail automático, por favor não responda.</p>
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
            error_log('Erro ao enviar e-mail: ' . $e->getMessage());
            throw $e;
        }
    }
}
