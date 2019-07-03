-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01-Jun-2017 às 20:01
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptweb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `id_alerta` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `af_andar`
--

CREATE TABLE `af_andar` (
  `id` int(11) NOT NULL,
  `frequencia` enum('0','1','2','3','4','5','6','7','8','9','10','10+') NOT NULL,
  `duracao` int(10) NOT NULL,
  `condicao_saude` enum('Melhorou','Manteve','Agravou') NOT NULL,
  `id_af` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `af_sentado`
--

CREATE TABLE `af_sentado` (
  `id` int(11) NOT NULL,
  `duracao` int(10) NOT NULL,
  `condicao_saude` enum('Melhorou','Manteve','Agravou') NOT NULL,
  `id_af` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alertas`
--

CREATE TABLE `alertas` (
  `id` int(10) NOT NULL,
  `tipo` int(10) NOT NULL,
  `descrição` varchar(250) NOT NULL,
  `limite_minimo` int(10) DEFAULT NULL,
  `limite_maximo` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade_fisica`
--

CREATE TABLE `atividade_fisica` (
  `id` int(10) NOT NULL,
  `id_utente` int(10) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_biometricos`
--

CREATE TABLE `dados_biometricos` (
  `id` int(10) NOT NULL,
  `id_utente` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dor`
--

CREATE TABLE `dor` (
  `id` int(10) NOT NULL,
  `cabeca` int(2) NOT NULL DEFAULT '0',
  `pesoco` int(2) NOT NULL DEFAULT '0',
  `ombros` int(2) NOT NULL DEFAULT '0',
  `bracos` int(2) NOT NULL DEFAULT '0',
  `punhos_maos` int(2) NOT NULL DEFAULT '0',
  `coluna_toracica` int(2) NOT NULL DEFAULT '0',
  `lombar` int(2) NOT NULL DEFAULT '0',
  `anca` int(2) NOT NULL DEFAULT '0',
  `coxa` int(2) DEFAULT '0',
  `joelho` int(2) NOT NULL DEFAULT '0',
  `tornozelos_pes` int(2) NOT NULL DEFAULT '0',
  `id_historico_saude` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `educacao_formal`
--

CREATE TABLE `educacao_formal` (
  `id` int(11) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `familiar`
--

CREATE TABLE `familiar` (
  `id_familiar` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_utente_associado` int(11) NOT NULL,
  `grau_parentesco` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia_cardiaca`
--

CREATE TABLE `frequencia_cardiaca` (
  `id` int(10) NOT NULL,
  `data` date NOT NULL,
  `hora` varchar(250) NOT NULL,
  `frequencia_cardiaca` int(11) NOT NULL,
  `responsavel` varchar(250) NOT NULL,
  `id_dados_biometricos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_saude`
--

CREATE TABLE `historico_saude` (
  `id` int(10) NOT NULL,
  `id_utente` int(10) NOT NULL,
  `data` date NOT NULL,
  `hipertensao_arterial` varchar(250) NOT NULL,
  `diabetes` varchar(250) NOT NULL,
  `artrose` varchar(250) NOT NULL,
  `espondiloartrose` varchar(250) NOT NULL,
  `patologia_vascular` varchar(250) NOT NULL,
  `patologia_respiratoria` varchar(250) NOT NULL,
  `cancro` varchar(250) NOT NULL,
  `depressao` varchar(250) NOT NULL,
  `trombose` varchar(250) NOT NULL,
  `outra` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `literacia_informatica`
--

CREATE TABLE `literacia_informatica` (
  `id` int(11) NOT NULL,
  `telemovel` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `computador_ou_tablet` enum('0','1') NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tensao_arterial`
--

CREATE TABLE `tensao_arterial` (
  `id` int(10) NOT NULL,
  `data` date NOT NULL,
  `hora` varchar(250) NOT NULL,
  `tensao_arterial` int(11) NOT NULL,
  `responsavel` varchar(250) NOT NULL,
  `id_dados_biometricos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `data_nascimento` date NOT NULL,
  `gender` enum('Masculino','Feminino') NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `data_conta` date NOT NULL,
  `bloqueado` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utente`
--

CREATE TABLE `utente` (
  `id_utente` int(10) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alerta_id` (`id_alerta`);

--
-- Indexes for table `af_andar`
--
ALTER TABLE `af_andar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_af` (`id_af`);

--
-- Indexes for table `af_sentado`
--
ALTER TABLE `af_sentado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_af` (`id_af`);

--
-- Indexes for table `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atividade_fisica`
--
ALTER TABLE `atividade_fisica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente_id` (`id_utente`);

--
-- Indexes for table `dados_biometricos`
--
ALTER TABLE `dados_biometricos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indexes for table `dor`
--
ALTER TABLE `dor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_historico_saude` (`id_historico_saude`);

--
-- Indexes for table `educacao_formal`
--
ALTER TABLE `educacao_formal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `familiar`
--
ALTER TABLE `familiar`
  ADD PRIMARY KEY (`id_familiar`),
  ADD KEY `user_id` (`id_user`),
  ADD KEY `id_utente_associado` (`id_utente_associado`);

--
-- Indexes for table `frequencia_cardiaca`
--
ALTER TABLE `frequencia_cardiaca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dados_biometricos` (`id_dados_biometricos`);

--
-- Indexes for table `historico_saude`
--
ALTER TABLE `historico_saude`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente_id` (`id_utente`);

--
-- Indexes for table `literacia_informatica`
--
ALTER TABLE `literacia_informatica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tensao_arterial`
--
ALTER TABLE `tensao_arterial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dados_biometricos` (`id_dados_biometricos`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id_utente`),
  ADD KEY `user_id` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `af_andar`
--
ALTER TABLE `af_andar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `af_sentado`
--
ALTER TABLE `af_sentado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `atividade_fisica`
--
ALTER TABLE `atividade_fisica`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dados_biometricos`
--
ALTER TABLE `dados_biometricos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dor`
--
ALTER TABLE `dor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `educacao_formal`
--
ALTER TABLE `educacao_formal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `frequencia_cardiaca`
--
ALTER TABLE `frequencia_cardiaca`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `historico_saude`
--
ALTER TABLE `historico_saude`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `literacia_informatica`
--
ALTER TABLE `literacia_informatica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tensao_arterial`
--
ALTER TABLE `tensao_arterial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `id_utente` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_alerta`) REFERENCES `alertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `af_andar`
--
ALTER TABLE `af_andar`
  ADD CONSTRAINT `af_andar_ibfk_1` FOREIGN KEY (`id_af`) REFERENCES `atividade_fisica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `af_sentado`
--
ALTER TABLE `af_sentado`
  ADD CONSTRAINT `af_sentado_ibfk_1` FOREIGN KEY (`id_af`) REFERENCES `atividade_fisica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `atividade_fisica`
--
ALTER TABLE `atividade_fisica`
  ADD CONSTRAINT `atividade_fisica_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `dados_biometricos`
--
ALTER TABLE `dados_biometricos`
  ADD CONSTRAINT `dados_biometricos_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `dor`
--
ALTER TABLE `dor`
  ADD CONSTRAINT `dor_ibfk_1` FOREIGN KEY (`id_historico_saude`) REFERENCES `historico_saude` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `educacao_formal`
--
ALTER TABLE `educacao_formal`
  ADD CONSTRAINT `educacao_formal_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `familiar`
--
ALTER TABLE `familiar`
  ADD CONSTRAINT `familiar_ibfk_1` FOREIGN KEY (`id_utente_associado`) REFERENCES `utente` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `familiar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `frequencia_cardiaca`
--
ALTER TABLE `frequencia_cardiaca`
  ADD CONSTRAINT `frequencia_cardiaca_ibfk_1` FOREIGN KEY (`id_dados_biometricos`) REFERENCES `dados_biometricos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `historico_saude`
--
ALTER TABLE `historico_saude`
  ADD CONSTRAINT `historico_saude_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `literacia_informatica`
--
ALTER TABLE `literacia_informatica`
  ADD CONSTRAINT `literacia_informatica_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tensao_arterial`
--
ALTER TABLE `tensao_arterial`
  ADD CONSTRAINT `tensao_arterial_ibfk_1` FOREIGN KEY (`id_dados_biometricos`) REFERENCES `dados_biometricos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
