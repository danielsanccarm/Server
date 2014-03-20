<?php
    include_once 'db_functions.php';
    $db = new DB_Functions();
    if(isset($_POST)){
        //var_dump($_POST);
        //exit(0);
        $insercion = explode(",",$_POST['parada']);
        //$insercion = json_decode($_POST['parada']);
        //$lista = new Array();
        $i=0;
        
        foreach($insercion as $conteo){
               $resultado = $db->Descarga($conteo);//$conteo
                while($fila  = mysql_fetch_row($resultado)){
                    //$lista = array(array($fila[0],$fila[1],$fila[2],$fila[3],$fila[4]));
                    //array_push($lista[],$fila[0],$fila[1],$fila[2],$fila[3]);
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
