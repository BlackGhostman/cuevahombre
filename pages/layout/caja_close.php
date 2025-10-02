<?php
session_start();
include('../../dist/includes/dbcon.php');
date_default_timezone_set("America/Costa_Rica");

if (!isset($_SESSION['barberia'])) {
    header('Location:../../index.php');
    exit();
}

$id_sucursal = $_SESSION['barberia'];
$fecha_cierre = date('Y-m-d H:i:s');
$monto_final = 0;

// 1. Obtener la fecha de apertura de la caja abierta
$caja_abierta_query = mysqli_query($con, "SELECT fecha_apertura, Monto_Apertura FROM caja WHERE estado='abierto' AND Id_Sucursal = '$id_sucursal' ORDER BY id_caja DESC LIMIT 1");
if ($caja_abierta = mysqli_fetch_assoc($caja_abierta_query)) {
    $fecha_apertura = $caja_abierta['fecha_apertura'];
    $monto_apertura = $caja_abierta['Monto_Apertura'];

    // 2. Calcular el total de ventas en efectivo desde la apertura
    $ventas_query = mysqli_query($con, "SELECT IFNULL(SUM(monto_pagado), 0) AS total_efectivo FROM pedidos WHERE id_cat_ingresos = 1 AND fecha >= '$fecha_apertura' AND Id_Sucursal = '$id_sucursal'");
    $ventas = mysqli_fetch_assoc($ventas_query);
    $total_efectivo = $ventas['total_efectivo'];

    // 3. Calcular el total de gastos desde la apertura
    $gastos_query = mysqli_query($con, "SELECT IFNULL(SUM(cantidad), 0) AS total_gastos FROM gastos WHERE fecha >= '$fecha_apertura' AND Id_Sucursal = '$id_sucursal'");
    $gastos = mysqli_fetch_assoc($gastos_query);
    $total_gastos = $gastos['total_gastos'];
    
    // 4. Calcular el monto final en caja
    $monto_final = ($monto_apertura + $total_efectivo) - $total_gastos;

    // 5. Actualizar la caja a 'cerrado' con los montos y fecha correctos
    $update_query = "UPDATE caja SET 
                        estado = 'cerrado',
                        fecha_cierre = '$fecha_cierre',
                        monto = '$monto_final',
                        Monto_Efectivo = '$total_efectivo'
                    WHERE estado = 'abierto' AND Id_Sucursal = '$id_sucursal'";
    
    mysqli_query($con, $update_query) or die(mysqli_error($con));

    echo "<script>document.location='caja.php'</script>";
} else {
    // No hay caja abierta, simplemente redirigir
    echo "<script>alert('No se encontró ninguna caja abierta para cerrar.'); document.location='caja.php'</script>";
}
?>