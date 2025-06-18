-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Tempo de geração: 18/06/2025 às 00:46
-- Versão do servidor: 8.0.41
-- Versão do PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto`
--
CREATE schema projeto;
use projeto;
-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `categorias_id` int NOT NULL,
  `categorias_nome` varchar(255) NOT NULL
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
  `cidades_uf` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `cidades`
--

INSERT INTO `cidades` (`cidades_id`, `cidades_nome`, `cidades_uf`) VALUES
(1, 'Rialma', 'GO'),
(2, 'Ceres', 'GO'),
(3, 'Goiânia', 'GO');

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
(1, 'Eric', 'Ferreira Gomes', '08120874102', '2003-09-05', '62998628227', 1),
(2, 'Carlos', 'Silva', '12345678901', '1990-01-01', '62999999999', 3),
(3, 'Mariana', 'Souza', '23456789012', '1985-05-05', '62988888888', 4),
(4, 'João', 'Pedro', '34567890123', '2000-12-12', '62977777777', 5);

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

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`endereco_id`, `endereco_rua`, `endereco_numero`, `endereco_complemento`, `endereco_cep`, `endereco_cidade_id`, `endereco_status`, `endereco_usuario_id`) VALUES
(1, 'Rua das Flores', 123, 'Apto 101', '74000000', 1, 1, 1),
(2, 'Av. Brasil', 456, 'Casa', '74100000', 2, 1, 3),
(3, 'Rua Goiás', 789, 'Bloco B', '74200000', 3, 1, 4),
(4, '18', 0, 'QD Z-18 LT 16 JARDIM SORRISO 2', '76300000', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `entregador`
--

CREATE TABLE `entregador` (
  `id_entregador` int NOT NULL,
  `nome_entregador` varchar(100) NOT NULL,
  `veiculo_entregador` varchar(100) NOT NULL,
  `placa_entregador` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `entregador`
--

INSERT INTO `entregador` (`id_entregador`, `nome_entregador`, `veiculo_entregador`, `placa_entregador`) VALUES
(1, 'Gláuber Henrique ', 'CG FAN 160', 'PXD8746'),
(2, 'Eric Ferreira', 'Fan 160 azul ', 'pxd-876');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoques`
--

CREATE TABLE `estoques` (
  `id` int NOT NULL,
  `produto_id` int NOT NULL,
  `quantidade` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `estoques`
--

INSERT INTO `estoques` (`id`, `produto_id`, `quantidade`) VALUES
(1, 1, 50),
(2, 2, 100),
(3, 3, 25);

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel`
--

CREATE TABLE `nivel` (
  `id_nivel` int NOT NULL,
  `nivel` varchar(20) NOT NULL
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
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `pedido_id` int NOT NULL,
  `cliente_id` int NOT NULL,
  `endereco_id` int NOT NULL,
  `data_pedido` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'Pendente',
  `entregador_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`pedido_id`, `cliente_id`, `endereco_id`, `data_pedido`, `status`, `entregador_id`) VALUES
