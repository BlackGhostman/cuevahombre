
<?php include '../layout/header.php';


?>

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
       <?php include '../layout/top_nav.php';?>      <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class = "x-panel">

            </div>

        </div><!--end of modal-dialog-->
 </div>

 <div class="container">
           <div class="col-md-3">
      
           </div>
           <div class="col-md-3">
             <form method="post" action="reportes_fecha_por_empleado.php" enctype="multipart/form-data" class="form-horizontal">
                    <button class="btn btn-lg btn-danger btn-print" id="daterange-btn"  name="buscar_fechas">BUSCAR ENTRE FECHAS</button>
                    <div class="col-md-12 btn-print">
                      <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Fecha inicio</label>
                        <div class="input-group col-sm-8">
                          <input type="date" class="form-control pull-right" id="date" name="fecha_inicio"  required >
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->
                    </div>
                  <div class="col-md-12 btn-print">
                      <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Fecha final</label>
                        <div class="input-group col-sm-8">
                          <input type="date" class="form-control pull-right" id="date" name="fecha_final"  required >
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->
                  </div>
                  <div class="col-md-12 btn-print">
                      <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Barbero</label>
                        <div class="input-group col-sm-8">
                        <select class="form-control select2" style="width: 200px;"  id="tbBarbero" name="tbBarbero" required>
                            <option value="">Seleccione:</option>
                            <?php          
                              $query = mysqli_query($con,"SELECT * FROM usuario where tipo in('empleado','administrador')")or die(mysqli_error());
                              while ($valores= mysqli_fetch_array($query)) {
                                echo '<option value='.$valores[id].'>'.$valores[nombre].'</option>';


                              }
                              
                            ?>
                          </select>
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->
                  </div>
              

                 




                    <div class="col-md-12">
                       <div class="col-md-12">
                        
                       
                         </div>

                    </div>

          </form>
           </div>
           <div class="col-md-3">
             
           </div>
       </div>
 <!--end of modal-->

                        <div class="box-body">
                  <!-- Date range -->  <section class="content-header">
             
          </section>

 <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Impresión</a>


                  <div class="box-header">
                  <h3 class="box-title"> Lista datos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
  <table id="example2" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th> Id </th>
            <th> Fecha </th>
            <th> Cliente </th>
            <th > Monto </th>
            <th > Descuento </th>
          </tr>
        </thead>
        <tbody>
                   




<?php
  

 


if(isset($_POST['buscar_fechas']))

{
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_final = $_POST['fecha_final'];
  $Barbero = $_POST['tbBarbero'];
?>

   <?php
 $Sumatoria = 0;
    $query=mysqli_query($con,"SELECT p.id_pedido, p.fecha,u.nombre , pr.precio_venta - p.Descuento as monto, p.Descuento FROM pedidos p
                              INNER JOIN detalles_pedido dp on dp.id_pedido = p.id_pedido
                              INNER JOIN producto pr on pr.id_pro = dp.id_producto
                              INNER JOIN usuario u on u.id = p.id_cliente
                              WHERE p.fecha BETWEEN '$fecha_inicio' AND '$fecha_final' and pr.estado = 'd' and p.id_empleado = $Barbero
                              order by p.id_pedido DESC;")or die(mysqli_error());
    $contador=0;
    while($row=mysqli_fetch_array($query)){
      $Sumatoria = $Sumatoria + $row['monto'];
$contador++;
    }

?>

  <div class = "row">
        <div class = "col-md-4 col-lg-12 hide-section">
  <a class="btn btn-danger btn-print"    disabled="true" style="height:25%; width:50%; font-size: 25px " role="button">SUMATORIA <label style='color:black;  font-size: 25px '>=<?php echo $Sumatoria;?></label></a>



</div>

      
</div>

              <?php




                
                
                  $query=mysqli_query($con,"SELECT p.id_pedido, p.fecha,u.nombre, pr.precio_venta - p.Descuento as monto, p.Descuento FROM pedidos p
                                            INNER JOIN detalles_pedido dp on dp.id_pedido = p.id_pedido
                                            INNER JOIN producto pr on pr.id_pro = dp.id_producto
                                            INNER JOIN usuario u on u.id = p.id_cliente
                                            WHERE p.fecha BETWEEN '$fecha_inicio' AND '$fecha_final' and pr.estado = 'd' and p.id_empleado = $Barbero
                  order by p.id_pedido DESC;")or die(mysqli_error());
                  $i=1;
                  while($row=mysqli_fetch_array($query)){
                    $num_pedido=$row['id_pedido'];
                    
              ?>

          <tr >
                  <td><?php echo $row['id_pedido'];?></td>
                  <td><?php echo $row['fecha'];?></td>
                  <td><?php echo $row['nombre'];?></td>
                  <td><?php echo $row['monto'];?></td>
                  <td><?php echo $row['Descuento'];?></td>
            
  
            </tr>

                <?php
                      }
                      }
                ?>



        </tbody>
         







    <footer>
          
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  <?php include '../layout/datatable_script.php';?>
    <!-- /gauge.js -->



          <script>
        $(document).ready( function() {
                $('#example2').dataTable( {
                 "language": {
                   "paginate": {
                      "previous": "anterior",
                      "next": "posterior"
                    },
                    "search": "Buscar:",


                  },

                  "info": false,
                  "lengthChange": false,
                  "searching": false,


                }

              );
              } );
    </script>
  </body>
</html>
