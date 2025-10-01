
<?php include '../layout/header.php';
date_default_timezone_set("America/Costa_Rica");

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
label{

color: black;
}
li {
  color: white;
}
ul {
  color: white;
}
#buscar{
  text-align: right;
}
th, td {
font-size: 15px;
text-align: center;
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





               
                               <?php

                             
            $fechaactual = date('Y-m-d');
      $nuevafecha = strtotime ( '-1420 day' , strtotime ( $fechaactual ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
            ?>           
                  <!-- Date range -->
                  <form method="post" action="exportar_gastos.php" enctype="multipart/form-data" class="form-horizontal">
                    <button class="btn btn-lg btn-success btn-print" id="daterange-btn"  name="">EXPORTAR EXCELL</button>
                    <div class="col-md-12 btn-print">
                      <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Fecha inicio</label>
                        <div class="input-group col-sm-8">
                          <input type="date" class="form-control pull-right" id="date" name="fecha_inicio" value="<?php echo $nuevafecha;?>" required >
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->
                    </div>
            <div class="col-md-12 btn-print">
                      <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Fecha final</label>
                        <div class="input-group col-sm-8">
                          <input type="date" class="form-control pull-right" id="date" name="fecha_final" value="<?php echo $fechaactual;?>" required >
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->
                    </div>
              

                 




                    <div class="col-md-12">
                       <div class="col-md-12">
                        
                       
                         </div>

                    </div>

          </form>



                           <?php
                  //    if ($guardar=="si") {
                    
                      ?>
 <button type="button" class="btn btn-primary btn-lg btn-print" data-toggle="modal" data-target="#miModal">
  NUEVO
</button>
                  <?php
                    //  }
                      ?>
<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
                        <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="gastos_add.php" enctype="multipart/form-data" class="form-horizontal">
                    <div class="col-md-12 btn-print">
                      <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Fecha</label>
                        <div class="input-group col-sm-8">
                          <input type="date" class="form-control pull-right" id="date" name="fecha" required >
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->
                    </div>
   <div class="col-md-12 btn-print">
                      <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Descripcion</label>
                        <div class="input-group col-md-8">
                          <input type="text" class="form-control pull-right" id="date" name="descripcion" placeholder="Descripcion " required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 btn-print">
                      <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Cantidad</label>
                        <div class="input-group col-md-8">
                          <input type="text" class="form-control pull-right" id="date" name="cantidad" placeholder="cantidad " required>
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->
                    </div>

                 
   <div class="col-md-12 btn-print"">
            <div class="form-group">
               <br> <label class="control-label col-lg-3" for="price">Categoria</label><br>
         
            <select class="form-control select2" name="categoria" required>

                <?php

              $queryc=mysqli_query($con,"select * from categoria_gastos")or die(mysqli_error());
                while($rowc=mysqli_fetch_array($queryc)){
                ?>
                  <option value="<?php echo $rowc['id_cat_gastos'];?>"><?php echo $rowc['nombre'];?></option>
                <?php }?>
              </select>
               </div>
    </div>







                    <div class="col-md-12">
                       <div class="col-md-12">
                        <button class="btn btn-lg btn-primary btn-print" id="daterange-btn"  name="">GUARDAR</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                         </div>

                    </div>

          </form>

          </div>
      </div>
   
    </div>
  </div>
</div>
 <!--end of modal-->


                  <div class="box-header">
                  <h3 class="box-title"> LISTA GASTOS</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                
                  <table id="example2" border=1 cellspacing=0 cellpadding=2 bordercolor="black">
                    <thead>
                      <tr>


                        <th style="width:30%">Fecha</th>
                        <th style="width:30%">Descripcion</th>
                  
                        <th style="width:10%"> Cantidad </th>
                          

                          <th style="width:20%"> Categoria </th>
                  
                       <th style="width:30%" class="btn-print"> Accion </th>

                      </tr>
                    </thead>
                    <tbody>
<?php

    $query=mysqli_query($con,"select * from gastos AS g
INNER JOIN categoria_gastos AS c
    ON g.categoria = c.id_cat_gastos ")or die(mysqli_error());

    while($row=mysqli_fetch_array($query)){
    $cid=$row['id_gastos'];
 
?>
                      <tr >
              <td><?php echo $row['fecha'];?></td>

                        <td><?php echo $row['descripcion'];?></td>
                        <td><?php echo $row['cantidad'];?></td>
                        <td><?php echo $row['nombre'];?></td>

      

                        <td>
                                                           <?php
                  //    if ($eliminar=="si") {
                    
                      ?>
<a class="btn btn-danger btn-print" href="<?php  echo "eliminar_gastos.php?cid=$cid";?>"    style="height:25%; width:75%; font-size: 12px " role="button">Eliminar</a>

   <?php
                   //   }
                      ?>

         <?php
                     // if ($editar=="si") {
                    
                      ?>

<a class="btn btn-success btn-print" href="#updateordinance<?php echo $row['id_gastos'];?>"  data-target="#updateordinance<?php echo $row['id_gastos'];?>" data-toggle="modal" style="color:#fff;"  style="height:25%; width:75%; font-size: 12px " role="button">Editar</a>


        <?php
                  //    }
                      ?>

            </td>
                      </tr>
        <div id="updateordinance<?php echo $row['id_gastos'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">ACCION DETALLES GASTOS</h4>
              </div>
              <div class="modal-body">

 
        <form class="form-horizontal" method="post" action="gastos_actualizar.php" enctype='multipart/form-data'>

                 <div class="row">
                    <div class="col-md-3 btn-print">
                      <div class="form-group">
                        <label for="date" >Fecha</label>
                 
                      </div><!-- /.form group -->
                    </div>
                       <div class="col-md-7 btn-print">
                      <div class="form-group">
                     <input type="hidden" class="form-control" id="id" name="id_gastos" value="<?php echo $row['id_gastos'];?>" required>
            <input type="date" class="form-control" id="name" name="fecha" value="<?php echo $row['fecha'];?>" required>
 
                      </div>
                    </div>
                           <div class="col-md-1 btn-print">
                
                    </div>
                    </div>


                                      <div class="row">
                    <div class="col-md-3 btn-print">
                      <div class="form-group">
                        <label for="date" >Descripcion</label>
                 
                      </div><!-- /.form group -->
                    </div>
                       <div class="col-md-7 btn-print">
                      <div class="form-group">
                    <input type="text" class="form-control" id="price" name="descripcion" value="<?php echo $row['descripcion'];?>"   required>
 
                      </div>
                    </div>
                           <div class="col-md-1 btn-print">
                
                    </div>
                    </div>

                                      <div class="row">
                    <div class="col-md-3 btn-print">
                      <div class="form-group">
                        <label for="date" >Cantidad</label>
                 
                      </div><!-- /.form group -->
                    </div>
                       <div class="col-md-7 btn-print">
                      <div class="form-group">
                   <input type="text" class="form-control" id="cantidad" name="cantidad" value="<?php echo $row['cantidad'];?>"  required>
 
                      </div>
                    </div>
                           <div class="col-md-1 btn-print">
                
                    </div>
                    </div>
                                                          <div class="row">
                    <div class="col-md-3 btn-print">
                      <div class="form-group">
                        <label for="date" >Categoria</label>
                 
                      </div><!-- /.form group -->
                    </div>
                       <div class="col-md-7 btn-print">
                      <div class="form-group">
                          <select class="form-control select2" name="categoria" required>

                <?php

              $queryc=mysqli_query($con,"select * from categoria_gastos")or die(mysqli_error());
                while($rowc=mysqli_fetch_array($queryc)){
                ?>
                  <option value="<?php echo $rowc['id_cat_gastos'];?>"><?php echo $rowc['nombre'];?></option>
                <?php }?>
              </select>
 
                      </div>
                    </div>
                           <div class="col-md-1 btn-print">
                
                    </div>
                    </div>



            <div class="row">
                    <div class="col-md-3 btn-print">
                      <div class="form-group">
      
                 
                      </div><!-- /.form group -->
                    </div>
                       <div class="col-md-7 btn-print">
                      <div class="form-group">

                     <button type="submit" class="btn btn-primary">GUARDAR</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
                      </div>
                    </div>
                           <div class="col-md-1 btn-print">
                
                    </div>
                    </div>




        </form>
            </div>

        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->

<?php }?>
                    </tbody>

                  </table>
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


  <?php include '../layout/datatable_script.php';?>



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


  "searching": true,
                }

              );
              } );
    </script>

                      <?php 
//}
      # code...
    
?>

    <!-- /gauge.js -->
  </body>
</html>
