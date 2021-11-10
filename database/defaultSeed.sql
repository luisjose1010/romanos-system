-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 04-11-2021 a las 15:01:12
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

INSERT INTO `products` (`id`, `code`, `name`, `description`, `price`, `max_ingredients`, `min_ingredients`, `updated_at`, `created_at`) VALUES
(1, NULL, 'Pizza sin borde', '1 ingrediente', NULL, 1, 1, NULL, NULL),
(2, NULL, 'Servicio de tequeños', '10 tequeñitos, salsa tártara.', 2.5, 0, 0, NULL, NULL),
(3, NULL, 'Helado', '1 Litro', NULL, 1, 1, NULL, NULL),
(4, NULL, 'Refresco', NULL, NULL, 0, 0, NULL, NULL),
(5, NULL, 'Agua', NULL, 0.5, 0, 0, NULL, NULL),
(6, NULL, 'Combo para 2', 'Pizza mediana, 1 ingrediente, borde de queso, 4 tequeños, salsa tártara, Pepsi de 1.5 litros.', 8, 1, 1, NULL, NULL),
(7, NULL, 'Combo resuelto', 'Pizza familiar, borde de queso, 1 ingrediente, salsa tártara, 8 tequeños, Pepsi de 1.5 litros.', 10, 1, 1, NULL, NULL),
(8, NULL, 'Combo económico', 'Pizza familiar, borde de queso, 1 ingrediente, salsa tártara, 12 tequeños, Pepsi de 1.5 litros.', 12, 1, 1, NULL, NULL),
(9, NULL, 'Combo helado sencillo', 'Pizza familiar, borde de queso, 1 ingrediente, Pepsi de 1.5 litros, helado de 1 litro (o 1 torta).', 12, 1, 1, NULL, NULL),
(10, NULL, 'Combo helado plus', 'Pizza familiar, borde de queso, 2 ingredientes, 12 tequeños, refresco de 1.5 litros, helado de 1 litro (o 1 torta).', 16, 2, 2, NULL, NULL),
(11, NULL, 'Combo duo', '2 Pizzas familiares, 1 ingrediente (c/u), borde de queso (c/u), refresco de 1.5 litros.', 16, 2, 1, NULL, NULL),
(12, NULL, 'Combo extrafamiliar', 'Pizza familiar, pizza individual, borde de queso (c/u), 1 ingrediente (c/u), salsa tártara, 12 tequeños, Pepsi de 1.5 litros.', 16, 2, 2, NULL, NULL),
(13, NULL, 'Combo maracucho #1', 'Pizza familiar, borde de queso, 4 ingredientes, 12 tequeños, salsa tártara, Pepsi de 1.5 litros.', 16, 4, 4, NULL, NULL),
(14, NULL, 'Pizza Nutella', NULL, 4, 1, 1, NULL, NULL),
(15, NULL, 'Pizza Nutella (con combo)', NULL, 2, 1, 1, NULL, NULL),
(16, NULL, 'Torta', NULL, 2.5, 1, 1, NULL, NULL),
(17, NULL, 'Combo teque', '20 tequeños grandes, refresco de 1.5 litros, 4 salsas tártaras.', 8, 0, 0, NULL, NULL),
(18, NULL, 'Ingrediente adicional', NULL, NULL, 1, 1, NULL, NULL);

