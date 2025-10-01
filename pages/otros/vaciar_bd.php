<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../../dist/includes/dbcon.php');






    mysqli_query($con,"delete from caja ")or die(mysqli_error());
    mysqli_query($con,"delete from categoria_gastos  ")or die(mysqli_error());
       mysqli_query($con,"delete from categoria_ingresos  ")or die(mysqli_error());
       mysqli_query($con,"delete from detalles_pedido   ")or die(mysqli_error());
              mysqli_query($con,"delete from gastos   ")or die(mysqli_error());
              mysqli_query($con,"delete from history_log     ")or die(mysqli_error());
            mysqli_query($con,"delete from ingresos   ")or die(mysqli_error());
                   mysqli_query($con,"delete from pedidos   ")or die(mysqli_error());
                      mysqli_query($con,"delete from producto   ")or die(mysqli_error());
                         mysqli_query($con,"delete from  reserva     ")or die(mysqli_error());

 
  echo "<script>document.location='../layout/inicio.php'</script>";  
  
  
?>