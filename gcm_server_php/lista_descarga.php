<?php
    include_once 'db_functions.php';
    $db = new DB_Functions();
    if(isset($_POST)){
        //json_encode(var_dump($_POST));
        //exit(0);
        //$insercion = explode(",",$_POST['parada']);
        // Accedo al RAW de datos directamente
        /*
        $datos =json_decode( file_get_contents("php://input"),true);
        print_r($datos);
        echo $datos["parada"];
        */
        
        //Accedemos al RAW de datos directamente
        $datos= json_decode(file_get_contents("php://input"),true);
        //Generamos el arreglo apartir perteneciente a parada dentro del json
        $insercion=json_decode($datos['parada'],true);
        if (sizeof($insercion) == 0)
            echo "aun no se puede";
        //print_r($insercion);
        
        $i=0;
        //print_r($insercion['parada']);
        
        $lista = array();       //Array donde se almacenaran las paradas
        
        //if (is_array($insercion['parada']))
        foreach($insercion as $conteo){             //Recorremos las rutas solicitadas
               $resultado = $db->Descarga($conteo);//$conteo
                while($fila  = mysql_fetch_row($resultado)){
                    $lista[$i]=array("ID_Estacion"=>$fila[0], "Ruta"=>$fila[1], "Nombre"=>$fila[2], "ID_Ruta"=>$fila[3], "Laitud_E"=>$fila[4], "Longitud_E"=>$fila[5]);
                    $i++;
            }
            
        }
        //$lista=array_map('htmlentities',$lista);
        //$temp= html_entity_decode(json_encode($lista)); //$lista

            $temp= codificar(json_encode($lista));
            echo  $temp;

    }else{
        echo "Error no se recibio el dato";
    }

//echo json_encode($lista);

           /*
    *codificar
    *
    */
    function codificar($text) {
        if (!is_utf8($text)) {
            $text = utf8_encode($text);
        }

        return $text;
    }
    /*
    *is_utf8
    *
    */
    function is_utf8($string) {

        // From http://w3.org/International/questions/qa-forms-utf-8.html
        return preg_match('%^(?:
              [\x09\x0A\x0D\x20-\x7E]            # ASCII
            | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
            |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
            | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
            |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
            |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
            | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
            |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
        )*$%xs', substr($string, 0, 100));
    }

?>
