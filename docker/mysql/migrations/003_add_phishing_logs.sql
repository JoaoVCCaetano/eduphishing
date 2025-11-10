-- Cria tabela para registrar envios de phishing educativo
CREATE TABLE IF NOT EXISTS phishing_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    sender_name VARCHAR(255) NOT NULL,
    sender_email VARCHAR(255) NOT NULL,
    recipient_name VARCHAR(255) NOT NULL,
    recipient_email VARCHAR(255) NOT NULL,
    phishing_type VARCHAR(50) NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    unique_token VARCHAR(255) UNIQUE NOT NULL,
    clicked TINYINT(1) DEFAULT 0,
    clicked_at TIMESTAMP NULL,
    FOREIGN KEY (sender_id) REFERENCES user(id) ON DELETE CASCADE,
    INDEX idx_sender_email (sender_email),
    INDEX idx_recipient_email (recipient_email),
    INDEX idx_sent_at (sent_at)
);