(1, 1, 1, '2025-06-16 01:18:25', 'Entregue', 1),
(2, 2, 2, '2025-06-16 01:18:25', 'Entregue', 1),
(3, 3, 3, '2025-06-16 01:18:25', 'Entregue', 1),
(5, 1, 1, '2025-06-17 21:08:51', 'Entregue', 1),
(6, 1, 1, '2025-06-17 18:53:24', 'Entregue', 2),
(7, 1, 1, '2025-06-17 22:17:04', 'Entregue', 2),
(8, 1, 1, '2025-06-17 22:17:49', 'Pendente', 2),
(9, 1, 1, '2025-06-17 22:18:15', 'Pendente', 2),
(10, 3, 1, '2025-06-17 22:24:41', 'Pendente', 1),
(11, 3, 1, '2025-06-17 22:25:32', 'Pendente', 1),
(12, 3, 1, '2025-06-17 22:27:33', 'Pendente', 1),
(13, 3, 2, '2025-06-17 22:32:15', 'Pendente', 2),
(14, 3, 2, '2025-06-17 22:32:53', 'Pendente', 2),
(15, 3, 2, '2025-06-17 22:33:34', 'Pendente', 2),
(16, 2, 1, '2025-06-17 22:49:57', 'Pendente', 2),
(17, 1, 1, '2025-06-17 22:51:07', 'Pendente', 2),
(18, 2, 1, '2025-06-17 22:52:03', 'Pendente', 2),
(19, 1, 4, '2025-06-17 22:52:48', 'Pendente', 2),
(20, 4, 1, '2025-06-18 00:31:03', 'Pendente', 2),
(21, 1, 1, '2025-06-18 00:32:27', 'Pendente', 1),
(22, 1, 4, '2025-06-18 00:33:24', 'Pendente', 2),
(23, 4, 4, '2025-06-18 00:34:39', 'Entregue', 2),
(24, 1, 4, '2025-06-18 00:41:56', 'Entregue', 2),
(25, 3, 3, '2025-06-18 00:43:28', 'Pendente', 2),
(26, 2, 3, '2025-06-18 00:46:40', 'Entregue', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos_itens`
--

CREATE TABLE `pedidos_itens` (
  `item_id` int NOT NULL,
  `pedido_id` int NOT NULL,
  `produto_id` int NOT NULL,
  `quantidade` int NOT NULL,
  `preco_unitario` float(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pedidos_itens`
--

INSERT INTO `pedidos_itens` (`item_id`, `pedido_id`, `produto_id`, `quantidade`, `preco_unitario`) VALUES
(3, 2, 3, 3, 9.50),
(6, 3, 1, 1, 0.00),
(7, 3, 3, 2, 0.00),
(8, 3, 2, 1, 0.00),
(9, 5, 1, 1, 0.00),
(10, 1, 1, 2, 0.00),
(11, 1, 2, 1, 0.00),
(14, 8, 1, 1, 0.00),
(15, 8, 2, 1, 0.00),
(16, 9, 1, 1, 0.00),
(17, 9, 2, 1, 0.00),
(18, 10, 1, 1, 0.00),
(19, 11, 1, 1, 0.00),
(20, 12, 1, 1, 0.00),
(21, 13, 1, 1, 0.00),
(22, 14, 1, 1, 0.00),
(23, 15, 1, 1, 0.00),
(24, 16, 1, 1, 0.00),
(25, 17, 1, 1, 0.00),
(26, 18, 1, 1, 0.00),
(27, 19, 1, 1, 0.00),
(30, 21, 2, 1, 0.00),
(31, 21, 3, 1, 0.00),
(32, 21, 2, 1, 0.00),
(33, 22, 1, 1, 0.00),
(34, 20, 2, 1, 0.00),
(35, 20, 3, 1, 0.00),
(40, 23, 1, 1, 0.00),
(41, 7, 1, 1, 0.00),
(42, 7, 2, 1, 0.00),
(43, 24, 1, 1, 0.00),
(44, 25, 1, 1, 0.00),
(45, 26, 1, 1, 0.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `produtos_id` int NOT NULL,
  `produtos_nome` varchar(255) NOT NULL,
  `produtos_descricao` text NOT NULL,
  `produtos_preco_custo` float(9,2) NOT NULL,
  `produtos_preco_venda` float(9,2) NOT NULL,
  `produtos_categoria_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`produtos_id`, `produtos_nome`, `produtos_descricao`, `produtos_preco_custo`, `produtos_preco_venda`, `produtos_categoria_id`) VALUES
(1, 'X-Burguer', 'Delicioso hambúrguer com queijo e salada.', 8.76, 15.13, 1),
(2, 'Suco de Laranja', 'Suco natural de laranja, 300ml.', 3.00, 7.00, 2),
(3, 'Pudim', 'Pudim de leite condensado com calda de caramelo.', 4.00, 9.50, 3);

--
-- Acionadores `produtos`
--
DELIMITER $$
CREATE TRIGGER `trg_produto_insert` AFTER INSERT ON `produtos` FOR EACH ROW BEGIN
  INSERT INTO estoques (produto_id, quantidade) VALUES (NEW.produtos_id, 1);
END
$$
DELIMITER ;

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

INSERT INTO `usuarios` (`usuarios_id`, `usuarios_nome`, `usuarios_email`, `usuarios_senha`, `usuarios_data_cadastro`, `usuarios_nivel`) VALUES
(1, 'Eric Gomes', 'eric@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '2025-06-16', 3),
(2, 'Adauto Turibio', 'adauto@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '2025-06-16', 3),
(3, 'Carlos Silva', 'carlos@gmail.com', 'abc123', '2025-06-16', 2),
(4, 'Mariana Souza', 'mariana@gmail.com', 'def456', '2025-06-16', 2),
(5, 'João Pedro', 'joao@gmail.com', 'ghi789', '2025-06-16', 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categorias_id`);

--
-- Índices de tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`cidades_id`);

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
-- Índices de tabela `entregador`
--
ALTER TABLE `entregador`
  ADD PRIMARY KEY (`id_entregador`);

--
-- Índices de tabela `estoques`
--
ALTER TABLE `estoques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `endereco_id` (`endereco_id`),
  ADD KEY `entregador_id` (`entregador_id`);

--
-- Índices de tabela `pedidos_itens`
--
ALTER TABLE `pedidos_itens`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produtos_id`),
  ADD KEY `fk_produto_categoria` (`produtos_categoria_id`);

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
  MODIFY `categorias_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `cidades_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_clientes` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `endereco_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `entregador`
--
ALTER TABLE `entregador`
  MODIFY `id_entregador` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estoques`
--
ALTER TABLE `estoques`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `nivel`
--
ALTER TABLE `nivel`
  MODIFY `id_nivel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedido_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `pedidos_itens`
--
ALTER TABLE `pedidos_itens`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtos_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`usuario_cliente`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`endereco_cidade_id`) REFERENCES `cidades` (`cidades_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `endereco_ibfk_2` FOREIGN KEY (`endereco_usuario_id`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Restrições para tabelas `estoques`
--
ALTER TABLE `estoques`
  ADD CONSTRAINT `estoques_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`produtos_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `entregador_id` FOREIGN KEY (`entregador_id`) REFERENCES `entregador` (`id_entregador`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id_clientes`) ON DELETE RESTRICT,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`endereco_id`) ON DELETE RESTRICT;

--
-- Restrições para tabelas `pedidos_itens`
--
ALTER TABLE `pedidos_itens`
  ADD CONSTRAINT `pedidos_itens_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`pedido_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedidos_itens_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`produtos_id`) ON DELETE RESTRICT;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`produtos_categoria_id`) REFERENCES `categorias` (`categorias_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`usuarios_nivel`) REFERENCES `nivel` (`id_nivel`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;