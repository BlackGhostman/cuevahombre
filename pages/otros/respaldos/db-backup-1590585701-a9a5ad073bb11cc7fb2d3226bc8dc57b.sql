DROP TABLE IF EXISTS caja;

CREATE TABLE `caja` (
  `id_caja` int(200) NOT NULL AUTO_INCREMENT,
  `estado` varchar(200) NOT NULL,
  `monto` varchar(200) NOT NULL,
  `fecha_apertura` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  PRIMARY KEY (`id_caja`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO caja VALUES("1","abierto","990","2020-05-24","0000-00-00");



DROP TABLE IF EXISTS categoria_gastos;

CREATE TABLE `categoria_gastos` (
  `id_cat_gastos` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id_cat_gastos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO categoria_gastos VALUES("2","colegiatura");



DROP TABLE IF EXISTS categoria_ingresos;

CREATE TABLE `categoria_ingresos` (
  `id_cat_ingresos` int(200) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id_cat_ingresos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO categoria_ingresos VALUES("1","sfdsdfsf");



DROP TABLE IF EXISTS configuracion;

CREATE TABLE `configuracion` (
  `id_configuracion` int(200) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(1000) NOT NULL,
  `servicios1` varchar(200) NOT NULL,
  `servicios2` varchar(200) NOT NULL,
  `servicios3` varchar(200) NOT NULL,
  `mision` varchar(1000) NOT NULL,
  `imagen_galeria1` varchar(200) NOT NULL,
  `imagen_galeria2` varchar(200) NOT NULL,
  `vision` varchar(1000) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `google_maps` varchar(5000) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  PRIMARY KEY (`id_configuracion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO configuracion VALUES("1","GOYMAR SERVICIOS GENERALES S.R.L"," Conexiones de Agua y Desagüe como contratista.","Obras de Saneamiento.","Subcontratos de Obras de Construcción ."," Ser la empresa contratista lï¿½der en construcciï¿½n, enfrentando nuevos retos, ofreciendo un servicio de calidad en: Estudios, Proyectos y ejecuciï¿½n de Obra de Construcciï¿½n en General, satisfaciendo las necesidades de nuestros clientes del sector pï¿½blico y privado, para ello trabajamos y construimos con responsabilidad, honestidad, calidad y cuidando nuestro medio ambiente. .","pelu1.jpg","pelu2.jpg","Alcanzar en el sector de la construcciï¿½n un destacado liderazgo apoyado en la mï¿½s alta tecnologï¿½a y capital humano base primordial para su desarrollo y posicionamiento. ","Av. J. Velasco Alvarado Mza E- Lote 4- La boya Camanï¿½- Camanï¿½ ï¿½ Arequipa Cel: 964994094- 980195872 ","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30584.49704594896!2d-72.72868365155294!3d-16.62365069444902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x914101e020118733%3A0xeebe6bc8a1bee4fb!2sHotel+de+Turistas!5e0!3m2!1ses!2spe!4v1562982130402!5m2!1ses!2spe","https://www.facebook.com/comprayventacodigofuente","https://twitter.com/tusolutionweb");



DROP TABLE IF EXISTS detalles_pedido;

CREATE TABLE `detalles_pedido` (
  `id_detalles` int(200) NOT NULL AUTO_INCREMENT,
  `id_pedido` varchar(200) NOT NULL,
  `id_producto` int(200) NOT NULL,
  `cantidad` varchar(200) NOT NULL,
  `id_cliente` int(200) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_detalles`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO detalles_pedido VALUES("1","1","1","1","15","2020-05-24"),
("2","2","1","2","15","2020-05-24"),
("3","3","5","30","15","2020-05-26"),
("4","4","1","1","16","2020-05-27"),
("5","5","1","1","16","2020-05-27");



DROP TABLE IF EXISTS empresa;

CREATE TABLE `empresa` (
  `id_empresa` int(100) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(200) NOT NULL,
  `ruc` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `descripcion` varchar(2000) NOT NULL,
  `imagen` varchar(2000) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `moneda` varchar(200) NOT NULL,
  `simbolo_moneda` varchar(200) NOT NULL,
  `impuesto_producto` float NOT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO empresa VALUES("1","peluqueria tusolutionweb","354355","av san jeroronimo","935142132","rubro de ventas","logo.jpg","tusolutionweb@gmail.com","Nuevo sol","S/","5");



DROP TABLE IF EXISTS gastos;

CREATE TABLE `gastos` (
  `id_gastos` int(200) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `categoria` int(100) NOT NULL,
  PRIMARY KEY (`id_gastos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO gastos VALUES("1","2020-05-21","1231","111","2");



DROP TABLE IF EXISTS history_log;

CREATE TABLE `history_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=latin1;

INSERT INTO history_log VALUES("1","1","has logged in the system at ","2018-11-27 07:58:26"),
("2","1","has logged out the system at ","2018-11-27 07:59:03"),
("3","1","has logged in the system at ","2018-11-30 22:32:20"),
("4","6","has logged in the system at ","2018-12-01 20:28:15"),
("13","1","has logged out the system at ","2018-11-30 22:42:36"),
("14","1","has logged in the system at ","2018-12-04 11:12:37"),
("15","1","has logged in the system at ","2018-12-19 10:16:00"),
("16","1","has logged in the system at ","2018-12-19 10:21:46"),
("17","1","has logged in the system at ","2018-12-19 10:27:32"),
("18","1","has logged in the system at ","2018-12-19 10:33:11"),
("19","1","se ha desconectado el sistema en ","2018-12-19 10:39:49"),
("20","1","has logged in the system at ","2018-12-19 10:40:01"),
("21","1","se ha desconectado el sistema en ","2018-12-19 10:40:04"),
("22","1","has logged in the system at ","2018-12-19 10:42:35"),
("23","1","se ha desconectado el sistema en ","2018-12-19 10:42:44"),
("24","1","has logged in the system at ","2018-12-19 10:43:07"),
("25","1","se ha desconectado el sistema en ","2018-12-19 10:44:35"),
("26","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-14 10:55:46"),
("27","1","se ha desconectado el sistema en ","2019-01-14 11:02:35"),
("28","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-14 11:02:41"),
("29","1","se ha desconectado el sistema en ","2019-01-14 11:09:15"),
("30","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-16 21:05:23"),
("31","1","se ha desconectado el sistema en ","2019-01-16 21:05:32"),
("32","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-16 21:06:19"),
("33","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-16 21:09:39"),
("34","1","se ha desconectado el sistema en ","2019-01-16 21:12:48"),
("35","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-16 21:12:52"),
("36","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-16 22:33:53"),
("37","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-17 08:50:57"),
("38","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-17 22:37:23"),
("39","1","se ha desconectado el sistema en ","2019-01-18 01:25:04"),
("40","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-18 03:35:56"),
("41","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-18 08:25:58"),
("42","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-18 20:31:12"),
("43","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-19 06:39:38"),
("44","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-20 01:27:24"),
("45","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-20 01:43:21"),
("46","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-20 02:56:46"),
("47","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-20 10:44:05"),
("48","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-20 11:13:20"),
("49","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-21 11:27:47"),
("50","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-23 01:38:33"),
("51","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-23 07:15:31"),
("52","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-23 10:39:09"),
("53","1","ha iniciado sesiÃ³n en el sistema en ","2019-01-23 20:39:13"),
("54","1","se ha desconectado el sistema en ","2019-01-24 01:32:13"),
("55","1","se ha desconectado el sistema en ","2019-01-24 01:46:48"),
("56","1","se ha desconectado el sistema en ","2019-01-24 01:48:41"),
("57","1","se ha desconectado el sistema en ","2019-01-24 01:48:52"),
("58","1","se ha desconectado el sistema en ","2019-01-24 01:49:01"),
("59","1","se ha desconectado el sistema en ","2019-01-24 01:52:37"),
("60","1","se ha desconectado el sistema en ","2019-01-24 01:55:52"),
("61","1","se ha desconectado el sistema en ","2019-01-24 02:50:25"),
("62","1","se ha desconectado el sistema en ","2019-01-25 18:59:42"),
("63","1","se ha desconectado el sistema en ","2019-01-26 12:13:01"),
("64","1","se ha desconectado el sistema en ","2019-01-26 12:39:03"),
("65","1","se ha desconectado el sistema en ","2019-01-26 21:34:43"),
("66","1","se ha desconectado el sistema en ","2019-01-26 21:35:05"),
("67","1","se ha desconectado el sistema en ","2019-01-26 21:36:18"),
("68","1","se ha desconectado el sistema en ","2019-01-26 21:37:19"),
("69","1","se ha desconectado el sistema en ","2019-01-26 21:40:18"),
("70","1","se ha desconectado el sistema en ","2019-01-26 21:42:37"),
("71","2","se ha desconectado el sistema en ","2019-01-26 21:53:27"),
("72","3","se ha desconectado el sistema en ","2019-01-26 23:53:55"),
("73","2","se ha desconectado el sistema en ","2019-01-27 00:02:46"),
("74","3","se ha desconectado el sistema en ","2019-01-27 00:26:04"),
("75","3","se ha desconectado el sistema en ","2019-01-27 00:27:37"),
("76","4","se ha desconectado el sistema en ","2019-01-27 00:28:53"),
("77","0","se ha desconectado el sistema en ","2019-02-01 10:49:35"),
("78","1","se ha desconectado el sistema en ","2019-02-02 01:10:46"),
("79","1","se ha desconectado el sistema en ","2019-02-08 13:27:52"),
("80","1","se ha desconectado el sistema en ","2019-02-08 13:29:04"),
("81","1","se ha desconectado el sistema en ","2019-02-11 12:13:25"),
("82","1","se ha desconectado el sistema en ","2019-02-17 23:59:49"),
("83","1","se ha desconectado el sistema en ","2019-02-19 22:06:23"),
("84","1","se ha desconectado el sistema en ","2019-02-25 00:30:32"),
("85","1","se ha desconectado el sistema en ","2019-02-27 11:45:10"),
("86","1","se ha desconectado el sistema en ","2019-02-28 05:20:10"),
("87","1","se ha desconectado el sistema en ","2019-03-04 01:08:23"),
("88","1","se ha desconectado el sistema en ","2019-03-04 07:27:54"),
("89","3","se ha desconectado el sistema en ","2019-03-04 07:28:35"),
("90","1","se ha desconectado el sistema en ","2019-03-04 07:37:53"),
("91","3","se ha desconectado el sistema en ","2019-03-04 10:41:27"),
("92","1","se ha desconectado el sistema en ","2019-03-05 10:17:44"),
("93","3","se ha desconectado el sistema en ","2019-03-05 10:17:54"),
("94","1","se ha desconectado el sistema en ","2019-03-05 12:54:15"),
("95","3","se ha desconectado el sistema en ","2019-03-05 12:56:25"),
("96","3","se ha desconectado el sistema en ","2019-03-05 13:15:01"),
("97","1","se ha desconectado el sistema en ","2019-03-05 21:34:11"),
("98","1","se ha desconectado el sistema en ","2019-03-05 22:56:40"),
("99","1","se ha desconectado el sistema en ","2019-03-06 09:09:23"),
("100","1","se ha desconectado el sistema en ","2019-03-06 09:19:54"),
("101","3","se ha desconectado el sistema en ","2019-03-06 09:32:54"),
("102","1","se ha desconectado el sistema en ","2019-03-07 08:06:32"),
("103","1","se ha desconectado el sistema en ","2019-03-08 13:47:16"),
("104","3","se ha desconectado el sistema en ","2019-03-08 14:13:56"),
("105","1","se ha desconectado el sistema en ","2019-03-08 14:32:58"),
("106","1","se ha desconectado el sistema en ","2019-03-08 23:57:14"),
("107","1","se ha desconectado el sistema en ","2019-03-09 03:23:22"),
("108","6","se ha desconectado el sistema en ","2019-03-09 04:49:54"),
("109","1","se ha desconectado el sistema en ","2019-03-09 04:53:28"),
("110","6","se ha desconectado el sistema en ","2019-03-09 05:07:58"),
("111","1","se ha desconectado el sistema en ","2019-03-09 05:10:25"),
("112","6","se ha desconectado el sistema en ","2019-03-09 05:12:26"),
("113","1","se ha desconectado el sistema en ","2019-03-09 07:41:10"),
("114","1","se ha desconectado el sistema en ","2019-03-09 12:58:12"),
("115","1","se ha desconectado el sistema en ","2019-03-09 23:58:32"),
("116","1","se ha desconectado el sistema en ","2019-03-09 23:59:19"),
("117","1","se ha desconectado el sistema en ","2019-03-09 23:59:27"),
("118","1","se ha desconectado el sistema en ","2019-03-10 00:00:22"),
("119","1","se ha desconectado el sistema en ","2019-03-10 00:00:34"),
("120","1","se ha desconectado el sistema en ","2019-03-10 01:33:16"),
("121","5","se ha desconectado el sistema en ","2019-03-10 01:46:17"),
("122","5","se ha desconectado el sistema en ","2019-03-10 05:54:18"),
("123","5","se ha desconectado el sistema en ","2019-03-11 12:37:07"),
("124","5","se ha desconectado el sistema en ","2019-03-11 13:12:30"),
("125","1","se ha desconectado el sistema en ","2019-03-12 04:02:11"),
("126","1","se ha desconectado el sistema en ","2019-03-12 08:26:01"),
("127","3","se ha desconectado el sistema en ","2019-03-12 08:38:10"),
("128","1","se ha desconectado el sistema en ","2019-03-12 09:10:43"),
("129","5","se ha desconectado el sistema en ","2019-03-12 12:33:46"),
("130","0","se ha desconectado el sistema en ","2019-03-12 12:51:49"),
("131","5","se ha desconectado el sistema en ","2019-03-31 19:59:15"),
("132","5","se ha desconectado el sistema en ","2019-04-02 11:38:59"),
("133","5","se ha desconectado el sistema en ","2019-04-04 11:41:47"),
("134","5","se ha desconectado el sistema en ","2019-04-04 16:01:10"),
("135","0","se ha desconectado el sistema en ","2019-04-05 18:15:40"),
("136","5","se ha desconectado el sistema en ","2019-04-06 10:36:44"),
("137","5","se ha desconectado el sistema en ","2019-04-13 12:32:33"),
("138","5","se ha desconectado el sistema en ","2019-04-15 11:45:20"),
("139","5","se ha desconectado el sistema en ","2019-04-15 21:55:45"),
("140","5","se ha desconectado el sistema en ","2019-04-15 22:13:42"),
("141","5","se ha desconectado el sistema en ","2019-04-16 11:58:00"),
("142","5","se ha desconectado el sistema en ","2019-04-16 18:48:57"),
("143","5","se ha desconectado el sistema en ","2019-04-16 22:39:40"),
("144","5","se ha desconectado el sistema en ","2019-04-16 23:41:18"),
("145","5","se ha desconectado el sistema en ","2019-04-17 21:20:15"),
("146","5","se ha desconectado el sistema en ","2019-04-17 21:28:21"),
("147","5","se ha desconectado el sistema en ","2019-04-18 09:40:21"),
("148","5","se ha desconectado el sistema en ","2019-04-18 20:00:53"),
("149","0","se ha desconectado el sistema en ","2019-04-18 20:00:59"),
("150","5","se ha desconectado el sistema en ","2019-04-18 23:16:01"),
("151","5","se ha desconectado el sistema en ","2019-04-18 23:16:38"),
("152","5","se ha desconectado el sistema en ","2019-04-19 07:47:43"),
("153","5","se ha desconectado el sistema en ","2019-04-21 09:08:54"),
("154","5","se ha desconectado el sistema en ","2019-04-21 19:56:32"),
("155","7","se ha desconectado el sistema en ","2019-04-21 22:30:24"),
("156","5","se ha desconectado el sistema en ","2019-04-22 23:02:23"),
("157","5","se ha desconectado el sistema en ","2019-04-22 23:37:21"),
("158","5","se ha desconectado el sistema en ","2019-04-23 11:40:35"),
("159","5","se ha desconectado el sistema en ","2019-05-01 12:04:50"),
("160","5","se ha desconectado el sistema en ","2019-05-02 10:12:30"),
("161","5","se ha desconectado el sistema en ","2019-05-02 12:30:32"),
("162","5","se ha desconectado el sistema en ","2019-05-04 12:10:46"),
("163","5","se ha desconectado el sistema en ","2019-05-04 22:20:56"),
("164","5","se ha desconectado el sistema en ","2019-05-07 22:22:45"),
("165","5","se ha desconectado el sistema en ","2019-05-07 22:24:13"),
("166","8","se ha desconectado el sistema en ","2019-05-08 12:37:35"),
("167","8","se ha desconectado el sistema en ","2019-05-08 12:37:46"),
("168","5","se ha desconectado el sistema en ","2019-05-08 16:44:07"),
("169","5","se ha desconectado el sistema en ","2019-06-14 20:32:26"),
("170","5","se ha desconectado el sistema en ","2019-06-14 20:32:59"),
("171","5","se ha desconectado el sistema en ","2019-06-17 12:46:29"),
("172","5","se ha desconectado el sistema en ","2019-06-18 20:28:48"),
("173","5","se ha desconectado el sistema en ","2019-06-19 12:37:10"),
("174","5","se ha desconectado el sistema en ","2019-06-25 22:06:36"),
("175","5","se ha desconectado el sistema en ","2019-06-25 22:36:28"),
("176","5","se ha desconectado el sistema en ","2019-06-26 10:59:22"),
("177","5","se ha desconectado el sistema en ","2019-09-13 23:00:56"),
("178","5","se ha desconectado el sistema en ","2019-09-13 23:23:25"),
("179","11","se ha desconectado el sistema en ","2019-09-13 23:29:53"),
("180","5","se ha desconectado el sistema en ","2019-09-13 23:32:07"),
("181","5","se ha desconectado el sistema en ","2019-09-16 12:06:18"),
("182","5","se ha desconectado el sistema en ","2019-09-16 16:15:48"),
("183","11","se ha desconectado el sistema en ","2019-09-16 16:34:17"),
("184","5","se ha desconectado el sistema en ","2019-09-16 16:34:35"),
("185","5","se ha desconectado el sistema en ","2019-09-16 16:34:44"),
("186","5","se ha desconectado el sistema en ","2019-09-16 16:34:59"),
("187","11","se ha desconectado el sistema en ","2019-09-16 16:38:11"),
("188","5","se ha desconectado el sistema en ","2019-09-16 16:38:57"),
("189","11","se ha desconectado el sistema en ","2019-09-16 17:22:07"),
("190","14","se ha desconectado el sistema en ","2019-09-16 17:23:01"),
("191","5","se ha desconectado el sistema en ","2019-09-16 17:24:05"),
("192","5","se ha desconectado el sistema en ","2019-09-16 17:25:47"),
("193","14","se ha desconectado el sistema en ","2019-09-16 17:25:58"),
("194","5","se ha desconectado el sistema en ","2019-09-16 17:27:54"),
("195","5","se ha desconectado el sistema en ","2020-02-06 10:56:48"),
("196","5","se ha desconectado el sistema en ","2020-05-20 12:37:02"),
("197","5","se ha desconectado el sistema en ","2020-05-23 04:25:28"),
("198","5","se ha desconectado el sistema en ","2020-05-23 04:26:41"),
("199","5","se ha desconectado el sistema en ","2020-05-23 04:47:17"),
("200","5","se ha desconectado el sistema en ","2020-05-24 01:03:29"),
("201","5","se ha desconectado el sistema en ","2020-05-24 01:06:01"),
("202","5","se ha desconectado el sistema en ","2020-05-24 01:06:04"),
("203","5","se ha desconectado el sistema en ","2020-05-24 21:22:50"),
("204","5","se ha desconectado el sistema en ","2020-05-25 06:31:45"),
("205","5","se ha desconectado el sistema en ","2020-05-26 04:03:59"),
("206","5","se ha desconectado el sistema en ","2020-05-26 23:25:08"),
("207","16","se ha desconectado el sistema en ","2020-05-27 04:26:58");



DROP TABLE IF EXISTS ingresos;

CREATE TABLE `ingresos` (
  `id_ingresos` int(200) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `cantidad` varchar(200) NOT NULL,
  `categoria` int(200) NOT NULL,
  PRIMARY KEY (`id_ingresos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO ingresos VALUES("1","2020-05-30","gdfgdfg","200","1");



DROP TABLE IF EXISTS pedidos;

CREATE TABLE `pedidos` (
  `id_pedido` int(200) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_sesion` int(100) NOT NULL,
  `id_cliente` int(200) NOT NULL,
  `monto_pagado` float NOT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO pedidos VALUES("1","2020-05-24","5","15","40"),
("2","2020-05-24","5","15","80"),
("3","2020-05-26","5","15","900"),
("4","2020-05-27","5","16","40"),
("5","2020-05-27","5","16","40");



DROP TABLE IF EXISTS producto;

CREATE TABLE `producto` (
  `id_pro` int(100) NOT NULL AUTO_INCREMENT,
  `nombre_pro` varchar(100) NOT NULL,
  `descripcion` varchar(2000) NOT NULL,
  `unidad` varchar(100) NOT NULL,
  `precio_venta` float NOT NULL,
  `precio_compra` float NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `stock` varchar(200) NOT NULL,
  `estado` varchar(200) NOT NULL,
  PRIMARY KEY (`id_pro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO producto VALUES("1","Aceitilina","adsasd","filtro","40","30","bug bony no.jpg","5","a"),
("2","CELULAR SAMSUNG J7 duo","celular ","celular","700","0","","10","d"),
("3","SDFS","SFDSF","SDFS","7","0","","20","d"),
("4","dgdfgdfgd","","fsd","1","32","","3","d"),
("5","GEL PARA CANELLO","SFDSF","GEL","30","20","VENTAS.webp","4","a");



DROP TABLE IF EXISTS reserva;

CREATE TABLE `reserva` (
  `id_reserva` int(200) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(200) NOT NULL,
  `fechaactual` date NOT NULL,
  `fechareserva` date NOT NULL,
  `hora` varchar(200) NOT NULL,
  `estado` varchar(200) NOT NULL,
  PRIMARY KEY (`id_reserva`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO reserva VALUES("1","5","2020-05-24","2020-05-27","21:02","");



DROP TABLE IF EXISTS temporal_reporte;

CREATE TABLE `temporal_reporte` (
  `id_temporal` int(200) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` varchar(200) NOT NULL,
  `fecha_final` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  PRIMARY KEY (`id_temporal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO temporal_reporte VALUES("1","2020-01-31","2020-02-08","servicios");



DROP TABLE IF EXISTS usuario;

CREATE TABLE `usuario` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO usuario VALUES("5","admin","a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3","4.jpg","administrador","rickun","fdf","","tusolutionweb@gmail.com"),
("15","sars","a1Bz20ydqelm8m1wqle1589ff014bbe86a6d0b10f8bfa8aab5","oton von bismark.jpg","cliente","sars","caribaldi","243234","tusolutionweb@gmail.com");



