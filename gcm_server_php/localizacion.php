<?php
if (isset($_POST["latitud"]) && isset($_POST["longitud"])) {
    $latitud = $_POST["latitud"];
    $longitud = $_POST["longitud"];
    include_once './db_functions.php';
    include_once './GCM.php';
    
    $db = new DB_Functions();
    $gcm = new GCM();
    $res = $db->AltaBus($latitud, $longitud);

    $consulta= $db->AnalisisPeriferias();

   $contador=1;
   while($row = mysql_fetch_array($consulta)){
              if($contador==1){
              //Inicializamos los vectores con la informacion del primer elemento de la consulta
                 $vector1[0]= $row["Longitud_P"];
                 $vector1[1]= $row["Latitud_P"];
                 //echo $vector1[0];
                 $vector2[0]= $row["Longitud_P"];
                 $vector2[1]= $row["Latitud_P"];
                 $vectorBus[0]= $row["Longitud_P"];
                 $vectorBus[1]= $row["Latitud_P"];


              }
              else if( $contador==2){
                   $vector1[0]=$row["Longitud_P"] - $vector1[0];
                   $vector1[1]=$row["Latitud_P"]- $vector1[1];
              }else{
                    $vector2[0]=$row["Longitud_P"] - $vector2[0];
                    $vector2[1]=$row["Latitud_P"]- $vector2[1];
              }
              $contador++;

   }
   
   $autobus_pos = $db->MostrarBus();

    while ($row = mysql_fetch_array($autobus_pos)) {
          $vectorBus[0]=$row["Longitud"]-$vectorBus[0];
          $vectorBus[1]=$row["Latitud"]-$vectorBus[1];

    }

    $a1=(($vectorBus[0]*$vector2[1])-($vector2[0]*$vectorBus[1]))/(($vector1[0]*$vector2[1])-($vector2[0]*$vector1[1]));

    $a2=(-1)*((($vectorBus[0]*$vector1[1])-($vector1[0]*$vectorBus[1]))/(($vector1[0]*$vector2[1])-($vector2[0]*$vector1[1])));

    $GCM_IDs= $db->GCM_IDS_Estacion();

    while ($row = mysql_fetch_array($GCM_IDs)) {

          if($a1>0 && $a2 >0){
                  $mensaje="Dentro";
          }else{
                  $mensaje="Fuera";
          }
          $registration_ids = array($row["gcm_regid"]);
          $mensaje = array("price" => $mensaje);
          $respuesta=$gcm->send_notification($registration_ids, $mensaje);

          echo $respuesta;
    }

}else{
}
?>
