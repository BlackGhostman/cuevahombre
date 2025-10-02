<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
$num_pedido=$_GET['num_pedido'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>COMPROBANTE</title>
  <style>
    body {
        color: #000;
    }
    #page-wrap {
        width: 80mm;
        margin: 0 auto;
        font-family: 'Courier New', Courier, monospace;
        font-size: 12px;
    }
    .header {
        text-align: center;
    }
    .header h1 {
        font-size: 16px;
        margin-bottom: 5px;
    }
    .info, .items, .totals {
        margin-top: 15px;
        border-top: 1px dashed #000;
        padding-top: 10px;
    }
    .info p, .totals p {
        margin: 0;
    }
    .items table {
        width: 100%;
        border-collapse: collapse;
    }
    .items th, .items td {
        padding: 5px 0;
        text-align: left;
    }
    .items .qty {
        text-align: center;
    }
    .items .total {
        text-align: right;
    }
    .totals table {
        width: 100%;
    }
    .totals td {
        width: 50%;
        text-align: right;
    }
    .totals .strong {
        font-weight: bold;
    }
    .footer {
        text-align: center;
        margin-top: 20px;
        border-top: 1px dashed #000;
        padding-top: 10px;
    }
    .btn-print {
        display: none;
    }
    @media print {
        .btn-print {
            display: none !important;
        }
        body {
            margin: 0;
        }
    }
  </style>
</head>
<body onload="window.print();">

<?php
include('../../dist/includes/dbcon.php');

$nombre_cliente = 'Genérico';
$telefono_cliente = '';
$fecha = '';
$nombre_vendedor = '';
$empresa = '';
$nit = '';
$id_vendedor = '';

// Fetch order and client details
$query3 = mysqli_query($con, "SELECT p.*, u.nombre_completo, u.telefono FROM pedidos AS p LEFT JOIN usuario AS u ON p.id_cliente = u.id WHERE p.id_pedido='$num_pedido'") or die(mysqli_error($con));
if ($row3 = mysqli_fetch_array($query3)) {
    $nombre_cliente = $row3['nombre_completo'] ?: 'Genérico';
    $telefono_cliente = $row3['telefono'];
    $fecha = date("Y-m-d", strtotime($row3['fecha']));
    $id_vendedor = $row3['id_sesion'];
}

// Fetch seller details
if ($id_vendedor) {
    $query2 = mysqli_query($con, "SELECT nombre_completo FROM usuario WHERE id='$id_vendedor'") or die(mysqli_error($con));
    if ($row2 = mysqli_fetch_array($query2)) {
        $nombre_vendedor = $row2['nombre_completo'];
    }
}

// Fetch company details
$query11 = mysqli_query($con, "SELECT empresa, ruc FROM empresa WHERE id_empresa='1'") or die(mysqli_error($con));
if ($row11 = mysqli_fetch_array($query11)) {
    $empresa = $row11['empresa'];
    $nit = $row11['ruc'];
}
?>

<div id="page-wrap">
    <div class="header">
        <h1><?php echo $empresa; ?></h1>
        <p><?php echo $nit; ?></p>
    </div>

    <div class="info">
        <p><strong>Recibo N°:</strong> <?php echo $num_pedido; ?></p>
        <p><strong>Fecha:</strong> <?php echo $fecha; ?></p>
        <p><strong>Cliente:</strong> <?php echo $nombre_cliente; ?></p>
        <?php if ($telefono_cliente): ?>
            <p><strong>Teléfono:</strong> <?php echo $telefono_cliente; ?></p>
        <?php endif; ?>
        <p><strong>Atendido por:</strong> <?php echo $nombre_vendedor; ?></p>
    </div>

    <div class="items">
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th class="qty">Cant.</th>
                    <th class="total">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_final = 0;
                $query4 = mysqli_query($con, "SELECT p.nombre_pro, t.cantidad, p.precio_venta FROM producto AS p INNER JOIN detalles_pedido AS t ON p.id_pro = t.id_producto WHERE t.id_pedido='$num_pedido'") or die(mysqli_error($con));
                while ($row4 = mysqli_fetch_array($query4)) {
                    $item_total = $row4['precio_venta'] * $row4['cantidad'];
                    $total_final += $item_total;
                ?>
                <tr>
                    <td><?php echo $row4['nombre_pro']; ?></td>
                    <td class="qty"><?php echo $row4['cantidad']; ?></td>
                    <td class="total"><?php echo number_format($item_total, 2); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="totals">
        <table>
            <tr>
                <td class="strong">TOTAL:</td>
                <td class="strong"><?php echo number_format($total_final, 2); ?></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>¡Gracias por su compra!</p>
    </div>
</div>

<a class="btn-print" href="../layout/inicio.php">Volver a la página de inicio</a>

</body>
</html>