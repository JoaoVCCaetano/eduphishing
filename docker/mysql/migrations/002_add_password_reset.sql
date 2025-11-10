-- Adiciona campos para reset de senha
ALTER TABLE user 
ADD COLUMN password_reset_token VARCHAR(255) DEFAULT NULL,
ADD COLUMN password_reset_expires DATETIME DEFAULT NULL;
