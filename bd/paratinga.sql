-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 02/02/2019 às 03h19min
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2947 ;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id_log`, `dt_log`, `hr_log`, `id_usuario`, `id_acao`, `nm_objeto`, `nu_ip`, `nm_dispositivo`, `nu_ano`) VALUES
(2937, '2019-02-02', '20:34', 77, 5, 'Login', '::1', 'Computador', 0),
(2936, '2019-02-02', '20:33', 73, 5, 'Login', '::1', 'Computador', 0),
(2935, '2019-02-02', '20:32', 77, 1, 'Ocorrência', '::1', 'Computador', 0),
(2934, '2019-02-02', '20:32', 77, 5, 'Login', '::1', 'Computador', 0),
(2933, '2019-02-02', '20:32', 73, 1, 'Ocorrência', '::1', 'Computador', 0),
(2932, '2019-02-02', '20:28', 73, 5, 'Login', '::1', 'Computador', 0),
(2931, '2019-02-01', '16:14', 73, 5, 'Login', '::1', 'Computador', 0),
(2930, '2019-02-01', '16:06', 73, 5, 'Login', '::1', 'Computador', 0),
(2929, '2019-02-01', '16:02', 40, 5, 'Login', '::1', 'Computador', 0),
(2928, '2019-02-01', '16:00', 73, 5, 'Login', '::1', 'Computador', 0),
(2927, '2019-02-01', '15:08', 73, 5, 'Login', '::1', 'Computador', 0),
(2926, '2019-02-01', '21:44', 73, 5, 'Login', '::1', 'Computador', 0),
(2925, '2019-02-01', '21:43', 77, 5, 'Login', '::1', 'Computador', 0),
(2924, '2019-02-01', '21:39', 73, 5, 'Login', '::1', 'Computador', 0),
(2923, '2019-02-01', '21:38', 77, 5, 'Login', '::1', 'Computador', 0),
(2922, '2019-02-01', '21:38', 40, 5, 'Login', '::1', 'Computador', 0),
(2921, '2019-02-01', '21:38', 56, 5, 'valdevino@gmail.com', '::1', 'Computador', 0),
(2920, '2019-02-01', '21:38', 56, 5, 'valdevino@gmail.com', '::1', 'Computador', 0),
(2919, '2019-02-01', '21:38', 56, 5, 'valdevino@gmail.com', '::1', 'Computador', 0),
(2918, '2019-02-01', '21:37', 73, 5, 'Login', '::1', 'Computador', 0),
(2917, '2019-02-01', '21:15', 73, 5, 'Login', '::1', 'Computador', 0),
(2916, '2019-02-01', '20:56', 73, 5, 'Login', '::1', 'Computador', 0),
(2915, '2019-01-31', '00:26', 77, 1, 'Ocorrência', '::1', 'Computador', 0),
(2914, '2019-01-31', '00:25', 77, 5, 'Login', '::1', 'Computador', 0),
(2913, '2019-01-31', '00:25', 77, 2, 'Usuário', '::1', '', 0),
(2912, '2019-01-31', '00:25', 40, 5, 'Login', '::1', 'Computador', 0),
(2911, '2019-01-31', '00:24', 73, 5, 'Login', '::1', 'Computador', 0),
(2938, '2019-02-02', '20:34', 77, 1, 'Ocorrência', '::1', 'Computador', 0),
(2939, '2019-02-02', '20:35', 77, 1, 'Ocorrência', '::1', 'Computador', 0),
(2940, '2019-02-02', '20:38', 77, 1, 'Ocorrência', '::1', 'Computador', 0),
(2941, '2019-02-02', '20:38', 73, 5, 'Login', '::1', 'Computador', 0),
(2942, '2019-02-02', '20:42', 77, 5, 'Login', '::1', 'Computador', 0),
(2943, '2019-02-02', '20:42', 77, 1, 'Ocorrência', '::1', 'Computador', 0),
(2944, '2019-02-02', '20:42', 56, 5, 'monique@gmail.com', '::1', 'Computador', 0),
(2945, '2019-02-02', '20:42', 77, 5, 'Login', '::1', 'Computador', 0),
(2946, '2019-02-02', '20:42', 73, 5, 'Login', '::1', 'Computador', 0);

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
  `te_relato_dir` varchar(255) NOT NULL,
  `nm_diretor` varchar(40) NOT NULL,
  `te_imagem` varchar(255) NOT NULL,
  `st_relato` int(11) NOT NULL,
  `nu_ano` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_ocorrencia`),
  KEY `id_assunto` (`id_assunto`,`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Extraindo dados da tabela `ocorrencias`
--

INSERT INTO `ocorrencias` (`id_ocorrencia`, `id_assunto`, `dt_relato`, `hr_relato`, `te_relato`, `te_relato_dir`, `nm_diretor`, `te_imagem`, `st_relato`, `nu_ano`, `id_usuario`) VALUES
(117, 3, '2019-02-02', '20:38', 'asddasdasdasdas', 'Prdro avancou', 'jairo vitorino da silva', '', 1, 0, 77),
(118, 8, '2019-02-02', '20:42', 'cczxcasdasdas', 'scasdasdasdasda', 'jairo vitorino da silva', '', 0, 0, 77);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=78 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nm_usuario`, `nu_cpf`, `nm_login`, `nm_senha`, `st_usuario`, `nu_ip`, `id_sexo`, `nu_lote`, `nm_quadra`, `nu_telefone`, `id_status`, `dt_cadastro`) VALUES
(40, 'Administrador', '', 'admin', '*2AF5EFAC0B14C5132BCD3D297954B53E634D160F', 0, '', '', '', '', '', 1, '2017-11-04'),
(73, 'jairo vitorino da silva', '13959930500', 'jairo.vitorino@gmail.com', '*CAC926C90985FC48783145FD428E3F0EBDCF43A5', 0, '127.0.0.1', '1', '23', 'L', '', 1, '2019-01-30'),
(77, 'MONIQUE', '02350499561', 'monique@gmail.com', '*0801D10217B06C5A9F32430C1A34E030D41A0257', 0, '::1', '2', '23', 'U', '', 2, '2019-01-31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
