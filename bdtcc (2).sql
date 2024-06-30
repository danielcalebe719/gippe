-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jul-2024 às 00:01
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdtcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admpermissoes`
--

CREATE TABLE `admpermissoes` (
  `idAdmPermissoes` int(2) NOT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `permissoes` text DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `dataAtualizacao` date DEFAULT NULL,
  `dataRemocao` date DEFAULT NULL,
  `idFuncionario` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `idAgendamento` int(10) NOT NULL,
  `idPedidos` int(10) DEFAULT NULL,
  `dataInicio` date DEFAULT NULL,
  `dataFim` date DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFim` time DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `agendamento`
--

INSERT INTO `agendamento` (`idAgendamento`, `idPedidos`, `dataInicio`, `dataFim`, `horaInicio`, `horaFim`, `observacao`, `dataCadastro`) VALUES
(3, 5, '2024-06-12', '2024-06-12', '11:11:00', '11:11:00', 'sadadsadsa', '2024-06-22'),
(4, 5, '2024-06-12', '2024-06-12', '11:11:00', '11:11:00', 'sadadsadsa', '2024-06-22'),
(5, 5, '2024-06-12', '2024-06-12', '11:11:00', '11:11:00', 'sadadsadsa', '2024-06-22'),
(6, 5, '2024-06-12', '2024-06-12', '11:11:00', '11:11:00', 'sadadsadsa', '2024-06-22'),
(7, 5, '2024-06-12', '2024-06-12', '11:11:00', '11:11:00', 'sadadsadsa', '2024-06-22'),
(8, 5, '2024-06-12', '2024-06-12', '11:11:00', '11:11:00', 'sadadsadsa', '2024-06-22'),
(9, 5, '2024-06-12', '2024-06-12', '11:11:00', '11:11:00', 'sadadsadsa', '2024-06-22'),
(13, 5, '2024-06-07', '2024-06-22', '12:02:00', '12:02:00', 'dsadsaddasda', '2024-06-22'),
(14, 5, '2024-06-07', '2024-06-22', '12:02:00', '12:02:00', 'dsadsaddasda', '2024-06-22'),
(15, 5, '2024-06-07', '2024-06-22', '12:02:00', '12:02:00', 'dsadsaddasda', '2024-06-22'),
(16, 5, '2024-06-03', '2024-06-11', '22:04:00', '23:02:00', 'dsadadadsadadas', '2024-06-22'),
(17, 5, '2024-06-29', '2024-06-30', '22:07:00', '02:08:00', 'dasdasfasfsa', '2024-06-22'),
(18, 5, '2024-06-20', '2024-06-18', '11:12:00', '22:22:00', 'dsdaDsadadsdsad', '2024-06-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `idClientes` int(10) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `status` enum('ativo','inativo') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` text DEFAULT NULL,
  `dataCadastro` date DEFAULT current_timestamp(),
  `dataAtualizacao` date DEFAULT current_timestamp(),
  `dataRemocao` date DEFAULT NULL,
  `imgCaminho` varchar(200) DEFAULT NULL,
  `telefone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`idClientes`, `nome`, `cpf`, `dataNascimento`, `status`, `email`, `senha`, `dataCadastro`, `dataAtualizacao`, `dataRemocao`, `imgCaminho`, `telefone`) VALUES
(33, '', '0', '0000-00-00', NULL, 'caloko1026@gmail.com', 'j', '2024-06-16', '2024-06-16', NULL, 'azevedo.webp', 0),
(34, 'dasdsada', '', '2222-02-22', NULL, 'dann@gmail.com', '$2y$10$ciEeYfyGl.TR3Fr6xh09qO792rEtrne.88LMqSyDcPjoE/OyHjn72', '2024-06-21', '2024-06-21', NULL, 'scrum-foundation-professional-certification-sfpc.png', 0),
(35, NULL, NULL, NULL, NULL, 'dann@gmail.com', '$2y$10$zZYavfbvZ/RiSRlzv59Y3.WW2.e3tChmka87UtVoswmTZ1ufYeL72', '2024-06-22', '2024-06-22', NULL, NULL, 0),
(36, NULL, NULL, NULL, NULL, '', '$2y$10$Ygv6B93Ba2WgR6YImFgPHusJogwl5s279PY78gfe5mU6o7yJJw0gi', '2024-06-22', '2024-06-22', NULL, NULL, 0),
(37, 'Daniel C', '15331285600', '2007-09-30', NULL, 's', '$2y$10$KVhjoxvYQwtLkUg/Zz1hruUPa1Mzp.Ohmq/z1YqzeTetGJCD6OgrG', '2024-06-22', '2024-06-22', NULL, 'scrum-foundation-professional-certification-sfpc.png', 0),
(38, 'Daniel Calebe Alves Ferreira', '15331285600', '2005-09-30', NULL, 'a', '$2y$10$WlyMRZSe7dvNvlrqkgKQN.uWi1CGnXNPfSjw.Vl2zLZjRRb2W/laq', '2024-06-22', '2024-06-22', NULL, NULL, 0),
(39, 'fafa', '322132131', '4444-04-04', NULL, 'fafa', '$2y$10$FRC3RfUhsvqwSnyC/JfKB.G3PU3mea6Y3FPbjbAe0hvstvV72mKBi', '2024-06-22', '2024-06-22', NULL, 'scrum-foundation-professional-certification-sfpc.png', 0),
(40, 'edson', '12345678911', '2020-04-23', NULL, 'socapa@gmail.com', '$2y$10$ij8N7GYFaKZBaa48nsroO.fcMrMhH1Vi0phvS0cSiVjhAv/WDU4kW', '2024-06-22', '2024-06-22', NULL, 'Capturar.PNG', 0),
(41, NULL, NULL, NULL, NULL, 'n', '$2y$10$IKFDB9IC/ZAcGf8GaJYhUeVG0ohBCtQp5wCVNw6NdviAbP1nrPS6O', '2024-06-23', '2024-06-23', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecosclientes`
--

CREATE TABLE `enderecosclientes` (
  `idEnderecosClientes` int(10) NOT NULL,
  `tipo` enum('residencial','comercial') DEFAULT NULL,
  `cep` int(8) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` int(10) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `idClientes` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `enderecosclientes`
--

INSERT INTO `enderecosclientes` (`idEnderecosClientes`, `tipo`, `cep`, `cidade`, `bairro`, `rua`, `numero`, `complemento`, `idClientes`) VALUES
(3, 'residencial', 3213, 'dsadsad', 'sadad', 'sdadad', 12, 'dasdasd', 33),
(4, 'residencial', 31655470, 'Belo Horizonte', 'Mantiqueira', 'Rua Edith Gomes Martins', 11, 'dsads', 34),
(5, 'residencial', 31655470, 'Belo Horizonte', 'Mantiqueira', 'Rua Edith Gomes Martins', 95, '', 37),
(6, 'residencial', 31655470, 'Belo Horizonte', 'Mantiqueira', 'a', 1, '0', 38),
(7, 'comercial', 33110560, 'Belo Horizonte', 'Conjunto Cristina (São Benedito)', 'Rua Donato Pinheiro Santos', 171, 'aqui', 39),
(8, 'residencial', 33110060, 'Sabará', 'Conjunto Cristina (São Benedito)', 'Rua Clarismundo Bernardes Terra', 23443, '0', 40);

-- --------------------------------------------------------

--
-- Estrutura da tabela `esquecisenha`
--

CREATE TABLE `esquecisenha` (
  `idEsqueciSenha` int(10) NOT NULL,
  `idClientes` int(10) DEFAULT NULL,
  `token` int(10) DEFAULT NULL,
  `dataEmissao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `feedbacks`
--

CREATE TABLE `feedbacks` (
  `idFeedback` int(10) NOT NULL,
  `mensagem` varchar(255) DEFAULT NULL,
  `avaliacao` enum('1','2','3','4','5') DEFAULT NULL,
  `data_mensagem` date DEFAULT NULL,
  `idPedidos` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `formaspagamento`
--

CREATE TABLE `formaspagamento` (
  `idFormaPagamento` int(10) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `classe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `idFornecedor` int(10) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `telefone1` int(11) DEFAULT NULL,
  `telefone2` int(11) DEFAULT NULL,
  `telefone3` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `cep` int(8) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` int(10) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `dataAtualizacao` date DEFAULT NULL,
  `dataRemocao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `idFuncionario` int(10) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`idFuncionario`, `email`, `senha`) VALUES
(0, 's', 's'),
(1, 's', 's');

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeriaimagens`
--

CREATE TABLE `galeriaimagens` (
  `id` int(10) NOT NULL,
  `evento` enum('outros','casamento','15anos','formatura','infantil') DEFAULT 'outros',
  `descricao` varchar(255) NOT NULL,
  `nome_imagem` varchar(25) NOT NULL,
  `tamanho_imagem` varchar(25) NOT NULL,
  `tipo_imagem` varchar(25) NOT NULL,
  `imagemCaminho` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `galeriaimagens`
--

INSERT INTO `galeriaimagens` (`id`, `evento`, `descricao`, `nome_imagem`, `tamanho_imagem`, `tipo_imagem`, `imagemCaminho`) VALUES
(26, 'casamento', 'casamento', '46502141_2554621897885736', '106212', 'image/jpeg', 'galeriaImagens/46502141_2554621897885736_7212542157880557568_n.jpg'),
(27, 'outros', 'outros', '666decd56f895_46502141_25', '106212', 'image/jpeg', 'galeriaImagens/666decd56f895_46502141_2554621897885736_7212542157880557568_n.jpg'),
(28, 'outros', 'outros', '666decda39c6e_46502141_25', '106212', 'image/jpeg', 'galeriaImagens/666decda39c6e_46502141_2554621897885736_7212542157880557568_n.jpg'),
(29, 'casamento', 'casamento', '46502141_2554621897885736', '106212', 'image/jpeg', 'galeriaImagens/46502141_2554621897885736_7212542157880557568_n.jpg'),
(30, 'outros', 'outros', '46502141_2554621897885736', '106212', 'image/jpeg', 'galeriaImagens/46502141_2554621897885736_7212542157880557568_n.jpg'),
(31, 'casamento', '', '46502141_2554621897885736', '106212', 'image/jpeg', 'galeriaImagens/46502141_2554621897885736_7212542157880557568_n.jpg'),
(32, 'outros', '', '46502141_2554621897885736', '106212', 'image/jpeg', '46502141_2554621897885736_7212542157880557568_n.jpg'),
(33, 'outros', '', '46502141_2554621897885736', '106212', 'image/jpeg', '46502141_2554621897885736_7212542157880557568_n.jpg'),
(34, 'casamento', 'casamento', '20190727amazon-the-boys.j', '233352', 'image/jpeg', '20190727amazon-the-boys.jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gasto`
--

CREATE TABLE `gasto` (
  `idCusto` int(10) NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `dataAtualizacao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiaprimaestoque`
--

CREATE TABLE `materiaprimaestoque` (
  `idMateriaPrima` int(10) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `classificacao` enum('perecivel','nao perecivel') DEFAULT NULL,
  `quantidade` int(10) DEFAULT NULL,
  `preco_unitario` decimal(10,2) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `dataAtualizacao` date DEFAULT NULL,
  `dataRemocao` date DEFAULT NULL,
  `imgCaminho` varchar(200) DEFAULT NULL,
  `idFornecedor` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `assunto` varchar(100) NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `nome`, `endereco`, `assunto`, `mensagem`, `data_envio`) VALUES
(1, '', '', '', 'dasdafdsafsd', '2024-05-25 19:32:18'),
(2, 'daniel', 'caloko1029@gmail.com', 'assuunto', 'DSDSADSDADSADSAFGIYFGIA', '2024-05-25 19:35:18'),
(3, 'daniel', 'caloko1029@gmail.com', 'assuunto', 'DSDSADSDADSADSAFGIYFGIA', '2024-05-25 19:36:56'),
(4, 'daniel', 'caloko1029@gmail.com', 'assuunto', 'DSDSADSDADSADSAFGIYFGIA', '2024-05-25 19:36:57'),
(5, 'daniel', 'caloko1029@gmail.com', 'assuunto', 'DSDSADSDADSADSAFGIYFGIA', '2024-05-25 19:36:57'),
(6, 'daniel', 'caloko1029@gmail.com', 'assuunto', 'DSDSADSDADSADSAFGIYFGIA', '2024-05-25 19:36:57'),
(7, 'adsdas', 'caloko1029@gmail.coma', 'aa', 'aa', '2024-05-25 19:42:58'),
(8, 'Daniel Calebe Alves Ferreira', 'caloko1029@gmail.com', 'vduvida', 'duvida viado', '2024-05-26 15:11:28'),
(9, 'daniel', 'caloko1029@gmail.com', 'dsahjdsadugasd', 'djgasjldgaiuhdAOH', '2024-05-29 15:06:56'),
(10, 'Daniel Calebe', 'caloko1026@gmail.com', 'dsadsad', 'sadsadsabbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2024-06-08 21:36:11'),
(11, 'Daniel Calebe', 'caloko1026@gmail.com', 'dsadsad', 'sadsadsabbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2024-06-08 21:39:25'),
(12, 'Daniel Calebe', 'caloko1026@gmail.com', 'dsadsad', 'sadsadsabbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2024-06-08 21:39:25'),
(13, 'Gapd method', 'caloko1026@gmail.com', 'astutto', 'Astutto', '2024-06-08 22:54:57'),
(14, 'a', 'a@sa', 'a', 'a', '2024-06-09 15:00:33'),
(15, 'a', 'a@aa', 'a', 'a', '2024-06-09 15:04:09'),
(16, 'a', 'a@as', 'a', 'a', '2024-06-09 15:05:13'),
(17, 'a', 'a@as', 'a', 'a', '2024-06-09 15:06:34'),
(18, 'MIQUEIAS ALVES GOMES FERREIRA', 'd@dasd', 'dasda', 'asdsaa', '2024-06-09 15:08:21'),
(19, 's', 'dsa@d', 'sadsa', 'dsa', '2024-06-09 15:10:16'),
(20, 's', 'dsa@d', 'sadsa', 'dsa', '2024-06-09 15:11:00'),
(21, 'Daniel Calebe', 'caloko1026@gmail.com', 'astutto', 'adsad', '2024-06-09 15:12:01'),
(22, 'dsadaa', 'dasdsa@dsad', 'dsadsa', 'dsa', '2024-06-09 15:14:04'),
(23, 'dsadsa', 'sasd@sadda', 'dasdsasad', 'dasdad', '2024-06-09 15:14:28'),
(24, 'dsdsa', 'sadsa@dsa', 'dsad', 'sadd', '2024-06-09 15:16:10'),
(25, 'dsad', 'dsads@DSA', 'dsadsa', 'dasdsad', '2024-06-09 15:16:44'),
(26, 'asd', 'dsad@dsa', 'adsad', 'dsa', '2024-06-09 15:16:56'),
(27, 'dadsa', 'dsa@sdad', 'dasdsa', 'sada', '2024-06-09 15:17:44'),
(28, 'asds', 'dsad@dsa', 'dsadsa', 'dasd', '2024-06-09 15:18:27'),
(29, '32132', '1313@3', 'dsadda', 'dasd', '2024-06-09 15:19:58'),
(30, 'MIQUEIAS ALVES GOMES FERREIRA', 'miqueiasferreira7931@gmail.com', 'Ldasdsan', 'ladsaodosad', '2024-06-09 15:20:44'),
(31, 'dsadsad', 'sad@dasds', 'ddsadsa', 'dsad', '2024-06-09 15:23:46'),
(32, 'dsadsad', 'sad@dasds', 'ddsadsa', 'dsad', '2024-06-09 15:23:48'),
(33, 'dsadsad', 'sad@dasds', 'ddsadsa', 'dsad', '2024-06-09 15:23:49'),
(34, 'dsadsad', 'sad@dasds', 'ddsadsa', 'dsad', '2024-06-09 15:23:49'),
(35, 'Daniel Calebe', 'caloko1026@gmail.com', 's', 's', '2024-06-09 15:27:07'),
(36, 'dsadsa', 'dsads@sad', 'addads', 'dsad', '2024-06-09 15:27:29'),
(37, 'd', 'a@ddsds', '2', 'dsa', '2024-06-09 15:28:47'),
(38, 'Daniel Calebe', 'caloko1026@gmail.com', 'astutto', 'sdsadsa', '2024-06-10 22:51:21'),
(39, 'ds', 'sdsad@dsad', 'sdad', 'dsa', '2024-06-10 22:51:32'),
(40, 's', 's@s', 's', 's', '2024-06-16 14:11:05'),
(41, 's', 's@sda', 's', 'dsad', '2024-06-16 14:11:17'),
(42, 'm', 'm@m', 'm', 'm', '2024-06-16 14:12:09'),
(43, 's', '2@s', '@s', 'sda', '2024-06-16 14:12:47'),
(44, 'dsadsadsa', 'sdad@dsada', 'adsda', 'dsadsa', '2024-06-16 14:15:15'),
(45, 'Pedrin', 'socapa@gmail.com', 'Amizade', 'Aceita eu ai', '2024-06-23 01:12:00'),
(46, 'd', 'd@e', 'd', 'd', '2024-06-23 05:06:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagenscliente`
--

CREATE TABLE `mensagenscliente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `assunto` varchar(255) NOT NULL,
  `mensagem` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(5, '2024_06_28_212404_create_mensagens_table', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoesmateriaprima`
--

CREATE TABLE `movimentacoesmateriaprima` (
  `idMovimentacoesMateriaPrima` int(10) NOT NULL,
  `idMateriaPrima` int(10) DEFAULT NULL,
  `tipo` enum('entrada','saida','retorno') DEFAULT NULL,
  `quantidade` int(10) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `dataAtualizacao` date DEFAULT NULL,
  `dataRemocao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoesprodutos`
--

CREATE TABLE `movimentacoesprodutos` (
  `idMovimentacoesProdutos` int(10) NOT NULL,
  `tipo` enum('entrada','saida','retorno') DEFAULT NULL,
  `idProdutos` int(10) DEFAULT NULL,
  `quantidade` int(10) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `dataAtualizacao` date DEFAULT NULL,
  `dataRemocao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `idNotificacoes` int(10) NOT NULL,
  `mensagem` varchar(500) DEFAULT NULL,
  `dataEnvio` date DEFAULT NULL,
  `titulo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `notificacoes`
--

INSERT INTO `notificacoes` (`idNotificacoes`, `mensagem`, `dataEnvio`, `titulo`) VALUES
(1, 'Oi, o seu pedido deve ser pago até o dia...', '2024-06-08', 'PEDIDO'),
(2, 'Oi, o seu pedido deve ser pago até o dia...dkjsdhsahdlsadhadsadsad', '2024-06-08', 'PEDIDO'),
(3, 'Olá z, quero que vc isso isso e aquilo', '2024-06-09', 'QUERIDO Z'),
(4, 'Olá z, quero que vc isso isso e aquilo', '2024-06-09', 'QUERIDO Z'),
(5, 'odsakndlksadnasda', NULL, 'dsadadsaa'),
(6, 'dasdadsadadsadasd', NULL, 'dsadadadd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoesclientes`
--

CREATE TABLE `notificacoesclientes` (
  `idNotificacaoClientes` int(10) NOT NULL,
  `idPedidos` int(10) DEFAULT NULL,
  `idClientes` int(10) DEFAULT NULL,
  `idNotificacoes` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoesfuncionario`
--

CREATE TABLE `notificacoesfuncionario` (
  `idNotificacaoFuncionario` int(11) NOT NULL,
  `idPedidos` int(10) DEFAULT NULL,
  `idFuncionario` int(10) DEFAULT NULL,
  `idNotificacoes` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('caloko1026@gmail.com', '6676c98d8d98f', NULL),
('caloko1029@gmail.com', '6676c890798fc', NULL),
('dann@gmail.com', '6676c8601b5bf', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedidos` int(10) NOT NULL,
  `idCliente` int(10) DEFAULT NULL,
  `observacao` varchar(500) DEFAULT NULL,
  `status` enum('pendente','a caminho','em producao','entregue') DEFAULT NULL,
  `totalPedido` decimal(10,2) DEFAULT NULL,
  `dataPedido` date DEFAULT NULL,
  `dataEntrega` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedidos`, `idCliente`, `observacao`, `status`, `totalPedido`, `dataPedido`, `dataEntrega`) VALUES
(5, 41, 'dsada', 'pendente', 22.00, '2024-06-26', '2024-06-22'),
(6, 34, 'sapdjjadas', 'a caminho', 10000.00, '2024-06-21', '2024-06-30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidosandamentos`
--

CREATE TABLE `pedidosandamentos` (
  `idPedidosAndamentos` int(10) NOT NULL,
  `idPedidos` int(10) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `status` enum('pendente','aceito','cancelado','entregue') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidosprodutos`
--

CREATE TABLE `pedidosprodutos` (
  `idPedidosProdutos` int(10) NOT NULL,
  `idPedidos` int(10) DEFAULT NULL,
  `idProdutos` int(10) DEFAULT NULL,
  `quantidade` int(10) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidosprodutos`
--

INSERT INTO `pedidosprodutos` (`idPedidosProdutos`, `idPedidos`, `idProdutos`, `quantidade`, `subtotal`) VALUES
(1, 5, 1, 10, NULL),
(2, 5, 1, 10, NULL),
(3, 5, 1, 20, 20.00),
(4, NULL, NULL, NULL, NULL),
(5, NULL, NULL, 51, NULL),
(6, NULL, NULL, 50, NULL),
(7, NULL, NULL, 50, NULL),
(8, NULL, NULL, 50, NULL),
(9, NULL, NULL, 50, NULL),
(10, NULL, NULL, 50, NULL),
(11, NULL, NULL, 50, NULL),
(12, NULL, NULL, 50, NULL),
(13, NULL, NULL, 50, NULL),
(14, NULL, NULL, 50, NULL),
(15, NULL, NULL, 50, NULL),
(16, NULL, NULL, 50, NULL),
(17, NULL, NULL, 50, NULL),
(18, NULL, NULL, 50, NULL),
(19, NULL, NULL, 50, NULL),
(20, NULL, NULL, 50, NULL),
(21, NULL, NULL, 50, NULL),
(22, NULL, NULL, 50, NULL),
(23, NULL, NULL, 50, NULL),
(24, NULL, NULL, 50, NULL),
(25, NULL, NULL, 50, NULL),
(26, NULL, NULL, 50, NULL),
(27, NULL, NULL, 50, NULL),
(28, NULL, NULL, 50, NULL),
(29, NULL, NULL, 50, NULL);

--
-- Acionadores `pedidosprodutos`
--
DELIMITER $$
CREATE TRIGGER `calcular_subtotal` BEFORE INSERT ON `pedidosprodutos` FOR EACH ROW BEGIN
    DECLARE preco_produto DECIMAL(10,2);
    DECLARE subtotal DECIMAL(10,2);

    -- Obtendo o preço do produto
    SELECT preco_unitario INTO preco_produto FROM produtos WHERE idProdutos = NEW.idProdutos;

    -- Calculando o subtotal
    SET subtotal = NEW.quantidade * preco_produto;

    -- Atualizando o valor do subtotal no novo registro
    SET NEW.subtotal = subtotal;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProdutos` int(10) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `tipo` enum('salgado','bebida','doce') DEFAULT NULL,
  `quantidade` int(10) DEFAULT NULL,
  `status` enum('pendente','aceito','cancelado','entregue') DEFAULT NULL,
  `preco_unitario` decimal(10,2) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `dataAtualizacao` date DEFAULT NULL,
  `dataRemocao` date DEFAULT NULL,
  `caminhoImagem` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idProdutos`, `nome`, `descricao`, `tipo`, `quantidade`, `status`, `preco_unitario`, `dataCadastro`, `dataAtualizacao`, `dataRemocao`, `caminhoImagem`) VALUES
(1, 'coxinha', 'gostoso', 'salgado', 10, NULL, 1.00, '2024-06-21', '2024-06-21', NULL, 'scrum-foundation-professional-certification-sfpc.png'),
(2, 'Brisadeiro', 'gostoso demais', 'doce', 20, NULL, 2.00, NULL, NULL, NULL, 'images.jpeg\r\n'),
(3, 'coca', 'nao beba', 'bebida', 20, 'aceito', 10.00, NULL, NULL, NULL, 'coca.webp\r\n'),
(5, 'Empada de camarão', 'Rogério skylab', 'salgado', 100, 'aceito', 1.00, NULL, NULL, NULL, 's.jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitasitem`
--

CREATE TABLE `receitasitem` (
  `idReceitasItem` int(10) NOT NULL,
  `idProdutos` int(10) DEFAULT NULL,
  `idMateriaPrima` int(10) DEFAULT NULL,
  `quantidade` int(10) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorios`
--

CREATE TABLE `relatorios` (
  `idRelatorio` int(10) NOT NULL,
  `parametros` text DEFAULT NULL,
  `dataEmissao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `idServicos` int(10) NOT NULL,
  `nomeServico` enum('festa pequena','festa media','festa grande','apenas entrega','personalizado') DEFAULT NULL,
  `total_servicos` decimal(10,2) DEFAULT NULL,
  `dataCadastro` date DEFAULT current_timestamp(),
  `dataAtualizacao` date DEFAULT current_timestamp(),
  `dataRemocao` date DEFAULT NULL,
  `imgCaminho` varchar(200) DEFAULT NULL,
  `duracaoHoras` int(11) DEFAULT NULL,
  `quantidadePessoas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`idServicos`, `nomeServico`, `total_servicos`, `dataCadastro`, `dataAtualizacao`, `dataRemocao`, `imgCaminho`, `duracaoHoras`, `quantidadePessoas`) VALUES
(1, 'festa pequena', 900.00, '2024-06-09', '2024-06-09', NULL, NULL, 4, 30),
(2, 'festa media', 1350.00, NULL, NULL, NULL, NULL, 7, 50),
(3, 'festa grande', 1800.00, NULL, NULL, NULL, NULL, 11, 100),
(4, 'apenas entrega', 0.00, NULL, NULL, NULL, NULL, NULL, 0),
(6, 'personalizado', 6750.00, '2024-06-09', '2024-06-09', NULL, NULL, NULL, 0),
(7, 'personalizado', 9900.00, '2024-06-09', '2024-06-09', NULL, NULL, NULL, 0),
(8, 'personalizado', 9900.00, '2024-06-09', '2024-06-09', NULL, NULL, NULL, 0),
(9, 'personalizado', 900.00, '2024-06-09', '2024-06-09', NULL, NULL, NULL, 0),
(10, 'personalizado', 900.00, '2024-06-09', '2024-06-09', NULL, NULL, NULL, 0),
(11, 'personalizado', 900.00, '2024-06-09', '2024-06-09', NULL, NULL, NULL, 0),
(12, 'personalizado', NULL, '2024-06-09', '2024-06-09', NULL, NULL, NULL, 0),
(13, 'personalizado', 900.00, '2024-06-09', '2024-06-09', NULL, NULL, NULL, 0),
(14, 'personalizado', 3750.00, '2024-06-09', '2024-06-09', NULL, NULL, NULL, 0),
(15, 'personalizado', 900.00, '2024-06-09', '2024-06-09', NULL, NULL, 14, NULL),
(16, 'personalizado', 900.00, '2024-06-09', '2024-06-09', NULL, NULL, 14, NULL),
(17, 'personalizado', 900.00, '2024-06-09', '2024-06-09', NULL, NULL, 14, NULL),
(18, 'personalizado', 900.00, '2024-06-09', '2024-06-09', NULL, NULL, 14, NULL),
(19, 'personalizado', 900.00, '2024-06-09', '2024-06-09', NULL, NULL, 2, 14),
(20, 'personalizado', 14400.00, '2024-06-16', '2024-06-16', NULL, NULL, 23, 32),
(21, 'personalizado', NULL, '2024-06-22', '2024-06-22', NULL, NULL, 0, 0),
(22, 'personalizado', NULL, '2024-06-22', '2024-06-22', NULL, NULL, 2, 55),
(23, 'personalizado', NULL, '2024-06-22', '2024-06-22', NULL, NULL, 1, 321),
(24, 'personalizado', NULL, '2024-06-22', '2024-06-22', NULL, NULL, 1, 1),
(25, 'personalizado', NULL, '2024-06-22', '2024-06-22', NULL, NULL, 2, 2),
(26, 'personalizado', NULL, '2024-06-22', '2024-06-22', NULL, NULL, 21, 21),
(27, 'personalizado', NULL, '2024-06-22', '2024-06-22', NULL, NULL, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicospedidos`
--

CREATE TABLE `servicospedidos` (
  `idServicosPedidos` int(10) NOT NULL,
  `idServicos` int(10) DEFAULT NULL,
  `idPedidos` int(10) DEFAULT NULL,
  `funcionarioTipo` enum('Garcom','Cozinheiro','Barman') DEFAULT NULL,
  `quantidade` int(10) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servicospedidos`
--

INSERT INTO `servicospedidos` (`idServicosPedidos`, `idServicos`, `idPedidos`, `funcionarioTipo`, `quantidade`, `subtotal`) VALUES
(25, 1, NULL, 'Garcom', 1, 150.00),
(26, 1, NULL, 'Cozinheiro', 2, 300.00),
(27, 1, NULL, 'Barman', 3, 450.00),
(28, 2, NULL, 'Garcom', 2, 300.00),
(29, 2, NULL, 'Cozinheiro', 3, 450.00),
(30, 2, NULL, 'Barman', 4, 600.00),
(31, 3, NULL, 'Garcom', 3, 450.00),
(32, 3, NULL, 'Cozinheiro', 4, 600.00),
(33, 3, NULL, 'Barman', 5, 750.00),
(34, 4, NULL, 'Garcom', 0, 0.00),
(35, 4, NULL, 'Cozinheiro', 0, 0.00),
(36, 4, NULL, 'Barman', 0, 0.00),
(37, 6, NULL, 'Barman', 15, 2250.00),
(38, 6, NULL, 'Garcom', 15, 2250.00),
(39, 6, NULL, 'Cozinheiro', 15, 2250.00),
(40, 7, NULL, 'Barman', 22, 3300.00),
(41, 7, NULL, 'Garcom', 22, 3300.00),
(42, 7, NULL, 'Cozinheiro', 22, 3300.00),
(43, 8, NULL, 'Barman', 22, 3300.00),
(44, 8, NULL, 'Garcom', 22, 3300.00),
(45, 8, NULL, 'Cozinheiro', 22, 3300.00),
(46, 9, NULL, 'Barman', 2, 300.00),
(47, 9, NULL, 'Garcom', 2, 300.00),
(48, 9, NULL, 'Cozinheiro', 2, 300.00),
(49, 10, NULL, 'Barman', 2, 300.00),
(50, 10, NULL, 'Garcom', 2, 300.00),
(51, 10, NULL, 'Cozinheiro', 2, 300.00),
(52, 11, NULL, 'Barman', 2, 300.00),
(53, 11, NULL, 'Garcom', 2, 300.00),
(54, 11, NULL, 'Cozinheiro', 2, 300.00),
(55, 13, NULL, 'Barman', 2, 300.00),
(56, 13, NULL, 'Garcom', 2, 300.00),
(57, 13, NULL, 'Cozinheiro', 2, 300.00),
(58, 14, NULL, 'Barman', 2, 300.00),
(59, 14, NULL, 'Garcom', 21, 3150.00),
(60, 14, NULL, 'Cozinheiro', 2, 300.00),
(61, 15, NULL, 'Barman', 2, 300.00),
(62, 15, NULL, 'Garcom', 2, 300.00),
(63, 15, NULL, 'Cozinheiro', 2, 300.00),
(64, 16, NULL, 'Barman', 2, 300.00),
(65, 16, NULL, 'Garcom', 2, 300.00),
(66, 16, NULL, 'Cozinheiro', 2, 300.00),
(67, 17, NULL, 'Barman', 2, 300.00),
(68, 17, NULL, 'Garcom', 2, 300.00),
(69, 17, NULL, 'Cozinheiro', 2, 300.00),
(70, 18, NULL, 'Barman', 2, 300.00),
(71, 18, NULL, 'Garcom', 2, 300.00),
(72, 18, NULL, 'Cozinheiro', 2, 300.00),
(73, 19, NULL, 'Barman', 2, 300.00),
(74, 19, NULL, 'Garcom', 2, 300.00),
(75, 19, NULL, 'Cozinheiro', 2, 300.00),
(76, 20, NULL, 'Barman', 32, 4800.00),
(77, 20, NULL, 'Garcom', 32, 4800.00),
(78, 20, NULL, 'Cozinheiro', 32, 4800.00),
(79, 21, NULL, '', 2, NULL),
(80, 22, NULL, '', 23, NULL),
(81, 23, NULL, '', 3, NULL),
(82, 24, NULL, '', 1, NULL),
(83, 25, NULL, '', 2, NULL),
(84, 26, NULL, '', 21, NULL),
(85, 27, NULL, '', 2, NULL);

--
-- Acionadores `servicospedidos`
--
DELIMITER $$
CREATE TRIGGER `calcular_total_servicos` AFTER INSERT ON `servicospedidos` FOR EACH ROW BEGIN
    DECLARE total DECIMAL(10,2);
    
    -- Calcular o total de subtotais para o serviço
    SELECT SUM(subtotal) INTO total
    FROM servicosPedidos
    WHERE idServicos = NEW.idServicos;
    
    -- Atualizar o campo total_servicos na tabela Servicos
    UPDATE Servicos
    SET total_servicos = total
    WHERE idServicos = NEW.idServicos;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('oeiyncHKMTAetlNwBFYb1JDb4AB8ttEeY6L8lAWc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaXo4VHRpTm1VOE9KT3VHcXlqNkVLRFpIbEFKbnFsZ25TR1FPMm9aRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1719014305);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Daniel Calebe Alves Ferreira', 'cad2@ds', NULL, '$2y$12$BUujzPflOsKiQSUgcimcIOnPXXe9w4jW2eBPQoVDKkwe5PltnaPZm', NULL, '2024-06-28 23:21:58', '2024-06-28 23:21:58');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admpermissoes`
--
ALTER TABLE `admpermissoes`
  ADD PRIMARY KEY (`idAdmPermissoes`),
  ADD KEY `idFuncionario` (`idFuncionario`);

--
-- Índices para tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`idAgendamento`),
  ADD KEY `idPedidos` (`idPedidos`);

--
-- Índices para tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idClientes`);

--
-- Índices para tabela `enderecosclientes`
--
ALTER TABLE `enderecosclientes`
  ADD PRIMARY KEY (`idEnderecosClientes`),
  ADD KEY `idClientes` (`idClientes`);

--
-- Índices para tabela `esquecisenha`
--
ALTER TABLE `esquecisenha`
  ADD PRIMARY KEY (`idEsqueciSenha`),
  ADD KEY `idClientes` (`idClientes`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`idFeedback`),
  ADD KEY `idPedidos` (`idPedidos`);

--
-- Índices para tabela `formaspagamento`
--
ALTER TABLE `formaspagamento`
  ADD PRIMARY KEY (`idFormaPagamento`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`idFornecedor`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`idFuncionario`);

--
-- Índices para tabela `galeriaimagens`
--
ALTER TABLE `galeriaimagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `gasto`
--
ALTER TABLE `gasto`
  ADD PRIMARY KEY (`idCusto`);

--
-- Índices para tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices para tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `materiaprimaestoque`
--
ALTER TABLE `materiaprimaestoque`
  ADD PRIMARY KEY (`idMateriaPrima`),
  ADD KEY `idFornecedor` (`idFornecedor`);

--
-- Índices para tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `mensagenscliente`
--
ALTER TABLE `mensagenscliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `movimentacoesmateriaprima`
--
ALTER TABLE `movimentacoesmateriaprima`
  ADD PRIMARY KEY (`idMovimentacoesMateriaPrima`),
  ADD KEY `idMateriaPrima` (`idMateriaPrima`);

--
-- Índices para tabela `movimentacoesprodutos`
--
ALTER TABLE `movimentacoesprodutos`
  ADD PRIMARY KEY (`idMovimentacoesProdutos`),
  ADD KEY `idProdutos` (`idProdutos`);

--
-- Índices para tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`idNotificacoes`);

--
-- Índices para tabela `notificacoesclientes`
--
ALTER TABLE `notificacoesclientes`
  ADD PRIMARY KEY (`idNotificacaoClientes`),
  ADD KEY `idPedidos` (`idPedidos`),
  ADD KEY `idClientes` (`idClientes`),
  ADD KEY `idNotificacoes` (`idNotificacoes`);

--
-- Índices para tabela `notificacoesfuncionario`
--
ALTER TABLE `notificacoesfuncionario`
  ADD PRIMARY KEY (`idNotificacaoFuncionario`),
  ADD KEY `idPedidos` (`idPedidos`),
  ADD KEY `idFuncionario` (`idFuncionario`),
  ADD KEY `idNotificacoes` (`idNotificacoes`);

--
-- Índices para tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedidos`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Índices para tabela `pedidosandamentos`
--
ALTER TABLE `pedidosandamentos`
  ADD PRIMARY KEY (`idPedidosAndamentos`),
  ADD KEY `idPedidos` (`idPedidos`);

--
-- Índices para tabela `pedidosprodutos`
--
ALTER TABLE `pedidosprodutos`
  ADD PRIMARY KEY (`idPedidosProdutos`),
  ADD KEY `idPedidos` (`idPedidos`),
  ADD KEY `idProdutos` (`idProdutos`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProdutos`);

--
-- Índices para tabela `receitasitem`
--
ALTER TABLE `receitasitem`
  ADD PRIMARY KEY (`idReceitasItem`),
  ADD KEY `idProdutos` (`idProdutos`),
  ADD KEY `idMateriaPrima` (`idMateriaPrima`);

--
-- Índices para tabela `relatorios`
--
ALTER TABLE `relatorios`
  ADD PRIMARY KEY (`idRelatorio`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`idServicos`);

--
-- Índices para tabela `servicospedidos`
--
ALTER TABLE `servicospedidos`
  ADD PRIMARY KEY (`idServicosPedidos`),
  ADD KEY `idServicos` (`idServicos`),
  ADD KEY `idPedidos` (`idPedidos`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `idAgendamento` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idClientes` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `enderecosclientes`
--
ALTER TABLE `enderecosclientes`
  MODIFY `idEnderecosClientes` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `galeriaimagens`
--
ALTER TABLE `galeriaimagens`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `mensagenscliente`
--
ALTER TABLE `mensagenscliente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `idNotificacoes` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `notificacoesclientes`
--
ALTER TABLE `notificacoesclientes`
  MODIFY `idNotificacaoClientes` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedidos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pedidosprodutos`
--
ALTER TABLE `pedidosprodutos`
  MODIFY `idPedidosProdutos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProdutos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `idServicos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `servicospedidos`
--
ALTER TABLE `servicospedidos`
  MODIFY `idServicosPedidos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `admpermissoes`
--
ALTER TABLE `admpermissoes`
  ADD CONSTRAINT `admpermissoes_ibfk_1` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionarios` (`idFuncionario`);

--
-- Limitadores para a tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`idPedidos`) REFERENCES `pedidos` (`idPedidos`);

--
-- Limitadores para a tabela `enderecosclientes`
--
ALTER TABLE `enderecosclientes`
  ADD CONSTRAINT `enderecosclientes_ibfk_1` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`);

--
-- Limitadores para a tabela `esquecisenha`
--
ALTER TABLE `esquecisenha`
  ADD CONSTRAINT `esquecisenha_ibfk_1` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`);

--
-- Limitadores para a tabela `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`idPedidos`) REFERENCES `pedidos` (`idPedidos`);

--
-- Limitadores para a tabela `materiaprimaestoque`
--
ALTER TABLE `materiaprimaestoque`
  ADD CONSTRAINT `materiaprimaestoque_ibfk_1` FOREIGN KEY (`idFornecedor`) REFERENCES `fornecedor` (`idFornecedor`);

--
-- Limitadores para a tabela `movimentacoesmateriaprima`
--
ALTER TABLE `movimentacoesmateriaprima`
  ADD CONSTRAINT `movimentacoesmateriaprima_ibfk_1` FOREIGN KEY (`idMateriaPrima`) REFERENCES `materiaprimaestoque` (`idMateriaPrima`);

--
-- Limitadores para a tabela `movimentacoesprodutos`
--
ALTER TABLE `movimentacoesprodutos`
  ADD CONSTRAINT `movimentacoesprodutos_ibfk_1` FOREIGN KEY (`idProdutos`) REFERENCES `produtos` (`idProdutos`);

--
-- Limitadores para a tabela `notificacoesclientes`
--
ALTER TABLE `notificacoesclientes`
  ADD CONSTRAINT `notificacoesclientes_ibfk_1` FOREIGN KEY (`idPedidos`) REFERENCES `pedidos` (`idPedidos`),
  ADD CONSTRAINT `notificacoesclientes_ibfk_2` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`),
  ADD CONSTRAINT `notificacoesclientes_ibfk_3` FOREIGN KEY (`idNotificacoes`) REFERENCES `notificacoes` (`idNotificacoes`);

--
-- Limitadores para a tabela `notificacoesfuncionario`
--
ALTER TABLE `notificacoesfuncionario`
  ADD CONSTRAINT `notificacoesfuncionario_ibfk_1` FOREIGN KEY (`idPedidos`) REFERENCES `pedidos` (`idPedidos`),
  ADD CONSTRAINT `notificacoesfuncionario_ibfk_2` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionarios` (`idFuncionario`),
  ADD CONSTRAINT `notificacoesfuncionario_ibfk_3` FOREIGN KEY (`idNotificacoes`) REFERENCES `notificacoes` (`idNotificacoes`);

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idClientes`);

--
-- Limitadores para a tabela `pedidosandamentos`
--
ALTER TABLE `pedidosandamentos`
  ADD CONSTRAINT `pedidosandamentos_ibfk_1` FOREIGN KEY (`idPedidos`) REFERENCES `pedidos` (`idPedidos`);

--
-- Limitadores para a tabela `pedidosprodutos`
--
ALTER TABLE `pedidosprodutos`
  ADD CONSTRAINT `pedidosprodutos_ibfk_1` FOREIGN KEY (`idPedidos`) REFERENCES `pedidos` (`idPedidos`),
  ADD CONSTRAINT `pedidosprodutos_ibfk_2` FOREIGN KEY (`idProdutos`) REFERENCES `produtos` (`idProdutos`);

--
-- Limitadores para a tabela `receitasitem`
--
ALTER TABLE `receitasitem`
  ADD CONSTRAINT `receitasitem_ibfk_1` FOREIGN KEY (`idProdutos`) REFERENCES `produtos` (`idProdutos`),
  ADD CONSTRAINT `receitasitem_ibfk_2` FOREIGN KEY (`idMateriaPrima`) REFERENCES `materiaprimaestoque` (`idMateriaPrima`);

--
-- Limitadores para a tabela `servicospedidos`
--
ALTER TABLE `servicospedidos`
  ADD CONSTRAINT `servicospedidos_ibfk_1` FOREIGN KEY (`idServicos`) REFERENCES `servicos` (`idServicos`),
  ADD CONSTRAINT `servicospedidos_ibfk_2` FOREIGN KEY (`idPedidos`) REFERENCES `pedidos` (`idPedidos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
