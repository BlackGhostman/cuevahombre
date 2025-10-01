
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
          <form method="post" action="reportes_por_fechaImpr.php" enctype="multipart/form-data" class="form-horizontal">
                    
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
                    <button class="btn btn-lg btn-danger btn-print" id="daterange-btn"  name="buscar_fechas">BUSCAR ENTRE FECHAS</button>


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
         <th > Metodo Pago </th>
         <th > Monto Pagado </th>
                 

                      </tr>
                    </thead>
                    <tbody>
                   




<?php
  

 


if(isset($_POST['buscar_fechas']))

{
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_final = $_POST['fecha_final'];
?>

   <?php
   
   $id_sucursal;
	 session_start();
	 if (!isset($_SESSION['barberia'])) {
		header('Location:../../index.php');
	 }
	 else{
		$id_sucursal = $_SESSION['barberia'];


	 }
 $MontoTotal ='';
    $query=mysqli_query($con,"select SUM(monto_pagado) as monto from pedidos  where  fecha >='$fecha_inicio' and fecha <='$fecha_final' and Id_Sucursal = $id_sucursal; ")or die(mysqli_error());
    $contador=0;
    while($row=mysqli_fetch_array($query)){
$contador++;
$MontoTotal = $row['monto'];
    }

?>

  <div class = "row">
        <div class = "col-md-4 col-lg-12 hide-section">
  <a class="btn btn-danger btn-print"    disabled="true" style="height:25%; width:50%; font-size: 25px " role="button">Total <label style='color:black;  font-size: 25px '>=<?php echo $MontoTotal;?></label></a>



</div>

      
</div>

 <?php






    $query=mysqli_query($con,"select p.id_pedido,p.fecha,u.nombre,ci.nombre as forma_pago,p.monto_pagado from pedidos AS p
    INNER JOIN usuario AS u ON u.id = p.id_cliente 
    INNER JOIN categoria_ingresos as ci on ci.id_cat_ingresos = p.id_cat_ingresos 
    where  fecha >='$fecha_inicio' and fecha <='$fecha_final' and p.Id_Sucursal = $id_sucursal; ")or die(mysqli_error());
    $i=1;
    while($row=mysqli_fetch_array($query)){
      $num_pedido=$row['id_pedido'];

?>

                      <tr >
                        <td><?php echo $row['id_pedido'];?></td>
                        <td><?php echo $row['fecha'];?></td>
                        <td><?php echo $row['nombre'];?></td>
                        <td><?php echo $row['forma_pago'];?></td>
                        <td><?php echo $row['monto_pagado'];?></td>
                        
  
                      </tr>

                                          <?php
                      }
                      }
?>


 <!--end of modal-->

                    </tbody>
         







    <footer>
          <div class="pull-right">
                             
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  <?php include '../layout/datatable_script.php';?>
    <!-- /gauge.js -->



          <!--<script>
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
    </script>-->
  </body>
</html>
