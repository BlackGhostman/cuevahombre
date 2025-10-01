


<?php session_start();
if(empty($_SESSION['id'])):
endif;
include('../../dist/includes/dbcon.php');
	
	$id_ingresos = $_POST['id_ingresos'];
		$fecha = $_POST['fecha'];
	$descripcion = $_POST['descripcion'];

	$cantidad = $_POST['cantidad'];

	$categoria = $_POST['categoria'];
;



	mysqli_query($con,"update ingresos set fecha='$fecha',descripcion='$descripcion',cantidad='$cantidad',categoria='$categoria' where id_ingresos='$id_ingresos'")or die(mysqli_error());

	echo "<script type='text/javascript'>alert('ingresos actualizado correctamente!');</script>";
	echo "<script>document.location='ingresos.php'</script>";
	


?>
