<?php

namespace App\Models;

use App\Database\Database;

class PhishingLog
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db->connect();
    }

    // Registra um novo envio de phishing
    public function logPhishingSent($senderId, $senderName, $senderEmail, $recipientName, $recipientEmail, $phishingType, $uniqueToken) {
        $stmt = $this->db->prepare('INSERT INTO phishing_logs (sender_id, sender_name, sender_email, recipient_name, recipient_email, phishing_type, unique_token) VALUES (?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$senderId, $senderName, $senderEmail, $recipientName, $recipientEmail, $phishingType, $uniqueToken]);
    }

    // Verifica quantos emails o remetente enviou nas últimas 24 horas
    public function getSentCountLast24Hours($senderId) {
        $stmt = $this->db->prepare('SELECT COUNT(*) as count FROM phishing_logs WHERE sender_id = ? AND sent_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)');
        $stmt->execute([$senderId]);
        $result = $stmt->fetch();
        return $result ? $result['count'] : 0;
    }

    // Verifica se o destinatário já recebeu phishing do mesmo remetente nas últimas 24 horas
    public function hasRecentlySentTo($senderId, $recipientEmail) {
        $stmt = $this->db->prepare('SELECT COUNT(*) as count FROM phishing_logs WHERE sender_id = ? AND recipient_email = ? AND sent_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)');
        $stmt->execute([$senderId, $recipientEmail]);
        $result = $stmt->fetch();
        return $result && $result['count'] > 0;
    }

    // Registra que o link foi clicado
    public function markAsClicked($token) {
        $stmt = $this->db->prepare('UPDATE phishing_logs SET clicked = 1, clicked_at = NOW() WHERE unique_token = ?');
        return $stmt->execute([$token]);
    }

    // Recupera informações do phishing pelo token
    public function getByToken($token) {
        $stmt = $this->db->prepare('SELECT * FROM phishing_logs WHERE unique_token = ?');
        $stmt->execute([$token]);
        return $stmt->fetch();
    }

    // Recupera estatísticas do usuário
    public function getUserStats($senderId) {
        $stmt = $this->db->prepare('
            SELECT 
                COUNT(*) as total_sent,
                SUM(clicked) as total_clicked,
                COUNT(DISTINCT recipient_email) as unique_recipients
            FROM phishing_logs 
            WHERE sender_id = ?
        ');
        $stmt->execute([$senderId]);
        return $stmt->fetch();
    }
}
