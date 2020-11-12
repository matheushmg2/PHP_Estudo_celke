-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Nov-2020 às 11:55
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `adm_pratica`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_cadastrar_usuarios`
--

CREATE TABLE `adm_cadastrar_usuarios` (
  `id` int(11) NOT NULL,
  `enviado_email_confirmado` int(11) NOT NULL,
  `adm_niveis_acessos_id` int(11) NOT NULL,
  `adm_situacoes_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adm_cadastrar_usuarios`
--

INSERT INTO `adm_cadastrar_usuarios` (`id`, `enviado_email_confirmado`, `adm_niveis_acessos_id`, `adm_situacoes_id`, `created`, `modified`) VALUES
(1, 1, 5, 3, '2020-05-20 00:04:09', '2020-07-06 15:59:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_confirmar_emails`
--

CREATE TABLE `adm_confirmar_emails` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `host` varchar(220) NOT NULL,
  `usuario` varchar(220) NOT NULL,
  `senha` varchar(220) NOT NULL,
  `smtp_secure` varchar(220) NOT NULL,
  `porta` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adm_confirmar_emails`
--

INSERT INTO `adm_confirmar_emails` (`id`, `nome`, `email`, `host`, `usuario`, `senha`, `smtp_secure`, `porta`, `created`, `modified`) VALUES
(1, 'Suporte Administrativo de E-mail', 'suport.personal18@gmail.com', 'smtp.gmail.com', 'suport.personal18@gmail.com', 'senha do email', 'tls', 587, '2020-06-01 14:28:44', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_cores`
--

CREATE TABLE `adm_cores` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `cor` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adm_cores`
--

INSERT INTO `adm_cores` (`id`, `nome`, `cor`, `created`, `modified`) VALUES
(1, 'Azul', 'primary', '2020-05-19 23:49:20', NULL),
(2, 'Cinza', 'secondary', '2020-05-19 23:49:20', NULL),
(3, 'Verde', 'success', '2020-05-19 23:49:20', NULL),
(4, 'Vermelho', 'danger', '2020-05-19 23:49:20', NULL),
(5, 'Laranja', 'warning', '2020-05-19 23:49:20', NULL),
(6, 'Azul Claro', 'info', '2020-05-19 23:49:20', NULL),
(7, 'Claro', 'light', '2020-05-19 23:49:20', NULL),
(8, 'Cinza Escuro', 'dark', '2020-05-19 23:49:20', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_grupos_paginas`
--

CREATE TABLE `adm_grupos_paginas` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adm_grupos_paginas`
--

INSERT INTO `adm_grupos_paginas` (`id`, `nome`, `ordem`, `created`, `modified`) VALUES
(1, 'Listar', 1, '2020-05-20 00:07:55', '2020-07-08 14:55:31'),
(2, 'Cadastrar', 2, '2020-05-20 00:07:55', '2020-07-08 14:55:40'),
(3, 'Editar', 3, '2020-05-20 00:07:55', '2020-07-08 14:55:40'),
(4, 'Apagar', 4, '2020-05-20 00:07:55', NULL),
(5, 'Visualizar', 5, '2020-05-20 00:07:55', NULL),
(6, 'Outros', 6, '2020-05-20 00:07:55', NULL),
(7, 'Acesso', 7, '2020-05-20 00:07:55', '2020-07-08 14:55:27'),
(8, 'Alterar Ordem', 8, '2020-05-20 00:07:55', '2020-07-08 14:55:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_menus`
--

CREATE TABLE `adm_menus` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `icones` varchar(45) NOT NULL,
  `ordem` int(11) NOT NULL,
  `adm_situacoes_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='					';

--
-- Extraindo dados da tabela `adm_menus`
--

INSERT INTO `adm_menus` (`id`, `nome`, `icones`, `ordem`, `adm_situacoes_id`, `created`, `modified`) VALUES
(1, 'Home', 'fas fa-tachometer-alt', 1, 1, '2020-05-20 00:14:20', '2020-07-06 15:13:34'),
(2, 'Usuário', 'fas fa-user', 2, 1, '2020-05-20 00:14:20', '2020-07-06 15:16:01'),
(3, 'Configuração', 'fas fa-cogs', 3, 1, '2020-05-20 00:14:20', '2020-07-06 15:17:39'),
(4, 'Sair', 'fas fa-sign-out-alt', 4, 1, '2020-05-20 00:14:20', '2020-07-06 15:17:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_niveis_acessos`
--

CREATE TABLE `adm_niveis_acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adm_niveis_acessos`
--

