<?php
    include_once 'db_functions.php';
    $db = new DB_Functions();
    //var_dump($_POST);
    
    if(isset($_POST)){
    $datos= json_decode(file_get_contents("php://input"),true);
    //print_r($datos);
   $parada=json_decode($datos['parada'],true);
   foreach($parada as $conteo)
    $respuesta= $db->RegistrarSolicitudNotificacion($conteo, $datos['id_gcm']);
    //echo mysql_error($respuesta);
    echo json_encode($respuesta);
}

?>