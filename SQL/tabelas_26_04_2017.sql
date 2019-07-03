-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: ptaw-gr1-2017-backup-26/04/2017
-- Source Schemata: ptaw-gr1-2017
-- Created: Wed Apr 26 22:29:19 2017
-- Workbench Version: 6.3.9
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema ptaw-gr1-2017-backup-26/04/2017
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `ptaw-gr1-2017-backup-26/04/2017` ;
CREATE SCHEMA IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017` ;

-- ----------------------------------------------------------------------------
-- Table ptaw-gr1-2017-backup-26/04/2017._dados_biometricos
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017`.`_dados_biometricos` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_utilizador` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `tipo` VARCHAR(255) NOT NULL,
  `data` VARCHAR(255) NOT NULL,
  `hora` VARCHAR(255) NOT NULL,
  `quem_mediu` VARCHAR(255) NOT NULL,
  `medicacao_sos` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC),
  INDEX `id_utilizador` (`id_utilizador` ASC),
  CONSTRAINT `_dados_biometricos_ibfk_1`
    FOREIGN KEY (`id_utilizador`)
    REFERENCES `ptaw-gr1-2017-backup-26/04/2017`.`detalhes_conta` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table ptaw-gr1-2017-backup-26/04/2017._desporto_semanal
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017`.`_desporto_semanal` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dia` VARCHAR(255) NOT NULL,
  `semana` VARCHAR(255) NOT NULL,
  `duracao` VARCHAR(255) NOT NULL,
  `condicao_de_saude` VARCHAR(255) NOT NULL,
  `id_utilizador` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC),
  INDEX `id_utilizador` (`id_utilizador` ASC),
  CONSTRAINT `_desporto_semanal_ibfk_1`
    FOREIGN KEY (`id_utilizador`)
    REFERENCES `ptaw-gr1-2017-backup-26/04/2017`.`detalhes_conta` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table ptaw-gr1-2017-backup-26/04/2017._historico_saude
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017`.`_historico_saude` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_utilizador` BIGINT(20) UNSIGNED NOT NULL,
  `data` VARCHAR(255) NOT NULL,
  `hipertensao_arterial` VARCHAR(255) NOT NULL,
  `diabetes` VARCHAR(255) NOT NULL,
  `tipo_artrose` VARCHAR(255) NOT NULL,
  `espondilartrose` VARCHAR(255) NOT NULL,
  `tipo_espondilartrose` VARCHAR(255) NOT NULL,
  `patologia_cardiovascular` VARCHAR(255) NOT NULL,
  `patologia_respiratoria` VARCHAR(255) NOT NULL,
  `cancro` VARCHAR(255) NOT NULL,
  `depressao` VARCHAR(255) NOT NULL,
  `trombose` VARCHAR(255) NOT NULL,
  `outra` VARCHAR(255) NOT NULL,
  `outra_descricao` VARCHAR(255) NOT NULL,
  `id_dor` BIGINT(20) UNSIGNED NOT NULL,
  `id_intensidade` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC),
  INDEX `id_utilizador` (`id_utilizador` ASC),
  INDEX `id_dor` (`id_dor` ASC),
  INDEX `id_intensidade` (`id_intensidade` ASC),
  CONSTRAINT `_historico_saude_ibfk_1`
    FOREIGN KEY (`id_utilizador`)
    REFERENCES `ptaw-gr1-2017-backup-26/04/2017`.`detalhes_conta` (`id`),
  CONSTRAINT `_historico_saude_ibfk_2`
    FOREIGN KEY (`id_dor`)
    REFERENCES `ptaw-gr1-2017-backup-26/04/2017`.`dor` (`id`),
  CONSTRAINT `_historico_saude_ibfk_3`
    FOREIGN KEY (`id_intensidade`)
    REFERENCES `ptaw-gr1-2017-backup-26/04/2017`.`intensidade` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table ptaw-gr1-2017-backup-26/04/2017.administrador
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017`.`administrador` (
  `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table ptaw-gr1-2017-backup-26/04/2017.alertas
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017`.`alertas` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(255) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table ptaw-gr1-2017-backup-26/04/2017.alertas_utilizador
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017`.`alertas_utilizador` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_utilizador` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `id_alerta` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC),
  INDEX `id_utilizador` (`id_utilizador` ASC),
  INDEX `id_alerta` (`id_alerta` ASC),
  CONSTRAINT `alertas_utilizador_ibfk_1`
    FOREIGN KEY (`id_utilizador`)
    REFERENCES `ptaw-gr1-2017-backup-26/04/2017`.`detalhes_conta` (`id`),
  CONSTRAINT `alertas_utilizador_ibfk_2`
    FOREIGN KEY (`id_alerta`)
    REFERENCES `ptaw-gr1-2017-backup-26/04/2017`.`alertas` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table ptaw-gr1-2017-backup-26/04/2017.detalhes_conta
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017`.`detalhes_conta` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `nome_conta` VARCHAR(255) NOT NULL,
  `pass` VARCHAR(255) NOT NULL,
  `utente_ou_familiar` VARCHAR(255) NOT NULL,
  `data_criacao` DATE NOT NULL,
  `last_login` DATE NULL DEFAULT NULL,
  `verifica_alerta` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table ptaw-gr1-2017-backup-26/04/2017.dor
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017`.`dor` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_utilizador` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `dor_ultima_semana` VARCHAR(255) NOT NULL,
  `dor_local` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC),
  INDEX `id_utilizador` (`id_utilizador` ASC),
  CONSTRAINT `dor_ibfk_1`
    FOREIGN KEY (`id_utilizador`)
    REFERENCES `ptaw-gr1-2017-backup-26/04/2017`.`detalhes_conta` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table ptaw-gr1-2017-backup-26/04/2017.familiar
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017`.`familiar` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_proprio` VARCHAR(255) NOT NULL,
  `grau_parentesco` VARCHAR(255) NOT NULL,
  `id_detalhes_conta` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC),
  INDEX `id_detalhes_conta` (`id_detalhes_conta` ASC),
  CONSTRAINT `familiar_ibfk_1`
    FOREIGN KEY (`id_detalhes_conta`)
    REFERENCES `ptaw-gr1-2017-backup-26/04/2017`.`detalhes_conta` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table ptaw-gr1-2017-backup-26/04/2017.intensidade
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017`.`intensidade` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_utilizador` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `dor_cabeca` TINYINT(1) NOT NULL,
  `dor_cabeca_int` INT(9) NOT NULL,
  `dor_pescoco` TINYINT(1) NOT NULL,
  `dor_pescoco_int` INT(9) NOT NULL,
  `dor_ombros` TINYINT(1) NOT NULL,
  `dor_ombros_int` INT(9) NOT NULL,
  `dor_bracos` TINYINT(1) NOT NULL,
  `dor_bracos_int` INT(9) NOT NULL,
  `dor_punhos_mao` TINYINT(1) NOT NULL,
  `dor_punhos_mao_int` INT(9) NOT NULL,
  `dor_coluna_tora` TINYINT(1) NOT NULL,
  `dor_coluna_tora_int` INT(9) NOT NULL,
  `dor_lombar` TINYINT(1) NOT NULL,
  `dor_lombar_int` INT(9) NOT NULL,
  `dor_anca` TINYINT(1) NOT NULL,
  `dor_anca_int` INT(9) NOT NULL,
  `dor_coxa` TINYINT(1) NOT NULL,
  `dor_coxa_int` INT(9) NOT NULL,
  `dor_joelho` TINYINT(1) NOT NULL,
  `dor_joelho_int` INT(9) NOT NULL,
  `dor_torn_pes` TINYINT(1) NOT NULL,
  `dor_torn_pes_int` INT(9) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC),
  INDEX `id_utilizador` (`id_utilizador` ASC),
  CONSTRAINT `intensidade_ibfk_1`
    FOREIGN KEY (`id_utilizador`)
    REFERENCES `ptaw-gr1-2017-backup-26/04/2017`.`detalhes_conta` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- ----------------------------------------------------------------------------
-- Table ptaw-gr1-2017-backup-26/04/2017.utente
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ptaw-gr1-2017-backup-26/04/2017`.`utente` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_proprio` CHAR(255) NOT NULL,
  `tem_familiar` TINYINT(1) NOT NULL,
  `id_familiar` INT(9) NULL DEFAULT NULL,
  `data_nascimento` DATE NOT NULL,
  `genero` CHAR(255) NOT NULL,
  `id_detalhes_conta` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC),
  INDEX `id_detalhes_conta` (`id_detalhes_conta` ASC),
  CONSTRAINT `utente_ibfk_1`
    FOREIGN KEY (`id_detalhes_conta`)
    REFERENCES `ptaw-gr1-2017-backup-26/04/2017`.`detalhes_conta` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;
SET FOREIGN_KEY_CHECKS = 1;
