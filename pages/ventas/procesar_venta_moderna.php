<?php
include '../php/conexion.php';

@session_start();

date_default_timezone_set('America/Costa_Rica');

header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'No se ha iniciado sesión']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'No se recibieron datos']);
    exit();
}

$id_sesion = $_SESSION['id'];
$id_sucursal = $_SESSION['barberia'];
$id_cliente = !empty($data['id_cliente']) ? $data['id_cliente'] : 22; // Default client
$id_empleado = $data['id_empleado'];
$id_metodo_pago = $data['id_metodo_pago'];
$descuento = $data['descuento'];
$total_venta = $data['total'] - $descuento;
$fecha = date('Y-m-d H:i:s');

try {
    $base_de_datos->beginTransaction();

    // 1. Insertar el pedido
    $sentencia_pedido = $base_de_datos->prepare("INSERT INTO pedidos(fecha, id_sesion, id_cliente, monto_pagado, id_empleado, id_cat_ingresos, Descuento, Id_Sucursal) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
    $sentencia_pedido->execute([$fecha, $id_sesion, $id_cliente, $total_venta, $id_empleado, $id_metodo_pago, $descuento, $id_sucursal]);

    $id_pedido = $base_de_datos->lastInsertId();

    // 2. Insertar detalles y actualizar stock
    $sentencia_detalle = $base_de_datos->prepare("INSERT INTO detalles_pedido(id_pedido, id_producto, cantidad, id_cliente, fecha) VALUES (?, ?, ?, ?, ?);");
    $sentencia_stock = $base_de_datos->prepare("UPDATE producto SET stock = stock - ? WHERE id_pro = ?;");

    foreach ($data['cart'] as $producto) {
        $sentencia_detalle->execute([$id_pedido, $producto['productId'], $producto['quantity'], $id_cliente, $fecha]);
        $sentencia_stock->execute([$producto['quantity'], $producto['productId']]);
    }

    // 3. Actualizar montos de caja
    if ($id_metodo_pago == 1) { // Asumiendo que 1 es Efectivo
        $sql_update_caja = "UPDATE caja SET monto = monto + ?, Monto_Efectivo = Monto_Efectivo + ? WHERE estado = 'abierto' AND Id_Sucursal = ?";
        $sentencia_caja = $base_de_datos->prepare($sql_update_caja);
        $sentencia_caja->execute([$total_venta, $total_venta, $id_sucursal]);
    } else { // Otros métodos de pago
        $sql_update_caja = "UPDATE caja SET monto = monto + ?, Monto_NoContado = Monto_NoContado + ? WHERE estado = 'abierto' AND Id_Sucursal = ?";
        $sentencia_caja = $base_de_datos->prepare($sql_update_caja);
        $sentencia_caja->execute([$total_venta, $total_venta, $id_sucursal]);
    }

    $base_de_datos->commit();

    echo json_encode(['success' => true, 'id_pedido' => $id_pedido]);

} catch (Exception $e) {
    $base_de_datos->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
}