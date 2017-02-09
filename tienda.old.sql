-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-02-2017 a las 00:57:57
-- Versión del servidor: 5.7.14
-- Versión de PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
  `oid` int(8) NOT NULL,
  `value` int(7) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `users.id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `category_id` int(9) NOT NULL,
  `category_name` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'traccion delantera'),
(2, 'traccion trasera'),
(3, '4x4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE `item` (
  `reference` int(8) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `value` int(8) NOT NULL,
  `subcategory_name` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(8) NOT NULL,
  `pic` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`reference`, `name`, `value`, `subcategory_name`, `type`, `description`, `stock`, `pic`) VALUES
(9, 'Fiat Multipla', 1220, 'Monovolumen', 'Diésel', 'Descripcion', 1, 'images/multipla.jpg'),
(10, 'BMW X6', 32000, 'Todocamino', 'Diésel', 'Descripcion', 1, 'images/original.jpg'),
(11, 'Mercedes Clase C', 38000, 'Berlina', 'Gasolina', 'Mercedes', 1, 'images/mercedesclasec.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(8) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `postalcode` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `users.id` int(8) NOT NULL,
  `cart.oid` int(8) NOT NULL,
  `seen` enum('yes','no') COLLATE utf8_spanish_ci NOT NULL,
  `message` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quantity`
--

CREATE TABLE `quantity` (
  `item.reference` int(8) NOT NULL,
  `cart.oid` int(8) NOT NULL,
  `quantity` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `category_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subcategory`
--

INSERT INTO `subcategory` (`subcategory_name`, `category_id`) VALUES
('Monovolumen', 1),
('Berlina', 2),
('Todocamino', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `nick` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `type` enum('admin','user') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'user',
  `name` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `surname` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nick`, `email`, `password`, `address`, `type`, `name`, `surname`) VALUES
(1, 'Alvarito', 'a.nietolopez96@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Sevilla, 41927, Mairena del Aljarafe, Simon Verde', 'admin', 'Alvaro', 'Nieto Lopez'),
(8, 'sergio', 'sergio1345@gmail.com', 'a3f3d7df63d86701109f9c89945b81c9', 'Camas Sity Siudá sin ley', 'user', 'Sergio', 'Gorgé Jorge'),
(12, 'roto2', 'roto2@forococoches.com', '0cef876758a37d356440d0cc5fe776c6', 'Madrit C/ Ferraz 288', 'user', 'Alonso', 'de Cera'),
(13, 'tester', 'testerino@tester.com', '827ccb0eea8a706c4c34a16891f84e7b', 'testerlandia', 'user', 'teste', 'ino');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`oid`,`users.id`),
  ADD KEY `users.id` (`users.id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indices de la tabla `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`reference`,`subcategory_name`),
  ADD KEY `subcategory_name` (`subcategory_name`);

--
-- Indices de la tabla `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`users.id`,`cart.oid`),
  ADD KEY `r.cart` (`cart.oid`);

--
-- Indices de la tabla `quantity`
--
ALTER TABLE `quantity`
  ADD PRIMARY KEY (`item.reference`,`cart.oid`),
  ADD KEY `cart.oid` (`cart.oid`);

--
-- Indices de la tabla `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_name`),
  ADD KEY `category.category_id` (`category_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick` (`nick`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
  MODIFY `oid` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `item`
--
ALTER TABLE `item`
  MODIFY `reference` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`users.id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`subcategory_name`) REFERENCES `subcategory` (`subcategory_name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `r.cart` FOREIGN KEY (`cart.oid`) REFERENCES `cart` (`oid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `r.users` FOREIGN KEY (`users.id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `quantity`
--
ALTER TABLE `quantity`
  ADD CONSTRAINT `quantity_ibfk_1` FOREIGN KEY (`cart.oid`) REFERENCES `cart` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `r.item` FOREIGN KEY (`item.reference`) REFERENCES `item` (`reference`);

--
-- Filtros para la tabla `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
