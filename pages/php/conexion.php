<?php
	include_once('config.php');
	class Model{
		protected $db;
		public function __construct(){
			$this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if($this->db->connect_errno){
				exit();
			}
			$this->db->set_charset(DB_CHARSET);
		}
	}

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