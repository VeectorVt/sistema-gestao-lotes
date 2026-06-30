SET NAMES utf8mb4;
CREATE DATABASE IF NOT EXISTS semit_lotes CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE semit_lotes;

CREATE TABLE IF NOT EXISTS lotes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quadra VARCHAR(50) NOT NULL,
    lote VARCHAR(50) NOT NULL,
    lote_num INT NOT NULL,
    area_total DECIMAL(10,2) DEFAULT NULL,
    frente VARCHAR(100) DEFAULT NULL,
    area_fr DECIMAL(10,2) DEFAULT NULL,
    fundo VARCHAR(100) DEFAULT NULL,
    area_fu DECIMAL(10,2) DEFAULT NULL,
    direito VARCHAR(100) DEFAULT NULL,
    area_ld DECIMAL(10,2) DEFAULT NULL,
    esquerdo VARCHAR(100) DEFAULT NULL,
    area_le DECIMAL(10,2) DEFAULT NULL,
    medidas VARCHAR(255) DEFAULT NULL,
    vr_metro_quadrado DECIMAL(10,2) DEFAULT NULL,
    vr_lote DECIMAL(12,2) DEFAULT NULL,
    codigo_situacao VARCHAR(20) DEFAULT NULL,
    iptu VARCHAR(50) DEFAULT NULL,
    iptu_desdobramento VARCHAR(50) DEFAULT NULL,
    inscricao_municipal VARCHAR(50) DEFAULT NULL,
    status_lote VARCHAR(30) NOT NULL DEFAULT 'Disponível',
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_quadra_lote (quadra, lote)
);

INSERT INTO lotes
(quadra, lote, lote_num, area_total, frente, area_fr, fundo, area_fu, direito, area_ld, esquerdo, area_le, medidas, vr_metro_quadrado, vr_lote, codigo_situacao, iptu, iptu_desdobramento, inscricao_municipal, status_lote)
VALUES
('01', 'Lote 01', 1, 360.00, 'Rua das Acacias', 12.00, 'Fundo de quadra', 12.00, 'Lote 02', 30.00, 'Lote 12', 30.00, '12x30', 850.00, 306000.00, 'ATV', '12345-6', NULL, '987654321', 'Disponível'),
('01', 'Lote 02', 2, 360.00, 'Rua das Acacias', 12.00, 'Fundo de quadra', 12.00, 'Lote 03', 30.00, 'Lote 01', 30.00, '12x30', 850.00, 306000.00, 'ATV', '12345-7', NULL, '987654322', 'Reservado'),
('02', 'Lote 05', 5, 450.00, 'Av. Central', 15.00, 'Fundo de quadra', 15.00, 'Lote 06', 30.00, 'Lote 04', 30.00, '15x30', 920.00, 414000.00, 'ATV', '12346-1', NULL, '987654400', 'Vendido'),
('02', 'Lote 06', 6, 450.00, 'Av. Central', 15.00, 'Fundo de quadra', 15.00, 'Lote 07', 30.00, 'Lote 05', 30.00, '15x30', 920.00, 414000.00, 'ATV', '12346-2', NULL, '987654401', 'Disponível'),
('03', 'Lote 10', 10, 300.00, 'Rua Sao Joao', 10.00, 'Fundo de quadra', 10.00, 'Lote 11', 30.00, 'Lote 09', 30.00, '10x30', 780.00, 234000.00, 'INT', '12347-3', '12347-3A', '987654550', 'Indisponível');
