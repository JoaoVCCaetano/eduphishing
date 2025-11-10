<?php

namespace App\Controllers;

use App\Models\PhishingLog;
use App\Database\Database;

class PhishingAlertController {

    public function showAlert() {
        $token = $_GET['token'] ?? '';

        if (empty($token)) {
            header('Location: /');
            exit;
        }

        $db = new Database('db');
        $phishingLogModel = new PhishingLog($db);
        $phishingData = $phishingLogModel->getByToken($token);

        if (!$phishingData) {
            header('Location: /');
            exit;
        }

        // Marca como clicado (apenas na primeira vez)
        if (!$phishingData['clicked']) {
            $phishingLogModel->markAsClicked($token);
        }

        // Coleta dados para fins educacionais (NÃO SALVAMOS NO BANCO)
        $educationalData = [
            'ip' => $this->getClientIP(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Não disponível',
            'referer' => $_SERVER['HTTP_REFERER'] ?? 'Direto',
            'browser' => $this->getBrowserInfo(),
            'os' => $this->getOSInfo(),
            'language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'Não disponível',
            'screen_info' => 'Detectável via JavaScript',
            'geolocation' => 'Detectável via JavaScript/API',
            'sender_name' => $phishingData['sender_name'],
            'sender_email' => $phishingData['sender_email'],
            'phishing_type' => $phishingData['phishing_type']
        ];

        include __DIR__ . '/../Views/phishing-alert.php';
    }

    private function getClientIP() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'DESCONHECIDO';
        return $ipaddress;
    }

    private function getBrowserInfo() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        if (strpos($userAgent, 'Firefox') !== false) {
            return 'Mozilla Firefox';
        } elseif (strpos($userAgent, 'Chrome') !== false) {
            return 'Google Chrome';
        } elseif (strpos($userAgent, 'Safari') !== false) {
            return 'Safari';
        } elseif (strpos($userAgent, 'Edge') !== false) {
            return 'Microsoft Edge';
        } elseif (strpos($userAgent, 'Opera') !== false || strpos($userAgent, 'OPR') !== false) {
            return 'Opera';
        } else {
            return 'Navegador desconhecido';
        }
    }

    private function getOSInfo() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        if (strpos($userAgent, 'Windows') !== false) {
            return 'Windows';
        } elseif (strpos($userAgent, 'Mac') !== false) {
            return 'macOS';
        } elseif (strpos($userAgent, 'Linux') !== false) {
            return 'Linux';
        } elseif (strpos($userAgent, 'Android') !== false) {
            return 'Android';
        } elseif (strpos($userAgent, 'iOS') !== false || strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'iPad') !== false) {
            return 'iOS';
        } else {
            return 'Sistema Operacional desconhecido';
        }
    }
}
