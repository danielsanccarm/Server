<?php
    include_once 'db_functions.php';
    $db = new DB_Functions();
    //var_dump($_POST);
    
    if(isset($_POST)){
    
   
    $respuesta= $db->RegistrarSolicitudNotificacion($_POST['parada'], $_POST['id_gcm']);
    //echo mysql_error($respuesta);
    echo json_encode($respuesta);
}

?>