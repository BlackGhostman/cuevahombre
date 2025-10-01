<?php
session_start();
include('../../dist/includes/dbcon.php');
	//$branch=$_SESSION['branch'];
	$fechaactual = $_POST['fechaactual'];
	$fechareserva = $_POST['fechareserva'];
$hora = $_POST['hora'];


  $id_sesion=$_SESSION['id'];




mysqli_query($con,"INSERT INTO reserva(id_usuario,fechaactual,fechareserva,hora,estado)
VALUES('$id_sesion','$fechaactual','$fechareserva','$hora','')")or die(mysqli_error($con));		

$correo="";

            $query1=mysqli_query($con,"select * from usuario where id='$id_sesion'")or die(mysqli_error());

                      while($row1=mysqli_fetch_array($query1)){

                   $correo = $row1['correo'];
               $telefono = $row1['telefono'];
     $nombre = $row1['nombre'].'  '.$row1['apellido'];

}


    $query=mysqli_query($con,"select * from empresa ")or die(mysqli_error());

    while($row=mysqli_fetch_array($query)){
   $correo_empresa = $row['correo'];
     $empresa = $row['empresa'];
   
    }
		
$to = $correo_empresa;
$subject = "reserva en espacio : ".$empresa;
$message ="Reservado por: ".$nombre." cuyo telefono es: ".$telefono." para la fecha : ".$fechareserva." Hora : ".$hora;
$headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($to, $subject, $message, $headers);

  echo "<script>document.location='reserva.php'</script>";




  $to = $correo;
$subject = "Usted hizo una reserva en :".$empresa;
$message ="Usted reservo con nombre : ".$nombre." cuyo telefono es: ".$telefono." para la fecha : ".$fechareserva." Hora : ".$hora;
$headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($to, $subject, $message, $headers);

  echo "<script>document.location='reserva.php'</script>";
  




?>
