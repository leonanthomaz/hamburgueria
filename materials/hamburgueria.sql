-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 19-Fev-2023 às 19:17
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
  `c_nome` text NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `c_telefone` text NOT NULL,
  `c_senha` binary(60) NOT NULL,
  `c_cep` int NOT NULL,
  `c_logradouro` varchar(50) NOT NULL,
  `c_bairro` text NOT NULL,
  `c_purl` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `c_ativo` tinyint NOT NULL DEFAULT '0',
  `c_created_at` datetime NOT NULL,
  `c_updated_at` datetime NOT NULL,
  `c_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`c_id`, `c_nome`, `c_email`, `c_telefone`, `c_senha`, `c_cep`, `c_logradouro`, `c_bairro`, `c_purl`, `c_ativo`, `c_created_at`, `c_updated_at`, `c_deleted_at`) VALUES
(1, 'Leonan', 'leonan.email@gmail.com', '21999999999', 0x2432792431302446496538644b5458654b314f71654433632f4e66484f32315369503558467a352e6f507774586d757869514b59426e67747a344836, 20531390, 'Estrada Tijuacu', 'Alto da Boa Vista', '', 1, '2023-02-19 10:53:21', '2023-02-19 10:53:58', NULL);

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
(2, 'Disco completo', 'Calabresa, fritas e salgadinhos', 'hamburguer2', '25', 0, '1', 0, '2023-02-18 10:47:12', '2023-02-18 10:47:12', '2023-02-18 10:47:12'),
(3, 'X Egg', 'Pão, ovo, bacon', 'hamburguer3', '35', 0, '1', 0, '2023-02-18 10:47:12', '2023-02-18 10:47:12', '2023-02-18 10:47:12'),
(4, 'X Egg', 'Pão, ovo, bacon', '', '35', 0, '0', 0, '2023-02-18 10:47:12', '2023-02-18 10:47:12', '2023-02-18 10:47:12'),
(5, 'X Duplo Bacon', 'Bacon, ovo, carne', '', '40', 0, '0', 0, '2023-02-18 10:47:12', '2023-02-18 10:47:12', '2023-02-18 10:47:12'),
(6, 'X Duplo Bacon', 'Bacon, ovo, carne', '', '40', 0, '0', 0, '2023-02-18 10:47:12', '2023-02-18 10:47:12', '2023-02-18 10:47:12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
