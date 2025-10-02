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
                    $caja_cont = 0;
                    $acumulado = 0;
                    $id_sucursal = $_SESSION['barberia'] ?? null;

                    if (!$id_sucursal) {
                        header('Location:../../index.php');
                        exit();
                    }

                    $caja_query = mysqli_query($con, "SELECT
                        z.id_caja, z.estado, IFNULL(z.Todo, 0) AS monto, z.fecha_apertura, z.fecha_cierre, z.Monto_Apertura,
                        IFNULL(z.Contado, 0) AS Monto_Efectivo, IFNULL(z.noContado, 0) AS Monto_NoContado, z.Id_Sucursal,
                        IFNULL(z.noContado, 0) AS noContado, IFNULL(z.gastos, 0) AS gastos
                        FROM (
                            SELECT *,
                                (SELECT IFNULL(SUM(monto_pagado), 0) FROM pedidos WHERE CAST(fecha AS DATE) >= CAST(c.fecha_apertura AS DATE) AND Id_Sucursal = $id_sucursal) AS Todo,
                                (SELECT IFNULL(SUM(monto_pagado), 0) FROM pedidos WHERE id_cat_ingresos = 1 AND CAST(fecha AS DATE) >= CAST(c.fecha_apertura AS DATE) AND Id_Sucursal = $id_sucursal) AS Contado,
                                (SELECT IFNULL(SUM(monto_pagado), 0) FROM pedidos WHERE id_cat_ingresos <> 1 AND CAST(fecha AS DATE) >= CAST(c.fecha_apertura AS DATE) AND Id_Sucursal = $id_sucursal) AS noContado,
                                (SELECT IFNULL(SUM(cantidad), 0) FROM gastos WHERE CAST(fecha AS DATE) >= CAST(c.fecha_apertura AS DATE) AND Id_Sucursal = $id_sucursal) AS gastos
                            FROM caja AS c
                            WHERE c.estado = 'abierto' AND Id_Sucursal = $id_sucursal
                        ) AS z;") or die(mysqli_error($con));

                    if ($row_caja = mysqli_fetch_array($caja_query)) {
                        $caja_cont = 1;
                        $MontoTotal = $row_caja['monto'];
                        $NoContado = $row_caja['noContado'];
                        $Gastos = $row_caja['gastos'];
                        $acumulado = $MontoTotal - ($NoContado + $Gastos);
                    }

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
                                    MONTO - APERT= <label style='color:black; font-size: 25px'><?php echo "$simbolo_moneda $acumulado $moneda"; ?></label>
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
                                    <input type="text" class="form-control" id="monto" name="monto" value="<?php echo $acumulado; ?>" readonly>
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
                        $query = mysqli_query($con, "SELECT id_caja, estado, monto, fecha_apertura, fecha_cierre, Monto_Apertura, IFNULL(z.Contado,0) as Monto_Efectivo, IFNULL(z.noContado,0) as Monto_NoContado, Id_Sucursal
                            FROM (
                                SELECT *,
                                (SELECT sum(monto_pagado) FROM pedidos WHERE id_cat_ingresos = 1 AND CAST(fecha as DATE) = CAST(c.fecha_apertura as DATE) AND Id_Sucursal = $id_sucursal) as Contado,
                                (SELECT sum(monto_pagado) FROM pedidos WHERE id_cat_ingresos <> 1 AND CAST(fecha as DATE) = CAST(c.fecha_apertura as DATE) AND Id_Sucursal = $id_sucursal) as noContado
                                FROM caja c WHERE Id_Sucursal = $id_sucursal ORDER BY id_caja DESC LIMIT 10
                            ) as z ORDER BY id_caja DESC;") or die(mysqli_error($con));
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