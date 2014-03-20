<?php

class DB_Functions {

    private $db;

    // constructor
    function __construct() {
        include_once './db_connect.php';
        // Conectando a la base de datos
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $gcm_regid) {
        mysql_query('SET CHARACTER SET utf8');          //Ponemos la codificación de carácteres como utf8
        // insert user into database
        //$result = mysql_query("INSERT INTO gcm_users(name, email, gcm_regid, create_at) VALUES('$name', '$email', '$gcm_regid', NOW())");
        
        //Insertaremos unicamente cuando no exista un registro con el nombre y el correo obtenidos del usuario
        $result = mysql_query("Insert into gcm_users (name, email, gcm_regid, create_at) 
                                                Select '$name','$email','$gcm_regid', 
                                                NOW() from dual where NOT exists( Select id from gcm_users where gcm_regid='$gcm_regid' );");
        
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM gcm_users WHERE id = $id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmail($email) {
        $result = mysql_query("SELECT * FROM gcm_users WHERE email = '$email' LIMIT 1");
        return $result;
    }

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM gcm_users");
        return $result;
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysql_query("SELECT email from gcm_users WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }

    public function AltaBus($latitud, $longitud, $identificador){
        //$result =mysql_query("Insert INTO Unidades(Latitud, Longitud) values('$latitud','$longitud')");
		
        //$id = mysql_insert_id(); // last inserted id
        $result= mysql_query("UPDATE Unidades set Latitud='$latitud', Longitud='$longitud' where Placas='$identificador';"); //where id_Unidad = $identificador
        //$result= mysql_query("Insert INTO Unidades (id_Unidad,Latitud, Longitud) values('$id','$latitud','$longitud') on duplicate key update Latitud='$latitud', Longitud='$longitud';");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM Unidades WHERE id_Unidad = '$id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
	}

    public function RegistraBus($nombre,$apellido,$placas,$id_ruta){
        //Registrar el bus y retornarle el ID, para almacenarlo en el dispositivo
        //$result = mysql_query("Insert Into Unidades(Nombres,Apellidos,Placas,ID_Ruta) values('$nombre','$apellido','$placas','$id_ruta')");
		
		$existentes = mysql_query("Select * from Unidades where Placas = '$placas';");
		
			if (mysql_num_rows($existentes) >= 1){
				
				$result = mysql_query("UPDATE Unidades SET Nombres='$nombre', Apellidos='$apellido' WHERE Placas ='$placas';");
			
			}
			else{
			
				$result = mysql_query("Insert Into Unidades(Nombres,Apellidos,Placas,ID_Ruta) values('$nombre','$apellido','$placas','$id_ruta');");
			
			}
		//$result = mysql_query("Insert into Unidades (Nombres, Apellidos, Placas, ID_Ruta) 
        //                                        Select '$nombre','$apellido','$placas', '$id_ruta',
        //                                        NOW() from dual where NOT exists( Select id_Unidad from Unidades where Unidades.Placas='$placas' 
        //                                        AND Nombres = '$nombre' AND Apellidos = '$apellido');");
        //Guardamos el último ID insertado
        //$id=mysql_insert_id();
        
        }
    
    public function MostrarBus(){
           $result = mysql_query("Select * from Unidades");
           return $result;

    }
    
    public function AnalisisPeriferias(){
           $result = mysql_query("Select ID_Periferia, Latitud_P, Longitud_P from Periferia where ID_Estacion='1'");
           return $result;
    }
    
    public function GCM_IDS_Estacion(){
           $gcm_ids=mysql_query("Select gcm_regid from gcm_users, UserStUnit, Estaciones where gcm_users.id= UserStUnit.ID_User and UserStUnit.ID_Estacion = Estaciones.ID_Estacion;");
           return $gcm_ids;
    }

    public function Descarga($conteo){
           mysql_query('SET CHARACTER SET utf8');
            $descarga = mysql_query("Select  Estaciones.ID_Estacion, Rutas.Ruta, Estaciones.Nombre, Estaciones.ID_Ruta, Estaciones.Latitud_E, Estaciones.Longitud_E from Estaciones inner join Rutas on Rutas.ID_Ruta = Estaciones.ID_Ruta where Estaciones.ID_Ruta =".$conteo.";");  //$conteo
            
            return $descarga;
    }
    
    public function RegistrarSolicitudNotificacion($estacion, $id_gcm){
    
        /*
        $result = mysql_query("Insert Into UserStUnit (Apuntador,ID_Estacion,ID_User)  Select 1,'.$estacion.',('.$select_id_usuario.') 
                                                from dual where NOT exists( Select ID_UserStUnit from UserStUnit where ID_Estacion='.$estacion.' 
                                                AND ID_User = ('.$select_id_usuario.'));");
           */                                     
         $result= mysql_query("Insert Into UserStUnit (Apuntador,ID_Estacion,ID_User)  Select 1,'$estacion',(Select id from gcm_users 
                                            where gcm_regid='".$id_gcm."')
                                            from dual where NOT exists( Select ID_UserStUnit from UserStUnit where ID_Estacion='$estacion' 
                                                AND ID_User = (Select id from gcm_users where gcm_regid='".$id_gcm."'));");
        return $result;
    }


}


?>
