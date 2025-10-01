
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

    <style>
        .caja{
            margin: auto;
            max-width: 250px;
            padding: 20px;
            border: 1px solid #BDBDBD;
        }
        .caja select{
            width: 100%;
            font-size: 16px;
            padding: 5px;
        }
        .resultados{
            margin: auto;
            margin-top: 40px;
            width: 1000px;
        }
    </style>

        <!-- page content -->
        <div class="right_col" role="main">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class = "x-panel">

            </div>

        </div><!--end of modal-dialog-->
 </div>




 <div class="container">
        
       </div>

                        <div class="box-body">
                                    <a class = "btn btn-success btn-print" href = "consolidado_docentes.php" ><i class ="glyphicon glyphicon-print"></i> Volver</a>
                                                                        <a class = "btn btn-success btn-print" href = "consolidado_docentes.php"   onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Imprimir</a>
          

                          <?php

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_final'];


  $cantidad_gastos=0;
  $c_total_gastos=0;
    $cantidad_ingresos=0;
  $c_total_ingresos=0;
  $total=0;
    $c_total=0;


?>
  <?php

      $query=mysqli_query($con,"select * from gastos AS g
INNER JOIN categoria_gastos AS c
    ON g.categoria = c.id_cat_gastos  where fecha >='$fecha_inicio' and fecha <='$fecha_fin' ")or die(mysqli_error());
      while($row=mysqli_fetch_array($query)){
      $cantidad_gastos=$row['cantidad']+$cantidad_gastos;
      }
      $c_total_gastos=($cantidad_gastos)/(40);




      $query2=mysqli_query($con,"select * from ingresos AS i
INNER JOIN categoria_ingresos AS c
    ON i.categoria = c.id_cat_ingresos   where fecha >='$fecha_inicio' and fecha <='$fecha_fin' ")or die(mysqli_error());
      while($row2=mysqli_fetch_array($query2)){
      $cantidad_ingresos=$row2['cantidad']+$cantidad_ingresos;
      }
      $c_total_ingresos=($cantidad_ingresos)/(40);


  $total=$cantidad_ingresos-$cantidad_gastos;

   $c_total=($total)/(40);


echo "<center><h1>"."consilidado entre fechas"."</h1></center>"; 


  ?>
                  <!-- Date range -->
                  
<br>
<br>
<br>


        <h4>EGRESOS:       <?php echo $cantidad_gastos?> </h4>
<h4>INGRESOS:       <?php echo $cantidad_ingresos?> </h4>
<h4>TOTAL:       <?php echo $total?> </h4>



          </div>
     <br>
<br>
<br><br>
<br>
<br><br>
<br>
<br><br>
<br>
<br>
 <!--end of modal-->


                  <div class="box-header">

                </div><!-- /.box-header -->
                <div class="box-body">
                

                </div><!-- /.box-body -->

            </div><!-- /.col -->


          </div><!-- /.row -->




                </div><!-- /.box-body -->

            </div>
        </div>
      </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
    <footer>
          <div class="pull-right">
                             <a href="https://ventadecodigofuente.com/">peluqueria tusulutionweb Sys</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>


              <?php 
// }
      # code...
    
?>
    <!-- /gauge.js -->
  </body>
</html>
