-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 20/09/2024 às 16:58
-- Versão do servidor: 8.2.0
-- Versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `express_parts`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `users_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cars_users1_idx` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `parts`
--

DROP TABLE IF EXISTS `parts`;
CREATE TABLE IF NOT EXISTS `parts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `preco` double NOT NULL,
  `quantity` int NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `users_id` int NOT NULL,
  `cars_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parts_users1_idx` (`users_id`),
  KEY `fk_parts_cars1_idx` (`cars_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `active`, `created`, `modified`, `modified_by`) VALUES
(1, 'admin', 'admin', '$2y$10$PlE6rHaXQAtUwplDBS0QbO/.EqP6slAm4WAW2HVDGfTcGip9hJNi6', 0, 1, '2024-09-19 11:36:41', '2024-09-19 11:36:41', 'Rabello'),
(2, 'gabriel', 'gabriel', '123', 0, 1, '2024-09-20 14:45:22', '2024-09-20 14:45:22', 'gabriel'),
(3, 'gabriel', 'user', 'EqP6slAm4WAW2HVDGfTcGip9hJNi6*', 0, 1, '2024-09-20 14:47:17', '2024-09-20 14:47:17', 'rabellog');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `fk_cars_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `fk_parts_cars1` FOREIGN KEY (`cars_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `fk_parts_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
