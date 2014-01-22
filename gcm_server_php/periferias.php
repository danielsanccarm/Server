<?php
         include_once 'db_functions.php';
         include_once './GCM.php';

            $db = new DB_Functions();

            $consulta= $db->AnalisisPeriferias();
           //$result = mysql_query("Select ID_Periferia, Latitud_P, Longitud_P from Periferia where ID_Estacion='1'");
           $contador=1;
           //echo $contador;
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
                      //echo "ID_Periferia" . $row["ID_Periferia"];
                      //echo "Latitud: ". $row["Latitud_P"]
                      //echo $contador;
                      $contador++;

           }

           
           $autobus_pos = $db->MostrarBus();
           
            while ($row = mysql_fetch_array($autobus_pos)) {
                  $vectorBus[0]=$row["Longitud"]-$vectorBus[0];
                  $vectorBus[1]=$row["Latitud"]-$vectorBus[1];

            }
            
            $a1=(($vectorBus[0]*$vector2[1])-($vector2[0]*$vectorBus[1]))/(($vector1[0]*$vector2[1])-($vector2[0]*$vector1[1]));
            
            $a2=(-1)*((($vectorBus[0]*$vector1[1])-($vector1[0]*$vectorBus[1]))/(($vector1[0]*$vector2[1])-($vector2[0]*$vector1[1])));
            //echo "V1= ". $vector1[0].",". $vector1[1]." "."<br>V2= ". $vector2[0].",". $vector2[1]."<br>Vbus=".$vectorBus[0].",".$vectorBus[1];
            //echo "<br>a1= ".$a1."<br>a2=  ".$a2."<br>";


            $GCM_IDs= $db->GCM_IDS_Estacion();
            $gcm = new GCM();
            while ($row = mysql_fetch_array($GCM_IDs)) {
                   //echo $row["gcm_regid"]."<br>";
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

?>
