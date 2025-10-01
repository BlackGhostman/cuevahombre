<?php
echo '<link rel="stylesheet" href="../ventas/css/factura.css">';
if(!isset($_POST["total"])) exit;
include('../layout/dbcon.php');
date_default_timezone_set("America/Costa_Rica");

session_start();

$id_sesion = $_POST["id_sesion"];
$total = $_POST["total"];

$id_cliente = $_POST["cliente"];
if($_POST["cliente"] !== ''){
	$id_cliente = $_POST["cliente"];
	
}
else{
	$id_cliente = '22';
	
}
echo '<script language="javascript">alert("'. $id_cliente .'");</script>';

$monto_pagado = $_POST["total"] - $_POST["descuento"];
$id_Empleado = $_POST["tbBarbero"];
$id_MetodoPago = $_POST["tbMetodo"];
$descuento = $_POST["descuento"];
$id_sucursal = $_SESSION['barberia'];


//echo $id_Empleado;
     $fecha = date('Y-m-d');



//$monto_pagado = $_POST["monto_pagado"];

$sub_total=0;


//$vuelto=$total




$sentencia_pedido = $base_de_datos->prepare("INSERT INTO pedidos(fecha, id_sesion,id_cliente,monto_pagado,id_empleado,id_cat_ingresos,Descuento,Id_Sucursal) VALUES (?, ?, ?,?,?,?,?,$id_sucursal);");
$sentencia_pedido->execute([$fecha, $id_sesion,$id_cliente,$monto_pagado,$id_Empleado,$id_MetodoPago,$descuento]);

$sentencia = $base_de_datos->prepare("SELECT id_pedido FROM pedidos ORDER BY id_pedido DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$id_pedido = $resultado === false ? 1 : $resultado->id_pedido;



$sentencia = $base_de_datos->prepare("SELECT nombre as Empleado FROM usuario WHERE id = '$id_Empleado'  limit 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);
$Empleado = $resultado === false ? 1 : $resultado->Empleado;

$sentencia = $base_de_datos->prepare("SELECT nombre as Cliente FROM usuario WHERE id = '$id_cliente'  limit 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);
$Cliente = $resultado === false ? 1 : $resultado->Cliente;



$sentencia = $base_de_datos->prepare("INSERT INTO detalles_pedido(id_pedido, id_producto, cantidad, id_cliente,fecha) VALUES (?, ?, ?, ?, ?);");
echo '<div class="ticket">';
echo '<img src="http://cuevadehombre.barbercr.net/peluqueria_tusolutionweb/pages/layout/images/202170761_121248603488419_7417805398988415987_n.jpg" alt="Logotipo">';
echo '<table ><caption><strong>CUEVA DE HOMBRE BARBERSHOP</strong></caption>';
echo '<br/><caption><strong>Fecha Factura: ' . $fecha . '</strong></caption>';
echo '<br/><caption><strong>Fue Atendido por: ' . $Empleado . '</strong></caption>';
echo '<br/><caption><strong>Cliente: ' . $Cliente . '</strong></caption>';
echo '<br/><caption><strong>Telefono: 8671 0839 </strong></caption>';
echo '<thead><tr><th>CANT</th><th>PRODUCTO</th><th>PREC</th></tr></thead><tbody>';

foreach ($_SESSION["carrito"] as $producto) {
//	$total += $producto->carrito;
	$sentencia->execute([$id_pedido, $producto->id_producto, $producto->cantidad, $id_cliente,$fecha]);

			$update=mysqli_query($con,"update producto set stock=stock-'$producto->cantidad' where id_pro='$producto->id_producto' ");

			echo '<tr ><td>' . $producto->cantidad . '</td> <td>' . $producto->nombre . '</td> <td>¢' . $producto->total . '</td></tr>';

}
if($descuento != 0){
	echo '<tr><td></td><td>Descuento</td><td>¢' . $descuento . '</td></tr>';
}
echo '<tr><td></td><td>TOTAL</td><td>¢' . $monto_pagado . '</td></tr>';
echo '</tbody></table>';
echo '<p class="centrado">¡GRACIAS POR PREFERIRNOS!</p>';
echo '<div/>';
//$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];

/*
$sentencia11 = $base_de_datos->prepare("SELECT case when sum(monto_pagado) is null then 0 else sum(monto_pagado) END as total_Pagado FROM pedidos where fecha = DATE(NOW()) and id_cat_ingresos = 1 and Id_Sucursal = '$id_sucursal' limit 1;");
$sentencia11->execute();
$Contado = $sentencia11->fetch(PDO::FETCH_OBJ);

$sentencia22 = $base_de_datos->prepare("SELECT case when sum(monto_pagado) is null then 0 else sum(monto_pagado) END as total_Pagado FROM pedidos where fecha = DATE(NOW()) and id_cat_ingresos = 2 and Id_Sucursal = '$id_sucursal'");
$sentencia22->execute();
$NoContado = $sentencia22->fetch(PDO::FETCH_OBJ);

, Monto_Efectivo = $Contado, Monto_NoContado = $NoContado
CALL ActualizarMontosCaja (25000,1)

if($id_MetodoPago = 1){
    $update=mysqli_query($con,"update caja set monto=monto+$monto_pagado ,  Monto_Efectivo = Monto_Efectivo+$monto_pagado   where estado='abierto' and id_Sucursal = $id_sucursal");
}
else{
    $update=mysqli_query($con,"update caja set monto=monto+$monto_pagado ,  Monto_Efectivo = Monto_NoContado+$monto_pagado   where estado='abierto' and id_Sucursal = $id_sucursal");
}
*/


            $update=mysqli_query($con,"CALL ActualizarMontosCaja ($monto_pagado,$id_sucursal)");

			/*$update=mysqli_query($con,"update caja set monto=monto+$monto_pagado   where estado='abierto' and id_Sucursal = $id_sucursal");*/
			echo '<script type="text/javascript"> window.print(); </script>';
			echo '<script type="text/javascript"> setTimeout("ir()",20000); </script>';
  echo "<script>
  function ir(){
  document.location='../ventas/pos.php'
  }
  </script>";


  

?>