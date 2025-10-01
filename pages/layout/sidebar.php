<?php 
$id=$_SESSION['id'];
?>

<?php

?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3><?php echo $empresa;?></h3>
                <ul class="nav side-menu">
                      <li><a href = "../layout/inicio.php"><i class="fa fa-dashboard"></i> inicio <span class="fa fa-chevron-right"></span></a></li>
                                  <?php
                      if ($tipo=="administrador" or $tipo=="empleado" ) {
                    
                      ?>
        
   <li><a href = "../layout/caja.php"><i class="fa fa-bank"></i> Caja <span class="fa fa-chevron-right"></span></a></li>
        <?php
                      }
                      ?>
                                  <?php
                      if ($tipo=="administrador" ) {
                    
                      ?>
                 <li><a><i class="fa fa-group"></i> Usuarios<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
        <li><a href="../cliente/clientes.php">Clientes</a></li>
                <li><a href="../empleados/usuario.php">Empleados</a></li>
                      <li><a href="../usuario/usuario.php">Usuarios</a></li>

                                  <li><a href="../usuario/usuario_agregar.php">Agregar usuario</a></li> 

                    </ul>
                  </li>

             <?php
                      }
                      ?>

                              <?php
                      if ($tipo=="administrador" or $tipo=="empleado") {
                    
                      ?>
                 <li><a><i class="fa fa-group"></i> Productos/Servicios<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                      <li><a href="../producto/producto.php">Producto</a></li>
                      <li><a href="../producto/servicio.php">Servicio</a></li>
              

                    </ul>
                    
                  </li>

             <?php
                      }
                      ?>
                      



                 <li><a><i class="fa fa-group"></i> Reservas<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
          <?php
                      if ($tipo=="administrador" or $tipo=="empleado" or $tipo=="cliente") {
                    
                      ?>
           <li><a href = "../reserva/reserva.php"><i class="fa fa-database"></i>Hacer reserva<span class="fa fa-chevron-right"></span></li></a>

                                    <?php
                      }
                      ?>

                                   <?php
                      if ($tipo=="administrador" or $tipo=="empleado" ) {
                    
                      ?>
                              <li><a href = "../reserva/lista_reservas.php"><i class="fa fa-database"></i>Lista de reservas<span class="fa fa-chevron-right"></span></li></a>

                                    <?php
                      }
                      ?>

                    </ul>
                  </li>





    

                               <?php
                      if ($tipo=="administrador" or $tipo=="empleado" ) {
                    
                      ?>

                           <li><a href = "../ventas/pos.php"><i class="fa fa-money"></i>Ventas<span class="fa fa-chevron-right"></span></li></a>
                   


                                    <?php
                      }
                      ?>
                   <?php
                      if ($tipo=="administrador" or $tipo=="empleado") {
                    
                      ?>
                              <li><a><i class="fa fa-money"></i> Gastos<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                      <li><a href="../gastos/gastos.php">Gastos</a></li>

<li><a href="../categoria_gastos/cat_gastos.php">Tipo gastos</a></li>
                       

                    </ul>
                  </li>



                            <li><a><i class="fa fa-money"></i> Ingresos<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                      <li><a href="../ingresos/ingresos.php">Ingresos</a></li>

<li><a href="../categoria_ingresos/cat_ingresos.php">Tipo Ingresos</a></li>
                       

                    </ul>
                  </li>


             
                 
         









                                   <li><a><i class="fa fa-bar-chart"></i> Consolidado gastos e ingresos<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
<li><a href="../reportes/consolidado_docentes.php">Consolidado por mes</a></li>
<li><a href="../reportes/consolidado_entre_fechas.php">Consolidado entre fechas</a></li>



                       

                    </ul>
                  </li>
                                           <?php
                      }
                      ?>
                                                              <?php
                      if ($tipo=="administrador" ) {
                    
                      ?>

                 <li><a><i class="fa fa-bar-chart"></i> Reportes Ventas<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="../reportes/reportes_por_fechaImpr.php">Entre fechas Imprimir</a></li>
                    <li><a href="../reportes/reportes_fecha_por_empleado.php">Entre fechas barbero</a></li>
                    <li><a href="../reportes/reportes_fecha_por_producto.php">Entre fechas producto</a></li>
                      <li><a href="../reportes/reportes_por_fecha.php">Entre fechas</a></li>
                      <li><a href="../reportes/reportes_por_dia.php">Por dia</a></li> 
                     <li><a href="../reportes/reportes_por_mes.php">Por mes</a></li> 
      <li><a href="../reportes/reportes_ultimos_7dias.php">Ultimos 7 dias</a></li> 
                    </ul>
                  </li>
             <?php
                      }
                      ?>



    

   




         
                 <li><a><i class="fa fa-gear"></i>Configuracion<span class="fa fa-chevron-s"></span></a>
                    <ul class="nav child_menu">


                      <li><a href="../usuario/editar_usuario_password.php">Cambiar Contraseña</a></li>
                                                                        <?php
                      if ($tipo=="administrador" ) {
                    
                      ?>
                          <li><a href="../configuracion/configuracion.php">Configuracion</a></li>

                           <li><a href="../config_frond_end/configuracion.php">Frond end</a></li>
                            <li><a href="../config_frond_end/galeria.php">Galeria Frond end</a></li>
                                 <?php
                      }
                      ?>

                    </ul>
                  </li>



                             <?php
                      if ($tipo=="administrador" ) {
                    
                      ?>

                     <li><a><i class="fa fa-database"></i> Base de datos<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                      <li><a href="../otros/vaciar_bd.php" onClick="return confirm('¿Está seguro de que quieres vaciar la base de datos ??');">Vaciar base de datos</a></li>
       
                       <li><a href="../otros/respaldo_add.php">Respaldo</a></li>

                    </ul>
                  </li>
             <?php
                      }
                      ?>
                      
              </div>
             <!--- <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>--->

            </div>
