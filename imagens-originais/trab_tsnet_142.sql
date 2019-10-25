-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Jun-2016 às 18:05
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trab_tsnet_142`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `idCidade` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `uf` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`idCidade`, `nome`, `uf`) VALUES
(4, 'Passo Fundo', 'RS'),
(6, 'SÃ£o Paulo', 'SP'),
(7, 'Porto Alegre', 'RS'),
(8, 'Itapema', 'SC'),
(9, 'Caxias do Sul', 'RS'),
(10, 'FlorianÃ³polis', 'SC');

-- --------------------------------------------------------

--
-- Estrutura da tabela `companhia`
--

CREATE TABLE `companhia` (
  `idCompanhia` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `companhia`
--

INSERT INTO `companhia` (`idCompanhia`, `nome`) VALUES
(5, 'Latam Linhas AÃ©reas'),
(7, 'Azul linhas aÃ©reas'),
(8, 'Gol Linhas AÃ©reas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

CREATE TABLE `compra` (
  `idCompra` int(11) NOT NULL,
  `dataCompra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valorTotal` decimal(10,2) DEFAULT NULL,
  `cod` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `compra`
--

INSERT INTO `compra` (`idCompra`, `dataCompra`, `valorTotal`, `cod`) VALUES
(38, '2016-06-22 01:02:06', '2163.00', 'ddc26af85ed8374f71f2881193ba8968'),
(42, '2016-06-23 03:24:21', '455.00', '14a1e98210e3eac2520401bf6d51b828'),
(43, '2016-06-23 03:26:00', '910.00', '6f5666fa1f70fe68564cc6c8a182ed9a'),
(44, '2016-06-23 03:55:16', '455.00', 'ef6b8443209fb77b57c7f9751c54a1b3'),
(45, '2016-06-23 03:57:38', '455.00', '2a866c3c8e85886e16c0a4b2b9b3d69e'),
(46, '2016-06-23 03:57:54', '2275.00', '37d3b82f45fa419e1e9cd4eaf742f85f'),
(47, '2016-06-23 03:58:11', '1155.00', '15f64f1d67631c9a99f3fce4c3260290'),
(48, '2016-06-23 03:58:38', '1748.00', '0b1ea1bf13e390dbffed5817f12d5219'),
(49, '2016-06-23 15:25:42', '455.00', 'e19001a8569cb9b62bfaae0dc3793fd4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compraitem`
--

