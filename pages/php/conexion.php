<?php
	include_once('config.php');
	class Conexion{
		public function conectar(){
			$conexion = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conexion;
		}
	}

$conexion = new Conexion();
$base_de_datos = $conexion->conectar();
?>