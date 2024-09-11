*Base de datos para control de planta*

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-09-2024 a las 18:40:19
-- Versión del servidor: 8.0.39
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controlplanta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accions`
--

CREATE TABLE `accions` (
  `accio_id` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `accions`
--

INSERT INTO `accions` (`accio_id`, `nom`) VALUES
('100', 'FALTA MATERIAL'),
('101', 'INCIDENCIA CALIDAD EXTERNO'),
('102', 'INCIDENCIA CALIDAD INTERNO'),
('103', 'DESCANSO'),
('104', 'SALIDA'),
('105', 'REUNIÓN'),
('106', 'DOCUMENTACIÓN'),
('108', 'INCIDENCIA LOGISTICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activitats`
--

CREATE TABLE `activitats` (
  `activitat_id` int NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuari_id` int DEFAULT NULL,
  `maquina_id` int DEFAULT NULL,
  `accions_id` varchar(255) DEFAULT NULL,
  `identificador` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `activitats`
--

INSERT INTO `activitats` (`activitat_id`, `fecha`, `hora`, `usuari_id`, `maquina_id`, `accions_id`, `identificador`) VALUES
(322, '2024-04-01', '06:00:00', 1, NULL, '105', NULL),
(323, '2024-04-01', '06:05:00', 1, 100, NULL, 'c'),
(324, '2024-04-01', '08:15:00', 1, NULL, '101', NULL),
(325, '2024-04-01', '09:00:00', 1, 100, NULL, 'c'),
(326, '2024-04-01', '10:00:00', 1, NULL, '103', NULL),
(327, '2024-04-01', '10:15:00', 1, 100, NULL, 'd'),
(328, '2024-04-01', '12:15:00', 1, 100, NULL, 'd'),
(329, '2024-04-01', '12:50:00', 1, 100, NULL, 'd'),
(330, '2024-04-01', '14:14:00', 1, NULL, '104', 'd'),
(331, '2024-04-02', '06:00:00', 1, NULL, '105', NULL),
(332, '2024-04-02', '06:05:00', 1, 100, NULL, 'e'),
(333, '2024-04-02', '08:30:00', 1, 100, NULL, 'e'),
(334, '2024-04-02', '09:15:00', 1, 100, NULL, 'e'),
(335, '2024-04-02', '10:00:00', 1, NULL, '103', NULL),
(336, '2024-04-02', '10:15:00', 1, 100, NULL, 'f'),
(337, '2024-04-02', '11:00:00', 1, NULL, '101', NULL),
(338, '2024-04-02', '12:30:00', 1, 100, NULL, 'f'),
(339, '2024-04-02', '13:00:00', 1, 100, NULL, 'f'),
(340, '2024-04-02', '14:10:00', 1, NULL, '104', NULL),
(341, '2024-04-03', '06:00:00', 1, NULL, '105', NULL),
(342, '2024-04-03', '06:05:00', 1, 100, NULL, 'g'),
(343, '2024-04-03', '08:45:00', 1, 100, NULL, 'g'),
(344, '2024-04-03', '09:30:00', 1, 100, NULL, 'g'),
(345, '2024-04-03', '10:00:00', 1, NULL, '103', NULL),
(346, '2024-04-03', '10:15:00', 1, 100, NULL, 'h'),
(347, '2024-04-03', '12:00:00', 1, 100, NULL, 'h'),
(348, '2024-04-03', '12:45:00', 1, 100, NULL, 'hh'),
(349, '2024-04-03', '14:20:00', 1, NULL, '104', NULL),
(350, '2024-04-04', '06:00:00', 1, NULL, '105', NULL),
(351, '2024-04-04', '06:05:00', 1, 100, NULL, 'h'),
(352, '2024-04-04', '08:20:00', 1, 100, NULL, 'i'),
(353, '2024-04-04', '09:00:00', 1, 100, NULL, 'i'),
(354, '2024-04-04', '10:00:00', 1, NULL, '103', NULL),
(355, '2024-04-04', '10:15:00', 1, 100, NULL, 'i'),
(356, '2024-04-04', '12:30:00', 1, 100, NULL, 'j'),
(357, '2024-04-04', '13:15:00', 1, 100, NULL, 'j'),
(358, '2024-04-04', '14:00:00', 1, NULL, '104', NULL),
(359, '2024-04-05', '06:00:00', 1, NULL, '105', NULL),
(360, '2024-04-05', '06:05:00', 1, 100, NULL, 'j'),
(361, '2024-04-05', '08:10:00', 1, 100, NULL, 'k'),
(362, '2024-04-05', '09:00:00', 1, 100, NULL, 'k'),
(363, '2024-04-05', '10:00:00', 1, NULL, '103', ''),
(364, '2024-04-05', '10:15:00', 1, 100, NULL, 'l'),
(365, '2024-04-05', '12:45:00', 1, 100, NULL, 'l'),
(366, '2024-04-05', '13:30:00', 1, 100, NULL, 'l'),
(367, '2024-04-05', '14:15:00', 1, NULL, '104', NULL),
(368, '2024-04-06', '06:00:00', 1, NULL, '105', NULL),
(369, '2024-04-03', '06:00:00', 1, NULL, '105', NULL),
(370, '2024-04-03', '06:05:00', 1, 100, NULL, 'm'),
(371, '2024-04-03', '08:45:00', 1, 100, NULL, 'm'),
(372, '2024-04-03', '09:30:00', 1, 100, NULL, 'm'),
(373, '2024-04-03', '10:00:00', 1, NULL, '103', NULL),
(374, '2024-04-03', '10:15:00', 1, 100, NULL, 'm'),
(375, '2024-04-03', '12:00:00', 1, 100, NULL, 'n'),
(376, '2024-04-03', '12:45:00', 1, 100, NULL, 'n'),
(377, '2024-04-03', '14:20:00', 1, NULL, '104', NULL),
(378, '2024-04-04', '06:00:00', 1, NULL, '105', NULL),
(379, '2024-04-04', '06:05:00', 1, 100, NULL, 'n'),
(380, '2024-04-04', '08:20:00', 1, 100, NULL, 'o'),
(381, '2024-04-04', '09:00:00', 1, 100, NULL, 'o'),
(382, '2024-04-04', '10:00:00', 1, NULL, '103', NULL),
(383, '2024-04-04', '10:15:00', 1, 100, NULL, 'o'),
(384, '2024-04-04', '12:30:00', 1, 100, NULL, 'p'),
(385, '2024-04-04', '13:15:00', 1, 100, NULL, 'p'),
(386, '2024-04-04', '14:00:00', 1, NULL, '104', NULL),
(387, '2024-04-05', '06:00:00', 1, NULL, '105', NULL),
(388, '2024-04-05', '06:05:00', 1, 100, NULL, 'p'),
(389, '2024-04-05', '08:10:00', 1, 100, NULL, 'q'),
(390, '2024-04-05', '09:00:00', 1, 100, NULL, 'q'),
(391, '2024-04-05', '10:00:00', 1, NULL, '103', NULL),
(392, '2024-04-05', '10:15:00', 1, 100, NULL, 'r'),
(393, '2024-04-05', '12:45:00', 1, 100, NULL, 'r'),
(394, '2024-04-05', '13:30:00', 1, 100, NULL, 'r'),
(395, '2024-04-05', '14:15:00', 1, NULL, '104', NULL),
(417, '2024-05-03', '21:04:41', 1, 100, NULL, ''),
(445, '2024-05-05', '12:18:18', 1, 100, NULL, 'a'),
(446, '2024-05-05', '12:57:38', 1, NULL, '100', NULL),
(447, '2024-05-06', '17:05:31', 1, NULL, '100', NULL),
(448, '2024-05-06', '17:05:53', 1, NULL, '104', NULL),
(450, '2024-05-06', '20:45:18', 1, 100, NULL, 'wr'),
(451, '2024-05-06', '20:46:13', 1, 100, NULL, '<srcript>a'),
(452, '2024-05-06', '20:51:09', 1, 100, NULL, 'j'),
(453, '2024-05-06', '20:51:29', 1, NULL, '100', NULL),
(454, '2024-05-06', '20:52:59', 1, 100, NULL, 'a'),
(460, '2024-05-07', '20:36:23', 1, 100, NULL, 'as'),
(461, '2024-05-07', '20:36:43', 1, NULL, '100', NULL),
(462, '2024-05-13', '21:09:56', 1, NULL, '103', NULL),
(463, '2024-05-13', '21:20:55', 1, NULL, '104', NULL),
(464, '2024-05-13', '21:21:39', 1, NULL, '105', NULL),
(465, '2024-05-18', '18:39:18', 1, NULL, '100', NULL),
(466, '2024-05-18', '18:39:19', 1, NULL, '101', NULL),
(467, '2024-05-19', '12:57:51', 1, NULL, '103', NULL),
(468, '2024-05-19', '12:58:05', 1, NULL, '105', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquines`
--

CREATE TABLE `maquines` (
  `maquina_id` int NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `temps_maquina` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `maquines`
--

INSERT INTO `maquines` (`maquina_id`, `nom`, `temps_maquina`) VALUES
(100, 'secado', 95),
(101, 'llavat', 900),
(102, 'carenats', 306),
(103, 'arrastre', 462);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE `usuaris` (
  `usuari_id` int NOT NULL,
  `nom_usuari` varchar(255) DEFAULT NULL,
  `rol` varchar(255) DEFAULT NULL,
  `data_incorporacio` datetime DEFAULT NULL,
  `seccio` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `supervisor_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`usuari_id`, `nom_usuari`, `rol`, `data_incorporacio`, `seccio`, `contraseña`, `supervisor_id`) VALUES
(0, 'admin', 'admin', NULL, NULL, '$2y$10$LxJDeEYuV.72aAB4xPQ1w.Mx5dyc78x25ywwh4dNIhRnZ6zay6yye', NULL),
(1, 'Toni Esparza', 'supervisor', '2024-03-01 00:00:00', 'trenes', '$2y$10$eQqnb2e2kXaEoRWYAn8ZseSZpWf/pR7lhZ7kdgmF1Zr5GKf2SGESi', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accions`
--
ALTER TABLE `accions`
  ADD PRIMARY KEY (`accio_id`);

--
-- Indices de la tabla `activitats`
--
ALTER TABLE `activitats`
  ADD PRIMARY KEY (`activitat_id`),
  ADD KEY `usuari_id` (`usuari_id`),
  ADD KEY `maquina_id` (`maquina_id`),
  ADD KEY `accions_id` (`accions_id`),
  ADD KEY `activitat_id_2` (`activitat_id`),
  ADD KEY `activitat_id_3` (`activitat_id`);

--
-- Indices de la tabla `maquines`
--
ALTER TABLE `maquines`
  ADD PRIMARY KEY (`maquina_id`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`usuari_id`),
  ADD KEY `supervisor_id` (`supervisor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activitats`
--
ALTER TABLE `activitats`
  MODIFY `activitat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activitats`
--
ALTER TABLE `activitats`
  ADD CONSTRAINT `activitats_ibfk_1` FOREIGN KEY (`usuari_id`) REFERENCES `usuaris` (`usuari_id`),
  ADD CONSTRAINT `activitats_ibfk_2` FOREIGN KEY (`maquina_id`) REFERENCES `maquines` (`maquina_id`),
  ADD CONSTRAINT `activitats_ibfk_3` FOREIGN KEY (`accions_id`) REFERENCES `accions` (`accio_id`);

--
-- Filtros para la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD CONSTRAINT `usuaris_ibfk_1` FOREIGN KEY (`supervisor_id`) REFERENCES `usuaris` (`usuari_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
