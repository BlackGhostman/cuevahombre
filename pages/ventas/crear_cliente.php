<?php
include '../php/conexion.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['nombre'])) {
    echo json_encode(['success' => false, 'message' => 'El nombre del cliente es requerido.']);
    exit();
}

$nombre_completo = $data['nombre'];
$telefono = isset($data['telefono']) ? $data['telefono'] : null;
$cumpleanos = isset($data['cumpleanos']) ? $data['cumpleanos'] : null;
$tipo = 'cliente';

try {
    $stmt = $base_de_datos->prepare("INSERT INTO usuario (nombre_completo, tipo, telefono, cumpleanos) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre_completo, $tipo, $telefono, $cumpleanos]);
    $newClientId = $base_de_datos->lastInsertId();

    echo json_encode(['success' => true, 'id' => $newClientId, 'nombre' => $nombre_completo]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al crear el cliente: ' . $e->getMessage()]);
}
?>
