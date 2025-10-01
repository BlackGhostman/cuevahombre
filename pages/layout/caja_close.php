<?php
session_start();
include('../../dist/includes/dbcon.php');
date_default_timezone_set("America/Costa_Rica");
	//$branch=$_SESSION['branch'






     $fecha_cierre = date('Y-m-d');



$id_sucursal;
	 
	 if (!isset($_SESSION['barberia'])) {
		header('Location:../../index.php');
	 }
	 else{
		$id_sucursal = $_SESSION['barberia'];


	 }





  mysqli_query($con,"update caja set estado='cerrado',
fecha_cierre=ObtenerUltimaFechaApertura($id_sucursal),  
monto = ObtenerMontoUltimaFechaApertura($id_sucursal)
where estado='abierto' and Id_Sucursal = $id_sucursal")or die(mysqli_error());


	echo "<script>document.location='caja.php'</script>";	










	
?>
