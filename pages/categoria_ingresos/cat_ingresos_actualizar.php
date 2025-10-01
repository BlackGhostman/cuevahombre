


<?php session_start();
if(empty($_SESSION['id'])):
endif;
include('../../dist/includes/dbcon.php');
	
	$id_cat_ingresos = $_POST['id_cat_ingresos'];
		$nombre = $_POST['nombre'];



	mysqli_query($con,"update categoria_ingresos set nombre='$nombre' where id_cat_ingresos='$id_cat_ingresos'")or die(mysqli_error());

	echo "<script type='text/javascript'>alert('categoria actualizada correctamente!');</script>";
	echo "<script>document.location='cat_ingresos.php'</script>";
	


?>
