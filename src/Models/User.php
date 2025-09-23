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

    // Recupera o usuário pelo login e senha
    public function get($login, $senha) {

        $stmt = $this->db->prepare('SELECT id FROM user WHERE login = ? AND password = password( ? )');

        $stmt->execute([
            $login,
            $senha
        ]);

        return $stmt->fetchAll()[0]['id'];
    }

    // Adicionar um novo usuário
    public function add($login,$senha) {
        $stmt = $this->db->prepare('INSERT INTO user (login, password) VALUES (?, password( ? ) )');
        return $stmt->execute([
            $login,
            $senha
        ]);
    } 

    public function setDate() {
        $stmt = $this->db->prepare('UPDATE user SET dateTimeSendEmail = CURRENT_TIME() WHERE id = ?');
        return $stmt->execute([
            $_SESSION['userId']
        ]);
    }
    
}