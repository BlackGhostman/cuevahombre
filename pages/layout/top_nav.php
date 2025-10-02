              <?php
include 'dbcon.php';
$caja_cont=0;
$acumulado=0;
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	if (!isset($_SESSION['barberia'])) {
		header('Location:../../index.php');
	}
	else{
		$id_sucursal = $_SESSION['barberia'];
	}

	$query_usuario=mysqli_query($con,"select nombre_completo, imagen from usuario where id ='" . $_SESSION['id'] . "'")or die(mysqli_error());
    $row_usuario=mysqli_fetch_array($query_usuario);
    $nombre = $row_usuario['nombre_completo'];
    $imagen = $row_usuario['imagen'];

    $query_empresa=mysqli_query($con,"select simbolo_moneda from empresa")or die(mysqli_error());
    $row_empresa=mysqli_fetch_array($query_empresa);
    $simbolo_moneda = $row_empresa['simbolo_moneda'];

    $caja_query=mysqli_query($con,"SELECT 
        c.Monto_Apertura,
        (SELECT IFNULL(SUM(monto_pagado), 0) FROM pedidos WHERE id_cat_ingresos = 1 AND CAST(fecha AS DATE) >= CAST(c.fecha_apertura AS DATE) AND Id_Sucursal = c.Id_Sucursal) AS Ventas_Efectivo,
        (SELECT IFNULL(SUM(monto_pagado), 0) FROM pedidos WHERE id_cat_ingresos <> 1 AND CAST(fecha AS DATE) >= CAST(c.fecha_apertura AS DATE) AND Id_Sucursal = c.Id_Sucursal) AS Ventas_Otros_Metodos
    FROM caja AS c
    WHERE c.estado = 'abierto' AND c.Id_Sucursal = $id_sucursal")or die(mysqli_error());

    $monto_apertura = 0;
    $ventas_efectivo = 0;
    $ventas_otros_metodos = 0;
    $total_caja = 0;

    if($row_caja=mysqli_fetch_array($caja_query)){
      $caja_cont=1;
      $monto_apertura = $row_caja['Monto_Apertura'];
      $ventas_efectivo = $row_caja['Ventas_Efectivo'];
      $ventas_otros_metodos = $row_caja['Ventas_Otros_Metodos'];
      $total_caja = $monto_apertura + $ventas_efectivo + $ventas_otros_metodos;
    }
if ($caja_cont==0) {

}
?>




 <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                         <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../usuario/subir_us/<?php echo $imagen; ?>" alt=""><?php echo $nombre; ?>

                    <span class=" fa fa-angle-down"></span>
                  </a>

              
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                
                    <li><a href="../layout/logout.php"><i class="fa fa-sign-out pull-right"></i> Cerrar sesion</a></li>

                  </ul>

                </li>   

                     <?php
                      if ($tipo=="administrador" or $tipo=="empleado") {
                    
                      ?>
         <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../layout/images/caja.png" alt="">CAJA<?php echo "<h2>$simbolo_moneda $total_caja</h2>"; ?>

                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                      <li><a>Apertura: <?php echo "$simbolo_moneda $monto_apertura"; ?></a></li>
                      <li><a>Efectivo: <?php echo "$simbolo_moneda $ventas_efectivo"; ?></a></li>
                      <li><a>Otros Métodos: <?php echo "$simbolo_moneda $ventas_otros_metodos"; ?></a></li>
                      <li class="divider"></li>
                      <?php if ($caja_cont == 0): ?>
                          <li><a href="caja.php"><i class="fa fa-money"></i> Abrir caja</a></li>
                      <?php else: ?>
                          <li><a href="caja_close.php"><i class="fa fa-money"></i> Cerrar caja</a></li>
                      <?php endif; ?>
                  </ul>
                </li>  

        <?php
                      }
                      ?>


          <?php
                      if ($tipo=="administrador" or $tipo=="empleado") {
                    
                      ?>
                                         <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../layout/img/pos.png" alt="">POS

                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                
                    <li><a href="../ventas/pos.php"><i class="fa fa-money"></i> POS </a></li>
             
                    
                  </ul>
                </li>  

        <?php
                      }
                      ?>
              </ul>
            </nav>
          </div>
 </div>

