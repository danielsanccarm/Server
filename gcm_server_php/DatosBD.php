<?php
    include_once 'db_functions.php';
    $db = new DB_Functions();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<meta http-equiv=content-type content=text/html; charset=UTF-8>
<html >
    <head>

    <title>Mostrar Información Base de datos</title>
    <link rel= "stylesheet" href="css/bootstrap.css">
    
    </head>
    <body>
         <form id="form1" name="form1">    
                <h1> Usuarios </h1>
                <div class="table-responsive">
                <table class="table table-bordered table-hover table-condensed" font id="tbinfo">
                <?php
                    $datos= $db->ObtenerUsuarios();
                    echo  "<thead><tr>";
                     echo "<th align ><b>Identificador Usuario</b></th>";
                     echo "<th><b>GCM_Reg_ID</b></th>";
                     echo "<th><b>Nombre</b></th>";
                     echo "<th><b>Correo</b></th>";
                    echo "<th><b>Fecha de Alta</b></th>";
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
                <br>
                <h1>Unidades</h1>
                <table class="table table-bordered table-hover table-condensed" font id="tbinfo">
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
                
                <br>
                <h1>Usuarios - Estación - Unidad</h1>
                <table class="table table-bordered table-hover table-condensed" font id="tbinfo">
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
        </form>
    </body>
</html>