-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-03-2017 a las 03:48:28
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

--
-- Volcado de datos para la tabla `cart`
--

INSERT INTO `cart` (`oid`, `value`, `date`, `users.id`) VALUES
(36, 63000, '2017-03-02', 13),
(38, 69000, '2017-03-02', 1),
(39, 105000, '2017-03-02', 1),
(40, 70000, '2017-03-02', 1),
(42, 35000, '2017-03-03', 1),
(43, 98000, '2017-03-03', 1),
(44, 202220, '2017-03-06', 1),
(46, 43003, '2017-03-07', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE `item` (
  `reference` int(8) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `value` int(8) NOT NULL,
  `chassis` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `traction` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `transmission` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(375) COLLATE utf8_spanish_ci NOT NULL,
  `description_long` varchar(3000) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(8) NOT NULL,
  `pic` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`reference`, `name`, `value`, `chassis`, `traction`, `transmission`, `type`, `description`, `description_long`, `stock`, `pic`) VALUES
(9, 'Fiat Multipla', 1220, 'Monovolumen', 'Delantera', 'Manual', 'Diésel', 'El Fiat Multipla es un monovolumen producido por el fabricante italiano Fiat desde 1998 hasta 2010. Se fabricó en la planta turinesa de Fiat Mirafiori.\nEl motor del Multipla es un gasolina de 1,6 litros con 102 CV de potencia máxima. La caja de cambios es manual con 5 velocidades.', 'El diseño peculiar del Fiat Multipla, con sus proporciones inusuales y un escalón entre el capó y el parabrisas, lo llevó a ser expuesto en el Museo de Arte Moderno de Nueva York (MoMA), aparecer en la película futurista Children of Men y recibir el galardón Automóvil más feo de 1999 por el programa de televisión inglés Top Gear. <br /> <br /> En el año 2004 el frontal fue reestilizado, perdiendo el escalón frente al parabrisas, mientras que la calandra y los faros fueron modificados para asemejarlos con los modelos contemporáneos de Fiat. El Multipla usa la plataforma C1 Sandwich, basada en el Fiat Bravo/Brava. Con respecto a otros monovolúmenes de su categoría, el Multipla es mucho más ancho y corto. A diferencia de ellos posee, al igual que el Fiat 600 Multipla de 1956, seis plazas, que están dispuestas en dos filas de tres asientos. Este formato fue posteriormente imitado en el Honda FR-V.', 1, 'images/multipla.jpg'),
(10, 'BMW X6', 32000, 'Todocamino', '4x4', 'Manual', 'Diésel', 'El BMW X6 representa una nueva categoría automovilística con un concepto de diseño diferente. El primer Sports Activity Coupé del fabricante fascina por un diseño que mezcla la elegancia y deportividad de un gran coupé con el aplomo y solidez de un modelo X de BMW.', 'La primera generación (E71) fue comercializada en 2008. Debutó combinando los atributos de un SUV (altura libre al suelo y capacidad de tracción integral a las cuatro ruedas) unido a la pose de vehículo coupé con una estética de gran dinamismo y aplomo. Su diseño específico y extravagante cuenta con una sección frontal que se distingue por su apariencia deportiva de líneas claramente estructuradas, con grandes entradas de aire.  <br /> <br /> El perfil es alargado, con una superficie acristalada esbelta y líneas de carrocería que guían la vista hacia las ruedas, acentuando el aplomo del coche. Las proporciones corresponden a las de un coupé clásico. La línea dinámica del techo termina de manera armónica en la zaga, dejando una sensación de diseño imponente en su conjunto. La segunda generación (F16) se presentó en el Salón de París en 2014.  ', 1, 'images/original.jpg'),
(11, 'Mercedes Clase C', 38000, 'Berlina', 'Trasera', 'Manual', 'Gasolina', 'El Mercedes Clase C es el coche que el segmento de las berlinas medias estaba esperando. Se trata de un producto que disfruta de un dinamismo y deportividad con el modelo precedente solo podía soñar. Sin duda, Mercedes-Benz quiere hacer mucho daño en el segmento y es por ello que los ingenieros de la firma de la estrella han creado un producto francamente convincente.', 'Esta berlina utiliza una nueva plataforma que ya se emplea en una batería de nuevos modelos de Mercedes. De hecho, son nada menos que cuatro las variantes disponibles de la gama del Clase C, pues además de la berlina de cuatro puertas, encontramos al Clase C Estate con carrocería familiar, al Clase C Coupé de dos puertas y por último, al más reciente de la gama, al nuevo Clase C Cabrio con capota de lona escamoteable.  <br /> <br />   En el nuevo Mercedes Clase C berlina ha aumentado sus dimensiones. La batalla crece en 80 milímetros en comparación con el antecesor, la longitud del vehículo 95 milímetros, y la anchura, otros 40 milímetros. Los ocupantes de las plazas traseras son los principales beneficiarios del incremento resultante en las cotas del habitáculo y pueden disfrutar de un mayor confort en sus viajes.Esta berlina utiliza una nueva plataforma que ya se emplea en una batería de nuevos modelos de Mercedes. De hecho, son nada menos que cuatro las variantes disponibles de la gama del Clase C, pues además de la berlina de cuatro puertas, encontramos al Clase C Estate con carrocería familiar, al Clase C Coupé de dos puertas y por último, al más reciente de la gama, al nuevo Clase C Cabrio con capota de lona escamoteable.  <br /> <br />   En el nuevo Mercedes Clase C berlina ha aumentado sus dimensiones. La batalla crece en 80 milímetros en comparación con el antecesor, la longitud del vehículo 95 milímetros, y la anchura, otros 40 milímetros. Los ocupantes de las plazas traseras son los principales beneficiarios del incremento resultante en las cotas del habitáculo y pueden disfrutar de un mayor confort en sus viajes.', 1, 'images/mercedesclasec.jpg'),
(15, 'Tesla Modelo S', 90000, 'Berlina', 'Trasera', 'Automático', 'Eléctrico', 'El Tesla Model S es una berlina de lujo de cinco puertas. Comercializado desde 2012, cuenta con la máxima calificación en materia de seguridad y, es todo un éxito en materia de ventas dentro y fuera de los Estados Unidos. Equipado con un paquete de baterías de 85 kWh, supera en autonomía al Tesla Roadster, siendo capaz de recorrer más de 400 kilómetros entre carga y carga.', 'El motor va en el eje trasero y las baterías van tumbadas en el suelo. ¿Resultado? Un centro de gravedad más bajo para que la berlina vaya a la misma distancia del asfalto que un deportivo. El Tesla Model S está disponible en dos configuraciones diferentes de tracción: trasera y tracción total con motor dual. Esta última configuración equipa un motor en ambos ejes, monitorizados y controlados digitalmente, que permite una tracción óptima en cualquier situación. <br /><br />  El Tesla Model S maximiza la capacidad del bloque de baterias con un diseño aerodinámico de lineas fluidas permitiendo una resistencia menor en el flujo de aire. En el interior llama la atención la pantalla táctil de 17 pulgadas, en ángulo hacia el conductor e incluye tanto los modos de día y de noche para una visibilidad sin distracciones. ', 1, 'images/teslamodels.jpg'),
(16, 'Ford Focus RS ', 41000, 'Hatchback', 'AWD', 'Manual', 'Gasolina', 'El nuevo Focus RS con motor EcoBoost de 2,3 litros presenta unas cifras impresionantes.   Todas ellas se han mejorado gracias a una serie de avanzadas tecnologías orientadas al rendimiento, como la tracción a las cuatro ruedas, el control de aceleración o los modos de conducción seleccionables.', 'La tracción a las cuatro ruedas (AWD) Ford Performance con control vectorial del par dinámico proporciona, un agarre excepcional y un paso por curva óptimo.El sistema emplea un doble embrague con control electrónico que ayuda a repartir el par motor entre las ruedas traseras en función de la superficie y las condiciones de conducción. Además, esta tecnología inteligente también le permite disfrutar de un derrape con sobreviraje controlado en conducción deportiva.  <br /><br />  La revolucionaria tecnología del motor EcoBoost de 2,3 litros incorpora inyección directa de combustible, doble distribución variable independiente y turbocompresor de doble entrada (twin-scroll). Esta tecnología, específicamente afinada y calibrada para el nuevo Focus RS permite disponer de una potencia máxima de 350 CV y un par máximo de 440 Nm (overboost de 470 Nm). A su excelente capacidad de respuesta a bajas revoluciones cabe sumar su excelente empuje en la zona media pudiendo llegar hasta 6800 rpm.', 1, 'images/2016-Ford-Focus-RS-lp-2.jpg'),
(18, 'Range Rover', 69000, 'Todoterreno', '4x4', 'Manual', 'Gasolina', 'El Range Rover Sport SVR derrocha deportividad por los cuatro costados y se presenta oficialmente como el SUV más rápido sobre Nürburgring. ¿Cómo lo consigue? Sin duda, con su poderoso motor V8 de 5,0 litros sobrealimentado que desarrolla 550 CV y 680 Nm de par máximo.', 'Con estas especificaciones, no tiene problemas para devorar el mítico trazado alemán puesto que acelera de 0 a 100 km/h en 4,7 segundos, con una velocidad máxima de 260 km/h. Si parece poco, el Range Rover Sport SVR utiliza un sistema de escape activo con control eléctrico y su bastidor se pone al nivel de las exigencias del nuevo motor. <br /><br />Para optimizar el reparto de la tracción, se ha recalibrado el bloqueo del diferencial trasero activo. Ahora, el diferencial se bloquea antes para que el par se transfiera a la rueda trasera aumentando así la agilidad.', 1, 'images/range_rover_sport_2014_c01.jpg'),
(19, 'Audi Q7', 63000, 'SUV', '4x4', 'Manual', 'Gasolina', 'Mucho más ligero, ágil y deportivo. Así es el nuevo Audi Q7. Los de Ingolstadt han creado un duro rival para el Porsche Cayenne y el BMW X5. El diseño no sorprende en exceso. No cabe duda de que es un SUV atractivo, pero recuerda en exceso al modelo anterior.', 'Así que uno apenas sospecha al primer vistazo que apenas comparte una pieza con su antecesor, que se trata de un modelo completamente nuevo, y más bien parece un ‘facelift’. Pero no es así en absoluto. Hay que fijarse para ver dónde están las novedades de la carrocería. Y en cuanto lo pones en la báscula, uno se da cuenta del milagro: ahorra nada más y nada menos que 325 kilos respecto al anterior, y logra quedarse por debajo de las dos toneladas.<br /><br /> Primera sorpresa. En el interior sí que se notan las diferencias: es más moderno y ergonómico, transmite aún más calidad que el del modelo anterior y sus sistemas multimedia y de conectividad se han puesto a la última. La cura de adelgazamiento se nota: su construcción ligera y el nuevo chasis de cinco brazos, así como motores más potentes y la opción de las ruedas traseras direccionales o la suspensión neumática dejan patente que  transmite más ligereza y es más manejable. <br /><br />A las salidas de los semáforos empuja con agresividad, pasa por las curvas ágil y aplomado, en superficie irregular filtra con eficacia y confort. En carreteras de montaña, da la impresión de estar conduciendo un Audi Q5 con traje de gala. En cuanto a la gama de motores, el Q7 cuenta con un 3.0 TDI de 272 CV, y un 3.0 TFSI de 333 CV.', 1, 'images/audi-q7_2016_c01.jpg'),
(23, 'Infiniti Q50', 35000, 'Berlina', 'Trasera', 'Manual', 'Gasolina', 'El Infiniti Q50 realmente supone una nueva era para la marca. Además, es el primer Infiniti que estrena una nueva nomenclatura para la futura gama de vehículos de la compañía con el prefijo Q para berlinas, coupés y cabrios. Esta berlina es algo más que una simple letra nueva', 'Para empezar, el diseño exterior del Infiniti Q50 ha sido influenciado por la trilogía de los concept cars de Infiniti: Essence, Etherea y Emerg-e. En el interior del Infiniti Q50, la sensación de doble cabina se consigue mediante un panel de control en forma de doble onda.<br /><br />\r\nAdemás, la calidad en acabados y ajustes corresponde sin duda al segmento de las berlinas premium como el BMW Serie 3, el Audi A4 o el Mercedes Clase C, donde el Q50 quiere ser un competidor de verdad.<br /><br />\r\n Con una distancia entre ejes de 2.850 mm, el Infiniti Q50 cuenta con un amplio espacio para los pasajeros adultos en las filas delantera y, sobre todo, en la trasera, donde dos adultos de 1,80 metros no tendrán mayor problema, con uno de los mejores espacios para las rodillas de su clase.', 1, 'images/infiniti-q50_2014_c01.jpg'),
(24, 'Jaguar XF', 43003, 'Berlina', 'Trasera', 'Manual', 'Gasolina', 'La primera generación del Jaguar XF ha cosechado un gran éxito, basada en su atractivo diseño, que mezcla elegancia y deportividad. Gracias a eso ha aguantado en tipo durante todos estos años, ya que se lanzó en 2008 (tuvo un restyling en 2011). Ahora el nuevo Jaguar XF actualiza sus formas, y renueva su gama mecánica.', 'Por fuera destaca un frontal que mantiene la esencia, pero que incorpora nuevos faros con luces de día LED, aunque lo que más destaca es su nueva plataforma y su construcción monocasco en la que se ha usado principalmente el aluminio (el 75% es de aluminio), lo que se traduce en una mayor ligereza (concretamente es un 11% más ligero que antes). <br />\r\n<br />\r\nEn total se ahorran 190 kilos, y se aumenta la rigidez (en un 28%). El interior, pese a que el Jaguar XF es más bajo que el anterior, logra una mejor cota de altura disponible para la cabeza en las plazas traseras, que ganan 27 milímetros. <br />\r\n<br />\r\nAdemás, la batalla gana 5 mm, que no es demasiado, pero no hace sino incrementar la sensación de espacio interior. Del mismo modo, se ha estudiado especialmente la aerodinámica en el nuevo Jaguar XF y con un Cx de 0,26 logra un gran indice de penetración en el aire si lo comparamos con su competencia. <br />\r\n<br />\r\nSu objetivo es enfrentarse a berlinas premium como el BMW Serie 5 o el Audi A6.', 1, 'images/jaguar-xf_2016_c01.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `mid` int(8) NOT NULL,
  `users.id` int(8) NOT NULL,
  `message` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`mid`, `users.id`, `message`) VALUES
(1, 1, 'Este mensaje es una prueba para el usuario Alvarito'),
(2, 14, 'Este mensaje se verá en todas las cuentas y solo puede ser borrado desde una cuenta de administrador.'),
(4, 1, 'prueba2'),
(5, 1, 'Prueba3'),
(7, 1, 'prueba5'),
(9, 14, 'Prueba para todos los usuarios.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quantity`
--

CREATE TABLE `quantity` (
  `item.reference` int(8) NOT NULL,
  `cart.oid` int(8) NOT NULL,
  `quantity` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `quantity`
--

INSERT INTO `quantity` (`item.reference`, `cart.oid`, `quantity`) VALUES
(9, 44, 1),
(10, 44, 1),
(11, 44, 1),
(15, 44, 1),
(16, 44, 1),
(18, 38, 1),
(19, 36, 1),
(19, 43, 1),
(23, 39, 3),
(23, 40, 2),
(23, 42, 1),
(23, 43, 1),
(24, 46, 1);

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
(1, 'Alvarito', 'a.nietolopez96@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Sevilla, 41927, Mairena del Aljarafe, Simon Verde', 'admin', 'Álvaro', 'Nieto López'),
(8, 'sergio', 'sergio1345@gmail.com', 'a3f3d7df63d86701109f9c89945b81c9', 'Camas Sity Siudá sin ley', 'user', 'Sergio', 'Gorgé Jorge'),
(12, 'roto2', 'roto2@forococoches.com', '0cef876758a37d356440d0cc5fe776c6', 'Madrit C/ Ferraz 288', 'user', 'Alonso', 'de Cera'),
(13, 'tester', 'testerino@tester.com', '827ccb0eea8a706c4c34a16891f84e7b', 'testerlandia', 'user', 'teste', 'ino'),
(14, 'all', 'all@all.com', '827ccb0eea8a706c4c34a16891f84e7b', 'all', 'user', 'all', 'all'),
(15, 'prueba', 'prueba@prueba.com', '827ccb0eea8a706c4c34a16891f84e7b', 'asd', 'user', 'asd', 'asd');

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
-- Indices de la tabla `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`reference`),
  ADD KEY `subcategory_name` (`chassis`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mid`,`users.id`);

--
-- Indices de la tabla `quantity`
--
ALTER TABLE `quantity`
  ADD PRIMARY KEY (`item.reference`,`cart.oid`),
  ADD KEY `cart.oid` (`cart.oid`);

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
  MODIFY `oid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de la tabla `item`
--
ALTER TABLE `item`
  MODIFY `reference` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `mid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`users.id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `quantity`
--
ALTER TABLE `quantity`
  ADD CONSTRAINT `quantity_ibfk_1` FOREIGN KEY (`cart.oid`) REFERENCES `cart` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `r.item` FOREIGN KEY (`item.reference`) REFERENCES `item` (`reference`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
