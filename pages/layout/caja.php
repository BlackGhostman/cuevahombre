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
        label{ color: black; }
        li { color: white; }
        ul { color: white; }
        #buscar{ text-align: right; }
       </style>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="box-header">
                <h3 class="box-title"> MENU</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <?php
                    // Las variables de la caja ($caja_cont, $monto_apertura, $ventas_efectivo, etc.) 
                    // ya se calculan en top_nav.php, por lo que no es necesario volver a consultarlas aquí.
                    $acumulado = $ventas_efectivo; // Para el botón de 'Ventas en Efectivo'

                    // Calculamos los gastos para el modal de cierre
                    $gastos_query = mysqli_query($con, "SELECT IFNULL(SUM(cantidad), 0) AS gastos FROM gastos g JOIN caja c ON CAST(g.fecha AS DATE) >= CAST(c.fecha_apertura AS DATE) WHERE c.estado = 'abierto' AND c.Id_Sucursal = $id_sucursal");
                    $gastos_row = mysqli_fetch_array($gastos_query);
                    $gastos_del_dia = $gastos_row['gastos'];
                    $monto_final_caja = $monto_apertura + $ventas_efectivo - $gastos_del_dia;

                    if ($caja_cont == 0) {
                    ?>
                        <button type="button" class="btn btn-danger btn-lg btn-print" data-toggle="modal" data-target="#miModalcaja">ABRIR CAJA</button>
                    <?php
                    } else {
                    ?>
                        <button type="button" class="btn btn-danger btn-lg btn-print" data-toggle="modal" data-target="#miModalcajacerrar">CERRAR CAJA</button>
                        <div class="row">
                            <div class="col-md-4 col-lg-12 hide-section">
                                <a class="btn btn-danger btn-print" disabled="true" style="height:25%; width:50%; font-size: 25px" role="button">
                                    Ventas en Efectivo= <label style='color:black; font-size: 25px'><?php echo "$simbolo_moneda $ventas_efectivo $moneda"; ?></label>
                                </a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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

            <div class="box-header">
                <h3 class="box-title"> LISTA DE CAJAS</h3>
            </div>
            <div class="box-body">
                <table ID="example22" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Apertura</th>
                            <th>Fecha Cierre</th>
                            <th>Estado</th>
                            <th>Monto</th>
                            <th>Apertura</th>
                            <th>Efectivo</th>
                            <th>Otros Métodos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // --- CORRECCIÓN AQUÍ ---
                        $query = mysqli_query($con, "
                            SELECT 
                                id_caja, 
                                estado, 
                                monto, 
                                fecha_apertura, 
                                fecha_cierre, 
                                Monto_Apertura, 
                                Monto_Efectivo, 
                                Monto_NoContado, 
                                Id_Sucursal
                            FROM caja
                            WHERE Id_Sucursal = $id_sucursal 
                            ORDER BY id_caja DESC 
                            LIMIT 10
                        ") or die(mysqli_error($con));
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $row['id_caja']; ?></td>
                                <td><?php echo $row['fecha_apertura']; ?></td>
                                <td><?php echo $row['fecha_cierre']; ?></td>
                                <td><?php echo $row['estado']; ?></td>
                                <td><?php echo $row['monto']; ?></td>
                                <td><?php echo $row['Monto_Apertura']; ?></td>
                                <td><?php echo $row['Monto_Efectivo']; ?></td>
                                <td><?php echo $row['Monto_NoContado']; ?></td>
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