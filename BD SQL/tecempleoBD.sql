-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2023 a las 15:50:09
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecempleo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aceptacion`
--

CREATE TABLE `aceptacion` (
  `Id_Contrato` int(11) NOT NULL,
  `Empresa_idEmpresa` int(11) NOT NULL,
  `Evaluacion_Perfil_idPerfil` int(11) NOT NULL,
  `Evaluacion_Perfil_Registro_Documento` int(11) NOT NULL,
  `Evaluacion_idEvaluacion` int(11) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Final` date NOT NULL,
  `Salario` float(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `aceptacion`
--

INSERT INTO `aceptacion` (`Id_Contrato`, `Empresa_idEmpresa`, `Evaluacion_Perfil_idPerfil`, `Evaluacion_Perfil_Registro_Documento`, `Evaluacion_idEvaluacion`, `Fecha_Inicio`, `Fecha_Final`, `Salario`) VALUES
(365478, 987654, 14785236, 103754, 8564752, '2023-08-29', '2024-08-31', 1400.000),
(548796, 456987, 654321, 107512563, 851472, '2023-08-17', '2024-08-17', 2000.000),
(896547, 123654, 132564, 103345687, 965147, '2023-08-31', '2024-08-31', 2000.000),
(2563415, 745698, 856321, 6985637, 645231, '2023-08-25', '2024-08-25', 2000.000),
(7896521, 852341, 5896321, 4252136, 156324, '2023-08-19', '2025-08-31', 1500.000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `Descripcion` text NOT NULL,
  `Nombre_Cat` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Descripcion`, `Nombre_Cat`) VALUES
(1245, 'Desarrollador de software especializado en redes sociales', 'Desarrollador'),
(1268, 'Se necesita psicologo para trabajar en lo laboral', 'Psicologo'),
(1348, 'Busco gerente en asesorar ', 'Gerente'),
(1547, 'Bodeguero con gran experiencia en el mercado de repartir productos', 'Bodeguero'),
(2064, 'Busco secretaria/o con experiencia en archivo', 'Secretaria'),
(3025, 'Asesor comercial en llamadas que trate bien a la gente', 'Asesor'),
(3026, 'Se busca Auxiliar ', 'Axuliar'),
(3027, 'Bodegero se busca', 'Bodegero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `Ciudad_emp` varchar(20) NOT NULL,
  `Direccion_emp` varchar(20) NOT NULL,
  `Email_emp` varchar(30) NOT NULL,
  `Telefono_emp` int(11) NOT NULL,
  `Nom_emp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `Ciudad_emp`, `Direccion_emp`, `Email_emp`, `Telefono_emp`, `Nom_emp`) VALUES
(456564, 'Bogota', 'Cl-22 norte', 'sasacore@gmail.com', 464664656, 'Core'),
(456987, 'Cali', 'Cl -52 A sur #4', 'compensar@gmail.com', 45632185, 'Compensar'),
(745698, 'Pereira', 'Cl -100 # sur', 'TECNO@gmail.com', 8569321, 'Tecno'),
(852341, 'Barranquilla', 'Dg-82 # D6', 'Bancolombia@gmail.com', 54200000, 'Bancolombia'),
(987654, 'Cartagena', 'Cl-92 4-8', 'Colpensiones@gmail.com', 78965421, 'Colpensiones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios`
--

CREATE TABLE `estudios` (
  `idEstudios` int(11) NOT NULL,
  `Estudios_universitarios` varchar(20) DEFAULT NULL,
  `Estudios_Primaria` varchar(20) NOT NULL,
  `Estudios_Segundaria` varchar(20) NOT NULL,
  `Otros_Estudios` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudios`
--

INSERT INTO `estudios` (`idEstudios`, `Estudios_universitarios`, `Estudios_Primaria`, `Estudios_Segundaria`, `Otros_Estudios`) VALUES
(1054, 'Ninguno', '5° bachillerato', '11° Bachillerato', 'Ninguno'),
(2095, 'psicologia', '5° primaria', '11° bachillerato', 'Universitario'),
(4758, '1 \"Diseñador\"', '5° primaria', '11° Bachillerato', 'Ninguno'),
(5236, '1 \"Ingeniero\"', '5° primaria', '11° Bachillerato', 'Ninguno'),
(9654, 'ninguno', '5° primaria', '11° bachillerato', 'Sena'),
(9655, 'La militar', 'completa', 'si', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `idEvaluacion` int(11) NOT NULL,
  `Perfil_Registro_Documento` int(11) NOT NULL,
  `Perfil_idPerfil` int(11) NOT NULL,
  `Entrevista` text NOT NULL,
  `Puntaje_PSI` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`idEvaluacion`, `Perfil_Registro_Documento`, `Perfil_idPerfil`, `Entrevista`, `Puntaje_PSI`) VALUES
(156324, 4252136, 14785236, 'buena HdV', '4/5'),
(645231, 6985637, 5896321, 'Buena presentacion', '3/5'),
(851472, 107512563, 654321, 'Buena capacidad', '5/5'),
(965147, 103345687, 856321, 'Buen puntaje', '5/5'),
(8564752, 103754, 132564, 'el usuario tuvo buena presentacion personal, buen vocabulario y buena experiencia laboral', '3/5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia_laboral`
--

CREATE TABLE `experiencia_laboral` (
  `empresa` int(11) NOT NULL,
  `Cargo` varchar(20) DEFAULT NULL,
  `Jefe` varchar(20) DEFAULT NULL,
  `Telefono` int(11) DEFAULT NULL,
  `Periodo_Lab` varchar(20) DEFAULT NULL,
  `Nombre_empres` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `experiencia_laboral`
--

INSERT INTO `experiencia_laboral` (`empresa`, `Cargo`, `Jefe`, `Telefono`, `Periodo_Lab`, `Nombre_empres`) VALUES
(1, 'diseñador', 'Carlos estepa', 7094331, 'de 2 a 3 años', 'Alkosto'),
(2, 'Especialista redes', 'Jesus Castro', 6087901, 'de 4 a 6 años', 'Compensar'),
(3, 'Desarrollador de sof', 'Fabian Villalba', 6790187, 'de 2 a 4 años', 'Colpensiones'),
(4, 'Psicologa', 'Luisa cardenas', 4698734, 'de 1 a 2 años', 'Colombina'),
(5, 'Secretaria', 'Camila Rendon', 6657914, 'de 5 a 10 años', 'Tecno'),
(6, 'Residente ', 'Harold ospina', 7697145, '1 año', 'Bancolombia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_pos`
--

CREATE TABLE `informacion_pos` (
  `idHdV` int(11) NOT NULL,
  `Experiencia_laboral_Nombre_empresa` int(11) NOT NULL,
  `Estudios_idEstudios` int(11) NOT NULL,
  `Referencia_idReferencia` int(11) NOT NULL,
  `Perfil_Registro_Documento` int(11) NOT NULL,
  `Perfil_idPerfil` int(11) NOT NULL,
  `Anexo_HdV` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `informacion_pos`
--

INSERT INTO `informacion_pos` (`idHdV`, `Experiencia_laboral_Nombre_empresa`, `Estudios_idEstudios`, `Referencia_idReferencia`, `Perfil_Registro_Documento`, `Perfil_idPerfil`, `Anexo_HdV`) VALUES
(1010, 0, 5236, 1048756120, 4252136, 14785236, 'Subio Archivo'),
(3214, 0, 4758, 102257814, 6985637, 5896321, 'Subio Archivo'),
(5464, 0, 9654, 1140965055, 1037524, 856321, 'Subio Archivo'),
(7070, 0, 2095, 1160331870, 107512563, 654321, 'Subio Archivo'),
(8080, 0, 1054, 1478302971, 103345687, 132564, 'Subio Archivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idPerfil` int(11) NOT NULL,
  `Registro_Documento` int(11) NOT NULL,
  `Profesion` varchar(20) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Fecha_Nac` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulaciones`
--

CREATE TABLE `postulaciones` (
  `idPostulaciones` int(11) NOT NULL,
  `Vacantes_Empresa_idEmpresa` int(11) NOT NULL,
  `Vacantes_Categoria_idCategoria` int(11) NOT NULL,
  `Vacantes_idVacantes` int(11) NOT NULL,
  `Perfil_Registro_Documento` int(11) NOT NULL,
  `Perfil_idPerfil` int(11) NOT NULL,
  `Fecha_Postulados` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `postulaciones`
--

INSERT INTO `postulaciones` (`idPostulaciones`, `Vacantes_Empresa_idEmpresa`, `Vacantes_Categoria_idCategoria`, `Vacantes_idVacantes`, `Perfil_Registro_Documento`, `Perfil_idPerfil`, `Fecha_Postulados`) VALUES
(21, 456987, 1268, 3261, 107512563, 654321, '2023-08-21'),
(36, 123654, 1245, 2587, 1003345687, 132564, '2023-09-04'),
(36, 987654, 2064, 4692, 1037524, 14785236, '2023-08-23'),
(102, 745698, 1348, 4125, 6985637, 856321, '2023-08-28'),
(708, 852341, 1547, 4563, 4452136, 5896321, '2023-08-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencia`
--

CREATE TABLE `referencia` (
  `idReferencia` int(11) NOT NULL,
  `Nombre_ref` varchar(20) NOT NULL,
  `Numero_ref` int(11) NOT NULL,
  `Cargo_ref` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `referencia`
--

INSERT INTO `referencia` (`idReferencia`, `Nombre_ref`, `Numero_ref`, `Cargo_ref`) VALUES
(102257814, 'Luis', 4, 'Bodeguero'),
(1048756120, 'Danna', 5, 'Diseñador'),
(1140965055, 'Juanito', 1, 'Vendedor'),
(1160331870, 'Pablo', 3, 'ayudante en ferreter'),
(1478302971, 'Carla', 2, 'Auxiliar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `Email_reg` varchar(30) NOT NULL,
  `Contrasena` varchar(250) NOT NULL,
  `Nombre_Reg` varchar(20) NOT NULL,
  `Apellido_Reg` varchar(10) NOT NULL,
  `Telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `Email_reg`, `Contrasena`, `Nombre_Reg`, `Apellido_Reg`, `Telefono`) VALUES
(1, 'jesus@gmail.com', '$2y$10$DTffVbcLGexXPz.rsPIsz.jlGLzEiLzFlPIgXTtdDSqje/P/YfFn2', 'jesus', 'catro', 774158336),
(2, 'fadee@gmail.com', '$2y$10$OIs8EWY76xpZeWBgz7YJCO.h1lp8R9MA./tDoTM5Nzhy3ktNZ76nW', 'Federico', 'Valverde', 65546564),
(3, 'andresg@gmail.com', '$2y$10$P/hvpY/Iv9yFMz0fQLj08OW7OEpuMix2Pm6/NKfZkoydvTsZRg//O', 'Andrres', 'Guzman', 12356465),
(4, 'jesusmoyano111@gmail.com', '$2y$10$pnB2cAVKyGkEUCjAWV1haeYDpLPNnDBENn2pCC7njqMDvzdi85v/y', 'ddsadsa', 'dasadsa', 123656);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacantes`
--

CREATE TABLE `vacantes` (
  `idVacantes` int(11) NOT NULL,
  `Categoria_idCategoria` int(11) NOT NULL,
  `Empresa_idEmpresa` int(11) NOT NULL,
  `Descripcion_vac` text NOT NULL,
  `Fecha_Publicacion` date NOT NULL,
  `Fecha_Cierre` date NOT NULL,
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vacantes`
--

INSERT INTO `vacantes` (`idVacantes`, `Categoria_idCategoria`, `Empresa_idEmpresa`, `Descripcion_vac`, `Fecha_Publicacion`, `Fecha_Cierre`, `Estado`) VALUES
(4692, 3025, 745698, 'Asesor comercial en llamadas', '2023-08-07', '2023-08-29', 'soltero'),
(7865, 1547, 852341, 'Busco gran bodeguero con experiencia', '2023-08-05', '2023-08-25', 'casado'),
(7866, 0, 0, 'ajahglas', '2023-09-20', '2023-09-28', 'Activo'),
(7867, 1, 2, 'Descripción de la vacante', '2023-10-22', '2023-11-22', 'Activa'),
(7868, 2064, 9654123, 'ssssssssssssssssss', '2023-10-23', '2023-11-23', 'Inactiva'),
(7869, 1, 2, 'Descripción de la vacante', '2023-10-22', '2023-11-22', 'Activa'),
(7870, 0, 0, 'Bajgasgsa', '2023-10-01', '2023-11-11', 'activo'),
(7871, 1268, 987654, 'Cargo de psicologooo', '2023-07-31', '2023-08-30', 'nose');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aceptacion`
--
ALTER TABLE `aceptacion`
  ADD PRIMARY KEY (`Id_Contrato`,`Empresa_idEmpresa`,`Evaluacion_Perfil_idPerfil`,`Evaluacion_Perfil_Registro_Documento`,`Evaluacion_idEvaluacion`),
  ADD KEY `Aceptacion_FKIndex1` (`Empresa_idEmpresa`),
  ADD KEY `Aceptacion_FKIndex2` (`Evaluacion_idEvaluacion`,`Evaluacion_Perfil_Registro_Documento`,`Evaluacion_Perfil_idPerfil`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`idEstudios`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`idEvaluacion`,`Perfil_Registro_Documento`,`Perfil_idPerfil`),
  ADD KEY `Evaluacion_FKIndex1` (`Perfil_idPerfil`,`Perfil_Registro_Documento`);

--
-- Indices de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  ADD PRIMARY KEY (`empresa`);

--
-- Indices de la tabla `informacion_pos`
--
ALTER TABLE `informacion_pos`
  ADD PRIMARY KEY (`idHdV`,`Experiencia_laboral_Nombre_empresa`,`Estudios_idEstudios`,`Referencia_idReferencia`,`Perfil_Registro_Documento`,`Perfil_idPerfil`),
  ADD KEY `Informacion_pos_FKIndex1` (`Experiencia_laboral_Nombre_empresa`),
  ADD KEY `Informacion_pos_FKIndex2` (`Estudios_idEstudios`),
  ADD KEY `Informacion_pos_FKIndex3` (`Referencia_idReferencia`),
  ADD KEY `Informacion_pos_FKIndex4` (`Perfil_idPerfil`,`Perfil_Registro_Documento`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idPerfil`,`Registro_Documento`),
  ADD KEY `Perfil_FKIndex1` (`Registro_Documento`);

--
-- Indices de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  ADD PRIMARY KEY (`idPostulaciones`,`Vacantes_Empresa_idEmpresa`,`Vacantes_Categoria_idCategoria`,`Vacantes_idVacantes`,`Perfil_Registro_Documento`,`Perfil_idPerfil`),
  ADD KEY `Postulaciones_FKIndex1` (`Vacantes_idVacantes`,`Vacantes_Categoria_idCategoria`,`Vacantes_Empresa_idEmpresa`),
  ADD KEY `Postulaciones_FKIndex2` (`Perfil_idPerfil`,`Perfil_Registro_Documento`);

--
-- Indices de la tabla `referencia`
--
ALTER TABLE `referencia`
  ADD PRIMARY KEY (`idReferencia`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  ADD PRIMARY KEY (`idVacantes`,`Categoria_idCategoria`,`Empresa_idEmpresa`),
  ADD KEY `Vacantes_FKIndex1` (`Categoria_idCategoria`),
  ADD KEY `Vacantes_FKIndex2` (`Empresa_idEmpresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aceptacion`
--
ALTER TABLE `aceptacion`
  MODIFY `Id_Contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7896528;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3028;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9654125;

--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `idEstudios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9656;

--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `idEvaluacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8564753;

--
-- AUTO_INCREMENT de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  MODIFY `empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14785237;

--
-- AUTO_INCREMENT de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  MODIFY `idPostulaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=709;

--
-- AUTO_INCREMENT de la tabla `referencia`
--
ALTER TABLE `referencia`
  MODIFY `idReferencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1478302972;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  MODIFY `idVacantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7872;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
