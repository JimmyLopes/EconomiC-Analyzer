-- MySQL Script generated by MySQL Workbench
-- 06/09/18 21:52:45
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema DB_ECA
-- -----------------------------------------------------
-- ECA Project Database

-- -----------------------------------------------------
-- Schema DB_ECA
--
-- ECA Project Database
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DB_ECA` DEFAULT CHARACTER SET latin1 ;
USE `DB_ECA` ;

-- -----------------------------------------------------
-- Table `DB_ECA`.`tb_region`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_ECA`.`tb_region` (
  `id_region` INT NOT NULL AUTO_INCREMENT,
  `str_name_region` VARCHAR(12) NULL,
  PRIMARY KEY (`id_region`),
  UNIQUE INDEX `str_name_region_UNIQUE` (`str_name_region` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_ECA`.`tb_state`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_ECA`.`tb_state` (
  `id_state` INT NOT NULL AUTO_INCREMENT,
  `str_uf` VARCHAR(2) NOT NULL,
  `str_name` VARCHAR(19) NULL,
  `tb_region_id_region` INT NOT NULL,
  PRIMARY KEY (`id_state`),
  UNIQUE INDEX `str_uf_UNIQUE` (`str_uf` ASC),
  UNIQUE INDEX `str_name_UNIQUE` (`str_name` ASC),
  INDEX `fk_tb_state_tb_region1_idx` (`tb_region_id_region` ASC),
  CONSTRAINT `fk_tb_state_tb_region1`
    FOREIGN KEY (`tb_region_id_region`)
    REFERENCES `DB_ECA`.`tb_region` (`id_region`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_ECA`.`tb_city`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_ECA`.`tb_city` (
  `id_city` INT NOT NULL AUTO_INCREMENT,
  `str_name_city` VARCHAR(255) NULL,
  `str_cod_siafi_city` VARCHAR(4) NOT NULL,
  `tb_state_id_state` INT NOT NULL,
  PRIMARY KEY (`id_city`),
  INDEX `fk_tb_city_tb_state_idx` (`tb_state_id_state` ASC),
  UNIQUE INDEX `str_cod_siafi_city_UNIQUE` (`str_cod_siafi_city` ASC),
  CONSTRAINT `fk_tb_city_tb_state`
    FOREIGN KEY (`tb_state_id_state`)
    REFERENCES `DB_ECA`.`tb_state` (`id_state`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_ECA`.`tb_functions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_ECA`.`tb_functions` (
  `id_function` INT NOT NULL AUTO_INCREMENT,
  `str_cod_function` VARCHAR(4) NOT NULL,
  `str_name_function` VARCHAR(255) NULL,
  PRIMARY KEY (`id_function`),
  UNIQUE INDEX `str_cod_function_UNIQUE` (`str_cod_function` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_ECA`.`tb_subfunctions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_ECA`.`tb_subfunctions` (
  `id_subfunction` INT NOT NULL AUTO_INCREMENT,
  `str_cod_subfunction` VARCHAR(4) NOT NULL,
  `str_name_subfunction` VARCHAR(255) NULL,
  PRIMARY KEY (`id_subfunction`),
  UNIQUE INDEX `str_cod_subfunction_UNIQUE` (`str_cod_subfunction` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_ECA`.`tb_program`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_ECA`.`tb_program` (
  `id_program` INT NOT NULL AUTO_INCREMENT,
  `str_cod_program` VARCHAR(4) NOT NULL,
  `str_name_program` VARCHAR(255) NULL,
  PRIMARY KEY (`id_program`),
  UNIQUE INDEX `str_cod_program_UNIQUE` (`str_cod_program` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_ECA`.`tb_action`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_ECA`.`tb_action` (
  `id_action` INT NOT NULL AUTO_INCREMENT,
  `str_cod_action` VARCHAR(4) NOT NULL,
  `str_name_action` VARCHAR(255) NULL,
  PRIMARY KEY (`id_action`),
  UNIQUE INDEX `str_cod_action_UNIQUE` (`str_cod_action` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_ECA`.`tb_source`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_ECA`.`tb_source` (
  `id_source` INT NOT NULL AUTO_INCREMENT,
  `str_goal` VARCHAR(255) NOT NULL,
  `str_origin` VARCHAR(255) NULL,
  `str_periodicity` VARCHAR(9) NULL,
  PRIMARY KEY (`id_source`),
  UNIQUE INDEX `str_goal_UNIQUE` (`str_goal` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_ECA`.`tb_beneficiaries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_ECA`.`tb_beneficiaries` (
  `id_beneficiaries` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `str_nis` VARCHAR(14) NOT NULL,
  `str_name_person` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_beneficiaries`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_ECA`.`tb_files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_ECA`.`tb_files` (
  `id_file` INT NOT NULL AUTO_INCREMENT,
  `str_name_file` VARCHAR(45) NOT NULL,
  `str_month` VARCHAR(2) NULL,
  `str_year` VARCHAR(4) NULL,
  PRIMARY KEY (`id_file`),
  UNIQUE INDEX `str_name_file_UNIQUE` (`str_name_file` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_ECA`.`tb_payments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_ECA`.`tb_payments` (
  `id_payment` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `tb_city_id_city` INT NOT NULL,
  `tb_functions_id_function` INT NOT NULL,
  `tb_subfunctions_id_subfunction` INT NOT NULL,
  `tb_program_id_program` INT NOT NULL,
  `tb_action_id_action` INT NOT NULL,
  `tb_beneficiaries_id_beneficiaries` BIGINT(20) NOT NULL,
  `tb_source_id_source` INT NOT NULL,
  `tb_files_id_file` INT NOT NULL,
  `db_value` DOUBLE NOT NULL,
  PRIMARY KEY (`id_payment`),
  INDEX `fk_tb_payments_tb_city1_idx` (`tb_city_id_city` ASC),
  INDEX `fk_tb_payments_tb_program1_idx` (`tb_program_id_program` ASC),
  INDEX `fk_tb_payments_tb_action1_idx` (`tb_action_id_action` ASC),
  INDEX `fk_tb_payments_tb_source1_idx` (`tb_source_id_source` ASC),
  INDEX `fk_tb_payments_tb_files1_idx` (`tb_files_id_file` ASC),
  INDEX `fk_tb_payments_tb_functions1_idx` (`tb_functions_id_function` ASC),
  INDEX `fk_tb_payments_tb_subfunctions1_idx` (`tb_subfunctions_id_subfunction` ASC),
  INDEX `fk_tb_payments_tb_beneficiaries1_idx` (`tb_beneficiaries_id_beneficiaries` ASC),
  CONSTRAINT `fk_tb_payments_tb_city1`
    FOREIGN KEY (`tb_city_id_city`)
    REFERENCES `DB_ECA`.`tb_city` (`id_city`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_payments_tb_program1`
    FOREIGN KEY (`tb_program_id_program`)
    REFERENCES `DB_ECA`.`tb_program` (`id_program`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_payments_tb_action1`
    FOREIGN KEY (`tb_action_id_action`)
    REFERENCES `DB_ECA`.`tb_action` (`id_action`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_payments_tb_source1`
    FOREIGN KEY (`tb_source_id_source`)
    REFERENCES `DB_ECA`.`tb_source` (`id_source`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_payments_tb_files1`
    FOREIGN KEY (`tb_files_id_file`)
    REFERENCES `DB_ECA`.`tb_files` (`id_file`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_payments_tb_functions1`
    FOREIGN KEY (`tb_functions_id_function`)
    REFERENCES `DB_ECA`.`tb_functions` (`id_function`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_payments_tb_subfunctions1`
    FOREIGN KEY (`tb_subfunctions_id_subfunction`)
    REFERENCES `DB_ECA`.`tb_subfunctions` (`id_subfunction`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_payments_tb_beneficiaries1`
    FOREIGN KEY (`tb_beneficiaries_id_beneficiaries`)
    REFERENCES `DB_ECA`.`tb_beneficiaries` (`id_beneficiaries`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
