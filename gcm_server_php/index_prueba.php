<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/gcm_server_php/conecta.php");
if(!isset($db_id)) { $db_id = conecta_db(); }

$sql='update gcm_users set name="Ismael" where id=181818 limit 2';
//$sql='select * from gcm_users';
//$res=mysql_query($sql,$db_id);
while($fila=mysql_fetch_assoc($res))
{
 var_dump($fila);
 echo '<hr>';
}
?>