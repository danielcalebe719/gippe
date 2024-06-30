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
-- Banco de dados: `bb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(10) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` int(10) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `status` enum('ativo','inativo') DEFAULT NULL,
  `senha` text DEFAULT NULL,
  `dataCadastro` date DEFAULT current_timestamp(),
  `dataAtualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dataRemocao` date DEFAULT NULL,
  `imgCaminho` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nome`, `email`, `telefone`, `endereco`, `cpf`, `dataNascimento`, `status`, `senha`, `dataCadastro`, `dataAtualizacao`, `dataRemocao`, `imgCaminho`) VALUES
(1, 'sadsad', 'dsadsa', 0, 'dsadsad', NULL, NULL, NULL, NULL, '2024-06-30', '2024-06-30 19:07:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gasto`
--

CREATE TABLE `gasto` (
  `idCusto` int(10) NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `total_gasto` decimal(10,2) DEFAULT NULL,
  `data_gasto` date DEFAULT NULL,
  `dataAtualizacao` date DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `departamento` enum('RH',' Compras','Operacional') NOT NULL,
  `status` enum('a pagar','pago') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `gasto`
--

INSERT INTO `gasto` (`idCusto`, `motivo`, `total_gasto`, `data_gasto`, `dataAtualizacao`, `descricao`, `departamento`, `status`) VALUES
(11120, 'xz\\x\\x', 500.00, '2024-06-15', NULL, 'dasdsads', ' Compras', 'a pagar'),
(11121, 'dsadds', 5.00, '2024-06-14', NULL, 'sdda', 'Operacional', 'a pagar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedidos` int(11) NOT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `observacao` varchar(500) DEFAULT NULL,
  `status` enum('aPagar','pago','recebido','cancelado','entregue') DEFAULT NULL,
  `total_pedido` decimal(10,2) DEFAULT NULL,
  `data_pedido` date DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedidos`, `idCliente`, `observacao`, `status`, `total_pedido`, `data_pedido`, `descricao`) VALUES
(3, 1, 'sadsa', 'aPagar', 500.00, '2024-06-21', 'sadsadsa'),
(4, 1, 'sadsa', 'pago', 506.00, '2024-06-21', 'sadsadsa'),
(5, 1, 'sadsa', 'aPagar', 1000.00, '2024-06-21', 'sadsadsa'),
(6, 1, 'sadsa', 'aPagar', 500.00, '2024-06-21', 'sadsadsa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidosprodutos`
--

CREATE TABLE `pedidosprodutos` (
  `idPedidosProdutos` int(11) NOT NULL,
  `idPedidos` int(11) DEFAULT NULL,
  `idProdutos` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidosprodutos`
--

INSERT INTO `pedidosprodutos` (`idPedidosProdutos`, `idPedidos`, `idProdutos`, `quantidade`, `subtotal`) VALUES
(1, 4, 1, 22, 312.00),
(2, 3, 3, 2, 2.00),
(3, 6, 2, 22, 0.00),
(4, 5, 4, 22, 22.00),
(5, 5, 5, 22, 0.00),
(6, 3, 3, 2, 2.00),
(7, 6, 2, 22, 0.00),
(8, 5, 4, 22, 22.00),
(9, 5, 5, 22, 22.00),
(10, 3, 6, 60, 2.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProdutos` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `tipo` enum('salgado','bebida','doce') DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
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
(1, 'coxinha', 'dasdsada', 'salgado', 10, 'pendente', 10.00, '2024-06-10', NULL, NULL, NULL),
(2, 'coca cola', 'asdsda', 'bebida', 22, 'pendente', 22.00, NULL, NULL, NULL, NULL),
(3, 'beijinho', 'dasdsa', 'doce', 22, 'pendente', 22.00, NULL, NULL, NULL, NULL),
(4, 'fanta', 'dsada', 'bebida', 22, 'pendente', 22.00, NULL, NULL, NULL, NULL),
(5, 'quibe', 'dsada', 'salgado', 22, 'pendente', 22.00, NULL, NULL, NULL, NULL),
(6, 'calango amanteigado', 'dsadad', 'salgado', 10, 'pendente', 10.00, NULL, NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices para tabela `gasto`
--
ALTER TABLE `gasto`
  ADD PRIMARY KEY (`idCusto`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedidos`),
  ADD KEY `fk_idCliente` (`idCliente`);

--
-- Índices para tabela `pedidosprodutos`
--
ALTER TABLE `pedidosprodutos`
  ADD PRIMARY KEY (`idPedidosProdutos`),
  ADD KEY `fk_idPedidos` (`idPedidos`),
  ADD KEY `fk_idProdutos` (`idProdutos`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProdutos`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `gasto`
--
ALTER TABLE `gasto`
  MODIFY `idCusto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11122;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pedidosprodutos`
--
ALTER TABLE `pedidosprodutos`
  MODIFY `idPedidosProdutos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProdutos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_idCliente` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`);

--
-- Limitadores para a tabela `pedidosprodutos`
--
ALTER TABLE `pedidosprodutos`
  ADD CONSTRAINT `fk_idPedidos` FOREIGN KEY (`idPedidos`) REFERENCES `pedidos` (`idPedidos`),
  ADD CONSTRAINT `fk_idProdutos` FOREIGN KEY (`idProdutos`) REFERENCES `produtos` (`idProdutos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
