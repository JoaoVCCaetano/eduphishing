<?php

namespace App\Controllers;

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;
use Exception;
use App\Models\PhishingLog;
use App\Models\User;
use App\Database\Database;

class EmailController {

    public function send() {

    error_log('--- INICIO ENVIO PHISHING ---');
    try {
            // Validações iniciais
            $senderName = trim($_POST['sender_name'] ?? '');
            $recipientName = trim($_POST['recipient_name'] ?? '');
            $recipientEmail = trim($_POST['email'] ?? '');
            $phishingType = $_POST['opcao-select'] ?? '';
            error_log('Dados recebidos: senderName=' . $senderName . ', recipientName=' . $recipientName . ', recipientEmail=' . $recipientEmail . ', phishingType=' . $phishingType);

            if (empty($senderName) || empty($recipientName) || empty($recipientEmail) || empty($phishingType)) {
                throw new Exception('Todos os campos são obrigatórios');
            }

            // Pega informações do usuário logado
            $userId = $_SESSION['userId'] ?? null;
            error_log('userId=' . $userId);
            if (!$userId) {
                error_log('Usuário não autenticado');
                throw new Exception('Usuário não autenticado');
            }

            $db = new Database('db');
            $userModel = new User($db);
            $user = $userModel->getByIdComplete($userId);
            error_log('Dados do usuário: ' . print_r($user, true));
            if (!$user) {
                error_log('Usuário não encontrado');
                throw new Exception('Usuário não encontrado');
            }

            $senderEmail = $user['email'];
            error_log('senderEmail=' . $senderEmail);

            // Validação anti-spam
            $phishingLogModel = new PhishingLog($db);
            // Limita a 10 envios por dia
            $sentCount = $phishingLogModel->getSentCountLast24Hours($userId);
            error_log('Envios nas últimas 24h: ' . $sentCount);
            if ($sentCount >= 25) {
                error_log('Limite de envios atingido');
                $_SESSION['error'] = 'Você atingiu o limite de envios nas últimas 24 horas. Tente novamente mais tarde.';
                header('Location: /');
                exit;
            }

            // Verifica se já enviou para este destinatário recentemente
            $jaEnviado = $phishingLogModel->hasRecentlySentTo($userId, $recipientEmail);
            error_log('Já enviado para destinatário nas últimas 24h: ' . ($jaEnviado ? 'sim' : 'não'));
            // if ($jaEnviado) {
            //     error_log('Envio duplicado bloqueado');
            //     $_SESSION['error'] = 'Você já enviou um phishing educativo para este destinatário nas últimas 24 horas.';
            //     header('Location: /form');
            //     exit;
            // }

            // Gera token único para rastreamento
            $uniqueToken = bin2hex(random_bytes(32));
            error_log('uniqueToken=' . $uniqueToken);

            $emailTemplates = [
                'Netflix' => __DIR__ . '/../Views/emails/netflix.html',
                'Facebook' => __DIR__ . '/../Views/emails/facebook.html',
                'Instagram' => __DIR__ . '/../Views/emails/instagram.html',
            ];

            if ($phishingType == 'Netflix') {
                $subject = 'Problemas com sua conta Netflix';
                $bodyHtml = file_get_contents($emailTemplates['Netflix']);
                $bodyHtml = str_replace('{{nome}}', $recipientName, $bodyHtml);
                $bodyHtml = str_replace('{{token}}', $uniqueToken, $bodyHtml);
                $phishingAlertUrl = 'https://localhost/phishing-alert?token=' . $uniqueToken;
                $bodyHtml = str_replace('{{phishing_alert_url}}', $phishingAlertUrl, $bodyHtml);
                $bodyText = '';
            } elseif ($phishingType == 'Facebook') {
                $subject = 'Problemas com sua conta Facebook';
                $bodyHtml = file_get_contents($emailTemplates['Facebook']);
                $bodyHtml = str_replace('{{nome}}', $recipientName, $bodyHtml);
                $bodyHtml = str_replace('{{token}}', $uniqueToken, $bodyHtml);
                $phishingAlertUrl = 'https://localhost/phishing-alert?token=' . $uniqueToken;
                $bodyHtml = str_replace('{{phishing_alert_url}}', $phishingAlertUrl, $bodyHtml);
                $bodyText = '';
            } elseif ($phishingType == 'Instagram') {
                $subject = 'Problemas com sua conta Instagram';
                $bodyHtml = file_get_contents($emailTemplates['Instagram']);
                $bodyHtml = str_replace('{{nome}}', $recipientName, $bodyHtml);
                $bodyHtml = str_replace('{{token}}', $uniqueToken, $bodyHtml);
                $phishingAlertUrl = 'https://localhost/phishing-alert?token=' . $uniqueToken;
                $bodyHtml = str_replace('{{phishing_alert_url}}', $phishingAlertUrl, $bodyHtml);
                $bodyText = '';
            }

                        // Removido bloco duplicado e mal posicionado
            $emailSender = new \App\Utils\EmailSender();
            $result = null;
            try {
                $result = $emailSender->sendEmail(
                    $recipientEmail,
                    $subject,
                    $bodyText,
                    $bodyHtml
                );
                error_log('Resultado envio SES: ' . print_r($result, true));
                // Registra o envio no log somente se o envio foi bem-sucedido
                $phishingLogModel->logPhishingSent(
                    $userId,
                    $senderName,
                    $senderEmail,
                    $recipientName,
                    $recipientEmail,
                    $phishingType,
                    $uniqueToken
                );
            } catch (\Exception $e) {
                error_log('Erro ao enviar e-mail: ' . $e->getMessage());
                throw new Exception('Erro ao enviar e-mail: ' . $e->getMessage());
            }

        } catch (Exception $e) {
            error_log('--- ERRO ENVIO PHISHING ---');
            error_log("Erro ao enviar email: " . $e->getMessage());
            $_SESSION['message'] = [
                'title' => 'Erro ao enviar email',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ];
            $_SESSION['fecharModal'] = true;
            header('Location: /form');
            exit;
        }
        error_log('--- FIM ENVIO PHISHING ---');

        // Atualiza o último envio
        $usuario = new User($db);
        if (!$usuario->setDate($_SESSION['userId'])) {
            $_SESSION['message'] = [
                'title' => 'Aviso',
                'text' => 'Email enviado, mas não foi possível atualizar a data do último envio.',
                'icon' => 'warning'
            ];
            $_SESSION['fecharModal'] = true;
            header('Location: /');
            exit;
        }

        $_SESSION['message'] = [
            'title' => 'Email enviado',
            'text' => 'Phishing educativo enviado com sucesso para ' . htmlspecialchars($recipientName) . ' (' . htmlspecialchars($recipientEmail) . ')',
            'icon' => 'success'
        ];
        $_SESSION['fecharModal'] = true;
        header('Location: /');
        exit;

    }


}
