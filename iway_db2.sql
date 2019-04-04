SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE `cf_ciclos_pagos` (
  `ciclos_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `centro_de_costos` int(11) NOT NULL,
  `mes` int(2) NOT NULL,
  `ciclo_produccion_id` varchar(16) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `fecha_desde` date NOT NULL,
  `fecha_hasta` date NOT NULL,
  `TRM_Liquidacion` decimal(10,2) DEFAULT '0.00',
  `estado` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `mae_administrativo` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_identidad_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `eps_id` int(11) NOT NULL,
  `caja_compensacion_id` int(11) NOT NULL,
  `tipo_cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `regimen_empresa` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `naturaleza` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `numero_identificacion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `digito_verificacion` int(11) NOT NULL,
  `nombre_legal` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_comercial` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `representante_legal` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_representante_legal` int(20) NOT NULL,
  `ciudad_expedicion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `persona_de_contacto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cargo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `pagina_web` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Documento_moneda_extranjera` tinyint(1) NOT NULL,
  `credito` varchar(2) COLLATE utf8_spanish2_ci NOT NULL,
  `dias_de_credito` int(11) NOT NULL,
  `Cupo_credito` float NOT NULL,
  `vendeddor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `lista_de_precios` varchar(2) COLLATE utf8_spanish2_ci NOT NULL,
  `suspendido_ventas` tinyint(1) NOT NULL,
  `Fecha_registro` date NOT NULL,
  `responsable_creacion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `mae_asociado` (
  `id` int(10) NOT NULL,
  `tipo_identidad_id` int(11) NOT NULL,
  `eps_id` int(11) NOT NULL,
  `caja_compensacion_id` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `tipo_cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `regimen_empresa` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `naturaleza` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `numero_identificacion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `digito_verificacion` int(11) NOT NULL,
  `nombre_legal` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_comercial` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `representante_legal` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_represntante_legal` int(20) NOT NULL,
  `ciudad_expedicion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `persona_de_contacto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cargo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `pagina_web` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Documento_moneda_extranjera` tinyint(1) NOT NULL,
  `credito` varchar(2) COLLATE utf8_spanish2_ci NOT NULL,
  `dias_de_credito` int(11) NOT NULL,
  `Cupo_credito` float NOT NULL,
  `vendeddor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `lista_de_precios` varchar(2) COLLATE utf8_spanish2_ci NOT NULL,
  `suspendido_ventas` tinyint(1) NOT NULL,
  `Fecha_registro` date NOT NULL,
  `responsable_creacion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `mae_calendario` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descripcion` longtext NOT NULL,
  `color` varchar(255) NOT NULL,
  `textColor` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `mae_centro_costo` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `centro_costo` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `Responsable_creacion` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `mae_cliente` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_identidad_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `tipo_cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `regimen_empresa` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `naturaleza` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `numero_identificacion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `digito_verificacion` int(11) NOT NULL,
  `nombre_legal` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_comercial` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `representante_legal` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_represntante_legal` int(20) NOT NULL,
  `ciudad_expedicion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `persona_de_contacto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cargo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `pagina_web` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Documento_moneda_extranjera` tinyint(1) NOT NULL,
  `credito` varchar(2) COLLATE utf8_spanish2_ci NOT NULL,
  `dias_de_credito` int(11) NOT NULL,
  `Cupo_credito` float NOT NULL,
  `vendeddor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `lista_de_precios` varchar(2) COLLATE utf8_spanish2_ci NOT NULL,
  `suspendido_ventas` tinyint(1) NOT NULL,
  `Fecha_registro` date NOT NULL,
  `responsable_creacion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `mae_cliente_joberp` (
  `empresa_id` int(11) NOT NULL,
  `regimen_empresa` varchar(100) NOT NULL,
  `naturaleza` varchar(100) NOT NULL,
  `fecha_matricula` date NOT NULL,
  `declara_renta` varchar(11) NOT NULL,
  `prefijo_documento` varchar(50) NOT NULL,
  `tipo_identificacion` int(11) NOT NULL,
  `numero_identificacion` varchar(50) NOT NULL,
  `digitos_verificacion` int(11) NOT NULL,
  `nombre_legal` varchar(100) NOT NULL,
  `nombre_comercial` varchar(100) NOT NULL,
  `id_representante_legal` varchar(50) NOT NULL,
  `ciudad_expedicion` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `ciudad` int(11) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `persona_contacto` varchar(100) NOT NULL,
  `cargo` int(11) NOT NULL,
  `pagina_web` varchar(200) NOT NULL,
  `descripcion_cliente` varchar(100) NOT NULL,
  `divisa_oficial` varchar(20) NOT NULL,
  `documento_moneda_extranjera` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `logo_json` longtext NOT NULL,
  `fecha_registro` date NOT NULL,
  `responsable_creacion` int(11) DEFAULT NULL,
  `demo` text NOT NULL,
  `color_aplicativo` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `empresa_id1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `mae_cuenta_bancaria` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `banco_id` int(10) UNSIGNED NOT NULL,
  `usuario` int(11) NOT NULL,
  `tipo_de_cuenta` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `numero_de_cuenta` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `responsable_creacion` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `mae_forma_de_pago` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `forma_pago` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `dias_pago` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `responsable_creacion` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `mae_inventario` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `inventariable` tinytext COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_articulo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `codigo_barra` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `referencia` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `garantia` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `foto_producto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `linea` int(11) NOT NULL,
  `unidad_de_medida` int(11) NOT NULL,
  `se_compra` int(11) NOT NULL,
  `retencion` int(11) NOT NULL,
  `se_vende` int(11) NOT NULL,
  `tarifa_iva` int(11) NOT NULL,
  `precio_venta` float NOT NULL,
  `cantidad_inicial` int(11) NOT NULL,
  `costo_inicial` float NOT NULL,
  `fecha_registro` date NOT NULL,
  `responsable_creacion` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `mae_pes_inventario` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `id_conf` int(11) NOT NULL,
  `se_compra` int(11) NOT NULL,
  `se_vende` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `responsable_creacion` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `mae_proveedores` (
  `id` int(11) NOT NULL,
  `tipo_identidad_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `tipo_proveedor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `regimen_empresa` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Naturaleza` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `numero_identificacion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `digito_verificacion` int(11) NOT NULL,
  `nombre_legal` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_comercial` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `representante_legal` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `id_representante_legal` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad_expedicion` int(11) NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` int(11) NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `persona_contacto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cargo` int(11) NOT NULL,
  `pagina_web` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `documento_moneda_extranjera` tinytext COLLATE utf8_spanish2_ci NOT NULL,
  `credito` tinytext COLLATE utf8_spanish2_ci NOT NULL,
  `dias_de_credito` int(11) NOT NULL,
  `cupo_credito` float NOT NULL,
  `banco` int(11) NOT NULL,
  `tipo_de_cuenta` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `numero_de_cuenta` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `responsable_contratacion` date NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `mae_usuarios_empleados` (
  `id` int(11) NOT NULL,
  `tipo_identidad_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `estado_civil_id` int(11) NOT NULL,
  `eps_id` int(11) NOT NULL,
  `caja_compensacion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `rol_id` int(11) NOT NULL,
  `centro_costos` int(11) NOT NULL,
  `tipo_empleado` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `numero_identificacion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad_expedicion` int(11) NOT NULL,
  `primer_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `segundo_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `primer_apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `segundo_apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `lugar_nacimiento` int(11) DEFAULT NULL,
  `Direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` int(11) NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cargo` int(11) NOT NULL,
  `salario_basico` float NOT NULL,
  `arp_id` int(11) NOT NULL,
  `pension` int(11) NOT NULL,
  `censatia` int(11) NOT NULL,
  `forma_de_pago` int(11) NOT NULL,
  `tipo_de_contratacion` int(11) NOT NULL,
  `moneda_de_pago` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_contratacion` date NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `foto_funcionario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `firma` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `inicio_sesion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fin_sesion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_registro` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `responsable_creacion` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `op_links` (
  `id_op_link` int(11) NOT NULL,
  `id_link` int(11) NOT NULL,
  `contador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;
CREATE TABLE `rp_operaciones` (
  `id` int(11) UNSIGNED NOT NULL,
  `responsable_id` int(11) NOT NULL,
  `responsable_anular` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `centro_de_costos` int(11) NOT NULL,
  `nro_documento` int(11) NOT NULL,
  `pref_nro_documento` varchar(5) NOT NULL,
  `tipo_documento` int(1) NOT NULL,
  `codigo_contable` varchar(10) NOT NULL,
  `codigo_contable_subfijo` varchar(2) DEFAULT NULL,
  `ciclo_produccion_id` varchar(100) DEFAULT '0',
  `fecha` date NOT NULL,
  `nickname_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT '0',
  `procesador_id` int(11) DEFAULT '0',
  `caja_id` int(11) DEFAULT '0',
  `plataforma_id` int(11) DEFAULT '0',
  `master_id` int(11) DEFAULT '0',
  `modelo_id` int(11) DEFAULT '0',
  `debito` decimal(20,10) NOT NULL,
  `credito` decimal(20,10) NOT NULL,
  `json` longtext NOT NULL,
  `estatus` int(1) DEFAULT '1',
  `estado_ciclo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `sys_arl` (
  `id` int(10) UNSIGNED NOT NULL,
  `razon_social_arl` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `cod_minproteccion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nit` int(11) NOT NULL,
  `div_` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_bancos` (
  `banco_id` int(10) UNSIGNED NOT NULL,
  `Entidad` varchar(51) COLLATE utf8_spanish2_ci NOT NULL,
  `Nit` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `DV` int(11) NOT NULL,
  `Direccion` varchar(62) COLLATE utf8_spanish2_ci NOT NULL,
  `Ciudad` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `Departamento` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `Telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO `sys_bancos` (`banco_id`, `Entidad`, `Nit`, `DV`, `Direccion`, `Ciudad`, `Departamento`, `Telefono`) VALUES
(1, 'Banco Agrario de Colombia S.A.', '800037800', 8, 'Carrera 8 # 15 - 43', 'Bogotá', 'Cundinamarca', '(+57 1) 3821400'),
(2, 'Banco Caja Social BCSC S.A.', '860007335', 4, 'Carrera 7 # 77- 65, Torre Colmena', 'Bogotá', 'Cundinamarca', '(+57 1) 3138000'),
(3, 'Banco Colpatria Multibanca Colpatria S.A.', '860034594', 1, 'Carrera 7 # 24 - 89, Piso # 10', 'Bogotá', 'Cundinamarca', '(+57 1) 3386300'),
(4, 'Banco Comercial AV Villas S.A.', '860035827', 5, 'Carrera 13 # 27- 47', 'Bogotá', 'Cundinamarca', '(+57 1) 2875411'),
(5, 'Banco Compartir S.A', '860025971', 5, 'Calle 16 # 6 - 66, Edificio Avianca P.H.', 'Bogotá', 'Cundinamarca', '(+57 1) 2868609'),
(6, 'Banco Coomeva S.A.', '900406150', 5, 'Calle 13 # 57 - 50, Piso # 2', 'Cali', 'Valle del Cauca', '(+57 2) 3330000'),
(7, 'Banco Cooperativo Coopcentral S.A.', '890203088', 9, 'Avenida Calle 116 # 23 - 06, Edificio Business Center 116 P.H.', 'Bogotá', 'Cundinamarca', '(+57 1) 7431088'),
(8, 'Banco Davivienda S.A.', '860034313', 7, 'Avenida el Dorado # 68 C -61, Piso # 10', 'Bogotá', 'Cundinamarca', '(+57 1) 3300000'),
(9, 'Banco de BogotÃ¡ S.A.', '860002964', 4, 'Calle 36 # 7 - 47', 'Bogotá', 'Cundinamarca', '(+57 1) 3383396'),
(10, 'Banco de las Microfinanzas BancamÃ­a S.A.', '900215071', 1, 'Carrera 9 # 66 - 25', 'Bogotá', 'Cundinamarca', '(+57 1) 3139300'),
(11, 'Banco de Occidente S.A.', '890300279', 4, 'Carrera 4 # 7- 61, Piso # 15', 'Cali', 'Valle del Cauca', '(+57 2) 8861111'),
(12, 'Banco Falabella S.A.', '900047981', 8, 'Avenida 19 # 120 - 71, Piso # 3', 'Bogotá', 'Cundinamarca', '(+57 1) 5878787'),
(13, 'Banco Finandina S.A.', '860051894', 6, 'Kilometro 17 VÃ­a ChÃ­a', 'Chía', 'Cundinamarca', '(+57 1) 6511919'),
(14, 'Banco GNB Sudameris Colombia S.A.', '860050750', 1, 'Carrera 7 # 75 - 85', 'Bogotá', 'Cundinamarca', '(+57 1) 2750000'),
(15, 'Banco ITAU Corpbanca Colombia S.A.', '890903937', 0, 'Carrera 7 # 99 - 53', 'Bogotá', 'Cundinamarca', '(+57 1) 6448500'),
(16, 'Banco Multibank S.A', '860024414', 1, 'Carrera 7 # 73 - 47, Piso # 6', 'Bogotá', 'Cundinamarca', '(+57 1) 3256600'),
(17, 'Banco Mundo Mujer S.A.', '900768933', 8, 'Carrera 11 # 5 - 56', 'Popayán', 'Cauca', '(+57 2) 8399900'),
(18, 'Banco Pichincha S.A.', '890200756', 7, 'Carrera 35 # 42 - 39', 'Bucaramanga', 'Santander', '(+57 7) 6800299'),
(19, 'Banco Popular S.A.', '860007738', 9, 'Calle 17 # 7- 35', 'Bogotá', 'Cundinamarca', '(+57 1) 3395500'),
(20, 'Banco ProCredit Colombia S.A.', '900200960', 9, 'Avenida Calle 39 # 13 A - 16', 'Bogotá', 'Cundinamarca', '(+57 1) 5978480'),
(21, 'Banco Santander de Negocios Colombia S.A.', '900628110', 3, 'Calle 93 A # 13 - 24, Piso # 4', 'Bogotá', 'Cundinamarca', '(+57 1) 7434222'),
(22, 'Banco W S.A.', '900378212', 2, 'Avenida 5 Norte # 16 N - 57, Piso # 4', 'Cali', 'Valle del Cauca', '(+57 2) 6083947'),
(23, 'Bancolombia S.A.', '890903938', 8, 'Carrera 48 # 26 - 85, Avenida Los Industriales', 'Medellín', 'Antioquia', '(+57 4) 4040000'),
(24, 'BBVA Banco Bilbao Vizcaya Argentaria S.A.', '860003020', 1, 'Carrera 9 # 72 - 21', 'Bogotá', 'Cundinamarca', '(+57 1) 3471600'),
(25, 'Citibank Colombia S.A.', '860051135', 4, 'Carrera 9A # 99 - 02, Piso # 3', 'Bogotá', 'Cundinamarca', '(+57 1) 6394069');
CREATE TABLE `sys_caja_comp` (
  `caja_compensacion_id` int(11) NOT NULL,
  `razon_social_caja_comp` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `cod_minproteccion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nit` int(11) NOT NULL,
  `div_` varchar(62) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_codigos_cup` (
  `id` int(11) NOT NULL,
  `seccion` varchar(50) NOT NULL,
  `capitulo` varchar(150) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE `sys_eps` (
  `eps_id` int(11) NOT NULL,
  `razon_social_eps` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `cod_minproteccion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `NIT` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `DV` int(11) NOT NULL,
  `Direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_estado_civil` (
  `estado_civil_id` int(11) NOT NULL,
  `Estado` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `sys_gastos_generales` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_gasto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `retencion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `iva` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `admon` int(11) NOT NULL,
  `contrapartida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_iva` (
  `id` int(10) UNSIGNED NOT NULL,
  `detalle` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `valor` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo_transaccion` int(1) NOT NULL,
  `tabla_afectada` varchar(100) NOT NULL,
  `registro_afectado_id` int(11) DEFAULT NULL,
  `modulo_donde_produjo_cambio` varchar(250) DEFAULT 'NULL',
  `accion` int(1) NOT NULL,
  `json` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `sys_municipios` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(6) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` varchar(27) COLLATE utf8_spanish2_ci NOT NULL,
  `departamento` varchar(56) COLLATE utf8_spanish2_ci NOT NULL,
  `union_` varchar(70) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_otros_ingresos` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Retencion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `iva` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `contabiliza` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_paises_mundo` (
  `pais_id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `pais` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_profesiones` (
  `profesion_id` int(10) UNSIGNED NOT NULL,
  `profesion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_puc` (
  `id` int(10) UNSIGNED NOT NULL,
  `grupo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `subtipo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `codigo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cuenta` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_retenciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `familia` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `detalle` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `valor_base_retencion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_roles` (
  `rol_id` int(11) NOT NULL,
  `json` longtext NOT NULL,
  `json_edit` longtext NOT NULL,
  `json_add` longtext NOT NULL,
  `estado` int(1) DEFAULT '1',
  `type_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `sys_roles_modulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `modulo_padre` int(11) NOT NULL,
  `modulo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `order_` int(11) DEFAULT NULL,
  `ico` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `session_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `sys_tipo_contrato` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_contrato` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_tipo_identidad` (
  `tipo_identidad_id` int(11) NOT NULL,
  `tipo_identidad` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_tipo_usuario` (
  `type_id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `sys_trm` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `sys_und_medida` (
  `id` int(10) UNSIGNED NOT NULL,
  `abreviacion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `equivale` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `unidad_equivalencia` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `login` varchar(40) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `intentos_errados` int(1) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `cf_ciclos_pagos`
  ADD PRIMARY KEY (`ciclos_id`),
  ADD KEY `mae_cliente_joberp_cf_ciclos_pagos` (`empresa_id`);
ALTER TABLE `mae_administrativo`
  ADD PRIMARY KEY (`id`,`tipo_identidad_id`,`empresa_id`,`eps_id`,`caja_compensacion_id`),
  ADD KEY `mae_cliente_joberp_mae_administrativo` (`empresa_id`),
  ADD KEY `sys_eps_mae_administrativo` (`eps_id`),
  ADD KEY `sys_caja_comp_mae_administrativo` (`caja_compensacion_id`);
ALTER TABLE `mae_asociado`
  ADD PRIMARY KEY (`id`,`tipo_identidad_id`,`eps_id`,`caja_compensacion_id`),
  ADD KEY `sys_tipo_identidad_mae_asociado` (`tipo_identidad_id`),
  ADD KEY `sys_eps_mae_asociado` (`eps_id`),
  ADD KEY `sys_caja_comp_mae_asociado` (`caja_compensacion_id`);
ALTER TABLE `mae_calendario`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `mae_centro_costo`
  ADD PRIMARY KEY (`id`,`empresa_id`),
  ADD KEY `mae_cliente_joberp_mae_centro_costo` (`empresa_id`);
ALTER TABLE `mae_cliente`
  ADD PRIMARY KEY (`id`,`tipo_identidad_id`,`empresa_id`),
  ADD KEY `sys_tipo_identidad_mae_cliente` (`tipo_identidad_id`),
  ADD KEY `mae_cliente_joberp_mae_cliente` (`empresa_id`);
ALTER TABLE `mae_cliente_joberp`
  ADD PRIMARY KEY (`empresa_id`),
  ADD KEY `mae_cliente_joberp_mae_cliente_joberp` (`empresa_id1`);
ALTER TABLE `mae_cuenta_bancaria`
  ADD PRIMARY KEY (`id`,`empresa_id`,`banco_id`),
  ADD KEY `mae_cliente_joberp_mae_cuenta_bancaria` (`empresa_id`),
  ADD KEY `sys_bancos_mae_cuenta_bancaria` (`banco_id`);
ALTER TABLE `mae_forma_de_pago`
  ADD PRIMARY KEY (`id`,`empresa_id`),
  ADD KEY `mae_cliente_joberp_mae_forma_de_pago` (`empresa_id`);
ALTER TABLE `mae_inventario`
  ADD PRIMARY KEY (`id`,`empresa_id`),
  ADD KEY `mae_cliente_joberp_mae_inventario` (`empresa_id`);
ALTER TABLE `mae_pes_inventario`
  ADD PRIMARY KEY (`id`,`empresa_id`),
  ADD KEY `mae_cliente_joberp_mae_pes_inventario` (`empresa_id`);
ALTER TABLE `mae_proveedores`
  ADD PRIMARY KEY (`id`,`tipo_identidad_id`,`empresa_id`),
  ADD KEY `sys_tipo_identidad_mae_proveedores` (`tipo_identidad_id`),
  ADD KEY `mae_cliente_joberp_mae_proveedores` (`empresa_id`);
ALTER TABLE `mae_usuarios_empleados`
  ADD PRIMARY KEY (`id`,`tipo_identidad_id`,`empresa_id`,`estado_civil_id`,`eps_id`,`caja_compensacion_id`),
  ADD KEY `sys_tipo_identidad_mae_usuarios_empleados` (`tipo_identidad_id`),
  ADD KEY `mae_cliente_joberp_mae_usuarios_empleados` (`empresa_id`),
  ADD KEY `sys_estado_civil_mae_usuarios_empleados` (`estado_civil_id`),
  ADD KEY `sys_eps_mae_usuarios_empleados` (`eps_id`),
  ADD KEY `sys_caja_comp_mae_usuarios_empleados` (`caja_compensacion_id`);
ALTER TABLE `op_links`
  ADD PRIMARY KEY (`id_op_link`);
ALTER TABLE `rp_operaciones`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_arl`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_bancos`
  ADD PRIMARY KEY (`banco_id`);
ALTER TABLE `sys_caja_comp`
  ADD PRIMARY KEY (`caja_compensacion_id`);
ALTER TABLE `sys_codigos_cup`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_eps`
  ADD PRIMARY KEY (`eps_id`);
ALTER TABLE `sys_estado_civil`
  ADD PRIMARY KEY (`estado_civil_id`);
ALTER TABLE `sys_gastos_generales`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_iva`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_logs`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `usuarios_sys_logs` (`user_id`);
ALTER TABLE `sys_municipios`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_otros_ingresos`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_paises_mundo`
  ADD PRIMARY KEY (`pais_id`);
ALTER TABLE `sys_profesiones`
  ADD PRIMARY KEY (`profesion_id`);
ALTER TABLE `sys_puc`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_retenciones`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_roles`
  ADD PRIMARY KEY (`rol_id`);
ALTER TABLE `sys_roles_modulos`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_session`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `usuarios_sys_session` (`user_id`);
ALTER TABLE `sys_tipo_contrato`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_tipo_identidad`
  ADD PRIMARY KEY (`tipo_identidad_id`);
ALTER TABLE `sys_tipo_usuario`
  ADD PRIMARY KEY (`type_id`);
ALTER TABLE `sys_trm`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sys_und_medida`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`,`empresa_id`,`type_id`),
  ADD KEY `mae_cliente_joberp_usuarios` (`empresa_id`),
  ADD KEY `sys_tipo_usuario_usuarios` (`type_id`);
ALTER TABLE `cf_ciclos_pagos`
  ADD CONSTRAINT `mae_cliente_joberp_cf_ciclos_pagos` FOREIGN KEY (`empresa_id`) REFERENCES `mae_cliente_joberp` (`empresa_id`);
ALTER TABLE `mae_administrativo`
  ADD CONSTRAINT `mae_cliente_joberp_mae_administrativo` FOREIGN KEY (`empresa_id`) REFERENCES `mae_cliente_joberp` (`empresa_id`),
  ADD CONSTRAINT `sys_caja_comp_mae_administrativo` FOREIGN KEY (`caja_compensacion_id`) REFERENCES `sys_caja_comp` (`caja_compensacion_id`),
  ADD CONSTRAINT `sys_eps_mae_administrativo` FOREIGN KEY (`eps_id`) REFERENCES `sys_eps` (`eps_id`);
ALTER TABLE `mae_asociado`
  ADD CONSTRAINT `sys_caja_comp_mae_asociado` FOREIGN KEY (`caja_compensacion_id`) REFERENCES `sys_caja_comp` (`caja_compensacion_id`),
  ADD CONSTRAINT `sys_eps_mae_asociado` FOREIGN KEY (`eps_id`) REFERENCES `sys_eps` (`eps_id`),
  ADD CONSTRAINT `sys_tipo_identidad_mae_asociado` FOREIGN KEY (`tipo_identidad_id`) REFERENCES `sys_tipo_identidad` (`tipo_identidad_id`);
ALTER TABLE `mae_centro_costo`
  ADD CONSTRAINT `mae_cliente_joberp_mae_centro_costo` FOREIGN KEY (`empresa_id`) REFERENCES `mae_cliente_joberp` (`empresa_id`);
ALTER TABLE `mae_cliente`
  ADD CONSTRAINT `mae_cliente_joberp_mae_cliente` FOREIGN KEY (`empresa_id`) REFERENCES `mae_cliente_joberp` (`empresa_id`),
  ADD CONSTRAINT `sys_tipo_identidad_mae_cliente` FOREIGN KEY (`tipo_identidad_id`) REFERENCES `sys_tipo_identidad` (`tipo_identidad_id`);
ALTER TABLE `mae_cliente_joberp`
  ADD CONSTRAINT `mae_cliente_joberp_mae_cliente_joberp` FOREIGN KEY (`empresa_id1`) REFERENCES `mae_cliente_joberp` (`empresa_id`);
ALTER TABLE `mae_cuenta_bancaria`
  ADD CONSTRAINT `mae_cliente_joberp_mae_cuenta_bancaria` FOREIGN KEY (`empresa_id`) REFERENCES `mae_cliente_joberp` (`empresa_id`),
  ADD CONSTRAINT `sys_bancos_mae_cuenta_bancaria` FOREIGN KEY (`banco_id`) REFERENCES `sys_bancos` (`banco_id`);
ALTER TABLE `mae_forma_de_pago`
  ADD CONSTRAINT `mae_cliente_joberp_mae_forma_de_pago` FOREIGN KEY (`empresa_id`) REFERENCES `mae_cliente_joberp` (`empresa_id`);
ALTER TABLE `mae_inventario`
  ADD CONSTRAINT `mae_cliente_joberp_mae_inventario` FOREIGN KEY (`empresa_id`) REFERENCES `mae_cliente_joberp` (`empresa_id`);
ALTER TABLE `mae_pes_inventario`
  ADD CONSTRAINT `mae_cliente_joberp_mae_pes_inventario` FOREIGN KEY (`empresa_id`) REFERENCES `mae_cliente_joberp` (`empresa_id`);
ALTER TABLE `mae_proveedores`
  ADD CONSTRAINT `mae_cliente_joberp_mae_proveedores` FOREIGN KEY (`empresa_id`) REFERENCES `mae_cliente_joberp` (`empresa_id`),
  ADD CONSTRAINT `sys_tipo_identidad_mae_proveedores` FOREIGN KEY (`tipo_identidad_id`) REFERENCES `sys_tipo_identidad` (`tipo_identidad_id`);
ALTER TABLE `mae_usuarios_empleados`
  ADD CONSTRAINT `mae_cliente_joberp_mae_usuarios_empleados` FOREIGN KEY (`empresa_id`) REFERENCES `mae_cliente_joberp` (`empresa_id`),
  ADD CONSTRAINT `sys_caja_comp_mae_usuarios_empleados` FOREIGN KEY (`caja_compensacion_id`) REFERENCES `sys_caja_comp` (`caja_compensacion_id`),
  ADD CONSTRAINT `sys_eps_mae_usuarios_empleados` FOREIGN KEY (`eps_id`) REFERENCES `sys_eps` (`eps_id`),
  ADD CONSTRAINT `sys_estado_civil_mae_usuarios_empleados` FOREIGN KEY (`estado_civil_id`) REFERENCES `sys_estado_civil` (`estado_civil_id`),
  ADD CONSTRAINT `sys_tipo_identidad_mae_usuarios_empleados` FOREIGN KEY (`tipo_identidad_id`) REFERENCES `sys_tipo_identidad` (`tipo_identidad_id`);
ALTER TABLE `sys_logs`
ADD CONSTRAINT `usuarios_sys_logs` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`);
ALTER TABLE `sys_session`
ADD CONSTRAINT `usuarios_sys_session` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`);

ALTER TABLE `usuarios`
  ADD CONSTRAINT `mae_cliente_joberp_usuarios` FOREIGN KEY (`empresa_id`) REFERENCES `mae_cliente_joberp` (`empresa_id`),
  ADD CONSTRAINT `sys_tipo_usuario_usuarios` FOREIGN KEY (`type_id`) REFERENCES `sys_tipo_usuario` (`type_id`);
COMMIT;
