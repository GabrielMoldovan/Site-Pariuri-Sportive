-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Gazda: localhost
-- Timp de generare: 04 Mai 2012 la 21:34
-- Versiune server: 5.1.36
-- Versiune PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Baza de date: `bet`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `money` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Salvarea datelor din tabel `accounts`
--


-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `meciuri`
--

CREATE TABLE IF NOT EXISTS `meciuri` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tip` varchar(255) NOT NULL,
  `team1` varchar(255) NOT NULL,
  `team2` varchar(255) NOT NULL,
  `team1c` float NOT NULL,
  `team2c` float NOT NULL,
  `teamx` float NOT NULL,
  `date` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Salvarea datelor din tabel `meciuri`
--


-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `pariu`
--

CREATE TABLE IF NOT EXISTS `pariu` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pid` int(5) NOT NULL,
  `team` int(9) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `suma` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Salvarea datelor din tabel `pariu`
--


-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `payout`
--

CREATE TABLE IF NOT EXISTS `payout` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `suma` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Salvarea datelor din tabel `payout`
--


-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `recharge`
--

CREATE TABLE IF NOT EXISTS `recharge` (
  `paycode` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sum` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `recharge`
--


-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `setname` varchar(255) NOT NULL,
  `setvalue` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `settings`
--

INSERT INTO `settings` (`setname`, `setvalue`) VALUES
('paypalacc', 'ceva@yahoo.com');
