<?php
/*
*conecta_db
*
*/
function conecta_db() {
    global $ZOGA;

    $host = "localhost";
    $user = "daniel_usr";
    $password = "esime_culhuacan";
    $db_name = "daniel_db";
    
    $db_id = mysql_connect($host, $user, $password);
    mysql_select_db($db_name, $db_id);
    return $db_id;
}
?>