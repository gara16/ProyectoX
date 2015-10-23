-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2015 a las 05:32:16
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
  PRIMARY KEY (`idboleta`),
  KEY `idUsuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE IF NOT EXISTS `datos` (
  `iddatos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `dni` char(8) NOT NULL,
  `email` varchar(30) NOT NULL,
  `img` varchar(50) NOT NULL,
  PRIMARY KEY (`iddatos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE IF NOT EXISTS `detallepedido` (
  `iddetallepedido` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`idproducto`),
  KEY `idTipoProd` (`idtipoprod`),
  KEY `idMedida` (`idmedida`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) NOT NULL,
  `apellido` varchar(15) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `compañia` varchar(20) NOT NULL,
  `fono` char(9) NOT NULL,
  `dni` char(8) NOT NULL,
  `ruc` char(11) NOT NULL,
  `img` varchar(40) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE IF NOT EXISTS `tipousuario` (
  `tipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`tipousuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadmedida`
--

CREATE TABLE IF NOT EXISTS `unidadmedida` (
  `idmedida` int(11) NOT NULL AUTO_INCREMENT,
  `medida` char(5) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`idmedida`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `idtipousuario` int(11) NOT NULL,
  `iddatos` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `idTipoUsuario` (`idtipousuario`),
  KEY `idDatos` (`iddatos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD CONSTRAINT `boleta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

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
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipousuario` (`tipoUsuario`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idDatos`) REFERENCES `datos` (`idDatos`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