INSERT INTO `adm_niveis_acessos` (`id`, `nome`, `ordem`, `created`, `modified`) VALUES
(1, 'Super Administrador', 1, '2020-05-19 23:49:11', NULL),
(2, 'Administrador', 2, '2020-05-19 23:49:11', '2020-07-02 15:58:31'),
(3, 'Colaborador', 3, '2020-05-19 23:49:11', '2020-07-02 15:58:31'),
(4, 'Financeiro', 4, '2020-07-02 15:50:05', NULL),
(5, 'Cliente', 5, '2020-07-02 15:59:33', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_nivel_acesso_paginas`
--

CREATE TABLE `adm_nivel_acesso_paginas` (
  `id` int(11) NOT NULL,
  `permissao` int(11) NOT NULL,
  `ordem` int(11) NOT NULL,
  `dropdown` int(11) NOT NULL,
  `liberado_menu` int(11) NOT NULL,
  `adm_menus_id` int(11) NOT NULL,
  `adm_niveis_acessos_id` int(11) NOT NULL,
  `adm_paginas_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adm_nivel_acesso_paginas`
--

INSERT INTO `adm_nivel_acesso_paginas` (`id`, `permissao`, `ordem`, `dropdown`, `liberado_menu`, `adm_menus_id`, `adm_niveis_acessos_id`, `adm_paginas_id`, `created`, `modified`) VALUES
(1, 1, 1, 2, 1, 1, 1, 1, '2020-05-20 20:17:57', '2020-07-03 02:46:30'),
(2, 1, 2, 1, 1, 2, 1, 2, '2020-07-02 03:01:27', '2020-07-02 03:06:32'),
(3, 1, 3, 1, 1, 3, 1, 17, '2020-07-02 03:03:29', '2020-07-03 02:43:38'),
(4, 1, 4, 1, 1, 3, 1, 23, '2020-07-02 03:04:56', '2020-07-02 03:06:25'),
(5, 1, 5, 2, 2, 3, 1, 33, '2020-07-02 11:05:24', '2020-07-02 16:11:42'),
(7, 1, 6, 2, 2, 2, 1, 3, '2020-07-02 15:32:45', '2020-07-03 02:23:15'),
(8, 1, 7, 2, 1, 4, 1, 4, '2020-07-02 15:32:46', '2020-07-02 16:07:53'),
(9, 1, 8, 2, 2, 2, 1, 5, '2020-07-02 15:32:46', NULL),
(10, 1, 9, 2, 2, 2, 1, 6, '2020-07-02 15:32:46', NULL),
(11, 1, 10, 2, 2, 2, 1, 7, '2020-07-02 15:32:46', NULL),
(12, 1, 11, 2, 2, 2, 1, 8, '2020-07-02 15:32:46', NULL),
(13, 1, 12, 2, 2, 2, 1, 9, '2020-07-02 15:32:46', NULL),
(14, 1, 13, 2, 2, 2, 1, 10, '2020-07-02 15:32:46', NULL),
(15, 1, 14, 2, 2, 2, 1, 11, '2020-07-02 15:32:46', NULL),
(16, 1, 15, 2, 2, 2, 1, 12, '2020-07-02 15:32:46', NULL),
(17, 1, 16, 2, 2, 2, 1, 13, '2020-07-02 15:32:46', NULL),
(18, 1, 17, 2, 2, 2, 1, 14, '2020-07-02 15:32:46', NULL),
(19, 1, 18, 2, 2, 2, 1, 15, '2020-07-02 15:32:46', NULL),
(20, 1, 19, 2, 2, 2, 1, 16, '2020-07-02 15:32:46', NULL),
(21, 1, 20, 2, 2, 2, 1, 18, '2020-07-02 15:32:46', NULL),
(22, 1, 21, 2, 2, 2, 1, 19, '2020-07-02 15:32:46', NULL),
(23, 1, 22, 2, 2, 2, 1, 20, '2020-07-02 15:32:46', NULL),
(24, 1, 23, 2, 2, 2, 1, 21, '2020-07-02 15:32:46', NULL),
(25, 1, 24, 2, 2, 2, 1, 22, '2020-07-02 15:32:47', NULL),
(26, 1, 25, 2, 2, 2, 1, 24, '2020-07-02 15:32:47', NULL),
(27, 1, 26, 2, 2, 2, 1, 25, '2020-07-02 15:32:47', NULL),
(28, 1, 27, 2, 2, 2, 1, 26, '2020-07-02 15:32:47', NULL),
(29, 1, 28, 2, 2, 2, 1, 27, '2020-07-02 15:32:47', NULL),
(30, 1, 29, 2, 2, 2, 1, 28, '2020-07-02 15:32:47', NULL),
(31, 1, 30, 2, 2, 2, 1, 29, '2020-07-02 15:32:47', NULL),
(32, 1, 31, 2, 2, 2, 1, 30, '2020-07-02 15:32:47', NULL),
(33, 1, 32, 2, 2, 2, 1, 31, '2020-07-02 15:32:47', NULL),
(34, 1, 33, 2, 2, 2, 1, 32, '2020-07-02 15:32:47', NULL),
(35, 1, 34, 2, 1, 1, 2, 1, '2020-07-02 15:32:47', '2020-07-03 02:49:36'),
(36, 1, 35, 1, 1, 2, 2, 2, '2020-07-02 15:32:47', '2020-07-03 02:47:00'),
(37, 1, 36, 2, 2, 2, 2, 3, '2020-07-02 15:32:47', NULL),
(38, 1, 37, 2, 1, 4, 2, 4, '2020-07-02 15:32:47', '2020-07-03 02:50:31'),
(39, 1, 38, 2, 2, 2, 2, 5, '2020-07-02 15:32:47', NULL),
(40, 1, 39, 2, 2, 2, 2, 6, '2020-07-02 15:32:47', NULL),
(41, 1, 40, 2, 2, 2, 2, 7, '2020-07-02 15:32:48', NULL),
(42, 1, 41, 2, 2, 2, 2, 8, '2020-07-02 15:32:48', NULL),
(43, 1, 42, 2, 2, 2, 2, 9, '2020-07-02 15:32:48', '2020-07-03 02:47:18'),
(44, 1, 43, 2, 2, 2, 2, 10, '2020-07-02 15:32:48', '2020-07-03 02:51:41'),
(45, 1, 44, 2, 2, 2, 2, 11, '2020-07-02 15:32:48', '2020-07-03 02:47:30'),
(46, 1, 45, 2, 2, 2, 2, 12, '2020-07-02 15:32:48', '2020-07-03 02:47:32'),
(47, 2, 46, 2, 2, 2, 2, 13, '2020-07-02 15:32:48', '2020-07-03 02:52:23'),
(48, 1, 47, 2, 2, 2, 2, 14, '2020-07-02 15:32:48', '2020-07-03 02:53:20'),
(49, 1, 48, 2, 2, 2, 2, 15, '2020-07-02 15:32:48', '2020-07-03 02:47:39'),
(50, 2, 49, 2, 2, 2, 2, 16, '2020-07-02 15:32:48', NULL),
(51, 1, 50, 1, 1, 3, 2, 17, '2020-07-02 15:32:48', '2020-07-03 02:49:23'),
(52, 2, 51, 2, 2, 2, 2, 18, '2020-07-02 15:32:48', NULL),
(53, 2, 52, 2, 2, 2, 2, 19, '2020-07-02 15:32:48', NULL),
(54, 1, 53, 2, 2, 2, 2, 20, '2020-07-02 15:32:48', '2020-07-03 02:47:55'),
(55, 2, 54, 2, 2, 2, 2, 21, '2020-07-02 15:32:48', NULL),
(56, 2, 55, 2, 2, 2, 2, 22, '2020-07-02 15:32:48', NULL),
(57, 1, 56, 2, 2, 2, 2, 23, '2020-07-02 15:32:48', '2020-07-03 02:48:02'),
(58, 1, 57, 2, 2, 2, 2, 24, '2020-07-02 15:32:48', '2020-07-03 02:48:07'),
(59, 2, 58, 2, 2, 2, 2, 25, '2020-07-02 15:32:48', NULL),
(60, 2, 59, 2, 2, 2, 2, 26, '2020-07-02 15:32:48', NULL),
(61, 2, 60, 2, 2, 2, 2, 27, '2020-07-02 15:32:48', NULL),
(62, 1, 61, 2, 2, 2, 2, 28, '2020-07-02 15:32:48', '2020-07-03 02:48:15'),
(63, 2, 62, 2, 2, 2, 2, 29, '2020-07-02 15:32:49', NULL),
(64, 2, 63, 2, 2, 2, 2, 30, '2020-07-02 15:32:49', NULL),
(65, 2, 64, 2, 2, 2, 2, 31, '2020-07-02 15:32:49', NULL),
(66, 2, 65, 2, 2, 2, 2, 32, '2020-07-02 15:32:49', NULL),
(67, 2, 66, 2, 2, 2, 2, 33, '2020-07-02 15:32:49', NULL),
(68, 2, 67, 2, 2, 2, 3, 1, '2020-07-02 15:32:49', NULL),
(69, 2, 68, 2, 2, 2, 3, 2, '2020-07-02 15:32:49', NULL),
(70, 1, 69, 2, 2, 2, 3, 3, '2020-07-02 15:32:49', NULL),
(71, 1, 70, 2, 2, 2, 3, 4, '2020-07-02 15:32:49', NULL),
(72, 1, 71, 2, 2, 2, 3, 5, '2020-07-02 15:32:49', NULL),
(73, 1, 72, 2, 2, 2, 3, 6, '2020-07-02 15:32:49', NULL),
(74, 1, 73, 2, 2, 2, 3, 7, '2020-07-02 15:32:49', NULL),
(75, 1, 74, 2, 2, 2, 3, 8, '2020-07-02 15:32:49', NULL),
(76, 2, 75, 2, 2, 2, 3, 9, '2020-07-02 15:32:50', NULL),
(77, 2, 76, 2, 2, 2, 3, 10, '2020-07-02 15:32:50', NULL),
(78, 2, 77, 2, 2, 2, 3, 11, '2020-07-02 15:32:50', NULL),
(79, 2, 78, 2, 2, 2, 3, 12, '2020-07-02 15:32:50', NULL),
(80, 2, 79, 2, 2, 2, 3, 13, '2020-07-02 15:32:50', NULL),
(81, 2, 80, 2, 2, 2, 3, 14, '2020-07-02 15:32:50', NULL),
(82, 2, 81, 2, 2, 2, 3, 15, '2020-07-02 15:32:50', NULL),
(83, 2, 82, 2, 2, 2, 3, 16, '2020-07-02 15:32:50', NULL),
(84, 1, 83, 2, 2, 2, 3, 17, '2020-07-02 15:32:50', NULL),
(85, 2, 84, 2, 2, 2, 3, 18, '2020-07-02 15:32:50', NULL),
(86, 2, 85, 2, 2, 2, 3, 19, '2020-07-02 15:32:50', NULL),
(87, 2, 86, 2, 2, 2, 3, 20, '2020-07-02 15:32:50', NULL),
(88, 2, 87, 2, 2, 2, 3, 21, '2020-07-02 15:32:50', NULL),
(89, 2, 88, 2, 2, 2, 3, 22, '2020-07-02 15:32:50', NULL),
(90, 2, 89, 2, 2, 2, 3, 23, '2020-07-02 15:32:50', NULL),
(91, 2, 90, 2, 2, 2, 3, 24, '2020-07-02 15:32:50', NULL),
(92, 2, 91, 2, 2, 2, 3, 25, '2020-07-02 15:32:51', NULL),
(93, 2, 92, 2, 2, 2, 3, 26, '2020-07-02 15:32:51', NULL),
(94, 2, 93, 2, 2, 2, 3, 27, '2020-07-02 15:32:51', NULL),
(95, 2, 94, 2, 2, 2, 3, 28, '2020-07-02 15:32:51', NULL),
(96, 2, 95, 2, 2, 2, 3, 29, '2020-07-02 15:32:51', NULL),
(97, 2, 96, 2, 2, 2, 3, 30, '2020-07-02 15:32:51', NULL),
(98, 2, 97, 2, 2, 2, 3, 31, '2020-07-02 15:32:51', NULL),
(99, 2, 98, 2, 2, 2, 3, 32, '2020-07-02 15:32:51', NULL),
(100, 2, 99, 2, 2, 2, 3, 33, '2020-07-02 15:32:51', NULL),
(101, 1, 100, 2, 2, 2, 4, 1, '2020-07-02 15:52:26', '2020-07-02 15:55:28'),
(102, 1, 101, 2, 2, 2, 4, 2, '2020-07-02 15:52:26', '2020-07-02 15:55:35'),
(103, 1, 102, 2, 2, 2, 4, 3, '2020-07-02 15:52:27', NULL),
(104, 1, 103, 2, 2, 2, 4, 4, '2020-07-02 15:52:27', NULL),
(105, 1, 104, 2, 2, 2, 4, 5, '2020-07-02 15:52:27', NULL),
(106, 1, 105, 2, 2, 2, 4, 6, '2020-07-02 15:52:27', NULL),
(107, 1, 106, 2, 2, 2, 4, 7, '2020-07-02 15:52:27', NULL),
(108, 1, 107, 2, 2, 2, 4, 8, '2020-07-02 15:52:27', NULL),
(109, 2, 108, 2, 2, 2, 4, 9, '2020-07-02 15:52:27', NULL),
(110, 2, 109, 2, 2, 2, 4, 10, '2020-07-02 15:52:27', NULL),
(111, 2, 110, 2, 2, 2, 4, 11, '2020-07-02 15:52:27', NULL),
(112, 2, 111, 2, 2, 2, 4, 12, '2020-07-02 15:52:27', NULL),
(113, 2, 112, 2, 2, 2, 4, 13, '2020-07-02 15:52:27', NULL),
(114, 2, 113, 2, 2, 2, 4, 14, '2020-07-02 15:52:27', NULL),
(115, 2, 114, 2, 2, 2, 4, 15, '2020-07-02 15:52:27', NULL),
(116, 2, 115, 2, 2, 2, 4, 16, '2020-07-02 15:52:27', NULL),
(117, 1, 116, 2, 2, 2, 4, 17, '2020-07-02 15:52:27', NULL),
(118, 2, 117, 2, 2, 2, 4, 18, '2020-07-02 15:52:27', NULL),
(119, 2, 118, 2, 2, 2, 4, 19, '2020-07-02 15:52:27', NULL),
(120, 2, 119, 2, 2, 2, 4, 20, '2020-07-02 15:52:28', NULL),
(121, 2, 120, 2, 2, 2, 4, 21, '2020-07-02 15:52:28', NULL),
(122, 2, 121, 2, 2, 2, 4, 22, '2020-07-02 15:52:28', NULL),
(123, 2, 122, 2, 2, 2, 4, 23, '2020-07-02 15:52:28', NULL),
(124, 2, 123, 2, 2, 2, 4, 24, '2020-07-02 15:52:28', NULL),
(125, 2, 124, 2, 2, 2, 4, 25, '2020-07-02 15:52:28', NULL),
(126, 2, 125, 2, 2, 2, 4, 26, '2020-07-02 15:52:28', NULL),
(127, 2, 126, 2, 2, 2, 4, 27, '2020-07-02 15:52:28', NULL),
(128, 2, 127, 2, 2, 2, 4, 28, '2020-07-02 15:52:28', NULL),
(129, 2, 128, 2, 2, 2, 4, 29, '2020-07-02 15:52:28', NULL),
(130, 2, 129, 2, 2, 2, 4, 30, '2020-07-02 15:52:28', NULL),
(131, 2, 130, 2, 2, 2, 4, 31, '2020-07-02 15:52:28', NULL),
(132, 2, 131, 2, 2, 2, 4, 32, '2020-07-02 15:52:28', NULL),
(133, 2, 132, 2, 2, 2, 4, 33, '2020-07-02 15:52:28', NULL),
(134, 1, 133, 2, 2, 2, 5, 1, '2020-07-02 15:59:54', '2020-07-02 16:00:02'),
(135, 1, 134, 2, 2, 2, 5, 2, '2020-07-02 15:59:54', '2020-07-02 16:03:52'),
(136, 2, 135, 2, 2, 2, 5, 3, '2020-07-02 15:59:55', '2020-07-02 16:03:55'),
(137, 1, 136, 2, 2, 2, 5, 4, '2020-07-02 15:59:55', '2020-07-02 16:06:17'),
(138, 1, 137, 2, 2, 2, 5, 5, '2020-07-02 15:59:55', NULL),
(139, 1, 138, 2, 2, 2, 5, 6, '2020-07-02 15:59:55', NULL),
(140, 1, 139, 2, 2, 2, 5, 7, '2020-07-02 15:59:55', NULL),
(141, 1, 140, 2, 2, 2, 5, 8, '2020-07-02 15:59:55', NULL),
(142, 2, 141, 2, 2, 2, 5, 9, '2020-07-02 15:59:55', NULL),
(143, 2, 142, 2, 2, 2, 5, 10, '2020-07-02 15:59:55', NULL),
(144, 2, 143, 2, 2, 2, 5, 11, '2020-07-02 15:59:55', NULL),
(145, 2, 144, 2, 2, 2, 5, 12, '2020-07-02 15:59:55', NULL),
(146, 2, 145, 2, 2, 2, 5, 13, '2020-07-02 15:59:55', NULL),
(147, 2, 146, 2, 2, 2, 5, 14, '2020-07-02 15:59:55', NULL),
(148, 2, 147, 2, 2, 2, 5, 15, '2020-07-02 15:59:55', NULL),
(149, 2, 148, 2, 2, 2, 5, 16, '2020-07-02 15:59:55', NULL),
(150, 1, 149, 2, 2, 2, 5, 17, '2020-07-02 15:59:55', NULL),
(151, 2, 150, 2, 2, 2, 5, 18, '2020-07-02 15:59:55', NULL),
(152, 2, 151, 2, 2, 2, 5, 19, '2020-07-02 15:59:55', NULL),
(153, 2, 152, 2, 2, 2, 5, 20, '2020-07-02 15:59:56', NULL),
(154, 2, 153, 2, 2, 2, 5, 21, '2020-07-02 15:59:56', NULL),
(155, 2, 154, 2, 2, 2, 5, 22, '2020-07-02 15:59:56', NULL),
(156, 2, 155, 2, 2, 2, 5, 23, '2020-07-02 15:59:56', NULL),
(157, 2, 156, 2, 2, 2, 5, 24, '2020-07-02 15:59:56', NULL),
(158, 2, 157, 2, 2, 2, 5, 25, '2020-07-02 15:59:56', NULL),
(159, 2, 158, 2, 2, 2, 5, 26, '2020-07-02 15:59:56', NULL),
(160, 2, 159, 2, 2, 2, 5, 27, '2020-07-02 15:59:56', NULL),
(161, 2, 160, 2, 2, 2, 5, 28, '2020-07-02 15:59:56', NULL),
(162, 2, 161, 2, 2, 2, 5, 29, '2020-07-02 15:59:56', NULL),
(163, 2, 162, 2, 2, 2, 5, 30, '2020-07-02 15:59:56', NULL),
(164, 2, 163, 2, 2, 2, 5, 31, '2020-07-02 15:59:56', NULL),
(165, 2, 164, 2, 2, 2, 5, 32, '2020-07-02 15:59:56', NULL),
(166, 2, 165, 2, 2, 2, 5, 33, '2020-07-02 15:59:56', NULL),
(167, 1, 166, 2, 2, 3, 1, 82, '2020-07-03 02:26:48', NULL),
(168, 2, 167, 2, 2, 3, 2, 82, '2020-07-03 02:26:49', NULL),
(169, 2, 168, 2, 2, 3, 3, 82, '2020-07-03 02:26:49', NULL),
(170, 2, 169, 2, 2, 3, 4, 82, '2020-07-03 02:26:49', NULL),
(171, 2, 170, 2, 2, 3, 5, 82, '2020-07-03 02:26:49', NULL),
(172, 1, 171, 1, 1, 3, 1, 83, '2020-07-03 14:14:08', NULL),
(173, 2, 172, 1, 1, 3, 2, 83, '2020-07-03 14:14:08', NULL),
(174, 2, 173, 1, 1, 3, 3, 83, '2020-07-03 14:14:08', NULL),
(175, 2, 174, 1, 1, 3, 4, 83, '2020-07-03 14:14:08', NULL),
(176, 2, 175, 1, 1, 3, 5, 83, '2020-07-03 14:14:08', NULL),
(177, 1, 176, 2, 2, 3, 1, 84, '2020-07-03 14:34:58', NULL),
(178, 2, 177, 2, 2, 3, 2, 84, '2020-07-03 14:34:59', NULL),
(179, 2, 178, 2, 2, 3, 3, 84, '2020-07-03 14:34:59', NULL),
(180, 2, 179, 2, 2, 3, 4, 84, '2020-07-03 14:34:59', NULL),
(181, 2, 180, 2, 2, 3, 5, 84, '2020-07-03 14:34:59', NULL),
(182, 1, 181, 2, 2, 3, 1, 85, '2020-07-03 16:47:58', NULL),
(183, 2, 182, 2, 2, 3, 2, 85, '2020-07-03 16:47:58', NULL),
(184, 2, 183, 2, 2, 3, 3, 85, '2020-07-03 16:47:58', NULL),
(185, 2, 184, 2, 2, 3, 4, 85, '2020-07-03 16:47:58', NULL),
(186, 2, 185, 2, 2, 3, 5, 85, '2020-07-03 16:47:58', NULL),
(187, 1, 186, 2, 2, 3, 1, 86, '2020-07-06 13:37:51', NULL),
(188, 2, 187, 2, 2, 3, 2, 86, '2020-07-06 13:37:51', NULL),
(189, 2, 188, 2, 2, 3, 3, 86, '2020-07-06 13:37:51', NULL),
(190, 2, 189, 2, 2, 3, 4, 86, '2020-07-06 13:37:51', NULL),
(191, 2, 190, 2, 2, 3, 5, 86, '2020-07-06 13:37:51', NULL),
(192, 1, 191, 2, 2, 3, 1, 87, '2020-07-06 14:08:16', NULL),
(193, 2, 192, 2, 2, 3, 2, 87, '2020-07-06 14:08:16', NULL),
(194, 2, 193, 2, 2, 3, 3, 87, '2020-07-06 14:08:16', NULL),
(195, 2, 194, 2, 2, 3, 4, 87, '2020-07-06 14:08:17', NULL),
(196, 2, 195, 2, 2, 3, 5, 87, '2020-07-06 14:08:17', NULL),
(197, 1, 196, 2, 2, 3, 1, 88, '2020-07-06 15:11:38', NULL),
(198, 2, 197, 2, 2, 3, 2, 88, '2020-07-06 15:11:38', NULL),
(199, 2, 198, 2, 2, 3, 3, 88, '2020-07-06 15:11:38', NULL),
(200, 2, 199, 2, 2, 3, 4, 88, '2020-07-06 15:11:38', NULL),
(201, 2, 200, 2, 2, 3, 5, 88, '2020-07-06 15:11:38', NULL),
(202, 1, 201, 1, 1, 3, 1, 89, '2020-07-06 15:57:36', NULL),
(203, 2, 202, 1, 1, 3, 2, 89, '2020-07-06 15:57:36', NULL),
(204, 2, 203, 1, 1, 3, 3, 89, '2020-07-06 15:57:36', NULL),
(205, 2, 204, 1, 1, 3, 4, 89, '2020-07-06 15:57:36', NULL),
(206, 2, 205, 1, 1, 3, 5, 89, '2020-07-06 15:57:36', NULL),
(207, 1, 206, 1, 1, 3, 1, 90, '2020-07-07 11:04:18', NULL),
(208, 2, 207, 1, 1, 3, 2, 90, '2020-07-07 11:04:18', NULL),
(209, 2, 208, 1, 1, 3, 3, 90, '2020-07-07 11:04:18', NULL),
(210, 2, 209, 1, 1, 3, 4, 90, '2020-07-07 11:04:18', NULL),
(211, 2, 210, 1, 1, 3, 5, 90, '2020-07-07 11:04:18', NULL),
(212, 1, 211, 1, 1, 3, 1, 91, '2020-07-07 11:54:37', NULL),
(213, 2, 212, 1, 1, 3, 2, 91, '2020-07-07 11:54:37', NULL),
(214, 2, 213, 1, 1, 3, 3, 91, '2020-07-07 11:54:37', NULL),
(215, 2, 214, 1, 1, 3, 4, 91, '2020-07-07 11:54:37', NULL),
(216, 2, 215, 1, 1, 3, 5, 91, '2020-07-07 11:54:37', NULL),
(217, 1, 216, 2, 2, 3, 1, 92, '2020-07-08 01:56:11', NULL),
(218, 2, 217, 2, 2, 3, 2, 92, '2020-07-08 01:56:11', NULL),
(219, 2, 218, 2, 2, 3, 3, 92, '2020-07-08 01:56:11', NULL),
(220, 2, 219, 2, 2, 3, 4, 92, '2020-07-08 01:56:11', NULL),
(221, 2, 220, 2, 2, 3, 5, 92, '2020-07-08 01:56:11', NULL),
(222, 1, 221, 2, 2, 3, 1, 93, '2020-07-08 02:06:33', NULL),
(223, 2, 222, 2, 2, 3, 2, 93, '2020-07-08 02:06:33', NULL),
(224, 2, 223, 2, 2, 3, 3, 93, '2020-07-08 02:06:33', NULL),
(225, 2, 224, 2, 2, 3, 4, 93, '2020-07-08 02:06:33', NULL),
(226, 2, 225, 2, 2, 3, 5, 93, '2020-07-08 02:06:33', NULL),
(227, 1, 226, 2, 2, 3, 1, 94, '2020-07-08 02:21:35', NULL),
(228, 2, 227, 2, 2, 3, 2, 94, '2020-07-08 02:21:35', NULL),
(229, 2, 228, 2, 2, 3, 3, 94, '2020-07-08 02:21:35', NULL),
(230, 2, 229, 2, 2, 3, 4, 94, '2020-07-08 02:21:35', NULL),
(231, 2, 230, 2, 2, 3, 5, 94, '2020-07-08 02:21:35', NULL),
(232, 1, 231, 2, 2, 3, 1, 95, '2020-07-08 02:27:06', NULL),
(233, 2, 232, 2, 2, 3, 2, 95, '2020-07-08 02:27:06', NULL),
(234, 2, 233, 2, 2, 3, 3, 95, '2020-07-08 02:27:06', NULL),
(235, 2, 234, 2, 2, 3, 4, 95, '2020-07-08 02:27:06', NULL),
(236, 2, 235, 2, 2, 3, 5, 95, '2020-07-08 02:27:06', NULL),
(237, 1, 236, 1, 1, 3, 1, 96, '2020-07-08 13:24:06', NULL),
(238, 2, 237, 1, 1, 3, 2, 96, '2020-07-08 13:24:06', NULL),
(239, 2, 238, 1, 1, 3, 3, 96, '2020-07-08 13:24:06', NULL),
(240, 2, 239, 1, 1, 3, 4, 96, '2020-07-08 13:24:06', NULL),
(241, 2, 240, 1, 1, 3, 5, 96, '2020-07-08 13:24:06', NULL),
(242, 1, 241, 2, 2, 3, 1, 97, '2020-07-08 13:25:07', NULL),
(243, 2, 242, 2, 2, 3, 2, 97, '2020-07-08 13:25:07', NULL),
(244, 2, 243, 2, 2, 3, 3, 97, '2020-07-08 13:25:07', NULL),
(245, 2, 244, 2, 2, 3, 4, 97, '2020-07-08 13:25:07', NULL),
(246, 2, 245, 2, 2, 3, 5, 97, '2020-07-08 13:25:08', NULL),
(247, 1, 246, 2, 2, 3, 1, 98, '2020-07-08 13:26:18', NULL),
(248, 2, 247, 2, 2, 3, 2, 98, '2020-07-08 13:26:18', NULL),
(249, 2, 248, 2, 2, 3, 3, 98, '2020-07-08 13:26:18', NULL),
(250, 2, 249, 2, 2, 3, 4, 98, '2020-07-08 13:26:18', NULL),
(251, 2, 250, 2, 2, 3, 5, 98, '2020-07-08 13:26:18', NULL),
(252, 1, 251, 2, 2, 3, 1, 99, '2020-07-08 13:27:36', NULL),
(253, 2, 252, 2, 2, 3, 2, 99, '2020-07-08 13:27:36', NULL),
(254, 2, 253, 2, 2, 3, 3, 99, '2020-07-08 13:27:36', NULL),
(255, 2, 254, 2, 2, 3, 4, 99, '2020-07-08 13:27:36', NULL),
(256, 2, 255, 2, 2, 3, 5, 99, '2020-07-08 13:27:36', NULL),
(257, 1, 256, 2, 2, 3, 1, 100, '2020-07-08 13:29:36', NULL),
(258, 2, 257, 2, 2, 3, 2, 100, '2020-07-08 13:29:36', NULL),
(259, 2, 258, 2, 2, 3, 3, 100, '2020-07-08 13:29:37', NULL),
(260, 2, 259, 2, 2, 3, 4, 100, '2020-07-08 13:29:37', NULL),
(261, 2, 260, 2, 2, 3, 5, 100, '2020-07-08 13:29:37', NULL),
(262, 1, 261, 2, 2, 3, 1, 101, '2020-07-08 13:31:09', NULL),
(263, 2, 262, 2, 2, 3, 2, 101, '2020-07-08 13:31:09', NULL),
(264, 2, 263, 2, 2, 3, 3, 101, '2020-07-08 13:31:09', NULL),
(265, 2, 264, 2, 2, 3, 4, 101, '2020-07-08 13:31:09', NULL),
(266, 2, 265, 2, 2, 3, 5, 101, '2020-07-08 13:31:09', NULL),
(267, 1, 266, 1, 1, 3, 1, 102, '2020-07-08 15:33:52', NULL),
(268, 2, 267, 1, 1, 3, 2, 102, '2020-07-08 15:33:52', NULL),
(269, 2, 268, 1, 1, 3, 3, 102, '2020-07-08 15:33:52', NULL),
(270, 2, 269, 1, 1, 3, 4, 102, '2020-07-08 15:33:52', NULL),
(271, 2, 270, 1, 1, 3, 5, 102, '2020-07-08 15:33:52', NULL),
(272, 1, 271, 2, 2, 3, 1, 103, '2020-07-08 15:39:41', NULL),
(273, 2, 272, 2, 2, 3, 2, 103, '2020-07-08 15:39:41', NULL),
(274, 2, 273, 2, 2, 3, 3, 103, '2020-07-08 15:39:41', NULL),
(275, 2, 274, 2, 2, 3, 4, 103, '2020-07-08 15:39:41', NULL),
(276, 2, 275, 2, 2, 3, 5, 103, '2020-07-08 15:39:41', NULL),
(277, 1, 276, 2, 2, 3, 1, 104, '2020-07-08 15:43:34', NULL),
(278, 2, 277, 2, 2, 3, 2, 104, '2020-07-08 15:43:34', NULL),
(279, 2, 278, 2, 2, 3, 3, 104, '2020-07-08 15:43:34', NULL),
(280, 2, 279, 2, 2, 3, 4, 104, '2020-07-08 15:43:34', NULL),
(281, 2, 280, 2, 2, 3, 5, 104, '2020-07-08 15:43:34', NULL),
(282, 1, 281, 2, 2, 3, 1, 105, '2020-07-08 15:46:29', NULL),
(283, 2, 282, 2, 2, 3, 2, 105, '2020-07-08 15:46:29', NULL),
(284, 2, 283, 2, 2, 3, 3, 105, '2020-07-08 15:46:29', NULL),
(285, 2, 284, 2, 2, 3, 4, 105, '2020-07-08 15:46:29', NULL),
(286, 2, 285, 2, 2, 3, 5, 105, '2020-07-08 15:46:29', NULL),
(287, 1, 286, 2, 2, 3, 1, 106, '2020-07-08 15:47:35', NULL),
(288, 2, 287, 2, 2, 3, 2, 106, '2020-07-08 15:47:35', NULL),
(289, 2, 288, 2, 2, 3, 3, 106, '2020-07-08 15:47:35', NULL),
(290, 2, 289, 2, 2, 3, 4, 106, '2020-07-08 15:47:35', NULL),
(291, 2, 290, 2, 2, 3, 5, 106, '2020-07-08 15:47:35', NULL),
(292, 1, 291, 2, 2, 3, 1, 107, '2020-07-08 15:48:55', NULL),
(293, 2, 292, 2, 2, 3, 2, 107, '2020-07-08 15:48:55', NULL),
(294, 2, 293, 2, 2, 3, 3, 107, '2020-07-08 15:48:55', NULL),
(295, 2, 294, 2, 2, 3, 4, 107, '2020-07-08 15:48:55', NULL),
(296, 2, 295, 2, 2, 3, 5, 107, '2020-07-08 15:48:55', NULL),
(297, 1, 296, 1, 1, 3, 1, 108, '2020-07-08 16:49:19', NULL),
(298, 2, 297, 1, 1, 3, 2, 108, '2020-07-08 16:49:19', NULL),
(299, 2, 298, 1, 1, 3, 3, 108, '2020-07-08 16:49:19', NULL),
(300, 2, 299, 1, 1, 3, 4, 108, '2020-07-08 16:49:19', NULL),
(301, 2, 300, 1, 1, 3, 5, 108, '2020-07-08 16:49:19', NULL),
(302, 1, 301, 2, 2, 3, 1, 109, '2020-07-08 16:50:17', NULL),
(303, 2, 302, 2, 2, 3, 2, 109, '2020-07-08 16:50:17', NULL),
(304, 2, 303, 2, 2, 3, 3, 109, '2020-07-08 16:50:17', NULL),
(305, 2, 304, 2, 2, 3, 4, 109, '2020-07-08 16:50:17', NULL),
(306, 2, 305, 2, 2, 3, 5, 109, '2020-07-08 16:50:17', NULL),
(307, 1, 306, 2, 2, 3, 1, 110, '2020-07-08 16:51:29', NULL),
(308, 2, 307, 2, 2, 3, 2, 110, '2020-07-08 16:51:29', NULL),
(309, 2, 308, 2, 2, 3, 3, 110, '2020-07-08 16:51:29', NULL),
(310, 2, 309, 2, 2, 3, 4, 110, '2020-07-08 16:51:29', NULL),
(311, 2, 310, 2, 2, 3, 5, 110, '2020-07-08 16:51:29', NULL),
(312, 1, 311, 2, 2, 3, 1, 111, '2020-07-08 16:53:48', NULL),
(313, 2, 312, 2, 2, 3, 2, 111, '2020-07-08 16:53:48', NULL),
(314, 2, 313, 2, 2, 3, 3, 111, '2020-07-08 16:53:48', NULL),
(315, 2, 314, 2, 2, 3, 4, 111, '2020-07-08 16:53:48', NULL),
(316, 2, 315, 2, 2, 3, 5, 111, '2020-07-08 16:53:48', NULL),
(317, 1, 316, 2, 2, 3, 1, 112, '2020-07-08 16:55:09', NULL),
(318, 2, 317, 2, 2, 3, 2, 112, '2020-07-08 16:55:09', NULL),
(319, 2, 318, 2, 2, 3, 3, 112, '2020-07-08 16:55:09', NULL),
(320, 2, 319, 2, 2, 3, 4, 112, '2020-07-08 16:55:10', NULL),
(321, 2, 320, 2, 2, 3, 5, 112, '2020-07-08 16:55:10', NULL),
(322, 1, 321, 1, 1, 2, 1, 179, '2020-10-22 21:07:30', NULL),
(323, 2, 322, 1, 1, 2, 2, 179, '2020-10-22 21:07:30', NULL),
(324, 2, 323, 1, 1, 2, 3, 179, '2020-10-22 21:07:30', NULL),
(325, 2, 324, 1, 1, 2, 4, 179, '2020-10-22 21:07:30', NULL),
(326, 2, 325, 1, 1, 2, 5, 179, '2020-10-22 21:07:30', NULL),
(327, 1, 326, 2, 2, 2, 1, 180, '2020-10-23 17:29:30', NULL),
(328, 2, 327, 2, 2, 2, 2, 180, '2020-10-23 17:29:30', NULL),
(329, 2, 328, 2, 2, 2, 3, 180, '2020-10-23 17:29:30', NULL),
(330, 2, 329, 2, 2, 2, 4, 180, '2020-10-23 17:29:30', NULL),
(331, 2, 330, 2, 2, 2, 5, 180, '2020-10-23 17:29:30', NULL),
(332, 1, 331, 2, 2, 2, 1, 181, '2020-10-26 14:33:54', NULL),
(333, 2, 332, 2, 2, 2, 2, 181, '2020-10-26 14:33:54', NULL),
(334, 2, 333, 2, 2, 2, 3, 181, '2020-10-26 14:33:54', NULL),
(335, 2, 334, 2, 2, 2, 4, 181, '2020-10-26 14:33:54', NULL),
(336, 2, 335, 2, 2, 2, 5, 181, '2020-10-26 14:33:54', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_paginas`
--

CREATE TABLE `adm_paginas` (
  `id` int(11) NOT NULL,
  `controller` varchar(220) NOT NULL,
  `metodo` varchar(220) NOT NULL,
  `menu_controller` varchar(220) NOT NULL,
  `menu_metodo` varchar(220) NOT NULL,
  `nome_pagina` varchar(220) NOT NULL,
  `observacoes` text NOT NULL,
  `liberado_publico` int(11) NOT NULL,
  `icones` varchar(45) DEFAULT NULL,
  `adm_grupos_paginas_id` int(11) NOT NULL,
  `adm_tipos_paginas_id` int(11) NOT NULL,
  `adm_situacoes_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adm_paginas`
--

INSERT INTO `adm_paginas` (`id`, `controller`, `metodo`, `menu_controller`, `menu_metodo`, `nome_pagina`, `observacoes`, `liberado_publico`, `icones`, `adm_grupos_paginas_id`, `adm_tipos_paginas_id`, `adm_situacoes_id`, `created`, `modified`) VALUES
(1, 'HOME', 'index', 'Home', 'index', 'Home', 'Página inicial', 2, 'fas fa-tachometer-all', 1, 1, 1, '2020-05-20 15:15:15', NULL),
(2, 'Usuarios', 'listar', 'usuarios', 'listar', 'Usuários', 'Páginas dos Usuários', 2, 'fas fa-users', 1, 1, 1, '2020-05-20 16:16:41', NULL),
(3, 'Login', 'acesso', 'Login', 'acesso', 'Login', 'Página do Administrador sobre os Níveis de Acessos                ', 1, 'fas fa-key', 1, 1, 1, '2020-05-20 20:35:41', '2020-07-02 12:41:15'),
(4, 'Login', 'logout', 'login', 'logout', 'Sair', 'Página para sair do administrativo', 1, '', 7, 1, 1, '2018-05-23 00:00:00', NULL),
(5, 'NovoUsuario', 'novoUsuario', 'novoUsuario', 'novoUsuario', 'Novo Usuário', 'Página de Cadastro de Novos Usuários', 1, NULL, 7, 1, 1, '2020-05-26 17:19:33', NULL),
(6, 'Confirmar', 'confirmarEmail', 'confirmar', 'confirmarEmail', 'Confirmar Email', 'Página para a confirmação de E-mail', 1, NULL, 7, 1, 1, '2020-06-01 16:54:18', NULL),
(7, 'EsqueceuSenha', 'esqueceuSenha', 'esqueceuSenha', 'esqueceuSenha', 'Esqueceu Senha', 'Página para recuperar a senha', 1, NULL, 7, 1, 1, '2020-06-03 14:40:12', NULL),
(8, 'AtualSenha', 'atualSenha', 'atualSenha', 'atualSenha', 'Alterar/Atualizar Senha', 'Página para Alterar/Atualizar Senha', 1, NULL, 7, 1, 1, '2020-06-04 14:19:33', NULL),
(9, 'VerPerfil', 'perfil', 'VerPerfil', 'perfil', 'Ver Perfil', 'Página para a visualização do Usuário', 2, NULL, 5, 1, 1, '2020-06-18 10:17:38', NULL),
(10, 'AterarSenha', 'editarSenha', 'AterarSenha', 'editarSenha', 'Alterar/Editar Senha', 'Página para a alteração/editar a senha', 2, NULL, 3, 1, 1, '2020-06-18 11:00:44', NULL),
(11, 'EditarPerfil', 'editarPerfil', 'EditarPerfil', 'editarPerfil', 'Editar Perfil do Usuário', 'Página para altera ou editar perfil do Usuário', 2, NULL, 3, 1, 1, '2020-06-18 18:15:47', NULL),
(12, 'VerUsuario', 'verUsuario', 'VerUsuario', 'verUsuario', 'Visualização do Usuário', 'Página de visualização do usuário', 2, NULL, 5, 1, 1, '2020-06-20 17:40:05', NULL),
(13, 'EditarSenha', 'editarSenha', 'EditarSenha', 'editarSenha', 'Editar Senha', 'Página para o ADMINISTRADOR editar senha do usuário', 2, NULL, 3, 1, 1, '2020-06-22 12:56:23', NULL),
(14, 'EditarUsuario', 'editarUsuario', 'editarUsuario', 'editarUsuario', 'Editar Usuário', 'Página do Administrador para Editar Usuários', 2, NULL, 3, 1, 1, '2020-06-22 22:37:04', NULL),
(15, 'CadastrarUsuario', 'cadastrarUsuario', 'cadastrarUsuario', 'cadastrarUsuario', 'Cadastrar Usuário', 'Página do Administrador para Cadastrar Usuário', 2, NULL, 2, 1, 1, '2020-06-24 00:34:44', NULL),
(16, 'ApagarUsuario', 'apagarUsuario', 'apagarUsuario', 'apagarUsuario', 'Apagar Usuario', 'Página do Administrador para apagar/deletar o Usuário.', 2, NULL, 4, 1, 1, '2020-06-24 12:09:56', NULL),
(17, 'NivelAcesso', 'listar', 'nivelAcesso', 'listar', 'Nível Acesso', 'Página do Administrador sobre os Níveis de Acessos', 1, 'fas fa-key', 1, 1, 1, '2020-06-25 21:21:31', NULL),
(18, 'CadastrarNivelAcesso', 'cadastrarNivelAcesso', 'cadastrarNivelAcesso', 'cadastrarNivelAcesso', 'Cadastrar Nível Acesso', 'Página do Administrador de Cadastro de Níveis de Acessos', 2, NULL, 2, 1, 1, '2020-06-26 11:25:15', NULL),
(19, 'AlterarOrdemNivelAcesso', 'alterarOrdemNivelAcesso', 'alterarOrdemNivelAcesso', 'alterarOrdemNivelAcesso', 'Alterar Ordem Nível Acesso', 'Página do Administrador para Alterar Ordem Nível Acesso', 2, NULL, 8, 1, 1, '2020-06-26 12:12:46', NULL),
(20, 'VerNivelAcesso', 'verNivelAcesso', 'verNivelAcesso', 'verNivelAcesso', 'Ver Nível Acesso', 'Página do Administrador para Ver Nível Acesso', 5, NULL, 5, 1, 1, '2020-06-26 13:45:03', NULL),
(21, 'EditarNivelAcesso', 'editarNivelAcesso', 'editarNivelAcesso', 'editarNivelAcesso', 'Editar Nível Acesso', 'Página do Administrador para Editar Nível Acesso', 2, NULL, 3, 1, 1, '2020-06-26 14:35:06', NULL),
(22, 'ApagarNivelAcesso', 'apagarNivelAcesso', 'apagarNivelAcesso', 'apagarNivelAcesso', 'Apagar Nível Acesso', 'Página do Administrador para Apagar Nível Acesso', 2, NULL, 4, 1, 1, '2020-06-26 17:16:09', NULL),
(23, 'Pagina', 'listar', 'pagina', 'listar', 'Listar Páginas', 'Página do Administrador para a listagem das Páginas criadas por ele', 2, 'fas fa-file-alt', 1, 1, 1, '2020-06-27 14:49:23', NULL),
(24, 'VerPagina', 'verPagina', 'verPagina', 'verPagina', 'Descrição da Página', 'Página do Administrador para a Descrição da Página', 2, NULL, 5, 1, 1, '2020-06-27 15:58:42', NULL),
(25, 'CadastrarPaginas', 'cadastrarPaginas', 'cadastrarPaginas', 'cadastrarPaginas', 'Cadastrar Páginas', 'Página do Administrador para fazer o Cadastramento das Páginas', 2, NULL, 2, 1, 1, '2020-06-27 17:52:16', NULL),
(26, 'EditarPagina', 'editarPagina', 'editarPagina', 'editarPagina', 'Editar Página', 'Página do Administrador para a Edição/Alteração da Página', 2, '', 3, 1, 1, '2020-06-28 13:55:22', '2020-06-28 16:49:49'),
(27, 'ApagarPagina', 'apagarPagina', 'apagarPagina', 'apagarPagina', 'Apagar Páginas', 'Página do Administrador para Deletar/Apagar uma determinada Páginas no Sistema', 2, '', 4, 1, 1, '2020-06-28 18:21:46', NULL),
(28, 'Permissoes', 'listar', 'permissoes', 'listar', 'Permissões', 'Página do Administrador para dar as devidas Permissões aos Usuários', 2, '', 1, 1, 1, '2020-06-29 14:33:53', NULL),
(29, 'LiberarPermissoes', 'liberarPermissoes', 'liberarPermissoes', 'liberarPermissoes', 'Liberar Permissões', 'Página do Administrador para Liberar Permissões', 2, '', 3, 1, 1, '2020-06-30 14:14:56', NULL),
(30, 'LiberarMenu', 'liberarMenu', 'liberarMenu', 'liberarMenu', 'Liberar Menu', 'Página do Administrador para Liberar Menu', 2, '', 3, 1, 1, '2020-06-30 15:18:58', NULL),
(31, 'LiberarDropdown', 'liberarDropdown', 'liberarDropdown', 'liberarDropdown', 'Liberar Dropdown', 'Página do Administrador para Liberar Dropdown                ', 2, '', 3, 1, 1, '2020-06-30 15:32:41', NULL),
(32, 'AlterarOrdemMenu', 'alterarOrdemMenu', 'alterarOrdemMenu', 'alterarOrdemMenu', 'Alterar Ordem Menu', 'Página do Administrador para Alterar Ordem Menu', 2, '', 3, 1, 1, '2020-07-01 14:04:49', NULL),
(33, 'SincronizarNivelAcessoPagina', 'sincronizarNivelAcessoPagina', 'sincronizarNivelAcessoPagina', 'sincronizarNivelAcessoPagina', 'Sincronizar Nível Acesso Página', 'Página do Administrador para Sincronizar Nível Acesso Página                                ', 2, '', 2, 1, 1, '2020-07-02 02:39:29', '2020-07-02 13:08:56'),
(82, 'EditarNivelAcessoPaginaMenu', 'editarNivelAcessoPaginaMenu', 'editarNivelAcessoPaginaMenu', 'editarNivelAcessoPaginaMenu', 'Editar Nível Acesso Página Menu', 'Página do Administrador para Editar Nível Acesso Página Menu', 2, '', 3, 1, 1, '2020-07-03 02:26:48', NULL),
(83, 'Menu', 'listar', 'menu', 'listar', 'Itens de Menu', 'Página do Administrador para Listar os Itens do Menu', 2, 'fab fa-elementor', 1, 1, 1, '2020-07-03 14:14:08', NULL),
(84, 'VerMenu', 'verMenu', 'verMenu', 'verMenu', 'Ver Menu', 'Página do Administrador para a Visualização do Itens do Menu                ', 2, '', 5, 1, 1, '2020-07-03 14:34:58', NULL),
(85, 'EditarItensMenu', 'editarItensMenu', 'editarItensMenu', 'editarItensMenu', 'Editar Itens Menu', 'Página do Administrador para Editar Itens Menu                ', 2, '', 3, 1, 1, '2020-07-03 16:47:58', NULL),
(86, 'CadastrarItensMenu', 'cadastrarItensMenu', 'cadastrarItensMenu', 'cadastrarItensMenu', 'Cadastrar Itens Menu', 'Página do Administrador para Cadastrar Itens Menu', 2, '', 2, 1, 1, '2020-07-06 13:37:50', NULL),
(87, 'AlterarOrdemItensMenu', 'alterarOrdemItensMenu', 'alterarOrdemItensMenu', 'alterarOrdemItensMenu', 'Alterar Ordem Itens Menu', 'Página do Administrador para Alterar Ordem Itens Menu', 2, '', 8, 1, 1, '2020-07-06 14:08:16', NULL),
(88, 'ApagarItensMenu', 'apagarItensMenu', 'apagarItensMenu', 'apagarItensMenu', 'Apagar Itens Menu', 'Página do Administrador para Apagar Itens Menu', 2, '', 4, 1, 1, '2020-07-06 15:11:38', NULL),
(89, 'EditarFormularioCadastroUsuario', 'editarFormularioCadastroUsuario', 'editarFormularioCadastroUsuario', 'editarFormularioCadastroUsuario', 'Formulário Cadastro Login', 'Página do Administrador para Editar Formulário Cadastro Usuário                                ', 2, 'fas fa-edit', 3, 1, 1, '2020-07-06 15:57:36', '2020-07-07 10:23:26'),
(90, 'EditarConfirmarEmail', 'editarConfirmarEmail', 'editarConfirmarEmail', 'editarConfirmarEmail', 'Confirmação de E-mail', 'Página do Administrador para Confirmação de E-mail', 2, 'fas fa-at', 3, 1, 1, '2020-07-07 11:04:18', NULL),
(91, 'Cores', 'listar', 'cores', 'listar', 'Cores', 'Página do Administrador para Listar as cores do Bootstrap', 2, 'fas fa-tint', 1, 1, 1, '2020-07-07 11:54:37', NULL),
(92, 'CadastrarCores', 'cadastrarCores', 'cadastrarCores', 'cadastrarCores', 'Cadastrar Cores', 'Página do Administrador para Cadastrar Cores', 2, '', 2, 1, 1, '2020-07-08 01:56:11', NULL),
(93, 'VerCores', 'verCores', 'verCores', 'verCores', 'Ver Cores', 'Página do Administrador para Visualizar as Cores', 2, '', 5, 1, 1, '2020-07-08 02:06:33', NULL),
(94, 'EditarCores', 'editarCores', 'editarCores', 'editarCores', 'Editar Cores', 'Página do Administrador para Editar Cores', 2, '', 3, 1, 1, '2020-07-08 02:21:35', NULL),
(95, 'ApagarCores', 'apagarCores', 'apagarCores', 'apagarCores', 'Apagar Cores', 'Página do Administrador para Apagar Cores', 2, '', 4, 1, 1, '2020-07-08 02:27:06', NULL),
(96, 'GrupoPagina', 'listar', 'grupoPagina', 'listar', 'Grupo Página', 'Página do Administrador para Grupo Página', 2, 'fas fa-file-alt', 7, 1, 1, '2020-07-08 13:24:06', NULL),
(97, 'CadastrarGrupoPagina', 'cadastrarGrupoPagina', 'cadastrarGrupoPagina', 'cadastrarGrupoPagina', 'Cadastrar Grupo Página', 'Página do Administrador para Cadastrar Grupo Página', 2, '', 2, 1, 1, '2020-07-08 13:25:07', NULL),
(98, 'AlterarOrdenarGrupoPagina', 'alterarOrdenarGrupoPagina', 'alterarOrdenarGrupoPagina', 'alterarOrdenarGrupoPagina', 'Alterar Ordenar Grupo Página', 'Página do Administrador para Alterar Ordenar Grupo Página', 2, '', 8, 1, 1, '2020-07-08 13:26:18', NULL),
(99, 'VerGrupoPagina', 'verGrupoPagina', 'verGrupoPagina', 'verGrupoPagina', 'Ver Grupo Página', 'Página do Administrador para Ver Grupo Página', 2, '', 5, 1, 1, '2020-07-08 13:27:36', NULL),
(100, 'EditarGrupoPagina', 'editarGrupoPagina', 'editarGrupoPagina', 'editarGrupoPagina', 'Editar Grupo Página', 'Página do Administrador para Editar Grupo Página', 2, '', 3, 1, 1, '2020-07-08 13:29:36', NULL),
(101, 'ApagarGrupoPagina', 'apagarGrupoPagina', 'apagarGrupoPagina', 'apagarGrupoPagina', 'Apagar Grupo Página', 'Página do Administrador para Apagar Grupo Página', 2, '', 4, 1, 1, '2020-07-08 13:31:09', NULL),
(102, 'TipoPagina', 'listar', 'tipoPagina', 'listar', 'Tipo Página', 'Página do Administrador para Tipo Página', 2, 'fas fa-list-ol', 1, 1, 1, '2020-07-08 15:33:52', NULL),
(103, 'VerTipoPagina', 'verTipoPagina', 'verTipoPagina', 'verTipoPagina', 'Ver Tipo Página', 'Página do Administrador para Ver Tipo Página', 2, '', 5, 1, 1, '2020-07-08 15:39:41', NULL),
(104, 'EditarTipoPagina', 'editarTipoPagina', 'editarTipoPagina', 'editarTipoPagina', 'Editar Tipo Página', 'Página do Administrador para Editar Tipo Página', 2, '', 3, 1, 1, '2020-07-08 15:43:34', NULL),
(105, 'CadastrarTipoPagina', 'cadastrarTipoPagina', 'cadastrarTipoPagina', 'cadastrarTipoPagina', 'Cadastrar Tipo Página', 'Página do Administrador para Cadastrar Tipo Página', 2, '', 2, 1, 1, '2020-07-08 15:46:29', NULL),
(106, 'ApagarTipoPagina', 'apagarTipoPagina', 'apagarTipoPagina', 'apagarTipoPagina', 'Apagar Tipo Página', 'Página do Administrador para Apagar Tipo Página', 2, '', 4, 1, 1, '2020-07-08 15:47:34', NULL),
(107, 'AlterarOrdemTipoPagina', 'alterarOrdemTipoPagina', 'alterarOrdemTipoPagina', 'alterarOrdemTipoPagina', 'Alterar Ordem Tipo Página', 'Página do Administrador para Alterar Ordem Tipo Página', 2, '', 8, 1, 1, '2020-07-08 15:48:55', NULL),
(108, 'Situacao', 'listar', 'situacao', 'listar', 'Situação', 'Página do Administrador para a Situações', 2, 'fas fa-exclamation-triangle', 1, 1, 1, '2020-07-08 16:49:19', NULL),
(109, 'VerSituacao', 'verSituacao', 'verSituacao', 'verSituacao', 'Ver Situação', 'Página do Administrador para Ver Situação', 2, '', 5, 1, 1, '2020-07-08 16:50:17', NULL),
(110, 'CadastrarSituacao', 'cadastrarSituacao', 'cadastrarSituacao', 'cadastrarSituacao', 'Cadastrar Situação', 'Página do Administrador para Cadastrar Situação', 2, '', 2, 1, 1, '2020-07-08 16:51:29', NULL),
(111, 'EditarSituacao', 'editarSituacao', 'editarSituacao', 'editarSituacao', 'Editar Situação', 'Página do Administrador para Editar Situação', 2, '', 3, 1, 1, '2020-07-08 16:53:48', NULL),
(112, 'ApagarSituacao', 'apagarSituacao', 'apagarSituacao', 'apagarSituacao', 'Apagar Situação', 'Página do Administrador para Apagar Situação', 2, '', 4, 1, 1, '2020-07-08 16:55:09', NULL),
(179, 'CarregarUsuariosJS', 'listar', 'carregarUsuariosJS', 'listar', 'CarregarUsuariosJS', 'CarregarUsuariosJS', 2, 'fas fa-users ', 1, 2, 1, '2020-10-22 21:07:30', NULL),
(180, 'VisualizarUsuarioModal', 'visualizarUsuarioModal', 'VisualizarUsuarioModal', 'visualizarUsuarioModal', 'Visualizar Usuário Modal', 'Visualizar Usuário Modal', 2, '', 5, 2, 1, '2020-10-23 17:29:30', NULL),
(181, 'CadastrarUsuarioModal', 'cadastrarUsuarioModal', 'CadastrarUsuarioModal', 'cadastrarUsuarioModal', 'CadastrarUsuarioModal', 'CadastrarUsuarioModal', 2, '', 2, 2, 1, '2020-10-26 14:33:54', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_situacoes`
--

CREATE TABLE `adm_situacoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `adm_cores_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adm_situacoes`
--

INSERT INTO `adm_situacoes` (`id`, `nome`, `adm_cores_id`, `created`, `modified`) VALUES
(1, 'Ativo', 3, '2020-05-19 23:53:28', NULL),
(2, 'Inativo', 5, '2020-05-19 23:53:28', NULL),
(3, 'Aguardando confirmação', 1, '2020-05-19 23:53:28', NULL),
(4, 'Span', 4, '2020-05-19 23:53:28', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_tipos_paginas`
--

CREATE TABLE `adm_tipos_paginas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `observacoes` text NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adm_tipos_paginas`
--

INSERT INTO `adm_tipos_paginas` (`id`, `tipo`, `nome`, `observacoes`, `ordem`, `created`, `modified`) VALUES
(1, 'adm', 'Super Administrador', 'Administrador', 1, '2020-05-19 23:57:32', '2020-07-08 15:49:01'),
(2, 'cpadm', 'Complemento do Administrativo', 'Complemento do Administrativo                ', 2, '2020-10-22 20:46:48', '2020-10-22 20:49:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_usuarios`
--

CREATE TABLE `adm_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `apelido` varchar(220) DEFAULT NULL,
  `email` varchar(220) NOT NULL,
  `usuario` varchar(220) NOT NULL,
  `senha` varchar(220) NOT NULL,
  `recuperar_senha` varchar(220) DEFAULT NULL,
  `chava_descadastro` varchar(220) DEFAULT NULL,
  `confirmar_email` varchar(220) DEFAULT NULL,
  `imagem` varchar(220) DEFAULT NULL,
  `adm_niveis_acessos_id` int(11) NOT NULL,
  `adm_situacoes_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adm_usuarios`
--

INSERT INTO `adm_usuarios` (`id`, `nome`, `apelido`, `email`, `usuario`, `senha`, `recuperar_senha`, `chava_descadastro`, `confirmar_email`, `imagem`, `adm_niveis_acessos_id`, `adm_situacoes_id`, `created`, `modified`) VALUES
(1, 'teste1', 'teste1', 'teste1', 'teste1', '$2y$10$XFWEXmgQT6SyYCSSSe4nae65vyM57ZO0OhkdHefURUoB/XYeFOz6O', NULL, NULL, NULL, 'logo.png', 1, 1, '2020-06-24 15:55:36', NULL),
(2, 'qwertyuiop', 'qwertyuiop', 'qwertyuiop@gmail.com', 'qwertyuiop', '$2y$10$asxWR2yHP/xwx8nXRy0syOxW92XjuX2dp43CUZ5hQgOmTL7zBZHwW', NULL, NULL, '2', NULL, 1, 1, '2020-05-25 23:23:42', '2020-06-22 15:14:42'),
(4, 'Suporte Personal 2', 'Suporte 18', 'suport@gmail.com', 'admin1', '$2y$10$XFWEXmgQT6SyYCSSSe4nae65vyM57ZO0OhkdHefURUoB/XYeFOz6O', NULL, 'bbe0d9883f909fb95ca46e8396fd7194', '2', 'event-accepted-50px.png', 2, 3, '2020-05-25 17:32:05', '2020-06-25 20:10:47'),
(29, 'matheusddd', 'thm', 'matheushmg@gmail.com', '74108520', '$2y$10$aNs4fl.Jizi5dStbbrNMDe41EbXTKbFRt94DS9l0I0u2GFA.8ZlNe', NULL, NULL, 'e79963e5bd30afc17ac6e9308f60c96f', NULL, 2, 1, '2020-06-02 16:21:15', '2020-07-03 19:50:07'),
(39, 'tokitoki', 'toki', 'toki@toki.com', 'tokitoki', '$2y$10$QmlAOFSTXBAut/dzstraLuutUGh9zOdoP2/H2U3E2sill7B/Yxomi', NULL, NULL, NULL, 'logo.png', 1, 3, '2020-06-24 11:37:58', '2020-06-24 11:38:38'),
(41, 'hhhhhhhhhhhhhhhh', 'hhhhhhhhhhhhhhh', 'hhhhj@hhh.hhh', 'hhhhhhhhhhhhhhhhhh', '$2y$10$EkoyroiABOHV3rX/bJyuj.JDGO0mbWuN09ySIH5xoIdZdYBtPmovW', NULL, NULL, NULL, '', 2, 3, '2020-06-24 15:15:22', '2020-06-24 16:21:33'),
(45, 'xcvxcvxcv', 'xcvxcvxcvxc', 'vxc@xcv.xcv', 'xcvxcxcv', '$2y$10$czPW26umf.7/gj1oQsDCY.2w6NZoffFM3WFCU.CrtrLKE8vc2BMjS', NULL, NULL, NULL, 'calendar8-50px.png', 5, 3, '2020-06-25 18:27:24', '2020-07-03 19:49:39'),
(46, 'chico', 'chico', 'chico@chico.chi', 'chico1', '$2y$10$y5NNBZkfWh521rOEqFxsY.xjw4WCVFAxYDXriyCmry0tvh0M6gRsW', NULL, NULL, NULL, '22-java-300.jpg', 6, 1, '2020-06-26 17:24:08', NULL),
(47, 'testando', NULL, 'testando23@gmail.com', 'testando23', '$2y$10$stDpTr5l/3dufhYjluqWe.QrWFHXtk6xgcmuL1pYpy6E4Cc0AEwNq', NULL, NULL, NULL, NULL, 5, 1, '2020-07-08 21:40:08', '2020-07-08 21:41:41'),
(48, 'testando', NULL, 'testando23@gmail.com', 'testando23', '$2y$10$stDpTr5l/3dufhYjluqWe.QrWFHXtk6xgcmuL1pYpy6E4Cc0AEwNq', NULL, NULL, NULL, NULL, 5, 1, '2020-07-08 21:40:08', '2020-07-08 21:41:41'),
(49, 'matheusddd', 'thm', 'matheushmg@gmail.com', '74108520', '$2y$10$aNs4fl.Jizi5dStbbrNMDe41EbXTKbFRt94DS9l0I0u2GFA.8ZlNe', NULL, NULL, 'e79963e5bd30afc17ac6e9308f60c96f', NULL, 2, 1, '2020-06-02 16:21:15', '2020-07-03 19:50:07'),
(50, 'tokitoki', 'toki', 'toki@toki.com', 'tokitoki', '$2y$10$QmlAOFSTXBAut/dzstraLuutUGh9zOdoP2/H2U3E2sill7B/Yxomi', NULL, NULL, NULL, 'logo.png', 1, 3, '2020-06-24 11:37:58', '2020-06-24 11:38:38'),
(51, 'hhhhhhhhhhhhhhhh', 'hhhhhhhhhhhhhhh', 'hhhhj@hhh.hhh', 'hhhhhhhhhhhhhhhhhh', '$2y$10$EkoyroiABOHV3rX/bJyuj.JDGO0mbWuN09ySIH5xoIdZdYBtPmovW', NULL, NULL, NULL, '', 2, 3, '2020-06-24 15:15:22', '2020-06-24 16:21:33'),
(52, 'xcvxcvxcv', 'xcvxcvxcvxc', 'vxc@xcv.xcv', 'xcvxcxcv', '$2y$10$czPW26umf.7/gj1oQsDCY.2w6NZoffFM3WFCU.CrtrLKE8vc2BMjS', NULL, NULL, NULL, 'calendar8-50px.png', 5, 3, '2020-06-25 18:27:24', '2020-07-03 19:49:39'),
(53, 'chico', 'chico', 'chico@chico.chi', 'chico1', '$2y$10$y5NNBZkfWh521rOEqFxsY.xjw4WCVFAxYDXriyCmry0tvh0M6gRsW', NULL, NULL, NULL, '22-java-300.jpg', 6, 1, '2020-06-26 17:24:08', NULL),
(54, 'testando', NULL, 'testando23@gmail.com', 'testando23', '$2y$10$stDpTr5l/3dufhYjluqWe.QrWFHXtk6xgcmuL1pYpy6E4Cc0AEwNq', NULL, NULL, NULL, NULL, 5, 1, '2020-07-08 21:40:08', '2020-07-08 21:41:41'),
(55, 'testando', NULL, 'testando23@gmail.com', 'testando23', '$2y$10$stDpTr5l/3dufhYjluqWe.QrWFHXtk6xgcmuL1pYpy6E4Cc0AEwNq', NULL, NULL, NULL, NULL, 5, 1, '2020-07-08 21:40:08', '2020-07-08 21:41:41'),
(56, 'teste de email', 'teste de email', 'suport.personal18@gmail.com', 'testedeemail1', '$2y$10$imCVqbG.kzW3Or/uF9qyk..LTvpxBWNkF74JPMjN8vFNHJx2ZvO6y', NULL, NULL, NULL, '', 5, 3, '2020-10-26 15:27:48', NULL),
(57, 'teste de email 88', 'teste de email 88', 'suport.perso55nal18@gmail.com', 'testedeemail18', '$2y$10$PDIC6ffDwe3H2wL8fSnAyuAnm/SFHgP4wn3bCVDznOwgwJWf2yooS', NULL, NULL, NULL, NULL, 5, 3, '2020-10-26 15:59:40', NULL),
(58, 'teste de email 99', 'teste de email 99', 'suport.55@gmail.com', 'testedeemail199', '$2y$10$9c8JYq/H.sybsLO7QORYGOXeKbhB5nZs4Qdj5RFuxiFaAAlpxjA3e', NULL, NULL, NULL, NULL, 5, 3, '2020-10-26 16:39:14', NULL),
(59, 'teste de email 99', 'teste de email 99', 'suport.555@gmail.com', 'testedeemail1899', '$2y$10$21GUSkWBSsXOErQ/qYvnT.g3zgHD1kAyniXb/lrCdmDwwWSvjexZ2', NULL, NULL, NULL, NULL, 5, 3, '2020-10-26 16:40:09', NULL),
(60, 'werqwerqwer3232411', 'werqwerqwer3232411', 'suport.perso555nal18@gmail.com', 'werqwerqwer3232411', '$2y$10$knvP74DiTXkVrwpv6m2Y6O1GTjxi2TzdWhIlsGqEmKPEsWLlLzO6m', NULL, NULL, NULL, NULL, 5, 3, '2020-10-26 16:45:15', NULL),
(61, 'teste de email 8888', 'teste de email 8888', 'aaaassswwww@we.xxx', 'ewrwerwer', '$2y$10$4y5qC6dRoXUJdP5XK85cW.u6qss9HRfPCUvw3VWr3Wh41YqYHMxvC', NULL, NULL, NULL, NULL, 5, 3, '2020-10-26 16:47:25', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adm_cadastrar_usuarios`
--
ALTER TABLE `adm_cadastrar_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_confirmar_emails`
--
ALTER TABLE `adm_confirmar_emails`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_cores`
--
ALTER TABLE `adm_cores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_grupos_paginas`
--
ALTER TABLE `adm_grupos_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_menus`
--
ALTER TABLE `adm_menus`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_niveis_acessos`
--
ALTER TABLE `adm_niveis_acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_nivel_acesso_paginas`
--
ALTER TABLE `adm_nivel_acesso_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_paginas`
--
ALTER TABLE `adm_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_situacoes`
--
ALTER TABLE `adm_situacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_tipos_paginas`
--
ALTER TABLE `adm_tipos_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adm_usuarios`
--
ALTER TABLE `adm_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm_cadastrar_usuarios`
--
ALTER TABLE `adm_cadastrar_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `adm_confirmar_emails`
--
ALTER TABLE `adm_confirmar_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `adm_cores`
--
ALTER TABLE `adm_cores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `adm_grupos_paginas`
--
ALTER TABLE `adm_grupos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `adm_menus`
--
ALTER TABLE `adm_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `adm_niveis_acessos`
--
ALTER TABLE `adm_niveis_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `adm_nivel_acesso_paginas`
--
ALTER TABLE `adm_nivel_acesso_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT de tabela `adm_paginas`
--
ALTER TABLE `adm_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT de tabela `adm_situacoes`
--
ALTER TABLE `adm_situacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `adm_tipos_paginas`
--
ALTER TABLE `adm_tipos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `adm_usuarios`
--
ALTER TABLE `adm_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
