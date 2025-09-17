-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/09/2025 às 02:38
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `diabetes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `controle_dt`
--

CREATE TABLE `controle_dt` (
  `ID_DT` int(11) NOT NULL,
  `Glicose` float DEFAULT NULL,
  `Gord_fig` float DEFAULT NULL,
  `Dt` date DEFAULT NULL,
  `Hora` datetime DEFAULT NULL,
  `ID_PC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `controle_dt`
--

INSERT INTO `controle_dt` (`ID_DT`, `Glicose`, `Gord_fig`, `Dt`, `Hora`, `ID_PC`) VALUES
(1, 120, 30.5, '2022-01-01', '2025-09-16 21:12:26', 1),
(2, 100, 25.1, '2022-01-02', '2025-09-16 21:12:26', 2),
(3, 140, 35.2, '2022-01-03', '2025-09-16 21:12:26', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `glicemia`
--

CREATE TABLE `glicemia` (
  `ID_GLICEMIA` int(11) NOT NULL,
  `Glicose` float NOT NULL,
  `Gord_fig` float DEFAULT NULL,
  `Dt` date NOT NULL,
  `Hora` time NOT NULL,
  `ID_PC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `glicemia`
--

INSERT INTO `glicemia` (`ID_GLICEMIA`, `Glicose`, `Gord_fig`, `Dt`, `Hora`, `ID_PC`) VALUES
(1, 200, NULL, '2028-02-22', '02:02:00', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `medicamentos`
--

CREATE TABLE `medicamentos` (
  `ID_MED` int(11) NOT NULL,
  `Medicamento` varchar(45) DEFAULT NULL,
  `Dose_med` varchar(45) DEFAULT NULL,
  `Paciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `medicamentos`
--

INSERT INTO `medicamentos` (`ID_MED`, `Medicamento`, `Dose_med`, `Paciente`) VALUES
(1, 'Metformina', '500mg', 1),
(2, 'Insulina', '10 UI', 2),
(3, 'Glimepirida', '2mg', 3),
(4, 'Arroz', '200mg', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

CREATE TABLE `paciente` (
  `ID_PC` int(11) NOT NULL,
  `Nome_PC` varchar(50) DEFAULT NULL,
  `Idade` int(11) DEFAULT NULL,
  `Peso` float DEFAULT NULL,
  `Sexo` varchar(2) DEFAULT NULL,
  `Naft` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `paciente`
--

INSERT INTO `paciente` (`ID_PC`, `Nome_PC`, `Idade`, `Peso`, `Sexo`, `Naft`) VALUES
(1, 'João Silva', 35, 70.5, 'M', 1),
(2, 'Maria Santos', 28, 55.2, 'F', 0),
(3, 'Pedro Oliveira', 42, 80.1, 'M', 1),
(4, 'Evelly', 20, 49, 'F', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `controle_dt`
--
ALTER TABLE `controle_dt`
  ADD PRIMARY KEY (`ID_DT`),
  ADD KEY `ID_PC` (`ID_PC`);

--
-- Índices de tabela `glicemia`
--
ALTER TABLE `glicemia`
  ADD PRIMARY KEY (`ID_GLICEMIA`),
  ADD KEY `ID_PC` (`ID_PC`);

--
-- Índices de tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`ID_MED`),
  ADD KEY `Paciente` (`Paciente`);

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`ID_PC`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `glicemia`
--
ALTER TABLE `glicemia`
  MODIFY `ID_GLICEMIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `controle_dt`
--
ALTER TABLE `controle_dt`
  ADD CONSTRAINT `controle_dt_ibfk_1` FOREIGN KEY (`ID_PC`) REFERENCES `paciente` (`ID_PC`);

--
-- Restrições para tabelas `glicemia`
--
ALTER TABLE `glicemia`
  ADD CONSTRAINT `glicemia_ibfk_1` FOREIGN KEY (`ID_PC`) REFERENCES `paciente` (`ID_PC`);

--
-- Restrições para tabelas `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD CONSTRAINT `medicamentos_ibfk_1` FOREIGN KEY (`Paciente`) REFERENCES `paciente` (`ID_PC`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
