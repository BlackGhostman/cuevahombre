
<?php include '../layout/header.php';

//$branch_id = $_GET['id'];
?>

    <!-- Font Awesome -->

    <link rel="stylesheet" href="../layout/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../layout/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../layout/plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../layout/dist/css/skins/_all-skins.min.css">
  <body class="nav-md">
                                         <?php 
//    if ($usuario=="si") {
      # code...
    
?>
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
   if(isset($_REQUEST['idventa']))
            {
              $idventa=$_REQUEST['idventa'];
            }
            else
            {
            $idventa=$_POST['idventa'];
          }


?>

                 
    <?php            
$pago=0;
       $query=mysqli_query($con,"select * from venta where idventa='$idventa'  ")or die(mysqli_error());

    while($row=mysqli_fetch_array($query)){

         $pago=$row['total'];
    } 
$idsucursal=0;

?>








<?php

   // $branch=$_SESSION['branch'];
    $query=mysqli_query($con,"select * from empresa  ")or die(mysqli_error());
    $i=1;
    while($row=mysqli_fetch_array($query)){
    $simbolo_moneda=$row['simbolo_moneda'];
        $impuesto=$row['impuesto'];
}


?>

             <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="asignar_credito_pos_add.php" enctype="multipart/form-data" class="form-horizontal">
  <input type="hidden" class="form-control" id="idventa" name="idventa" value="<?php echo $idventa;?>" required>
      



                  <div class="row">
                    <div class="col-md-3 btn-print">
                      <div class="form-group">
                        <label for="date" >Deuda</label>
                 
                      </div><!-- /.form group -->
                    </div>
                       <div class="col-md-4 btn-print">
                      <div class="form-group">
                               <input type="text"   class="form-control pull-right" value="<?php echo $pago;?>"  readonly >
       
  
                      </div>
                    </div>
                           <div class="col-md-4 btn-print">
                
                    </div>
                    </div>

               <div class="row">
                    <div class="col-md-3 btn-print">
                      <div class="form-group">
                        <label for="date" >Monto a pagar</label>
                 
                      </div><!-- /.form group -->
                    </div>
                       <div class="col-md-4 btn-print">
                      <div class="form-group">
                      
                          <input type="text" class="form-control pull-right"   min="0" max="<?php echo $pago; ?>" name="monto_pagado" required>       
  
                      </div>
                    </div>
                           <div class="col-md-4 btn-print">
                
                    </div>
                    </div>
    
     
                <div class="row">
                    <div class="col-md-3 btn-print">
                      <div class="form-group">
                        <label for="date" ></label>
                 
                      </div><!-- /.form group -->
                    </div>

                       <div class="col-md-4 btn-print">
                      <div class="form-group">
                       <button type="submit" class="btn btn-primary">PAGAR</button>     
  
                      </div>
                    </div>
                           <div class="col-md-4 btn-print">
                
                    </div>
                    </div>
    
   
   
           <div class="col-lg-9">

                         
                               
            
      </div>
          </form>
              
          </div>

                  <div class="box-header">
               
                </div><!-- /.box-header -->
                <div class="box-body">
                
 
                </div><!-- /.box-body -->

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
             <a href="https://ventas.programacionparacompartir.com/">ventas  tusulutionweb Sys</a>
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
 // }    
?>



    <!-- /gauge.js -->
  </body>
</html>
