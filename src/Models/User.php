<?php

namespace App\Models;

use App\Database\Database;

class User
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db->connect();
    }

    // Recupera o usuário pelo e-mail e senha
    public function get($email, $senha) {
        $stmt = $this->db->prepare('SELECT id, password, email_verified FROM user WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($senha, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Adicionar um novo usuário com token de verificação
    public function add($email, $senha) {
        // Verifica se o e-mail já existe
        $check = $this->db->prepare('SELECT id FROM user WHERE email = ?');
        $check->execute([$email]);
        if ($check->fetch()) {
            return 'duplicate';
        }
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(32));
        $stmt = $this->db->prepare('INSERT INTO user (email, password, email_verification_token) VALUES (?, ?, ?)');
        $result = $stmt->execute([
            $email,
            $hash,
            $token
        ]);
        return $result ? $token : false;
    }

    public function setDate($id) {
        // Remover verificação de $_SESSION, pois o id já é passado corretamente
        $stmt = $this->db->prepare('UPDATE user SET dateTimeSendEmail = CURRENT_TIME() WHERE id = ?');
        return $stmt->execute([
            $id
        ]);
    }

    // Verifica o email usando o token
    public function verifyEmail($token) {
        // Primeiro busca o ID
        $stmt = $this->db->prepare('SELECT id FROM user WHERE email_verification_token = ?');
        $stmt->execute([$token]);
        $user = $stmt->fetch();
        
        if ($user) {
            // Depois atualiza o status
            $updateStmt = $this->db->prepare('UPDATE user SET email_verified = 1, email_verification_token = NULL WHERE id = ?');
            $updateStmt->execute([$user['id']]);
            return $user['id'];
        }
        
        return false;
    }

    // Recupera o usuário pelo id
    public function getById($id) {
        $db = new Database('db');
        $pdo = $db->connect();
        $stmt = $pdo->prepare('SELECT email_verified, dateTimeSendEmail FROM user WHERE id = ?');
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        return  $user ?? false;
    }

    // Recupera o usuário completo pelo id
    public function getByIdComplete($id) {
        $stmt = $this->db->prepare('SELECT id, email, email_verified, dateTimeSendEmail FROM user WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Recupera o usuário pelo e-mail
    public function getByEmail($email) {
        $stmt = $this->db->prepare('SELECT id, email, email_verified FROM user WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Gera token de reset de senha
    public function generatePasswordResetToken($userId) {
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        $stmt = $this->db->prepare('UPDATE user SET password_reset_token = ?, password_reset_expires = ? WHERE id = ?');
        $result = $stmt->execute([$token, $expires, $userId]);
        
        return $result ? $token : false;
    }

    // Recupera o usuário pelo token de reset
    public function getUserByResetToken($token) {
        $stmt = $this->db->prepare('SELECT id, email FROM user WHERE password_reset_token = ? AND password_reset_expires > NOW()');
        $stmt->execute([$token]);
        return $stmt->fetch();
    }

    // Reseta a senha do usuário
    public function resetPassword($userId, $newPassword) {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare('UPDATE user SET password = ?, password_reset_token = NULL, password_reset_expires = NULL WHERE id = ?');
        return $stmt->execute([$hash, $userId]);
    }
}
    
