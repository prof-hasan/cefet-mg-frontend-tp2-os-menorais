-- CRIAR O BANCO DE DADOS
CREATE DATABASE IF NOT EXISTS banco_dados;
USE banco_dados;

-- TABELA DE USUARIOS
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- USUARIOS PRE DEFINIDOS
INSERT INTO usuarios (nome, senha, id) VALUES
('Ana', '$2y$10$47uIrXf52u.gYdFBVPD2vezZPXvIIkVDgt1xGZEJEa52TeLNQNNz6', '1'),
('Bruno', '$2y$10$47uIrXf52u.gYdFBVPD2vezZPXvIIkVDgt1xGZEJEa52TeLNQNNz6', '2'),
('Carla', '$2y$10$47uIrXf52u.gYdFBVPD2vezZPXvIIkVDgt1xGZEJEa52TeLNQNNz6', '3'),
('Diego', '$2y$10$47uIrXf52u.gYdFBVPD2vezZPXvIIkVDgt1xGZEJEa52TeLNQNNz6', '4');

-- TABELA DE LIVROS
CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    foto VARCHAR(255) NOT NULL,
    categoria ENUM('ja_li', 'em_andamento', 'quero_ler') NOT NULL,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
-- LIVROS PRE CADASTRADOS
INSERT INTO livros (titulo, foto, categoria, usuario_id) VALUES
('Dom Casmurro', 'domcasmurro.jpg', 'ja_li', 1),
('1984', '1984.jpg', 'em_andamento', 2),
('Harry Potter', 'harry_potter.jpg', 'quero_ler', 3),
('A Culpa é das Estrelas', 'culpa_estrelas.jpg', 'quero_ler', 4);
