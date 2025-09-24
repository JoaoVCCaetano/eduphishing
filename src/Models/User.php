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
        $stmt = $this->db->prepare('SELECT id, password FROM user WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($senha, $user['password'])) {
            return $user['id'];
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

    public function setDate() {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }
        $stmt = $this->db->prepare('UPDATE user SET dateTimeSendEmail = CURRENT_TIME() WHERE id = ?');
        return $stmt->execute([
            $_SESSION['user_id']
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
    }
    
