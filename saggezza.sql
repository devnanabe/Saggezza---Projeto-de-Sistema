-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Mar-2024 às 14:22
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
-- Banco de dados: `saggezza`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `apontamentos`
--

CREATE TABLE `apontamentos` (
  `ap_id` int(11) NOT NULL,
  `ap_cliente` int(11) NOT NULL,
  `ap_equipamento` int(11) NOT NULL,
  `ap_valor` decimal(15,2) NOT NULL,
  `ap_data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `apontamentos`
--

INSERT INTO `apontamentos` (`ap_id`, `ap_cliente`, `ap_equipamento`, `ap_valor`, `ap_data`) VALUES
(1, 1, 1, 9.15, '2024-03-19'),
(2, 2, 2, 10.00, '1970-01-01'),
(3, 2, 1, 15.50, '2024-03-20'),
(4, 1, 1, 12.00, '2024-03-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `cl_id` int(11) NOT NULL,
  `cl_nome` varchar(50) NOT NULL,
  `cl_telefone` char(14) DEFAULT NULL,
  `cl_responsavel` varchar(40) NOT NULL,
  `cl_email` varchar(30) NOT NULL,
  `cl_data_cad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cl_id`, `cl_nome`, `cl_telefone`, `cl_responsavel`, `cl_email`, `cl_data_cad`) VALUES
(1, 'usuario 01', '12 99123 4578', 'responsavel 01', 'usuario01@gmail.com', '2024-03-20 00:33:55'),
(2, 'usuario 02', '12 98316 4578', 'responsavel 02', 'usuario02@gmail.com', '2024-03-20 01:00:08'),
(3, 'usuario 03', '12 91234 5678', 'responsavel 03', 'usuario03@gmail.com', '2024-03-20 05:21:22'),
(4, 'usuario 04', '12 91236 7894', 'responsavel 04', 'usuario04@gmail.com', '2024-03-20 12:58:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `eq_id` int(11) NOT NULL,
  `eq_nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `equipamentos`
--

INSERT INTO `equipamentos` (`eq_id`, `eq_nome`) VALUES
(1, 'equipamento 01'),
(2, 'equipamento 02'),
(3, 'equipamento 03'),
(4, 'equipamento 04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricantes`
--

CREATE TABLE `fabricantes` (
  `fa_id` int(11) NOT NULL,
  `fa_nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `fabricantes`
--

INSERT INTO `fabricantes` (`fa_id`, `fa_nome`) VALUES
(1, 'fabricante 01'),
(2, 'fabricante 02'),
(3, 'fabricante 03'),
(4, 'fabricante 04'),
(5, 'fabricante 05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

CREATE TABLE `imagens` (
  `im_id` int(11) NOT NULL,
  `im_cliente` int(11) NOT NULL,
  `im_equipamento` int(11) NOT NULL,
  `im_data` date NOT NULL,
  `im_nome_image` varchar(100) NOT NULL,
  `im_path_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `imagens`
--

INSERT INTO `imagens` (`im_id`, `im_cliente`, `im_equipamento`, `im_data`, `im_nome_image`, `im_path_image`) VALUES
(1, 1, 1, '2024-03-19', 'troca-de-oleo.jpg', '../Upload/65fa3920d8436.jpg'),
(3, 2, 2, '2024-03-19', 'montadora-de-carro.jpg', '../Upload/65fa39792fe03.jpg'),
(4, 2, 1, '2024-03-19', 'troca-de-oleo.jpg', '../Upload/65fa398c275fd.jpg'),
(5, 1, 1, '2024-03-20', 'troca-de-oleo.jpg', '../Upload/65fa82974f65f.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lubrificantes`
--

CREATE TABLE `lubrificantes` (
  `lu_id` int(11) NOT NULL,
  `lu_nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `lubrificantes`
--

INSERT INTO `lubrificantes` (`lu_id`, `lu_nome`) VALUES
(1, 'lubrificante 01'),
(2, 'lubrificante 02'),
(3, 'lubrificante 03'),
(4, 'lubrificante 04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `maquinas`
--

CREATE TABLE `maquinas` (
  `ma_id` int(11) NOT NULL,
  `ma_equipamento` int(11) NOT NULL,
  `ma_cliente` int(11) NOT NULL,
  `ma_fabricante` int(11) NOT NULL,
  `ma_tipo` int(11) NOT NULL,
  `ma_lubrificante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `maquinas`
--

INSERT INTO `maquinas` (`ma_id`, `ma_equipamento`, `ma_cliente`, `ma_fabricante`, `ma_tipo`, `ma_lubrificante`) VALUES
(1, 1, 1, 2, 2, 2),
(2, 2, 1, 1, 3, 2),
(3, 2, 1, 1, 2, 2),
(4, 3, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sinalizacoes`
--

CREATE TABLE `sinalizacoes` (
  `si_id` int(11) NOT NULL,
  `si_cliente` int(11) NOT NULL,
  `si_equipamento` int(11) NOT NULL,
  `si_sinalizacao` varchar(255) NOT NULL,
  `si_data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `sinalizacoes`
--

INSERT INTO `sinalizacoes` (`si_id`, `si_cliente`, `si_equipamento`, `si_sinalizacao`, `si_data`) VALUES
(1, 1, 1, 'primeira sinalização.', '2024-03-19'),
(2, 2, 2, 'segunda sinalização.', '2024-03-20'),
(3, 1, 3, 'terceira sinalização.', '2024-03-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_maquina`
--

CREATE TABLE `tipos_maquina` (
  `tm_id` int(11) NOT NULL,
  `tm_tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tipos_maquina`
--

INSERT INTO `tipos_maquina` (`tm_id`, `tm_tipo`) VALUES
(1, 'maquina 01'),
(2, 'maquina 02'),
(3, 'maquina 03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_usuario`
--

CREATE TABLE `tipos_usuario` (
  `tu_id` int(11) NOT NULL,
  `tu_tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`tu_id`, `tu_tipo`) VALUES
(1, 'Administrador'),
(2, 'Operacional'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `us_id` int(11) NOT NULL,
  `us_nome` varchar(40) NOT NULL,
  `us_senha` varchar(100) NOT NULL,
  `us_cliente` int(10) DEFAULT NULL,
  `us_email` varchar(30) NOT NULL,
  `us_telefone` char(14) DEFAULT NULL,
  `us_tipo` int(10) NOT NULL,
  `cl_data_cad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`us_id`, `us_nome`, `us_senha`, `us_cliente`, `us_email`, `us_telefone`, `us_tipo`, `cl_data_cad`) VALUES
(16, 'John', '$2y$10$dFgaIjmSHxQnPDOEZpnIzOEsZXQGh0D.gOgVhboNUIpzYw3gwfMS.', 1, 'john@gmail.com', '12 92316 4678', 1, '2024-03-20 05:18:23'),
(18, 'Nicole', '$2y$10$h6zJDv6TKIKgg6rdwcOunuarPrgt9pWmeIm1BGCAbihmu5T7J5Tau', 1, 'nicolemunis@gmail.com', '12 91245 7896', 2, '2024-03-20 05:23:11'),
(19, 'Ana Carolina Pereira', '$2y$10$soy6U.0Spj9zghmd7PlnDuv/.vnpTN3rYndPrIV8Q9jXBAZ8YO/X6', 2, 'anacarolina@gmail.com', '12 91245 2147', 2, '2024-03-20 05:26:21'),
(20, 'Beatriz Ferreira', '$2y$10$swJqp.XBWZ01Ml.TrqSsb.XhqEts0qeQbvcBonMhEfEIbwCvx7wve', 1, 'beatriz@gmail.com', '12 91245 7896', 2, '2024-03-20 05:30:28'),
(21, 'Vitoria Lemes', '$2y$10$NWlGEikMj9L4vTp5sATOyOUnTQTE52K3Pukd7a5KOAGROO/72HR2C', 1, 'vitorialemes@gmail.com', '12 91475 6589', 3, '2024-03-20 05:35:07'),
(22, 'Lucia Silvia', '$2y$10$vZtx52.QIDQx1HyHRzQqSOxRW/5iCciEtkgJ89Di860SqAXY0BPP2', 3, 'Luciasilvia@gmail.com', '12 91475 6589', 1, '2024-03-20 05:37:46'),
(24, 'Lucia Maria', '$2y$10$rpBoFR5BArlT6oH3pKnMC.3IYUKmhsrpfZZcpNeDLSL23DN3ZvtJS', 2, 'luciamaria@gmail.com', '12914756589', 2, '2024-03-20 05:40:23'),
(25, 'Lucia Crispim', '$2y$10$v3LYHffCbE6vexUmKpmFIOGQERcxwmRF9IYuR5cPJij9ruYC.0XLm', 1, 'luciacrispim@gmail.com', '12 91475 6589', 1, '2024-03-20 05:48:52');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `apontamentos`
--
ALTER TABLE `apontamentos`
  ADD PRIMARY KEY (`ap_id`),
  ADD KEY `ap_cliente` (`ap_cliente`),
  ADD KEY `ap_equipamento` (`ap_equipamento`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cl_id`);

--
-- Índices para tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`eq_id`);

--
-- Índices para tabela `fabricantes`
--
ALTER TABLE `fabricantes`
  ADD PRIMARY KEY (`fa_id`);

--
-- Índices para tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`im_id`),
  ADD KEY `im_cliente` (`im_cliente`),
  ADD KEY `im_equipamento` (`im_equipamento`);

--
-- Índices para tabela `lubrificantes`
--
ALTER TABLE `lubrificantes`
  ADD PRIMARY KEY (`lu_id`);

--
-- Índices para tabela `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`ma_id`),
  ADD KEY `ma_cliente` (`ma_cliente`),
  ADD KEY `ma_equipamento` (`ma_equipamento`),
  ADD KEY `ma_fabricante` (`ma_fabricante`),
  ADD KEY `ma_lubrificante` (`ma_lubrificante`),
  ADD KEY `ma_tipo` (`ma_tipo`);

--
-- Índices para tabela `sinalizacoes`
--
ALTER TABLE `sinalizacoes`
  ADD PRIMARY KEY (`si_id`);

--
-- Índices para tabela `tipos_maquina`
--
ALTER TABLE `tipos_maquina`
  ADD PRIMARY KEY (`tm_id`);

--
-- Índices para tabela `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  ADD PRIMARY KEY (`tu_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`us_id`),
  ADD KEY `us_cliente` (`us_cliente`),
  ADD KEY `us_tipo` (`us_tipo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `apontamentos`
--
ALTER TABLE `apontamentos`
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `eq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `fabricantes`
--
ALTER TABLE `fabricantes`
  MODIFY `fa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `im_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `lubrificantes`
--
ALTER TABLE `lubrificantes`
  MODIFY `lu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `ma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `sinalizacoes`
--
ALTER TABLE `sinalizacoes`
  MODIFY `si_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipos_maquina`
--
ALTER TABLE `tipos_maquina`
  MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  MODIFY `tu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `apontamentos`
--
ALTER TABLE `apontamentos`
  ADD CONSTRAINT `apontamentos_ibfk_1` FOREIGN KEY (`ap_cliente`) REFERENCES `clientes` (`cl_id`),
  ADD CONSTRAINT `apontamentos_ibfk_2` FOREIGN KEY (`ap_equipamento`) REFERENCES `equipamentos` (`eq_id`);

--
-- Limitadores para a tabela `imagens`
--
ALTER TABLE `imagens`
  ADD CONSTRAINT `imagens_ibfk_1` FOREIGN KEY (`im_cliente`) REFERENCES `clientes` (`cl_id`),
  ADD CONSTRAINT `imagens_ibfk_2` FOREIGN KEY (`im_equipamento`) REFERENCES `equipamentos` (`eq_id`);

--
-- Limitadores para a tabela `maquinas`
--
ALTER TABLE `maquinas`
  ADD CONSTRAINT `maquinas_ibfk_1` FOREIGN KEY (`ma_cliente`) REFERENCES `clientes` (`cl_id`),
  ADD CONSTRAINT `maquinas_ibfk_2` FOREIGN KEY (`ma_equipamento`) REFERENCES `equipamentos` (`eq_id`),
  ADD CONSTRAINT `maquinas_ibfk_3` FOREIGN KEY (`ma_fabricante`) REFERENCES `fabricantes` (`fa_id`),
  ADD CONSTRAINT `maquinas_ibfk_4` FOREIGN KEY (`ma_lubrificante`) REFERENCES `lubrificantes` (`lu_id`),
  ADD CONSTRAINT `maquinas_ibfk_5` FOREIGN KEY (`ma_tipo`) REFERENCES `tipos_maquina` (`tm_id`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`us_cliente`) REFERENCES `clientes` (`cl_id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`us_tipo`) REFERENCES `tipos_usuario` (`tu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
