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

    try {
            // Validações iniciais
            $senderName = trim($_POST['sender_name'] ?? '');
            $recipientName = trim($_POST['recipient_name'] ?? '');
            $recipientEmail = trim($_POST['email'] ?? '');
            $phishingType = $_POST['opcao-select'] ?? '';

            if (empty($senderName) || empty($recipientName) || empty($recipientEmail) || empty($phishingType)) {
                throw new Exception('Todos os campos são obrigatórios');
            }

            // Pega informações do usuário logado
            $userId = $_SESSION['userId'] ?? null;

            if (!$userId) {
                throw new Exception('Usuário não autenticado');
            }

            $db = new Database('db');
            $userModel = new User($db);
            $user = $userModel->getByIdComplete($userId);

            if (!$user) {
                throw new Exception('Usuário não encontrado');
            }

            $senderEmail = $user['email'];

            // Validação anti-spam
            $phishingLogModel = new PhishingLog($db);
            // Limita a 10 envios por dia
            $sentCount = $phishingLogModel->getSentCountLast24Hours($userId);

            if ($sentCount >= 10) {
                $_SESSION['message'] = [
                    'title' => 'Erro',
                    'text' => 'Você atingiu o limite de envios nas últimas 24 horas. Tente novamente mais tarde.',
                    'icon' => 'error'
                ];
                $_SESSION['fecharModal'] = true;
                header('Location: /');
                exit;
            }

            // Verifica se já enviou para este destinatário recentemente
            $jaEnviado = $phishingLogModel->hasRecentlySentTo($userId, $recipientEmail);
            if ($jaEnviado) {
                $_SESSION['message'] = [
                    'title' => 'Erro',
                    'text' => 'Você já enviou um phishing educativo para este destinatário nas últimas 24 horas.',
                    'icon' => 'error'
                ];
                $_SESSION['fecharModal'] = true;
                header('Location: /');
                exit;
            }

            // Gera token único para rastreamento
            $uniqueToken = bin2hex(random_bytes(32));

            $emailTemplates = [
                'Netflix' => __DIR__ . '/../Views/emails/netflix.html',
                'Facebook' => __DIR__ . '/../Views/emails/facebook.html',
                'Instagram' => __DIR__ . '/../Views/emails/instagram.html',
                'Google' => __DIR__ . '/../Views/emails/google.html'
            ];

            if ($phishingType == 'Netflix') {
                $subject = 'Problemas com sua conta Netflix';
                $bodyHtml = file_get_contents($emailTemplates['Netflix']);
                $bodyHtml = str_replace('{{nome}}', $recipientName, $bodyHtml);
                $bodyHtml = str_replace('{{token}}', $uniqueToken, $bodyHtml);
            } elseif ($phishingType == 'Facebook') {
                $subject = 'Problemas com sua conta Facebook';
                $bodyHtml = file_get_contents($emailTemplates['Facebook']);
                $bodyHtml = str_replace('{{nome}}', $recipientName, $bodyHtml);
                $bodyHtml = str_replace('{{token}}', $uniqueToken, $bodyHtml);
            } elseif ($phishingType == 'Instagram') {
                $subject = 'Problemas com sua conta Instagram';
                $bodyHtml = file_get_contents($emailTemplates['Instagram']);
                $bodyHtml = str_replace('{{nome}}', $recipientName, $bodyHtml);
                $bodyHtml = str_replace('{{token}}', $uniqueToken, $bodyHtml);
            } elseif ($phishingType == 'Google') {
                $subject = 'Problemas com sua conta Google';
                $bodyHtml = file_get_contents($emailTemplates['Google']);
                $bodyHtml = str_replace('{{nome}}', $recipientName, $bodyHtml);
                $bodyHtml = str_replace('{{token}}', $uniqueToken, $bodyHtml);
            }

            $emailSender = new \App\Utils\EmailSender();
            try {
                $emailSender->sendEmail(
                    $recipientEmail,
                    $subject,
                    '',
                    $bodyHtml
                );
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
                throw new Exception('Erro ao enviar e-mail: ' . $e->getMessage());
            }

        } catch (Exception $e) {
            $_SESSION['message'] = [
                'title' => 'Erro ao enviar email',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ];
            $_SESSION['fecharModal'] = true;
            header('Location: /form');
            exit;
        }

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
