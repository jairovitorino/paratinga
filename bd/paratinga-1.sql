-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 30/01/2019 às 18h33min
-- Versão do Servidor: 5.5.16
-- Versão do PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `paratinga`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acoes`
--

CREATE TABLE IF NOT EXISTS `acoes` (
  `id_acao` int(11) NOT NULL AUTO_INCREMENT,
  `nm_acao` varchar(20) NOT NULL,
  PRIMARY KEY (`id_acao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `acoes`
--

INSERT INTO `acoes` (`id_acao`, `nm_acao`) VALUES
(1, 'Inserir'),
(2, 'Editar'),
(3, 'Excluir'),
(4, 'Listar'),
(5, 'Logar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `assuntos`
--

CREATE TABLE IF NOT EXISTS `assuntos` (
  `id_assunto` int(11) NOT NULL AUTO_INCREMENT,
  `nm_assunto` varchar(20) NOT NULL,
  PRIMARY KEY (`id_assunto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `assuntos`
--

INSERT INTO `assuntos` (`id_assunto`, `nm_assunto`) VALUES
(1, 'LIMPEZA'),
(2, 'SEGURANÇA'),
(3, 'ALAGAMENTO'),
(4, 'PORTARIA'),
(5, 'CONSERTO'),
(6, 'ESTRANHOS'),
(7, 'INVASÃO'),
(8, 'INCENDIO'),
(9, 'OUTROS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `dt_log` date NOT NULL,
  `hr_log` varchar(5) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_acao` int(11) NOT NULL,
  `nm_objeto` varchar(50) NOT NULL,
  `nu_ip` varchar(50) NOT NULL,
  `nm_dispositivo` varchar(20) NOT NULL,
  `nu_ano` int(11) NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `id_usuario` (`id_usuario`,`id_acao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2882 ;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id_log`, `dt_log`, `hr_log`, `id_usuario`, `id_acao`, `nm_objeto`, `nu_ip`, `nm_dispositivo`, `nu_ano`) VALUES
(2881, '2019-01-30', '14:04', 73, 5, 'Login', '127.0.0.1', 'Computador', 0),
(2880, '2019-01-30', '13:42', 73, 5, 'Login', '127.0.0.1', 'Computador', 0),
(2879, '2019-01-30', '13:32', 73, 5, 'Login', '127.0.0.1', 'Computador', 2019),
(2878, '2019-01-30', '13:27', 73, 1, 'Ocorrência', '127.0.0.1', 'Computador', 2019),
(2877, '2019-01-30', '13:27', 73, 5, 'Login', '127.0.0.1', 'Computador', 2019),
(2876, '2019-01-30', '13:22', 73, 5, 'Login', '127.0.0.1', 'Computador', 2019),
(2875, '2019-01-30', '13:19', 73, 1, 'Ocorrência', '127.0.0.1', 'Computador', 2019);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencias`
--

CREATE TABLE IF NOT EXISTS `ocorrencias` (
  `id_ocorrencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_assunto` int(11) NOT NULL,
  `dt_relato` date NOT NULL,
  `hr_relato` varchar(5) NOT NULL,
  `te_relato` varchar(255) NOT NULL,
  `te_imagem` varchar(255) NOT NULL,
  `st_relato` int(11) NOT NULL,
  `nu_ano` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_ocorrencia`),
  KEY `id_assunto` (`id_assunto`,`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Extraindo dados da tabela `ocorrencias`
--

INSERT INTO `ocorrencias` (`id_ocorrencia`, `id_assunto`, `dt_relato`, `hr_relato`, `te_relato`, `te_imagem`, `st_relato`, `nu_ano`, `id_usuario`) VALUES
(105, 3, '2019-01-30', '13:07', 'zzczxczx', '', 0, 2019, 74),
(106, 3, '2019-01-30', '13:17', 'asdad', '', 0, 2019, 73),
(107, 7, '2019-01-30', '13:27', 'sfsdfsdfsd', 'iptu_2010.pdf', 1, 2019, 73);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `nm_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`id_status`, `nm_status`) VALUES
(1, 'supervisor'),
(2, 'operador'),
(3, 'visitante'),
(4, 'desligado'),
(5, 'novo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nu_cpf` varchar(11) COLLATE latin1_general_ci NOT NULL,
  `nm_login` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nm_senha` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `st_usuario` int(11) NOT NULL,
  `nu_ip` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `id_sexo` varchar(1) COLLATE latin1_general_ci NOT NULL,
  `nu_lote` varchar(2) COLLATE latin1_general_ci NOT NULL,
  `nm_quadra` varchar(1) COLLATE latin1_general_ci NOT NULL,
  `nu_telefone` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT '3',
  `dt_cadastro` date NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_status` (`id_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=75 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nm_usuario`, `nu_cpf`, `nm_login`, `nm_senha`, `st_usuario`, `nu_ip`, `id_sexo`, `nu_lote`, `nm_quadra`, `nu_telefone`, `id_status`, `dt_cadastro`) VALUES
(40, 'Administrador', '', 'admin', '*2AF5EFAC0B14C5132BCD3D297954B53E634D160F', 0, '', '', '', '', '', 1, '2017-11-04'),
(73, 'jairo vitorino da silva', '13959930500', 'jairo.vitorino@gmail.com', '*CAC926C90985FC48783145FD428E3F0EBDCF43A5', 0, '127.0.0.1', '1', '23', 'L', '', 1, '2019-01-30'),
(74, 'JULIANA MASCARENHAS PEREIRA', '13959930505', 'juliana@gmail.com', '*0801D10217B06C5A9F32430C1A34E030D41A0257', 0, '127.0.0.1', '2', '22', 'Y', '', 2, '2019-01-30'),
(72, 'laura oliveira', '13959930501', 'laurasilva@gmail.com', '*0801D10217B06C5A9F32430C1A34E030D41A0257', 0, '127.0.0.1', '2', '23', 'L', '', 2, '2019-01-30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
