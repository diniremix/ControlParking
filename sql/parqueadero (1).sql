-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2015 a las 20:53:12
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `parqueadero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `cedula` int(10) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cedula`, `nombres`, `apellidos`) VALUES
(1116235315, 'Leo', 'ramirez'),
(1116235310, 'leandro', 'ramirez'),
(1116235300, 'leandro', 'ramirez'),
(94478683, 'Maverick', 'Meerkat'),
(94479583, 'Alejandro', 'Pardo P'),
(29283113, 'Carlina', 'Viveros'),
(1234567890, 'Sara', 'Corrales'),
(6349635, 'jhon', 'ramirez'),
(94480650, 'Gustavo', 'Henao');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE IF NOT EXISTS `movimientos` (
`id` int(8) NOT NULL,
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
  `e_s` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `placa`, `tipo`, `fecha_llegada`, `hora_llegada`, `usuario_llegada`, `fecha_salida`, `hora_salida`, `usuario_salida`, `transcurrido`, `valor_cobro`, `tipo_cobro`, `cliente`, `e_s`) VALUES
(1, 'PRU123', 'moto', '2012-11-12', '20:15:14', 'Usuario', '2014-12-08', '16:58:19', 'Jose', '00:00:12', 0, 'horas', NULL, 1),
(2, 'des222', 'carro', '2012-11-12', '20:15:27', 'Usuario', '2012-11-12', '20:15:47', 'Usuario', '00:00:20', 0, 'horas', NULL, 1),
(3, 'LRQ38A', 'moto', '2012-11-12', '20:36:22', 'Usuario', '2012-11-12', '20:36:28', 'Usuario', '00:00:06', 0, 'horas', NULL, 1),
(4, 'cct52a', 'moto', '2012-11-28', '21:02:26', 'Usuario', '2012-11-28', '21:03:11', 'Usuario', '00:00:45', 0, 'horas', NULL, 1),
(5, 'PRU123', 'moto', '2014-12-08', '11:45:43', 'Jose', '2014-12-08', '16:58:19', 'Jose', '00:00:12', 0, 'horas', NULL, 1),
(6, '<br />', 'carro', '2014-12-08', '22:12:19', 'Jose', '2014-12-18', '18:40:51', 'vendedor', '20:28:32', 260000, 'horas', NULL, 1),
(7, 'GHS54B', 'carro', '2014-12-08', '22:12:25', 'Jose', '0000-00-00', '00:00:00', ' ', '00:00:00', 0, 'horas', NULL, 0),
(8, 'GHS54B', 'carro', '2014-12-08', '22:23:39', 'Jose', '0000-00-00', '00:00:00', ' ', '00:00:00', 0, 'horas', NULL, 0),
(9, 'PRU123', 'carro', '2014-12-08', '22:54:05', 'Jose', '2014-12-08', '16:58:19', 'Jose', '00:00:12', 0, 'horas', NULL, 1),
(10, 'GAH84', 'carro', '2014-12-08', '22:55:47', 'Jose', '0000-00-00', '00:00:00', ' ', '00:00:00', 0, 'horas', NULL, 0),
(11, 'PRU123', 'moto', '2014-12-08', '16:58:07', 'Jose', '2014-12-08', '16:58:19', 'Jose', '00:00:12', 0, 'horas', NULL, 1),
(12, 'DRU66C', 'carro', '2014-12-17', '17:20:20', 'vendedor', '2014-12-17', '17:22:49', 'vendedor', '00:00:24', 0, 'horas', NULL, 1),
(13, 'DRU66C', 'moto', '2014-12-17', '17:21:10', 'vendedor', '2014-12-17', '17:22:49', 'vendedor', '00:00:24', 0, 'horas', NULL, 1),
(14, 'DRU66C', 'moto', '2014-12-17', '17:22:25', 'vendedor', '2014-12-17', '17:22:49', 'vendedor', '00:00:24', 0, 'horas', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
`id` int(11) NOT NULL,
  `cedula` int(10) NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `hora_pago` time NOT NULL,
  `tiempo` varchar(6) NOT NULL,
  `usuario_pago` varchar(30) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `cedula`, `fecha_pago`, `fecha_vencimiento`, `hora_pago`, `tiempo`, `usuario_pago`) VALUES
