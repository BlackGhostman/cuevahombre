DROP TABLE IF EXISTS caja;

CREATE TABLE `caja` (
  `id_caja` int(200) NOT NULL AUTO_INCREMENT,
  `estado` varchar(200) NOT NULL,
  `monto` varchar(200) NOT NULL,
  `fecha_apertura` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  PRIMARY KEY (`id_caja`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO caja VALUES("2","cerrado","21300","2022-07-18","2022-07-18"),
("3","cerrado","36800","2022-07-19","2022-07-19"),
("4","cerrado","33300","2022-07-20","2022-07-21"),
("5","cerrado","22300","2022-07-21","2022-07-22"),
("6","cerrado","45300","2022-07-22","2022-07-23"),
("7","cerrado","56800","2022-07-23","2022-07-24"),
("8","cerrado","46650","2022-07-25","2022-07-25"),
("9","cerrado","47650","2022-07-26","2022-07-27"),
("10","cerrado","30350","2022-07-27","2022-07-27"),
("11","cerrado","27650","2022-07-28","2022-07-28"),
("12","cerrado","31150","2022-07-29","2022-07-29"),
("13","abierto","56650","2022-07-30","0000-00-00");



DROP TABLE IF EXISTS categoria_gastos;

CREATE TABLE `categoria_gastos` (
  `id_cat_gastos` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id_cat_gastos`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO categoria_gastos VALUES("3","Otros"),
("4","Limpieza"),
("5","Productos"),
("6","Vale"),
("7","Admin");



DROP TABLE IF EXISTS categoria_ingresos;

CREATE TABLE `categoria_ingresos` (
  `id_cat_ingresos` int(200) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id_cat_ingresos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO categoria_ingresos VALUES("1","Efectivo"),
("2","SIMPE");



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

INSERT INTO configuracion VALUES("1","Cueva de Hombre Barbershop","Corte de Cabello","Afeitado","Esculpir Barba","Brindar servicios de alta calidad que satisfagan las necesidades de cada cliente. Con personal profesional, calificado y responsable, nuestros clientes experimentan lo que es estar en un ambiente hogareño y quieren volver a nuestra barbería.","img1.png","img2.jpg","Que nuestros clientes estes satisfechos con su servicio","Residencial Tecno 2000, 25 metros oeste de la entrada principal","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3931.0260397457637!2d-83.90882158538584!3d9.848179792955323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0dfea4956ca35%3A0xa2759277aa506d1e!2sCueva%20de%20Hombre%20Barbershop!5e0!3m2!1ses!2scr!4v1654199469294!5m2!1ses!2scr","https://www.facebook.com/search/top?q=cueva%20de%20hombre%20-%20barbershop","https://twitter.com/");



DROP TABLE IF EXISTS detalles_pedido;

CREATE TABLE `detalles_pedido` (
  `id_detalles` int(200) NOT NULL AUTO_INCREMENT,
  `id_pedido` varchar(200) NOT NULL,
  `id_producto` int(200) NOT NULL,
  `cantidad` varchar(200) NOT NULL,
  `id_cliente` int(200) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_detalles`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

INSERT INTO detalles_pedido VALUES("1","1","5","3","17","2022-07-18"),
("2","2","18","1","20","2022-07-19"),
("3","3","15","1","21","2022-07-19"),
("4","4","11","1000","0","2022-07-19"),
("5","5","15","1","22","2022-07-19"),
("6","6","15","1","22","2022-07-19"),
("7","7","15","2","22","2022-07-19"),
("8","8","11","1","22","2022-07-19"),
("9","9","15","2","22","2022-07-19"),
("10","10","18","1","22","2022-07-20"),
("11","10","15","1","22","2022-07-20"),
("12","11","15","1","23","2022-07-21"),
("13","12","11","1","22","2022-07-21"),
("14","13","15","1","22","2022-07-22"),
("15","14","15","1","22","2022-07-22"),
("16","15","15","1","22","2022-07-22"),
("17","16","15","1","22","2022-07-22"),
("18","17","15","1","22","2022-07-22"),
("19","18","15","2","22","2022-07-22"),
("20","19","22","1","22","2022-07-23"),
("21","20","17","1","22","2022-07-23"),
("22","21","15","1","22","2022-07-23"),
("23","22","19","1","22","2022-07-23"),
("24","23","23","1","22","2022-07-23"),
("25","24","15","1","22","2022-07-23"),
("26","25","21","1","22","2022-07-23"),
("27","26","21","1","22","2022-07-24"),
("28","27","15","1","22","2022-07-24"),
("29","28","15","1","22","2022-07-25"),
("30","29","13","1","22","2022-07-25"),
("31","29","15","1","22","2022-07-25"),
("32","30","15","1","22","2022-07-25"),
("33","31","19","1","22","2022-07-25"),
("34","32","23","1","22","2022-07-25"),
("35","32","15","1","22","2022-07-25"),
("36","33","15","1","22","2022-07-25"),
("37","34","17","1","22","2022-07-26"),
("38","35","17","1","22","2022-07-26"),
("39","36","11","1","22","2022-07-26"),
("40","37","17","1","22","2022-07-26"),
("41","38","21","1","22","2022-07-26"),
("42","39","15","1","22","2022-07-26"),
("43","40","15","1","25","2022-07-27"),
("44","41","19","2","22","2022-07-27"),
("45","42","15","1","22","2022-07-27"),
("46","43","15","1","22","2022-07-27"),
("47","44","15","1","22","2022-07-27"),
("48","45","11","1","22","2022-07-27"),
("49","46","25","1","22","2022-07-28"),
("50","47","15","1","22","2022-07-28"),
("51","48","15","1","22","2022-07-28"),
("52","49","19","2","22","2022-07-28"),
("53","50","25","1","22","2022-07-29"),
("54","51","15","1","22","2022-07-29"),
("55","52","15","1","22","2022-07-29"),
("56","53","15","1","26","2022-07-29"),
("57","54","18","1","22","2022-07-30"),
("58","55","27","1","22","2022-07-30"),
("59","55","15","1","22","2022-07-30"),
("60","56","15","1","22","2022-07-30"),
("61","57","15","1","22","2022-07-30"),
("62","58","15","1","22","2022-07-30"),
("63","59","18","1","22","2022-07-30"),
("64","60","18","1","22","2022-07-30"),
("65","61","17","1","22","2022-07-30");



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

INSERT INTO empresa VALUES("1","Cueva de Hombre Barbershop","354355","Residencial Tecno2000 Cartago, Cartago, Dulce Nombre","86710839","rubro de ventas","202170761_121248603488419_7417805398988415987_n.jpg","ernesto.aguilaar@gmail.com","Colón","¢","13");



DROP TABLE IF EXISTS gastos;

CREATE TABLE `gastos` (
  `id_gastos` int(200) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `categoria` int(100) NOT NULL,
  PRIMARY KEY (`id_gastos`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO gastos VALUES("10","2022-07-25","Vale de david","1000","6"),
("11","2022-07-25","Vale de david","3000","6"),
("12","2022-07-26","pan","1000","3"),
("13","2022-07-26","Vale de david","5300","3"),
("14","2022-07-27","pan","1300","3"),
("15","2022-07-29","pan","1000","3"),
("16","2022-07-30","LAVA PLATOS","500","4");



DROP TABLE IF EXISTS history_log;

CREATE TABLE `history_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO history_log VALUES("1","5","se ha desconectado el sistema en ","2022-07-18 17:34:26"),
("2","5","se ha desconectado el sistema en ","2022-07-26 15:45:51");



DROP TABLE IF EXISTS ingresos;

CREATE TABLE `ingresos` (
  `id_ingresos` int(200) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `cantidad` varchar(200) NOT NULL,
  `categoria` int(200) NOT NULL,
  PRIMARY KEY (`id_ingresos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS pedidos;

CREATE TABLE `pedidos` (
  `id_pedido` int(200) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_sesion` int(100) NOT NULL,
  `id_cliente` int(200) NOT NULL,
  `monto_pagado` float NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_cat_ingresos` int(11) NOT NULL,
  `Descuento` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

INSERT INTO pedidos VALUES("2","2022-07-18","5","20","4500","19","2","0"),
("3","2022-07-18","5","21","3000","19","2","500"),
("4","2022-07-19","5","22","2000","18","1","0"),
("5","2022-07-19","5","22","3500","19","1","0"),
("6","2022-07-19","5","22","3500","19","1","0"),
("7","2022-07-19","5","22","7000","19","1","0"),
("8","2022-07-19","5","22","2000","19","2","0"),
("9","2022-07-19","5","22","7000","19","1","0"),
("10","2022-07-20","5","22","8000","19","1","0"),
("11","2022-07-20","5","23","3000","19","1","500"),
("12","2022-07-21","5","22","2000","18","1","0"),
("13","2022-07-22","5","22","3500","19","1","0"),
("14","2022-07-22","5","22","3500","19","1","0"),
("15","2022-07-22","5","22","3000","19","2","500"),
("16","2022-07-22","5","22","3500","19","2","0"),
("17","2022-07-22","5","22","3500","19","1","0"),
("18","2022-07-22","5","22","6000","19","1","1000"),
("19","2022-07-23","5","22","10000","18","2","0"),
("20","2022-07-23","5","22","5500","19","2","0"),
("21","2022-07-23","5","22","3500","24","1","0"),
("22","2022-07-23","5","22","1000","19","1","0"),
("23","2022-07-23","5","22","2500","19","2","0"),
("24","2022-07-23","5","22","3500","24","1","0"),
("25","2022-07-23","5","22","1500","19","2","0"),
("26","2022-07-24","5","22","1500","18","1","0"),
("27","2022-07-24","5","22","2000","19","2","1500"),
("28","2022-07-25","5","22","3500","19","1","0"),
("29","2022-07-25","5","22","6500","19","2","0"),
("30","2022-07-25","5","22","3500","18","1","0"),
("31","2022-07-25","5","22","1000","19","1","0"),
("32","2022-07-25","5","22","6000","19","2","0"),
("33","2022-07-25","5","22","3500","19","2","0"),
("34","2022-07-26","5","22","5500","19","2","0"),
("36","2022-07-26","5","22","2000","19","1","0"),
("37","2022-07-26","5","22","5500","19","2","0"),
("38","2022-07-26","5","22","1500","19","1","0"),
("39","2022-07-26","5","22","3500","19","1","0"),
("40","2022-07-26","5","25","3000","19","2","500"),
("41","2022-07-27","5","22","2000","19","1","0"),
("42","2022-07-27","5","22","3000","19","2","500"),
("43","2022-07-27","5","22","3500","19","1","0"),
("44","2022-07-27","5","22","3500","19","1","0"),
("45","2022-07-27","5","22","2000","19","1","0"),
("46","2022-07-28","5","22","2500","19","2","0"),
("47","2022-07-28","5","22","3500","19","1","0"),
("48","2022-07-28","5","22","3500","19","2","0"),
("49","2022-07-28","5","22","2000","18","2","0"),
("50","2022-07-29","5","22","2500","19","2","0"),
("51","2022-07-29","5","22","3500","19","1","0"),
("52","2022-07-29","5","22","3500","19","1","0"),
("53","2022-07-29","5","26","3500","19","2","0"),
("54","2022-07-30","5","22","4500","19","2","0"),
("55","2022-07-30","5","22","3500","19","2","0"),
("56","2022-07-30","5","22","3500","19","2","0"),
("57","2022-07-30","5","22","3500","19","1","0"),
("58","2022-07-30","5","22","3000","19","2","500"),
("59","2022-07-30","5","22","4500","19","2","0"),
("60","2022-07-30","5","22","4500","19","2","0"),
("61","2022-07-30","5","22","5500","19","2","0");



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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

INSERT INTO producto VALUES("5","Natura Men Care Bálsamo","Natura Men Care Bálsamo para Barba","Bálsamo","6500","4500","balsamo natura men care.jpg","2","a"),
("6","Edge Tamer H.N.P Cafe","Edge Tamer H.N.P Cafe","Cera","5500","2600","hnpCafe.jpeg","2","a"),
("7","Edge Tamer H.N.P Negra","Edge Tamer H.N.P Negra","Cera","5500","2600","HNP negra.jpg","3","a"),
("11","Corte Cabello Adulto Mayor","Corte Cabello para Adulto Mayor","0","2000","0","215522-340x425-Partido-en-el-lado.jpg","8996","d"),
("12","Cera Ossion Personal Care","Cera Ossion Personal Care","Cera","6500","3800","Cera ossion.jpg","4","a"),
("13","Evok Cera para Cabello","Evok Cera para Cabello","cera","3000","1500","evok cera.jpeg","2","a"),
("14","Nishman spider wax ","Nishman s1 blackwidow spider wax 150ml","1","9000","8000","4603794.jpg","1","a"),
("15","CORTE DE HOMBRE","CORTE DE CABALLERO NORMAL","","3500","0","CORTE HOMBRE.jpg","99962","d"),
("16","Elegance Matte Paste","Elegance Matte Paste 140g","1","9000","8000","elegance-matte-paste_1000x1000.progressive.PNG","1","a"),
("17","CORTE CABALLERO + BARBA COMPLETA","CORTE CABALLERO + BARBA COMPLETA","0","5500","0","CORTE CABALLERO  BARBA COMPLETA.jpg","999995","d"),
("18","CORTE CABALLERO + CONTORNO BARBA","CORTE CABALLERO + CONTORNO BARBA","0","4500","0","CORTE CABALLERO  CONTORNO BARBA.jpg","999995","d"),
("19","MARCADO CEJAS","MARCADO CEJAS","0","1000","0","MARCADO CEJAS.jpg","999994","d"),
("20","Dibujo en Corte","Dibujo en Corte","0","1500","0","dibujo.jpg","1000000","d"),
("21","CONTORNO BARBA","CONTORNO BARBA","0","1500","0","contorno barba.jpg","999997","d"),
("22","Lavado + Planchado","Lavado y planchado de cabello largo","0","10000","0","lavado.jpg","999999","d"),
("23","corte niño","corte niño menos 4años","0","2500","0","descarga.jpg","999998","d"),
("24","corte adolecente ","corte 8años adelante","0","3000","0","corte-de-pelo-degradado-laterales-afilados.jpg","1000000","d"),
("25","estudiastes","corte estudiantes","0","2500","0","Nota-accidentes-escolares_mobile.png","999998","d"),
("26","depilacon de bigote y oidos","depilacon","0","2500","0","depilacion-bigote-cera-tradicional-o-caliente.jpg","1000000","d"),
("27","corte de corte cumpleaños","corte de cortesía","0","0","0","descarga (4).jpg","999999","d"),
("28","ACEITE BARBA","ACEITE DE BARBA","2","7000","4200","natural-chic-men.jpg","4","a");



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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

INSERT INTO usuario VALUES("5","admin","a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3","4.jpg","administrador","Admin","fdf","86710839","cuevadehombre@gmail.com"),
("18","prodriguez","a1Bz20ydqelm8m1wqle10adc3949ba59abbe56e057f20f883e","pame.jpg","empleado","Pamela","Rodriguez","83375495","cuevadehombre@gmail.com"),
("19","daraya","a1Bz20ydqelm8m1wqle10adc3949ba59abbe56e057f20f883e","davi.jpeg","empleado","David","Araya","71436047","cuevadehombre@gmail.com"),
("20","jsanabria","a1Bz20ydqelm8m1wqle10adc3949ba59abbe56e057f20f883e","","cliente","Juan Diego Sanabria","Falta","70888818","algo@gmail.com"),
("21","aguillen","a1Bz20ydqelm8m1wqle10adc3949ba59abbe56e057f20f883e","","cliente","Alejandro Guillen","16 Setiembre","70080684","algo@gmail.com"),
("22","generico","a1Bz20ydqelm8m1wqle10adc3949ba59abbe56e057f20f883e","","cliente","GENERICO","GENERICO","888888888","algo@algo.com"),
("23","marias","a1Bz20ydqelm8m1wqle10adc3949ba59abbe56e057f20f883e","","cliente","Marvin Arias","10 julio","84867720","algo@gmail.com"),
("24","steven","a1Bz20ydqelm8m1wqle10adc3949ba59abbe56e057f20f883e","","empleado","Steven","S","88888880","algo@gmail.com"),
("25","adavanzo","a1Bz20ydqelm8m1wqle10adc3949ba59abbe56e057f20f883e","","cliente","Andres Davanzo","22 de Agosto","88963110","algo@gmail.com"),
("26","pbrenes","a1Bz20ydqelm8m1wqle10adc3949ba59abbe56e057f20f883e","","cliente","Pablo Brenes","25 de Diciembre","85663304","algo@gmail.com");



