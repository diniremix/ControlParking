-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.5.16 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla parkingdb.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `cedula` int(10) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla parkingdb.movimientos
CREATE TABLE IF NOT EXISTS `movimientos` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `placa` varchar(6) NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `fecha_llegada` date NOT NULL,
  `hora_llegada` time NOT NULL,
  `usuario_llegada` varchar(15) NOT NULL,
  `fecha_salida` date NOT NULL,
  `hora_salida` time NOT NULL,
  `usuario_salida` varchar(15) NOT NULL,
  `transcurrido` time NOT NULL,
  `valor_cobro` int(8) NOT NULL,
  `tipo_cobro` varchar(15) NOT NULL,
  `cliente` int(10) DEFAULT NULL,
  `e_s` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `placa` (`placa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla parkingdb.pagos
CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(10) NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `hora_pago` time NOT NULL,
  `tiempo` varchar(6) NOT NULL,
  `usuario_pago` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente` (`cedula`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla parkingdb.tarifas
CREATE TABLE IF NOT EXISTS `tarifas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(6) NOT NULL,
  `tiempo` varchar(6) NOT NULL,
  `valor_tarifa` int(7) NOT NULL,
  `descuento` int(3) NOT NULL,
  `aplica_descuento` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla parkingdb.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `login` varchar(35) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `password`, `nombres`, `tipo`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrador', '1'),
(2, 'demo', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 'Usuario Regular', '2');


-- Volcando estructura para tabla parkingdb.vehiculos
CREATE TABLE IF NOT EXISTS `vehiculos` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `placa` varchar(6) NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `marca` varchar(12) NOT NULL,
  `modelo` int(4) NOT NULL,
  `color` varchar(10) NOT NULL,
  `cliente` int(10) DEFAULT NULL,
  PRIMARY KEY (`placa`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para vista parkingdb.vista1
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vista1` (
	`placa` VARCHAR(6) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;


-- Volcando estructura para vista parkingdb.vista1
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vista1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `vista1` AS select `movimientos`.`placa` AS `placa` from (`movimientos` join `vehiculos`) where ((`vehiculos`.`tipo` = 'moto') and (`movimientos`.`placa` = `vehiculos`.`placa`)) ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
