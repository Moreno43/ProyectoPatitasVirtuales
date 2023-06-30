-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2023 a las 05:00:06
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_config` int(11) NOT NULL,
  `identidad` varchar(20) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `facebook` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_config`, `identidad`, `nombre`, `telefono`, `correo`, `direccion`, `mensaje`, `facebook`) VALUES
(1, '1033176625', 'Tigerish', '3219262693', 'tigerish123465@gmail.com', 'Medellin - Colombia', 'GRACIAS POR SU PREFERENCIA', 'url');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_pedido`, `id_producto`, `nombre`, `precio`, `cantidad`) VALUES
(1, 1, 1, 'Caja de Arena Automatica', '250.00', 1),
(2, 1, 3, 'CAÑA NAVIDEÑA PARA MICHIS', '15.00', 1),
(3, 1, 5, 'WHISKAS', '11.00', 1),
(4, 2, 4, 'Cuido para Perros', '10.00', 1),
(5, 2, 2, 'PACK DE JUGUETES! para perros', '10.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `transaccion` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(150) DEFAULT '',
  `direccion` varchar(255) DEFAULT '',
  `telefono` varchar(50) DEFAULT '',
  `estado` int(11) NOT NULL DEFAULT 1,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `transaccion`, `fecha`, `nombre`, `direccion`, `telefono`, `estado`, `total`) VALUES
(1, '7S514222BB822971B', '2023-02-08', 'Tigerish', 'Calle 666# 00-00', '3219262693', 0, '276.00'),
(2, '5AN5435384598072U', '2023-02-08', 'LarrY The Black', 'Sur Este.Africa 13', '301 5808159', 0, '20.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion_corta` text NOT NULL,
  `precio_normal` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `foto_destacada` varchar(50) DEFAULT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `titulo`, `descripcion_corta`, `precio_normal`, `stock`, `estado`, `foto_destacada`, `fecha_create`) VALUES
(1, 'Caja de Arena Automatica', 'La caja de arena automática: ¡limpieza sin complicaciones para ti y un paraíso higiénico para tu gato', '250.00', 24, 1, '1.JPG', '2023-05-31 23:29:34'),
(2, 'PACK DE JUGUETES! para perros', '¡El pack de juguetes para perros, la receta perfecta para horas interminables de diversión y alegría en cada mordisco y juego!', '10.00', 67, 1, '2.JPG', '2023-05-31 23:43:41'),
(3, 'CAÑA NAVIDEÑA PARA MICHIS', 'La caña navideña para michis: un regalo mágico que despierta el espíritu felino de la temporada, invitando a saltar, cazar y disfrutar de momentos llenos de diversión y encanto.', '15.00', 24, 1, '3.JPG', '2023-05-31 23:51:30'),
(4, 'Cuido para Perros', 'La comida para perros: una deliciosa forma de nutrir y consentir a nuestros fieles compañeros, brindándoles energía y salud en cada bocado', '10.00', 69, 1, '4.JPG', '2023-05-31 23:34:40'),
(5, 'Whiskas', 'La vida es como un lienzo en blanco, ¡agarra el pincel y crea tu propia obra maestra!', '11.00', 256, 1, '5.JPG', '2023-05-31 23:41:56'),
(6, 'COLLAR', 'Carisimo Tio', '1999.00', 0, 0, '6.jpg', '2023-05-31 23:54:38'),
(7, 'NUEVO PRODUCTO', 'GFDFDG', '5.00', 5, 0, '20230208111832.jpg', '2023-02-08 21:18:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `titulo` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `slider`
--

INSERT INTO `slider` (`id`, `imagen`, `titulo`, `descripcion`, `estado`) VALUES
(1, '1.jpg', 'APROVECHE LAS OFERTAS', 'TODA LAS COMPRAS VIENEN CON UN REGALO', 1),
(2, '2.jpg', 'PANTALON DE MODA', 'minima sed. Tempore autem aut similique tenetur quaerat?', 1),
(3, '3.jpg', 'BLACK FRIDAY', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `perfil` varchar(50) NOT NULL DEFAULT 'avatar.svg',
  `fecha_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_update` timestamp NULL DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `telefono`, `clave`, `perfil`, `fecha_create`, `fecha_update`, `estado`) VALUES
(1, 'Pablo Nieto', 'tigerish123465@gmail.com', '3219262693', '$2y$10$PuuKkm6GYFYhDserwrlg5e4Pwz5C89v9PFg8LreX3vKRGo4lgXqsG', '20221025000917.jpg', '2023-06-01 00:25:16', NULL, 1),
(2, 'Pablo Moreno', 'sylvaticsquid@gmail.com', '777', '123', 'avatar.svg', '2023-05-31 23:13:35', NULL, 1),
(3, 'Larry Alberto Vergara', 'ciruela@gmail.com', '666', '321', 'avatar.svg', '2023-05-31 23:14:08', NULL, 0),
(4, 'Larry', 'ciruela123@gmail.com', '666', '$2y$10$UaulZRbRZCH/G1JhDWz1nuLaCsIsMzooEBWDezLcGdoUAf5RTNmLq', 'avatar.svg', '2023-06-01 01:17:31', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_config`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
