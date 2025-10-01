 <?php
session_start();
include('../layout/dbcon.php');
date_default_timezone_set("America/Costa_Rica");
	//$branch=$_SESSION['branch'];

	$monto_pagado = $_POST['monto_pagado'];
	$idventa = $_POST['idventa'];

	

   $fecha_pago = date('Y-m-d');



		///finzalizo encriptacion


	/*mysqli_query($con,"update ingreso set monto_pagado='$monto_pagado'  where idingreso='$idingreso'")or die(mysqli_error());
*/
			



					mysqli_query($con,"INSERT INTO credito(idventa,fecha_pago,total_pago)
				VALUES('$idventa','$fecha_pago','$monto_pagado')")or die(mysqli_error($con));


	echo "<script type='text/javascript'>alert(' actualizado correctamente!');</script>";
  echo "<script>document.location='../ventas/lista_ventas.php'</script>";



	




   







?>
