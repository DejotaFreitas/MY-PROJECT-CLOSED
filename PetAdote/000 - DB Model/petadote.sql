-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 14-Abr-2018 às 14:48
-- Versão do servidor: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petadote`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

DROP TABLE IF EXISTS `cidade`;
CREATE TABLE IF NOT EXISTS `cidade` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  `estado_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cidade_estado1_idx` (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `cor_fundo` varchar(45) DEFAULT NULL,
  `cor_logo` varchar(45) DEFAULT NULL,
  `cor_corpo` varchar(45) DEFAULT NULL,
  `estilo_icone` varchar(45) DEFAULT NULL,
  `menu_lateral` varchar(45) DEFAULT NULL,
  `tamanho_texto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `fk_config_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncia`
--

DROP TABLE IF EXISTS `denuncia`;
CREATE TABLE IF NOT EXISTS `denuncia` (
  `tipo` enum('pet','noticia','usuario') NOT NULL,
  `delator` int(10) UNSIGNED NOT NULL,
  `denunciado` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`tipo`,`delator`,`denunciado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_estado_pais1_idx` (`pais_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

DROP TABLE IF EXISTS `instituicao`;
CREATE TABLE IF NOT EXISTS `instituicao` (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `historia` blob,
  `como_receber_ajuda` blob,
  `processo_adocao` blob,
  `conteudo_educativo` blob,
  `facebook` varchar(200) DEFAULT NULL,
  `instagram` varchar(200) DEFAULT NULL,
  `youtube` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `googleplus` varchar(200) DEFAULT NULL,
  `site` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

DROP TABLE IF EXISTS `noticias`;
CREATE TABLE IF NOT EXISTS `noticias` (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `time` int(20) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` blob NOT NULL,
  PRIMARY KEY (`usuario_id`,`time`),
  KEY `fk_noticias_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `parceiros`
--

DROP TABLE IF EXISTS `parceiros`;
CREATE TABLE IF NOT EXISTS `parceiros` (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `site` varchar(200) DEFAULT NULL,
  `foto` varchar(200) NOT NULL,
  PRIMARY KEY (`usuario_id`,`cnpj`),
  KEY `fk_parceiros_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pet`
--

DROP TABLE IF EXISTS `pet`;
CREATE TABLE IF NOT EXISTS `pet` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `especie` enum('Cachorro','Gato') NOT NULL,
  `genero` enum('Macho','Fêmea') NOT NULL,
  `idade` enum('Filhote','Adulto') NOT NULL,
  `porte` enum('Pequeno','Médio','Grande') NOT NULL,
  `castrado` enum('Sim','Não') NOT NULL,
  `vacinado` enum('Sim','Não') NOT NULL,
  `descricao` varchar(600) DEFAULT NULL,
  `foto_facial` varchar(200) NOT NULL,
  `foto_lateral` varchar(200) NOT NULL,
  `foto_superior` varchar(200) NOT NULL,
  `time` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacao`
--

DROP TABLE IF EXISTS `relacao`;
CREATE TABLE IF NOT EXISTS `relacao` (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `pet_id` int(10) UNSIGNED NOT NULL,
  `relacao` enum('Doação','Doador','Aguardando','Aceito','Recusado','Perdido','Encontrado','Aguardando_Perdido','Aguardando_Encontrado','Aceito_Perdido','Aceito_Encontrado','Recusado_Perdido','Recusado_Encontrado','Doador_Perdido','Doador_Encontrado') NOT NULL,
  `time` int(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`pet_id`,`usuario_id`),
  KEY `fk_usuario_has_pet_pet1_idx` (`pet_id`),
  KEY `fk_usuario_has_pet_usuario_idx` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` enum('p','i') NOT NULL,
  `nome` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `foto` varchar(200) NOT NULL,
  `senha` char(60) NOT NULL,
  `time` int(20) NOT NULL,
  `cidade_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuario_cidade1_idx` (`cidade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `fk_cidade_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `fk_config_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `fk_estado_pais1` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `instituicao`
--
ALTER TABLE `instituicao`
  ADD CONSTRAINT `fk_redes_sociais_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_noticias_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `parceiros`
--
ALTER TABLE `parceiros`
  ADD CONSTRAINT `fk_parceiros_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `relacao`
--
ALTER TABLE `relacao`
  ADD CONSTRAINT `fk_usuario_has_pet_pet1` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_pet_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_cidade1` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
