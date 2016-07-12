-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12-Jul-2016 às 12:15
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cruddb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `cd_produto` int(11) NOT NULL AUTO_INCREMENT,
  `dc_descricao` varchar(250) NOT NULL,
  `nm_saldo` int(11) NOT NULL,
  `vl_preco` float(10,2) NOT NULL,
  `id_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cd_produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`cd_produto`, `dc_descricao`, `nm_saldo`, `vl_preco`, `id_status`) VALUES
(1, 'Produto 1', 10, 200.00, 1),
(2, 'Produto 2', 20, 150.00, 1),
(3, 'Produto 3', 30, 200.00, 1),
(4, 'Produto 4', 40, 250.00, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
