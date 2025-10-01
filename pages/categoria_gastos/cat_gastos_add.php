<?php
session_start();
include('../../dist/includes/dbcon.php');
	//$branch=$_SESSION['branch'];
	$nombre = $_POST['nombre'];




	$query2=mysqli_query($con,"select * from categoria_gastos where nombre='$nombre'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('categoria ya existe!');</script>";
			echo "<script>document.location='cat_gastos.php'</script>";
		}
		else
		{

		mysqli_query($con,"INSERT INTO categoria_gastos(nombre)
				VALUES('$nombre')")or die(mysqli_error($con));

			
			echo "<script>document.location='cat_gastos.php'</script>";

		}
?>
