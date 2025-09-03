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

        $stmt = $this->db->prepare('SELECT * FROM user WHERE login = ? AND password = ?');

        $stmt->execute([
            $login,
            $senha
        ]);

        return $stmt->fetchAll();
    }

    // Adicionar um novo usuário
    public function add($login,$senha) {
        $stmt = $this->db->prepare('INSERT INTO user (login, password) VALUES (?, ?)');
        return $stmt->execute([
            $login,
            $senha
        ]);
    } 
    
}