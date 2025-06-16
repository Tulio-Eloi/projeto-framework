SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ============================================================
-- Estruturas de tabelas
-- ============================================================

CREATE TABLE `categorias` (
  `categorias_id` int NOT NULL AUTO_INCREMENT,
  `categorias_nome` varchar(255) NOT NULL,
  PRIMARY KEY (`categorias_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `cidades` (
  `cidades_id` int NOT NULL AUTO_INCREMENT,
  `cidades_nome` varchar(255) NOT NULL,
  `cidades_uf` varchar(2) NOT NULL,
  PRIMARY KEY (`cidades_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `nivel` (
  `id_nivel` int NOT NULL AUTO_INCREMENT,
  `nivel` varchar(20) NOT NULL,
  PRIMARY KEY (`id_nivel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `usuarios` (
  `usuarios_id` int NOT NULL AUTO_INCREMENT,
  `usuarios_nome` varchar(255) NOT NULL,
  `usuarios_email` varchar(255) NOT NULL,
  `usuarios_senha` varchar(32) NOT NULL,
  `usuarios_data_cadastro` date NOT NULL,
  `usuarios_nivel` int NOT NULL,
  PRIMARY KEY (`usuarios_id`),
  KEY `usuarios_nivel` (`usuarios_nivel`),
  FOREIGN KEY (`usuarios_nivel`) REFERENCES `nivel` (`id_nivel`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `clientes` (
  `id_clientes` int NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(20) NOT NULL,
  `sobrenome_cliente` varchar(50) NOT NULL,
  `cpf_cliente` varchar(11) NOT NULL,
  `data_nasc_cliente` date NOT NULL,
  `fone_cliente` varchar(11) NOT NULL,
  `usuario_cliente` int NOT NULL,
  PRIMARY KEY (`id_clientes`),
  KEY `usuario_cliente` (`usuario_cliente`),
  FOREIGN KEY (`usuario_cliente`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `endereco` (
  `endereco_id` int NOT NULL AUTO_INCREMENT,
  `endereco_rua` varchar(255) NOT NULL,
  `endereco_numero` int NOT NULL,
  `endereco_complemento` varchar(255) NOT NULL,
  `endereco_cep` varchar(10) NOT NULL,
  `endereco_cidade_id` int NOT NULL,
  `endereco_status` int NOT NULL,
  `endereco_usuario_id` int NOT NULL,
  PRIMARY KEY (`endereco_id`),
  KEY `endereco_cidade_id` (`endereco_cidade_id`),
  KEY `endereco_usuario_id` (`endereco_usuario_id`),
  FOREIGN KEY (`endereco_cidade_id`) REFERENCES `cidades` (`cidades_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`endereco_usuario_id`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `produtos` (
  `produtos_id` int NOT NULL AUTO_INCREMENT,
  `produtos_nome` varchar(255) NOT NULL,
  `produtos_descricao` text NOT NULL,
  `produtos_preco_custo` float(9,2) NOT NULL,
  `produtos_preco_venda` float(9,2) NOT NULL,
  `produtos_categoria_id` int NOT NULL,
  PRIMARY KEY (`produtos_id`),
  KEY `fk_produto_categoria` (`produtos_categoria_id`),
  FOREIGN KEY (`produtos_categoria_id`) REFERENCES `categorias` (`categorias_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `pedidos` (
  `pedido_id` INT NOT NULL AUTO_INCREMENT,
  `cliente_id` INT NOT NULL,
  `endereco_id` INT NOT NULL,
  `data_pedido` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` VARCHAR(50) NOT NULL DEFAULT 'Pendente',
  PRIMARY KEY (`pedido_id`),
  FOREIGN KEY (`cliente_id`) REFERENCES `clientes`(`id_clientes`) ON DELETE RESTRICT,
  FOREIGN KEY (`endereco_id`) REFERENCES `endereco`(`endereco_id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `pedidos_itens` (
  `item_id` INT NOT NULL AUTO_INCREMENT,
  `pedido_id` INT NOT NULL,
  `produto_id` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `preco_unitario` FLOAT(9,2) NOT NULL,
  PRIMARY KEY (`item_id`),
  FOREIGN KEY (`pedido_id`) REFERENCES `pedidos`(`pedido_id`) ON DELETE CASCADE,
  FOREIGN KEY (`produto_id`) REFERENCES `produtos`(`produtos_id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `estoques` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `produto_id` INT NOT NULL,
  `quantidade` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`produto_id`) REFERENCES `produtos`(`produtos_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELIMITER //

CREATE TRIGGER trg_produto_insert AFTER INSERT ON produtos
FOR EACH ROW
BEGIN
  INSERT INTO estoques (produto_id, quantidade) VALUES (NEW.produtos_id, 1);
END;
//

DELIMITER ;

-- ============================================================
-- Dados das tabelas
-- ============================================================

INSERT INTO `categorias` (`categorias_nome`) VALUES
('Comida'),
('Bebida'),
('Sobremesa');

INSERT INTO `cidades` (`cidades_nome`, `cidades_uf`) VALUES
('Rialma', 'GO'),
('Ceres', 'GO'),
('Goiânia', 'GO');

INSERT INTO `nivel` (`nivel`) VALUES
('Admin'),
('Funcionario'),
('Cliente');

INSERT INTO `usuarios` (`usuarios_nome`, `usuarios_email`, `usuarios_senha`, `usuarios_data_cadastro`, `usuarios_nivel`) VALUES
('Eric Gomes', 'eric@gmail.com', 'admin', CURDATE(), 1),
('Adauto Turibio', 'adauto@gmail.com', '123456', CURDATE(), 3),
('Carlos Silva', 'carlos@gmail.com', 'abc123', CURDATE(), 2),
('Mariana Souza', 'mariana@gmail.com', 'def456', CURDATE(), 2),
('João Pedro', 'joao@gmail.com', 'ghi789', CURDATE(), 3);

INSERT INTO `clientes` (`nome_cliente`, `sobrenome_cliente`, `cpf_cliente`, `data_nasc_cliente`, `fone_cliente`, `usuario_cliente`) VALUES
('Eric', 'Ferreira Gomes', '08120874102', '2003-09-05', '62998628227', 1),
('Carlos', 'Silva', '12345678901', '1990-01-01', '62999999999', 3),
('Mariana', 'Souza', '23456789012', '1985-05-05', '62988888888', 4),
('João', 'Pedro', '34567890123', '2000-12-12', '62977777777', 5);

INSERT INTO `endereco` (`endereco_rua`, `endereco_numero`, `endereco_complemento`, `endereco_cep`, `endereco_cidade_id`, `endereco_status`, `endereco_usuario_id`) VALUES
('Rua das Flores', 123, 'Apto 101', '74000000', 1, 1, 1),
('Av. Brasil', 456, 'Casa', '74100000', 2, 1, 3),
('Rua Goiás', 789, 'Bloco B', '74200000', 3, 1, 4);

INSERT INTO `produtos` (`produtos_nome`, `produtos_descricao`, `produtos_preco_custo`, `produtos_preco_venda`, `produtos_categoria_id`) VALUES
('X-Burguer', 'Delicioso hambúrguer com queijo e salada.', 8.50, 15.00, 1),
('Suco de Laranja', 'Suco natural de laranja, 300ml.', 3.00, 7.00, 2),
('Pudim', 'Pudim de leite condensado com calda de caramelo.', 4.00, 9.50, 3);

INSERT INTO `pedidos` (`cliente_id`, `endereco_id`, `status`) VALUES
(1, 1, 'Pendente'),
(2, 2, 'Em Preparo'),
(3, 3, 'Entregue');

INSERT INTO `pedidos_itens` (`pedido_id`, `produto_id`, `quantidade`, `preco_unitario`) VALUES
(1, 1, 2, 15.00),
(1, 2, 1, 7.00),
(2, 3, 3, 9.50),
(3, 1, 1, 15.00),
(3, 3, 2, 9.50);

-- Ajustando estoques
UPDATE `estoques` SET quantidade = 50 WHERE produto_id = 1;
UPDATE `estoques` SET quantidade = 100 WHERE produto_id = 2;
UPDATE `estoques` SET quantidade = 25 WHERE produto_id = 3;

COMMIT;
