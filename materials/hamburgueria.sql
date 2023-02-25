-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 24-Fev-2023 às 18:50
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hamburgueria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `c_id_google` int DEFAULT NULL,
  `c_id_facebook` int DEFAULT NULL,
  `c_nome` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `c_telefone` text,
  `c_senha` binary(60) DEFAULT NULL,
  `c_cep` int DEFAULT NULL,
  `c_logradouro` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `c_numero` int DEFAULT NULL,
  `c_bairro` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `c_purl` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `c_ativo` tinyint NOT NULL DEFAULT '0',
  `c_ofertas` tinyint NOT NULL DEFAULT '0',
  `c_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `c_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `c_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `pd_id` int NOT NULL AUTO_INCREMENT,
  `pd_id_cliente` int NOT NULL,
  `pd_codigo` varchar(12) DEFAULT NULL,
  `pd_cupom` varchar(12) DEFAULT NULL,
  `pd_observacao` text NOT NULL,
  `pd_status` tinyint NOT NULL DEFAULT '0',
  `pd_pagamento` text,
  `pd_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pd_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pd_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_produtos`
--

DROP TABLE IF EXISTS `pedidos_produtos`;
CREATE TABLE IF NOT EXISTS `pedidos_produtos` (
  `pdp_id` int NOT NULL AUTO_INCREMENT,
  `pdp_id_cliente` int NOT NULL,
  `pdp_id_produto` int NOT NULL,
  `pdp_qtd` int NOT NULL,
  `pdp_codigo` varchar(12) DEFAULT NULL,
  `pdp_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pdp_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pdp_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pdp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `p_nome` text NOT NULL,
  `p_descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `p_imagem` varchar(50) NOT NULL,
  `p_preco` decimal(5,0) NOT NULL,
  `p_categoria` tinyint NOT NULL DEFAULT '0',
  `p_disponivel` enum('0','1') NOT NULL,
  `p_estoque` int NOT NULL,
  `p_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`p_id`, `p_nome`, `p_descricao`, `p_imagem`, `p_preco`, `p_categoria`, `p_disponivel`, `p_estoque`, `p_created_at`, `p_updated_at`, `p_deleted_at`) VALUES
(1, 'Hamburguer Junior', 'Hamburguer simples com pão e carne', 'hamburguer1', '15', 0, '1', 0, '2023-02-18 10:47:12', '2023-02-18 10:47:12', '2023-02-18 10:47:12'),
(2, 'Disco completo', 'Calabresa, fritas e salgadinhos', 'hamburguer2', '25', 0, '0', 0, '2023-02-18 10:47:12', '2023-02-18 10:47:12', '2023-02-18 10:47:12'),
(3, 'X Egg', 'Pão, ovo, bacon', 'hamburguer3', '35', 0, '1', 0, '2023-02-18 10:47:12', '2023-02-18 10:47:12', '2023-02-18 10:47:12'),
(4, 'X Egg', 'Pão, ovo, bacon', 'hamburguer4', '35', 0, '0', 0, '2023-02-18 10:47:12', '2023-02-18 10:47:12', '2023-02-18 10:47:12'),
(5, 'X Duplo Bacon', 'Bacon, ovo, carne', 'hamburguer5', '40', 0, '1', 0, '2023-02-18 10:47:12', '2023-02-18 10:47:12', '2023-02-18 10:47:12'),
(6, 'X Duplo Bacon', 'Bacon, ovo, carne', 'hamburguer6', '40', 0, '1', 0, '2023-02-18 10:47:12', '2023-02-18 10:47:12', '2023-02-18 10:47:12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
