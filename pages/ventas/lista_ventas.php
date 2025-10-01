
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
 

                 <div class="panel-heading">


        </div>
 
 <!--end of modal-->


                  <div class="box-header">
                  <h3 class="box-title"> </h3>

                </div><!-- /.box-header -->
                 <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Impresión</a>
                <a class="btn btn-warning btn-print" href="pos.php"    style="height:25%; width:15%; font-size: 12px " role="button">REGISTRAR</a>


                









                <div class="box-body">
                
         

 
                        
            

          
      






      
 <!--end of modal-->











                  <div class="box-header">
                  <h3 class="box-title"> LISTA VENTAS</h3>
                </div><!-- /.box-header -->
              


                <div class="box-body">
                
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr class=" btn-success">

                    <th>#</th>
               
                        <th>Cliente</th>
                    
                       
         
                           
        <th>Fecha</th>
    <th>Total</th>
 <th class="btn-print"> Accion </th>
                      </tr>
                    </thead>
                    <tbody>
<?php



   // $branch=$_SESSION['branch'];
    $query=mysqli_query($con,"select p.*, c.nombre as Cliente, c.correo ,v.total,v.tipo_comprobante 
      from venta v inner join pedido p on v.idpedido = p.idpedido inner join clientes c on p.idcliente = c.id_cliente where p.idsucursal = $idsucursal 
       and p.tipo_pedido = 'Venta' order by idpedido desc limit 0,2999")or die(mysqli_error());
    $i=0;
    while($row=mysqli_fetch_array($query)){
$tipo_comprobante=$row['tipo_comprobante'];
$idpedido=$row['idpedido'];
    $i++;
?>
                      <tr >

<td ><?php echo $i;?></td>

<td><?php echo $row['Cliente'];?></td>

    

        <td><?php echo $row['fecha'];?></td>              
         <td><?php echo $row['total'];?></td>                                      

                          <td>
                                 <?php
                   
if ($tipo_comprobante=="Boleta") {



                    
                      ?>


<a class="btn btn-danger btn-print" href="<?php  echo "../boletas_ventas/generar_boleta.php?idpedido=$idpedido";?>"  target="_blank"  role="button">Boleta</a>
      <?php
                      }
                      ?>

                                                       <?php


  if ($tipo_comprobante=="Factura") {

                    
                      ?>

<a class="btn btn-danger btn-print" href="<?php  echo "../boletas_ventas/generar_factura.php?idpedido=$idpedido";?>"  target="_blank"  role="button">Factura</a>
      <?php
                      }
                      ?>


                                                       <?php
                   
if ($tipo_comprobante=="Ticket") {

                      ?>

                      <a class="btn btn-danger btn-print" href="<?php  echo "../boletas_ventas/generar_ticket.php?idpedido=$idpedido";?>"  target="_blank"  role="button">Ticket</a>
                               <?php
                      }
                      ?>

            </td>
                      </tr>

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
           "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],


  "searching": true,
                }

              );
              } );
    </script>




    <!-- /gauge.js -->
  </body>
</html>
