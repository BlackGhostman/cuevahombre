


<?php session_start();
if(empty($_SESSION['id'])):
endif;
include('../../dist/includes/dbcon.php');
	
	$id_cat_gastos = $_POST['id_cat_gastos'];
		$nombre = $_POST['nombre'];



	mysqli_query($con,"update categoria_gastos set nombre='$nombre' where id_cat_gastos='$id_cat_gastos'")or die(mysqli_error());

	echo "<script type='text/javascript'>alert('categoria actualizada correctamente!');</script>";
	echo "<script>document.location='cat_gastos.php'</script>";
	


?>
