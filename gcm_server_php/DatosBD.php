<?php
    include_once 'db_functions.php';
    $db = new DB_Functions();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<meta http-equiv=content-type content=text/html; charset=UTF-8>
<html >
    <head>

    <title>Mostrar Información Base de datos</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel= "stylesheet" href="css/bootstrap.css">
    <link rel= "stylesheet" href="css/style.css" type="text/css">
    <style type="text/css">
<!--
.Estilo1 {font-family: Arial, Helvetica, sans-serif;font-size: 0.7em;}
body {
	background-color: #F5F5F5;
}
-->
</style>
    </head>
    <body>
        
         <form id="form1" name="form1">    
                  <div class="row">
                        <div class="col-md-4">
                            <p><img  style="width: 18%;" src="./pictures/rojo_512.png" alt="" align="center" ></p>
                            <p>NotiBus</p>
                        </div>
                        <div class="col-md-4"> </div>
                         <div class="col-md-4">
                            <p class="Estilo1 text-center"><strong>
                            <img  style="width: 5%;" src="./pictures/ipn-logo.gif" alt="" align="center" >
                            Escuela Superior de Ingeniería Mecánica y Eléctrica Unidad Culhuacan
                            <img  style="width: 9%;" src="./pictures/Logo_ESIME.jpg" alt="" align="center" >
                            </strong></p>
                            <p></p>
                            <p class="Estilo1 text-justify"><strong> Sistema de notificación de proximidad para transporte público
                                                                                            en ruta Xochimilco/ Bosque de Nativitas - Metro San Lázaro, 
                                                                                            utilizando el Posicionamiento Global GPS y Google Cloud Messaging.</strong></p>
                         </div>
                          
                </div>
                <br>
                    <div>
                    <ul class="nav nav-tabs" id="myTab" >
                      <li class="active"><a href="#usuarios" data-toggle="tab">Usuarios</a></li>
                      <li><a href="#unidades" data-toggle="tab">Unidades</a></li>
                      <li><a href="#rutas" data-toggle="tab">Rutas</a></li>
                      <li><a href="#estaciones" data-toggle="tab">Estaciones</a></li>
                      <li><a href="#us_est_unid" data-toggle="tab">Usuarios - Estación - Unidad</a></li>
                    </ul>
                    </div>
                    
                    <div id="myTabContent" class="tab-content" >
                          <div class="tab-pane in active" id="usuarios">
                          <div class="tab-pane">
                               <table class="activated" font id="tbinfo">
                                        <?php
                                            $datos= $db->ObtenerUsuarios();
                                            echo  "<thead><tr >";
                                             echo "<th align ><b>Identificador Usuario</b></th>";
                                             echo "<th><b>ID Registro de GCM</b></th>";
                                             echo "<th><b>Nombre</b></th>";
                                             echo "<th><b>Correo</b></th>";
                                            echo "<th><b>Fecha de Alta</b></th>";
                                             echo "</tr></thead>";
                                                echo "<tbody>";
                                                        $control_color=1;
                                                        while($fila = mysql_fetch_array($datos)){
                                                                echo "<tr>";
                                                                echo "<td>".utf8_encode($fila[0])."</td>";
                                                                echo "<td>".substr(utf8_encode($fila[1]),0,20)."</td>";
                                                                echo "<td>".utf8_encode($fila[2])."</td>";
                                                                echo "<td>".utf8_encode($fila[3])."</td>";
                                                                echo "<td>".utf8_encode($fila[4])."</td>";
                                                                echo "</tr>";						
                                                                
                                                    }
                                                    
                                                echo "</tbody>";
                                        ?>

                                        </table>
                             </div>
                          
                        </div>
                        
                          <div class="tab-pane fade" id="unidades">
                            <table class="activate" font id="tbinfo">
                                <?php
                                    $datos= $db->ObtenerUnidadesBus();
                                    echo  "<thead><tr>";
                                     echo "<th align ><b>ID Unidad</b></th>";
                                     echo "<th><b>Latitud</b></th>";
                                     echo "<th><b>Longitud</b></th>";
                                     echo "<th><b>Placas</b></th>";
                                    echo "<th><b>Nombres</b></th>";
                                    echo "<th><b>Apellidos</b></th>";
                                    echo "<th><b>ID Ruta</b></th>";
                                     echo "</tr></thead>";
                                        echo "<tbody>";
                                                while($fila = mysql_fetch_array($datos)){
                                                        echo "<tr>";
                                                        echo "<td>".utf8_encode($fila[0])."</td>";
                                                        echo "<td>".utf8_encode($fila[1])."</td>";
                                                        echo "<td>".utf8_encode($fila[2])."</td>";
                                                        echo "<td>".utf8_encode($fila[3])."</td>";
                                                        echo "<td>".utf8_encode($fila[4])."</td>";
                                                        echo "<td>".utf8_encode($fila[5])."</td>";
                                                        echo "<td>".utf8_encode($fila[6])."</td>";
                                                        echo "</tr>";						
                                                        
                                            }
                                            
                                        echo "</tbody>";
                                ?>

                            </table>
                        
                          
                          
                          
                          </div>
                          
                          <!-- -->
                          <div class="tab-pane fade" id="rutas">
                            <table class="activate" font id="tbinfo">
                                <?php
                                    $datos= $db->ObtenerRutas();
                                    echo  "<thead><tr>";
                                     echo "<th align ><b>ID Ruta</b></th>";
                                     echo "<th><b>Nombre</b></th>";
                                     echo "<th><b>Origen</b></th>";
                                     echo "<th><b>Destino</b></th>";
                                     echo "</tr></thead>";
                                        echo "<tbody>";
                                                while($fila = mysql_fetch_array($datos)){
                                                        echo "<tr>";
                                                        echo "<td>".utf8_encode($fila[0])."</td>";
                                                        echo "<td>".utf8_encode($fila[1])."</td>";
                                                        echo "<td>".utf8_encode($fila[2])."</td>";
                                                        echo "<td>".utf8_encode($fila[3])."</td>";
                                                        echo "</tr>";						
                                                        
                                            }
                                            
                                        echo "</tbody>";
                                ?>

                            </table>

                          </div>

                          <!-- -->
                          
                          
                          <!-- -->
                          <div class="tab-pane fade" id="estaciones">
                            <table class="activate" font id="tbinfo">
                                <?php
                                    $datos= $db->ObtenerEstaciones();
                                    echo  "<thead><tr>";
                                     echo "<th align ><b>ID Estacion</b></th>";
                                     echo "<th><b>ID Ruta</b></th>";
                                     echo "<th><b>Latitud</b></th>";
                                     echo "<th><b>Longitud</b></th>";
                                     echo "<th><b>Nombre Estación</b></th>";
                                     echo "</tr></thead>";
                                        echo "<tbody>";
                                                while($fila = mysql_fetch_array($datos)){
                                                        echo "<tr>";
                                                        echo "<td>".utf8_encode($fila[0])."</td>";
                                                        echo "<td>".utf8_encode($fila[1])."</td>";
                                                        echo "<td>".utf8_encode($fila[2])."</td>";
                                                        echo "<td>".utf8_encode($fila[3])."</td>";
                                                        echo "<td>".utf8_encode($fila[4])."</td>";
                                                        echo "</tr>";						
                                                        
                                            }
                                            
                                        echo "</tbody>";
                                ?>

                            </table>

                          </div>

                          <!-- -->
                          
                          <div class="tab-pane fade" id="us_est_unid">
                            <table class="activate" font id="tbinfo">
                                <?php
                                    $datos= $db->ObtenerRelacionUsuarioEstacionUnidad();
                                    echo  "<thead><tr>";
                                     echo "<th align ><b>ID UserStUnit</b></th>";
                                     echo "<th><b>ID Estacion</b></th>";
                                     echo "<th><b>ID Unidad</b></th>";
                                     echo "<th><b>ID Usuario</b></th>";
                                    echo "<th><b>Apuntador</b></th>";
                                     echo "</tr></thead>";
                                        echo "<tbody>";
                                                while($fila = mysql_fetch_array($datos)){
                                                        echo "<tr>";
                                                        echo "<td>".utf8_encode($fila[0])."</td>";
                                                        echo "<td>".utf8_encode($fila[1])."</td>";
                                                        echo "<td>".utf8_encode($fila[2])."</td>";
                                                        echo "<td>".utf8_encode($fila[3])."</td>";
                                                        echo "<td>".utf8_encode($fila[4])."</td>";
                                                        echo "</tr>";						
                                                        
                                            }
                                            
                                        echo "</tbody>";
                                ?>

                            </table>
                          
                          
                          
                          </div>
                          <div class="tab-pane fade" id="settings">tab4</div>
                        </div>

                <script>
                          $('#myTab a').click(function (e) {
                                    e.preventDefault();
                                    $(this).tab('show');
                            });
                </script>
                    
                    
        
        </form>
    </body>
</html>
