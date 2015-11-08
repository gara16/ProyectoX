-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2015 a las 10:42:25
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `baseproyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleta`
--

CREATE TABLE IF NOT EXISTS `boleta` (
  `idboleta` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `idusuario` int(11) NOT NULL,
  `preciototal` decimal(10,2) NOT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`idboleta`),
  KEY `idUsuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `boleta`
--

INSERT INTO `boleta` (`idboleta`, `fecha`, `hora`, `idusuario`, `preciototal`, `estado`) VALUES
(1, '2015-11-04', '03:08:16', 1, '12.30', '1'),
(2, '2015-11-06', '03:08:16', 2, '12.30', '1'),
(3, '2015-11-06', '03:19:16', 1, '430.75', '1'),
(5, '2015-11-06', '03:21:49', 3, '430.75', '1'),
(6, '2015-11-06', '03:21:52', 3, '430.75', '1'),
(7, '2015-11-06', '03:22:00', 3, '430.75', '1'),
(8, '2015-11-06', '04:04:51', 7, '430.75', '1'),
(9, '2015-11-06', '04:05:15', 7, '430.75', '1'),
(10, '2015-11-06', '04:05:57', 7, '430.75', '1'),
(11, '2015-11-06', '04:06:41', 7, '0.00', '1'),
(12, '2015-11-06', '04:06:42', 7, '0.00', '1'),
(14, '2015-11-06', '04:14:42', 8, '0.00', '1'),
(15, '2015-11-06', '04:19:41', 8, '259.20', '1'),
(16, '2015-11-06', '04:32:45', 8, '220.75', '1'),
(17, '2015-11-06', '04:39:38', 8, '79.50', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE IF NOT EXISTS `datos` (
  `iddatos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `dni` char(8) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `img` varchar(50) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`iddatos`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`iddatos`, `nombre`, `apellido`, `dni`, `email`, `img`, `idusuario`) VALUES
