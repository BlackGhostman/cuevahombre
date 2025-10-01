<?php
session_start();
$id_sucursal;

include('../../dist/includes/dbcon.php');
date_default_timezone_set("America/Costa_Rica");
	//$branch=$_SESSION['branch'
	$monto = $_POST['monto'];





     $fecha_apertura = date('Y-m-d');


if (!isset($_SESSION['barberia'])) {
		header('Location:../../index.php');
	 }
	 else{
		$id_sucursal = $_SESSION['barberia'];

				
				
		mysqli_query($con,"INSERT INTO caja(estado,monto,fecha_apertura,fecha_cierre,Monto_Apertura,Monto_Efectivo,Id_Sucursal)
				VALUES('abierto','$monto','$fecha_apertura','','$monto','0',$id_sucursal)")or die(mysqli_error($con));
				
	echo "<script>document.location='caja.php'</script>";	

	 }











	
?>
