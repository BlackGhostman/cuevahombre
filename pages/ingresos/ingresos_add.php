<?php
session_start();
include('../../dist/includes/dbcon.php');
	//$branch=$_SESSION['branch'];
	$fecha = $_POST['fecha'];
	$descripcion = $_POST['descripcion'];

	$cantidad = $_POST['cantidad'];

	$categoria = $_POST['categoria'];



		mysqli_query($con,"INSERT INTO ingresos(fecha,descripcion,cantidad,categoria)
				VALUES('$fecha','$descripcion','$cantidad','$categoria')")or die(mysqli_error($con));

			
			echo "<script>document.location='ingresos.php'</script>";

		
?>
