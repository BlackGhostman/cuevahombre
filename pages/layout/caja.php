<?php include '../layout/header.php'; ?>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../layout/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../layout/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../layout/plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../layout/dist/css/skins/_all-skins.min.css">
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include '../layout/main_sidebar.php';?>

        <!-- top navigation -->
       <?php include '../layout/top_nav.php';?>
       <style>
        .page-title {
            margin-bottom: 20px;
        }
        .page-title h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .page-title p {
            font-size: 16px;
            color: #6c757d;
        }
        .summary-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            color: #6c757d;
        }
        .summary-card .value {
            font-size: 28px;
            font-weight: 700;
            color: #343a40;
        }
        .summary-card .status.operative {
            color: #28a745;
        }
        .table-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: 600;
            text-transform: capitalize;
        }
        .status-badge.abierto {
            background-color: #e9f7ef;
            color: #28a745;
        }
        .status-badge.cerrado {
            background-color: #f8f9fa;
            color: #6c757d;
        }
        .table thead th {
            text-transform: uppercase;
            color: #6c757d;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody tr {
            border-bottom: 1px solid #f1f1f1;
        }
        .table tbody tr:last-child {
            border-bottom: none;
        }
        .table tbody td {
            vertical-align: middle;
        }
        .right_col {
            background-color: #f8f9fa !important;
        }
       </style>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title">
                <h1>Gestión de Cajas</h1>
                <p>Supervisa y administra las aperturas y cierres de caja.</p>
            </div>

            <?php
            // --- Lógica de cálculo de caja --- //
            $caja_abierta_id = 0;
            if ($caja_cont > 0) {
                $caja_id_query = mysqli_query($con, "SELECT id_caja FROM caja WHERE estado = 'abierto' AND Id_Sucursal = $id_sucursal ORDER BY id_caja DESC LIMIT 1");
                if ($row_id = mysqli_fetch_array($caja_id_query)) {
                    $caja_abierta_id = $row_id['id_caja'];
                }
            }
            $gastos_query = mysqli_query($con, "SELECT IFNULL(SUM(cantidad), 0) AS gastos FROM gastos g JOIN caja c ON CAST(g.fecha AS DATE) >= CAST(c.fecha_apertura AS DATE) WHERE c.estado = 'abierto' AND c.Id_Sucursal = $id_sucursal");
            $gastos_row = mysqli_fetch_array($gastos_query);
            $gastos_del_dia = $gastos_row['gastos'];
            $monto_final_caja = $monto_apertura + $ventas_efectivo - $gastos_del_dia;
            ?>

            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="summary-card">
                        Ventas en Efectivo (Caja Abierta)
                        <div class="value"><?php echo $simbolo_moneda; ?><?php echo number_format($ventas_efectivo, 2, ',', '.'); ?></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="summary-card">
                        Caja Abierta Actual
                        <div class="value">#<?php echo $caja_cont > 0 ? $caja_abierta_id : 'N/A'; ?></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="summary-card">
                        Estado General
                        <div class="value status operative"><?php echo $caja_cont > 0 ? 'Operativo' : 'Cerrado'; ?></div>
                    </div>
                </div>
            </div>

            <!-- Modales -->
            <div class="modal fade" id="miModalcajacerrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="caja_close.php" enctype="multipart/form-data" class="form-horizontal">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Cerrar Caja</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="monto">Monto Final en Caja</label>
                                    <input type="text" class="form-control" id="monto" name="monto" value="<?php echo $monto_final_caja; ?>" readonly>
                                    <p class="help-block">Este es el monto calculado. ¿Desea continuar con el cierre?</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" name="guardar">Confirmar Cierre</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="miModalcaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="caja_add.php" enctype="multipart/form-data" class="form-horizontal">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Abrir Caja</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="monto_inicial">Monto Inicial</label>
                                    <input type="text" class="form-control" id="monto_inicial" name="monto" placeholder="Monto de Apertura" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <div class="row search-bar">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="🔍 Buscar por ID o estado...">
                    </div>
                    <div class="col-md-6 text-right">
                        <?php if ($caja_cont == 0): ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#miModalcaja">Abrir Caja</button>
                        <?php else: ?>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#miModalcajacerrar">Cerrar Caja</button>
                        <?php endif; ?>
                    </div>
                </div>

                <table id="example22" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Apertura</th>
                            <th>Fecha Cierre</th>
                            <th>Estado</th>
                            <th>Monto Final</th>
                            <th>Monto Apertura</th>
                            <th>Efectivo</th>
                            <th>Otros Métodos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($con, "SELECT id_caja, estado, monto, fecha_apertura, fecha_cierre, Monto_Apertura, Monto_Efectivo, Monto_NoContado FROM caja WHERE Id_Sucursal = $id_sucursal ORDER BY id_caja DESC LIMIT 10") or die(mysqli_error($con));
                        while ($row = mysqli_fetch_array($query)) {
                            $estado_class = strtolower($row['estado']);
                        ?>
                            <tr>
                                <td><b><?php echo $row['id_caja']; ?></b></td>
                                <td><?php echo date('Y-m-d', strtotime($row['fecha_apertura'])); ?></td>
                                <td><?php echo $row['fecha_cierre'] ? date('Y-m-d', strtotime($row['fecha_cierre'])) : '-'; ?></td>
                                <td><span class="status-badge <?php echo $estado_class; ?>"><?php echo $row['estado']; ?></span></td>
                                <td><?php echo $simbolo_moneda; ?><?php echo number_format((float)$row['monto'], 2, ',', '.'); ?></td>
                                <td><?php echo $simbolo_moneda; ?><?php echo number_format((float)$row['Monto_Apertura'], 2, ',', '.'); ?></td>
                                <td><?php echo $simbolo_moneda; ?><?php echo number_format((float)$row['Monto_Efectivo'], 2, ',', '.'); ?></td>
                                <td><?php echo $simbolo_moneda; ?><?php echo number_format((float)$row['Monto_NoContado'], 2, ',', '.'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right"></div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  <?php include '../layout/datatable_script.php';?>
  </body>
</html>