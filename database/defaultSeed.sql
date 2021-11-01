-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 16-10-2021 a las 12:48:27
-- Versión del servidor: 10.3.9-MariaDB
-- Versión de PHP: 7.2.10


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `romanos-system`
--

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `multiple_ingredients`, `updated_at`, `created_at`) VALUES
(1, 'Pizza sin bordes', NULL, 1, NULL, NULL),
(2, 'Servicio de tequeños', '- 10 tequeñitos\r\n- salsa tártara', 0, NULL, NULL),
(3, 'Helado', NULL, 0, NULL, NULL);

--
-- Volcado de datos para la tabla `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `price`, `updated_at`, `created_at`, `product_id`) VALUES
(1, 'Batti Batti', 3, NULL, NULL, 3),
(2, 'Mantecado', 3, NULL, NULL, 3),
(3, 'Cocossette', 3, NULL, NULL, 3),
(4, 'Chocolate', 3, NULL, NULL, 3),
(5, 'Fresa', 3, NULL, NULL, 3),
(6, 'Oreo', 3, NULL, NULL, 3);

--
-- Volcado de datos para la tabla `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `price`, `updated_at`, `created_at`, `product_id`) VALUES
(1,'Familiar',  NULL, NULL, NULL, 1),
(2, 'Mediana', NULL, NULL, NULL, 1),
(3, 'Personal', NULL, NULL, NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
