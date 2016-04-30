--
-- MySQL 5.6.21
-- Wed, 14 Oct 2015 00:02:11 +0000
--

CREATE TABLE `barrios` (
   `id` int(11) not null auto_increment,
   `slug` varchar(120),
   `nombre` varchar(120),
   `localidad` varchar(120),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=31;

INSERT INTO `barrios` (`id`, `slug`, `nombre`, `localidad`) VALUES 
('3', 'gba-campana', 'GBA - Campana', 'GBA'),
('4', 'gba-escobar', 'GBA - Escobar', 'GBA'),
('5', 'gba-exaltacin-de-la-cruz', 'GBA - Exaltación de la Cruz', 'GBA'),
('6', 'gba-jos-c-paz', 'GBA - Jos&eacute; C. Paz', 'GBA'),
('7', 'gba-malvinas-argentinas', 'GBA - Malvinas Argentinas', 'GBA'),
('8', 'gba-san-fernando', 'GBA - San Fernando', 'GBA'),
('9', 'gba-san-isidro', 'GBA - San Isidro', 'GBA'),
('10', 'gba-san-miguel', 'GBA - San Miguel', 'GBA'),
('11', 'gba-tigre', 'GBA - Tigre', 'GBA'),
('12', 'gba-pilar', 'GBA - Pilar', 'GBA'),
('13', 'gba-vicente-lopez', 'GBA - Vicente Lopez', 'GBA'),
('14', 'gba-zona-norte', 'GBA - Zona Norte', 'GBA'),
('15', 'caba-agronomia', 'CABA - Agronomia', 'CABA'),
('16', 'caba-belgrano', 'CABA - Belgrano', 'CABA'),
('17', 'caba-caballito', 'CABA - Caballito', 'CABA'),
('18', 'caba-coghlan', 'CABA - Coghlan', 'CABA'),
('19', 'caba-constitucin', 'CABA - Constituci&oacute;n', 'CABA'),
('20', 'caba-colegiales', 'CABA - Colegiales', 'CABA'),
('21', 'caba-nuez', 'CABA - Nu&ntilde;ez', 'CABA'),
('22', 'caba-palermo', 'CABA - Palermo', 'CABA'),
('23', 'caba-parque-patricios', 'CABA - Parque Patricios', 'CABA'),
('24', 'caba-puerto-madero', 'CABA - Puerto Madero', 'CABA'),
('25', 'caba-recoleta', 'CABA - Recoleta', 'CABA'),
('26', 'caba-retiro', 'CABA - Retiro', 'CABA'),
('27', 'caba-saavedra', 'CABA - Saavedra', 'CABA'),
('28', 'caba-villa-urquiza', 'CABA - Villa Urquiza', 'CABA'),
('29', 'caba-villa-pueyrredn', 'CABA - Villa Pueyrred&oacute;n', 'CABA'),
('30', 'dixon-city', 'GBA - Dixon city', 'GBA');

CREATE TABLE `categorias` (
   `id` int(11) unsigned not null auto_increment,
   `nombre` varchar(255) not null,
   `slug` varchar(255) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

INSERT INTO `categorias` (`id`, `nombre`, `slug`) VALUES 
('1', 'Casas', 'casas'),
('2', 'Departamento', 'departamento'),
('3', 'Casa Quinta', 'casa-quinta');

CREATE TABLE `imagenes_propiedades` (
   `id` int(11) unsigned not null auto_increment,
   `propiedad_id` int(11) not null,
   `filename` varchar(255) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=65;

INSERT INTO `imagenes_propiedades` (`id`, `propiedad_id`, `filename`) VALUES 
('1', '2', '85f5bd_huber.png'),
('2', '1', '6d5612_1000.jpg'),
('3', '1', '760281_1000-2.jpg'),
('4', '1', 'b2ec22_1000-3.jpg'),
('7', '3', '57bad6_1000.jpg'),
('10', '5', '4dc945_1000.jpg'),
('11', '5', 'fc704c_avatar.jpg'),
('12', '4', 'aec3eb_tumblr_mmr7jekILn1rr4szko1_400.jpg'),
('18', '8', '2eb279_Bdq2dXeCMAAf07L.jpg'),
('19', '8', 'b6d527_Diseño-de-sala-y-cocina-de-mini-departamento.jpg'),
('38', '14', '5957f4_7652e4_Koala.jpg'),
('39', '14', '42c35d_95e8a8_Penguins.jpg'),
('40', '14', 'ee7abc_95e8a8_Penguins.jpg'),
('59', '7', 'ead583_GUSTAVO-SOBRERO-LADRON.jpg'),
('60', '7', 'd5ad8d_0001174162.jpg'),
('63', '6', 'c54bd9_11816853_10153552582182028_7520185319517242421_n.jpg'),
('64', '6', '88f936_calamar-gay-660x350.png');

CREATE TABLE `migrations` (
   `version` int(3) not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`version`) VALUES 
('6');

CREATE TABLE `propiedades` (
   `id` int(11) unsigned not null auto_increment,
   `titulo` varchar(255) not null,
   `subtitulo` varchar(255) not null,
   `codigo` varchar(255) not null,
   `categoria_id` int(11) not null,
   `localidad` varchar(255) not null,
   `barrio` varchar(255) not null,
   `input_direccion` varchar(255) not null,
   `direccion` varchar(180),
   `mapa` text not null,
   `tipo_transaccion` int(11) not null,
   `moneda` varchar(255) not null,
   `sup_cubierta` varchar(255) not null,
   `sup_semi_cubierta` varchar(255) not null,
   `sup_t_total` varchar(255) not null,
   `palier_privado` varchar(255) not null,
   `hall_de_entrada` varchar(255) not null,
   `living` varchar(255) not null,
   `comedor` varchar(255) not null,
   `toilette` varchar(255) not null,
   `cant_banos` varchar(255) not null,
   `cocina` varchar(255) not null,
   `comedor_diario` varchar(255) not null,
   `lavadero` varchar(255) not null,
   `hab_servicio` varchar(255) not null,
   `balcon` varchar(255) not null,
   `segundo_balcon` varchar(255) not null,
   `quincho` varchar(255) not null,
   `cochera` varchar(255) not null,
   `garage` varchar(255) not null,
   `baulera` varchar(255) not null,
   `parrilla` varchar(255) not null,
   `cant_dormitorios` varchar(255) not null,
   `descrip_dormitorios` varchar(255) not null,
   `expensas` varchar(255) not null,
   `abl` varchar(255) not null,
   `tipo_piso` varchar(255) not null,
   `calefaccion` varchar(255) not null,
   `aire_acondicionado` varchar(255) not null,
   `agua_caliente` varchar(255) not null,
   `entrada_servicio` varchar(255) not null,
   `doble_circulacion` varchar(255) not null,
   `piscina` varchar(255) not null,
   `orientacion` varchar(255) not null,
   `condicion` varchar(255) not null,
   `apto_profesional` varchar(255) not null,
   `sum` varchar(255) not null,
   `antiguedad` varchar(255) not null,
   `estado` varchar(255) not null,
   `ascensor` varchar(255) not null,
   `otros_servicios` varchar(255) not null,
   `observaciones` text not null,
   `coordenadas` varchar(255),
   `main_image` int(2),
   `sucursal_id` int(11),
   `destacada` int(1),
   `precio` float(11,2),
   `arba` varchar(100),
   `sup_lote` varchar(100),
   `family` varchar(100),
   `playroom` varchar(100),
   `escritorio` varchar(100),
   `reservado` tinyint(1),
   `vendido` tinyint(1),
   `sup_descubierta` varchar(120),
   `telefono` varchar(80),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=15;

INSERT INTO `propiedades` (`id`, `titulo`, `subtitulo`, `codigo`, `categoria_id`, `localidad`, `barrio`, `input_direccion`, `direccion`, `mapa`, `tipo_transaccion`, `moneda`, `sup_cubierta`, `sup_semi_cubierta`, `sup_t_total`, `palier_privado`, `hall_de_entrada`, `living`, `comedor`, `toilette`, `cant_banos`, `cocina`, `comedor_diario`, `lavadero`, `hab_servicio`, `balcon`, `segundo_balcon`, `quincho`, `cochera`, `garage`, `baulera`, `parrilla`, `cant_dormitorios`, `descrip_dormitorios`, `expensas`, `abl`, `tipo_piso`, `calefaccion`, `aire_acondicionado`, `agua_caliente`, `entrada_servicio`, `doble_circulacion`, `piscina`, `orientacion`, `condicion`, `apto_profesional`, `sum`, `antiguedad`, `estado`, `ascensor`, `otros_servicios`, `observaciones`, `coordenadas`, `main_image`, `sucursal_id`, `destacada`, `precio`, `arba`, `sup_lote`, `family`, `playroom`, `escritorio`, `reservado`, `vendido`, `sup_descubierta`, `telefono`) VALUES 
('5', 'Lavale 550', 'Quil Lavale 550Lavale 550', '123', '1', 'CABA', 'CABA - Retiro', 'Salgado Oeste 421, Lobos, Buenos Aires, Argentina', 'Salgado oeste 421', '0', '1', 'u$s', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '4', '[\"11111\",\"22222\",\"33333\",\"SOYEL 4444444\"]', '', '', '', '', '', '', '', '', '', 'NORTE', '', 'Si', '', '', '', '', 'asdad', 'asdasd', '(-35.1858826, -59.10141399999998)', '10', '2', '1', '25000.00', '', '', '', '', '', '', '', '', ''),
('6', '0', '0', 'asdasdasd', '1', 'GBA', 'CABA - Retiro', '432 Avenida Puerto Cabello, Valencia, Carabobo, Venezuela', 'Avenida cabello 43222', '0', '1', 'u$s', '', '', '356', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 'false', '', '', '', '', '', '', '', '', '', 'NORTE', '', 'Si', '', '', '', '', 'asd', 'asd', '', '17', '2', '1', '13.00', '', '', '', '', '', '0', '0', '', ''),
('7', '0', '0', '12nsjhas', '2', 'GBA', '16', 'Armenia 1473, C1414DKE CABA, Argentina', 'Armenia 1473', '0', '1', 'u$s', '45', '23', '54', 'palier no ', 'Si', 'Si', 'si comedor', 'toillete', '2 banios', 'si coci', 'si cme', 'si lav', 'si hab ser', 'si bal', 'si segun', 'si quin', 'si chco', 'si garage', 'si abule', 'si p[arrrrl', '3', '[\"un dormitorio lindo\",\"otro mas lindo aun\",\"el tercero es maso\"]', '1200', 'si', 'parquet', 'si ', 'frio', 'posupuesto', 'si entrada de serv', 'nop', 'si piscina', 'NORTE', 'eccelnte condicion', 'Si', 'si sum', '4 anos an', 'muy buen estado', 'si ascen', 'ducha', 'es beautfull', '(-34.59107113342948, -58.429412841796875)', '22', '1', '1', '99000.00', '1200', '', '', '', '', '0', '0', '131313', '446910'),
('8', '0', '0', '72i1y123', '1', 'GBA', 'GBA - Pilar', 'Florida 2099-2127, B1602EQA Florida, Buenos Aires, Argentina', 'lavallejas y Av. Zaraza', '0', '1', '$', '90', '21', '144', 'No ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '4', '[\"El dormitorio principal es muy grande y con vestidos\"]', '', '', '', '', '', '', '', '', '', 'NORTE', '', 'Si', '', '10 años', '', '', 'Se encuentra cerca de la estacion de trenes.', 'Muy bien cuidada y con alta calidad de terminaciones.', '(-34.52208035667066, -58.49395751953125)', '18', '1', '1', '12000.00', 'ARBASIP', '1002', 'si family', 'el palyrrom', 'con sambuches', '', '', '', ''),
('9', '0', '0', '123123', '3', 'CABA', 'CABA - Agronomia', '', 'por ahos 555', '0', '2', 'u$s', '123', '123', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 'false', '', '', '', '', '', '', '', '', '', 'NORTE', '', 'Si', '', '', '', '', 'asda', 'con reservación i venosdpasdasdassd', '', '', '2', '0', '0.00', '', '123', '', '', '', '', '', '', ''),
('14', '0', '0', 'reser', '3', 'CABA', 'CABA - Agronomia', '', 'vendi', '0', '2', 'u$s', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 'false', '', '', '', '', '', '', '', '', '', 'NORTE', '', 'Si', '', '', '', '', '', '', '', '', '2', '0', '0.00', '', '', '', '', '', '1', '1', '', '');

CREATE TABLE `sucursales` (
   `id` int(11) unsigned not null auto_increment,
   `nombre` varchar(255) not null,
   `direccion` varchar(255) not null,
   `emails` varchar(255) not null,
   `telefonos` varchar(255) not null,
   `detalles` text not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

INSERT INTO `sucursales` (`id`, `nombre`, `direccion`, `emails`, `telefonos`, `detalles`) VALUES 
('1', 'Sucursal uno', 'Lorenzo lamas 8422 - Quilmes', 'un@email.com, dos@memails.net', '4742-8567 - 6593-2247', 'el detalle editado'),
('2', '2', '2', 'un@email.com, dos@memails.net', '2', '0'),
('3', '3', '3', 'un@email.com, dos@memails.net', '123,123,543', '0');

CREATE TABLE `tipos_transacciones` (
   `id` int(11) unsigned not null auto_increment,
   `nombre` varchar(255) not null,
   `slug` varchar(255) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

INSERT INTO `tipos_transacciones` (`id`, `nombre`, `slug`) VALUES 
('1', 'Venta', 'venta'),
('2', 'Alquiler', 'alquiler');

CREATE TABLE `useradmin` (
   `id` int(11) unsigned not null auto_increment,
   `email` varchar(100) not null,
   `password` varchar(100) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

INSERT INTO `useradmin` (`id`, `email`, `password`) VALUES 
('1', 'admin', 'plokij');