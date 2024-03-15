-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-08-2023 a las 17:34:30
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dual_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

DROP TABLE IF EXISTS `administradores`;
CREATE TABLE IF NOT EXISTS `administradores` (
  `idAdministrador` int NOT NULL AUTO_INCREMENT,
  `matricula` int NOT NULL,
  `nombres` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idAdministrador`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`idAdministrador`, `matricula`, `nombres`, `apellidos`, `usuario`, `password`) VALUES
(1, 155673, 'Pablo', 'Martínez', 'Admin', '12345'),
(2, 0, 'AdminDual', '', 'AdminDual', 'pygORN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `idAlumno` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `matricula` int NOT NULL,
  `carrera` enum('Ingeniería en Desarrollo y Gestión de Software','Ingeniería en Mecatrónica','Ingeniería en Sistemas Productivos','Ingeniería en Mantenimiento Industrial','Licenciatura en Innovación de Negocios y Mercadotecnia','Licenciatura en Gestión Institucional Educativa y Curricular','TSU en Lengua Inglesa','TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma','TSU en Desarrollo de Negocios área Mercadotecnia','TSU en Mantenimiento área Industrial','TSU en Procesos Industriales área Manufactura','TSU en Mecatrónica área Automatización') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idEmpresa` int DEFAULT NULL,
  `cuatrimestre` enum('1','2','3','4','5','6','7','8','9','10','11') COLLATE utf8mb4_general_ci NOT NULL,
  `idTutor` int NOT NULL,
  `idInstructor` int NOT NULL,
  `idFormador` int NOT NULL,
  `telefono` text COLLATE utf8mb4_general_ci NOT NULL,
  `correo` text COLLATE utf8mb4_general_ci NOT NULL,
  `ingreso` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `duracion` enum('1 Cuatrimestre','2 Cuatrimestres','3 Cuatrimestres','4 Cuatrimestres','5 Cuatrimestres','6 Cuatrimestres','7 Cuatrimestres','8 Cuatrimestres','9 Cuatrimestres','10 Cuatrimestres','11 Cuatrimestres') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usuario` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `estatus_alumno` enum('Activo','Baja','Incapacitado','Suspendido','En proceso','Finalizado') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Activo',
  `motivo_baja` varchar(320) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `observaciones` varchar(320) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Sin Observaciones.',
  PRIMARY KEY (`idAlumno`),
  KEY `fk_alumnos_empresas` (`idEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`idAlumno`, `nombres`, `apellidos`, `matricula`, `carrera`, `idEmpresa`, `cuatrimestre`, `idTutor`, `idInstructor`, `idFormador`, `telefono`, `correo`, `ingreso`, `fecha_fin`, `duracion`, `usuario`, `password`, `estatus_alumno`, `motivo_baja`, `observaciones`) VALUES
