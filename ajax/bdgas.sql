-- MySQL Script generated by MySQL Workbench
-- Wed Feb 21 16:22:31 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bdgas
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bdgas
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bdgas` DEFAULT CHARACTER SET latin1 ;
USE `bdgas` ;

-- -----------------------------------------------------
-- Table `bdgas`.`gas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdgas`.`gas` (
  `id_gas` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_gas` VARCHAR(100) NULL DEFAULT NULL,
  `kilos` INT(11) NULL DEFAULT NULL,
  `valor` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_gas`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bdgas`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdgas`.`usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(20) NOT NULL,
  `clave` VARCHAR(64) NOT NULL,
  `imagen` VARCHAR(50) NOT NULL,
  `condicion` TINYINT(4) NOT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 2941
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bdgas`.`pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdgas`.`pedido` (
  `id_pedido` INT(11) NOT NULL AUTO_INCREMENT,
  `cantidad` INT(11) NOT NULL,
  `total_pedido` INT(11) NOT NULL,
  `total_kilos_pedidos` INT(11) NOT NULL,
  `estado` INT(11) NOT NULL,
  `usuario_id_usuario` INT(11) NOT NULL,
  `gas_id_gas` INT(11) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  INDEX `fk_pedido_usuario1_idx` (`usuario_id_usuario` ASC),
  INDEX `fk_pedido_gas1_idx` (`gas_id_gas` ASC),
  CONSTRAINT `fk_pedido_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `bdgas`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_gas1`
    FOREIGN KEY (`gas_id_gas`)
    REFERENCES `bdgas`.`gas` (`id_gas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bdgas`.`detalle_pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdgas`.`detalle_pedido` (
  `id_detalle_pedido` INT(11) NOT NULL AUTO_INCREMENT,
  `cantidad` INT(11) NOT NULL,
  `precio_total_pedido` INT(11) NOT NULL,
  `pedido_id_pedido` INT(11) NOT NULL,
  `gas_id_gas` INT(11) NOT NULL,
  PRIMARY KEY (`id_detalle_pedido`),
  INDEX `fk_detalle_pedido_pedido1_idx` (`pedido_id_pedido` ASC),
  INDEX `fk_detalle_pedido_gas1_idx` (`gas_id_gas` ASC),
  CONSTRAINT `fk_detalle_pedido_gas1`
    FOREIGN KEY (`gas_id_gas`)
    REFERENCES `bdgas`.`gas` (`id_gas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_pedido_pedido1`
    FOREIGN KEY (`pedido_id_pedido`)
    REFERENCES `bdgas`.`pedido` (`id_pedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bdgas`.`registro_pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdgas`.`registro_pago` (
  `id_registro_pago` INT(11) NOT NULL AUTO_INCREMENT,
  `comprobante_pago` VARCHAR(100) NOT NULL,
  `num_comprobante` INT(11) NOT NULL,
  `pedido_id_pedido` INT(11) NOT NULL,
  PRIMARY KEY (`id_registro_pago`),
  INDEX `fk_registro_pago_pedido1_idx` (`pedido_id_pedido` ASC),
  CONSTRAINT `fk_registro_pago_pedido1`
    FOREIGN KEY (`pedido_id_pedido`)
    REFERENCES `bdgas`.`pedido` (`id_pedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bdgas`.`socio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdgas`.`socio` (
  `rut_soc` INT(11) NOT NULL,
  `dv_soc` VARCHAR(2) NULL DEFAULT NULL,
  `nombre` VARCHAR(100) NULL DEFAULT NULL,
  `fechaIngreso` DATE NULL DEFAULT NULL,
  `region` VARCHAR(50) NULL DEFAULT NULL,
  `telefono` VARCHAR(11) NOT NULL,
  `estado` INT(2) NULL DEFAULT NULL,
  `user_type` INT(20) NULL DEFAULT NULL,
  `usuario_id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`rut_soc`),
  INDEX `fk_socio_usuario1_idx` (`usuario_id_usuario` ASC),
  CONSTRAINT `fk_socio_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `bdgas`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bdgas`.`tipo_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdgas`.`tipo_permiso` (
  `id_tipo_permiso` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id_tipo_permiso`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bdgas`.`usuario_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdgas`.`usuario_permiso` (
  `id_permiso` INT(11) NOT NULL AUTO_INCREMENT,
  `permiso_id_permiso` INT(11) NOT NULL,
  `usuario_id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_permiso`),
  INDEX `fk_usuario_permiso_permiso1_idx` (`permiso_id_permiso` ASC),
  INDEX `fk_usuario_permiso_usuario1_idx` (`usuario_id_usuario` ASC),
  CONSTRAINT `fk_usuario_permiso_permiso1`
    FOREIGN KEY (`permiso_id_permiso`)
    REFERENCES `bdgas`.`tipo_permiso` (`id_tipo_permiso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_permiso_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `bdgas`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;