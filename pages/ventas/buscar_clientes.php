<?php
include '../php/conexion.php';

header('Content-Type: application/json');

$term = isset($_GET['term']) ? $_GET['term'] . '%' : '%';

try {
    $stmt = $base_de_datos->prepare("SELECT id, nombre_completo AS nombre FROM usuario WHERE (nombre_completo LIKE ?) AND tipo = 'cliente'");
    $stmt->execute([$term]);
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($clientes);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
