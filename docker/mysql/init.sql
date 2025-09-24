-- Seleciona o banco de dados
USE eduphishing;

-- Cria a tabela se não existir
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email_verification_token VARCHAR(255) DEFAULT NULL,
    email_verified TINYINT(1) DEFAULT 0,
    dateTimeSendEmail DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);