CREATE TABLE `compraitem` (
  `idUsuario` int(11) NOT NULL,
  `idPassagem` int(11) NOT NULL,
  `idCompra` int(11) NOT NULL,
  `quantidade` int(3) NOT NULL,
  `valorTotalItem` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `compraitem`
--

INSERT INTO `compraitem` (`idUsuario`, `idPassagem`, `idCompra`, `quantidade`, `valorTotalItem`) VALUES
(1, 1, 48, 2, 978),
(1, 2, 47, 3, 1155),
(1, 2, 48, 2, 770),
(1, 3, 38, 3, 1365),
(1, 3, 42, 1, 455),
(1, 3, 43, 2, 910),
(1, 3, 44, 1, 455),
(1, 3, 45, 1, 455),
(1, 3, 46, 5, 2275),
(1, 3, 49, 1, 455);

-- --------------------------------------------------------

--
-- Estrutura da tabela `destino`
--

CREATE TABLE `destino` (
  `idDestino` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `idCidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `destino`
--

INSERT INTO `destino` (`idDestino`, `nome`, `endereco`, `idCidade`) VALUES
(2, 'FLN - FlorianÃ³polis', 'Av. Dep. DiomÃ­cio Freitas, 3393 - Carianos', 10),
(3, 'CXJ - Caxias do Sul', 'Rua Bento GonÃ§alves, n185', 9),
(4, 'POA - Porto Alegre', 'Rod. BR 116, km 250', 7),
(5, 'GRU - SÃ£o Paulo', 'Avenida Tom Jobim, n4589', 6),
(6, 'PFB - Passo Fundo', 'BR 285, km 122', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `origem`
--

CREATE TABLE `origem` (
  `idOrigem` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `idCidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `origem`
--

INSERT INTO `origem` (`idOrigem`, `nome`, `endereco`, `idCidade`) VALUES
(2, 'FLN - FlorianÃ³polis', 'Av. Dep. DiomÃ­cio Freitas, 3393 - Carianos', 10),
(3, 'CXJ - Caxias do Sul', 'Rua Bento GonÃ§alves, n185', 9),
(4, 'POA - Porto Alegre', 'Rod. BR 116, km 250', 7),
(5, 'GRU - SÃ£o Paulo', 'Avenida Tom Jobim, n4589', 6),
(6, 'PFB - Passo Fundo', 'BR 285, km 122', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `passagem`
--

CREATE TABLE `passagem` (
  `idPassagem` int(11) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `dataPartida` date DEFAULT NULL,
  `imagem` varchar(300) NOT NULL,
  `idCompanhia` int(11) DEFAULT NULL,
  `idOrigem` int(11) DEFAULT NULL,
  `idDestino` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `passagem`
--

INSERT INTO `passagem` (`idPassagem`, `descricao`, `preco`, `quantidade`, `dataPartida`, `imagem`, `idCompanhia`, `idOrigem`, `idDestino`) VALUES
(1, 'Voo 1386 - Tv e Wifi disponiveis, partida 13h, chegada prevista 18h', 469, 40, '2016-10-12', 'f68dadba4d94ec15809765d63b4bb84d.jpg', 5, 3, 5),
(2, 'Voo1085, partida 15:30h, previsÃ£o de chegada 21:45h, com escala em Porto Alegre', 385, 15, '2016-11-03', 'fefbc96b72f1be73531706c52b458bf8.jpg', 7, 2, 3),
(3, 'Voo 1025 - partida 18:50h, chegada prevista 20:30h', 455, 13, '2016-11-04', '42cfa64401e9a902075165e1be09c670.jpg', 7, 5, 2),
(4, 'Voo 1828 - partida 21:30h, chegada prevista 23:30h', 399, 20, '2016-12-01', 'b4f586a4ef5fa62ee8c59ce58bc81a7b.jpg', 5, 5, 4),
(5, 'Voo 7885', 299, 10, '2016-10-20', 'b9a22666d8abb15a415d2fcb2f4acd90.jpg', 8, 4, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `sexo` varchar(10) NOT NULL,
  `nascimento` date NOT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `dataCadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `cpf`, `nome`, `sexo`, `nascimento`, `endereco`, `email`, `senha`, `dataCadastro`, `tipo`) VALUES
(1, '88888888888', 'Gustavo Girardi', 'masculino', '0000-00-00', 'Rua Número 2,189', 'gus@gus.com', 'e10adc3949ba59abbe56e057f20f883e', '2016-05-29 03:00:00', 'admin'),
(2, '02032726092', 'Gustavo ', 'masculino', '2016-06-01', 'BR 285, km 125', 'girardi_gustavo@outlook.com', '4c96f8324e3ba54a99e78249b95daa30', '2016-06-21 04:15:57', 'user'),
(3, '41094131091', 'Guilherme Girardi dos Passos', 'masculino', '2005-06-14', 'Rua ProfÂª Iza de L. da C. Moura', 'gui@gui.com.br', '192309aaddc500140db28668e1bbd8b5', '2016-06-22 00:59:09', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`idCidade`);

--
-- Indexes for table `companhia`
--
ALTER TABLE `companhia`
  ADD PRIMARY KEY (`idCompanhia`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idCompra`);

--
-- Indexes for table `compraitem`
--
ALTER TABLE `compraitem`
  ADD PRIMARY KEY (`idUsuario`,`idPassagem`,`idCompra`),
  ADD KEY `idPassagem` (`idPassagem`),
  ADD KEY `idCompra` (`idCompra`);

--
-- Indexes for table `destino`
--
ALTER TABLE `destino`
  ADD PRIMARY KEY (`idDestino`),
  ADD KEY `idCidade` (`idCidade`);

--
-- Indexes for table `origem`
--
ALTER TABLE `origem`
  ADD PRIMARY KEY (`idOrigem`),
  ADD KEY `origem_ibfk_1` (`idCidade`);

--
-- Indexes for table `passagem`
--
ALTER TABLE `passagem`
  ADD PRIMARY KEY (`idPassagem`),
  ADD KEY `passagem_ibfk_2` (`idOrigem`),
  ADD KEY `passagem_ibfk_3` (`idDestino`),
  ADD KEY `passagem_ibfk_1` (`idCompanhia`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
  MODIFY `idCidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `companhia`
--
ALTER TABLE `companhia`
  MODIFY `idCompanhia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `destino`
--
ALTER TABLE `destino`
  MODIFY `idDestino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `origem`
--
ALTER TABLE `origem`
  MODIFY `idOrigem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `passagem`
--
ALTER TABLE `passagem`
  MODIFY `idPassagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `compraitem`
--
ALTER TABLE `compraitem`
  ADD CONSTRAINT `compraitem_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `compraitem_ibfk_2` FOREIGN KEY (`idPassagem`) REFERENCES `passagem` (`idPassagem`),
  ADD CONSTRAINT `compraitem_ibfk_3` FOREIGN KEY (`idCompra`) REFERENCES `compra` (`idCompra`);

--
-- Limitadores para a tabela `destino`
--
ALTER TABLE `destino`
  ADD CONSTRAINT `destino_ibfk_1` FOREIGN KEY (`idCidade`) REFERENCES `cidade` (`idCidade`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `origem`
--
ALTER TABLE `origem`
  ADD CONSTRAINT `origem_ibfk_1` FOREIGN KEY (`idCidade`) REFERENCES `cidade` (`idCidade`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `passagem`
--
ALTER TABLE `passagem`
  ADD CONSTRAINT `passagem_ibfk_1` FOREIGN KEY (`idCompanhia`) REFERENCES `companhia` (`idCompanhia`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `passagem_ibfk_2` FOREIGN KEY (`idOrigem`) REFERENCES `origem` (`idOrigem`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `passagem_ibfk_3` FOREIGN KEY (`idDestino`) REFERENCES `destino` (`idDestino`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