(1, 1116235315, '2012-11-12', '2012-11-26', '20:14:37', '15dias', 'Usuario'),
(2, 94478683, '2012-11-12', '2012-11-13', '20:14:48', 'dia', 'Usuario'),
(3, 6349635, '2012-11-12', '2012-11-19', '20:14:57', 'semana', 'Usuario'),
(4, 94479583, '2012-11-12', '2012-12-12', '20:15:55', 'mes_c', 'Usuario'),
(5, 1116235300, '2012-11-12', '2012-11-26', '20:36:36', '15dias', 'Usuario'),
(6, 94479583, '2014-12-08', '2014-12-22', '11:46:08', '15dias', 'Jose');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE IF NOT EXISTS `tarifas` (
`id` int(11) NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `tiempo` varchar(6) NOT NULL,
  `valor_tarifa` int(7) NOT NULL,
  `descuento` int(3) NOT NULL,
  `aplica_descuento` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `tipo`, `tiempo`, `valor_tarifa`, `descuento`, `aplica_descuento`) VALUES
(1, 'moto', 'mhora', 800, 0, 0),
(2, 'moto', 'horas', 1000, 0, 0),
(3, 'moto', '12hora', 1200, 0, 0),
(4, 'moto', '24hora', 2000, 0, 0),
(5, 'moto', '15dias', 10000, 0, 0),
(6, 'moto', 'mes_l', 18700, 0, 0),
(7, 'moto', 'mes_c', 20000, 0, 0),
(8, 'carro', 'hora', 1500, 0, 0),
(9, 'carro', 'hora_a', 500, 0, 0),
(10, 'carro', '12hora', 6500, 0, 0),
(11, 'carro', 'dia', 12000, 0, 0),
(12, 'carro', 'semana', 18000, 0, 0),
(13, 'carro', '15dias', 30000, 0, 0),
(14, 'carro', 'mes', 60000, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(2) NOT NULL,
  `login` varchar(35) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `tipo` varchar(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `password`, `nombres`, `tipo`) VALUES
(5, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrador', '1'),
(6, 'vendedor', '88d6818710e371b461efff33d271e0d2fb6ccf47', 'Alejandro Suarez', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE IF NOT EXISTS `vehiculos` (
`id` int(8) NOT NULL,
  `placa` varchar(6) NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `marca` varchar(12) NOT NULL,
  `modelo` int(4) NOT NULL,
  `color` varchar(10) NOT NULL,
  `cliente` int(10) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `placa`, `tipo`, `marca`, `modelo`, `color`, `cliente`) VALUES
(1, 'PRU123', 'moto', 'honda', 2002, 'blanco', 1116235315),
(2, 'CCT52B', '', '', 0, '0', 1116235310),
(3, 'aaaaaa', 'moto', 'honda', 2008, 'azul', 1116235300),
(4, 'NTX001', 'carro', 'Pidgey', 2020, 'AzulGris', 94478683),
(5, 'LRQ38A', 'moto', 'Yamaha', 2000, 'Negro-Bla', 94479583),
(6, 'PPP45C', 'moto', 'Yamaha', 2012, 'Gris', 29283113),
(7, 'PUA777', 'moto', 'Rara', 900, 'Dersa', 1234567890),
(8, 'des222', 'carro', 'Cacaro', 1996, 'Opaco', 6349635),
(9, 'GAH84', 'moto', 'YAMAHA', 2013, 'BLANCA', 94480650);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista1`
--
CREATE TABLE IF NOT EXISTS `vista1` (
`placa` varchar(6)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `vista1`
--
DROP TABLE IF EXISTS `vista1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista1` AS select `movimientos`.`placa` AS `placa` from (`movimientos` join `vehiculos`) where ((`vehiculos`.`tipo` = 'moto') and (`movimientos`.`placa` = `vehiculos`.`placa`));

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `placa` (`placa`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
 ADD PRIMARY KEY (`id`), ADD KEY `cliente` (`cedula`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
 ADD PRIMARY KEY (`placa`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
