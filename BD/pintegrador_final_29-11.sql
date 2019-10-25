-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29-Nov-2016 às 03:30
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
  `descricao` varchar(200) NOT NULL,
  `imagem` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nome`, `descricao`, `imagem`) VALUES
(3, 'Lanches', 'Lanches em geral, xis, torradas, cachorro quente, etc.', '76e6a6535e25abae51e6224328b52d51.png'),
(4, 'PorÃ§Ãµes', 'Petiscos em geral, porÃ§Ã£o de tamanho padrÃ£o', '6178dc86547127a90c8d8b5347e71fe6.png'),
(5, 'PastÃ©is', 'PastÃ©is tamanho padrÃ£o de diversos sabores', 'a2a678e19f052735af275ea870ff5515.png'),
(6, 'Sobremesas', 'Doces e sobremesas quentes ou geladas', '408e45aeffe572ebbe890bd441caeeea.png'),
(7, 'Bebidas', 'Bebidas em geral, sucos, refrigerantes, alcoÃ³licos e demais', '5bff79ce276e73cd62daafa0e64d8e38.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `sexo` char(1) NOT NULL,
  `nascimento` date NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `loginExt` tinyint(1) NOT NULL DEFAULT '0',
  `flagSenha` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nome`, `cpf`, `telefone`, `sexo`, `nascimento`, `email`, `senha`, `loginExt`, `flagSenha`) VALUES
(2, 'Gustavo Girardi', '020.327.260-92', '(54)9999-9999', 'm', '1994-09-03', 'girardigustavo.03@gmail.com', NULL, 1, 0),
(3, 'Gustavo Girardi dos Passos', '265.897.114-91', '(54)9999-9999', 'm', '1994-09-03', 'girardi_gustavo@outlook.com', 'fa564a82d58b9d97fad38d95446b6784', 0, 0);

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

--
-- Extraindo dados da tabela `combinacao`
--