(1, 'Alexander', 'Arevalo Garavito', '61152516', 'lex_94@outlook.com', 'garavito', 1),
(2, 'Milagros', 'Garavito Mogollon', '61151420', 'mili@hotmail.com', 'mili', 2),
(3, 'alexander', 'garavito', '61152415', 'lex_94@outlook.com', 'jajaja', 3),
(4, 'alex', 'garavito', '61152516', 'lex_58@outlook.com', '', 9),
(5, 'alex', 'garavito', '61152516', 'lex_58@outlook.com', '', 12),
(6, 'alex', 'garavito', '61152516', 'lex_58@outlook.com', '', 13),
(7, 'alex', 'arevalo', '6152516', 'lex_94@outlook.com', '', 14),
(8, 'alex', 'arevalo', '6152516', 'lex_94@outlook.com', '', 15),
(9, 'alex', 'arevalo', '61152516', 'lex@hotmail.com', '', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleboleta`
--

CREATE TABLE IF NOT EXISTS `detalleboleta` (
  `iddetalleboleta` int(11) NOT NULL AUTO_INCREMENT,
  `idboleta` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciounit` decimal(7,2) NOT NULL,
  PRIMARY KEY (`iddetalleboleta`),
  KEY `idProducto` (`idproducto`),
  KEY `idBoleta` (`idboleta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `detalleboleta`
--

INSERT INTO `detalleboleta` (`iddetalleboleta`, `idboleta`, `idproducto`, `cantidad`, `preciounit`) VALUES
(1, 1, 1, 2, '2.00'),
(2, 8, 4, 15, '14.00'),
(3, 8, 1, 5, '1.40'),
(4, 8, 2, 15, '14.25'),
(5, 14, 4, 18, '14.00'),
(6, 14, 5, 6, '1.20'),
(7, 14, 10, 2, '0.00'),
(8, 14, 2, 15, '14.25'),
(9, 14, 1, 5, '1.40'),
(10, 14, 10, 10, '0.00'),
(11, 17, 10, 10, '0.00'),
(12, 17, 1, 5, '1.40'),
(13, 17, 3, 5, '14.50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE IF NOT EXISTS `detallepedido` (
  `iddetallepedido` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL,
  PRIMARY KEY (`iddetallepedido`),
  KEY `idPedido` (`idpedido`),
  KEY `idProducto` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `fechaped` date NOT NULL,
  `fechae` date NOT NULL,
  `idproveedor` int(11) NOT NULL,
  PRIMARY KEY (`idpedido`),
  KEY `idProveedor` (`idproveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreprod` varchar(15) NOT NULL,
  `precio` decimal(7,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `idmedida` int(11) NOT NULL,
  `img` varchar(50) NOT NULL,
  `idtipoprod` int(11) NOT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `idTipoProd` (`idtipoprod`),
  KEY `idMedida` (`idmedida`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `nombreprod`, `precio`, `stock`, `idmedida`, `img`, `idtipoprod`, `estado`) VALUES
(1, 'Azucar', '1.40', 125, 1, '', 1, '0'),
(2, 'arroz blanco', '14.25', 147, 1, '', 1, '0'),
(3, 'arroz blanco', '14.50', 147, 1, '', 1, '1'),
(4, 'hola', '14.00', 145, 1, '', 1, '1'),
(5, 'yogurt', '1.20', 48, 1, '', 2, '1'),
(10, 'arroz', '0.00', 0, 1, '', 1, '1'),
(14, 'leche', '14.25', 14, 1, '', 1, '1'),
(15, 'leche', '15.20', 48, 1, '', 1, '1'),
(18, 'arroz', '14.25', 147, 1, '', 1, '1'),
(19, 'arroz', '14.25', 147, 1, 'imagen', 1, '1'),
(20, 'arroz', '14.25', 147, 1, 'imagen', 1, '1'),
(21, 'arroz', '14.25', 147, 1, 'imagen', 1, '0'),
(22, '0', '0.00', 0, 1, '', 1, ''),
(25, '0', '1522.00', 15, 1, '', 1, ''),
(26, 'yogurt', '15.20', 15, 1, '', 2, '1'),
(34, '0', '0.00', 0, 1, '', 2, '1'),
(37, 'yogurt', '12.03', 15, 1, '', 1, '1'),
(38, 'yogurt', '12.03', 15, 1, '', 1, '1'),
(39, 'yogurt', '12.03', 15, 1, '', 1, '1'),
(40, 'yogurt', '14.25', 15, 2, '', 1, '1'),
(41, 'yogurt', '14.25', 25, 1, '', 1, '1'),
(42, 'yogurt', '14.25', 147, 1, '', 1, '1'),
(43, 'arroz blanco', '14.25', 15, 1, '', 1, '1'),
(44, 'arroz blanco', '14.25', 15, 1, '', 1, '1'),
(45, 'arroz blanco', '12.03', 147, 1, '', 1, '1'),
(46, 'arroz blanco', '12.03', 14, 1, '', 1, '1'),
(47, 'arroz blanco4', '12.03', 14, 1, '', 1, '1'),
(48, 'arroz blanco', '15.20', 120, 2, '', 1, '1'),
(49, 'arroz blanco', '2.20', 156, 1, '', 1, '1'),
(50, 'arroz blanco', '14.25', 230, 1, '', 1, '1'),
(51, 'arroz blanco', '14.25', 230, 1, '', 1, '1'),
(52, 'arroz blanco', '14.25', 230, 1, '', 1, '1'),
(53, 'arroz blanco', '2.20', 980, 1, '', 1, '1'),
(54, 'arroz blanco4', '14.25', 980, 2, '', 1, '1'),
(55, 'arroz blanco4', '14.25', 980, 2, '', 1, '1'),
(56, 'arroz blanco', '14.25', 125, 1, '', 1, '1'),
(58, '0', '0.00', 0, 2, '', 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `compañia` varchar(20) NOT NULL,
  `fono` char(9) NOT NULL,
  `dni` char(8) NOT NULL,
  `ruc` char(11) NOT NULL,
  `img` varchar(40) NOT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproducto`
--

CREATE TABLE IF NOT EXISTS `tipoproducto` (
  `idtipoprod` int(11) NOT NULL AUTO_INCREMENT,
  `tipoprod` varchar(15) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`idtipoprod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipoproducto`
--

INSERT INTO `tipoproducto` (`idtipoprod`, `tipoprod`, `descripcion`) VALUES
(1, 'Cereales', 'Todo tipo de variedad de cereales'),
(2, 'Verduras', 'Variedad de verduras'),
(3, 'Lacteos', 'Lscteos de las mejores marcas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE IF NOT EXISTS `tipousuario` (
  `tipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`tipousuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`tipousuario`, `usuario`, `descripcion`) VALUES
(1, 'Administrador', 'Tipo de usuario que tiene los mayores privilegios en cuanto al la modificacion de datos.'),
(2, 'cliente', 'Tipo de usuario que solo tiene permisos para realizar compras.'),
(3, 'Publico', 'Este tipo de acceso es en caso de que el usuario no este logueado ni como administrado ni como cliente.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadmedida`
--

CREATE TABLE IF NOT EXISTS `unidadmedida` (
  `idmedida` int(11) NOT NULL AUTO_INCREMENT,
  `medida` char(5) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`idmedida`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `unidadmedida`
--

INSERT INTO `unidadmedida` (`idmedida`, `medida`, `descripcion`) VALUES
(1, 'K', 'para kilogramos'),
(2, 'L', 'Este tipo de medida es para aquellos productos que tienen el litro'),
(3, 'un', 'Este tipo de medidas es para aquellos productos que se venden por unidades');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `idtipousuario` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `idTipoUsuario` (`idtipousuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usuario`, `password`, `idtipousuario`) VALUES
(1, 'Gara94', 'garavito16', 1),
(2, 'mili', 'mili1415', 2),
(3, 'jorge', 'jorge1415', 2),
(4, 'gara1694', 'garavito', 2),
(6, 'gara169', 'garavito', 2),
(7, 'gara16', 'garavito', 2),
(8, 'gara', 'garavito', 2),
(9, 'garavito', 'garavito', 2),
(11, 'garalex', 'garavito', 2),
(12, 'garalex1694', 'garavito', 2),
(13, 'garalex1695', 'garavito', 2),
(14, 'lex1694', 'garavito', 2),
(15, 'lex169', 'garavito', 2),
(16, 'lex123', 'garavito', 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD CONSTRAINT `boleta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `datos`
--
ALTER TABLE `datos`
  ADD CONSTRAINT `datos_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `detalleboleta`
--
ALTER TABLE `detalleboleta`
  ADD CONSTRAINT `detalleboleta_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `detalleboleta_ibfk_2` FOREIGN KEY (`idBoleta`) REFERENCES `boleta` (`idBoleta`);

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`),
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `detallepedido_ibfk_3` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idtipoprod`) REFERENCES `tipoproducto` (`idTipoProd`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idMedida`) REFERENCES `unidadmedida` (`idMedida`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipousuario` (`tipoUsuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