--
-- Volcado de datos para la tabla `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `price`, `updated_at`, `created_at`, `product_id`) VALUES
(1, 'Batti Batti', 3, NULL, NULL, 3),
(2, 'Mantecado', 3, NULL, NULL, 3),
(3, 'Cocossette', 3, NULL, NULL, 3),
(4, 'Chocolate', 3, NULL, NULL, 3),
(5, 'Fresa', 3, NULL, NULL, 3),
(6, 'Oreo', 3, NULL, NULL, 3),
(7, 'Jamón', NULL, NULL, NULL, 1),
(8, 'Maíz', NULL, NULL, NULL, 1),
(9, 'Pimentón', NULL, NULL, NULL, 1),
(10, 'Cebolla', NULL, NULL, NULL, 1),
(11, 'Tocineta', NULL, NULL, NULL, 1),
(12, 'Peperoni', NULL, NULL, NULL, 1),
(13, 'Champiñones', NULL, NULL, NULL, 1),
(14, 'Anchoas', NULL, NULL, NULL, 1),
(15, 'Aceitunas negras', NULL, NULL, NULL, 1),
(16, 'Piña', NULL, NULL, NULL, 1),
(17, 'Jamón', NULL, NULL, NULL, 6),
(18, 'Maíz', NULL, NULL, NULL, 6),
(19, 'Pimentón', NULL, NULL, NULL, 6),
(20, 'Cebolla', NULL, NULL, NULL, 6),
(21, 'Tocineta', NULL, NULL, NULL, 6),
(22, 'Peperoni', NULL, NULL, NULL, 6),
(23, 'Champiñones', NULL, NULL, NULL, 6),
(24, 'Anchoas', NULL, NULL, NULL, 6),
(25, 'Aceitunas negras', NULL, NULL, NULL, 6),
(26, 'Piña', NULL, NULL, NULL, 6),
(27, 'Jamón', NULL, NULL, NULL, 7),
(28, 'Maíz', NULL, NULL, NULL, 7),
(29, 'Pimentón', NULL, NULL, NULL, 7),
(30, 'Cebolla', NULL, NULL, NULL, 7),
(31, 'Tocineta', NULL, NULL, NULL, 7),
(32, 'Peperoni', NULL, NULL, NULL, 7),
(33, 'Champiñones', NULL, NULL, NULL, 7),
(34, 'Anchoas', NULL, NULL, NULL, 7),
(35, 'Aceitunas negras', NULL, NULL, NULL, 7),
(36, 'Piña', NULL, NULL, NULL, 7),
(37, 'Jamón', NULL, NULL, NULL, 8),
(38, 'Maíz', NULL, NULL, NULL, 8),
(39, 'Pimentón', NULL, NULL, NULL, 8),
(40, 'Cebolla', NULL, NULL, NULL, 8),
(41, 'Tocineta', NULL, NULL, NULL, 8),
(42, 'Peperoni', NULL, NULL, NULL, 8),
(43, 'Champiñones', NULL, NULL, NULL, 8),
(44, 'Anchoas', NULL, NULL, NULL, 8),
(45, 'Aceitunas negras', NULL, NULL, NULL, 8),
(46, 'Piña', NULL, NULL, NULL, 8),
(47, 'Jamón', NULL, NULL, NULL, 9),
(48, 'Maíz', NULL, NULL, NULL, 9),
(49, 'Pimentón', NULL, NULL, NULL, 9),
(50, 'Cebolla', NULL, NULL, NULL, 9),
(51, 'Tocineta', NULL, NULL, NULL, 9),
(52, 'Peperoni', NULL, NULL, NULL, 9),
(53, 'Champiñones', NULL, NULL, NULL, 9),
(54, 'Anchoas', NULL, NULL, NULL, 9),
(55, 'Aceitunas negras', NULL, NULL, NULL, 9),
(56, 'Piña', NULL, NULL, NULL, 9),
(57, 'Jamón', NULL, NULL, NULL, 10),
(58, 'Maíz', NULL, NULL, NULL, 10),
(59, 'Pimentón', NULL, NULL, NULL, 10),
(60, 'Cebolla', NULL, NULL, NULL, 10),
(61, 'Tocineta', NULL, NULL, NULL, 10),
(62, 'Peperoni', NULL, NULL, NULL, 10),
(63, 'Champiñones', NULL, NULL, NULL, 10),
(64, 'Anchoas', NULL, NULL, NULL, 10),
(65, 'Aceitunas negras', NULL, NULL, NULL, 10),
(66, 'Piña', NULL, NULL, NULL, 10),
(67, 'Jamón', NULL, NULL, NULL, 11),
(68, 'Maíz', NULL, NULL, NULL, 11),
(69, 'Pimentón', NULL, NULL, NULL, 11),
(70, 'Cebolla', NULL, NULL, NULL, 11),
(71, 'Tocineta', NULL, NULL, NULL, 11),
(72, 'Peperoni', NULL, NULL, NULL, 11),
(73, 'Champiñones', NULL, NULL, NULL, 11),
(74, 'Anchoas', NULL, NULL, NULL, 11),
(75, 'Aceitunas negras', NULL, NULL, NULL, 11),
(76, 'Piña', NULL, NULL, NULL, 11),
(77, 'Jamón', NULL, NULL, NULL, 12),
(78, 'Maíz', NULL, NULL, NULL, 12),
(79, 'Pimentón', NULL, NULL, NULL, 12),
(80, 'Cebolla', NULL, NULL, NULL, 12),
(81, 'Tocineta', NULL, NULL, NULL, 12),
(82, 'Peperoni', NULL, NULL, NULL, 12),
(83, 'Champiñones', NULL, NULL, NULL, 12),
(84, 'Anchoas', NULL, NULL, NULL, 12),
(85, 'Aceitunas negras', NULL, NULL, NULL, 12),
(86, 'Piña', NULL, NULL, NULL, 12),
(87, 'Jamón', NULL, NULL, NULL, 13),
(88, 'Maíz', NULL, NULL, NULL, 13),
(89, 'Pimentón', NULL, NULL, NULL, 13),
(90, 'Cebolla', NULL, NULL, NULL, 13),
(91, 'Tocineta', NULL, NULL, NULL, 13),
(92, 'Peperoni', NULL, NULL, NULL, 13),
(93, 'Champiñones', NULL, NULL, NULL, 13),
(94, 'Anchoas', NULL, NULL, NULL, 13),
(95, 'Aceitunas negras', NULL, NULL, NULL, 13),
(96, 'Piña', NULL, NULL, NULL, 13),
(97, 'M&M', NULL, NULL, NULL, 14),
(98, 'Oreo', NULL, NULL, NULL, 14),
(99, 'M&M', NULL, NULL, NULL, 15),
(100, 'Oreo', NULL, NULL, NULL, 15),
(101, 'Tres leches', NULL, NULL, NULL, 16),
(102, 'Chocolate', NULL, NULL, NULL, 16),
(103, 'Jamón', 1, NULL, NULL, 18),
(104, 'Maíz', 1, NULL, NULL, 18),
(105, 'Pimentón', 1, NULL, NULL, 18),
(106, 'Cebolla', 1, NULL, NULL, 18),
(107, 'Tocineta', 1, NULL, NULL, 18),
(108, 'Peperoni', 1, NULL, NULL, 18),
(109, 'Champiñones', 1, NULL, NULL, 18),
(110, 'Anchoas', 1, NULL, NULL, 18),
(111, 'Aceitunas negras', 1, NULL, NULL, 18),
(112, 'Piña', 1, NULL, NULL, 18),
(113, 'Champiñones (combo Napoli)', 2, NULL, NULL, 18),
(114, 'Anchoas (combo Napoli)', 2, NULL, NULL, 18),
(115, 'Aceitunas negras (combo Napoli)', 2, NULL, NULL, 18);

--
-- Volcado de datos para la tabla `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `price`, `updated_at`, `created_at`, `product_id`) VALUES
(1, 'Familiar', 9, NULL, NULL, 1),
(2, 'Mediana', 8, NULL, NULL, 1),
(3, 'Personal', 4, NULL, NULL, 1),
(4, '1.5 Litros', 1.5, NULL, NULL, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
