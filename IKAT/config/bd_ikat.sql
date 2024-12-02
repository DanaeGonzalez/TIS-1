-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2024 a las 19:06:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_usuario` int(100) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_usuario`, `id_producto`, `cantidad`) VALUES
(1, 3, 1),
(1, 6, 1),
(1, 9, 2),
(1, 16, 1);

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
(6, 'Cafe', NULL),
(7, 'Multicolor', NULL),
(8, 'Amarillo', NULL),
(9, 'Beige', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(100) NOT NULL,
  `fecha_compra` date NOT NULL,
  `total_compra` int(11) NOT NULL,
  `puntos_ganados` int(11) NOT NULL,
  `direccion_pedido` varchar(255) NOT NULL,
  `id_metodo` int(10) DEFAULT NULL,
  `id_usuario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `fecha_compra`, `total_compra`, `puntos_ganados`, `direccion_pedido`, `id_metodo`, `id_usuario`) VALUES
(1, '2024-11-04', 50980, 5098, 'Timor del este', 5, 1),
(2, '2024-11-04', 50980, 5098, 'Timor del este', 5, 1),
(3, '2024-11-04', 0, 0, 'Timor del este', 6, 1),
(4, '2024-11-23', 25990, 1300, 'Angol 921, Concepción', 6, 1),
(5, '2024-11-27', 2358437, 117922, 'a', 7, 2),
(6, '2024-11-27', 2390046, 119502, 'pekin', 7, 2),
(7, '2024-11-28', 157413, 7871, 'Angol 931, Concepción', 5, 1),
(8, '2024-11-30', 1014177, 50709, 'Angol 931, Concepción', 5, 1),
(9, '2024-11-30', 1014177, 50709, 'Angol 931, Concepción', 5, 1),
(10, '2024-11-30', 811882, 40594, 'Angol 931, Concepción', 5, 1),
(11, '2024-12-02', 52264, 2613, 'concepcion', 5, 2),
(12, '2024-12-02', 223371, 11169, 'concepcion', 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_producto`
--

CREATE TABLE `compra_producto` (
  `id_compra` int(100) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo_estado` enum('Preparando pedido','En reparto','Entregado','Intento de entrega fallido','Devuelto a origen') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra_producto`
--

INSERT INTO `compra_producto` (`id_compra`, `id_producto`, `cantidad`, `tipo_estado`) VALUES
(4, 3, 1, 'Entregado'),
(5, 3, 1, 'Devuelto a origen'),
(5, 6, 1, 'Preparando pedido'),
(7, 17, 1, 'Preparando pedido'),
(9, 6, 1, 'Preparando pedido'),
(9, 17, 1, 'Preparando pedido'),
(9, 19, 2, 'Preparando pedido'),
(10, 7, 1, 'Preparando pedido'),
(10, 11, 1, 'Preparando pedido'),
(10, 13, 1, 'Preparando pedido'),
(10, 16, 1, 'Preparando pedido'),
(11, 3, 1, 'Preparando pedido'),
(11, 5, 1, 'Preparando pedido'),
(12, 9, 1, 'Preparando pedido'),
(12, 29, 1, 'Preparando pedido');

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
(9, 3, 12, 'Ingreso', 'qweqwe', '2024-11-02 19:59:05'),
(10, 9, 4, 'Ingreso', 'Llegan productos a nuestra bodega n° de envio 1', '2024-11-04 05:57:57'),
(11, 5, 15, 'Ingreso', 'Llegan productos a nuestra bodega n° de envio 1', '2024-11-04 05:58:11'),
(12, 6, 31, 'Ingreso', 'Llegan productos a nuestra bodega n° de envio 1', '2024-11-04 05:58:23'),
(13, 8, 12, 'Ingreso', 'Llegan productos a nuestra bodega n° de envio 1', '2024-11-04 05:58:36'),
(14, 17, 5, 'Ingreso', 'Llego nueva mercadería de sillones', '2024-11-28 20:15:41'),
(15, 19, 30, 'Ingreso', 'a', '2024-11-30 16:50:37'),
(16, 20, 15, 'Ingreso', 'Compra de stock', '2024-12-02 14:57:47'),
(17, 21, 10, 'Ingreso', 'Compra stock', '2024-12-02 14:58:11'),
(18, 22, 12, 'Ingreso', 'Compra stock', '2024-12-02 14:58:51'),
(19, 24, 14, 'Ingreso', 'Compra stock', '2024-12-02 14:59:02'),
(20, 25, 23, 'Ingreso', 'Compra stock', '2024-12-02 14:59:09'),
(21, 26, 16, 'Ingreso', 'Compra stock', '2024-12-02 14:59:17'),
(22, 27, 12, 'Ingreso', 'Compra Stock', '2024-12-02 15:10:15'),
(23, 28, 13, 'Ingreso', 'Compra Stock', '2024-12-02 15:10:22'),
(24, 29, 11, 'Ingreso', 'Compra Stock', '2024-12-02 15:10:28'),
(25, 30, 12, 'Ingreso', 'Compra Stock', '2024-12-02 15:10:34');

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
(1, 'Cuadrada'),
(2, 'Forma de L'),
(3, 'Rectangular'),
(4, 'Ovalado'),
(5, 'Circular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_deseos_producto`
--

CREATE TABLE `lista_deseos_producto` (
  `id_lista_deseos` int(100) NOT NULL,
  `id_producto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista_deseos_producto`
--

INSERT INTO `lista_deseos_producto` (`id_lista_deseos`, `id_producto`) VALUES
(1, 3),
(1, 6),
(1, 8),
(1, 16),
(1, 17),
(2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_de_deseos`
--

CREATE TABLE `lista_de_deseos` (
  `id_lista_deseos` int(100) NOT NULL,
  `id_usuario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista_de_deseos`
--

INSERT INTO `lista_de_deseos` (`id_lista_deseos`, `id_usuario`) VALUES
(1, 1),
(2, 2),
(4, 4),
(3, 5);

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
(4, 'Vidrio'),
(5, 'Poliuretano'),
(6, 'Plástico de polipropileno'),
(7, 'Textil'),
(8, 'Acero'),
(9, 'Melamina');

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
(5, 'Paypal', 1),
(6, 'Crédito', 1),
(7, 'Debito', 1);

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
(2, 30, 1, 3),
(3, 10, 1, 5),
(4, 30, 1, 29),
(5, 35, 1, 21),
(6, 13, 1, 10),
(7, 25, 1, 20),
(8, 10, 1, 25);

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
(3, 'Cama gato', 25990, 98, 'Una linda camita para tu felino :3 miau', 'https://imagedelivery.net/4fYuQyy-r8_rpBpcY7lH_A/falabellaCL/127645737_01/w=1500,h=1500,fit=pad', 2, 1, 1, 5),
(5, 'Mesa roble', 30990, 14, 'Una mesa de roble barnizada', 'https://www.cic.cl/dw/image/v2/BDXB_PRD/on/demandware.static/-/Sites-masterCatalog_CIC/es_CL/dw742de45c/original/images/products/mesa-centro-nuble-caramelo-110x70x40-cm-01.jpg?sw=1500&sh=1500&sm=fit', 1, 0, 1, 3),
(6, 'Pluma Silla de Cuero y Madera', 19990, 29, 'Una silla de madera con sillones de cuero', 'https://www.cueroydiseno.cl/wp-content/uploads/2021/04/sillapluma-scaled.jpg', 2, 0, 1, 2),
(7, 'Cama estructural MALM', 369980, 49, 'Una elegante cama de color con dos cajones en la parte de abajo', 'https://www.ikea.com/cl/es/images/products/malm-cama-estructural-con-2-cajones-negro-loenset__1101552_pe866728_s5.jpg?f=s', 1, 0, 1, 4),
(8, 'Cajonera Alex', 79990, 12, 'Una cajonera muy elegante.', 'https://www.ikea.com/cl/es/images/products/alex-cajonera-negro__0977786_pe813770_s5.jpg?f=s', 0, 0, 1, 6),
(9, 'Silla de escritorio MARKUS', 119990, 45, 'Una elegante silla de color blanco ideal para tu escritorio de trabajo.', 'https://www.ikea.com/cl/es/images/products/markus-silla-escritorio-vissle-gris-claro__1101440_pe866425_s5.jpg?f=s', 1, 0, 1, 7),
(10, 'Clóset Rakkestad', 119990, 50, 'Sencillo y práctico. Un clóset que ofrece todas las funciones básicas. Y si te falta espacio de almacenaje, puedes añadir otro clóset de la serie RAKKESTAD.', 'https://www.ikea.com/cl/es/images/products/rakkestad-closet-con-2-puertas-negro__0780372_pe760493_s5.jpg?f=s', 0, 0, 1, 8),
(11, 'Buffet blanco VIHALS', 159990, 49, 'Los dos cajones te permiten organizar tus cosas fácilmente, y tienes más espacio en las repisas detrás de las puertas.', 'https://www.ikea.com/cl/es/images/products/vihals-buffet-blanco__1035578_pe838113_s5.jpg?f=s', 1, 0, 1, 9),
(12, 'ESCRITORIO PERAL', 69990, 50, 'Un escritorio para tu computador perfecto para que hagas todas tus tareas.', 'https://ideamarketspa.cl/wp-content/uploads/2022/01/ESCRITORIO-2.png', 0, 0, 1, 1),
(13, 'Estante billy', 59990, 29, 'Según nuestros cálculos, cada 5 segundos se vende un estante BILLY en algún lugar del mundo. Un dato impresionante, y más teniendo en cuenta que lanzamos BILLY en 1979. Es la opción preferida por los lectores y nunca se pasa de moda.', 'https://www.ikea.com/cl/es/images/products/billy-estante-blanco__0625599_pe692385_s5.jpg?f=s', 1, 0, 1, 10),
(16, 'Sillón rojo', 89990, 29, 'Un elegante sillón con un color distinguido', '../../assets/images/productos/1732820938-sillon rojo.jpg', 1, 0, 1, 2),
(17, 'Sillón amarillo', 129990, 42, 'Un sillón de la mas alta calidad muy cómodo y de un color amarillo.', '../../assets/images/productos/1732821050-sillon_amarillo.jpg', 1, 0, 1, 2),
(18, 'Silla de cuero roma', 191500, 66, 'El Sillón Roma se ubica entre los mejores sillones ejecutivos del mercado...¿porqué?\r\n\r\nTapizado en cuero tipo Búfalo, destaca por su sobriedad y comodidad. Se adapta bien a espacios gerenciales, escritorios ejecutivos, ideal para ofrecer descanso y comodidad a personas exigentes. \r\n\r\nCuenta con apoyabrazos incorporados con acolchado y tapiz en Eco cuero tipo Búfalo. Además de un mecanismo basculante y la posibilidad de ajustar la tensión con su perilla bajo el asiento.\r\n\r\nEstrella Aluminio ultra resistente con ruedas dobles de 50 mm.', '../../assets/images/productos/1732823165-sillon-de-cuero-roma.jpg', 0, 0, 1, 2),
(19, 'Sillón Florencia', 349990, 28, 'Un elegante sillón de color negro para cubrir las necesidades de tu hogar.', '../../assets/images/productos/1732837514-1CC21271241.jpg', 2, 0, 1, 2),
(20, 'Sillon en L', 150000, 15, 'Es fácil mantener la funda impecable, ya que se puede quitar y meter en la lavadora.\r\n\r\nEsta funda está hecha con tejido Saxemara de algodón y poliéster. El tejido de pana milrayas es suave y duradero y tiene un aspecto moderno y elegante.', '../../assets/images/productos/1733149749-Sillon_L.jpg', 0, 0, 1, 4),
(21, 'Sillon rosen mira zander', 800000, 10, 'Ambienta tu sala con la nueva colección de muebles Rosen. Este modelo de sofá Mira ha sido diseñado para brindar un confortable descanso y llenar de elegancia tu hogar. Con un sueva tapiz en tela, asientos un mullido relleno en fibra de poliéster que entrega una óptima sensación de confort.', '../../assets/images/productos/1733149923-Sillon 2.jpg', 0, 0, 1, 11),
(22, 'Sillon Pirlo', 1699990, 12, 'Elegante sofá seccional modelo Pirlo, de Ripley Home. De un sobrio color café, cuenta con respaldo y apoyabrazos en el cuerpo principal, brindándote máxima comodidad. Sus amplias dimensiones lo hacen ideal para incorporar en grandes espacios, llenando de calidez y estilo tu living. Las medidas son aproximadas', '../../assets/images/productos/1733150321-Sillon 3.jpg', 0, 0, 1, 11),
(23, 'Mesa de centro de vidrio', 139990, 0, 'Integra muebles que te ayuden a crear ambientes únicos con lo nuevo de Ripley Home. Esta mesa de centro Penélope es ideal para brindar un apoyo extra en tu sala. Fabricada con materiales de gran calidad que aseguran la durabilidad que esperaras.', '../../assets/images/productos/1733150510-mesa1.jpg', 0, 0, 0, NULL),
(24, 'Mesa comedor londres', 319990, 14, 'La mesa Londres impactará tanto en tu terraza como al interior de tu casa. Su diseño curvo, sus patas, colores y combinación de materiales generarán una nostalgia y calidez de hogar. El ratán sintético alrededor de la estructura de acero le da un aspecto clásico a nuestra mesa Londres. Es de material ligero, duradero e ideal para exterior o interior, la mesa consta con un vidrio templado resistente a los rayos UV.', '../../assets/images/productos/1733150657-mesa2.png', 0, 0, 1, 3),
(25, 'Mesa Gerona', 429990, 23, 'Imponente y con un diseño de otro nivel, Mark es una mesa de comedor cargada de estilo. Su base de líneas cruzadas y superficie de vidrio 1ue le darán un refresh a tu comedor.', '../../assets/images/productos/1733151218-mesa2.jpg', 0, 0, 1, 3),
(26, 'Mesa Chriss', 899990, 16, 'Mesas muy contemporáneas que aportan diseño y acabados únicos.\r\nMesa de comedor redonda de madera color natural.', '../../assets/images/productos/1733151387-mesa3.jpg', 0, 0, 1, 4),
(27, 'Escritorio Gamer', 249990, 12, 'Diseñado para profesionales: escritorio gaming para pc pensado especialmente para e-sports, con textura de fibra de carbono\r\nNo te quedes sin espacio: amplia superficie para colocar el monitor, teclado y ratón y demás periféricos con comodidad\r\nEstabilidad y resistencia: estructura en forma de Z que dota a la mesa de una gran estabilidad, construida con materiales de gran calidad: aleación de aluminio, acero, ABS y MDF\r\nEficiente gestión del cableado: cajón de almacenamiento y agujeros pasacables para facilitar su colocación y evitar la molesta acumulación de cables en escritorios tradicionales\r\nComodidad premium: reposavasos de gran tamaño para mantener tu bebida cerca al mismo tiempo que evita el riesgo de mojar el teclado u otros periféricos.', '../../assets/images/productos/1733151894-esc1.png', 0, 0, 1, 1),
(28, 'Escritorio 4 Cajone MDF', 99990, 13, 'El escritorio con 4 cajones es una pieza de mobiliario que combina funcionalidad y estilo en un diseño moderno y versátil. Fabricado con material de MDP de 15 mm y acabado en pintura UV, este escritorio garantiza resistencia y durabilidad en el tiempo. Su estructura permite el montaje tanto en el lado derecho como en el izquierdo, lo que lo hace adaptable a diferentes espacios y necesidades. Este escritorio cuenta con 4 cajones que proporcionan un amplio espacio de almacenamiento para organizar tus documentos, utensilios de oficina y otros objetos personales de manera ordenada. Las manijas de plástico y las correderas metálicas aseguran un funcionamiento suave y duradero de los cajones. Además, se incluyen instrucciones y accesorios para facilitar el montaje. Para mantener su aspecto y calidad, se recomienda limpiarlo con una franela seca o un paño suave, evitando el uso de abrasivos, desengrasantes o solventes, y mantenerlo en un lugar libre de humedad y exposición directa al sol', '../../assets/images/productos/1733151999-esc2.png', 0, 0, 1, 1),
(29, 'Escritorio Gamer Boku', 99990, 10, 'Con el equilibrio perfecto entre funcionalidad y estilo, un escritorio adecuado mejora tu concentración, manteniendo todo a mano y creando un ambiente que invita a la creatividad y la inspiración diaria. MDP 15 mm y tablero de 25 mm, soporte de metal para audífonos/auricular,​ acabado de pintura mate,​ alto soporte para la CPU​IMPORTANTE: Producto se entrega desarmado, Incluye manual de instrucciones e insumos (tornillos, tarugos, etc.), fotos referenciales no incluyen accesorios.', '../../assets/images/productos/1733152072-esc3.png', 1, 0, 1, 1),
(30, 'Escritorio Home Ofice Electrico', 399990, 12, 'Cosmo ofrece una comodidad excepcional, ya que permite ajustar la altura adaptándose a tus necesitades. Su diseño moderno y funcional permite llevar el home office a otro nivel.', '../../assets/images/productos/1733152170-esc4.png', 0, 0, 1, 1);

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
(11, 6),
(12, 5),
(13, 5),
(16, 6),
(17, 6),
(18, 5),
(19, 6),
(20, 6),
(21, 6),
(22, 6),
(24, 3),
(25, 4),
(26, 4),
(27, 5),
(28, 5),
(29, 5),
(30, 5);

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
(11, 4),
(12, 6),
(13, 4),
(16, 1),
(17, 8),
(18, 3),
(19, 3),
(20, 2),
(21, 9),
(22, 6),
(24, 6),
(25, 4),
(26, 6),
(27, 3),
(28, 4),
(29, 3),
(30, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_firmeza`
--

CREATE TABLE `producto_firmeza` (
  `id_producto` int(11) NOT NULL,
  `id_firmeza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_firmeza`
--

INSERT INTO `producto_firmeza` (`id_producto`, `id_firmeza`) VALUES
(16, 3),
(17, 4),
(19, 1),
(20, 3),
(21, 3),
(22, 1);

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
(5, 1),
(12, 1),
(16, 1),
(17, 1),
(19, 1),
(20, 2),
(21, 3),
(22, 2),
(24, 4),
(25, 3),
(26, 5),
(27, 3),
(28, 3),
(29, 3),
(30, 3);

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
(11, 1),
(12, 1),
(13, 1),
(16, 5),
(17, 5),
(18, 6),
(19, 5),
(20, 5),
(21, 7),
(22, 7),
(24, 4),
(25, 4),
(26, 1),
(27, 8),
(28, 1),
(29, 9),
(30, 8);

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
(5, 6),
(12, 1),
(16, 1),
(17, 1),
(19, 1),
(20, 3),
(21, 3),
(22, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 1),
(28, 1),
(29, 1),
(30, 1);

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
(11, 3),
(13, 3);

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
  `fecha_resenia` date DEFAULT NULL,
  `razon` text DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_usuario` int(100) NOT NULL,
  `id_producto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resenia`
--

INSERT INTO `resenia` (`id_resenia`, `calificacion`, `comentario`, `fecha_resenia`, `razon`, `activo`, `id_usuario`, `id_producto`) VALUES
(6, 5, 'AMOOO ESTA CAMA OMG MÁXIMO LA ADORA TAMBIEN esta muy feliz!!!1', NULL, '', 1, 3, 3),
(7, 3, 'La mesa se se raya muy facilmente, el barniz deja mucho que desear', NULL, '', 1, 4, 5),
(9, 1, 'Esta cajonera no sirve para nada es inutil.', NULL, '', 1, 5, 8),
(10, 5, 'LINDA CAMA', NULL, '', 1, 4, 3),
(11, 5, 'A mi gatito le encanta muy buena', '2024-12-02', '', 1, 2, 3),
(12, 5, 'CAMA ULTRA GOD', NULL, '', 1, 5, 3),
(22, 5, 'Hola', '2024-12-01', NULL, 1, 1, 3),
(23, 4, 'La silla esta bien pero le falta creo yo', '2024-12-01', NULL, 1, 1, 6),
(24, 5, 'Me gusto esta cama', '2024-12-01', NULL, 1, 1, 7),
(25, 5, 'Me gusta ', '2024-12-02', NULL, 1, 1, 11),
(26, 5, 'muy comoda y robusta, excelente silla', '2024-12-02', NULL, 1, 2, 6),
(27, 1, 'Mala calidad de la madera, dudo que sea roble.', '2024-12-02', NULL, 1, 2, 5),
(28, 4, 'buena calidad pero el respaldo es incomodo', '2024-12-02', NULL, 1, 2, 9),
(29, 5, 'muy bueno y es gamer', '2024-12-02', NULL, 1, 2, 29);

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
(1, 'Escritorio', 6),
(2, 'Silla', 5),
(3, 'Mesa', 6),
(4, 'Cama', 8),
(5, 'Cama gato', 8),
(6, 'Cajonera', 9),
(7, 'Silla de escritorio', 5),
(8, 'Clóset', 9),
(9, 'Buffet', 9),
(10, 'Estante', 9),
(11, 'Sofa', 5);

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
  `token_rec` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `run_usuario`, `correo_usuario`, `numero_usuario`, `contrasenia_usuario`, `direccion_usuario`, `tipo_usuario`, `puntos_totales`, `activo`, `ultima_sesion`, `token_rec`) VALUES
(1, 'Javier', 'Pino', '208460730', 'jpinoh@ing.ucsc.cl', '+56932365067', '$2y$10$FleiHYb0jPoueiI064rr1O92e30.3Ss5imRAI1yxRsqm4wEW47Qle', NULL, 'Superadmin', 91303, 1, '2024-12-01', NULL),
(2, 'Camilo', 'Campos', '21233765k', 'ccamposg@ing.ucsc.cl', '+56988275096', '$2y$10$VJN9UetBgsVYRfajlvPta.eMaldA5iwrpW7dI/YGrOD907azjhH4.', NULL, 'Admin', 13782, 1, '2024-12-02', NULL),
(3, 'Danae', 'Gonzalez', '210653163', 'dgonzalezv@ing.ucsc.cl', '+56931173800', '$2y$10$vKXZksm8sGgg9G/HurQZL.ycLlY7SAfGk/UNYPYpqHbIM2tEG865u', NULL, 'Registrado', 0, 1, '2024-11-04', NULL),
(4, 'Maicol', 'Ramirez', '212725021', 'mramirezm@ing.ucsc.cl', '+56968365262', '$2y$10$TmwGuN5O6N37SQKbc9Dy2OXVUoXIoe44XiO7DAIis/MZO6mGZWSFS', NULL, 'Registrado', 0, 1, '2024-12-02', NULL),
(5, 'Cesar', 'Avendaño', '210720537', 'cavendano@ing.ucsc.cl', '+56982911751', '$2y$10$IwbJKgN6gEzIjfLglZUpzOeQuD.OJfItLqARNAf4WGcRJJFexvHX6', NULL, 'Registrado', 0, 1, '2024-11-29', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  ADD PRIMARY KEY (`id_ambiente`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_usuario`,`id_producto`),
  ADD KEY `fk_carrito_producto` (`id_producto`);

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
  ADD KEY `id_metodo` (`id_metodo`);

--
-- Indices de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  ADD PRIMARY KEY (`id_compra`,`id_producto`),
  ADD KEY `fk_compra_producto_producto` (`id_producto`);

--
-- Indices de la tabla `control_stock`
--
ALTER TABLE `control_stock`
  ADD PRIMARY KEY (`id_control`),
  ADD KEY `id_producto` (`id_producto`);

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
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  MODIFY `id_ambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `control_stock`
--
ALTER TABLE `control_stock`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `firmeza`
--
ALTER TABLE `firmeza`
  MODIFY `id_firmeza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `forma`
--
ALTER TABLE `forma`
  MODIFY `id_forma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `lista_de_deseos`
--
ALTER TABLE `lista_de_deseos`
  MODIFY `id_lista_deseos` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id_metodo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id_oferta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `resenia`
--
ALTER TABLE `resenia`
  MODIFY `id_resenia` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_carrito_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_carrito_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_metodo`) REFERENCES `metodo_pago` (`id_metodo`);

--
-- Filtros para la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  ADD CONSTRAINT `fk_compra_producto_compra` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_compra_producto_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `control_stock`
--
ALTER TABLE `control_stock`
  ADD CONSTRAINT `control_stock_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
