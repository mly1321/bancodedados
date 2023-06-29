-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/06/2023 às 13:45
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `NomeAluno` varchar(45) NOT NULL,
  `NoMatricula` int(11) NOT NULL,
  `Nascimento` date NOT NULL,
  `Profissao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `Valor` double NOT NULL,
  `NomeCurso` varchar(45) NOT NULL,
  `Horário` time NOT NULL,
  `CodCurso` int(11) NOT NULL,
  `DataInicio` date NOT NULL,
  `DataFim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `instrutor`
--

CREATE TABLE `instrutor` (
  `Registro` int(11) NOT NULL,
  `Salario` double NOT NULL,
  `Dia` date NOT NULL,
  `Turno` int(11) NOT NULL,
  `NomeInst` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `matriculado`
--

CREATE TABLE `matriculado` (
  `Aluno_NoMatricula` int(11) NOT NULL,
  `Curso_CodCurso` int(11) NOT NULL,
  `Frequencia` double NOT NULL,
  `Nota` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ministra`
--

CREATE TABLE `ministra` (
  `Instrutor_Registro` int(11) NOT NULL,
  `Curso_CodCurso` int(11) NOT NULL,
  `Nota` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`NoMatricula`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`CodCurso`);

--
-- Índices de tabela `instrutor`
--
ALTER TABLE `instrutor`
  ADD PRIMARY KEY (`Registro`);

--
-- Índices de tabela `matriculado`
--
ALTER TABLE `matriculado`
  ADD PRIMARY KEY (`Aluno_NoMatricula`,`Curso_CodCurso`),
  ADD KEY `Curso_CodCurso` (`Curso_CodCurso`);

--
-- Índices de tabela `ministra`
--
ALTER TABLE `ministra`
  ADD PRIMARY KEY (`Instrutor_Registro`,`Curso_CodCurso`),
  ADD KEY `Curso_CodCurso` (`Curso_CodCurso`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `matriculado`
--
ALTER TABLE `matriculado`
  ADD CONSTRAINT `matriculado_ibfk_1` FOREIGN KEY (`Curso_CodCurso`) REFERENCES `ministra` (`Curso_CodCurso`),
  ADD CONSTRAINT `matriculado_ibfk_2` FOREIGN KEY (`Aluno_NoMatricula`) REFERENCES `aluno` (`NoMatricula`);

--
-- Restrições para tabelas `ministra`
--
ALTER TABLE `ministra`
  ADD CONSTRAINT `ministra_ibfk_1` FOREIGN KEY (`Instrutor_Registro`) REFERENCES `instrutor` (`Registro`),
  ADD CONSTRAINT `ministra_ibfk_2` FOREIGN KEY (`Curso_CodCurso`) REFERENCES `curso` (`CodCurso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