(1, 'Genesis Hamor', 'Carrillo Salas', 19156, 'TSU en Lengua Inglesa', 3, '5', 1, 1, 0, '', '', '2023-06-02', '2023-06-09', '8 Cuatrimestres', '19156', 'pN1gos', 'Activo', '', 'Sin Observaciones.'),
(2, 'Carolina', 'Vicencio Adán', 17725, 'Licenciatura en Gestión Institucional Educativa y Curricular', 3, '4', 3, 1, 0, '', '', '2023-05-28', '2023-06-25', '8 Cuatrimestres', '17725', 'WkVAGN', 'Activo', '', 'Sin Observaciones.'),
(3, 'Sofia', 'Acosta Chaires', 17726, 'Licenciatura en Gestión Institucional Educativa y Curricular', 3, '7', 3, 1, 0, '', '', '2023-05-28', '2023-12-06', '5 Cuatrimestres', '17726', 'XjIGOP', 'Activo', '', 'Sin Observaciones.'),
(4, 'Fernando Daniel', 'Gaytán Velazquez', 20308, 'TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma', 3, '5', 3, 1, 0, '', '', '2023-05-28', '2023-06-29', '2 Cuatrimestres', '20308', '7Aj5CU', 'Activo', '', 'Sin Observaciones.'),
(5, 'Jeysa Michelle', 'Reyes Velazquez', 20428, 'TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma', 3, '5', 1, 0, 0, '', '', '2023-05-28', '2022-05-31', '2 Cuatrimestres', '20428', 'p1zCjw', 'Activo', '', 'Sin Observaciones.'),
(6, 'Astrid Alejandra', 'Rodríguez Morales', 19282, 'TSU en Lengua Inglesa', 4, '5', 3, 5, 0, '', '', '2023-05-28', '2023-06-28', '2 Cuatrimestres', '19282', 'kwU1qD', 'Finalizado', '', 'Sin Observaciones.'),
(7, 'Fausto', 'Camacho Moreno', 19294, 'TSU en Lengua Inglesa', 4, '5', 1, 0, 0, '', '', '2023-05-28', '2023-06-30', '2 Cuatrimestres', '19294', 'n6Nq79', 'Activo', '', 'Sin Observaciones.'),
(8, 'Glorinelba', 'Luis González', 19181, 'TSU en Lengua Inglesa', 4, '5', 2, 0, 0, '', '', '2023-05-28', '2023-12-13', '7 Cuatrimestres', '19181', 'aXKufO', 'Activo', '', 'Sin Observaciones.'),
(9, 'Lesdi Guadalupe', 'Alemán Tovar', 19147, 'TSU en Lengua Inglesa', 4, '5', 2, 0, 0, '', '', '2023-05-28', '2023-12-31', '2 Cuatrimestres', '19147', 'CyQkb5', 'Activo', '', 'Sin Observaciones.'),
(10, 'Lucia Michelle', 'Morin Guerrero', 19187, 'TSU en Lengua Inglesa', 4, '5', 2, 0, 0, '', '', '2023-05-28', '2024-12-31', '7 Cuatrimestres', '19187', '7I3kT0', 'Finalizado', '', 'Sin Observaciones.'),
(11, 'Alessandra Berenice', 'Niño López', 18876, 'TSU en Lengua Inglesa', 4, '5', 2, 0, 0, '', '', '2023-05-28', '2024-12-12', '7 Cuatrimestres', '18876', 'd9FpTQ', 'Activo', '', 'Sin Observaciones.'),
(12, 'Azucena', 'Enríquez Ruiz', 17732, 'TSU en Lengua Inglesa', 4, '6', 0, 0, 0, '', '', '2023-05-28', '2025-01-24', '6 Cuatrimestres', '17732', 'w7Sq8l', 'Activo', '', 'Sin Observaciones.'),
(13, 'Pilar Alejandra', 'Guerrero Urazanda', 18871, 'TSU en Lengua Inglesa', 4, '6', 0, 0, 0, '', '', '2023-05-28', '2025-12-18', '6 Cuatrimestres', '18871', 'aU6Fmn', 'Activo', '', 'Sin Observaciones.'),
(14, 'Wendy Yanira', 'Mateo Mejía', 20059, 'TSU en Desarrollo de Negocios área Mercadotecnia', 4, '5', 0, 0, 0, '', '', '2023-05-28', '2025-12-18', '2 Cuatrimestres', '20059', 'UjKop1', 'Activo', '', 'Sin Observaciones.'),
(15, 'Jose Angel', 'Lugo Esparza', 18190, 'Ingeniería en Desarrollo y Gestión de Software', 5, '8', 0, 0, 0, '', '', '2023-05-28', '2023-12-31', '4 Cuatrimestres', '18190', '3YfZPQ', 'Activo', '', 'Sin Observaciones.'),
(16, 'Diego', 'Carrizales Zamarrón', 17928, 'Ingeniería en Mecatrónica', 5, '8', 0, 0, 0, '', '', '2023-05-28', '2024-01-31', '4 Cuatrimestres', '17928', 'e7lSsG', 'Activo', '', 'Sin Observaciones.'),
(17, 'Ricardo Adrián', 'Avila Izaguirre', 11453, 'Ingeniería en Mecatrónica', 5, '8', 0, 0, 0, '', '', '2023-05-28', '2024-01-17', '4 Cuatrimestres', '11453', 'oAuZU2', 'Activo', '', 'Sin Observaciones.'),
(18, 'Salma Paola', 'Niño Antonio', 18679, 'Ingeniería en Sistemas Productivos', 5, '8', 0, 0, 0, '', '', '2023-05-28', '2025-12-24', '4 Cuatrimestres', '18679', '3jKIwC', 'Activo', '', 'Sin Observaciones.'),
(19, 'Karla Galilea', 'Arizmendi Vazquez', 18650, 'Ingeniería en Sistemas Productivos', 5, '8', 0, 0, 0, '', '', '2023-05-28', '2025-12-20', '4 Cuatrimestres', '18650', 'z73iYo', 'Activo', '', 'Sin Observaciones.'),
(20, 'Jorge Ivan', 'Corpus Zapata', 19651, 'TSU en Mantenimiento área Industrial', 7, '5', 0, 0, 0, '', '', '2023-05-28', '2024-01-19', '2 Cuatrimestres', '19651', '01dvJL', 'Activo', '', 'Sin Observaciones.'),
(21, 'Jabes Sebastián', 'Hernández Antonio', 19648, 'TSU en Mantenimiento área Industrial', 7, '5', 0, 0, 0, '', '', '2023-05-28', '2024-12-31', '2 Cuatrimestres', '19648', 'eyAncH', 'Activo', '', 'Sin Observaciones.'),
(22, 'Francisco Gabriel', 'Montelongo Ramos', 19643, 'TSU en Mantenimiento área Industrial', 7, '5', 0, 0, 0, '', '', '2023-05-28', '2024-01-13', '2 Cuatrimestres', '19643', 'CoUA6h', 'Activo', '', 'Sin Observaciones.'),
(23, 'Francisco Eugenio', 'De la O Reyes', 19642, 'Ingeniería en Mantenimiento Industrial', 7, '5', 0, 0, 0, '', '', '2023-05-28', '2024-12-25', '2 Cuatrimestres', '19642', 'v5unhC', 'Activo', '', 'Sin Observaciones.'),
(24, 'Brayan', 'Limón Delgado', 19629, 'TSU en Mantenimiento área Industrial', 10, '5', 0, 0, 0, '', '', '2023-05-28', '2024-01-17', '7 Cuatrimestres', '19629', 'xZDUcH', 'Activo', '', 'Sin Observaciones.'),
(25, 'Ricardo Angel', 'Fuentes Guerra', 19709, 'TSU en Mantenimiento área Industrial', 10, '5', 0, 0, 0, '', '', '2023-05-28', '2024-01-13', '7 Cuatrimestres', '19709', 'IkGoxa', 'Activo', '', 'Sin Observaciones.'),
(26, 'Diana Laura', 'Cavazos Martinez', 20308, 'TSU en Desarrollo de Negocios área Mercadotecnia', 10, '3', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '9 Cuatrimestres', '20308', 'mYsMCA', 'Activo', '', 'Sin Observaciones.'),
(27, 'Juan Manuel', 'Zambrano Leal', 20428, 'TSU en Procesos Industriales área Manufactura', 10, '3', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '9 Cuatrimestres', '20428', 'MVzt3F', 'Activo', '', 'Sin Observaciones.'),
(28, 'Gerardo Asael', 'Esquivel de la Cruz', 19681, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '19681', 'DntYkW', 'Activo', '', 'Sin Observaciones.'),
(29, 'Héctor', 'Ortiz Cavazos', 20489, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '20489', 'chVmEs', 'Activo', '', 'Sin Observaciones.'),
(30, 'Brian Abimael', 'Ramirez Guzman', 20492, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '20492', 'gJW4yb', 'Activo', '', 'Sin Observaciones.'),
(31, 'Francisco Antonio', 'Sánchez Zaragoza', 20495, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '20495', 'ABTuwK', 'Activo', '', 'Sin Observaciones.'),
(32, 'Yahir de Jesus', 'Morin Delabra', 20488, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '20488', 'gd4McX', 'Activo', '', 'Sin Observaciones.'),
(33, 'Gilberto', 'Mendoza Alvarez', 20484, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '20484', 'q1XAle', 'Activo', '', 'Sin Observaciones.'),
(34, 'Pablo Sebastián', 'Puente Torres', 19665, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '19665', 'XC06AY', 'Activo', '', 'Sin Observaciones.'),
(35, 'Axel Uriel', 'Loera Quiroz', 20480, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '20480', 'aZQ47J', 'Activo', '', 'Sin Observaciones.'),
(36, 'Jesús Adrián', 'Montoya Iracheta', 20486, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '20486', 'lJiWNE', 'Activo', '', 'Sin Observaciones.'),
(37, 'Fernando', 'Espinosa Perez', 19640, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '19640', 'Uq3TF0', 'Activo', '', 'Sin Observaciones.'),
(38, 'Diana Abigail', 'Aguilar Escobar', 20471, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '20471', 'M0LUgz', 'Activo', '', 'Sin Observaciones.'),
(39, 'María Fernanda', 'Amaro De La Fuente', 20472, 'TSU en Mantenimiento área Industrial', 8, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '3 Cuatrimestres', '20472', 'gax3cX', 'Activo', '', 'Sin Observaciones.'),
(40, 'Carlos Brayan', 'Gonzalez Oyohua', 18992, 'Ingeniería en Mantenimiento Industrial', 6, '7', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '5 Cuatrimestres', '18992', 's5HULI', 'Baja', '', 'Sin Observaciones.'),
(41, 'Omar Isai', 'Garcia Coronado', 19088, 'Ingeniería en Mantenimiento Industrial', 6, '7', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '5 Cuatrimestres', '19088', 'Flt9U3', 'Baja', '', 'Sin Observaciones.'),
(42, 'Andrés Alejandro', 'Banda Tello', 20880, 'TSU en Mantenimiento área Industrial', 6, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '8 Cuatrimestres', '20880', '1Wlx9y', 'Activo', '', 'Sin Observaciones.'),
(43, 'Erik Daniel', 'Ramoz Pérez', 19096, 'Ingeniería en Sistemas Productivos', 6, '7', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '5 Cuatrimestres', '19096', 'D5UEbV', 'Baja', '', 'Sin Observaciones.'),
(44, 'Lorena Guadalupe', 'Martinez Martinez', 19075, 'Ingeniería en Sistemas Productivos', 6, '7', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '5 Cuatrimestres', '19075', 'FJEnS0', 'Baja', '', 'Sin Observaciones.'),
(45, 'Edgamy Paul', 'Tabares Buentello', 20517, 'TSU en Mecatrónica área Automatización', 9, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '8 Cuatrimestres', '20517', 'VnyPaL', 'Activo', '', 'Sin Observaciones.'),
(46, 'José Luis', 'Antonio Epifanio', 19692, 'TSU en Mecatrónica área Automatización', 9, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '8 Cuatrimestres', '19692', 'vsUc0J', 'Activo', '', 'Sin Observaciones.'),
(47, 'Diego Armando', 'Padilla Rodríguez', 19535, 'TSU en Mecatrónica área Automatización', 9, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '8 Cuatrimestres', '19535', 'Cjxv8q', 'Activo', '', 'Sin Observaciones.'),
(48, 'Mariana Guadalupe', 'Luna Alvarez', 20507, 'TSU en Mecatrónica área Automatización', 9, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '8 Cuatrimestres', '20507', 'xJHptm', 'Activo', '', 'Sin Observaciones.'),
(49, 'Hilda', 'Tetzoyotl Tetlactle', 20424, 'TSU en Procesos Industriales área Manufactura', 9, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '8 Cuatrimestres', '20424', 'o9EfPy', 'Activo', '', 'Sin Observaciones.'),
(50, 'Ricardo Antonio', 'Rodriguez Olivares', 20627, 'TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma', 9, '4', 0, 0, 0, '', '', '2023-05-28', '0000-00-00', '8 Cuatrimestres', '20627', 'P9w5Bt', 'Activo', '', 'Sin Observaciones.'),
(51, 'Abigail Maricela', 'Muníz Betancourt', 19188, 'TSU en Lengua Inglesa', 3, '4', 0, 0, 0, '', '', '2023-05-28', '2027-12-24', '8 Cuatrimestres', '19188', 'XO2dao', 'Activo', '', 'Sin Observaciones.'),
(65, 'Marco', 'Pérez Vasquez', 15166, 'TSU en Mantenimiento área Industrial', NULL, '10', 0, 0, 0, '', '', '0000-00-00', '0000-00-00', NULL, '15166', '3FlpQ2', 'Activo', '', 'Sin Observaciones.'),
(66, 'Laez', 'Sanchez De la Torre', 19348, 'TSU en Lengua Inglesa', 3, '6', 0, 0, 0, '', '', '2023-06-02', '2023-06-21', NULL, '19348', 'hP3u7C', 'Activo', '', 'Sin Observaciones.'),
(67, 'Carlos', 'Padilla Rodríguez', 151215, '', NULL, '6', 0, 0, 0, '', '', '0000-00-00', '0000-00-00', NULL, '151215', '6C8uba', 'Activo', '', 'Sin Observaciones.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_docentes`
--

DROP TABLE IF EXISTS `alumnos_docentes`;
CREATE TABLE IF NOT EXISTS `alumnos_docentes` (
  `idAlumno` int DEFAULT NULL,
  `idDocente` int DEFAULT NULL,
  KEY `idAlumno` (`idAlumno`),
  KEY `idDocente` (`idDocente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos_docentes`
--

INSERT INTO `alumnos_docentes` (`idAlumno`, `idDocente`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_postulados`
--

DROP TABLE IF EXISTS `alumnos_postulados`;
CREATE TABLE IF NOT EXISTS `alumnos_postulados` (
  `idPostulado` int NOT NULL AUTO_INCREMENT,
  `nombres` text COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` text COLLATE utf8mb4_general_ci NOT NULL,
  `matricula` int NOT NULL,
  `carrera` enum('Ingeniería en Desarrollo y Gestión de Software','Ingeniería en Mecatrónica','Ingeniería en Sistemas Productivos','Ingeniería en Mantenimiento Industrial','Licenciatura en Innovación de Negocios y Mercadotecnia','Licenciatura en Gestión Institucional Educativa y Curricular','TSU en Lengua Inglesa','TSU en Tecnologías de la Información área Desarrollo de Software','TSU en Desarrollo de Negocios área Mercadotecnia','TSU en Mantenimiento área Industrial','TSU en Procesos Industriales área Manufactura','TSU en Mecatrónica área Automatización') COLLATE utf8mb4_general_ci NOT NULL,
  `cuatrimestre` enum('1','2','3','4','5','6','7','8','9','10','11') COLLATE utf8mb4_general_ci NOT NULL,
  `correo` text COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` text COLLATE utf8mb4_general_ci NOT NULL,
  `empresa` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idPostulado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos_postulados`
--

INSERT INTO `alumnos_postulados` (`idPostulado`, `nombres`, `apellidos`, `matricula`, `carrera`, `cuatrimestre`, `correo`, `telefono`, `empresa`) VALUES
(5, 'Miriam', 'Castillo Lozano', 151784, 'Licenciatura en Gestión Institucional Educativa y Curricular', '1', '151784@virtual.utsc.edu.mx', '', 'Centro Educativo Santa Catarina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

DROP TABLE IF EXISTS `asignaturas`;
CREATE TABLE IF NOT EXISTS `asignaturas` (
  `idAsignatura` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `competencia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idCuatrimestre` int DEFAULT NULL,
  `idCarrera` int DEFAULT NULL,
  PRIMARY KEY (`idAsignatura`),
  KEY `cuatrimestre_id` (`idCuatrimestre`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`idAsignatura`, `nombre`, `competencia`, `idCuatrimestre`, `idCarrera`) VALUES
(1, 'Cálculo Diferencial', 'El alumno determinará la razón de cambio y la solución óptima en problemas de su entorno, a través del cálculo diferencial para contribuir a la toma de decisiones en el manejo eficiente de los recursos.', 1, 1),
(2, 'Probabilidad y Estadística', 'El alumno resolverá problemas estadísticos mediante el procesamiento de datos, así como el análisis y estimación de parámetros para fundamentar la toma de decisiones. ', 1, 1),
(3, 'Sistemas Operativos', 'El alumno realizará la instalación y configuración de sistemas operativos y los servicios necesarios para la publicación de sitios web.', 1, 1),
(4, 'Integradora I', 'El alumno demostrará la competencia de desarrollar soluciones tecnológicas para entornos Web mediante fundamentos de programación orientada a objetos, base de datos y redes de área local  que atiendan las necesidades de las organizaciones.', 1, 1),
(5, 'Aplicaciones Web', 'El alumno desarrollará aplicaciones Web con acceso a base de datos a través de lenguajes y herramientas especializadas para distribuirlas en internet.', 1, 1),
(6, 'Bases de Datos para Aplicaciones', 'El alumno creará bases de datos con base en esquemas de administración y seguridad para su integración en aplicaciones de software.', 1, 1),
(7, 'Inglés III', 'El alumno intercambiará información sobre acontecimientos pasados, así como de planes y proyectos a futuro mediante el uso de los verbos modales, el pasado continuo y las formas del futuro; para la satisfacción de sus necesidades inmediatas, la comprensión de normas y reglamentos establecidos,  toma de decisiones y compromiso con su entorno personal, social y profesional inmediato.', 1, 1),
(8, 'Formación Sociocultural III', 'El alumno establecerá estrategias de trabajo, a través de la dirección de equipos, solución de conflictos y toma de decisiones, para contribuir al logro de los objetivos de la organización.', 1, 1),
(9, 'Estándares y Métricas para el Desarrollo de Software', 'El alumno evaluará las metodologías y modelos existentes en la industria mediante el uso de estándares y métricas para asegurar la calidad de proyectos de desarrollo de software.', 2, 1),
(10, 'Principios de IoT', 'El alumno programará dispositivos de hardware abierto mediante la manipulación de componentes electrónicos para la propuesta de soluciones tecnológicas orientadas a sistemas embebidos.', 2, 1),
(11, 'Diseño de Apps', 'El alumno desarrollará soluciones tecnológicas mediante aplicaciones móviles que integren el patrón de diseño Modelo Vista Controlador e interfaces de usuario para su publicación en las plataformas de distribución digital.', 2, 1),
(12, 'Estructura de Datos Aplicadas', 'El alumno empleará estructuras de datos abstractas en el desarrollo de aplicaciones multiplataforma usando el paradigma orientado a objetos para agilizar el acceso a los datos.', 2, 1),
(13, 'Aplicaciones Web Orientadas a Servicios', 'El alumno desarrollará aplicaciones Web híbridas orientadas a servicios mediante la integración de lenguajes de programación, frameworks de desarrollo y API\'s para la publicación en la nube.', 2, 1),
(14, 'Evaluación y Mejora para el Desarrollo de Software', 'El alumno implementará pruebas manuales y de software de acceso abierto para evaluar la calidad y operación integral de sistemas Web y móvil.', 2, 1),
(15, 'Inglés IV', 'El alumno intercambiará información sobre experiencias vividas y su frecuencia a partir del uso del Presente Perfecto y Pasado Simple; así como de la comparación de lugares, personas, objetos y situaciones para relacionarse con su entorno social y laboral inmediato.', 2, 1),
(16, 'Formación Sociocultural IV', 'El alumno desarrollará ideas innovadoras o alternativas de solución, bajo parámetros éticos de aplicación y mediante el uso de técnicas de creatividad, para dar solución a problemas cotidianos o estimular la generación de nuevos negocios que contribuyan al desarrollo económico y social del entorno.', 2, 1),
(17, 'Aplicaciones de IoT', 'El alumno desarrollará aplicaciones de IoT mediante la integración de software y hardware abierto para monitoreo y control de sistemas embebidos.', 3, 1),
(18, 'Desarrollo Móvil Multiplataforma', 'El alumno desarrollará aplicaciones móviles multiplataforma mediante el uso de frameworks para el control de dispositivos de hardware abierto y gestión de información en bases de datos.', 3, 1),
(19, 'Integradora II', 'El alumno aplicará metodologías de aprendizaje basada en proyectos para el desarrollo de soluciones tecnológicas.', 3, 1),
(20, 'Aplicaciones Web para I4.0', 'El alumno desarrollará aplicaciones Web empresariales mediante el uso de Frameworks MVC para brindar seguridad a los procesos de la industria 4.0.', 3, 1),
(21, 'Bases de Datos para Cómputo en la Nube', 'El alumno implementará Bases de Datos no relacionales en la nube a través de las herramientas NoSQL  para  integrarlas con aplicaciones multiplataforma.', 3, 1),
(22, 'Expresión Oral y Escrita II', 'El alumno expresará de manera oral y escrita la información relativa a su formación académica y profesional, las condiciones indispensables para llevar a cabo acciones de mejora, así como la interpretación de documentos auténticos para facilitar su inserción en su entorno social y profesional.', 3, 1),
(23, 'Inglés V', 'El alumno sustentará proyectos escritos y orales con base en el proceso de la comunicación, la argumentación y los tipos de textos y documentos acorde al Nivel B2 del Marco Común Europeo de Referencia para lograr la comunicación efectiva en un contexto profesional y sociocultural. ', 3, 1),
(24, 'Proyecto de Estadía', 'El TSU en Tecnologías de la Información Área Desarrollo de Software Multiplataforma será capaz de analizar los requerimientos, diseñar soluciones, desarrollar software para distintas plataformas, diseñar y administrar bases de datos, aplicar pruebas de software e implementar soluciones de tecnologías de la información para la optimización y solución de problemáticas.', 4, 1),
(40, 'u9iio', 'awr', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `borradores`
--

DROP TABLE IF EXISTS `borradores`;
CREATE TABLE IF NOT EXISTS `borradores` (
  `idBorrador` int NOT NULL AUTO_INCREMENT,
  `idAlumno` int NOT NULL,
  `matricula` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombres` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `carrera` enum('Ingeniería en Desarrollo y Gestión de Software','Ingeniería en Mecatrónica','Ingeniería en Sistemas Productivos','Ingeniería en Mantenimiento Industrial','Licenciatura en Innovación de Negocios y Mercadotecnia','Licenciatura en Gestión Institucional Educativa y Curricular','TSU en Lengua Inglesa','TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma','TSU en Desarrollo de Negocios área Mercadotecnia','TSU en Mantenimiento área Industrial','TSU en Procesos Industriales área Manufactura','TSU en Mecatrónica área Automatización') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `empresa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idTutor` int NOT NULL,
  `idInstructor` int NOT NULL,
  `semana` enum('1','2','3','4','5','6','7','8','9','10','11','12') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_Inicio` date NOT NULL,
  `f_Fin` date NOT NULL,
  `cuatrimestre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `resumen_L` varchar(8000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img_L` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `resumen_M` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `img_M` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `resumen_Mi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `img_Mi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `resumen_J` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `img_J` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `resumen_V` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `img_V` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_L` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_M` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_Mi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_J` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_V` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `retro_tutor` varchar(350) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `retro_instructor` varchar(350) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estatus_tutor` enum('aprobado','pendiente','no_aprobado','sin_revisar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'sin_revisar',
  `estatus_instructor` enum('aprobado','pendiente','no_aprobado','sin_revisar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'sin_revisar',
  PRIMARY KEY (`idBorrador`),
  KEY `idAlumno` (`idAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `borradores`
--

INSERT INTO `borradores` (`idBorrador`, `idAlumno`, `matricula`, `nombres`, `apellidos`, `carrera`, `empresa`, `idTutor`, `idInstructor`, `semana`, `f_Inicio`, `f_Fin`, `cuatrimestre`, `resumen_L`, `img_L`, `resumen_M`, `img_M`, `resumen_Mi`, `img_Mi`, `resumen_J`, `img_J`, `resumen_V`, `img_V`, `fecha_L`, `fecha_M`, `fecha_Mi`, `fecha_J`, `fecha_V`, `retro_tutor`, `retro_instructor`, `estatus_tutor`, `estatus_instructor`) VALUES
(102, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 'Colegio Mexicano AC', 1, 1, '9', '2023-07-17', '2023-07-21', '5', '<p>uju7</p>', '', '', '', '', '', '', '', '', '', '17-07-2023', '18-07-2023', '19-07-2023', '20-07-2023', '21-07-2023', NULL, NULL, 'sin_revisar', 'sin_revisar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

DROP TABLE IF EXISTS `carreras`;
CREATE TABLE IF NOT EXISTS `carreras` (
  `idCarrera` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idCarrera`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`idCarrera`, `nombre`) VALUES
(1, 'Ingeniería en Desarrollo y Gestión de Software'),
(2, 'Ingeniería en Mecatrónica'),
(3, 'Ingeniería en Sistemas Productivos'),
(4, 'Ingeniería en Mantenimiento Industrial'),
(5, 'Licenciatura en Innovación de Negocios y Mercadotecnia'),
(6, 'Licenciatura en Gestión Institucional Educativa y Curricular'),
(7, 'TSU en Lengua Inglesa'),
(8, 'TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma'),
(9, 'TSU en Desarrollo de Negocios área Mercadotecnia'),
(10, 'TSU en Mantenimiento área Industrial'),
(11, 'TSU en Procesos Industriales área Manufactura'),
(12, 'TSU en Mecatrónica área Automatización');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuatrimestres`
--

DROP TABLE IF EXISTS `cuatrimestres`;
CREATE TABLE IF NOT EXISTS `cuatrimestres` (
  `idCuatrimestre` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idCuatrimestre`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuatrimestres`
--

INSERT INTO `cuatrimestres` (`idCuatrimestre`, `nombre`) VALUES
(1, '3er Cuatrimestre'),
(2, '4to Cuatrimestre'),
(3, '5to Cuatrimestre'),
(4, '6to Cuatrimestre'),
(5, '7mo Cuatrimestre'),
(6, '8vo Cuatrimestre'),
(7, '9no Cuatrimestre'),
(8, '10mo Cuatrimestre'),
(9, '11vo Cuatrimestre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores`
--

DROP TABLE IF EXISTS `directores`;
CREATE TABLE IF NOT EXISTS `directores` (
  `idDirector` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `matricula` int NOT NULL,
  `nombres` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idDirector`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `directores`
--

INSERT INTO `directores` (`idDirector`, `tipo`, `matricula`, `nombres`, `apellidos`, `usuario`, `password`) VALUES
(1, 'Directivo', 356431, 'Gabriela', 'Ruiz', 'Directivo', '12345'),
(2, 'Encargado Proyecto Dual', 0, 'Encargado Proyecto Dual', '', 'ProyectoDual', 'cetOLB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

DROP TABLE IF EXISTS `docentes`;
CREATE TABLE IF NOT EXISTS `docentes` (
  `idDocente` int NOT NULL AUTO_INCREMENT,
  `matricula` int NOT NULL,
  `nombres` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idDocente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`idDocente`, `matricula`, `nombres`, `apellidos`, `usuario`, `password`) VALUES
(4, 1515151, 'Ulises', 'ada', 'Docente', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edit_reportes`
--

DROP TABLE IF EXISTS `edit_reportes`;
CREATE TABLE IF NOT EXISTS `edit_reportes` (
  `idEReporte` int NOT NULL AUTO_INCREMENT,
  `idReporteOriginal` int NOT NULL,
  `idAlumno` int NOT NULL,
  `matricula` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombres` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `carrera` enum('Ingeniería en Desarrollo y Gestión de Software','Ingeniería en Mecatrónica','Ingeniería en Sistemas Productivos','Ingeniería en Mantenimiento Industrial','Licenciatura en Innovación de Negocios y Mercadotecnia','Licenciatura en Gestión Institucional Educativa y Curricular','TSU en Lengua Inglesa','TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma','TSU en Desarrollo de Negocios área Mercadotecnia','TSU en Mantenimiento área Industrial','TSU en Procesos Industriales área Manufactura','TSU en Mecatrónica área Automatización') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idTutor` int NOT NULL,
  `idInstructor` int NOT NULL,
  `idFormador` int NOT NULL,
  `empresa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `semana` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_Inicio` date NOT NULL,
  `f_Fin` date NOT NULL,
  `cuatrimestre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `resumen_L` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `resumen_M` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `resumen_Mi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `resumen_J` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `resumen_V` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `fecha_L` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img_L` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img_M` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img_Mi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img_J` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img_V` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_M` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_Mi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_J` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_V` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `retro_tutor` varchar(350) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `retro_instructor` varchar(350) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estatus_tutor` enum('aprobado','pendiente','no_aprobado','sin_revisar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'sin_revisar',
  `estatus_instructor` enum('aprobado','pendiente','no_aprobado','sin_revisar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'sin_revisar',
  PRIMARY KEY (`idEReporte`),
  KEY `idAlumno` (`idAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `edit_reportes`
--

INSERT INTO `edit_reportes` (`idEReporte`, `idReporteOriginal`, `idAlumno`, `matricula`, `nombres`, `apellidos`, `carrera`, `idTutor`, `idInstructor`, `idFormador`, `empresa`, `semana`, `f_Inicio`, `f_Fin`, `cuatrimestre`, `resumen_L`, `resumen_M`, `resumen_Mi`, `resumen_J`, `resumen_V`, `fecha_L`, `img_L`, `img_M`, `img_Mi`, `img_J`, `img_V`, `fecha_M`, `fecha_Mi`, `fecha_J`, `fecha_V`, `retro_tutor`, `retro_instructor`, `estatus_tutor`, `estatus_instructor`) VALUES
(19, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '1', '2023-06-26', '2023-06-30', '4', '', '', '', '', '<p>adadaada</p>', '26-06-2023', '', '', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', 'Buen trabajo', NULL, 'no_aprobado', 'aprobado'),
(20, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '2', '2023-06-26', '2023-06-30', '4', 'adadadad', '', '', '', 'ada', '26-06-2023', '', '', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(21, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '3', '2023-06-26', '2023-06-30', '4', '<p>lknasncknaskc klasc</p>', '', '', '', '', '26-06-2023', '', '', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(22, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '4', '2023-06-26', '2023-06-30', '4', '<p>dmfksdmkfmskdmfsdsd</p>', '', '', '', '', '26-06-2023', '', '', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(23, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '5', '2023-06-26', '2023-06-30', '4', '<p>lknsdksdnfklnsdklfnsd</p>', '', '', '', '', '26-06-2023', 'imagenes/reportes/R.png', '', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(24, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '6', '2023-06-26', '2023-06-30', '4', '<p>,jabzxjbajksbxjkasas</p>', '<p>akjbsdjbasjbdjkabskdjas</p>', '', '', '', '26-06-2023', 'imagenes/reportes/popop.jpg', 'images/reportes/Evidencia.jpg', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(25, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '7', '2023-06-26', '2023-06-30', '4', '<p>sjdbfjsdbjfkbjsdbfjkbsjd</p>', '<p>kjasjdbjasbdjkbaskda</p>', '', '', '', '26-06-2023', 'imagenes/reportes/popop.jpg', 'images/reportes/Evidencia.jpg', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(26, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '7', '2023-06-26', '2023-06-30', '4', '<p>sjdbfjsdbjfkbjsdbfjkbsjd</p>', '<p>kjasjdbjasbdjkbaskda</p>', '', '', '', '26-06-2023', 'imagenes/reportes/popop.jpg', 'images/reportes/evidencia2.jpeg', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(27, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '7', '2023-06-26', '2023-06-30', '4', '<p>sjdbfjsdbjfkbjsdbfjkbsjd</p>', '<p>kjasjdbjasbdjkbaskda</p>', '', '', '', '26-06-2023', 'imagenes/reportes/popop.jpg', 'images/reportes/popop.jpg', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(28, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '10', '2023-06-26', '2023-06-30', '4', '<p>ksndfjnskdnfjksdnjfknsd</p>', '<p>lknasjcnkasndkcnaskc</p>', '', '', '', '26-06-2023', 'imagenes/reportes/popop.jpg', 'imagenes/reportes/Evidencia.jpg', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(29, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '11', '2023-06-26', '2023-06-30', '4', '<p>klsndkjnkjsfkjsndjfds</p>', '<p>kjnjbjbjjkjkbkjbkj</p>', '<p>lnjknjnfjnwejfnjkwenwe</p>', '', '', '26-06-2023', 'imagenes/reportes/popop.jpg', 'imagenes/reportes/R.png', 'imagenes/reportes/evidencia2.jpeg', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(30, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '12', '2023-06-26', '2023-06-30', '4', '<p>kncnsklncsdsd</p>', '<p>lsdjcfbsdjbvcjsbdjvkbsd</p>', '<p>lnkdlsfncksdnklcnklsdc</p>', '<p>jabjcbjkasbjcajscjkas</p>', '', '26-06-2023', 'imagenes/reportes/popop.jpg', 'imagenes/reportes/evidencia2.jpeg', 'imagenes/reportes/Evidencia.jpg', 'imagenes/reportes/landscape.jpg', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(31, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '13', '2023-06-26', '2023-06-30', '4', '<p>njncjsndjcnjkdsnjcsd</p>', '<p>knkzncksdklncknsdklcds</p>', '<p>knsdjkcsdknckjdnds</p>', '<p>ksncdjbdjkbcjbsjdjkds</p>', '<p>sndcjsdjcbjksdbjckbjkdscjkds</p>', '26-06-2023', 'imagenes/reportes/popop.jpg', 'imagenes/reportes/evidencia2.jpeg', 'imagenes/reportes/landscape.jpg', 'imagenes/reportes/R.png', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(32, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '13', '2023-06-26', '2023-06-30', '4', '<p>njncjsndjcnjkdsnjcsd</p>', '<p>knkzncksdklncknsdklcds</p>', '<p>knsdjkcsdknckjdnds</p>', '<p>ksncdjbdjkbcjbsjdjkds</p>', '<p>sndcjsdjcbjksdbjckbjkdscjkds</p>', '26-06-2023', 'imagenes/reportes/popop.jpg', 'imagenes/reportes/evidencia2.jpeg', 'imagenes/reportes/landscape.jpg', 'imagenes/reportes/R.png', 'imagenes/reportes/landscape.jpg', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(33, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '15', '2023-06-26', '2023-06-30', '4', '<p>a dc sdnam cn sdncsdcsd</p>', '', '', '', '', '26-06-2023', 'imagenes/borradores/popop.jpg', '', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(34, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '16', '2023-06-26', '2023-06-30', '4', '<p>kansdjbsjbjfjsdfs</p>', '<p>asdjbasjdbjabsjdkas</p>', '', '', '', '26-06-2023', 'imagenes/borradores/popop.jpg', 'imagenes/borradores/landscape.jpg', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(35, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '17', '2023-06-26', '2023-06-30', '4', '<p>kansdjbsjbjfjsdfs</p>', '<p>asdjbasjdbjabsjdkas</p>', '', '', '', '26-06-2023', 'imagenes/borradores/popop.jpg', 'imagenes/borradores/landscape.jpg', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(36, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '18', '2023-06-26', '2023-06-30', '4', '<p>lknscjbjbcjksdbjhkcbskdsd</p>', '<p>asndnhajsdbjasdas</p>', '', '', '', '26-06-2023', '', '', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(37, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '19', '2023-06-26', '2023-06-30', '4', '<p>ksndlkcnsknfdklcnslkdnclknsdcklsd</p>', '<p>asndknaskdklasndka</p>', '<p>lsndkfnklsndklfnskdnfklsndkfnsd</p>', '<p>lkndfnjsdbjfubsjdbfjkdsjkfbsdf</p>', '<p>kdnfknklsdnfknsdkfnklsdnfklnsldknfs</p>', '26-06-2023', '', 'imagenes/reportes/popop.jpg', 'imagenes/reportes/popop.jpg', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(38, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '20', '2023-06-26', '2023-06-30', '4', '<p>lsdnlcnlsdncknklsdncklnsdklncklsd</p>', '<p>jsndjcbjsdbjvbsjdvjkbsdkvjbdsjsbdjbsdjbfsbdfbjsdbfkjsd</p>', '<p>bnkdnfknskdfnksndfknsdnfsdf</p>', '<p>jdbcjbjsbdjbcsjdbvjsbdkjvbsdkjsdbvjbsdjvbjsdsd</p>', '<p>jsdbjfcbsjdbfjsbdjfbjsdbfkjbsdfkjdsf</p>', '26-06-2023', 'imagenes/reportes/popop.jpg', '', 'imagenes/reportes/landscape.jpg', '', 'imagenes/reportes/Evidencia.jpg', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(39, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '21', '2023-06-26', '2023-06-30', '4', '<p>akjbsdjabsjdbjkasbdjbasda</p>', '<p>jsbdcjbsjdsdcsd</p>', '', '', '', '26-06-2023', 'imagenes/borradores/popop.jpg', '', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(40, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '21', '2023-06-26', '2023-06-30', '4', '<p>akjbsdjabsjdbjkasbdjbasda</p>', '<p>jsbdcjbsjdsdcsd</p>', '', '', '', '26-06-2023', 'imagenes/borradores/popop.jpg', '', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(41, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '23', '2023-06-26', '2023-06-30', '4', '<p>holalalalala</p>', '<p>lalalalalalala</p>', '', '', '', '26-06-2023', '', '', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(42, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '24', '2023-06-26', '2023-06-30', '4', '<p>lksndkvnksdvkksdlnvksdv</p>', '<p>sdjcbsjdbcbsjdbcjkdsc</p>', '', '', '', '26-06-2023', 'imagenes/borradores/R.png', 'imagenes/borradores/Evidencia.jpg', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(43, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '25', '2023-06-26', '2023-06-30', '4', '<p>utsc</p>', '<p>scc</p>', '', '', '', '26-06-2023', 'imagenes/borradores/evidencia2.jpeg', 'imagenes/borradores/Evidencia.jpg', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(44, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '26', '2023-06-26', '2023-06-30', '4', '<p>hola</p>', '<p>lala</p>', '<p>papapa</p>', '<p>zazazazazaz</p>', '<p>mamzzazazassadsdasdasda</p>', '26-06-2023', 'imagenes/borradores/landscape.jpg', 'imagenes/borradores/evidencia2.jpeg', 'imagenes/borradores/evidencia2.jpeg', 'imagenes/borradores/Evidencia.jpg', 'imagenes/borradores/R.png', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(45, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '27', '2023-06-26', '2023-06-30', '4', '<p>kaoskdoaksdokaskdoas</p>', '<p>okokokokoo</p>', '<p>okokokokookook</p>', '<p>kokokokokokok</p>', '<p>kokokokokokok</p>', '26-06-2023', 'imagenes/borradores/popop.jpg', 'imagenes/borradores/landscape.jpg', 'imagenes/borradores/evidencia2.jpeg', 'imagenes/borradores/Evidencia.jpg', 'imagenes/borradores/R.png', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(46, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '28', '2023-06-26', '2023-06-30', '4', '<p>popopopopop</p>', '<p>lsdnjcbjsdbcjsbdjcbjdkvsd</p>', '<p>kansdjnjsdnfjnsdfnsd</p>', '<p>kjsdnfnsjdvbjsdbjvkbsdjvbsdv</p>', '', '26-06-2023', 'imagenes/borradores/R.png', 'imagenes/borradores/landscape.jpg', 'imagenes/borradores/evidencia2.jpeg', 'imagenes/borradores/Evidencia.jpg', 'imagenes/borradores/R.png', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(47, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '29', '2023-06-26', '2023-06-30', '4', '<p>lksndknksndkflnskdfksd</p>', '<p>lsdnjcbjsdbcjsbdjcbjdkvsd</p>', '<p>kansdjnjsdnfjnsdfnsd</p>', '<p>kjsdnfnsjdvbjsdbjvkbsdjvbsdv</p>', '<p>lksnkdncksndkcnslkdncklnsdklcnlksdcsd</p>', '26-06-2023', 'imagenes/borradores/R.png', 'imagenes/borradores/popop.jpg', 'imagenes/borradores/popop.jpg', 'imagenes/borradores/popop.jpg', 'imagenes/borradores/popop.jpg', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(48, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '30', '2023-06-26', '2023-06-30', '4', '<p>lksndkflnklsdnfklsndfnlskdfs</p>', '<p>lsdnclknsdkcnklsdnvlknsdklvnlksdvsd</p>', '<p>aksbdjkabsjkcbajscabsjcjkasbcjkbascas</p>', '<p>jbwdfjkbcwjbdfkjwbjfbwjefbjkwebfjkbwekjfkjwef</p>', '<p>acjasbcjkbsdjcbjdsbcjsdbcjkbskdjcbkjdsds</p>', '26-06-2023', 'imagenes/borradores/R.png', '', 'imagenes/borradores/landscape.jpg', '', 'imagenes/borradores/popop.jpg', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(49, 0, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 1, 'Colegio Mexicano AC', '31', '2023-06-26', '2023-06-30', '4', '<p>,asndjbajsdbjasbdkbasdkjasd</p>', '<p>asjdbajsbdjbajsdbajbsdkjas</p>', '<p>ajsdbjabsdbajsdbjkaskdjasd</p>', '<p>askldnaksndknaskldnasd</p>', '<p>loloaksdoasdasda</p>', '26-06-2023', '', '', '', '', '', '27-06-2023', '28-06-2023', '29-06-2023', '30-06-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(50, 50, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>hola</p>', '<p>sdc,jbsdjcbjkdsc</p>', '<p>dsjbcjsdbjckbsjdcsd</p>', '<p>jkdsbncsdbjkcbsdjcjksdc</p>', '<p>sdckjbsdjcbjsdckjsd</p>', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(51, 19, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>am smnasmnckasnkcsdcsd</p>', '', '', '', '<p>adadaada</p>', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(52, 51, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>ksdncjnsdklncksdncnklsdncds</p>', '<p>ncnkncksdnkcsdcsdc</p>', '<p>sdcsdcsdcsdcsdc</p>', '<p>sdcdfsdfsdfsdfsdfsd</p>', '<p>lololo</p>', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(53, 52, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>sndkncksdnvknsdklvnsdvsd</p>', '<p>sdfsdfsdfds</p>', '', '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(54, 52, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>sndkncksdnvknsdklvnsdvsd</p>', '<p>sdfsdfsdfds</p>', '<p>skndkvnskdnvlskdnvksnldvsd</p>', '<p>skldmfksnmdfknsdlnflknsdlkfsd</p>', '<p>mdnsfknsdklfnksdlnfksdf</p>', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(55, 52, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>sndkncksdnvknsdklvnsdvsd</p>', '<p>hola</p>', '<p>skndkvnskdnvlskdnvksnldvsd</p>', '<p>skldmfksnmdfknsdlnflknsdlkfsd</p>', '<p>mdnsfknsdklfnksdlnfksdf</p>', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(56, 53, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>kzxkcnjsdnjcnsdkjcdnskcsd</p>', '<p>jsdjcbjsdbcjksdkjcsbdjkcbsd</p>', '', '', '', NULL, 'imagenes/reportes/R.png', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(57, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '', '', '', '', NULL, 'imagenes/reportes/R.png', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(58, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, 'imagenes/reportes/R.png', 'imagenes/reportes/R.png', 'imagenes/reportes/R.png', 'imagenes/reportes/R.png', 'imagenes/reportes/R.png', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(59, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, '', 'imagenes/reportes/Evidencia.jpg', 'imagenes/reportes/Evidencia.jpg', 'imagenes/reportes/Evidencia.jpg', 'imagenes/reportes/Evidencia.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(60, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, 'imagenes/reportes/R.png', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(61, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, '', 'imagenes/reportes/popop.jpg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(62, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, 'imagenes/reportes/R.png', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(63, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(64, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, 'imagenes/reportes/popop.jpg', 'imagenes/reportes/popop.jpg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(65, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, '', 'imagenes/reportes/landscape.jpg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(66, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, 'imagenes/reportes/popop.jpg', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(67, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, '', 'imagenes/reportes/popop.jpg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(68, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, 'imagenes/reportes/popop.jpg', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(69, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, '', 'imagenes/reportes/landscape.jpg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(70, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, 'imagenes/reportes/landscape.jpg', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(71, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, '', 'imagenes/reportes/popop.jpg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(72, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, 'imagenes/reportes/landscape.jpg', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(73, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(74, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, 'imagenes/reportes/R.png', 'imagenes/reportes/popop.jpg', 'imagenes/reportes/landscape.jpg', 'imagenes/reportes/evidencia2.jpeg', 'imagenes/reportes/popop.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(75, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, 'imagenes/reportes/landscape.jpg', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(76, 54, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>opjsoejgojesopgjopwejopgjeopjgopwe</p>', '<p>jbsdjbcjksdbjvbsjdvbkjdsbvkjbsdv</p>', '<p>kjnjbvujsdbvubsduivbsduivbuisdbvuids</p>', '<p>jjscbjsdbcjbjsdcjkbsdjcbjkdsjksdb&nbsp;</p>', '<p>kjbsdjcjsdbcjkbdsjcbjsdbcjkbsdjkcbjsdcb&nbsp;</p>', NULL, '', 'imagenes/reportes/popop.jpg', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar'),
(77, 57, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', 1, 1, 0, 'Colegio Mexicano AC', '', '0000-00-00', '0000-00-00', '', '<p>asdasdasdasda</p>', '<p>asdasdasdasd</p>', '<p>asdasdasd</p>', '<p>asdasdasdasd</p>', '<p>asdasdasdas</p>', NULL, 'imagenes/reportes/popop.jpg', 'imagenes/reportes/landscape.jpg', 'imagenes/reportes/evidencia2.jpeg', 'imagenes/reportes/R.png', 'imagenes/reportes/popop.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'sin_revisar', 'sin_revisar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `idEmpresa` int NOT NULL AUTO_INCREMENT,
  `nombreEmp` text COLLATE utf8mb4_general_ci NOT NULL,
  `colonia` text COLLATE utf8mb4_general_ci NOT NULL,
  `municipio` enum('Santa Catarina','Monterrey','García','San Pedro','Otro') COLLATE utf8mb4_general_ci NOT NULL,
  `calle` text COLLATE utf8mb4_general_ci NOT NULL,
  `numero` text COLLATE utf8mb4_general_ci NOT NULL,
  `cp` text COLLATE utf8mb4_general_ci NOT NULL,
  `giro` enum('Agricultura y actividades del campo','Minería','Energía eléctrica y suministro de agua y de gas','Construcción','Industrias manufactureras','Comercio','Transportes, correos y almacenamiento','Información en medios masivos','Servicios financieros y de seguros','Servicios inmobiliarios y de alquiler de bienes muebles e intangibles','Servicios profesionales, científicos y técnicos','Corporativos','Servicios de apoyo a los negocios y manejo de residuos y desechos','Servicios educativos','Servicios de salud y de asistencia social','Servicios de esparcimiento culturales y deportivos','Servicios de alojamiento temporal y de preparación de alimentos y bebidas','Otros servicios','Dependencias gubernamentales') COLLATE utf8mb4_general_ci NOT NULL,
  `razon_social` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `parqueIndustrial` enum('si','no') COLLATE utf8mb4_general_ci NOT NULL,
  `nombreC` text COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` text COLLATE utf8mb4_general_ci NOT NULL,
  `correo` text COLLATE utf8mb4_general_ci NOT NULL,
  `puesto` text COLLATE utf8mb4_general_ci NOT NULL,
  `ingreso` date NOT NULL,
  `estatus_empresa` enum('Activo','Desvinculado','En proceso') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Activo',
  `permite_imagenes` enum('Si','No') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`idEmpresa`, `nombreEmp`, `colonia`, `municipio`, `calle`, `numero`, `cp`, `giro`, `razon_social`, `parqueIndustrial`, `nombreC`, `telefono`, `correo`, `puesto`, `ingreso`, `estatus_empresa`, `permite_imagenes`) VALUES
(3, 'Colegio Mexicano AC', 'San Jerónimo ', 'Monterrey', 'Flores', '769', '59383', 'Servicios educativos', '', 'no', 'Martha Sanchez', '151266', 'marth1@gmail.com', 'Directora', '2023-05-29', 'Desvinculado', ''),
(4, 'Centro Educativo Santa Catarina', '', '', '', '', '', '', '', '', '', '', '', '', '2023-05-29', 'Activo', 'Si'),
(5, 'Siemens de México SA de CV', '', '', '', '', '', '', '', '', '', '', '', '', '2023-05-29', 'Activo', ''),
(6, 'CAMCAR DE MÉXICO, S. A. DE C.V.', '', '', '', '', '', '', '', '', '', '', '', '', '2023-05-29', 'Activo', ''),
(7, 'Coflex de México SA de CV', '', '', '', '', '', '', '', '', '', '', '', '', '2023-05-29', 'Activo', ''),
(8, 'Dal-Tile México, S. de R. L. de C.V.', '', '', '', '', '', '', '', '', '', '', '', '', '2023-05-29', 'Activo', ''),
(9, 'EZI METALES', '', '', '', '', '', '', '', '', '', '', '', '', '2023-05-29', 'Activo', ''),
(10, 'Griffith Foods SA de CV', '', '', '', '', '', '', '', '', '', '', '', '', '2023-05-29', 'Activo', ''),
(12, 'Estética Carmen', 'Paseo del Nogal', 'García', 'Tulipan', '14', '66007', 'Servicios de salud y de asistencia social', '', 'no', 'Carmen', '28248147', 'carmen@gmail.com', 'Jefa', '2023-06-01', 'Activo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas_postuladas`
--

DROP TABLE IF EXISTS `empresas_postuladas`;
CREATE TABLE IF NOT EXISTS `empresas_postuladas` (
  `idEmpresaPostulada` int NOT NULL AUTO_INCREMENT,
  `nombreEmp` text COLLATE utf8mb4_general_ci NOT NULL,
  `colonia` text COLLATE utf8mb4_general_ci NOT NULL,
  `municipio` enum('Santa Catarina','Monterrey','García','San Pedro','Otro') COLLATE utf8mb4_general_ci NOT NULL,
  `calle` text COLLATE utf8mb4_general_ci NOT NULL,
  `numero` text COLLATE utf8mb4_general_ci NOT NULL,
  `cp` text COLLATE utf8mb4_general_ci NOT NULL,
  `giro` enum('Agricultura y actividades del campo','Minería','Energía eléctrica y suministro de agua y de gas','Construcción','Industrias manufactureras','Comercio','Transportes, correos y almacenamiento','Información en medios masivos','Servicios financieros y de seguros','Servicios inmobiliarios y de alquiler de bienes muebles e intangibles','Servicios profesionales, científicos y técnicos','Corporativos','Servicios de apoyo a los negocios y manejo de residuos y desechos','Servicios educativos','Servicios de salud y de asistencia social','Servicios de esparcimiento culturales y deportivos','Servicios de alojamiento temporal y de preparación de alimentos y bebidas','Otros servicios','Dependencias gubernamentales') COLLATE utf8mb4_general_ci NOT NULL,
  `parqueIndustrial` enum('si','no') COLLATE utf8mb4_general_ci NOT NULL,
  `nombreC` text COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` text COLLATE utf8mb4_general_ci NOT NULL,
  `correo` text COLLATE utf8mb4_general_ci NOT NULL,
  `puesto` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idEmpresaPostulada`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas_postuladas`
--

INSERT INTO `empresas_postuladas` (`idEmpresaPostulada`, `nombreEmp`, `colonia`, `municipio`, `calle`, `numero`, `cp`, `giro`, `parqueIndustrial`, `nombreC`, `telefono`, `correo`, `puesto`) VALUES
(2, 'Instituto Bucle', 'Bugambilias', 'San Pedro', 'tulipan', '1412', '45344', 'Corporativos', 'no', 'Julio Martinez Hernandez', '15515', 'julio@outlook.com', 'Supervisor'),
(3, 'Soldaduras Santa Catarina', 'Las Lomas', 'Santa Catarina', 'Coco', '156', '68583', 'Servicios inmobiliarios y de alquiler de bienes muebles e intangibles', 'no', 'Francis', 'Ramirez Espinoza', 'ramri@gmail.com', 'Gerente'),
(4, 'adada', 'adad', 'Santa Catarina', 'adad', '1414', '1515', 'Servicios de alojamiento temporal y de preparación de alimentos y bebidas', 'si', 'asda', '15415', 'ada@gma.com', 'afaf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formadores`
--

DROP TABLE IF EXISTS `formadores`;
CREATE TABLE IF NOT EXISTS `formadores` (
  `idFormador` int NOT NULL AUTO_INCREMENT,
  `idEmpresa` int NOT NULL,
  `matricula` int NOT NULL,
  `nombres` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idFormador`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formadores`
--

INSERT INTO `formadores` (`idFormador`, `idEmpresa`, `matricula`, `nombres`, `apellidos`, `usuario`, `password`) VALUES
(1, 3, 19257, 'Saúl Mauricio', 'Rodríguez Vaquera', 'Formador', '12345'),
(7, 8, 85752, 'Lautaro', 'Gonzales', '85752', '0N4YEj'),
(8, 5, 161679, 'Penelope', 'Ramirez', '161679', 'oNwU0Y'),
(9, 4, 167784, 'Paolo', 'Galván', '167784', 'Jxs7Gn'),
(10, 6, 16693, 'Gonzalo', 'Fuentes', '16693', 'Fb60rn'),
(11, 7, 657588, 'Ramón', 'Pérez', '657588', 'BVA8Mv');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generaciones`
--

DROP TABLE IF EXISTS `generaciones`;
CREATE TABLE IF NOT EXISTS `generaciones` (
  `idGeneracion` int NOT NULL AUTO_INCREMENT,
  `anio` int NOT NULL,
  `cuatrimestre` int NOT NULL,
  PRIMARY KEY (`idGeneracion`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generaciones`
--

INSERT INTO `generaciones` (`idGeneracion`, `anio`, `cuatrimestre`) VALUES
(1, 2023, 1),
(2, 2023, 2),
(3, 2023, 3),
(4, 2024, 1),
(5, 2024, 2),
(6, 2024, 3),
(7, 2025, 1),
(8, 2025, 2),
(9, 2025, 3),
(10, 2026, 1),
(11, 2026, 2),
(12, 2026, 3),
(13, 2027, 1),
(14, 2027, 2),
(15, 2027, 3),
(16, 2028, 1),
(17, 2028, 2),
(18, 2028, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_docentes`
--

DROP TABLE IF EXISTS `historial_docentes`;
CREATE TABLE IF NOT EXISTS `historial_docentes` (
  `idHistorial` int NOT NULL AUTO_INCREMENT,
  `idAlumno` int DEFAULT NULL,
  `idDocente` int DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  PRIMARY KEY (`idHistorial`),
  KEY `idInstructor` (`idDocente`),
  KEY `idDocente` (`idDocente`),
  KEY `idAlumno_2` (`idAlumno`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_docentes`
--

INSERT INTO `historial_docentes` (`idHistorial`, `idAlumno`, `idDocente`, `fecha_asignacion`) VALUES
(1, 0, 1, '2023-06-28'),
(2, 0, 1, '2023-06-28'),
(3, NULL, 1, '2023-06-28'),
(4, 2, 4, '2023-06-28'),
(5, 2, 4, '2023-06-28'),
(6, 2, 4, '2023-06-28'),
(7, 3, 4, '2023-06-28'),
(8, 2, 4, '2023-06-28'),
(9, 2, 4, '2023-06-28'),
(10, 2, 4, '2023-06-28'),
(11, 3, 4, '2023-06-28'),
(12, 6, 4, '2023-06-28'),
(13, 1, 4, '2023-06-28'),
(14, 2, 4, '2023-06-30'),
(15, 2, 4, '2023-07-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_instructores`
--

DROP TABLE IF EXISTS `historial_instructores`;
CREATE TABLE IF NOT EXISTS `historial_instructores` (
  `idHistorial` int NOT NULL AUTO_INCREMENT,
  `idAlumno` int DEFAULT NULL,
  `idInstructor` int DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  PRIMARY KEY (`idHistorial`),
  KEY `idAlumno` (`idAlumno`),
  KEY `idInstructor` (`idInstructor`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_instructores`
--

INSERT INTO `historial_instructores` (`idHistorial`, `idAlumno`, `idInstructor`, `fecha_asignacion`) VALUES
(1, 6, 5, '2023-06-05'),
(2, 1, 1, '2023-06-06'),
(3, 1, 1, '2023-06-06'),
(4, 5, 0, '2023-06-06'),
(5, 1, 0, '2023-06-06'),
(6, 1, 1, '2023-06-06'),
(7, 7, 5, '2023-06-30'),
(8, 7, 0, '2023-06-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_tutores`
--

DROP TABLE IF EXISTS `historial_tutores`;
CREATE TABLE IF NOT EXISTS `historial_tutores` (
  `idHistorial` int NOT NULL AUTO_INCREMENT,
  `idAlumno` int DEFAULT NULL,
  `idTutor` int DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  PRIMARY KEY (`idHistorial`),
  KEY `idAlumno` (`idAlumno`),
  KEY `idTutor` (`idTutor`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_tutores`
--

INSERT INTO `historial_tutores` (`idHistorial`, `idAlumno`, `idTutor`, `fecha_asignacion`) VALUES
(1, 6, 1, '2023-06-05'),
(2, 6, 2, '2023-06-05'),
(3, 6, 3, '2023-06-05'),
(4, 5, 1, '2023-06-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructores`
--

DROP TABLE IF EXISTS `instructores`;
CREATE TABLE IF NOT EXISTS `instructores` (
  `idInstructor` int NOT NULL AUTO_INCREMENT,
  `idEmpresa` int NOT NULL,
  `matricula` int NOT NULL,
  `nombres` text COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` text COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idInstructor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instructores`
--

INSERT INTO `instructores` (`idInstructor`, `idEmpresa`, `matricula`, `nombres`, `apellidos`, `usuario`, `password`) VALUES
(1, 3, 19257, 'Irving Javier', 'Cruz Hernandez', 'Instructor', '12345'),
(4, 5, 293248, 'David Misael', 'Rey Velazquez', '293248', 'rX6D2k'),
(5, 4, 12556, 'Juancho', 'Monterrubio', '12556', 'JxTXbw'),
(6, 9, 12515, 'Andrés', 'Carmín', '12515', '75uFZk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

DROP TABLE IF EXISTS `puestos`;
CREATE TABLE IF NOT EXISTS `puestos` (
  `idPuesto` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idEmpresa` int DEFAULT NULL,
  `idCarrera` int DEFAULT NULL,
  PRIMARY KEY (`idPuesto`)
) ENGINE=MyISAM AUTO_INCREMENT=273 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`idPuesto`, `nombre`, `idEmpresa`, `idCarrera`) VALUES
(46, 'Desarrollador Multiplataforma', 3, 1),
(263, 'Desarrollador Móvil', 3, 1),
(270, 'Desarrollador junior', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos_asignaturas`
--

DROP TABLE IF EXISTS `puestos_asignaturas`;
CREATE TABLE IF NOT EXISTS `puestos_asignaturas` (
  `idPuestoAsignatura` int NOT NULL AUTO_INCREMENT,
  `idPuesto` int DEFAULT NULL,
  `idAsignatura` int DEFAULT NULL,
  `cumple` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idPuestoAsignatura`),
  KEY `idAsignatura` (`idAsignatura`),
  KEY `fk_puestos` (`idPuesto`)
) ENGINE=MyISAM AUTO_INCREMENT=184 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puestos_asignaturas`
--

INSERT INTO `puestos_asignaturas` (`idPuestoAsignatura`, `idPuesto`, `idAsignatura`, `cumple`) VALUES
(112, 46, 2, 0),
(111, 46, 1, 0),
(121, 46, 3, 0),
(123, 46, 4, 0),
(125, 46, 6, 0),
(127, 46, 8, 0),
(128, 46, 5, 0),
(130, 46, 7, 0),
(132, 263, 2, 1),
(134, 46, 9, 0),
(139, 46, 16, 0),
(140, 263, 16, 0),
(141, 263, 6, 0),
(142, 263, 3, 1),
(143, 263, 4, 1),
(144, 263, 7, 0),
(145, 263, 1, 1),
(146, 263, 8, 0),
(147, 263, 15, 0),
(148, 46, 15, 0),
(150, 263, 14, 0),
(151, 263, 12, 1),
(152, 46, 11, 0),
(153, 263, 10, 0),
(154, 46, 10, 1),
(177, 46, 14, 1),
(174, 263, 21, 1),
(160, 263, 5, 1),
(172, 263, 9, 1),
(162, 263, 17, 0),
(163, 263, 24, 0),
(164, 263, 23, 0),
(165, 263, 22, 1),
(166, 263, 20, 1),
(168, 263, 19, 0),
(171, 263, 11, 0),
(179, 46, 24, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

DROP TABLE IF EXISTS `reportes`;
CREATE TABLE IF NOT EXISTS `reportes` (
  `idReporte` int NOT NULL AUTO_INCREMENT,
  `idAlumno` int NOT NULL,
  `matricula` text COLLATE utf8mb4_general_ci NOT NULL,
  `nombres` text COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` text COLLATE utf8mb4_general_ci NOT NULL,
  `carrera` enum('Ingeniería en Desarrollo y Gestión de Software','Ingeniería en Mecatrónica','Ingeniería en Sistemas Productivos','Ingeniería en Mantenimiento Industrial','Licenciatura en Innovación de Negocios y Mercadotecnia','Licenciatura en Gestión Institucional Educativa y Curricular','TSU en Lengua Inglesa','TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma','TSU en Desarrollo de Negocios área Mercadotecnia','TSU en Mantenimiento área Industrial','TSU en Procesos Industriales área Manufactura','TSU en Mecatrónica área Automatización') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_entrega` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `f_aprobado_instructor` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `f_aprobado_tutor` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `f_aprobado_formador` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idTutor` int NOT NULL,
  `idInstructor` int NOT NULL,
  `idFormador` int NOT NULL,
  `empresa` text COLLATE utf8mb4_general_ci NOT NULL,
  `semana` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_Inicio` date NOT NULL,
  `f_Fin` date NOT NULL,
  `cuatrimestre` text COLLATE utf8mb4_general_ci NOT NULL,
  `resumen_L` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `resumen_M` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `resumen_Mi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `resumen_J` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `resumen_V` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `fecha_L` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img_L` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `img_M` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `img_Mi` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `img_J` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `img_V` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_M` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_Mi` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_J` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_V` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `retro_tutor` varchar(350) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `retro_instructor` varchar(350) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estatus_tutor` enum('aprobado','pendiente','no_aprobado','sin_revisar') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'sin_revisar',
  `estatus_instructor` enum('aprobado','pendiente','no_aprobado','sin_revisar') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'sin_revisar',
  PRIMARY KEY (`idReporte`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`idReporte`, `idAlumno`, `matricula`, `nombres`, `apellidos`, `carrera`, `f_entrega`, `f_aprobado_instructor`, `f_aprobado_tutor`, `f_aprobado_formador`, `idTutor`, `idInstructor`, `idFormador`, `empresa`, `semana`, `f_Inicio`, `f_Fin`, `cuatrimestre`, `resumen_L`, `resumen_M`, `resumen_Mi`, `resumen_J`, `resumen_V`, `fecha_L`, `img_L`, `img_M`, `img_Mi`, `img_J`, `img_V`, `fecha_M`, `fecha_Mi`, `fecha_J`, `fecha_V`, `retro_tutor`, `retro_instructor`, `estatus_tutor`, `estatus_instructor`) VALUES
(45, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'Ingeniería en Desarrollo y Gestión de Software', '20-07-2023', NULL, '02-08-2023', NULL, 1, 1, 1, 'Colegio Mexicano AC', '1', '2023-07-18', '2023-07-22', '5', '', '', '', '', '<p>adkakd</p>', '17-07-2023', '', '', '', '', 'imagenes/reportes/f23645c114704abf25b4cec0bb8f04e9.jpg', '18-07-2023', '19-07-2023', '20-07-2023', '22-07-2023', NULL, NULL, 'aprobado', 'sin_revisar'),
(46, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'Ingeniería en Desarrollo y Gestión de Software', '25-07-2023', '02-08-2023', '02-08-2023', '02-08-2023', 1, 1, 1, 'Colegio Mexicano AC', '2', '2023-07-24', '2023-07-28', '5', '<p>adad</p>', '', '', '', '', '24-07-2023', '', '', '', '', '', '25-07-2023', '26-07-2023', '27-07-2023', '28-07-2023', NULL, NULL, 'aprobado', 'aprobado'),
(47, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'Ingeniería en Desarrollo y Gestión de Software', '25-07-2023', NULL, NULL, NULL, 1, 1, 1, 'Colegio Mexicano AC', '3', '2023-07-24', '2023-07-28', '5', '<p>aa</p>', '', '', '', '', '24-07-2023', '', '', '', '', '', '25-07-2023', '26-07-2023', '27-07-2023', '28-07-2023', NULL, NULL, 'no_aprobado', 'no_aprobado'),
(48, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'Ingeniería en Desarrollo y Gestión de Software', '25-07-2023', NULL, NULL, NULL, 1, 1, 1, 'Colegio Mexicano AC', '3', '2023-07-24', '2023-07-28', '5', '<p>aa</p>', '', '', '', '<p>a</p>', '24-07-2023', '', '', '', '', '', '25-07-2023', '26-07-2023', '27-07-2023', '28-07-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(49, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', '25-07-2023', NULL, NULL, NULL, 1, 1, 1, 'Colegio Mexicano AC', '3', '2023-07-24', '2023-07-28', '5', '<p>aa</p>', '', '', '', '<p>a&ntilde;&ntilde;a&ntilde;fa&ntilde;f</p>', '24-07-2023', '', '', '', '', '', '25-07-2023', '26-07-2023', '27-07-2023', '28-07-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(50, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', '25-07-2023', NULL, NULL, NULL, 1, 1, 1, 'Colegio Mexicano AC', '3', '2023-07-24', '2023-07-28', '5', '<p>aa</p>', '', '', '', '<p>a&ntilde;&ntilde;a&ntilde;fa&ntilde;f</p>', '24-07-2023', '', '', '', '', '', '25-07-2023', '26-07-2023', '27-07-2023', '28-07-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(51, 1, '19156', 'Genesis Hamor', 'Carrillo Salas', 'TSU en Lengua Inglesa', '25-07-2023', NULL, NULL, NULL, 1, 1, 1, 'Colegio Mexicano AC', '3', '2023-07-24', '2023-07-28', '5', '<p>aa</p>', '', '', '', '<p>a&ntilde;&ntilde;a&ntilde;fa&ntilde;f</p>', '24-07-2023', '', '', '', '', '', '25-07-2023', '26-07-2023', '27-07-2023', '28-07-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(123, 4, '20308', 'Fernando Daniel', 'Gaytán Velazquez', 'TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma', '02-08-2023', NULL, NULL, NULL, 3, 1, 1, 'Colegio Mexicano AC', '1', '2023-07-31', '2023-08-04', '5', '<p>qd&ntilde;a&ntilde;da</p>', '', '', '', '', '31-07-2023', '', '', '', '', '', '01-08-2023', '02-08-2023', '03-08-2023', '04-08-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(124, 4, '20308', 'Fernando Daniel', 'Gaytán Velazquez', 'TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma', '02-08-2023', NULL, NULL, NULL, 3, 1, 1, 'Colegio Mexicano AC', '2', '2023-07-31', '2023-08-04', '5', '', '', '', '', '<p>ada</p>', '31-07-2023', '', '', '', '', '', '01-08-2023', '02-08-2023', '03-08-2023', '04-08-2023', NULL, NULL, 'sin_revisar', 'sin_revisar'),
(125, 4, '20308', 'Fernando Daniel', 'Gaytán Velazquez', 'TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma', '02-08-2023', NULL, NULL, NULL, 3, 1, 1, 'Colegio Mexicano AC', '2', '2023-07-31', '2023-08-04', '5', '', '', '', '', '<p>ada</p>', '31-07-2023', '', '', '', '', '', '01-08-2023', '02-08-2023', '03-08-2023', '04-08-2023', NULL, NULL, 'sin_revisar', 'sin_revisar');

--
-- Disparadores `reportes`
--
DROP TRIGGER IF EXISTS `tr_actualizar_fecha_aprobado_formador`;
DELIMITER $$
CREATE TRIGGER `tr_actualizar_fecha_aprobado_formador` BEFORE UPDATE ON `reportes` FOR EACH ROW BEGIN
    IF NEW.estatus_instructor = 'aprobado' AND NEW.estatus_tutor = 'aprobado' THEN
        SET NEW.f_aprobado_formador = DATE_FORMAT(NOW(), '%d-%m-%Y');
    ELSE
        SET NEW.f_aprobado_formador = NULL;
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_actualizar_fecha_aprobado_instructor`;
DELIMITER $$
CREATE TRIGGER `tr_actualizar_fecha_aprobado_instructor` BEFORE UPDATE ON `reportes` FOR EACH ROW BEGIN
    IF NEW.estatus_instructor = 'aprobado' THEN
        SET NEW.f_aprobado_instructor = DATE_FORMAT(NOW(), '%d-%m-%Y');
    ELSE
        SET NEW.f_aprobado_instructor = NULL;
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_actualizar_fecha_aprobado_tutor`;
DELIMITER $$
CREATE TRIGGER `tr_actualizar_fecha_aprobado_tutor` BEFORE UPDATE ON `reportes` FOR EACH ROW BEGIN
    IF NEW.estatus_tutor = 'aprobado' THEN
        SET NEW.f_aprobado_tutor = DATE_FORMAT(NOW(), '%d-%m-%Y');
    ELSE
        SET NEW.f_aprobado_tutor = NULL;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subdirectores`
--

DROP TABLE IF EXISTS `subdirectores`;
CREATE TABLE IF NOT EXISTS `subdirectores` (
  `idSubdirector` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `carrera` enum('Ingeniería en Desarrollo y Gestión de Software','Ingeniería en Mecatrónica','Ingeniería en Sistemas Productivos','Ingeniería en Mantenimiento Industrial','Licenciatura en Innovación de Negocios y Mercadotecnia','Licenciatura en Gestión Institucional Educativa y Curricular','TSU en Lengua Inglesa','TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma','TSU en Desarrollo de Negocios área Mercadotecnia','TSU en Mantenimiento área Industrial','TSU en Procesos Industriales área Manufactura','TSU en Mecatrónica área Automatización') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `matricula` int NOT NULL,
  `nombres` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idSubdirector`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subdirectores`
--

INSERT INTO `subdirectores` (`idSubdirector`, `tipo`, `carrera`, `matricula`, `nombres`, `apellidos`, `usuario`, `password`) VALUES
(3, 'Subdirectivo', 'Ingeniería en Desarrollo y Gestión de Software', 0, 'IDGS', '', 'IDGS', 'JapNPC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutores`
--

DROP TABLE IF EXISTS `tutores`;
CREATE TABLE IF NOT EXISTS `tutores` (
  `idTutor` int NOT NULL AUTO_INCREMENT,
  `matricula` int NOT NULL,
  `nombres` text COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` text COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idTutor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tutores`
--

INSERT INTO `tutores` (`idTutor`, `matricula`, `nombres`, `apellidos`, `usuario`, `password`) VALUES
(1, 151567, 'Martha Cecilia', 'Rodríguez Martínez', 'Tutor', '12345'),
(2, 15156, 'Ulises', 'Rodriguez', '15156', 'miWqL7'),
(3, 12515, 'Abimael', 'Gonzales', '12515', 'etYgBD');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_alumnos_empresas` FOREIGN KEY (`idEmpresa`) REFERENCES `empresas` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