INSERT INTO `combinacao` (`idCombinacao`, `idSabor1`, `idSabor2`, `idSabor3`, `idTipoPizza`) VALUES
(13, 1, NULL, NULL, 2),
(14, 2, NULL, NULL, 2),
(15, 3, NULL, NULL, 2),
(16, 1, 3, NULL, 3),
(17, 1, 2, NULL, 3),
(18, 2, 3, 7, 6),
(19, 11, 13, NULL, 5),
(20, 2, 3, NULL, 5),
(21, 3, 6, NULL, 3),
(22, 2, 7, NULL, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `destaques`
--

CREATE TABLE `destaques` (
  `idDestaque` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `destaques`
--

INSERT INTO `destaques` (`idDestaque`, `idProduto`) VALUES
(4, 8),
(1, 11),
(2, 12),
(5, 14),
(6, 15),
(7, 17),
(3, 19),
(8, 50);

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

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`idEndereco`, `rua`, `numero`, `bairro`, `complemento`, `cep`, `cidade`, `idCliente`) VALUES
(1, 'Rua Professora Iza de Lourdes da Costa Moura', 191, 'Colina da lagoa', '0', '95300-000', 'Lagoa Vermelha', 2),
(2, 'Rua Professora Iza de Lourdes da Costa Moura', 191, 'Colina da lagoa', '0', '95300-000', 'Lagoa Vermelha', 2),
(3, 'Rua Afonso Pena', 122, 'Centro', '1', '95300000', 'Lagoa Vermelha', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itempedido`
--

CREATE TABLE `itempedido` (
  `idPedido` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `idCombinacao` int(11) DEFAULT NULL,
  `idProduto` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valorUnitarioItem` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itempedido`
--

INSERT INTO `itempedido` (`idPedido`, `idItem`, `idCombinacao`, `idProduto`, `quantidade`, `valorUnitarioItem`) VALUES
(6, 7, NULL, 12, 2, 15.5),
(6, 8, 21, NULL, 2, 34.874),
(6, 9, 22, NULL, 1, 35.861),
(7, 10, NULL, 8, 3, 12.5),
(8, 11, NULL, 14, 2, 4.5),
(8, 12, NULL, 40, 2, 1.99),
(8, 13, NULL, 45, 4, 4.5);

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

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`idPedido`, `valorTotal`, `idEndereco`, `codigoValidacao`, `idCliente`, `dataPedido`, `status`) VALUES
(6, 136.609, 3, '88DVD', 3, '2016-11-27 23:47:51', '0'),
(7, 37.5, 3, 'W2KNU', 3, '2016-11-27 23:55:15', '0'),
(8, 30.98, 2, '6SQO6', 2, '2016-11-29 02:16:54', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idProduto` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
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
(8, 'Pastel Frango', 'Ingredientes: frango, milho, ervilha e requeijÃ£o', '00:20:00', 12.5, 5, '01fc4fcee77cf95c9fe7921292ceeb33.jpg'),
(9, 'PorÃ§Ã£o frango', 'Frango frito Ã  milanesa', '00:15:00', 11.5, 4, '9d6d07fe0340cead5ae39b27caa1bfb8.jpg'),
(10, 'Heavy Bacon Burger', 'Hamburguer de carne, crispy bacon e cebola refogada', '00:25:00', 15.5, 3, '26bd99ca33caf445d2c5a9ba6ff44247.jpg'),
(11, 'Combo Bacon Burger', 'Hamburguer de carne, crispy bacon e cebola refogada + porÃ§Ã£o de fritas e salada', '00:25:00', 19.9, 3, '459fa369b881a2e023e09ab13d68fd2f.jpg'),
(12, 'Combo Burger', 'Hamburguer acompanhado de fritas e salada', '00:22:00', 15.5, 3, 'bc3e9ff7d4326b6348abdeb3ef0d8722.jpg'),
(13, 'Chicken Burger', 'Hamburger de franco com cebola e queijo cheddar', '00:15:00', 12.9, 3, '31f70783745c961ac66ffc19c5e59217.jpg'),
(14, 'Sorvete de LimÃ£o e cha verde', 'ChÃ¡ verde, suco de limÃ£o, raspas de limÃ£o e leite condensado', '00:00:00', 4.5, 6, '3c7c2071d33d4c134ac1b30289c77e68.jpg'),
(15, 'PavÃª de maracujÃ¡', 'Chocolate ao leite, leite condensado, suco de maracujÃ¡ e gotas de chocolate', '00:00:00', 5.8, 6, '9e7e5de9345d498470b389d1cd985a23.jpg'),
(16, 'PavÃª de uvas e baunilha', 'PavÃª de baunilha com calda de uvas rosas', '00:00:00', 4.9, 6, '8b32efc74a6158975fdf7acd86012fc2.jpg'),
(17, 'PavÃª doce de leite, coco e abacaxi', 'Doce de leite, coco ralado e pedaÃ§os de abacaxi', '00:00:00', 6.9, 6, '19bcd32bb793db15f5899935f922101e.jpg'),
(18, 'Tabua de petiscos', 'Picanha, coraÃ§Ã£o de frango, polenta, mandioca e batata frita', '00:00:25', 49.9, 4, '0c3a10c770420349a33fa07b8c093058.jpg'),
(19, 'Polenta com queijo', 'Polenta frita em tiras com queijo ralado derretido', '00:00:12', 22.9, 4, '30fa9774a7544223eba15c7bda029851.jpg'),
(20, 'Mandioca frita', 'Mandioca frita', '00:00:10', 12.9, 4, '92e2ff15b980059ff77da2056b16ed9c.jpg'),
(21, 'CamarÃ£o frito', 'CamarÃ£o Ã  milanesa frito', '00:00:15', 45.9, 4, 'bca67c58b6ad918f176575919accb0ae.png'),
(22, 'Batata frita', 'Batata frita', '00:00:08', 9.9, 4, '9dd505082881f310a4482542caa97170.jpg'),
(23, 'Picanha com cebola', 'Picanha com cebola', '00:00:18', 29.9, 4, '18017a871f220818165f85eae361430d.jpg'),
(24, 'Pastel tradicional', 'Carne, tempeiro verde e ovo cozido picado', '00:00:06', 12.9, 5, '7c27c85e367bc8d313d3a5c8a4649bd5.jpg'),
(25, 'Pastel carne seca', 'Carne seca e temperos', '00:00:10', 14.9, 5, '112cc6000ea10a3c32ec2da3a3a859e1.jpg'),
(26, 'Pastel bacalhau', 'Bacalhau desfiado e temperos', '00:00:14', 16.9, 5, '2a2d190d7ddb862f7a0cda921a41abdd.jpg'),
(27, 'Pastel de chocolate', 'Chocolate ao leite com morangos', '00:00:10', 16.9, 5, '289fbcab22d2c2509c64666390cba6bb.jpg'),
(28, 'Pastel de camarÃ£o', 'camarÃ£o e temperos', '00:00:15', 19.9, 5, 'fc7cd0c002fd790693016c6fcbd69562.jpg'),
(29, 'Burger Hunter', 'Cebola, linguiÃ§a defumada frita e queijo muzzarela', '00:00:17', 15.9, 3, 'e40f68e9d69555088a16dc77f1384d1a.jpg'),
(30, 'Coca cola lata', 'Coca cola lata 350ml', '00:00:00', 2.5, 7, 'a5cc81835c766cea0826a6674a13440f.jpg'),
(31, 'Coca cola', 'Coca cola 2l', '00:00:00', 6.9, 7, '9df4a7c5cfae3b1f85c0e7e14fef057a.jpg'),
(32, 'Pepsi lata', 'Refrigerante Pepsi lata 350ml', '00:00:00', 2.5, 7, '280103e0b55eedf2b94b30b4c344427a.jpg'),
(33, 'Pepsi ', 'Refrigerante Pepsi 2l', '00:00:00', 6.5, 7, 'ad6f95b555f500416f84894268786f8c.jpg'),
(34, 'Guarana Antartica lata', 'Refrigerante Guarana Antartica lata 350ml', '00:00:00', 1.99, 7, '3a22bb3d63fe4d6c507a4d821ebe0bb1.jpg'),
(35, 'Guarana Antartica 2l', 'Refrigerante Guarana Antartica 2l', '00:00:00', 5.5, 7, '54e20c9b4f80ab4d1cda7ee0bce58324.jpg'),
(36, 'Guarana Kuat lata', 'Refrigerante Guarana Kuat lata 350ml', '00:00:00', 1.99, 7, 'df62ba26469dbe25faf816233c129688.jpg'),
(37, 'Guarana Kuat 2l', 'Refrigerante Guarana Kuat 2l', '00:00:00', 5.5, 7, '28d1ad2ece6c268857935d1f0b257212.jpg'),
(38, 'Fanta Laranja lata', 'Refrigerante Fanta Laranja lata 350ml', '00:00:00', 1.99, 7, '965ccbebeda4ce9b80be1638c9b8360d.jpg'),
(39, 'Fanta Laranja 2l', 'Refrigerante Fanta Laranja 2l', '00:00:00', 5.5, 7, '238834e101767b0c3011f6ac66e472f2.jpg'),
(40, 'Fanta Uva lata', 'Refrigerante Fanta Uva lata 350ml', '00:00:00', 1.99, 7, 'c6078a9b00858b1b6bd43f1461b81131.jpg'),
(41, 'Fanta Uva 2l', 'Refrigerante Fanta Uva 2l', '00:00:00', 5.5, 7, 'd0e91f1506fef9ad938965f12004cb0e.jpg'),
(42, 'Suco natural pÃªssego', 'Suco natural pÃªssego Del Valle 350ml', '00:00:00', 2.69, 7, 'd05b0098b14425a17ddd43980bd44530.jpg'),
(43, 'Suco natural manga', 'Suco natural manga Del Valle 350ml', '00:00:00', 2.69, 7, 'a2c08e5c7f6f05b08e5817dd3b285725.jpe'),
(44, 'Suco natural uva', 'Suco natural uva Del Valle 350ml', '00:00:00', 2.69, 7, 'a211440d451f1a7afa0c3678e9387717.jpg'),
(45, 'Cerveja Skol', 'Cerveja Skol lata 350ml', '00:00:00', 4.5, 7, '6fbab49482f9fe428531423c37eb4d47.jpg'),
(46, 'Cerveja Brahma', 'Cerveja Brahma lata 350ml', '00:00:00', 4.5, 7, 'c7576f996e7b175d3e20101f8afd5ffd.jpg'),
(47, 'Cerveja Budweiser', 'Cerveja Budweiser lata 350ml', '00:00:00', 4.5, 7, '8b45917e54e397c493ec3883ccd8bee9.jpg'),
(48, 'Cerveja AntÃ¡rtica', 'Cerveja AntÃ¡rtica lata 350ml', '00:00:00', 4.5, 7, '0517c9ef21d2889990559333ab674733.jpg'),
(49, 'Cerveja Kaiser', 'Cerveja Kaiser lata 350ml', '00:00:00', 4.5, 7, '6b81f940da58f4cb8e8dde1d97a2a89b.jpg'),
(50, 'Chopp Brahma', 'Chopp Brahma copo 500ml', '00:00:00', 9.9, 7, '307ad075b1b18c354445ce4450736c38.jpg');

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
(1, 'Calabreza', 'Molho de tomate, calabreza, muzzarela e orÃ©gano', 28.9, '1fe910991310439f605ee67277475a31.png'),
(2, 'Al caponi', 'Molho de tomate, mussarela, mortadela defumada, pimentÃ£o, orÃ©gano e azeite', 25.9, '8457a950c4f60affd1ff814ea0969c10.jpg'),
(3, 'Frango & Catupiry', 'Molho de tomate, mussarela, catupiry, frango desfiado', 29.9, 'f978fae4496fb7306f768ced5d86cb7b.png'),
(4, 'Strogonoff', 'molho de tomate, queijo mussarela, strogonoff de carne e batata palha.', 45.9, 'd0330adfda9855a79914581cbfc3f978.png'),
(5, 'Ratatouille', 'Molho de tomate, beringela, cebola, abobrinha, pimentÃ£o e orÃ©gano', 35.9, 'd42f66b56934949d3c548b76e52e1af8.png'),
(6, 'Alho e Ã³leo', 'Molho de tomate, queijo mussarela, alho frito, azeite e orÃ©gano.', 32.9, '45f785f8ce6d5e22944d772d7f13a795.png'),
(7, 'Pizza de Batata', 'Massa de batata, rodelas de tomate, orÃ©gano, champignons fatiados, mussarela picada e azeitona.', 32.9, 'fe0c27462ea294c6e3fea09c40647001.png'),
(8, 'Lombo com abacaxi', 'Molho de tomate, cebola refogada, queijo mussarela, fatias de lombo, abacaxi e queijo provolone.', 39.9, 'fbc592eb9f465c51359bd4c46723395a.png'),
(9, 'Quatro queijos', 'Molho de tomate, queijos mussarela, provolone, catupiry e parmesÃ£o', 26.9, 'bc0017537c79797b4fb1334f03232cdf.png'),
(10, 'Lombo com cheddar', 'Molho de tomate, cebola refogada, fatias de lombo, queijo mussarela e cheddar.', 38.9, '60ecc209d8407b96d1cbf2037683abff.png'),
(11, 'Portuguesa', 'Molho de tomate, queijo mussarela, presunto, rodelas de ovo, rodelas de tomate, pimentÃ£o, cebola e orÃ©gano', 32.9, '481a91296fe046b416ebdf7fa08637a8.png'),
(12, 'Marguerita', 'Molho de tomate, queijo mussarela, rodelas de tomate, azeite, manjericÃ£o e orÃ©gano', 29.9, 'c5966d57f3bf950cd70ad43212e3da2c.png'),
(13, 'Chocolate com castanhas', 'Chocolate ao leite e castanhas do parÃ¡', 36.9, '55baefcdc89efd682802b10813440587.png'),
(14, 'Floresta negra', 'Chocxolate ao leite, sorvete de creme, raspas de chocolate meio amargo e morangos', 36.9, '11225359f138fa0e6c1053f6e1ce6547.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipopizza`
--

CREATE TABLE `tipopizza` (
  `idTipoPizza` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `reajuste` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipopizza`
--

INSERT INTO `tipopizza` (`idTipoPizza`, `descricao`, `quantidade`, `reajuste`) VALUES
(1, 'Pequena', 1, 0),
(2, 'Media 1 sabor', 1, 5),
(3, 'Media 2 sabores', 2, 6),
(4, 'Grande 1 sabor', 1, 8),
(5, 'Grande 2 sabores', 2, 9),
(6, 'Grande 3 sabores', 3, 10);

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
-- Indexes for table `destaques`
--
ALTER TABLE `destaques`
  ADD PRIMARY KEY (`idDestaque`),
  ADD KEY `idProduto` (`idProduto`);

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
  ADD PRIMARY KEY (`idPedido`,`idItem`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `combinacao` (`idCombinacao`),
  ADD KEY `produto` (`idProduto`),
  ADD KEY `INDEX` (`idItem`);

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
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `combinacao`
--
ALTER TABLE `combinacao`
  MODIFY `idCombinacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `destaques`
--
ALTER TABLE `destaques`
  MODIFY `idDestaque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `itempedido`
--
ALTER TABLE `itempedido`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `sabor`
--
ALTER TABLE `sabor`
  MODIFY `idSabor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tipopizza`
--
ALTER TABLE `tipopizza`
  MODIFY `idTipoPizza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
-- Limitadores para a tabela `destaques`
--
ALTER TABLE `destaques`
  ADD CONSTRAINT `destaque_produto_fk` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`idProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `itemPedido_pedido_fk` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION;

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
