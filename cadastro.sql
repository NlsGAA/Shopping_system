-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/03/2024 às 16:57
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`) VALUES
(170, 1, 31),
(171, 1, 4),
(172, 1, 30),
(173, 1, 30),
(174, 1, 30),
(175, 1, 4),
(176, 1, 30),
(177, 1, 30);

-- --------------------------------------------------------

--
-- Estrutura para tabela `company_register`
--

CREATE TABLE `company_register` (
  `id` int(11) NOT NULL,
  `type_user` varchar(255) DEFAULT NULL,
  `cnpj` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `fantasyName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `company_register`
--

INSERT INTO `company_register` (`id`, `type_user`, `cnpj`, `address`, `companyName`, `fantasyName`, `email`, `password`) VALUES
(1, 'legal', '1235260000165', 'Rua Tortuguita ', 'Hamburguer Fries LTDA ', 'Hamburguer Fries', 'hamburguer@fries.com', 'd785450c4917ce5d516314fb875ed16b');

-- --------------------------------------------------------

--
-- Estrutura para tabela `costumer_register`
--

CREATE TABLE `costumer_register` (
  `id` int(11) NOT NULL,
  `type_user` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `costumer_register`
--

INSERT INTO `costumer_register` (`id`, `type_user`, `cpf`, `birthdate`, `address`, `email`, `password`) VALUES
(8, 'physical', '13175961263', '2003-06-27', 'Rua. Sonho de valsa', 'nicolas@admin.com', 'cfa96cfe4e39a32867a1929bd00742bb'),
(15, 'physical', '222', '1233-03-25', 'teste', 'teste@teste.com', '698dc19d489c4e4db73e28a713eab07b');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

CREATE TABLE `itens` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens`
--

INSERT INTO `itens` (`id`, `title`, `description`, `value`) VALUES
(4, 'Hamburguer', 'Pão, maionese e hambuguer', '23.00'),
(30, 'Test', 'Test', '1.00'),
(31, 'A', 'A', '3.50'),
(32, 'Ola', 'Aaa', '22.00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_product_opnion`
--

CREATE TABLE `user_product_opnion` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_commentary` text DEFAULT NULL,
  `creation_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `user_product_opnion`
--

INSERT INTO `user_product_opnion` (`id`, `user_id`, `user_name`, `product_id`, `user_commentary`, `creation_time`) VALUES
(14, 1, 'hamburguer', 4, 'Teste de horas\r\n', '2024-03-08 18:27:33'),
(15, 1, 'hamburguer', 4, 'mais um teste', '2024-03-08 18:27:39'),
(16, 8, 'nicolas', 4, 'Uma coisa qualquer', '2024-03-08 18:32:27');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_ibfk_1` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices de tabela `company_register`
--
ALTER TABLE `company_register`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `costumer_register`
--
ALTER TABLE `costumer_register`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `user_product_opnion`
--
ALTER TABLE `user_product_opnion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT de tabela `company_register`
--
ALTER TABLE `company_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `costumer_register`
--
ALTER TABLE `costumer_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `user_product_opnion`
--
ALTER TABLE `user_product_opnion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `itens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
