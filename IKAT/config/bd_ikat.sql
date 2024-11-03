-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2024 a las 06:15:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_ikat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambiente`
--

CREATE TABLE `ambiente` (
  `id_ambiente` int(11) NOT NULL,
  `nombre_ambiente` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ambiente`
--

INSERT INTO `ambiente` (`id_ambiente`, `nombre_ambiente`) VALUES
(1, 'Cocina'),
(2, 'Baño'),
(3, 'Exterior'),
(4, 'Comedor'),
(5, 'Dormitorio'),
(6, 'Living');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleta`
--

CREATE TABLE `boleta` (
  `id_boleta` int(100) NOT NULL,
  `id_compra` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`) VALUES
(1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_producto`
--

CREATE TABLE `carrito_producto` (
  `id_carrito` int(100) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `cantidad_producto` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito_producto`
--

INSERT INTO `carrito_producto` (`id_carrito`, `id_producto`, `cantidad_producto`) VALUES
(1, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(10) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`) VALUES
(5, 'Silla'),
(6, 'Mesa'),
(7, 'Sillon'),
(8, 'Cama'),
(9, 'Almacenamiento  y Organización');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `id_color` int(11) NOT NULL,
  `nombre_color` varchar(50) NOT NULL,
  `codigo_hex` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`id_color`, `nombre_color`, `codigo_hex`) VALUES
(1, 'Rojo', NULL),
(2, 'Azul', NULL),
(3, 'Negro', NULL),
(4, 'Blanco', NULL),
(5, 'Gris', NULL),
(6, 'Cafe', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(100) NOT NULL,
  `fecha_compra` date NOT NULL,
  `total_compra` int(11) NOT NULL,
  `puntos_ganados` int(11) NOT NULL,
  `tipo_estado` enum('Preparando pedido','En reparto','Entregado','Intento de entrega fallido','Devuelto a origen') NOT NULL,
  `direccion_pedido` varchar(255) NOT NULL,
  `id_metodo` int(10) DEFAULT NULL,
  `id_usuario` int(100) NOT NULL,
  `id_carrito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_stock`
--

CREATE TABLE `control_stock` (
  `id_control` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `motivo` enum('Ingreso','Salida') DEFAULT NULL,
  `explicacion` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `control_stock`
--

INSERT INTO `control_stock` (`id_control`, `id_producto`, `cantidad`, `motivo`, `explicacion`, `fecha`) VALUES
(1, 3, 1, 'Ingreso', 'a', '2024-11-01 19:15:27'),
(2, 3, 10, 'Salida', 'a', '2024-11-01 19:16:12'),
(3, 3, 5, 'Ingreso', 'a', '2024-11-01 19:16:41'),
(4, 3, 1, 'Ingreso', 'a', '2024-11-01 19:21:35'),
(5, 3, 1, 'Ingreso', 'a', '2024-11-01 19:27:09'),
(6, 3, 1, 'Ingreso', 'a', '2024-11-01 19:27:21'),
(7, 3, 14, 'Salida', 'a', '2024-11-01 19:28:09'),
(8, 3, 10, 'Ingreso', 'a', '2024-11-01 19:30:15'),
(9, 3, 12, 'Ingreso', 'qweqwe', '2024-11-02 19:59:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `id_envio` int(100) NOT NULL,
  `distancia` float NOT NULL,
  `coordenadas_origen` varchar(20) DEFAULT NULL,
  `coordenadas_destino` varchar(20) DEFAULT NULL,
  `tarifa_base` float DEFAULT NULL,
  `costo_envio` float DEFAULT NULL,
  `id_compra` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firmeza`
--

CREATE TABLE `firmeza` (
  `id_firmeza` int(11) NOT NULL,
  `nivel_firmeza` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `firmeza`
--

INSERT INTO `firmeza` (`id_firmeza`, `nivel_firmeza`) VALUES
(1, 'Suave'),
(2, 'Extra suave'),
(3, 'Firmeza media'),
(4, 'Firme');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma`
--

CREATE TABLE `forma` (
  `id_forma` int(11) NOT NULL,
  `nombre_forma` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `forma`
--

INSERT INTO `forma` (`id_forma`, `nombre_forma`) VALUES
(1, 'Cuadrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_deseos_producto`
--

CREATE TABLE `lista_deseos_producto` (
  `id_lista_deseos` int(100) NOT NULL,
  `id_producto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_de_deseos`
--

CREATE TABLE `lista_de_deseos` (
  `id_lista_deseos` int(100) NOT NULL,
  `id_usuario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id_material` int(11) NOT NULL,
  `nombre_material` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id_material`, `nombre_material`) VALUES
(1, 'Madera'),
(2, 'Metal'),
(3, 'Plástico'),
(4, 'Vidrio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id_metodo` int(10) NOT NULL,
  `nombre_metodo` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`id_metodo`, `nombre_metodo`, `activo`) VALUES
(5, 'Paypal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `n_asientos`
--

CREATE TABLE `n_asientos` (
  `id_n_asientos` int(11) NOT NULL,
  `cantidad_asientos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `n_asientos`
--

INSERT INTO `n_asientos` (`id_n_asientos`, `cantidad_asientos`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `n_cajones`
--

CREATE TABLE `n_cajones` (
  `id_n_cajones` int(11) NOT NULL,
  `cantidad_cajones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `n_cajones`
--

INSERT INTO `n_cajones` (`id_n_cajones`, `cantidad_cajones`) VALUES
(1, 2),
(2, 4),
(3, 6),
(4, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `n_plazas`
--

CREATE TABLE `n_plazas` (
  `id_n_plazas` int(11) NOT NULL,
  `tamaño_plaza` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `n_plazas`
--

INSERT INTO `n_plazas` (`id_n_plazas`, `tamaño_plaza`) VALUES
(1, '1'),
(2, '1,5'),
(3, '2'),
(4, 'King'),
(5, 'Queen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
  `id_oferta` int(10) NOT NULL,
  `porcentaje_descuento` float NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_producto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`id_oferta`, `porcentaje_descuento`, `activo`, `id_producto`) VALUES
(2, 30, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(10) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `stock_producto` int(11) NOT NULL,
  `descripcion_producto` text NOT NULL,
  `foto_producto` varchar(255) NOT NULL,
  `cantidad_vendida` int(11) NOT NULL,
  `top_venta` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_subcategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `precio_unitario`, `stock_producto`, `descripcion_producto`, `foto_producto`, `cantidad_vendida`, `top_venta`, `activo`, `id_subcategoria`) VALUES
(3, 'Cama gato', 25990, 10, 'Una linda camita para tu felino :3 miau', 'https://imagedelivery.net/4fYuQyy-r8_rpBpcY7lH_A/falabellaCL/127645737_01/w=1500,h=1500,fit=pad', 0, 0, 1, 5),
(5, 'Mesa roble', 30990, 0, 'Una mesa de roble barnizada', 'https://www.cic.cl/dw/image/v2/BDXB_PRD/on/demandware.static/-/Sites-masterCatalog_CIC/es_CL/dw742de45c/original/images/products/mesa-centro-nuble-caramelo-110x70x40-cm-01.jpg?sw=1500&sh=1500&sm=fit', 0, 0, 1, 3),
(6, 'Pluma Silla de Cuero y Madera', 19990, 0, 'Una silla de madera con sillones de cuero', 'https://www.cueroydiseno.cl/wp-content/uploads/2021/04/sillapluma-scaled.jpg', 0, 0, 1, 2),
(7, 'cama estructural con 2 cajones MALM', 369980, 0, 'Una elegante cama de color con dos cajones en la parte de abajo', 'https://www.ikea.com/cl/es/images/products/malm-cama-estructural-con-2-cajones-negro-loenset__1101552_pe866728_s5.jpg?f=s', 0, 0, 1, 4),
(8, 'Cajonera Alex', 79990, 0, 'Una cajonera muy elegante.', 'https://www.ikea.com/cl/es/images/products/alex-cajonera-negro__0977786_pe813770_s5.jpg?f=s', 0, 0, 1, 6),
(9, 'Silla de escritorio MARKUS', 119990, 0, 'Una elegante silla de color blanco ideal para tu escritorio de trabajo.', 'https://www.ikea.com/cl/es/images/products/markus-silla-escritorio-vissle-gris-claro__1101440_pe866425_s5.jpg?f=s', 0, 0, 1, 7),
(10, 'Clóset Rakkestad', 119990, 0, 'Sencillo y práctico. Un clóset que ofrece todas las funciones básicas. Y si te falta espacio de almacenaje, puedes añadir otro clóset de la serie RAKKESTAD.', 'https://www.ikea.com/cl/es/images/products/rakkestad-closet-con-2-puertas-negro__0780372_pe760493_s5.jpg?f=s', 0, 0, 1, 8),
(11, 'Buffet blanco VIHALS', 159990, 0, 'Los dos cajones te permiten organizar tus cosas fácilmente, y tienes más espacio en las repisas detrás de las puertas.', 'https://www.ikea.com/cl/es/images/products/vihals-buffet-blanco__1035578_pe838113_s5.jpg?f=s', 0, 0, 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_ambiente`
--

CREATE TABLE `producto_ambiente` (
  `id_producto` int(11) NOT NULL,
  `id_ambiente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_ambiente`
--

INSERT INTO `producto_ambiente` (`id_producto`, `id_ambiente`) VALUES
(5, 4),
(6, 4),
(7, 5),
(8, 5),
(9, 5),
(10, 5),
(11, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_color`
--

CREATE TABLE `producto_color` (
  `id_producto` int(11) NOT NULL,
  `id_color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_color`
--

INSERT INTO `producto_color` (`id_producto`, `id_color`) VALUES
(3, 4),
(5, 6),
(6, 6),
(7, 3),
(8, 3),
(9, 4),
(10, 3),
(11, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_firmeza`
--

CREATE TABLE `producto_firmeza` (
  `id_producto` int(11) NOT NULL,
  `id_firmeza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_forma`
--

CREATE TABLE `producto_forma` (
  `id_producto` int(11) NOT NULL,
  `id_forma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_forma`
--

INSERT INTO `producto_forma` (`id_producto`, `id_forma`) VALUES
(5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_material`
--

CREATE TABLE `producto_material` (
  `id_producto` int(11) NOT NULL,
  `id_material` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_material`
--

INSERT INTO `producto_material` (`id_producto`, `id_material`) VALUES
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 2),
(10, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_n_asientos`
--

CREATE TABLE `producto_n_asientos` (
  `id_producto` int(11) NOT NULL,
  `id_n_asientos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_n_asientos`
--

INSERT INTO `producto_n_asientos` (`id_producto`, `id_n_asientos`) VALUES
(5, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_n_cajones`
--

CREATE TABLE `producto_n_cajones` (
  `id_producto` int(11) NOT NULL,
  `id_n_cajones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_n_cajones`
--

INSERT INTO `producto_n_cajones` (`id_producto`, `id_n_cajones`) VALUES
(8, 2),
(10, 2),
(11, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_n_plazas`
--

CREATE TABLE `producto_n_plazas` (
  `id_producto` int(11) NOT NULL,
  `id_n_plazas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_n_plazas`
--

INSERT INTO `producto_n_plazas` (`id_producto`, `id_n_plazas`) VALUES
(7, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenia`
--

CREATE TABLE `resenia` (
  `id_resenia` int(100) NOT NULL,
  `calificacion` int(1) NOT NULL,
  `comentario` text DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_usuario` int(100) NOT NULL,
  `id_producto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id_subcategoria` int(11) NOT NULL,
  `nombre_subcategoria` varchar(30) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id_subcategoria`, `nombre_subcategoria`, `id_categoria`) VALUES
(1, 'Escritorio', 5),
(2, 'Silla', 5),
(3, 'Mesa', 6),
(4, 'Cama', 8),
(5, 'Cama gato', 8),
(6, 'Cajonera', 9),
(7, 'Silla de escritorio', 5),
(8, 'Clóset', 9),
(9, 'Buffet', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(100) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `apellido_usuario` varchar(50) NOT NULL,
  `run_usuario` varchar(9) NOT NULL,
  `correo_usuario` varchar(100) NOT NULL,
  `numero_usuario` varchar(12) NOT NULL,
  `contrasenia_usuario` varchar(255) NOT NULL,
  `direccion_usuario` varchar(100) DEFAULT NULL,
  `tipo_usuario` enum('Admin','Registrado','Superadmin') NOT NULL,
  `puntos_totales` bigint(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `ultima_sesion` date DEFAULT NULL,
  `id_carrito` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `run_usuario`, `correo_usuario`, `numero_usuario`, `contrasenia_usuario`, `direccion_usuario`, `tipo_usuario`, `puntos_totales`, `activo`, `ultima_sesion`, `id_carrito`) VALUES
(1, 'Javier', 'Pino', '208460730', 'jpinoh@ing.ucsc.cl', '+56932365067', '$2y$10$FleiHYb0jPoueiI064rr1O92e30.3Ss5imRAI1yxRsqm4wEW47Qle', NULL, 'Superadmin', 0, 1, '2024-11-02', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  ADD PRIMARY KEY (`id_ambiente`);

--
-- Indices de la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD PRIMARY KEY (`id_boleta`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`);

--
-- Indices de la tabla `carrito_producto`
--
ALTER TABLE `carrito_producto`
  ADD PRIMARY KEY (`id_carrito`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id_color`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_metodo` (`id_metodo`),
  ADD KEY `id_carrito` (`id_carrito`);

--
-- Indices de la tabla `control_stock`
--
ALTER TABLE `control_stock`
  ADD PRIMARY KEY (`id_control`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`id_envio`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `firmeza`
--
ALTER TABLE `firmeza`
  ADD PRIMARY KEY (`id_firmeza`);

--
-- Indices de la tabla `forma`
--
ALTER TABLE `forma`
  ADD PRIMARY KEY (`id_forma`);

--
-- Indices de la tabla `lista_deseos_producto`
--
ALTER TABLE `lista_deseos_producto`
  ADD PRIMARY KEY (`id_lista_deseos`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `lista_de_deseos`
--
ALTER TABLE `lista_de_deseos`
  ADD PRIMARY KEY (`id_lista_deseos`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`id_metodo`);

--
-- Indices de la tabla `n_asientos`
--
ALTER TABLE `n_asientos`
  ADD PRIMARY KEY (`id_n_asientos`);

--
-- Indices de la tabla `n_cajones`
--
ALTER TABLE `n_cajones`
  ADD PRIMARY KEY (`id_n_cajones`);

--
-- Indices de la tabla `n_plazas`
--
ALTER TABLE `n_plazas`
  ADD PRIMARY KEY (`id_n_plazas`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`id_oferta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_producto_subcategoria` (`id_subcategoria`);

--
-- Indices de la tabla `producto_ambiente`
--
ALTER TABLE `producto_ambiente`
  ADD PRIMARY KEY (`id_producto`,`id_ambiente`),
  ADD KEY `id_ambiente` (`id_ambiente`);

--
-- Indices de la tabla `producto_color`
--
ALTER TABLE `producto_color`
  ADD PRIMARY KEY (`id_producto`,`id_color`),
  ADD KEY `id_color` (`id_color`);

--
-- Indices de la tabla `producto_firmeza`
--
ALTER TABLE `producto_firmeza`
  ADD PRIMARY KEY (`id_producto`,`id_firmeza`),
  ADD KEY `id_firmeza` (`id_firmeza`);

--
-- Indices de la tabla `producto_forma`
--
ALTER TABLE `producto_forma`
  ADD PRIMARY KEY (`id_producto`,`id_forma`),
  ADD KEY `id_forma` (`id_forma`);

--
-- Indices de la tabla `producto_material`
--
ALTER TABLE `producto_material`
  ADD PRIMARY KEY (`id_producto`,`id_material`),
  ADD KEY `id_material` (`id_material`);

--
-- Indices de la tabla `producto_n_asientos`
--
ALTER TABLE `producto_n_asientos`
  ADD PRIMARY KEY (`id_producto`,`id_n_asientos`),
  ADD KEY `id_n_asientos` (`id_n_asientos`);

--
-- Indices de la tabla `producto_n_cajones`
--
ALTER TABLE `producto_n_cajones`
  ADD PRIMARY KEY (`id_producto`,`id_n_cajones`),
  ADD KEY `id_n_cajones` (`id_n_cajones`);

--
-- Indices de la tabla `producto_n_plazas`
--
ALTER TABLE `producto_n_plazas`
  ADD PRIMARY KEY (`id_producto`,`id_n_plazas`),
  ADD KEY `id_n_plazas` (`id_n_plazas`);

--
-- Indices de la tabla `resenia`
--
ALTER TABLE `resenia`
  ADD PRIMARY KEY (`id_resenia`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuario_carrito` (`id_carrito`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  MODIFY `id_ambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `boleta`
--
ALTER TABLE `boleta`
  MODIFY `id_boleta` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_stock`
--
ALTER TABLE `control_stock`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `id_envio` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `firmeza`
--
ALTER TABLE `firmeza`
  MODIFY `id_firmeza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `forma`
--
ALTER TABLE `forma`
  MODIFY `id_forma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lista_de_deseos`
--
ALTER TABLE `lista_de_deseos`
  MODIFY `id_lista_deseos` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id_metodo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `n_asientos`
--
ALTER TABLE `n_asientos`
  MODIFY `id_n_asientos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `n_cajones`
--
ALTER TABLE `n_cajones`
  MODIFY `id_n_cajones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `n_plazas`
--
ALTER TABLE `n_plazas`
  MODIFY `id_n_plazas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id_oferta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `resenia`
--
ALTER TABLE `resenia`
  MODIFY `id_resenia` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD CONSTRAINT `boleta_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`);

--
-- Filtros para la tabla `carrito_producto`
--
ALTER TABLE `carrito_producto`
  ADD CONSTRAINT `carrito_producto_ibfk_1` FOREIGN KEY (`id_carrito`) REFERENCES `carrito` (`id_carrito`),
  ADD CONSTRAINT `carrito_producto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_metodo`) REFERENCES `metodo_pago` (`id_metodo`),
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`id_carrito`) REFERENCES `carrito` (`id_carrito`);

--
-- Filtros para la tabla `control_stock`
--
ALTER TABLE `control_stock`
  ADD CONSTRAINT `control_stock_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `envio_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`);

--
-- Filtros para la tabla `lista_deseos_producto`
--
ALTER TABLE `lista_deseos_producto`
  ADD CONSTRAINT `lista_deseos_producto_ibfk_1` FOREIGN KEY (`id_lista_deseos`) REFERENCES `lista_de_deseos` (`id_lista_deseos`),
  ADD CONSTRAINT `lista_deseos_producto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `lista_de_deseos`
--
ALTER TABLE `lista_de_deseos`
  ADD CONSTRAINT `lista_de_deseos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `oferta_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_subcategoria` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategoria` (`id_subcategoria`) ON DELETE SET NULL;

--
-- Filtros para la tabla `producto_ambiente`
--
ALTER TABLE `producto_ambiente`
  ADD CONSTRAINT `producto_ambiente_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_ambiente_ibfk_2` FOREIGN KEY (`id_ambiente`) REFERENCES `ambiente` (`id_ambiente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto_color`
--
ALTER TABLE `producto_color`
  ADD CONSTRAINT `producto_color_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_color_ibfk_2` FOREIGN KEY (`id_color`) REFERENCES `color` (`id_color`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto_firmeza`
--
ALTER TABLE `producto_firmeza`
  ADD CONSTRAINT `producto_firmeza_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_firmeza_ibfk_2` FOREIGN KEY (`id_firmeza`) REFERENCES `firmeza` (`id_firmeza`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto_forma`
--
ALTER TABLE `producto_forma`
  ADD CONSTRAINT `producto_forma_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_forma_ibfk_2` FOREIGN KEY (`id_forma`) REFERENCES `forma` (`id_forma`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto_material`
--
ALTER TABLE `producto_material`
  ADD CONSTRAINT `producto_material_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_material_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto_n_asientos`
--
ALTER TABLE `producto_n_asientos`
  ADD CONSTRAINT `producto_n_asientos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_n_asientos_ibfk_2` FOREIGN KEY (`id_n_asientos`) REFERENCES `n_asientos` (`id_n_asientos`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto_n_cajones`
--
ALTER TABLE `producto_n_cajones`
  ADD CONSTRAINT `producto_n_cajones_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_n_cajones_ibfk_2` FOREIGN KEY (`id_n_cajones`) REFERENCES `n_cajones` (`id_n_cajones`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto_n_plazas`
--
ALTER TABLE `producto_n_plazas`
  ADD CONSTRAINT `producto_n_plazas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_n_plazas_ibfk_2` FOREIGN KEY (`id_n_plazas`) REFERENCES `n_plazas` (`id_n_plazas`) ON DELETE CASCADE;

--
-- Filtros para la tabla `resenia`
--
ALTER TABLE `resenia`
  ADD CONSTRAINT `resenia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `resenia_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_carrito` FOREIGN KEY (`id_carrito`) REFERENCES `carrito` (`id_carrito`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
