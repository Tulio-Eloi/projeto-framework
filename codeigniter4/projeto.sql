-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3309
-- Tempo de geração: 10/04/2025 às 01:30
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `categorias_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`categorias_id`) VALUES
(1);

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
(1, 'rialma', 'GO'),
(3, 'Ceres', 'Go');

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarios_id` int NOT NULL,
  `usuarios_nome` varchar(255) NOT NULL,
  `usuarios_sobrenome` varchar(255) NOT NULL,
  `usuarios_email` varchar(255) NOT NULL,
  `usuarios_cpf` varchar(14) NOT NULL,
  `usuarios_data_nasc` date NOT NULL,
  `usuarios_nivel` int NOT NULL,
  `usuarios_fone` varchar(15) NOT NULL,
  `usuarios_senha` varchar(32) NOT NULL,
  `usuarios_data_cadastro` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `usuarios_nome`, `usuarios_sobrenome`, `usuarios_email`, `usuarios_cpf`, `usuarios_data_nasc`, `usuarios_nivel`, `usuarios_fone`, `usuarios_senha`, `usuarios_data_cadastro`) VALUES
(1, 'teste', 'teste', 'teste@gmail.com', '999999999', '2003-09-05', 0, '9999999999', 'e10adc3949ba59abbe56e057f20f883e', 1);

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
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`endereco_id`),
  ADD KEY `endereco_cidade_id` (`endereco_cidade_id`),
  ADD KEY `endereco_usuario_id` (`endereco_usuario_id`);

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
  ADD PRIMARY KEY (`usuarios_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categorias_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `cidades_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `endereco_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtos_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
