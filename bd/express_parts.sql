-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26/09/2024 às 15:42
-- Versão do servidor: 8.3.0
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `cars`
--

INSERT INTO `cars` (`id`, `name`, `brand`, `model`, `active`, `created`, `modified`, `modified_by`, `users_id`) VALUES
(1, 'BMW X1', 'BMW AG', 'X1', 1, '2024-09-25 16:09:29', '2024-09-25 16:09:29', 'admin', 1),
(2, 'Fiat Strada', 'Fiat', 'Strada', 1, '2024-09-25 16:17:52', '2024-09-25 16:17:52', 'admin', 1),
(3, 'HYUNDAI ', 'HYUNDAI', 'HB20 ', 1, '2024-09-25 16:18:07', '2024-09-25 16:18:07', 'admin', 1),
(4, 'Fiat Mobi', 'Fiat', 'Mobi', 1, '2024-09-25 16:18:21', '2024-09-25 16:18:21', 'admin', 1),
(5, 'Renault Kwid', 'Renault', 'Kwid', 1, '2024-09-25 16:18:35', '2024-09-25 16:18:35', 'admin', 1),
(6, 'BMW X1', 'BMW AG', 'X1', 1, '2024-09-26 14:22:29', '2024-09-26 14:22:29', 'admin', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `parts`
--

DROP TABLE IF EXISTS `parts`;
CREATE TABLE IF NOT EXISTS `parts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `stock` int NOT NULL,
  `discount` int DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `users_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parts_users1_idx` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `parts`
--

INSERT INTO `parts` (`id`, `name`, `image`, `price`, `stock`, `discount`, `active`, `created`, `modified`, `modified_by`, `users_id`) VALUES
(1, 'Volante', 'download.jpg', 2500, 2, NULL, 1, '2024-09-25 16:09:48', '2024-09-25 16:09:48', 'admin', 1),
(3, 'Volante', 'download.jpg', 2500, 2, NULL, 1, '2024-09-25 17:32:56', '2024-09-25 17:32:56', 'admin', 1),
(4, 'Volante', 'download.jpg', 2500, 2, NULL, 1, '2024-09-25 18:00:02', '2024-09-25 18:00:02', 'admin', 1),
(5, 'Volante', 'download.jpg', 1000, 1, NULL, 1, '2024-09-25 18:08:35', '2024-09-25 18:08:35', 'admin', 1),
(6, 'Volante', 'download.jpg', 2500, 2, NULL, 1, '2024-09-25 18:54:21', '2024-09-25 18:54:21', 'admin', 1),
(7, 'Volante', 'download.jpg', 2500, 2, NULL, 1, '2024-09-25 19:26:12', '2024-09-25 19:26:12', 'admin', 1),
(8, 'Volante', '1727292524_download (1).jpg', 2500, 2, 5, 1, '2024-09-25 19:28:44', '2024-09-25 19:28:44', 'admin', 1),
(9, 'Volante', '1727362220_download.jpg', 2500, 2, 10, 1, '2024-09-26 14:50:20', '2024-09-26 14:50:20', 'admin', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `parts_cars`
--

DROP TABLE IF EXISTS `parts_cars`;
CREATE TABLE IF NOT EXISTS `parts_cars` (
  `parts_id` int NOT NULL,
  `cars_id` int NOT NULL,
  PRIMARY KEY (`parts_id`,`cars_id`),
  KEY `fk_parts_has_cars_cars1_idx` (`cars_id`),
  KEY `fk_parts_has_cars_parts1_idx` (`parts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `parts_cars`
--

INSERT INTO `parts_cars` (`parts_id`, `cars_id`) VALUES
(3, 2),
(4, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(3, 3),
(4, 3),
(5, 3),
(7, 3),
(4, 4),
(6, 4),
(5, 5),
(8, 5);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `active`, `created`, `modified`, `modified_by`) VALUES
(1, 'admin', 'admin', '$2y$10$bSrGFpPoohDaIXjlg/K9X.V3eO2SE0./MuU/H9Wwu3B.q2oCbnJUa', 0, 1, '2024-09-25 16:05:33', '2024-09-25 16:05:33', NULL);

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
  ADD CONSTRAINT `fk_parts_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `parts_cars`
--
ALTER TABLE `parts_cars`
  ADD CONSTRAINT `fk_parts_has_cars_cars1` FOREIGN KEY (`cars_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `fk_parts_has_cars_parts1` FOREIGN KEY (`parts_id`) REFERENCES `parts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;