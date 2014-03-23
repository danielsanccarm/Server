<?php
         include_once 'db_functions.php';
         include_once './GCM.php';
            
            //Creamos un objeto para poder usar las funciones de la base de datos
            $db = new DB_Functions();
            
            //Nos retornara todas aquellas periferias por estacion, por el momento solo tenemos con la estación 1
            $consulta= $db->AnalisisPeriferias();
            
            //El contador nos servirá para llevar un orden en las periferias que nos regresara la BD, serán 3 por estación
            //Cuando sea 1 se inicializarán los arreglos
            //$vector1, $vector2, $vectorBus. Todos serán con un tamaño de dos, para almacenar su Latitud y Longitud
            //Cuando sea 2 la única variable que se utilizará será el $vector1 y se utilizarán los valores obtenidos de la BD
            //Cuando sea 3 la única variable utilizada será $vector2 
            
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
                      
                      //echo $contador;
                      
                      $contador++;

           }

            //Obtenemos la información de las unidades
           $autobus_pos = $db->MostrarBus();
           
           //Aqui se realiza la operación hacer el "trazo" del autobus}
        //PROBLEMA!!! Se estan obteniendo todos los autobuses, entonces como esta dentro de un ciclo puede que se sobreescriba
        //Una manera de solucionarlos sería mandar la llave de cierre del while hasta finalizar el otro ciclo
            while ($row = mysql_fetch_array($autobus_pos)) {
                  $vectorBus[0]=$row["Longitud"]-$vectorBus[0];
                  $vectorBus[1]=$row["Latitud"]-$vectorBus[1];

            }
            
            //Cálculos para obtener los valores para la saber si se encuentra dentro o fuera de la periferia
            $a1=(($vectorBus[0]*$vector2[1])  -  ($vector2[0]*$vectorBus[1]))   /   (($vector1[0]*$vector2[1])  -  ($vector2[0]*$vector1[1]));
            
            $a2=(-1) * ((($vectorBus[0]*$vector1[1])  -  ($vector1[0]*$vectorBus[1]))  /  (($vector1[0]*$vector2[1])  -  ($vector2[0]*$vector1[1])));
            
            //<- Solo se ocupan para version_compare la info en la página ->
            //echo "V1= ". $vector1[0].",". $vector1[1]." "."<br>V2= ". $vector2[0].",". $vector2[1]."<br>Vbus=".$vectorBus[0].",".$vectorBus[1];
            //echo "<br>a1= ".$a1."<br>a2=  ".$a2."<br>";
            //<- ->

            //Obtendremos el gcm_regid de todos los usuarios que se hayan dado de alta en UserStUnit
            
            $GCM_IDs= $db->GCM_IDS_Estacion();
            $gcm = new GCM();
            while ($row = mysql_fetch_array($GCM_IDs)) {
                   //echo $row["gcm_regid"]."<br>";
                  if($a1>0 && $a2 >0){
                          $mensaje="Dentro";
                  }else{
                          $mensaje="Fuera";
                  }
                  
                  //Almacenamos el gcm_regid del usuario
                  $registration_ids = array($row["gcm_regid"]);
                  //Sería se crea un arreglo para ingresar el mensaje, ya que en send_notification se requiere en un arreglo
                  //Y se accedera al mensaje a través de 'price' (es como si dijeras $_POST['price'])
                  $mensaje = array("price" => $mensaje);
                  $respuesta=$gcm->send_notification($registration_ids, $mensaje);
                  
                  echo $respuesta;
            }

?>
