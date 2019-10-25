-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Set-2016 às 00:35
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pintegrador`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nome` varchar(15) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nome`, `descricao`) VALUES
(2, 'Gastel', 'PastÃ©is tamanho padrÃ£o de diversos sabores'),
(3, 'Lanches', 'Pequena'),
(4, 'Fatima Lima Gir', 'Grande'),
(5, 'Portuguesa', 'Lanches em geral, xis, torradas, cachorro quente, etc.'),
(6, 'Fatima Lima Gir', 'Ingredientes: milho, queijo muzzarela, tomate');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `telefone` varchar(10) NOT NULL,
  `sexo` char(1) NOT NULL,
  `nascimento` date NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `combinacao`
--

CREATE TABLE `combinacao` (
  `idCombinacao` int(11) NOT NULL,
  `idSabor1` int(11) NOT NULL,
  `idSabor2` int(11) DEFAULT NULL,
  `idSabor3` int(11) DEFAULT NULL,
  `idTipoPizza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `idEndereco` int(11) NOT NULL,
  `rua` varchar(200) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `cep` varchar(11) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itempedido`
--

CREATE TABLE `itempedido` (
  `idPedido` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `idCombinacao` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valorUnitarioItem` float NOT NULL,
  `valorTotalItem` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `valorTotal` float NOT NULL,
  `idEndereco` int(11) DEFAULT NULL,
  `codigoValidacao` varchar(5) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `dataPedido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idProduto` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `tempoPreparo` time NOT NULL,
  `valor` float NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `imagem` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `nome`, `descricao`, `tempoPreparo`, `valor`, `idCategoria`, `imagem`) VALUES
(1, 'Pastel Tebanos', 'Ingredientes: milho, queijo muzzarela, tomate', '00:20:00', 22, 2, '2ad755c7c3ae77149b59b7d4db9ce5f7.jpg'),
(2, 'Coca Cola 1L', 'Coca cola retornÃ¡vel 1L', '00:00:00', 4.5, 2, '9ff021a0ee629c053f5c1b7b41407666.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sabor`
--

CREATE TABLE `sabor` (
  `idSabor` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `valor` float NOT NULL,
  `imagem` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sabor`
--

INSERT INTO `sabor` (`idSabor`, `nome`, `descricao`, `valor`, `imagem`) VALUES
(5, 'Lanches', 'Pequena', 22, 'ef3ed7b46d6a8578f6f8d89defa45b60.jpg'),
(6, 'Lanches', 'Pequena', 22, 'b7b9308ecb493467a0cbb8bcb29e86bb.jpg'),
(7, 'Lanches', 'Pequena', 22, 'db2a2217e275559cf9e9ca93045d3d50.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipopizza`
--

CREATE TABLE `tipopizza` (
  `idTipoPizza` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipopizza`
--

INSERT INTO `tipopizza` (`idTipoPizza`, `descricao`, `quantidade`) VALUES
(2, 'Pequenaaaaaa', 1),
(3, 'Grande 1 sabor', 1),
(4, 'Grande 2 sabores', 2),
(5, 'Media', 1),
(6, 'Media 2 sabores', 2),
(7, 'Grande 3 sabores', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `permissao` varchar(5) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `username`, `senha`, `permissao`) VALUES
(1, 'Gustavo Girardi dos Passos', 'ggpassos', '63797faee8c413c0c066ee4e1af342dc', 'admin'),
(2, 'Guilherme Girardi', 'guigirardi', 'b7087c1f4f89e63af8d46f3b20271153', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indexes for table `combinacao`
--
ALTER TABLE `combinacao`
  ADD PRIMARY KEY (`idCombinacao`),
  ADD KEY `sabor1` (`idSabor1`),
  ADD KEY `sabor2` (`idSabor2`),
  ADD KEY `sabor3` (`idSabor3`),
  ADD KEY `tipoPizza` (`idTipoPizza`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idEndereco`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indexes for table `itempedido`
--
ALTER TABLE `itempedido`
  ADD PRIMARY KEY (`idPedido`,`idProduto`),
  ADD KEY `itemPedido_produto_fk` (`idProduto`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `combinacao` (`idCombinacao`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `INDEX` (`idCliente`),
  ADD KEY `enderecoEntrega` (`idEndereco`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idProduto`),
  ADD KEY `index` (`idCategoria`);

--
-- Indexes for table `sabor`
--
ALTER TABLE `sabor`
  ADD PRIMARY KEY (`idSabor`);

--
-- Indexes for table `tipopizza`
--
ALTER TABLE `tipopizza`
  ADD PRIMARY KEY (`idTipoPizza`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `combinacao`
--
ALTER TABLE `combinacao`
  MODIFY `idCombinacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idEndereco` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sabor`
--
ALTER TABLE `sabor`
  MODIFY `idSabor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tipopizza`
--
ALTER TABLE `tipopizza`
  MODIFY `idTipoPizza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `combinacao`
--
ALTER TABLE `combinacao`
  ADD CONSTRAINT `combinacao_sabor1_fk` FOREIGN KEY (`idSabor1`) REFERENCES `sabor` (`idSabor`),
  ADD CONSTRAINT `combinacao_sabor2_fk` FOREIGN KEY (`idSabor2`) REFERENCES `sabor` (`idSabor`),
  ADD CONSTRAINT `combinacao_sabor3_fk` FOREIGN KEY (`idSabor3`) REFERENCES `sabor` (`idSabor`),
  ADD CONSTRAINT `combinacao_tipo_fk` FOREIGN KEY (`idTipoPizza`) REFERENCES `tipopizza` (`idTipoPizza`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_cliente_fk` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`);

--
-- Limitadores para a tabela `itempedido`
--
ALTER TABLE `itempedido`
  ADD CONSTRAINT `itemPedido_combinacao_fk` FOREIGN KEY (`idCombinacao`) REFERENCES `combinacao` (`idCombinacao`),
  ADD CONSTRAINT `itemPedido_pedido_fk` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION,
  ADD CONSTRAINT `itemPedido_produto_fk` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`idProduto`) ON DELETE NO ACTION;

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_cliente_fk` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `pedido_endereco_fk` FOREIGN KEY (`idEndereco`) REFERENCES `endereco` (`idEndereco`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_categoria_fk` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
