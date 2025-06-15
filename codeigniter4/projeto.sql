-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Tempo de geração: 12/06/2025 às 19:33
-- Versão do servidor: 8.0.41
-- Versão do PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto`
--

--
-- Banco de dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--
CREATE TABLE `categorias` (
  `categorias_id` int NOT NULL,
  `categorias_nome` varchar(255) NOT NULL,
  PRIMARY KEY (`categorias_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`categorias_id`, `categorias_nome`) VALUES
(1, 'Comida'),
(2, 'Bebida'),
(3, 'Sobremesa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidades`
--
CREATE TABLE `cidades` (
  `cidades_id` int NOT NULL,
  `cidades_nome` varchar(255) NOT NULL,
  `cidades_uf` varchar(2) NOT NULL,
  PRIMARY KEY (`cidades_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `cidades`
--

INSERT INTO `cidades` (`cidades_id`, `cidades_nome`, `cidades_uf`) VALUES
(1, 'rialma', 'GO'),
(3, 'Ceres', 'Go');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_clientes` int NOT NULL,
  `nome_cliente` varchar(20) NOT NULL,
  `sobrenome_cliente` varchar(50) NOT NULL,
  `cpf_cliente` varchar(11) NOT NULL,
  `data_nasc_cliente` date NOT NULL,
  `fone_cliente` varchar(11) NOT NULL,
  `usuario_cliente` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_clientes`, `nome_cliente`, `sobrenome_cliente`, `cpf_cliente`, `data_nasc_cliente`, `fone_cliente`, `usuario_cliente`) VALUES
(29, 'Eric', 'Ferreira Gomes', '08120874102', '2003-09-05', '62998628227', 59);

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `endereco_id` int NOT NULL,
  `endereco_rua` varchar(255) NOT NULL,
  `endereco_numero` int NOT NULL,
  `endereco_complemento` varchar(255) NOT NULL,
  `endereco_cep` varchar(10) NOT NULL,
  `endereco_cidade_id` int NOT NULL,
  `endereco_status` int NOT NULL,
  `endereco_usuario_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel`
--

CREATE TABLE `nivel` (
  `id_nivel` int NOT NULL,
  `nivel` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `nivel`
--

INSERT INTO `nivel` (`id_nivel`, `nivel`) VALUES
(1, 'Admin'),
(2, 'Funcionario'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--
-- PRIMARY KEY adicionada diretamente na criação da tabela
CREATE TABLE `produtos` (
  `produtos_id` int NOT NULL AUTO_INCREMENT,
  `produtos_nome` varchar(255) NOT NULL,
  `produtos_descricao` text NOT NULL,
  `produtos_preco_custo` float(9,2) NOT NULL,
  `produtos_preco_venda` float(9,2) NOT NULL,
  `produtos_categoria_id` int NOT NULL,
  PRIMARY KEY (`produtos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura para tabela `Pedidos`
--

CREATE TABLE `pedidos` (
  `pedido_id` INT NOT NULL AUTO_INCREMENT,
  `cliente_id` INT NOT NULL,
  `endereco_id` INT NOT NULL,
  `data_pedido` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR(50) NOT NULL DEFAULT 'Pendente',
  PRIMARY KEY (`pedido_id`),
  FOREIGN KEY (`cliente_id`) REFERENCES `clientes`(`id_clientes`) ON DELETE RESTRICT,
  FOREIGN KEY (`endereco_id`) REFERENCES `endereco`(`endereco_id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


--
-- Estrutura para tabela `Pedidos Itens`
--

CREATE TABLE pedidos_itens (
  `item_id` INT NOT NULL AUTO_INCREMENT,
  `pedido_id` INT NOT NULL,
  `produto_id` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `preco_unitario` FLOAT(9,2) NOT NULL,
  PRIMARY KEY (`item_id`),
  FOREIGN KEY (`pedido_id`) REFERENCES `pedidos`(`pedido_id`) ON DELETE CASCADE,
  FOREIGN KEY (`produto_id`) REFERENCES `produtos`(`produtos_id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



--
-- Estrutura para tabela `estoques`
--


CREATE TABLE `estoques` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `produto_id` INT NOT NULL,
  `quantidade` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`produto_id`) REFERENCES `produtos`(`produtos_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- Gatilho para adicionar todo novo produto a tabela 'estoques'
DELIMITER //

CREATE TRIGGER trg_produto_insert AFTER INSERT ON produtos
FOR EACH ROW
BEGIN
  INSERT INTO estoques (produto_id, quantidade)
  VALUES (NEW.produtos_id, 1);
END;
//

DELIMITER ;

-- Colocando dados na tabela produtos
-- Estes INSERTs agora virão *após* a criação do trigger
INSERT INTO `produtos` (
    `produtos_nome`,
    `produtos_descricao`,
    `produtos_preco_custo`,
    `produtos_preco_venda`,
    `produtos_categoria_id`
) VALUES
('X-Burguer', 'Delicioso hambúrguer com queijo e salada.', 8.50, 15.00, 1), 
('Suco de Laranja', 'Suco natural de laranja, 300ml.', 3.00, 7.00, 2),        
('Pudim', 'Pudim de leite condensado com calda de caramelo.', 4.00, 9.50, 3); 

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarios_id` int NOT NULL,
  `usuarios_nome` varchar(255) NOT NULL,
  `usuarios_email` varchar(255) NOT NULL,
  `usuarios_senha` varchar(32) NOT NULL,
  `usuarios_data_cadastro` date NOT NULL,
  `usuarios_nivel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--
-- CORREÇÃO: Removido o segundo 'VALUES'
INSERT INTO `usuarios` (`usuarios_id`, `usuarios_nome`, `usuarios_email`, `usuarios_senha`, `usuarios_data_cadastro`, `usuarios_nivel`) 
VALUES 
(59, 'Eric Gomes', 'eric@gmail.com', 'admin', CURDATE(), 3),
(60, 'Adauto Turibio', 'adauto@gmail.com', '123456', CURDATE(), 3);


--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
-- REMOVIDO: A Primary Key já está definida no CREATE TABLE `categorias`

--
-- Índices de tabela `cidades`
-- REMOVIDO: A Primary Key já está definida no CREATE TABLE `cidades`

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_clientes`),
  ADD KEY `usuario_cliente` (`usuario_cliente`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`endereco_id`),
  ADD KEY `endereco_cidade_id` (`endereco_cidade_id`),
  ADD KEY `endereco_usuario_id` (`endereco_usuario_id`);

--
-- Índices de tabela `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Índices de tabela `produtos`
-- REMOVIDO: A Primary Key já está definida no CREATE TABLE `produtos`
-- ALTER TABLE `produtos` ADD PRIMARY KEY (`produtos_id`);
ALTER TABLE `produtos`
  ADD KEY `fk_produto_categoria` (`produtos_categoria_id`); -- Mantido este KEY para a FK

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarios_id`),
  ADD KEY `usuarios_nivel` (`usuarios_nivel`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categorias_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4; -- AUTO_INCREMENT ajustado para o maior ID inserido

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `cidades_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_clientes` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `endereco_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `nivel`
--
ALTER TABLE `nivel`
  MODIFY `id_nivel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtos_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61; -- Ajustado para o próximo ID disponível (60+1)

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `usuario_cliente` FOREIGN KEY (`usuario_cliente`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_cidade_id` FOREIGN KEY (`endereco_cidade_id`) REFERENCES `cidades` (`cidades_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `endereco_usuario_id` FOREIGN KEY (`endereco_usuario_id`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`produtos_categoria_id`) REFERENCES `categorias` (`categorias_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_nivel` FOREIGN KEY (`usuarios_nivel`) REFERENCES `nivel` (`id_nivel`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;